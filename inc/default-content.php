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

/**
 * Dados dos dois responsaveis (Prity Santos e Rodrigo Fabbris), conforme o
 * roteiro oficial. Usado tanto no seed inicial quanto na migracao de copy
 * (ppf_migrate_content_v3) para sites que ja tinham essas paginas ativas.
 */
function ppf_people_seed_data() {
	return array(
		array(
			'title'   => 'Prity Santos',
			'content' => 'Prity Santos e uma das responsaveis pela parte pratica do Pai de Princesa. No curso, ela transforma conhecimentos profissionais em orientacoes simples, pensadas para pais que nunca tiveram contato com esse tipo de cuidado. Prity ensina como escolher produtos, desembaracar o cabelo com mais tranquilidade, organizar os materiais e compreender os cuidados basicos para diferentes tipos de cabelo infantil.',
			'meta'    => array(
				'role_label'          => 'Responsavel pela orientacao pratica',
				'occupation'          => 'Cabeleireira',
				'city'                => 'Curitiba',
				'subtitle'            => 'A tecnica explicada de maneira simples e acolhedora.',
				'featured_quote'      => 'Voce nao precisa ser profissional. Precisa apenas aprender o jeito certo de comecar.',
				'instagram_primary'   => 'https://www.instagram.com/pritysantos/',
				'instagram_secondary' => 'https://www.instagram.com/studiopritysantos/',
				'cta_label'           => 'Conhecer Prity Santos',
				'secondary_cta_label' => 'Conhecer o Studio Prity Santos',
			),
		),
		array(
			'title'   => 'Rodrigo Fabbris',
			'content' => 'Rodrigo Fabbris concilia sua rotina como advogado com os compromissos e os cuidados que fazem parte da vida de um pai presente. Escola, festas, danca, apresentacoes, eventos e os pequenos desafios cotidianos fazem parte dessa rotina. Como muitos pais, Rodrigo percebeu que amar e querer participar nao significa saber automaticamente como fazer tudo. Foi dessa experiencia que surgiu uma das bases do Pai de Princesa: criar um caminho para outros pais aprenderem sem constrangimento, sem julgamento e sem dependerem sempre de outra pessoa.',
			'meta'    => array(
				'role_label'          => 'Advogado, pai separado e um dos idealizadores do Pai de Princesa',
				'occupation'          => 'Advogado',
				'city'                => 'Curitiba',
				'subtitle'            => 'A experiencia real de quem concilia trabalho, responsabilidades e paternidade.',
				'featured_quote'      => 'Presenca tambem se constroi nos pequenos detalhes.',
				'instagram_primary'   => 'https://www.instagram.com/rodrigofabbris/',
				'instagram_secondary' => 'https://www.instagram.com/rodrigofabbrisadvogado/',
				'cta_label'           => 'Conhecer Rodrigo Fabbris',
				'secondary_cta_label' => 'Ver perfil profissional',
			),
		),
	);
}

function ppf_seed_people() {
	if ( ! empty( get_posts( array( 'post_type' => 'ppf_person', 'posts_per_page' => 1, 'post_status' => 'any' ) ) ) ) {
		return;
	}

	foreach ( ppf_people_seed_data() as $index => $person ) {
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

/**
 * Grade oficial dos modulos do curso, conforme o roteiro. Cada item vira um
 * post do CPT "ppf_module" com os campos definidos em inc/cpt-module.php.
 * "content_items" usa uma linha por bullet (convertido em <li> no template).
 */
function ppf_modules_seed_data() {
	return array(
		array(
			'title' => 'A Conexao Pai e Filha',
			'meta'  => array(
				'short_description' => 'Entenda por que os pequenos cuidados tambem sao uma forma de presenca, afeto e conexao.',
				'content_items'     => "A origem e o proposito do Pai de Princesa.\nA importancia da presenca paterna nos detalhes.\nComo os cuidados cotidianos ajudam a fortalecer o vinculo.\nA experiencia real de Rodrigo como pai.\nApresentacao de tudo o que sera aprendido no curso.",
				'participants'      => 'Prity Santos, Rodrigo Fabbris e participacao da filha de Rodrigo.',
				'duration_label'    => '8 a 10 minutos.',
				'is_locked'         => '0',
			),
		),
		array(
			'title' => 'Cuidados Basicos com o Cabelo Infantil',
			'meta'  => array(
				'short_description' => 'Aprenda os cuidados fundamentais para lidar com o cabelo infantil com mais seguranca e tranquilidade.',
				'content_items'     => "Diferencas basicas entre cabelos lisos, cacheados e crespos.\nComo escolher shampoo, condicionador e finalizador.\nComo desembaracar sem causar dor.\nCuidados com o couro cabeludo.\nFormas adequadas de secagem.\nComo utilizar pentes e escovas.\nDemonstracoes praticas.",
				'participants'      => 'Prity Santos como professora principal e participacao de crianca modelo autorizada.',
				'duration_label'    => '15 minutos.',
				'is_locked'         => '1',
			),
		),
		array(
			'title' => 'Penteados do Dia a Dia',
			'meta'  => array(
				'badge_label'        => 'Com a professora convidada Kimberly.',
				'short_description'  => 'Aprenda penteados simples e possiveis para escola, passeios e compromissos do cotidiano.',
				'content_items'      => "Como preparar o cabelo.\nTranca simples.\nCoque pratico.\nRabo de cavalo.\nFinalizacao.\nComo tornar o momento mais tranquilo para a crianca.",
				'featured_quote'     => 'O mais importante nao e alcancar um resultado perfeito. E o momento que voces vivem juntos.',
				'participants'       => 'Prity Santos, Kimberly e modelos autorizadas.',
				'duration_label'     => '25 a 30 minutos.',
				'is_locked'          => '1',
				'admin_review_note'  => 'Confirmar se "Kimberly" (professora convidada de penteados e maquiagem) e a mesma pessoa citada como "Kemily" no modulo de autoestima, ou se sao duas profissionais diferentes. Validar grafia antes da publicacao definitiva.',
			),
		),
		array(
			'title' => 'Autoestima e Beleza Infantil',
			'meta'  => array(
				'short_description' => 'Entenda como o cuidado, a atencao e a presenca paterna podem contribuir para a seguranca emocional da crianca.',
				'content_items'     => "A importancia do vinculo afetivo.\nA presenca paterna na rotina.\nComo gestos de cuidado podem impactar emocionalmente.\nSeguranca emocional.\nAutoconfianca.\nAmor proprio.\nRespeito a personalidade e as preferencias da crianca.\nFortalecimento da relacao entre pai e filha.",
				'participants'      => 'Rodrigo Fabbris e a psicologa Kemily.',
				'duration_label'    => '12 minutos.',
				'is_locked'         => '1',
				'admin_review_note' => 'Confirmar nome completo, registro profissional e forma correta de apresentacao da psicologa "Kemily" antes da publicacao definitiva. Confirmar tambem se e a mesma pessoa citada como "Kimberly" no modulo de penteados/bonus.',
			),
		),
		array(
			'title' => 'Moda Infantil Pratica',
			'meta'  => array(
				'short_description' => 'Aprenda a participar das escolhas de roupas de maneira simples, confortavel e adequada para cada ocasiao.',
				'content_items'     => "Combinacao basica de cores.\nComo escolher roupas confortaveis.\nComo combinar pecas.\nUso de acessorios.\nLooks para escola.\nLooks para passeios.\nLooks para festas e eventos.\nComo organizar conjuntos com antecedencia.\nParticipacao do pai nas escolhas da filha.",
				'participants'      => 'Prity Santos, stylist convidada, Rodrigo Fabbris e participacao da filha de Rodrigo.',
				'duration_label'    => '10 minutos.',
				'is_locked'         => '1',
				'admin_review_note' => 'Confirmar nome e informacoes profissionais da stylist convidada antes da publicacao definitiva.',
			),
		),
		array(
			'title' => 'Bonus - Maquiagem de Princesa',
			'meta'  => array(
				'badge_label'        => 'Bonus',
				'short_description'  => 'Orientacoes para uma maquiagem infantil leve, ludica e apropriada para ocasioes especiais.',
				'content_items'      => "Cuidados basicos de seguranca.\nEscolha de produtos adequados para pele infantil.\nAplicacao leve de blush.\nBrilho.\nBatom.\nToque suave de sombra colorida.\nComo respeitar a idade, a vontade e o conforto da crianca.",
				'participants'       => 'Professora: Kimberly.',
				'duration_label'     => '10 a 15 minutos.',
				'notice_text'        => 'O conteudo e destinado a ocasioes especiais, com produtos adequados, supervisao de um responsavel e respeito a vontade da crianca.',
				'is_locked'          => '1',
				'admin_review_note'  => 'Confirmar se "Kimberly" e a mesma pessoa citada como "Kemily" no modulo de autoestima, ou se sao duas profissionais diferentes. Validar grafia antes da publicacao definitiva.',
			),
		),
	);
}

function ppf_seed_modules() {
	if ( ! empty( get_posts( array( 'post_type' => 'ppf_module', 'posts_per_page' => 1, 'post_status' => 'any' ) ) ) ) {
		return;
	}

	ppf_insert_modules( ppf_modules_seed_data() );
}

function ppf_insert_modules( $modules ) {
	foreach ( $modules as $index => $module ) {
		$post_id = wp_insert_post( array(
			'post_title'   => $module['title'],
			'post_status'  => 'publish',
			'post_type'    => 'ppf_module',
			'menu_order'   => $index,
		) );

		if ( $post_id && ! is_wp_error( $post_id ) ) {
			foreach ( $module['meta'] as $key => $value ) {
				update_post_meta( $post_id, $key, $value );
			}
		}
	}
}

/**
 * Migracao de conteudo (roteiro oficial do curso): sites que ativaram o tema
 * antes desta atualizacao ja tinham a grade antiga de 6 modulos e a copy
 * antiga dos responsaveis publicadas no banco - o seed inicial (acima) so
 * roda uma vez e nao mexe em conteudo ja existente. Esta funcao roda por
 * fora desse gate, uma unica vez (controlada por ppf_content_migrated_v3),
 * e substitui os modulos antigos pelos oficiais + atualiza a copy dos
 * responsaveis. Nao mexe em fotos/consentimento de imagem ja configurados.
 */
function ppf_migrate_content_v3() {
	if ( get_option( 'ppf_content_migrated_v3' ) ) {
		return;
	}

	// Modulos: remove a grade antiga por completo e insere a oficial.
	$old_modules = get_posts( array(
		'post_type'      => 'ppf_module',
		'post_status'    => 'any',
		'posts_per_page' => -1,
	) );
	foreach ( $old_modules as $old_module ) {
		wp_delete_post( $old_module->ID, true );
	}
	ppf_insert_modules( ppf_modules_seed_data() );

	// Responsaveis: atualiza titulo/bio/meta preservando a imagem ja enviada.
	$existing_people = get_posts( array(
		'post_type'      => 'ppf_person',
		'post_status'    => 'any',
		'posts_per_page' => -1,
	) );
	foreach ( ppf_people_seed_data() as $person ) {
		foreach ( $existing_people as $existing ) {
			if ( $existing->post_title !== $person['title'] ) {
				continue;
			}
			wp_update_post( array(
				'ID'           => $existing->ID,
				'post_content' => $person['content'],
			) );
			foreach ( $person['meta'] as $key => $value ) {
				update_post_meta( $existing->ID, $key, $value );
			}
			break;
		}
	}

	update_option( 'ppf_content_migrated_v3', 1 );
}
add_action( 'init', 'ppf_migrate_content_v3' );
