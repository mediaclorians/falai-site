/* FALAÍ — interações da landing page */
(function () {
  'use strict';

  /* ---------- Menu mobile ---------- */
  var toggle = document.querySelector('.nav-toggle');
  var nav = document.getElementById('menu');

  toggle.addEventListener('click', function () {
    var open = nav.classList.toggle('is-open');
    toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    toggle.setAttribute('aria-label', open ? 'Fechar menu' : 'Abrir menu');
  });

  nav.addEventListener('click', function (e) {
    if (e.target.matches('.nav__link')) {
      nav.classList.remove('is-open');
      toggle.setAttribute('aria-expanded', 'false');
    }
  });

  /* ---------- Scroll suave (independe da config do sistema) ---------- */
  var HEADER_H = 72;

  function smoothScrollTo(targetY, duration) {
    var startY = window.scrollY;
    var dist = targetY - startY;
    var t0 = null;

    function easeInOutCubic(t) {
      return t < 0.5 ? 4 * t * t * t : 1 - Math.pow(-2 * t + 2, 3) / 2;
    }

    var done = false;
    function step(ts) {
      if (done) return;
      if (t0 === null) t0 = ts;
      var p = Math.min((ts - t0) / duration, 1);
      window.scrollTo(0, startY + dist * easeInOutCubic(p));
      if (p < 1) requestAnimationFrame(step);
      else done = true;
    }
    requestAnimationFrame(step);

    /* garantia: se a aba perder o foco (rAF pausa), chega ao destino mesmo assim */
    setTimeout(function () {
      if (!done) { done = true; window.scrollTo(0, targetY); }
    }, duration + 150);
  }

  document.addEventListener('click', function (e) {
    var link = e.target.closest('a[href^="#"]');
    if (!link) return;
    var id = link.getAttribute('href').slice(1);
    var alvo = id ? document.getElementById(id) : document.body;
    if (!alvo) return;
    e.preventDefault();
    var y = id === 'topo' ? 0 : alvo.getBoundingClientRect().top + window.scrollY - HEADER_H;
    smoothScrollTo(Math.max(0, y), 700);
    history.pushState(null, '', '#' + id);
  });

  /* ---------- Scrollspy (link ativo no menu) ---------- */
  var sections = ['sobre', 'valores', 'time', 'contato']
    .map(function (id) { return document.getElementById(id); });

  var headerLinks = Array.prototype.slice.call(
    document.querySelectorAll('.header .nav__link')
  );

  function setActive(id) {
    headerLinks.forEach(function (link) {
      link.classList.toggle('is-active', link.getAttribute('href') === '#' + id);
    });
  }

  var spy = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) setActive(entry.target.id);
    });
  }, { rootMargin: '-40% 0px -55% 0px' });

  sections.forEach(function (s) { if (s) spy.observe(s); });

  /* ---------- Marquee: garante 4 cópias para loop sem gap ---------- */
  var track = document.querySelector('.marquee__track');
  if (track) {
    var original = track.firstElementChild;
    for (var i = 0; i < 3; i++) {
      track.appendChild(original.cloneNode(true));
    }
  }

  /* ---------- Carrossel de valores ---------- */
  var carousel = document.querySelector('.carousel');
  var cTrack = document.querySelector('.carousel__track');
  var cards = cTrack ? Array.prototype.slice.call(cTrack.children) : [];
  var prevBtn = document.querySelector('.carousel-btn--prev');
  var nextBtn = document.querySelector('.carousel-btn--next');
  var index = 0;

  function perView() {
    var w = window.innerWidth;
    if (w <= 768) return 1;
    if (w <= 1024) return 2;
    return 3;
  }

  function maxIndex() {
    return Math.max(0, cards.length - perView());
  }

  function update() {
    index = Math.min(index, maxIndex());
    var gap = parseFloat(getComputedStyle(cTrack).gap) || 0;
    var step = cards[0].getBoundingClientRect().width + gap;
    cTrack.style.transform = 'translateX(' + (-index * step) + 'px)';
    prevBtn.disabled = index === 0;
    nextBtn.disabled = index >= maxIndex();
  }

  if (cards.length) {
    prevBtn.addEventListener('click', function () { index = Math.max(0, index - 1); update(); });
    nextBtn.addEventListener('click', function () { index = Math.min(maxIndex(), index + 1); update(); });

    carousel.addEventListener('keydown', function (e) {
      if (e.key === 'ArrowLeft') { e.preventDefault(); prevBtn.click(); }
      if (e.key === 'ArrowRight') { e.preventDefault(); nextBtn.click(); }
    });

    /* swipe no mobile */
    var startX = null;
    carousel.addEventListener('touchstart', function (e) {
      startX = e.touches[0].clientX;
    }, { passive: true });
    carousel.addEventListener('touchend', function (e) {
      if (startX === null) return;
      var dx = e.changedTouches[0].clientX - startX;
      if (Math.abs(dx) > 40) (dx < 0 ? nextBtn : prevBtn).click();
      startX = null;
    }, { passive: true });

    var resizeTimer;
    window.addEventListener('resize', function () {
      clearTimeout(resizeTimer);
      resizeTimer = setTimeout(update, 120);
    });

    update();
  }

  /* ---------- Máscara de Telefone (WhatsApp) ---------- */
  var whatsappInput = document.getElementById('whatsapp');
  if (whatsappInput) {
    whatsappInput.addEventListener('input', function (e) {
      var v = e.target.value.replace(/\D/g, '');
      v = v.substring(0, 11); // Limita a 11 dígitos
      v = v.replace(/^(\d{2})(\d)/g, '($1) $2');
      v = v.replace(/(\d{1,5})(\d{4})$/, '$1-$2');
      e.target.value = v;
    });
  }

  /* ---------- Formulário de contato ---------- */
  var form = document.getElementById('form-contato');
  var feedback = form.querySelector('.form__feedback');
  var submitBtn = form.querySelector('.form__submit');
  var inputs = form.querySelectorAll('input, select, textarea');

  function removeError(input) {
    input.classList.remove('is-invalid');
    var errorMsg = input.nextElementSibling;
    if (errorMsg && errorMsg.classList.contains('error-msg')) {
      errorMsg.remove();
    }
  }

  function showError(input, message) {
    removeError(input);
    input.classList.add('is-invalid');
    var errorMsg = document.createElement('span');
    errorMsg.className = 'error-msg';
    errorMsg.textContent = message;
    input.parentNode.insertBefore(errorMsg, input.nextSibling);
  }

  inputs.forEach(function (input) {
    input.addEventListener('input', function () {
      if (input.classList.contains('is-invalid')) {
        removeError(input);
      }
    });
    input.addEventListener('blur', function () {
      if (!input.checkValidity() && input.value !== '') {
        showError(input, input.validationMessage);
      } else if (input.checkValidity()) {
        removeError(input);
      }
    });
  });

  function showFeedback(msg, ok) {
    feedback.textContent = msg;
    feedback.classList.toggle('is-ok', ok);
    feedback.classList.toggle('is-error', !ok);
  }

  form.addEventListener('submit', function (e) {
    e.preventDefault();

    var isValid = true;
    inputs.forEach(function (input) {
      if (!input.checkValidity()) {
        showError(input, input.validationMessage);
        isValid = false;
      }
    });

    if (!isValid) {
      var firstInvalid = form.querySelector('.is-invalid');
      if (firstInvalid) firstInvalid.focus();
      return;
    }

    submitBtn.disabled = true;
    submitBtn.textContent = 'ENVIANDO...';
    showFeedback('', true);

    fetch(form.action, {
      method: 'POST',
      body: new FormData(form),
      headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
      .then(function (res) {
        return res.json().then(function (data) {
          return { status: res.status, data: data };
        });
      })
      .then(function (result) {
        if (result.status === 200 && result.data.ok) {
          showFeedback(result.data.message, true);
          form.reset();
        } else {
          showFeedback(result.data.message || 'Não foi possível enviar. Tente novamente.', false);
        }
      })
      .catch(function () {
        showFeedback('Falha de conexão. Verifique sua internet e tente novamente.', false);
      })
      .finally(function () {
        submitBtn.disabled = false;
        submitBtn.textContent = 'ENVIAR';
      });
  });
})();
