(function ($) {
	'use strict';

	$(function () {
		// Hero photo uploader
		var heroFrame;
		var $heroSelect = $('#ppf-hero-photo-select');
		var $heroRemove = $('#ppf-hero-photo-remove');
		var $heroInput = $('#hero_photo_id');
		var $heroPreview = $('#ppf-hero-photo-preview');

		if ($heroSelect.length) {
			$heroSelect.on('click', function (event) {
				event.preventDefault();

				if (heroFrame) {
					heroFrame.open();
					return;
				}

				heroFrame = wp.media({
					title: 'Selecionar imagem do hero',
					button: { text: 'Usar esta imagem' },
					multiple: false,
				});

				heroFrame.on('select', function () {
					var attachment = heroFrame.state().get('selection').first().toJSON();
					$heroInput.val(attachment.id);
					$heroPreview.html('<img src="' + attachment.url + '" style="max-width:300px;height:auto;" />');
				});

				heroFrame.open();
			});

			$heroRemove.on('click', function (event) {
				event.preventDefault();
				$heroInput.val('');
				$heroPreview.empty();
			});
		}

		// Partnership photo uploader
		var partnershipFrame;
		var $partnershipSelect = $('#ppf-partnership-photo-select');
		var $partnershipRemove = $('#ppf-partnership-photo-remove');
		var $partnershipInput = $('#partnership_photo_id');
		var $partnershipPreview = $('#ppf-partnership-photo-preview');

		if ($partnershipSelect.length) {
			$partnershipSelect.on('click', function (event) {
				event.preventDefault();

				if (partnershipFrame) {
					partnershipFrame.open();
					return;
				}

				partnershipFrame = wp.media({
					title: 'Selecionar imagem de parceria',
					button: { text: 'Usar esta imagem' },
					multiple: false,
				});

				partnershipFrame.on('select', function () {
					var attachment = partnershipFrame.state().get('selection').first().toJSON();
					$partnershipInput.val(attachment.id);
					$partnershipPreview.html('<img src="' + attachment.url + '" style="max-width:300px;height:auto;" />');
				});

				partnershipFrame.open();
			});

			$partnershipRemove.on('click', function (event) {
				event.preventDefault();
				$partnershipInput.val('');
				$partnershipPreview.empty();
			});
		}
	});
})(jQuery);
