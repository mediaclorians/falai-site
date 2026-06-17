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
  <meta name="description"
    content="Criamos camisetas com ideias, frases e pequenas verdades do cotidiano. Humor, design e uma frase certeira. Falaí: a estampa que fala por você.">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&family=Barlow+Condensed:wght@400;500;600;700;800;900&family=Space+Mono:wght@400;700&display=swap"
    rel="stylesheet">
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
    <section class="hero" aria-label="Falaí — a camiseta que fala por você">
      <div class="container hero__inner">
        <div class="hero__content">
          <h1 class="hero__title">A CAMISETA <br class="hero__br--desk">QUE <br class="hero__br--mob"><span
              class="txt-red">FALA</span> <br class="hero__br--desk"><span class="txt-red">POR VOCÊ.</span></h1>
          <h3 class="hero__subtitle">HUMOR, DESIGN E UMA FRASE CERTEIRA.</h3>
          <p class="hero__text">
            Criamos camisetas com ideias, frases e pequenas verdades<br>
            do cotidiano. Peças que geram identificação imediata, daquelas<br>
            que fazem alguém olhar, sorrir e pensar: &ldquo;é exatamente isso&rdquo;.
          </p>
          <div class="hero__actions">
            <a href="https://shopee.com.br/falaicamiseta" target="_blank" rel="noopener noreferrer"
              class="btn btn--lime">VER COLEÇÃO</a>
            <a href="#sobre" class="btn btn--outline-red">NOSSA HISTÓRIA</a>
          </div>
        </div>
      </div>
    </section>

    <!-- ============ MARQUEE ============ -->
    <div class="marquee" aria-hidden="true">
      <div class="marquee__track">
        <!-- duplicado via JS para loop infinito -->
        <div class="marquee__group">
          <span class="marquee__item">DESIGN COM INTENÇÃO</span>
          <span class="marquee__sep"><svg viewBox="0 0 24 16" width="20" height="14">
              <g fill="currentColor">
                <rect x="0" y="5" width="3" height="6" />
                <rect x="5" y="2" width="3" height="12" />
                <rect x="10" y="0" width="3" height="16" />
                <rect x="15" y="3" width="3" height="10" />
                <rect x="20" y="6" width="3" height="4" />
              </g>
            </svg></span>
          <span class="marquee__item">QUALIDADE REAL</span>
          <span class="marquee__sep"><svg viewBox="0 0 24 16" width="20" height="14">
              <g fill="currentColor">
                <rect x="0" y="5" width="3" height="6" />
                <rect x="5" y="2" width="3" height="12" />
                <rect x="10" y="0" width="3" height="16" />
                <rect x="15" y="3" width="3" height="10" />
                <rect x="20" y="6" width="3" height="4" />
              </g>
            </svg></span>
          <span class="marquee__item">PREÇO JUSTO</span>
          <span class="marquee__sep"><svg viewBox="0 0 24 16" width="20" height="14">
              <g fill="currentColor">
                <rect x="0" y="5" width="3" height="6" />
                <rect x="5" y="2" width="3" height="12" />
                <rect x="10" y="0" width="3" height="16" />
                <rect x="15" y="3" width="3" height="10" />
                <rect x="20" y="6" width="3" height="4" />
              </g>
            </svg></span>
          <span class="marquee__item">ENTREGA COM CUIDADO</span>
          <span class="marquee__sep"><svg viewBox="0 0 24 16" width="20" height="14">
              <g fill="currentColor">
                <rect x="0" y="5" width="3" height="6" />
                <rect x="5" y="2" width="3" height="12" />
                <rect x="10" y="0" width="3" height="16" />
                <rect x="15" y="3" width="3" height="10" />
                <rect x="20" y="6" width="3" height="4" />
              </g>
            </svg></span>
          <span class="marquee__item">HUMOR INTELIGENTE</span>
          <span class="marquee__sep"><svg viewBox="0 0 24 16" width="20" height="14">
              <g fill="currentColor">
                <rect x="0" y="5" width="3" height="6" />
                <rect x="5" y="2" width="3" height="12" />
                <rect x="10" y="0" width="3" height="16" />
                <rect x="15" y="3" width="3" height="10" />
                <rect x="20" y="6" width="3" height="4" />
              </g>
            </svg></span>
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
                <p>Cada estampa é pensada como uma peça própria, com conceito, composição e identidade visual. Nada de
                  frase jogada no peito.</p>
              </li>
              <li class="value-card">
                <span class="value-card__num">03</span>
                <h3>QUALIDADE, CONFORTO E EXPERIÊNCIA</h3>
                <p>Criamos camisetas para pessoas reais, que valorizam conforto, bom acabamento, durabilidade e uma
                  experiência de compra bem resolvida.</p>
              </li>
              <li class="value-card">
                <span class="value-card__num">04</span>
                <h3>PREÇO JUSTO</h3>
                <p>Acreditamos que criatividade, estilo e expressão não precisam ser inacessíveis. Queremos democratizar
                  discursos, ideias e boas camisetas.</p>
              </li>
              <li class="value-card">
                <span class="value-card__num">05</span>
                <h3>CLAREZA NA COMUNICAÇÃO</h3>
                <p>Falamos de forma direta, simples e objetiva — da estampa ao atendimento, do produto ao pós-venda.</p>
              </li>
              <li class="value-card">
                <span class="value-card__num">06</span>
                <h3>COMPROMISSO COM A ENTREGA</h3>
                <p>Cuidamos para que cada peça saia da ideia e chegue ao cliente com qualidade, agilidade e atenção aos
                  detalhes.</p>
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
                <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M6.50001 4.11572C5.18441 4.11572 4.11581 5.18432 4.11581 6.49992C4.11581 7.81552 5.18441 8.88672 6.50001 8.88672C7.81561 8.88672 8.88681 7.81552 8.88681 6.49992C8.88681 5.18432 7.81561 4.11572 6.50001 4.11572Z"
                    fill="#E03C31" />
                  <path
                    d="M10.0984 0H2.9016C1.3026 0 0 1.3026 0 2.9016V10.0984C0 11.7 1.3026 13 2.9016 13H10.0984C11.7 13 13 11.7 13 10.0984V2.9016C13 1.3026 11.7 0 10.0984 0ZM6.5 10.712C4.1782 10.712 2.288 8.8218 2.288 6.5C2.288 4.1782 4.1782 2.2906 6.5 2.2906C8.8218 2.2906 10.712 4.1782 10.712 6.5C10.712 8.8218 8.8218 10.712 6.5 10.712ZM10.8004 3.055C10.309 3.055 9.9086 2.6572 9.9086 2.1658C9.9086 1.6744 10.309 1.274 10.8004 1.274C11.2918 1.274 11.6922 1.6744 11.6922 2.1658C11.6922 2.6572 11.2918 3.055 10.8004 3.055Z"
                    fill="#E03C31" />
                </svg>


                <a href="https://instagram.com/falaicamiseta" target="_blank" rel="noopener">@falaicamiseta</a>
              </li>
              <li>
                <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M4.46875 5.48442H8.53125C8.7557 5.48442 8.9375 5.30262 8.9375 5.07817V4.67192C8.9375 4.44747 8.7557 4.26568 8.53125 4.26568H4.46875C4.2443 4.26568 4.0625 4.44747 4.0625 4.67192V5.07817C4.0625 5.30262 4.2443 5.48442 4.46875 5.48442ZM4.0625 7.51566C4.0625 7.74011 4.2443 7.92191 4.46875 7.92191H8.53125C8.7557 7.92191 8.9375 7.74011 8.9375 7.51566V7.10941C8.9375 6.88496 8.7557 6.70316 8.53125 6.70316H4.46875C4.2443 6.70316 4.0625 6.88496 4.0625 7.10941V7.51566ZM6.5 10.5912C6.08309 10.5912 5.66617 10.4627 5.3102 10.2055L0 6.36953V11.7813C0 12.4544 0.545645 13 1.21875 13H11.7812C12.4544 13 13 12.4544 13 11.7813V6.36953L7.6898 10.2055C7.33383 10.4625 6.91691 10.5912 6.5 10.5912ZM12.5331 4.13746C12.3084 3.96125 12.0953 3.79545 11.7812 3.5583V2.43756C11.7812 1.76446 11.2356 1.21882 10.5625 1.21882H8.59346C8.51627 1.16296 8.44441 1.11066 8.36393 1.05226C7.93711 0.740718 7.08906 -0.00880833 6.5 7.8339e-05C5.91094 -0.00880833 5.06314 0.740718 4.63607 1.05226C4.55559 1.11066 4.48373 1.16296 4.40654 1.21882H2.4375C1.76439 1.21882 1.21875 1.76446 1.21875 2.43756V3.5583C0.904668 3.79519 0.691641 3.96125 0.466934 4.13746C0.321485 4.25144 0.203865 4.39701 0.12297 4.56315C0.0420755 4.7293 2.50302e-05 4.91166 0 5.09645L0 5.36686L2.4375 7.12769V2.43756H10.5625V7.12769L13 5.36686V5.09645C13 4.7222 12.8279 4.36851 12.5331 4.13746Z"
                    fill="#E03C31" />
                </svg>

                <a href="mailto:contato@falaicamiseta.com.br">contato@falaicamiseta.com.br</a>
              </li>
              <li>
                <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M6.5 0C2.9159 0 0 2.91569 0 6.5C0 7.76107 0.361605 8.97686 1.048 10.0327L0.0351237 12.3961C-0.0347005 12.5586 0.00169271 12.7478 0.126953 12.873C0.209896 12.956 0.320768 13 0.433333 13C0.490885 13 0.549072 12.9886 0.604085 12.9649L2.96753 11.9518C4.02314 12.6386 5.23893 13 6.5 13C10.0843 13 13 10.0843 13 6.5C13 2.91569 10.0843 0 6.5 0ZM9.83633 8.82663C9.83633 8.82663 9.29593 9.51979 8.90534 9.68187C7.91257 10.0928 6.511 9.68187 4.91436 8.08564C3.31813 6.489 2.90702 5.08743 3.31813 4.09466C3.48021 3.70365 4.17337 3.16367 4.17337 3.16367C4.36126 3.01725 4.65326 3.03545 4.82168 3.20387L5.60583 3.98802C5.77425 4.15645 5.77425 4.43236 5.60583 4.60078L5.11367 5.09251C5.11367 5.09251 4.91436 5.69089 6.11152 6.88848C7.30869 8.08564 7.90749 7.88633 7.90749 7.88633L8.39922 7.39417C8.56764 7.22575 8.84355 7.22575 9.01198 7.39417L9.79613 8.17832C9.96455 8.34674 9.98275 8.63831 9.83633 8.82663Z"
                    fill="#E03C31" />
                </svg>

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
                <input type="text" id="nome" name="nome" placeholder="Seu nome*" required maxlength="100"
                  autocomplete="name">
                <label for="email" class="sr-only">Seu e-mail</label>
                <input type="email" id="email" name="email" placeholder="Seu e-mail*" required maxlength="150"
                  autocomplete="email">
                <label for="whatsapp" class="sr-only">Seu WhatsApp</label>
                <input type="tel" id="whatsapp" name="whatsapp" placeholder="Seu WhatsApp" required maxlength="20"
                  autocomplete="tel">
                <label for="assunto" class="sr-only">Assunto</label>
                <select id="assunto" name="assunto" required>
                  <option value="" disabled selected>Assunto</option>
                  <option value="duvida">Dúvidas</option>
                  <option value="pedido">Pedido</option>
                  <option value="parceria">Parceria</option>
                  <option value="outro">Outros Assuntos</option>
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
    <div class="container footer__grid">
      <a href="#topo" class="brand brand--big footer__brand" aria-label="Falaí Camiseta — voltar ao topo">
        <img src="assets/img/tshirt-white.png" alt="" class="brand__icon" width="72" height="72">
        <span class="brand__textcol">
          <span class="brand__name">FALAÍ</span>
          <span class="brand__tag brand__tag--red">CAMISETA</span>
        </span>
      </a>
      <p class="footer__tagline">A estampa que fala por você.</p>
      <nav class="nav nav--footer footer__nav" aria-label="Navegação do rodapé">
        <a href="#sobre" class="nav__link">SOBRE</a>
        <a href="#valores" class="nav__link">VALORES</a>
        <a href="#time" class="nav__link">TIME</a>
        <a href="#contato" class="nav__link">CONTATO</a>
      </nav>
      <span class="footer__divider" aria-hidden="true"></span>
      <p class="footer__copy">2026 © FALAÍ<span class="footer__copy-sep"> &nbsp;·&nbsp; </span>TODOS OS DIREITOS
        RESERVADOS</p>
    </div>
  </footer>

  <script src="assets/js/main.js?v=<?php echo filemtime(__DIR__ . '/assets/js/main.js'); ?>"></script>
</body>

</html>