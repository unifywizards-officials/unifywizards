(function () {
  const navInner  = document.getElementById('navInner');
  const navLinks  = document.getElementById('navLinks');
  const ngHamburger = document.getElementById('ng-hamburger');
  const items     = document.querySelectorAll('.ng-nav-item[data-menu]');
 
  const DESKTOP_BREAKPOINT = 900;
 
  /* Reset any desktop dropdown positioning so mobile dropdowns stay full-width */
  function resetDropdownPosition(item) {
    const drop = item.querySelector('.ng-dropdown');
    if (!drop) return;
    drop.style.left = '';
    drop.style.right = '';
  }
 
  /* Center ng-dropdown horizontally within ng-nav-inner */
  function centerDrop(item) {
    const drop = item.querySelector('.ng-dropdown');
    if (!drop || window.innerWidth <= DESKTOP_BREAKPOINT) return;
 
    const innerW = navInner.offsetWidth;
    const dropW  = drop.offsetWidth;
 
    // Ideal center
    let left = (innerW - dropW) / 2;
    // Clamp inside ng-nav-inner
    left = Math.max(0, Math.min(innerW - dropW, left));
    drop.style.left  = left + 'px';
    drop.style.right = 'auto';
  }
 
  /* Desktop — hover */
  if (window.innerWidth > DESKTOP_BREAKPOINT) {
    items.forEach(item => {
      const drop = item.querySelector('.ng-dropdown');
 
      item.addEventListener('mouseenter', () => {
        items.forEach(i => i.classList.remove('open'));
        item.classList.add('open');
        centerDrop(item);
      });
 
      item.addEventListener('mouseleave', () => {
        item._t = setTimeout(() => item.classList.remove('open'), 100);
      });
 
      if (drop) {
        drop.addEventListener('mouseenter', () => clearTimeout(item._t));
        drop.addEventListener('mouseleave', () => item.classList.remove('open'));
      }
    });
 
    document.addEventListener('click', e => {
      if (!e.target.closest('.ng-nav-item')) items.forEach(i => i.classList.remove('open'));
    });
  }
 
  /* Mobile — click toggle */
  items.forEach(item => {
    item.querySelector('.ng-nav-link').addEventListener('click', e => {
      if (window.innerWidth <= DESKTOP_BREAKPOINT) {
        e.preventDefault();
        const was = item.classList.contains('open');
        items.forEach(i => {
          i.classList.remove('open');
          resetDropdownPosition(i);
        });
        if (!was) {
          item.classList.add('open');
          item.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
      }
    });
  });
 
  ngHamburger.addEventListener('click', () => {
    ngHamburger.classList.toggle('open');
    navLinks.classList.toggle('open');
            navLinks.style.display = navLinks.classList.contains('open') ? 'flex' : 'none';
        resetDropdownPosition(i);
      });
    }
  });
 
  window.addEventListener('resize', () => {
    if (window.innerWidth > DESKTOP_BREAKPOINT) {
      ngHamburger.classList.remove('open');
      navLinks.classList.remove('open');
      items.forEach(i => i.classList.remove('open'));
      document.querySelectorAll('.ng-nav-item.open[data-menu]').forEach(centerDrop);
    } else {
      items.forEach(i => resetDropdownPosition(i));
    }
  });
})();
 