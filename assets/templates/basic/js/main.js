"use strict";
(function ($) {
  // ==========================================
  //      Start Document Ready function
  // ==========================================
  $(document).ready(function () {
    // ============== Header Hide Click On Body Js Start ========
    $(".header-button").on("click", function () {
      $(".body-overlay").toggleClass("show");
    });
    $(".body-overlay").on("click", function () {
      $(".header-button").trigger("click");
      $(this).removeClass("show");
    });
    // =============== Header Hide Click On Body Js End =========
    // // ========================= Header Sticky Js Start ==============
    $(window).on("scroll", function () {
      if ($(window).scrollTop() >= 100) {
        $(".header").addClass("fixed-header");
      } else {
        $(".header").removeClass("fixed-header");
      }
    });
    // // ========================= Header Sticky Js End===================

    // //============================ Scroll To Top Icon Js Start =========
    var btn = $(".scroll-top");

    $(window).scroll(function () {
      if ($(window).scrollTop() > 300) {
        btn.addClass("show");
      } else {
        btn.removeClass("show");
      }
    });

    btn.on("click", function (e) {
      e.preventDefault();
      $("html, body").animate({ scrollTop: 0 }, "300");
    });

    // ========================== Header Hide Scroll Bar Js Start =====================
    $(".navbar-toggler.header-button").on("click", function () {
      $("body").toggleClass("scroll-hide-sm");
    });
    $(".body-overlay").on("click", function () {
      $("body").removeClass("scroll-hide-sm");
    });
    // ========================== Header Hide Scroll Bar Js End =====================

    // analytic js start here
    $(".dropdown-action-btn__icon").on("click", function () {
      $(this)
        .closest(".analytic-wrapper-item")
        .find(".chart-wrapper")
        .toggleClass("chart-wrapper-show");
    });
    // analytic js start here

    // ========================== Add Attribute For Bg Image Js Start =====================
    $(".bg-img").css("background-image", function () {
      var bg = "url(" + $(this).data("background-image") + ")";
      return bg;
    });
    // ========================== Add Attribute For Bg Image Js End =====================



    // ========================== add active class to ul>li top Active current page Js Start =====================
    function dynamicActiveMenuClass(selector) {
      let fileName = window.location.pathname.split("/").reverse()[0];
      selector.find("li").each(function () {
        let anchor = $(this).find("a");
        if ($(anchor).attr("href") == fileName) {
          $(this).addClass("active");
        }
      });
      // if any li has active element add class
      selector.children("li").each(function () {
        if ($(this).find(".active").length) {
          $(this).addClass("active");
        }
      });
      // if no file name return
      if ("" == fileName) {
        selector.find("li").eq(0).addClass("active");
      }
    }
    if ($("ul.sidebar-menu-list").length) {
      dynamicActiveMenuClass($("ul.sidebar-menu-list"));
    }
    // ========================== add active class to ul>li top Active current page Js End =====================

    // ================== Password Show Hide Js Start ==========
    $(".toggle-password").on("click", function () {
      const input = $(this).siblings("input");
      $(this).toggleClass(" fa-eye");

      if (input.attr("type") == "password") {
        input.attr("type", "text");
      } else {
        input.attr("type", "password");
      }
    });
    // =============== Password Show Hide Js End =================
    // =============== Password Show Hide Js End =================

    /*================ tooltip js start here ================*/
    const tooltipTriggerList = document.querySelectorAll(
      '[data-bs-toggle="tooltip"]'
    );
    const tooltipList = [...tooltipTriggerList].map(
      (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
    );
    /*================ tooltip js start here ================*/

    //  how work active class add js start
    $(".how-work__item").on("mouseover", function () {
      $(".how-work__item").removeClass("active");
      $(this).addClass("active");
    });
    //  how work active class add js end



    /*==================== custom dropdown select js ====================*/
    $(".custom--dropdown > .custom--dropdown__selected").on(
      "click",
      function () {
        $(this).parent().toggleClass("open");
      }
    );
    $(".custom--dropdown > .dropdown-list > .dropdown-list__item").on(
      "click",
      function () {
        $(
          ".custom--dropdown > .dropdown-list > .dropdown-list__item"
        ).removeClass("selected");
        $(this)
          .addClass("selected")
          .parent()
          .parent()
          .removeClass("open")
          .children(".custom--dropdown__selected")
          .html($(this).html());
      }
    );
    $(document).on("keyup", function (evt) {
      if ((evt.keyCode || evt.which) === 27) {
        $(".custom--dropdown").removeClass("open");
      }
    });
    $(document).on("click", function (evt) {
      if (
        $(evt.target).closest(".custom--dropdown > .custom--dropdown__selected")
          .length === 0
      ) {
        $(".custom--dropdown").removeClass("open");
      }
    });

    /*=============== custom dropdown select js end =================*/


    // ================== Sidebar Menu Js Start ===============
    // Sidebar Dropdown Menu Start
    $(".has-dropdown > a").on("click", function () {
      $(this).next(".sidebar-submenu").slideUp(200);
      if ($(this).parent().hasClass("active")) {
        $(this).parent().removeClass("active");
      } else {

        $(this).next(".sidebar-submenu").slideDown(200);
        $(this).parent().addClass("active");
      }
    });

    // Sidebar Icon & Overlay js
    $(".dashboard-body__bar-icon").on("click", function () {
      $(".sidebar-menu").addClass("show-sidebar");
      $(".sidebar-overlay").addClass("show");
    });
    $(".sidebar-menu__close, .sidebar-overlay").on("click", function () {
      $(".sidebar-menu").removeClass("show-sidebar");
      $(".sidebar-overlay").removeClass("show");
    });
    // Sidebar Icon & Overlay js
    // ===================== Sidebar Menu Js End =================
    // show filter js
    $(".filter-btn").on("click", function () {
      $(".transaction-top").addClass("show-filter");
      $(".sidebar-overlay").addClass("show");
    });
    $(".filter__close, .sidebar-overlay").on("click", function () {
      $(".transaction-top").removeClass("show-filter");
      $(".sidebar-overlay").removeClass("show");
    });
    // show filter js

    // ==================== Dashboard User Profile Dropdown Start ==================
    $(".user-info__button").on("click", function () {
      $(".user-info-dropdown").toggleClass("show");
    });
    $(".user-info__button").attr("tabindex", -1).focus();

    $(".user-info__button").on("focusout", function () {
      $(".user-info-dropdown").removeClass("show");
    });
    // ==================== Dashboard User Profile Dropdown End ==================

    /*===================== action btn js start here =====================*/
    $(".action-btn__icon").on("click", function () {
      $(".action-dropdown")
        .not($(this).parent().find(".action-dropdown"))
        .removeClass("show");
      $(this).parent().find(".action-dropdown").toggleClass("show");
    });
    /*===================== action btn js end here =====================*/

    // ========================= Odometer Counter Up Js End ==========
    $(".counterup-item").each(function () {
      $(this).isInViewport(function (status) {
        if (status === "entered") {
          for (
            var i = 0;
            i < document.querySelectorAll(".odometer").length;
            i++
          ) {
            var el = document.querySelectorAll(".odometer")[i];
            el.innerHTML = el.getAttribute("data-odometer-final");
          }
        }
      });
    });
    // ========================= Odometer Up Counter Js End =====================

    //required
    $.each($('input, select, textarea'), function (i, element) {
      if (element.hasAttribute('required')) {
        $(element).closest('.form-group').find('label').first().addClass('required');
      }

    });


  });


  if ($('li').hasClass('active')) {
    $('#sidebar__menuWrapper').animate({
      scrollTop: eval($(".active").offset().top - 320)
    }, 500);
  }
  $('.navbar-search-field').on('input', function () {
    var search = $(this).val().toLowerCase();
    var search_result_pane = $('.search-list');
    $(search_result_pane).html('');
    if (search.length == 0) {
      $('.search-list').addClass('d-none');
      return;
    }
    $('.search-list').removeClass('d-none');

    // search
    var match = $('.sidebar__menu-wrapper .nav-link').filter(function (idx, elem) {
      return $(elem).text().trim().toLowerCase().indexOf(search) >= 0 ? elem : null;
    }).sort();

    // search not found
    if (match.length == 0) {
      $(search_result_pane).append('<li class="text-muted pl-5">No search result found.</li>');
      return;
    }
    // search found
    match.each(function (idx, elem) {
      console.log(elem);
      var parent = $(elem).parents('.has-dropdown').find('.menu-title').first().text();


      if (!parent) {
        parent = `Main Menu`
      }

      parent = `<small class="d-block">${parent}</small>`

      var item_url = $(elem).attr('href') || $(elem).data('default-url');
      var item_text = $(elem).text().replace(/(\d+)/g, '').trim();
      $(search_result_pane).append(`
    <li>
      ${parent}
      <a href="${item_url}" class="fw-bold d-block">${item_text}</a>
    </li>
  `);
    });

  });



  var len = 0;
  var clickLink = 0;
  var search = null;
  var process = false;
  $('#searchInput').on('keydown', function (e) {

    var length = $('.search-list li').length;

    if (search != $(this).val() && process) {
      len = 0;
      clickLink = 0;
      $(`.search-list li:eq(${len}) a`).focus();
      $(`#searchInput`).focus();
    }
    //Down
    if (e.keyCode == 40 && length) {
      process = true;
      var contra = false;
      if (len < clickLink && clickLink < length) {
        len += 2;
      }
      $(`.search-list li[class="bg--success"]`).removeClass('bg--success');
      $(`.search-list li a`).removeClass('text--white');
      $(`.search-list li:eq(${len}) a`).focus().addClass('text--white');
      $(`.search-list li:eq(${len})`).addClass('bg--success');
      $(`#searchInput`).focus();
      clickLink = len;
      if (!$(`.search-list li:eq(${clickLink}) a`).length) {
        $(`.search-list li:eq(${len})`).addClass('text--white');
      }
      len += 1;
      if (length == Math.abs(clickLink)) {
        len = 0;
      }
    }
    //Up
    else if (e.keyCode == 38 && length) {
      process = true;
      if (len > clickLink && len != 0) {
        len -= 2;
      }
      $(`.search-list li[class="bg--success"]`).removeClass('bg--success');
      $(`.search-list li a`).removeClass('text--white');
      $(`.search-list li:eq(${len}) a`).focus().addClass('text--white');
      $(`.search-list li:eq(${len})`).addClass('bg--success');
      $(`#searchInput`).focus();
      clickLink = len;
      if (!$(`.search-list li:eq(${clickLink}) a`).length) {
        $(`.search-list li:eq(${len})`).addClass('text--white');
      }
      len -= 1;
      if (length == Math.abs(clickLink)) {
        len = 0;
      }
    }
    //Enter
    else if (e.keyCode == 13) {
      e.preventDefault();
      if ($(`.search-list li:eq(${clickLink}) a`).length && process) {
        $(`.search-list li:eq(${clickLink}) a`)[0].click();
      }
    }
    //Retry
    else if (e.keyCode == 8) {
      len = 0;
      clickLink = 0;
      $(`.search-list li:eq(${len}) a`).focus();
      $(`#searchInput`).focus();
    }
    search = $(this).val();
  });


  $(window).on("load", function () {
    $(".preloader").fadeOut();
  });



  $('.table-responsive').on('click', '[data-bs-toggle="dropdown"]', function (e) {
    const { top, left } = $(this).next(".dropdown-menu")[0].getBoundingClientRect();
    $(this).next(".dropdown-menu").css({
      position: "fixed",
      inset: "unset",
      transform: "unset",
      top: top + "px",
      left: left + "px",
    });
  });
  
  if ($('.table-responsive').length) {
    $(window).on('scroll', function (e) {
      $('.table-responsive .dropdown-menu').removeClass('show');
      $('.table-responsive [data-bs-toggle="dropdown"]').removeClass('show');
    });
  }
})(jQuery);
