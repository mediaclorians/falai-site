<?php
// Falaí Camiseta — Landing page institucional
session_start();
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf = $_SESSION['csrf_token'];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Falaí Camiseta — A camiseta que fala por você</title>
  <meta name="description" content="Criamos camisetas com ideias, frases e pequenas verdades do cotidiano. Humor, design e uma frase certeira. Falaí: a estampa que fala por você.">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&family=Barlow+Condensed:wght@400;500;600;700;800;900&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css?v=<?php echo filemtime(__DIR__ . '/assets/css/style.css'); ?>">
</head>
<body>

<!-- ============ HEADER ============ -->
<header class="header" id="topo">
  <div class="container header__inner">
    <a href="#topo" class="brand" aria-label="Falaí Camiseta — início">
      <img src="assets/img/tshirt-white.png" alt="" class="brand__icon" width="38" height="38">
      <span class="brand__name">FALAÍ</span>
      <span class="brand__tag">CAMISETA</span>
    </a>
    <button class="nav-toggle" aria-label="Abrir menu" aria-expanded="false" aria-controls="menu">
      <span></span><span></span><span></span>
    </button>
    <nav class="nav" id="menu" aria-label="Navegação principal">
      <a href="#sobre" class="nav__link">SOBRE</a>
      <a href="#valores" class="nav__link">VALORES</a>
      <a href="#time" class="nav__link">TIME</a>
      <a href="#contato" class="nav__link">CONTATO</a>
    </nav>
  </div>
</header>

<main>
  <!-- ============ HERO ============ -->
  <section class="hero">
    <div class="container hero__inner">
      <div class="hero__content">
        <h1 class="hero__title">
          A CAMISETA<br>
          QUE <span class="txt-red">FALA</span><br>
          <span class="txt-red">POR VOCÊ.</span>
        </h1>
        <h3 class="hero__subtitle">HUMOR, DESIGN E UMA FRASE CERTEIRA.</h3>
        <p class="hero__text">
          Criamos camisetas com ideias, frases e pequenas verdades<br>
          do cotidiano. Peças que geram identificação imediata, daquelas<br>
          que fazem alguém olhar, sorrir e pensar: &ldquo;é exatamente isso&rdquo;.
        </p>
        <div class="hero__actions">
          <a href="https://shopee.com.br/falaicamiseta" target="_blank" rel="noopener noreferrer" class="btn btn--lime">VER COLEÇÃO</a>
          <a href="#sobre" class="btn btn--outline-red">NOSSA HISTÓRIA</a>
        </div>
      </div>
      <div class="hero__media">
        <img src="assets/img/hero.jpg" alt="Mulher sorrindo vestindo camiseta preta Falaí" fetchpriority="high">
      </div>
    </div>
  </section>

  <!-- ============ MARQUEE ============ -->
  <div class="marquee" aria-hidden="true">
    <div class="marquee__track">
      <!-- duplicado via JS para loop infinito -->
      <div class="marquee__group">
        <span class="marquee__item">DESIGN COM INTENÇÃO</span>
        <span class="marquee__sep"><svg viewBox="0 0 24 16" width="20" height="14"><g fill="currentColor"><rect x="0" y="5" width="3" height="6"/><rect x="5" y="2" width="3" height="12"/><rect x="10" y="0" width="3" height="16"/><rect x="15" y="3" width="3" height="10"/><rect x="20" y="6" width="3" height="4"/></g></svg></span>
        <span class="marquee__item">QUALIDADE REAL</span>
        <span class="marquee__sep"><svg viewBox="0 0 24 16" width="20" height="14"><g fill="currentColor"><rect x="0" y="5" width="3" height="6"/><rect x="5" y="2" width="3" height="12"/><rect x="10" y="0" width="3" height="16"/><rect x="15" y="3" width="3" height="10"/><rect x="20" y="6" width="3" height="4"/></g></svg></span>
        <span class="marquee__item">PREÇO JUSTO</span>
        <span class="marquee__sep"><svg viewBox="0 0 24 16" width="20" height="14"><g fill="currentColor"><rect x="0" y="5" width="3" height="6"/><rect x="5" y="2" width="3" height="12"/><rect x="10" y="0" width="3" height="16"/><rect x="15" y="3" width="3" height="10"/><rect x="20" y="6" width="3" height="4"/></g></svg></span>
        <span class="marquee__item">ENTREGA COM CUIDADO</span>
        <span class="marquee__sep"><svg viewBox="0 0 24 16" width="20" height="14"><g fill="currentColor"><rect x="0" y="5" width="3" height="6"/><rect x="5" y="2" width="3" height="12"/><rect x="10" y="0" width="3" height="16"/><rect x="15" y="3" width="3" height="10"/><rect x="20" y="6" width="3" height="4"/></g></svg></span>
        <span class="marquee__item">HUMOR INTELIGENTE</span>
        <span class="marquee__sep"><svg viewBox="0 0 24 16" width="20" height="14"><g fill="currentColor"><rect x="0" y="5" width="3" height="6"/><rect x="5" y="2" width="3" height="12"/><rect x="10" y="0" width="3" height="16"/><rect x="15" y="3" width="3" height="10"/><rect x="20" y="6" width="3" height="4"/></g></svg></span>
      </div>
    </div>
  </div>

  <!-- ============ SOBRE ============ -->
  <section class="sobre section" id="sobre">
    <div class="container">
      <p class="label">SOBRE A FALAÍ</p>
      <div class="sobre__grid">
        <h2 class="sobre__title">
          UMA CAMISETA PODE <span class="txt-red">PROVOCAR,</span> RESUMIR E ATÉ MESMO GRITAR
        </h2>
        <div class="sobre__texts">
          <p>
            A Falaí é para quem gosta de se comunicar sem precisar fazer textão.
            Para quem valoriza uma ironia bem colocada, entende que humor
            também é linguagem e sabe que estilo não precisa gritar para ser
            percebido.
          </p>
          <p>
            A Falaí existe para vestir pessoas com opinião, repertório, senso de
            humor e pouca disposição para explicar o óbvio.
          </p>
        </div>
        <div class="sobre__card">
          <p>
            TRANSFORMAR SENTIMENTOS E PENSAMENTOS NÃO
            VERBALIZADOS EM CAMISETAS
            <span class="txt-lime">QUE FALAM POR VOCÊ.</span>
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- ============ VALORES ============ -->
  <section class="valores section" id="valores">
    <div class="container">
      <p class="label">NOSSOS VALORES</p>
      <div class="valores__head">
        <h2 class="section-title">O QUE <span class="txt-red">GUIA</span> CADA ESTAMPA</h2>
      </div>
      <div class="valores__carousel">
        <div class="carousel" tabindex="0" aria-label="Carrossel de valores">
        <ul class="carousel__track">
          <li class="value-card">
            <span class="value-card__num">01</span>
            <h3>AUTENTICIDADE COM HUMOR INTELIGENTE</h3>
            <p>Transformamos situações reais em frases certeiras, com personalidade, ironia e identificação.</p>
          </li>
          <li class="value-card">
            <span class="value-card__num">02</span>
            <h3>DESIGN COM INTENÇÃO</h3>
            <p>Cada estampa é pensada como uma peça própria, com conceito, composição e identidade visual. Nada de frase jogada no peito.</p>
          </li>
          <li class="value-card">
            <span class="value-card__num">03</span>
            <h3>QUALIDADE, CONFORTO E EXPERIÊNCIA</h3>
            <p>Criamos camisetas para pessoas reais, que valorizam conforto, bom acabamento, durabilidade e uma experiência de compra bem resolvida.</p>
          </li>
          <li class="value-card">
            <span class="value-card__num">04</span>
            <h3>PREÇO JUSTO</h3>
            <p>Acreditamos que criatividade, estilo e expressão não precisam ser inacessíveis. Queremos democratizar discursos, ideias e boas camisetas.</p>
          </li>
          <li class="value-card">
            <span class="value-card__num">05</span>
            <h3>CLAREZA NA COMUNICAÇÃO</h3>
            <p>Falamos de forma direta, simples e objetiva — da estampa ao atendimento, do produto ao pós-venda.</p>
          </li>
          <li class="value-card">
            <span class="value-card__num">06</span>
            <h3>COMPROMISSO COM A ENTREGA</h3>
            <p>Cuidamos para que cada peça saia da ideia e chegue ao cliente com qualidade, agilidade e atenção aos detalhes.</p>
          </li>
        </ul>
        </div>
        <div class="valores__nav">
          <button class="carousel-btn carousel-btn--prev" aria-label="Valor anterior">&#8249;</button>
          <button class="carousel-btn carousel-btn--next" aria-label="Próximo valor">&#8250;</button>
        </div>
      </div>
    </div>
  </section>

  <!-- ============ MISSÃO / VISÃO ============ -->
  <section class="mv">
    <div class="container mv__grid">
    <div class="mv__col mv__col--missao">
      <p class="label label--gray">MISSÃO</p>
      <h3 class="mv__title">O QUE <span class="txt-lime">FAZEMOS</span></h3>
      <p class="mv__text">
        Criamos camisetas criativas, confortáveis e acessíveis que expressem,
        com humor e inteligência, pensamentos, sentimentos e situações do
        cotidiano — ajudando pessoas a se comunicarem de forma leve, autêntica
        e direta.
      </p>
    </div>
    <div class="mv__col mv__col--visao">
      <p class="label label--light">VISÃO</p>
      <h3 class="mv__title">PARA ONDE <span class="txt-lime">VAMOS</span></h3>
      <p class="mv__text">
        Ser uma marca referência em camisetas com personalidade no Brasil,
        reconhecida por unir humor, design, qualidade e identificação real com o
        público — formando uma comunidade de pessoas que usam a moda como
        expressão e posicionamento.
      </p>
    </div>
    </div>
  </section>

  <!-- ============ TIME ============ -->
  <section class="time section" id="time">
    <div class="container time__grid">
      <div class="time__intro">
        <p class="label">NOSSO TIME</p>
        <h2 class="section-title">A <span class="txt-red">OPERAÇÃO</span> POR TRÁS DA ESTAMPA</h2>
        <p class="time__text">
          Por trás da marca, existem duas mulheres ocupando cadeiras
          estratégicas — garantindo que cada camiseta chegue até o cliente com
          qualidade, agilidade e muito a dizer.
        </p>
      </div>
      <div class="time__cards">
        <article class="member">
          <div class="member__photo">
            <img src="assets/img/tati.jpg" alt="Tatiana Nacaguma" loading="lazy">
          </div>
          <h3 class="member__name">TATIANA NACAGUMA</h3>
          <p class="member__bio">
            É responsável por conduzir a estratégia da marca, a
            linguagem, a comunicação, a presença digital, os
            conteúdos, os lançamentos e toda a construção
            criativa que faz o Falaí ter uma voz própria. Tati cuida
            do que a marca fala, de como ela aparece e de como
            se conecta com as pessoas.
          </p>
          <span class="member__role">DIREÇÃO CRIATIVA · DIGITAL</span>
        </article>
        <article class="member">
          <div class="member__photo">
            <img src="assets/img/paula.jpg" alt="Paula Shizue De Martini Mukai" loading="lazy">
          </div>
          <h3 class="member__name">PAULA SHIZUE DE MARTINI MUKAI</h3>
          <p class="member__bio">
            Responsável por fazer a empresa funcionar na
            prática: finanças, produção, estoque, logística, dados
            e processos. Paula monitora os indicadores
            estratégicos que garantem que a criatividade tenha
            estrutura para virar produto, entrega e negócio
            sustentável.
          </p>
          <span class="member__role">OPERAÇÕES · DADOS · FINANCEIRO</span>
        </article>
      </div>
    </div>
  </section>

  <!-- ============ CONTATO ============ -->
  <section class="contato section" id="contato">
    <div class="container">
      <p class="label">FALAÍ</p>
      <h2 class="section-title">TEM UMA IDEIA, PARCERIA OU <span class="txt-red">QUER FALAR?</span></h2>
      <div class="contato__grid">
        <div class="contato__info">
          <p>
            Se você quer tirar dúvidas, falar sobre pedidos, criar uma parceria ou
            simplesmente mandar aquela frase que merecia virar camiseta, estamos
            por aqui.
          </p>
          <ul class="contato__list">
            <li>
              <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/></svg>
              <a href="https://instagram.com/falaicamiseta" target="_blank" rel="noopener">@falaicamiseta</a>
            </li>
            <li>
              <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m2 7 10 6 10-6"/></svg>
              <a href="mailto:contato@falaicamiseta.com.br">contato@falaicamiseta.com.br</a>
            </li>
            <li>
              <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
              <a href="https://wa.me/5519994502953" target="_blank" rel="noopener noreferrer">(19) 99450-2953</a>
            </li>
          </ul>
        </div>
        <form class="contato__form" id="form-contato" action="contact.php" method="post" novalidate>
          <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf, ENT_QUOTES, 'UTF-8'); ?>">
          <!-- honeypot anti-spam: humanos não veem este campo -->
          <p class="hp-field" aria-hidden="true">
            <label for="site">Não preencha este campo</label>
            <input type="text" id="site" name="site" tabindex="-1" autocomplete="off">
          </p>
          <div class="form__row">
            <div class="form__group">
              <label for="nome" class="sr-only">Seu nome</label>
              <input type="text" id="nome" name="nome" placeholder="Seu nome*" required maxlength="100" autocomplete="name">
              <label for="email" class="sr-only">Seu e-mail</label>
              <input type="email" id="email" name="email" placeholder="Seu e-mail*" required maxlength="150" autocomplete="email">
              <label for="whatsapp" class="sr-only">Seu WhatsApp</label>
              <input type="tel" id="whatsapp" name="whatsapp" placeholder="Seu WhatsApp" maxlength="20" autocomplete="tel">
              <label for="assunto" class="sr-only">Assunto</label>
              <select id="assunto" name="assunto" required>
                <option value="" disabled selected>Assunto</option>
                <option value="duvida">Dúvida</option>
                <option value="pedido">Pedido</option>
                <option value="parceria">Parceria</option>
                <option value="frase">Sugestão de frase</option>
                <option value="outro">Outro</option>
              </select>
            </div>
            <div class="form__group form__group--msg">
              <label for="mensagem" class="sr-only">Mensagem</label>
              <textarea id="mensagem" name="mensagem" placeholder="Mensagem*" required maxlength="3000"></textarea>
              <button type="submit" class="btn btn--red form__submit">ENVIAR</button>
            </div>
          </div>
          <p class="form__feedback" role="status" aria-live="polite"></p>
        </form>
      </div>
    </div>
  </section>
</main>

<!-- ============ FOOTER ============ -->
<footer class="footer">
  <div class="container footer__inner">
    <a href="#topo" class="brand brand--big" aria-label="Falaí Camiseta — voltar ao topo">
      <img src="assets/img/tshirt-white.png" alt="" class="brand__icon" width="72" height="72">
      <span class="brand__textcol">
        <span class="brand__name">FALAÍ</span>
        <span class="brand__tag brand__tag--red">CAMISETA</span>
      </span>
    </a>
    <nav class="nav nav--footer" aria-label="Navegação do rodapé">
      <a href="#sobre" class="nav__link">SOBRE</a>
      <a href="#valores" class="nav__link">VALORES</a>
      <a href="#time" class="nav__link">TIME</a>
      <a href="#contato" class="nav__link">CONTATO</a>
    </nav>
  </div>
  <div class="container footer__bottom">
    <p>A estampa que fala por você.</p>
    <p>2026 © FALAÍ &nbsp;·&nbsp; TODOS OS DIREITOS RESERVADOS</p>
  </div>
</footer>

<script src="assets/js/main.js?v=<?php echo filemtime(__DIR__ . '/assets/js/main.js'); ?>"></script>
</body>
</html>
