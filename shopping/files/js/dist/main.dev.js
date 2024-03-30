"use strict";

if (CSS.supports("( -moz-user-select:unset )")) {
  var gh = document.getElementsByClassName('DOWN_box');

  for (i = 0; i < gh.length; i++) {
    gh[i].classList.add('active');
  }
} // Get all the dropdown from document


document.querySelectorAll('.dropdown-toggle').forEach(dropDownFunc); // Dropdown Open and Close function

function dropDownFunc(dropDown) {
  if (dropDown.classList.contains('click-dropdown') === true) {
    dropDown.addEventListener('click', function (e) {
      e.preventDefault();

      if (this.nextElementSibling.classList.contains('dropdown-active') === true) {
        // Close the clicked dropdown
        this.parentElement.classList.remove('dropdown-open');
        this.nextElementSibling.classList.remove('dropdown-active');
      } else {
        // Close the opend dropdown
        closeDropdown(); // add the open and active class(Opening the DropDown)

        this.parentElement.classList.add('dropdown-open');
        this.nextElementSibling.classList.add('dropdown-active');
      }
    });
  }
}

; // Listen to the doc click

window.addEventListener('click', function (e) {
  // Close the menu if click happen outside menu
  if (e.target.closest('.dropdown-container') === null) {
    // Close the opend dropdown
    closeDropdown();
  }
}); // Close the openend Dropdowns

function closeDropdown() {
  // remove the open and active class from other opened Dropdown (Closing the opend DropDown)
  document.querySelectorAll('.dropdown-container').forEach(function (container) {
    container.classList.remove('dropdown-open');
  });
  document.querySelectorAll('.dropdown-menu').forEach(function (menu) {
    menu.classList.remove('dropdown-active');
  });
}

function menu() {
  document.querySelector('.sidebar').classList.toggle('active');
  document.querySelector('.box-TgMenu').classList.toggle('active');
  document.body.classList.toggle('active');
}

var lo = function lo() {
  tabcontent = document.getElementsByClassName("tabcontent");

  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  document.querySelector('.overlay').classList.remove('active');
};

var scrollToTopBtn = document.getElementById("scrollToTopBtn");
var rootElement = document.documentElement;

function scrollToTop() {
  // Scroll to top logic
  rootElement.scrollTo({
    top: 0,
    behavior: "smooth"
  });
}

scrollToTopBtn.addEventListener("click", scrollToTop);
var btn = document.querySelector(".btn-toggle");
var prefersDarkScheme = window.matchMedia("(prefers-color-scheme: dark)");
var currentTheme = localStorage.getItem("theme");

if (currentTheme == "dark") {
  document.body.classList.toggle("dark-theme");
} else if (currentTheme == "light") {
  document.body.classList.toggle("light-theme");
}

btn.addEventListener("click", function () {
  //   btn.classList.toggle('active');
  if (prefersDarkScheme.matches) {
    document.body.classList.toggle("light-theme");
    var theme = document.body.classList.contains("light-theme") ? "light" : "dark";
  } else {
    document.body.classList.toggle("dark-theme");
    var theme = document.body.classList.contains("dark-theme") ? "dark" : "light";
  }

  localStorage.setItem("theme", theme);
});
var fBox = document.querySelector('.contentS');

var changeDirection = function changeDirection() {
  fBox.classList.toggle('active');
};

$('.owl-carousel').owlCarousel({
  autoplay: true,
  autoplayTimeout: 3000,
  autoplayHoverPause: true,
  stagePadding: 50,
  loop: true,
  margin: 30,
  nav: true,
  responsive: {
    0: {
      items: 1
    },
    480: {
      items: 1
    },
    600: {
      items: 2
    },
    1000: {
      items: 4
    }
  }
});

var startTime = function startTime() {
  var today = new Date();
  var h = today.getHours();
  var m = today.getMinutes();
  m = checkTime(m);
  document.getElementById('clock').innerHTML = h + ":" + m;
  setTimeout(startTime, 1000);
};

var checkTime = function checkTime(i) {
  if (i < 10) {
    i = "0" + i;
  }

  ; // add zero in front of numbers < 10

  return i;
};

startTime();
var clip = new ClipboardJS('.btnCopy');
clip.on('success', function (e) {
  $('.copied').show();
  $('.copied').fadeOut(1000);
});

(function ($) {
  $.fn.bekeyProgressbar = function (options) {
    options = $.extend({
      animate: true,
      animateText: true
    }, options);
    var $this = $(this);
    var $progressBar = $this;
    var $progressCount = $progressBar.find('.ProgressBar-percentage--count');
    var $circle = $progressBar.find('.ProgressBar-circle');
    var percentageProgress = $progressBar.attr('data-progress');
    var percentageRemaining = 100 - percentageProgress;
    var percentageText = $progressCount.parent().attr('data-progress'); //Calcule la circonférence du cercle

    var radius = $circle.attr('r');
    var diameter = radius * 2;
    var circumference = Math.round(Math.PI * diameter); //Calcule le pourcentage d'avancement

    var percentage = circumference * percentageRemaining / 100;
    $circle.css({
      'stroke-dasharray': circumference,
      'stroke-dashoffset': percentage
    }); //Animation de la barre de progression

    if (options.animate === true) {
      $circle.css({
        'stroke-dashoffset': circumference
      }).animate({
        'stroke-dashoffset': percentage
      }, 3000);
    } //Animation du texte (pourcentage)


    if (options.animateText == true) {
      $({
        Counter: 0
      }).animate({
        Counter: percentageText
      }, {
        duration: 3000,
        step: function step() {
          $progressCount.text(Math.ceil(this.Counter) + '%');
        }
      });
    } else {
      $progressCount.text(percentageText + '%');
    }
  };
})(jQuery);

$(document).ready(function () {
  $('.ProgressBar--animateAll').bekeyProgressbar();
});
var acc = document.getElementsByClassName("SEASONDOWNLOAD");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function () {
    /* Toggle between adding and removing the "active" class,
    to highlight the button that controls the panel */
    this.classList.toggle("active");
    /* Toggle between hiding and showing the active panel */

    var panel = this.nextElementSibling;

    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}

$(".like-btn").click(function () {
  $(this).toggleClass('clicked');
  event.preventDefault();
});
$(".panel-group_btn button").click(function () {
  var btnStorage = $(this).attr("id");

  if ($(this).hasClass("clicked")) {
    this.innerHTML = 'پسندیده شد';
    localStorage.setItem(btnStorage, 'true');
  } else {
    this.innerHTML = 'پسندیدن';
    localStorage.removeItem(btnStorage, 'true');
  }
});
$(".panel-group_btn button").each(function () {
  var mainlocalStorage = $(this).attr("id");

  if (localStorage.getItem(mainlocalStorage) == 'true') {
    $(this).addClass("clicked");
    this.innerHTML = 'پسندیده شد';
  } else {
    $(this).removeClass("clicked");
    this.innerHTML = 'پسندیدن';
  }
});

var basicScrollTop = function basicScrollTop() {
  // The button
  var btnTop = document.querySelector('#goTop'); // Reveal the button

  var btnReveal = function btnReveal() {
    var position = document.querySelector('#position');
    position.innerHTML = window.scrollY + 'px';
    window.scrollY >= 2000 ? btnTop.classList.add('is-visible') : btnTop.classList.remove('is-visible');
  }; // Smooth scroll top
  // Thanks to => http://stackoverflow.com/a/22610562


  var TopscrollTo = function TopscrollTo() {
    if (window.scrollY != 0) {
      setTimeout(function () {
        window.scrollTo(0, window.scrollY - 30);
        TopscrollTo();
      }, 5);
    }
  }; // Listeners


  window.addEventListener('scroll', btnReveal);
};