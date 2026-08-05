# Pai de Princesa — Tema WordPress da página de vendas

Tema WordPress customizado para a landing page de vendas do curso **Pai de Princesa**
(`paideprincesa.com.br`). O checkout e a área de membros **não** são construídos aqui —
ficam a cargo da plataforma de pagamento escolhida (Kiwify ou Greenn), que já oferece
checkout e entrega de acesso próprios. Este repositório cuida só da página de vendas.

## O que está incluído

- Tema WordPress nativo, sem dependência de page builders (Elementor etc.) nem de
  plugins de terceiros. Os arquivos do tema ficam na **raiz deste repositório** de
  propósito: assim o cPanel Git Version Control pode clonar direto dentro de
  `wp-content/themes/pai-de-princesa` do site, sem pasta aninhada extra.
- Todas as seções da landing page com o copy definido no briefing (hero, dores,
  transformação, método, "quem está por trás do curso", grade de módulos,
  benefícios, oferta, garantia, FAQ, CTA final).
- Painel próprio em **wp-admin → Pai de Princesa**: links de checkout (Kiwify/Greenn),
  link da área de membros, WhatsApp, campanha/contador, dados da oferta, GTM e a foto
  do hero — tudo editável sem mexer em código.
- Três tipos de conteúdo nativos do WordPress (sem ACF) editáveis em wp-admin:
  - **Responsáveis** (Prity Santos e Rodrigo Fabbris) — nome, bio, foto, frase de
    destaque, links de Instagram, e um checkbox de **autorização de imagem**
    (a foto só aparece no site se essa autorização estiver marcada).
  - **FAQ**.
  - **Módulos do curso**.
- Logo: usa o **Custom Logo** nativo do WordPress (Aparência → Personalizar →
  Identidade do Site). Enquanto o arquivo oficial (SVG) não é enviado, o site usa um
  símbolo provisório em CSS/SVG inline — **substitua assim que a logo vetorial oficial
  estiver aprovada**.
- Páginas legais (`/termos`, `/privacidade`, `/cookies`, `/reembolso`, `/aviso-legal`)
  criadas automaticamente com um texto inicial — **precisam de revisão jurídica**
  antes de ir ao ar em definitivo, aviso que já aparece no topo de cada página.
- Banner de cookies (LGPD) com categorias (necessários/analytics/marketing/preferências)
  — o Google Tag Manager só carrega depois do consentimento.
- SEO básico: meta description, Open Graph, Twitter Card, canonical e JSON-LD
  (Organization, WebSite, FAQPage — e Course/Offer somente se o preço promocional
  estiver preenchido). Sitemap e robots.txt são os nativos do WordPress
  (`/wp-sitemap.xml`).
- Preservação de UTMs (`utm_source`, `utm_medium`, `utm_campaign`, `utm_content`,
  `utm_term`, `fbclid`, `gclid`, `src`, `sck`) nos links de checkout.
- Botão flutuante de WhatsApp, CTA fixo no mobile, acessibilidade (skip link,
  `prefers-reduced-motion`, accordion nativo `<details>` no FAQ).

## O que **não** está aqui (por decisão do projeto)

Área de membros, login, player de vídeo, progresso de aulas, webhooks e painel de
matrículas foram descartados de propósito: o acesso ao curso é 100% gerenciado pela
Kiwify ou Greenn (checkout + entrega de acesso + área de membros deles). Isso evita
ter que manter infraestrutura própria de vídeo/autenticação.

## Estrutura

```
(raiz do repositório = raiz do tema)
  style.css              cabeçalho obrigatório do tema (estilos reais ficam em assets/css)
  functions.php          bootstrap do tema
  header.php / footer.php / page.php / front-page.php / index.php / 404.php
  inc/
    enqueue.php           fontes, CSS, JS
    theme-options.php     painel "Pai de Princesa" em wp-admin
    cpt-person.php        CPT Responsáveis + meta box
    cpt-faq.php           CPT FAQ
    cpt-module.php        CPT Módulos do curso + meta box
    meta-box-helper.php   helper genérico de meta box (sem ACF)
    default-content.php   seed de conteúdo inicial (páginas legais, FAQ, responsáveis, módulos)
    template-tags.php     logo, CTA de checkout, WhatsApp
    seo.php                meta tags + JSON-LD
    analytics.php          GTM condicionado ao consentimento de cookies
  template-parts/         uma seção da landing por arquivo
  assets/css/style.css    design system completo (tokens de cor oficiais da marca)
  assets/js/main.js       menu mobile, FAQ, UTMs, cookies/GTM, eventos de analytics
  assets/js/admin-options.js  uploader de imagem no painel de opções
```

## Rodando localmente

Você precisa de PHP + MySQL + WordPress instalado (ex: via
[LocalWP](https://localwp.com/), Docker ou `wp-env`). Não é necessário Node/build —
o tema usa CSS/JS puro.

1. Suba um WordPress local.
2. Copie (ou link simbólico) todo o conteúdo deste repositório para dentro de uma
   pasta `wp-content/themes/pai-de-princesa/` da sua instalação local.
3. Em **Aparência → Temas**, ative o tema "Pai de Princesa".
4. A ativação cria automaticamente: páginas legais, FAQ, os dois responsáveis
   (Prity e Rodrigo) e os 6 módulos do curso.
5. Verificação de sintaxe PHP (sem instalar WordPress): `php -l` em cada arquivo —
   já validado neste repositório, sem erros.

## Configuração (wp-admin)

### 1. Checkout
`Pai de Princesa → Checkout`
- Escolha a plataforma ativa (Kiwify ou Greenn).
- Cole o link de checkout de cada uma (o link que a própria Kiwify/Greenn gera para
  o produto).
- Cole o link da área de membros/login (também gerado pela Kiwify/Greenn) — usado no
  botão "Área do aluno" do header e no footer.

### 2. Campanha (opcional)
Ative a barra de campanha, defina o texto e a data/hora de encerramento. Passado esse
horário, a barra e o contador somem sozinhos.

### 3. Oferta
Preencha preço, parcelas, prazo de acesso e garantia. **Campos vazios** aparecem no
site como "Consulte a condição disponível no checkout" — não inventamos valores.

### 4. WhatsApp / suporte
Número com DDI+DDD (ex: `5541999999999`), mensagem inicial e e-mail de suporte.

### 5. Analytics
ID do GTM (`GTM-XXXXXXX`). Só carrega depois que o visitante aceita cookies de
analytics/marketing no banner.

### 6. Imagem do hero
Upload direto pelo painel (usa a biblioteca de mídia do WordPress).

### 7. Logo
Aparência → Personalizar → Identidade do Site → Logotipo. Envie o arquivo oficial
assim que estiver aprovado.

### 8. Responsáveis, FAQ e Módulos
Menus próprios no admin (`Responsáveis`, `FAQ`, `Módulos do curso`). Reordene
arrastando na listagem (coluna de ordem). Para os responsáveis, a foto só aparece no
site depois de marcar **"Autorização de imagem confirmada"** no responsável.

## Deploy via Git no cPanel (HostGator)

O domínio `paideprincesa.com.br` já tem WordPress instalado. **Não** versionamos o
WordPress inteiro aqui — só o tema. Os arquivos do tema ficam na raiz deste
repositório de propósito, então o **Repository Path** deve apontar direto para a
pasta `wp-content/themes/pai-de-princesa` dentro do site — assim o `git clone` já
entrega os arquivos no lugar certo, sem passo manual de copiar/mover nada.

1. No GitHub, gere um token (Settings → Developer settings → Fine-grained tokens),
   com acesso somente a este repositório e permissão `Contents: Read-only`.
   ⚠️ Se você já gerou um token e ele apareceu em algum print de tela ou foi
   compartilhado, revogue-o e gere um novo — trate qualquer token exposto como
   comprometido.
2. Confirme o caminho absoluto do domínio no cPanel (**Domínios** → coluna
   "Diretório" do `paideprincesa.com.br`). No seu caso é `/paideprincesa.com.br`
   dentro do home do usuário, ou seja, o caminho completo é algo como
   `/home1/SEU_USUARIO/paideprincesa.com.br`.
3. No cPanel, abra **Git™ Version Control → Create**.
4. Em **Repository Path**, use exatamente:
   `/home1/SEU_USUARIO/paideprincesa.com.br/wp-content/themes/pai-de-princesa`
   (troque `SEU_USUARIO` pelo usuário do cPanel — visível nos caminhos que já
   apareceram na tela, ex: `trendm93`).
5. Em **Clone URL**, use:
   `https://SEU_TOKEN@github.com/luisfwdp/paideprincesa-site.git`
6. Se você já criou um repositório apontando para outra pasta (ex:
   `/home1/SEU_USUARIO/repositories/paideprincesa-site`), abra-o em **Manage** e
   apague-o (isso só remove a cópia local no servidor — não afeta o GitHub) e
   recrie seguindo os passos 3–5 acima com o caminho correto.
7. Em **Aparência → Temas** no wp-admin, ative "Pai de Princesa" (só precisa
   ativar uma vez — isso também cria automaticamente as páginas legais, FAQ,
   responsáveis e módulos).
8. A cada push novo no GitHub, volte no Git Version Control do cPanel, abra o
   repositório e clique em **Pull or Deploy → Update from Remote**.

## Pendências (dependem de informações reais)

- **Logo vetorial oficial** (SVG) — a logo real já está em uso (extraída da
  arte fornecida e recortada em `assets/images/brand/`), mas ainda em PNG.
  Substitua por um SVG limpo quando o design vetorial final for aprovado.
- **Fotos autorizadas** de Rodrigo Fabbris e Prity Santos (com consentimento
  registrado no checkbox do admin).
- **Foto do hero** (pai penteando o cabelo da filha).
- **Preço, parcelas, prazo de acesso e garantia** da oferta.
- **Links de checkout reais** da Kiwify e/ou Greenn.
- **Link da área de membros** (login) da plataforma escolhida.
- **CNPJ, razão social e endereço** para o footer e páginas legais.
- **Revisão jurídica** dos textos de Termos, Privacidade, Cookies, Reembolso e
  Aviso Legal (hoje são um modelo inicial, não um texto definitivo).
- **Depoimentos reais** — a seção foi omitida de propósito até haver depoimentos
  confirmados (não usamos depoimentos fictícios).
