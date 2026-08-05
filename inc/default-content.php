<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Popula conteúdo inicial (páginas legais, FAQ, responsáveis e módulos) na
 * ativação do tema, apenas uma vez (controlado pela option ppf_seeded_v1).
 * Tudo aqui é editável depois em wp-admin - isto é só o ponto de partida
 * para o site não ir ao ar vazio ou com lorem ipsum.
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
	return "<p><em>Aviso: este texto é um modelo inicial e precisa ser revisado por um profissional jurídico antes da publicação definitiva. Substitua os campos entre colchetes pelos dados reais da empresa.</em></p>\n\n";
}

function ppf_legal_pages_seed_data() {
	return array(
		'termos' => array(
			'title'   => 'Termos de Uso',
			'content' => ppf_legal_notice() .
				"<h2>1. Aceitação dos termos</h2><p>Ao acessar e utilizar o site Pai de Princesa e o curso oferecido, você concorda com estes Termos de Uso.</p>" .
				"<h2>2. Sobre o curso</h2><p>O Pai de Princesa é um curso digital educacional voltado a pais e responsáveis, com conteúdo sobre cuidados cotidianos com filhas. O conteúdo tem caráter educacional e não substitui orientação médica, dermatológica ou profissional específica.</p>" .
				"<h2>3. Acesso</h2><p>O acesso ao conteúdo é liberado após a confirmação do pagamento na plataforma de checkout (Kiwify ou Greenn) e é de uso pessoal e intransferível.</p>" .
				"<h2>4. Empresa responsável</h2><p>[RAZÃO SOCIAL A CONFIRMAR], inscrita no CNPJ [CNPJ A CONFIRMAR], com sede em [ENDEREÇO A CONFIRMAR].</p>" .
				"<h2>5. Contato</h2><p>Dúvidas podem ser enviadas para [E-MAIL DE SUPORTE A CONFIRMAR].</p>",
		),
		'privacidade' => array(
			'title'   => 'Política de Privacidade',
			'content' => ppf_legal_notice() .
				"<h2>1. Dados coletados</h2><p>Coletamos os dados fornecidos no momento da compra (nome, e-mail) pela plataforma de checkout, além de dados de navegação neste site (cookies, analytics).</p>" .
				"<h2>2. Finalidade</h2><p>Os dados são usados para liberar o acesso ao curso, enviar comunicações relacionadas à compra e melhorar a experiência do site.</p>" .
				"<h2>3. Compartilhamento</h2><p>Não vendemos dados pessoais. Dados de pagamento são processados diretamente pela plataforma de checkout (Kiwify ou Greenn), que possui suas próprias políticas de privacidade.</p>" .
				"<h2>4. Seus direitos (LGPD)</h2><p>Você pode solicitar acesso, correção ou exclusão dos seus dados pessoais entrando em contato pelo e-mail [E-MAIL DE SUPORTE A CONFIRMAR].</p>" .
				"<h2>5. Cookies</h2><p>Consulte nossa <a href=\"/cookies\">Política de Cookies</a> para mais detalhes.</p>",
		),
		'cookies' => array(
			'title'   => 'Política de Cookies',
			'content' => ppf_legal_notice() .
				"<h2>O que são cookies</h2><p>Cookies são pequenos arquivos armazenados no seu navegador para lembrar preferências e coletar dados de navegação.</p>" .
				"<h2>Categorias utilizadas neste site</h2><ul><li><strong>Necessários:</strong> essenciais para o funcionamento do site.</li><li><strong>Analytics:</strong> ajudam a entender como o site é utilizado.</li><li><strong>Marketing:</strong> usados para mensurar a eficácia de campanhas.</li><li><strong>Preferências:</strong> lembram escolhas feitas por você no site.</li></ul>" .
				"<p>Você pode gerenciar suas preferências de cookies a qualquer momento pelo banner exibido na primeira visita.</p>",
		),
		'reembolso' => array(
			'title'   => 'Política de Reembolso',
			'content' => ppf_legal_notice() .
				"<h2>Garantia</h2><p>O prazo de garantia e as condições de reembolso são os informados no momento da compra, no checkout da plataforma utilizada (Kiwify ou Greenn).</p>" .
				"<h2>Como solicitar</h2><p>Solicitações de reembolso devem ser feitas diretamente pela plataforma de pagamento utilizada na compra, ou pelo e-mail [E-MAIL DE SUPORTE A CONFIRMAR].</p>",
		),
		'aviso-legal' => array(
			'title'   => 'Aviso Legal',
			'content' => ppf_legal_notice() .
				"<h2>Natureza do conteúdo</h2><p>O curso Pai de Princesa tem caráter educacional e trata de cuidados cotidianos (cabelo, vestuário, rotina). O conteúdo não substitui orientação médica, dermatológica, psicológica ou jurídica.</p>" .
				"<h2>Resultados</h2><p>Não garantimos resultados específicos, uma vez que estes dependem da aplicação individual do conteúdo por cada aluno.</p>",
		),
	);
}

function ppf_seed_legal_pages() {
	foreach ( ppf_legal_pages_seed_data() as $slug => $page ) {
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

function ppf_faq_seed_data() {
	return array(
		array( 'Preciso ter alguma experiência?', 'Não. O curso começa pelo básico e foi desenvolvido para quem nunca aprendeu esses cuidados.' ),
		array( 'O curso é apenas para pais solteiros?', 'Não. Ele serve para qualquer pai ou responsável que queira participar mais da rotina de uma menina.' ),
		array( 'Consigo assistir pelo celular?', 'Sim. A plataforma de aulas funciona em celular, tablet e computador.' ),
		array( 'Preciso comprar muitos produtos?', 'Não. As aulas priorizam materiais simples. Cada aula informa o que será necessário.' ),
		array( 'Por quanto tempo terei acesso?', 'O prazo é o informado na oferta e no checkout no momento da compra.' ),
		array( 'Como recebo o acesso?', 'Depois da confirmação do pagamento, você recebe as orientações de acesso no e-mail usado na compra.' ),
		array( 'Já comprei, mas não consegui entrar. O que faço?', 'Entre em contato com o suporte da plataforma de pagamento (Kiwify ou Greenn) usando o mesmo e-mail da compra, ou fale com nosso suporte.' ),
		array( 'Posso assistir no meu ritmo?', 'Sim. Você pode continuar de onde parou e acompanhar seu próprio progresso dentro da área de membros.' ),
		array( 'O curso substitui orientação médica ou profissional?', 'Não. O conteúdo é educacional e trata de cuidados cotidianos. Questões médicas, dermatológicas ou específicas devem ser avaliadas por profissionais qualificados.' ),
	);
}

function ppf_insert_faqs( $faqs ) {
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

function ppf_seed_faq() {
	if ( ! empty( get_posts( array( 'post_type' => 'ppf_faq', 'posts_per_page' => 1, 'post_status' => 'any' ) ) ) ) {
		return;
	}

	ppf_insert_faqs( ppf_faq_seed_data() );
}

/**
 * Dados dos dois responsáveis (Prity Santos e Rodrigo Fabbris), conforme o
 * roteiro oficial. Usado tanto no seed inicial quanto na migração de copy
 * (ppf_migrate_content_v4) para sites que já tinham essas páginas ativas.
 */
function ppf_people_seed_data() {
	return array(
		array(
			'title'   => 'Prity Santos',
			'content' => 'Prity Santos é uma das responsáveis pela parte prática do Pai de Princesa. No curso, ela transforma conhecimentos profissionais em orientações simples, pensadas para pais que nunca tiveram contato com esse tipo de cuidado. Prity ensina como escolher produtos, desembaraçar o cabelo com mais tranquilidade, organizar os materiais e compreender os cuidados básicos para diferentes tipos de cabelo infantil.',
			'meta'    => array(
				'role_label'          => 'Responsável pela orientação prática',
				'occupation'          => 'Cabeleireira',
				'city'                => 'Curitiba',
				'subtitle'            => 'A técnica explicada de maneira simples e acolhedora.',
				'featured_quote'      => 'Você não precisa ser profissional. Precisa apenas aprender o jeito certo de começar.',
				'instagram_primary'   => 'https://www.instagram.com/pritysantos/',
				'instagram_secondary' => 'https://www.instagram.com/studiopritysantos/',
				'cta_label'           => 'Conhecer Prity Santos',
				'secondary_cta_label' => 'Conhecer o Studio Prity Santos',
			),
		),
		array(
			'title'   => 'Rodrigo Fabbris',
			'content' => 'Rodrigo Fabbris concilia sua rotina como advogado com os compromissos e os cuidados que fazem parte da vida de um pai presente. Escola, festas, dança, apresentações, eventos e os pequenos desafios cotidianos fazem parte dessa rotina. Como muitos pais, Rodrigo percebeu que amar e querer participar não significa saber automaticamente como fazer tudo. Foi dessa experiência que surgiu uma das bases do Pai de Princesa: criar um caminho para outros pais aprenderem sem constrangimento, sem julgamento e sem dependerem sempre de outra pessoa.',
			'meta'    => array(
				'role_label'          => 'Advogado, pai separado e um dos idealizadores do Pai de Princesa',
				'occupation'          => 'Advogado',
				'city'                => 'Curitiba',
				'subtitle'            => 'A experiência real de quem concilia trabalho, responsabilidades e paternidade.',
				'featured_quote'      => 'Presença também se constrói nos pequenos detalhes.',
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
 * Grade oficial dos módulos do curso, conforme o roteiro. Cada item vira um
 * post do CPT "ppf_module" com os campos definidos em inc/cpt-module.php.
 * "content_items" usa uma linha por bullet (convertido em <li> no template).
 */
function ppf_modules_seed_data() {
	return array(
		array(
			'title' => 'A Conexão Pai e Filha',
			'meta'  => array(
				'short_description' => 'Entenda por que os pequenos cuidados também são uma forma de presença, afeto e conexão.',
				'content_items'     => "A origem e o propósito do Pai de Princesa.\nA importância da presença paterna nos detalhes.\nComo os cuidados cotidianos ajudam a fortalecer o vínculo.\nA experiência real de Rodrigo como pai.\nApresentação de tudo o que será aprendido no curso.",
				'participants'      => 'Prity Santos, Rodrigo Fabbris e participação da filha de Rodrigo.',
				'duration_label'    => '8 a 10 minutos.',
				'is_locked'         => '0',
			),
		),
		array(
			'title' => 'Cuidados Básicos com o Cabelo Infantil',
			'meta'  => array(
				'short_description' => 'Aprenda os cuidados fundamentais para lidar com o cabelo infantil com mais segurança e tranquilidade.',
				'content_items'     => "Diferenças básicas entre cabelos lisos, cacheados e crespos.\nComo escolher shampoo, condicionador e finalizador.\nComo desembaraçar sem causar dor.\nCuidados com o couro cabeludo.\nFormas adequadas de secagem.\nComo utilizar pentes e escovas.\nDemonstrações práticas.",
				'participants'      => 'Prity Santos como professora principal e participação de criança modelo autorizada.',
				'duration_label'    => '15 minutos.',
				'is_locked'         => '1',
			),
		),
		array(
			'title' => 'Penteados do Dia a Dia',
			'meta'  => array(
				'badge_label'        => 'Com a professora convidada Kimberly.',
				'short_description'  => 'Aprenda penteados simples e possíveis para escola, passeios e compromissos do cotidiano.',
				'content_items'      => "Como preparar o cabelo.\nTrança simples.\nCoque prático.\nRabo de cavalo.\nFinalização.\nComo tornar o momento mais tranquilo para a criança.",
				'featured_quote'     => 'O mais importante não é alcançar um resultado perfeito. É o momento que vocês vivem juntos.',
				'participants'       => 'Prity Santos, Kimberly e modelos autorizadas.',
				'duration_label'     => '25 a 30 minutos.',
				'is_locked'          => '1',
				'admin_review_note'  => 'Confirmar se "Kimberly" (professora convidada de penteados e maquiagem) é a mesma pessoa citada como "Kemily" no módulo de autoestima, ou se são duas profissionais diferentes. Validar grafia antes da publicação definitiva.',
			),
		),
		array(
			'title' => 'Autoestima e Beleza Infantil',
			'meta'  => array(
				'short_description' => 'Entenda como o cuidado, a atenção e a presença paterna podem contribuir para a segurança emocional da criança.',
				'content_items'     => "A importância do vínculo afetivo.\nA presença paterna na rotina.\nComo gestos de cuidado podem impactar emocionalmente.\nSegurança emocional.\nAutoconfiança.\nAmor próprio.\nRespeito à personalidade e às preferências da criança.\nFortalecimento da relação entre pai e filha.",
				'participants'      => 'Rodrigo Fabbris e a psicóloga Kemily.',
				'duration_label'    => '12 minutos.',
				'is_locked'         => '1',
				'admin_review_note' => 'Confirmar nome completo, registro profissional e forma correta de apresentação da psicóloga "Kemily" antes da publicação definitiva. Confirmar também se é a mesma pessoa citada como "Kimberly" no módulo de penteados/bônus.',
			),
		),
		array(
			'title' => 'Moda Infantil Prática',
			'meta'  => array(
				'short_description' => 'Aprenda a participar das escolhas de roupas de maneira simples, confortável e adequada para cada ocasião.',
				'content_items'     => "Combinação básica de cores.\nComo escolher roupas confortáveis.\nComo combinar peças.\nUso de acessórios.\nLooks para escola.\nLooks para passeios.\nLooks para festas e eventos.\nComo organizar conjuntos com antecedência.\nParticipação do pai nas escolhas da filha.",
				'participants'      => 'Prity Santos, stylist convidada, Rodrigo Fabbris e participação da filha de Rodrigo.',
				'duration_label'    => '10 minutos.',
				'is_locked'         => '1',
				'admin_review_note' => 'Confirmar nome e informações profissionais da stylist convidada antes da publicação definitiva.',
			),
		),
		array(
			'title' => 'Bônus - Maquiagem de Princesa',
			'meta'  => array(
				'badge_label'        => 'Bônus',
				'short_description'  => 'Orientações para uma maquiagem infantil leve, lúdica e apropriada para ocasiões especiais.',
				'content_items'      => "Cuidados básicos de segurança.\nEscolha de produtos adequados para pele infantil.\nAplicação leve de blush.\nBrilho.\nBatom.\nToque suave de sombra colorida.\nComo respeitar a idade, a vontade e o conforto da criança.",
				'participants'       => 'Professora: Kimberly.',
				'duration_label'     => '10 a 15 minutos.',
				'notice_text'        => 'O conteúdo é destinado a ocasiões especiais, com produtos adequados, supervisão de um responsável e respeito à vontade da criança.',
				'is_locked'          => '1',
				'admin_review_note'  => 'Confirmar se "Kimberly" é a mesma pessoa citada como "Kemily" no módulo de autoestima, ou se são duas profissionais diferentes. Validar grafia antes da publicação definitiva.',
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
 * Correção de acentuação (roteiro oficial do curso): todo o texto original
 * do site foi escrito sem acentos por engano. Sites que ativaram o tema
 * antes desta correção já têm páginas legais, FAQ, módulos e responsáveis
 * publicados no banco com o texto sem acento - o seed inicial (acima) só
 * roda uma vez e não mexe em conteúdo já existente. Esta função roda por
 * fora desse gate, uma única vez (controlada por ppf_content_migrated_v4),
 * e reaplica o texto correto: recria FAQ e módulos do zero (conteúdo
 * inteiramente nosso, sem edição esperada do admin ainda), atualiza as
 * páginas legais e a copy dos responsáveis preservando foto/consentimento
 * de imagem já configurados.
 */
function ppf_migrate_content_v4() {
	if ( get_option( 'ppf_content_migrated_v4' ) ) {
		return;
	}

	// Páginas legais: atualiza o conteúdo das páginas já existentes pelo slug.
	foreach ( ppf_legal_pages_seed_data() as $slug => $page ) {
		$existing = get_page_by_path( $slug );
		if ( $existing ) {
			wp_update_post( array(
				'ID'           => $existing->ID,
				'post_title'   => $page['title'],
				'post_content' => $page['content'],
			) );
		}
	}

	// FAQ: recria do zero (conteúdo próprio do tema, sem entradas do admin esperadas ainda).
	$old_faqs = get_posts( array(
		'post_type'      => 'ppf_faq',
		'post_status'    => 'any',
		'posts_per_page' => -1,
	) );
	foreach ( $old_faqs as $old_faq ) {
		wp_delete_post( $old_faq->ID, true );
	}
	ppf_insert_faqs( ppf_faq_seed_data() );

	// Módulos: mesma lógica.
	$old_modules = get_posts( array(
		'post_type'      => 'ppf_module',
		'post_status'    => 'any',
		'posts_per_page' => -1,
	) );
	foreach ( $old_modules as $old_module ) {
		wp_delete_post( $old_module->ID, true );
	}
	ppf_insert_modules( ppf_modules_seed_data() );

	// Responsáveis: atualiza título/bio/meta preservando a imagem já enviada.
	$existing_people = get_posts( array(
		'post_type'      => 'ppf_person',
		'post_status'    => 'any',
		'posts_per_page' => -1,
	) );
	foreach ( ppf_people_seed_data() as $person ) {
		foreach ( $existing_people as $existing ) {
			// Compara sem acento para casar com o registro antigo (ex: "Prity Santos" já era igual, mas títulos futuros podem mudar).
			if ( remove_accents( $existing->post_title ) !== remove_accents( $person['title'] ) ) {
				continue;
			}
			wp_update_post( array(
				'ID'           => $existing->ID,
				'post_title'   => $person['title'],
				'post_content' => $person['content'],
			) );
			foreach ( $person['meta'] as $key => $value ) {
				update_post_meta( $existing->ID, $key, $value );
			}
			break;
		}
	}

	update_option( 'ppf_content_migrated_v4', 1 );
}
add_action( 'init', 'ppf_migrate_content_v4' );
