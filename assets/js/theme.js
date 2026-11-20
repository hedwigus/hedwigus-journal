/* Hedwigus Journal — progressive enhancement, no dependencies. */
(function () {
  'use strict';

  var root = document.documentElement;
  var saved = null;
  try { saved = localStorage.getItem('hedwigus-theme'); } catch (e) {}

  var toggle = document.getElementById('themeToggle');
  if (toggle) {
    toggle.addEventListener('click', function () {
      var next = root.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
      root.setAttribute('data-theme', next);
      try { localStorage.setItem('hedwigus-theme', next); } catch (e) {}
    });
  }

  var menuBtn = document.getElementById('menuToggle');
  var nav = document.getElementById('primary-nav');
  if (menuBtn && nav) {
    menuBtn.addEventListener('click', function () {
      var open = nav.classList.toggle('open');
      menuBtn.setAttribute('aria-expanded', String(open));
    });
    nav.addEventListener('click', function (e) {
      if (e.target && e.target.tagName === 'A') {
        nav.classList.remove('open');
        menuBtn.setAttribute('aria-expanded', 'false');
      }
    });
  }

  var searchBtn = document.getElementById('searchToggle');
  var searchBox = document.getElementById('headerSearch');
  if (searchBtn && searchBox) {
    searchBtn.addEventListener('click', function () {
      var open = searchBox.classList.toggle('open');
      searchBtn.setAttribute('aria-expanded', String(open));
      if (open) {
        var input = searchBox.querySelector('input[type="search"]');
        if (input) input.focus();
      }
    });
  }

  document.addEventListener('keydown', function (e) {
    if (e.key !== '/') return;
    var tag = (document.activeElement && document.activeElement.tagName) || '';
    if (/^(INPUT|TEXTAREA|SELECT)$/.test(tag)) return;
    var input = document.querySelector('#headerSearch input[type="search"]');
    if (!input) return;
    e.preventDefault();
    if (searchBox && !searchBox.classList.contains('open')) searchBox.classList.add('open');
    input.focus();
  });

  var reveals = document.querySelectorAll('.reveal');
  if ('IntersectionObserver' in window) {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (!entry.isIntersecting) return;
        entry.target.classList.add('in');
        io.unobserve(entry.target);
      });
    }, { threshold: 0.12 });
    reveals.forEach(function (el) { io.observe(el); });
  }

  /* Fallback: background tabs throttle observers; never leave content hidden. */
  setTimeout(function () {
    reveals.forEach(function (el) { el.classList.add('in'); });
  }, 2200);
})();
