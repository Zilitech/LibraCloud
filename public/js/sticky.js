
"use strict";
(() => {
  window.addEventListener('scroll', stickyFn);
  var navbar = document.getElementById("sidebar");
  var sticky = navbar.offsetTop;
  function stickyFn() {
    if (window.scrollY >= 75) {
      navbar.classList.add("sticky-pin")
    } else {
      navbar.classList.remove("sticky-pin");
    }
  }
  window.addEventListener('scroll', stickyFn);
  window.addEventListener('DOMContentLoaded', stickyFn);
})();


document.addEventListener('DOMContentLoaded', function () {
    const stickyHeader = document.getElementById('sticky-header');
    if (stickyHeader) {
        // your sticky logic here
    }

    const menu = document.getElementById('default-menu');
    if (menu) {
        menu.addEventListener('click', function() {
            // menu click logic
        });
    }
});
