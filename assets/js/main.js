(function () {
	'use strict';

	var settings = window.ppfSettings || {};
	window.dataLayer = window.dataLayer || [];

	function pushEvent( name, payload ) {
		window.dataLayer.push( Object.assign( { event: name, page_path: window.location.pathname }, payload || {} ) );
	}

	/* --------------------------------------------------------------------
	 * Mobile menu
	 * ------------------------------------------------------------------ */
	var menuToggle = document.getElementById( 'ppf-menu-toggle' );
	var nav = document.getElementById( 'ppf-primary-nav' );
	if ( menuToggle && nav ) {
		menuToggle.addEventListener( 'click', function () {
			var isOpen = nav.classList.toggle( 'is-open' );
			menuToggle.setAttribute( 'aria-expanded', isOpen ? 'true' : 'false' );
		} );
		nav.querySelectorAll( 'a' ).forEach( function ( link ) {
			link.addEventListener( 'click', function () {
				nav.classList.remove( 'is-open' );
				menuToggle.setAttribute( 'aria-expanded', 'false' );
			} );
		} );
	}

	/* --------------------------------------------------------------------
	 * UTM / click-id preservation on checkout links
	 * ------------------------------------------------------------------ */
	var TRACKED_PARAMS = [ 'utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term', 'fbclid', 'gclid', 'src', 'sck' ];
	var STORAGE_KEY = 'ppf_tracking_params';

	function captureTrackingParams() {
		var params = new URLSearchParams( window.location.search );
		var stored = {};
		try {
			stored = JSON.parse( sessionStorage.getItem( STORAGE_KEY ) || '{}' );
		} catch ( e ) {
			stored = {};
		}
		TRACKED_PARAMS.forEach( function ( key ) {
			if ( params.has( key ) ) {
				stored[ key ] = params.get( key );
			}
		} );
		try {
			sessionStorage.setItem( STORAGE_KEY, JSON.stringify( stored ) );
		} catch ( e ) { /* sessionStorage indisponível: segue sem persistir */ }
		return stored;
	}

	function applyTrackingParamsToCheckoutLinks() {
		var tracked = captureTrackingParams();
		if ( ! Object.keys( tracked ).length ) {
			return;
		}
		document.querySelectorAll( '.js-checkout-cta' ).forEach( function ( link ) {
			var rawHref = link.getAttribute( 'href' ) || '';
			if ( ! rawHref || rawHref.charAt( 0 ) === '#' ) {
				return;
			}
			try {
				var url = new URL( link.href, window.location.origin );
				Object.keys( tracked ).forEach( function ( key ) {
					if ( ! url.searchParams.has( key ) ) {
						url.searchParams.set( key, tracked[ key ] );
					}
				} );
				link.href = url.toString();
			} catch ( e ) { /* href inválido (ex: '#oferta') - ignora */ }
		} );
	}

	/* --------------------------------------------------------------------
	 * Campaign countdown
	 * ------------------------------------------------------------------ */
	function initCampaignCountdown() {
		var bar = document.querySelector( '.ppf-campaign-bar' );
		if ( ! bar ) {
			return;
		}
		var endsAt = bar.getAttribute( 'data-campaign-ends' );
		var countdownEl = bar.querySelector( '[data-countdown]' );
		if ( ! endsAt || ! countdownEl ) {
			return;
		}
		var endTime = new Date( endsAt ).getTime();
		if ( isNaN( endTime ) ) {
			return;
		}

		function tick() {
			var diff = endTime - Date.now();
			if ( diff <= 0 ) {
				bar.remove();
				return;
			}
			var hours = Math.floor( diff / 3600000 );
			var minutes = Math.floor( ( diff % 3600000 ) / 60000 );
			var seconds = Math.floor( ( diff % 60000 ) / 1000 );
			countdownEl.textContent = '(' + [ hours, minutes, seconds ].map( function ( n ) {
				return String( n ).padStart( 2, '0' );
			} ).join( ':' ) + ')';
			window.requestAnimationFrame( function () {
				setTimeout( tick, 1000 );
			} );
		}
		tick();
	}

	/* --------------------------------------------------------------------
	 * Analytics: cliques de CTA, WhatsApp, FAQ, responsáveis, oferta visível
	 * ------------------------------------------------------------------ */
	function initAnalyticsBindings() {
		document.querySelectorAll( '.js-checkout-cta' ).forEach( function ( link ) {
			link.addEventListener( 'click', function () {
				pushEvent( link.getAttribute( 'data-analytics-event' ) || 'section_cta_click' );
				if ( window.fbq ) {
					window.fbq( 'track', 'InitiateCheckout' );
				}
			} );
		} );

		var whatsapp = document.querySelector( '.js-whatsapp-cta' );
		if ( whatsapp ) {
			whatsapp.addEventListener( 'click', function () {
				pushEvent( 'whatsapp_click' );
			} );
		}

		document.querySelectorAll( '.js-faq-item' ).forEach( function ( item ) {
			item.addEventListener( 'toggle', function () {
				if ( item.open ) {
					var question = item.querySelector( 'summary' );
					pushEvent( 'faq_open', { faq_question: question ? question.textContent.trim() : '' } );
				}
			} );
		} );

		document.querySelectorAll( '.js-responsible-link' ).forEach( function ( link ) {
			link.addEventListener( 'click', function () {
				pushEvent( 'responsible_profile_click', {
					person_slug: link.getAttribute( 'data-person-slug' ),
					link_type: link.getAttribute( 'data-link-type' ),
				} );
			} );
		} );

		var offer = document.getElementById( 'oferta' );
		if ( offer && 'IntersectionObserver' in window ) {
			var observer = new IntersectionObserver( function ( entries, obs ) {
				entries.forEach( function ( entry ) {
					if ( entry.isIntersecting ) {
						pushEvent( 'view_offer' );
						obs.disconnect();
					}
				} );
			}, { threshold: 0.4 } );
			observer.observe( offer );
		}

		var responsibleSection = document.getElementById( 'responsaveis' );
		if ( responsibleSection && 'IntersectionObserver' in window ) {
			var respObserver = new IntersectionObserver( function ( entries, obs ) {
				entries.forEach( function ( entry ) {
					if ( entry.isIntersecting ) {
						pushEvent( 'view_responsible_people_section' );
						obs.disconnect();
					}
				} );
			}, { threshold: 0.3 } );
			respObserver.observe( responsibleSection );
		}
	}

	/* --------------------------------------------------------------------
	 * Cookie consent (LGPD) + carregamento condicional do GTM
	 * ------------------------------------------------------------------ */
	var CONSENT_COOKIE = settings.consentCookieKey || 'ppf_cookie_consent';

	function getCookie( name ) {
		var match = document.cookie.match( new RegExp( '(?:^|; )' + name + '=([^;]*)' ) );
		return match ? decodeURIComponent( match[1] ) : null;
	}

	function setCookie( name, value, days ) {
		var expires = new Date( Date.now() + days * 864e5 ).toUTCString();
		document.cookie = name + '=' + encodeURIComponent( value ) + '; expires=' + expires + '; path=/; SameSite=Lax';
	}

	function loadGTM( gtmId ) {
		if ( ! gtmId || document.getElementById( 'ppf-gtm-script' ) ) {
			return;
		}
		window.dataLayer.push( { 'gtm.start': new Date().getTime(), event: 'gtm.js' } );
		var script = document.createElement( 'script' );
		script.id = 'ppf-gtm-script';
		script.async = true;
		script.src = 'https://www.googletagmanager.com/gtm.js?id=' + gtmId;
		document.head.appendChild( script );

		var iframe = document.createElement( 'iframe' );
		iframe.src = 'https://www.googletagmanager.com/ns.html?id=' + gtmId;
		iframe.height = 0;
		iframe.width = 0;
		iframe.style.display = 'none';
		iframe.style.visibility = 'hidden';
		var noscript = document.createElement( 'noscript' );
		noscript.appendChild( iframe );
		document.body.insertBefore( noscript, document.body.firstChild );
	}

	function loadMetaPixel( pixelId ) {
		if ( ! pixelId || window.fbq ) {
			return;
		}
		/* eslint-disable */
		!function(f,b,e,v,n,t,s)
		{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
		n.callMethod.apply(n,arguments):n.queue.push(arguments)};
		if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
		n.queue=[];t=b.createElement(e);t.async=!0;
		t.src=v;s=b.getElementsByTagName(e)[0];
		s.parentNode.insertBefore(t,s)}(window, document,'script',
		'https://connect.facebook.net/en_US/fbevents.js');
		/* eslint-enable */
		window.fbq( 'init', pixelId );
		window.fbq( 'track', 'PageView' );

		var img = document.createElement( 'img' );
		img.height = 1;
		img.width = 1;
		img.style.display = 'none';
		img.src = 'https://www.facebook.com/tr?id=' + pixelId + '&ev=PageView&noscript=1';
		var noscript = document.createElement( 'noscript' );
		noscript.appendChild( img );
		document.body.insertBefore( noscript, document.body.firstChild );
	}

	function initCookieConsent() {
		var banner = document.getElementById( 'ppf-cookie-consent' );
		if ( ! banner ) {
			return;
		}

		var existing = getCookie( CONSENT_COOKIE );
		if ( existing ) {
			try {
				var consent = JSON.parse( existing );
				if ( consent.analytics || consent.marketing ) {
					loadGTM( settings.gtmId );
				}
				if ( consent.marketing ) {
					loadMetaPixel( settings.metaPixelId );
				}
			} catch ( e ) { /* cookie corrompido: trata como sem decisão */ }
			return;
		}

		banner.hidden = false;

		var optionsPanel = document.getElementById( 'ppf-cookie-options' );
		var customizeBtn = document.getElementById( 'ppf-cookie-customize' );
		var acceptBtn = document.getElementById( 'ppf-cookie-accept' );
		var rejectBtn = document.getElementById( 'ppf-cookie-reject' );

		if ( customizeBtn && optionsPanel ) {
			customizeBtn.addEventListener( 'click', function () {
				optionsPanel.hidden = ! optionsPanel.hidden;
			} );
		}

		function saveConsent( consent ) {
			setCookie( CONSENT_COOKIE, JSON.stringify( consent ), 180 );
			banner.hidden = true;
			if ( consent.analytics || consent.marketing ) {
				loadGTM( settings.gtmId );
			}
			if ( consent.marketing ) {
				loadMetaPixel( settings.metaPixelId );
			}
		}

		if ( acceptBtn ) {
			acceptBtn.addEventListener( 'click', function () {
				var panelOpen = optionsPanel && ! optionsPanel.hidden;
				saveConsent( {
					necessary: true,
					analytics: panelOpen ? document.getElementById( 'ppf-consent-analytics' ).checked : true,
					marketing: panelOpen ? document.getElementById( 'ppf-consent-marketing' ).checked : true,
					preferences: panelOpen ? document.getElementById( 'ppf-consent-preferences' ).checked : true,
				} );
			} );
		}

		if ( rejectBtn ) {
			rejectBtn.addEventListener( 'click', function () {
				saveConsent( { necessary: true, analytics: false, marketing: false, preferences: false } );
			} );
		}
	}

	/* --------------------------------------------------------------------
	 * Header ganha sombra depois de rolar a página
	 * ------------------------------------------------------------------ */
	function initHeaderScrollState() {
		var header = document.getElementById( 'ppf-header' );
		if ( ! header ) {
			return;
		}
		function update() {
			header.classList.toggle( 'is-scrolled', window.scrollY > 12 );
		}
		update();
		window.addEventListener( 'scroll', update, { passive: true } );
	}

	/* --------------------------------------------------------------------
	 * Reveal ao rolar: elementos marcados com .js-reveal ganham a classe
	 * .is-visible quando entram na tela, disparando a transição definida em
	 * CSS. Respeita prefers-reduced-motion (o CSS zera a transição nesse caso
	 * via media query global, então aqui só cuidamos de mostrar o elemento).
	 * ------------------------------------------------------------------ */
	function initScrollReveal() {
		var items = document.querySelectorAll( '.js-reveal' );
		if ( ! items.length ) {
			return;
		}
		if ( ! ( 'IntersectionObserver' in window ) ) {
			items.forEach( function ( el ) {
				el.classList.add( 'is-visible' );
			} );
			return;
		}
		var observer = new IntersectionObserver( function ( entries, obs ) {
			entries.forEach( function ( entry ) {
				if ( entry.isIntersecting ) {
					entry.target.classList.add( 'is-visible' );
					obs.unobserve( entry.target );
				}
			} );
		}, { threshold: 0.15, rootMargin: '0px 0px -40px 0px' } );
		items.forEach( function ( el ) {
			observer.observe( el );
		} );
	}

	/* --------------------------------------------------------------------
	 * Init: cada função roda isolada - se uma falhar (ex: markup alterado
	 * por plugin de cache/otimização), as demais continuam normalmente em
	 * vez de travar o script inteiro (isso já aconteceu: uma falha aqui
	 * impedia até o banner de cookies de aparecer).
	 * ------------------------------------------------------------------ */
	function safeRun( fn ) {
		try {
			fn();
		} catch ( e ) {
			window.console && console.error( 'ppf-main:', e );
		}
	}

	document.addEventListener( 'DOMContentLoaded', function () {
		safeRun( applyTrackingParamsToCheckoutLinks );
		safeRun( initCampaignCountdown );
		safeRun( initAnalyticsBindings );
		safeRun( initCookieConsent );
		safeRun( initHeaderScrollState );
		safeRun( initScrollReveal );
		safeRun( function () { pushEvent( 'page_view' ); } );
	} );
})();
