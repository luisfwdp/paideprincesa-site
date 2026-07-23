<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Popula conteudo inicial (paginas legais, FAQ, responsaveis e modulos) na
 * ativacao do tema, apenas uma vez (controlado pela option ppf_seeded_v1).
 * Tudo aqui e editavel depois em wp-admin - isto e so o ponto de partida
 * para o site nao ir ao ar vazio ou com lorem ipsum.
 */
function ppf_seed_default_content() {
	if ( get_option( 'ppf_seeded_v1' ) ) {
		return;
	}

	ppf_seed_legal_pages();
	ppf_seed_faq();
	ppf_seed_people();
	ppf_seed_modules();

	update_option( 'ppf_seeded_v1', 1 );
}
add_action( 'after_switch_theme', 'ppf_seed_default_content' );

function ppf_legal_notice() {
	return "<p><em>Aviso: este texto e um modelo inicial e precisa ser revisado por um profissional juridico antes da publicacao definitiva. Substitua os campos entre colchetes pelos dados reais da empresa.</em></p>\n\n";
}

function ppf_seed_legal_pages() {
	$pages = array(
		'termos' => array(
			'title'   => 'Termos de Uso',
			'content' => ppf_legal_notice() .
				"<h2>1. Aceitacao dos termos</h2><p>Ao acessar e utilizar o site Pai de Princesa e o curso oferecido, voce concorda com estes Termos de Uso.</p>" .
				"<h2>2. Sobre o curso</h2><p>O Pai de Princesa e um curso digital educacional voltado a pais e responsaveis, com conteudo sobre cuidados cotidianos com filhas. O conteudo tem carater educacional e nao substitui orientacao medica, dermatologica ou profissional especifica.</p>" .
				"<h2>3. Acesso</h2><p>O acesso ao conteudo e liberado apos a confirmacao do pagamento na plataforma de checkout (Kiwify ou Greenn) e e de uso pessoal e intransferivel.</p>" .
				"<h2>4. Empresa responsavel</h2><p>[RAZAO SOCIAL A CONFIRMAR], inscrita no CNPJ [CNPJ A CONFIRMAR], com sede em [ENDERECO A CONFIRMAR].</p>" .
				"<h2>5. Contato</h2><p>Duvidas podem ser enviadas para [E-MAIL DE SUPORTE A CONFIRMAR].</p>",
		),
		'privacidade' => array(
			'title'   => 'Politica de Privacidade',
			'content' => ppf_legal_notice() .
				"<h2>1. Dados coletados</h2><p>Coletamos os dados fornecidos no momento da compra (nome, e-mail) pela plataforma de checkout, alem de dados de navegacao neste site (cookies, analytics).</p>" .
				"<h2>2. Finalidade</h2><p>Os dados sao usados para liberar o acesso ao curso, enviar comunicacoes relacionadas a compra e melhorar a experiencia do site.</p>" .
				"<h2>3. Compartilhamento</h2><p>Nao vendemos dados pessoais. Dados de pagamento sao processados diretamente pela plataforma de checkout (Kiwify ou Greenn), que possui suas proprias politicas de privacidade.</p>" .
				"<h2>4. Seus direitos (LGPD)</h2><p>Voce pode solicitar acesso, correcao ou exclusao dos seus dados pessoais entrando em contato pelo e-mail [E-MAIL DE SUPORTE A CONFIRMAR].</p>" .
				"<h2>5. Cookies</h2><p>Consulte nossa <a href=\"/cookies\">Politica de Cookies</a> para mais detalhes.</p>",
		),
		'cookies' => array(
			'title'   => 'Politica de Cookies',
			'content' => ppf_legal_notice() .
				"<h2>O que sao cookies</h2><p>Cookies sao pequenos arquivos armazenados no seu navegador para lembrar preferencias e coletar dados de navegacao.</p>" .
				"<h2>Categorias utilizadas neste site</h2><ul><li><strong>Necessarios:</strong> essenciais para o funcionamento do site.</li><li><strong>Analytics:</strong> ajudam a entender como o site e utilizado.</li><li><strong>Marketing:</strong> usados para mensurar a eficacia de campanhas.</li><li><strong>Preferencias:</strong> lembram escolhas feitas por voce no site.</li></ul>" .
				"<p>Voce pode gerenciar suas preferencias de cookies a qualquer momento pelo banner exibido na primeira visita.</p>",
		),
		'reembolso' => array(
			'title'   => 'Politica de Reembolso',
			'content' => ppf_legal_notice() .
				"<h2>Garantia</h2><p>O prazo de garantia e as condicoes de reembolso sao os informados no momento da compra, no checkout da plataforma utilizada (Kiwify ou Greenn).</p>" .
				"<h2>Como solicitar</h2><p>Solicitacoes de reembolso devem ser feitas diretamente pela plataforma de pagamento utilizada na compra, ou pelo e-mail [E-MAIL DE SUPORTE A CONFIRMAR].</p>",
		),
		'aviso-legal' => array(
			'title'   => 'Aviso Legal',
			'content' => ppf_legal_notice() .
				"<h2>Natureza do conteudo</h2><p>O curso Pai de Princesa tem carater educacional e trata de cuidados cotidianos (cabelo, vestuario, rotina). O conteudo nao substitui orientacao medica, dermatologica, psicologica ou juridica.</p>" .
				"<h2>Resultados</h2><p>Nao garantimos resultados especificos, uma vez que estes dependem da aplicacao individual do conteudo por cada aluno.</p>",
		),
	);

	foreach ( $pages as $slug => $page ) {
		$existing = get_page_by_path( $slug );
		if ( $existing ) {
			continue;
		}

		wp_insert_post( array(
			'post_title'   => $page['title'],
			'post_name'    => $slug,
			'post_content' => $page['content'],
			'post_status'  => 'publish',
			'post_type'    => 'page',
		) );
	}
}

function ppf_seed_faq() {
	if ( ! empty( get_posts( array( 'post_type' => 'ppf_faq', 'posts_per_page' => 1, 'post_status' => 'any' ) ) ) ) {
		return;
	}

	$faqs = array(
		array( 'Preciso ter alguma experiencia?', 'Nao. O curso comeca pelo basico e foi desenvolvido para quem nunca aprendeu esses cuidados.' ),
		array( 'O curso e apenas para pais solteiros?', 'Nao. Ele serve para qualquer pai ou responsavel que queira participar mais da rotina de uma menina.' ),
		array( 'Consigo assistir pelo celular?', 'Sim. A plataforma de aulas funciona em celular, tablet e computador.' ),
		array( 'Preciso comprar muitos produtos?', 'Nao. As aulas priorizam materiais simples. Cada aula informa o que sera necessario.' ),
		array( 'Por quanto tempo terei acesso?', 'O prazo e o informado na oferta e no checkout no momento da compra.' ),
		array( 'Como recebo o acesso?', 'Depois da confirmacao do pagamento, voce recebe as orientacoes de acesso no e-mail usado na compra.' ),
		array( 'Ja comprei, mas nao consegui entrar. O que faco?', 'Entre em contato com o suporte da plataforma de pagamento (Kiwify ou Greenn) usando o mesmo e-mail da compra, ou fale com nosso suporte.' ),
		array( 'Posso assistir no meu ritmo?', 'Sim. Voce pode continuar de onde parou e acompanhar seu proprio progresso dentro da area de membros.' ),
		array( 'O curso substitui orientacao medica ou profissional?', 'Nao. O conteudo e educacional e trata de cuidados cotidianos. Questoes medicas, dermatologicas ou especificas devem ser avaliadas por profissionais qualificados.' ),
	);

	foreach ( $faqs as $index => $faq ) {
		wp_insert_post( array(
			'post_title'   => $faq[0],
			'post_content' => $faq[1],
			'post_status'  => 'publish',
			'post_type'    => 'ppf_faq',
			'menu_order'   => $index,
		) );
	}
}

function ppf_seed_people() {
	if ( ! empty( get_posts( array( 'post_type' => 'ppf_person', 'posts_per_page' => 1, 'post_status' => 'any' ) ) ) ) {
		return;
	}

	$people = array(
		array(
			'title'   => 'Prity Santos',
			'content' => 'Prity Santos e cabeleireira em Curitiba e uma das responsaveis pela parte pratica do Pai de Princesa. No curso, ela transforma conhecimentos que poderiam parecer complicados em orientacoes faceis de entender e aplicar, mesmo para um pai que nunca segurou uma escova, fez uma tranca ou escolheu produtos para o cabelo da filha. Com Prity, voce vai aprender cuidados essenciais, formas mais tranquilas de desembaracar, organizacao dos materiais e penteados possiveis para a rotina.',
			'meta'    => array(
				'role_label'          => 'Responsavel pela orientacao pratica',
				'occupation'          => 'Cabeleireira',
				'city'                => 'Curitiba',
				'subtitle'            => 'A tecnica explicada de maneira simples e acolhedora.',
				'featured_quote'      => 'A missao dela no curso e mostrar que voce nao precisa ser profissional. Precisa apenas aprender o jeito certo de comecar.',
				'instagram_primary'   => 'https://www.instagram.com/pritysantos/',
				'instagram_secondary' => 'https://www.instagram.com/studiopritysantos/',
				'cta_label'           => 'Conhecer Prity Santos',
			),
		),
		array(
			'title'   => 'Rodrigo Fabbris',
			'content' => 'Rodrigo Fabbris e advogado e pai separado. Enquanto mantem sua rotina profissional, ele tambem participa ativamente dos compromissos da filha: escola, festas, apresentacoes, danca, eventos e todos os pequenos cuidados que fazem parte da vida de um pai presente. Como muitos pais, Rodrigo percebeu que amar e desejar participar nem sempre significa saber exatamente o que fazer. Foi dessa experiencia que surgiu uma das bases do Pai de Princesa: criar um caminho para que outros pais aprendam sem constrangimento, sem julgamentos e sem depender sempre de outra pessoa.',
			'meta'    => array(
				'role_label'          => 'Idealizador e representante da experiencia real dos pais',
				'occupation'          => 'Advogado',
				'city'                => 'Curitiba',
				'subtitle'            => 'A experiencia real de quem concilia trabalho, responsabilidades e paternidade.',
				'featured_quote'      => 'Rodrigo representa o pai que tem uma rotina corrida, mas entende que presenca tambem se constroi nos pequenos detalhes.',
				'instagram_primary'   => 'https://www.instagram.com/rodrigofabbris/',
				'instagram_secondary' => 'https://www.instagram.com/rodrigofabbrisadvogado/',
				'cta_label'           => 'Conhecer Rodrigo Fabbris',
			),
		),
	);

	foreach ( $people as $index => $person ) {
		$post_id = wp_insert_post( array(
			'post_title'   => $person['title'],
			'post_content' => $person['content'],
			'post_status'  => 'publish',
			'post_type'    => 'ppf_person',
			'menu_order'   => $index,
		) );

		if ( $post_id && ! is_wp_error( $post_id ) ) {
			foreach ( $person['meta'] as $key => $value ) {
				update_post_meta( $post_id, $key, $value );
			}
			update_post_meta( $post_id, 'image_consent_confirmed', '0' );
		}
	}
}

function ppf_seed_modules() {
	if ( ! empty( get_posts( array( 'post_type' => 'ppf_module', 'posts_per_page' => 1, 'post_status' => 'any' ) ) ) ) {
		return;
	}

	$modules = array(
		array( 'Modulo 1 - Comecando sem medo', 'O que voce realmente precisa saber, como criar uma rotina simples, produtos e acessorios basicos e erros comuns que podem ser evitados.' ),
		array( 'Modulo 2 - Cabelo sem complicacao', 'Como identificar necessidades basicas do cabelo, desembaracar sem machucar, lavar e secar corretamente, e escolher escova, pente e acessorios.' ),
		array( 'Modulo 3 - Penteados para o cotidiano', 'Rabo de cavalo, maria-chiquinha, trancas simples, coques basicos e penteados rapidos para escola e passeios.' ),
		array( 'Modulo 4 - Roupas e ocasioes', 'Como combinar pecas, escolher roupas confortaveis, vestir para escola, passeio, festa e compromissos, e organizar conjuntos com antecedencia.' ),
		array( 'Modulo 5 - Cuidados para momentos especiais', 'Preparacao para festas, acessorios, cuidados leves de apresentacao e maquiagem infantil leve e adequada, quando necessaria e permitida pelos responsaveis.' ),
		array( 'Modulo 6 - Presenca que fica', 'Como transformar tarefas em momentos de conexao, incentivar autonomia, ouvir e respeitar as preferencias da filha, e continuar aprendendo em cada fase.' ),
	);

	foreach ( $modules as $index => $module ) {
		$post_id = wp_insert_post( array(
			'post_title'   => $module[0],
			'post_content' => $module[1],
			'post_status'  => 'publish',
			'post_type'    => 'ppf_module',
			'menu_order'   => $index,
		) );

		if ( $post_id && ! is_wp_error( $post_id ) ) {
			update_post_meta( $post_id, 'is_locked', $index > 0 ? '1' : '0' );
		}
	}
}
