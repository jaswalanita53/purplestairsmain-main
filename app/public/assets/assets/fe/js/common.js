jQuery(document).ready(function ($) {
  // document start
  /// this is used
  // Navbar
  $("<span class='clickD'></span>").insertAfter(
    ".navbar-nav li.menu-item-has-children > a"
  );
  $(".navbar-nav li .clickD").click(function (e) {
    e.preventDefault();
    var $this = $(this);
    if ($this.next().hasClass("show")) {
      $this.next().removeClass("show");
      $this.removeClass("toggled");
    } else {
      $this.parent().parent().find(".sub-menu").removeClass("show");
      $this.parent().parent().find(".toggled").removeClass("toggled");
      $this.next().toggleClass("show");
      $this.toggleClass("toggled");
    }
  });

  $(window).on("resize", function () {
    if ($(this).width() < 1025) {
      $("html").click(function () {
        $(".navbar-nav li .clickD").removeClass("toggled");
        $(".toggled").removeClass("toggled");
        $(".sub-menu").removeClass("show");
      });
      $(document).click(function () {
        $(".navbar-nav li .clickD").removeClass("toggled");
        $(".toggled").removeClass("toggled");
        $(".sub-menu").removeClass("show");
      });
      $(".navbar-nav").click(function (e) {
        e.stopPropagation();
      });
    }
  });
  // Navbar end

  /* ===== For menu animation === */
  $(".navbar-toggler").click(function () {
    $(".navbar-toggler").toggleClass("open");
    $(".navbar-toggler .stick").toggleClass("open");
    $("body,html").toggleClass("open-nav");
  });

  // Navbar end

  // to make sticky nav bar
  $(window).scroll(function() {
      var scroll = $(window).scrollTop();
      if (scroll > 50) {
          $(".main-head").addClass("fixed");
      }
      else {
        $(".main-head").removeClass("fixed");
      }
  })

  // smooth scroll to any section
  // if($('a.scroll').length){
  //     $("a.scroll").on('click', function(event) {
  //       if (this.hash !== "") {
  //         event.preventDefault();
  //         var target = this.hash, $target = $(target);
  //         $('html, body').animate({
  //           scrollTop: $target.offset().top - 60
  //         }, 800, function(){
  //           window.location.href.substr(0, window.location.href.indexOf('#'));
  //         });
  //       }
  //     });

  //   }

  // back to top
  if ($("#scroll").length) {
    $(window).scroll(function () {
      if ($(this).scrollTop() > 200) {
        $("#scroll").fadeIn(200);
      } else {
        $("#scroll").fadeOut(200);
      }
    });
    $("#scroll").click(function () {
      $("html, body").animate({ scrollTop: 0 }, 500);
      return false;
    });
  }


  // $(".add_btn").click(function(){
  //   $("body").find(".add_note_list").prepend(`<li>
  //   <div class="add_note_list_item">
  //     <div class="add_note_list_item_head">
  //       <ul>
  //         <li>
  //           <span><img src="images/prpl_calender.svg" alt=""></span>Nov 16th 2022
  //         </li>
  //         <li>
  //           <span><img src="images/prpl_clock.svg" alt=""></span>8:30am
  //         </li>
  //       </ul>
  //     </div>
  //     <div class="add_note_list_item_content">
  //       Lorem ipsum dolor sit amet, consectetur adipiscing
  //       elit. Maecenas vulputate justo consectetur viverra
  //       rutrum. Aliquam at sodales odio, non hendrerit quam.
  //     </div>
  //     <div class="add_note_list_item_ftr">
  //       <h6>
  //         <span><img src="images/demo_avatar.svg" alt=""></span>Marry Brown
  //       </h6>
  //     </div>
  //   </div>
  // </li>`)

  //   // if($(".add_note_list li").hasClass("active")){
  //     $("body").find(".add_note_list li.active").removeClass("active")
  //     $(".add_note_list li:first-child").addClass("active")


  // })


  $(".switch_1").change(function () {
    if ($(this).is(":checked")) {
      $(this).parents(".toggle-switch-block").next().removeClass("show-check");
    } else {
      $(this).parents(".toggle-switch-block").next().addClass("show-check");
    }
  });

//   $(".input-daterange .yr-field .form-control").datepicker({
//       format: "yyyy",
//       viewMode: "years",
//       updateViewDate: true,
//       minViewMode: "years",
//       autoclose: true,
//   });

    $(".unmask-hdr-wrp2 .btn.active + div").slideDown()
    $(".unmask-hdr-wrp2 .btn").click(function(){
      if($(this).hasClass("active")){
          $(this).removeClass("active")
          $(this).parents(".unmask-hdr-wrp2").find(".unmask-collap").slideUp()
      }else{
          $("body").find(".unmask-hdr-wrp2 .btn").removeClass("active")
          $("body").find(".unmask-collap").slideUp()

          $(this).parents(".unmask-hdr-wrp2").find(".unmask-collap").slideDown()
          $(this).addClass("active")
      }


  })

  // one page scroll menu link
  // $('a[href*="#"]').on('click', function (e) {
  //     e.preventDefault();
  //     $(document).off("scroll");
  //     $('.navbar-nav > li > a').each(function () {
  //         $(this).parent('li').removeClass('current-menu-item');
  //     });
  //     $(this).parent('li').addClass('current-menu-item');
  //     var target = this.hash, $target = $(target);
  //     $('html, body').stop().animate({
  //         'scrollTop': $target.offset().top
  //     }, 500, 'swing', function () {
  //         window.location.href.substr(0, window.location.href.indexOf('#'));
  //         $(document).on("scroll", onScroll);
  //     });
  // });
  //  $(document).on("scroll", onScroll);
  // function onScroll(event){
  //     var scrollPos = $(document).scrollTop() + 100;
  //     $('.navbar-nav > li > a').each(function () {
  //         var currLink = $(this);
  //         var refElement = $(currLink.attr("href"));
  //         if (refElement.position().top <= scrollPos && refElement.position().top + refElement.height() > scrollPos) {
  //             $('.navbar-nav > li').removeClass("current-menu-item");
  //             currLink.parent('li').addClass("current-menu-item");
  //         }
  //         else{
  //             currLink.parent('li').removeClass("current-menu-item");
  //         }
  //     });
  // }

  $('.test-slider').slick({
    dots: true,
    arrows: false,
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 3,
    autoplay: false,
    autoplaySpeed: 3000,
    centerMode: true,
    adaptiveHeight: true,
    centerPadding: '0px',
    responsive: [
      {
        breakpoint: 767,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ]
  });


  $(".social-slider").slick({
    dots: false,
    arrows: false,
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 3,
    autoplay: false,
    autoplaySpeed: 2000,
    centerMode: false,
    adaptiveHeight: true,
    responsive: [
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1,
          autoplay:true,
        }
      },
      {
        breakpoint: 479,
        settings:{
          slidesToShow: 2,
          slidesToScroll: 1,
          autoplay:true,
        }
      },
    ],
  });









  function aqInit() {
    if ($(".accor-wrap .accordion-collapse").hasClass("show")) {
      $(".accor-wrap .accordion-collapse.show").parent().addClass("shadow");
    } else {
      return false;
    }

    $(".accor-wrap .accordion-button").click(function () {
      if ($(this).parent().parent().hasClass("shadow")) {
        $(this).parent().parent().removeClass("shadow");
      } else {
        $("body").find(".shadow").removeClass("shadow");
        $(this).parent().parent().addClass("shadow");
      }
    });
  }

  aqInit();

  $(".counter").each(function () {
    var $this = $(this),
      countTo = $this.attr("data-count");

    $({ countNum: $this.text() }).animate(
      {
        countNum: countTo,
      },

      {
        duration: 5000,
        easing: "linear",
        step: function () {
          $this.text(Math.floor(this.countNum));
        },
        complete: function () {
          $this.text(this.countNum);
          //alert('finished');
        },
      }
    );
  });

  $("#parentHorizontalTab").easyResponsiveTabs({
    type: "default", //Types: default, vertical, accordion
    width: "auto", //auto or any width like 600px
    fit: true, // 100% fit in a container
    tabidentify: "hor_1", // The tab groups identifier
    activate: function (event) {
      // Callback function if tab is switched
      var $tab = $(this);
      var $info = $("#nested-tabInfo");
      var $name = $("span", $info);
      $name.text($tab.text());
      $info.show();
    },
  });
  // document end
  // custom file upload btn open
  jQuery(".customfile_inputin").on("change", function () {
    var file_name = jQuery("input[type=file]").val().split("\\").pop();
    jQuery(".customfile_label").text(file_name);
  });
  jQuery(".customfile_inputin2").on("change", function () {
    var file_name = jQuery("input[type=file]").val().split("\\").pop();
    jQuery(".customfile_label2").text(file_name);
  });
  // custom file upload btn end

//   var addBtn = $(".large-dropdown.lg-drop .dropdown-menu li");
//   addBtn.on("click", function () {
//     $(this).appendTo("#new-list").addClass("new-li");

//   });
//   var addBtn = $(".large-dropdown.lg-drop2 dropdown-menu li");
//   addBtn.on("click", function () {
//     $(this).appendTo("#new-list2").addClass("new-li");
//   });
//   var addBtn = $(".large-dropdown.lg-drop3 dropdown-menu li");
//   addBtn.on("click", function () {
//     $(this).appendTo("#new-list2").addClass("new-li");
//   });

// $(".new-li").click(function(){
//     $(this).hide()
// })

  function height_calc(){
    if ($('.heightof_section').length) {
      var header_height = document.querySelector(".main-head").clientHeight,
      footer_height = document.querySelector(".footer").clientHeight;
      var total_value = header_height + footer_height;
      $(".heightof_section").css("min-height", 'calc(103vh - ' + total_value + 'px)');
    }
  }
  height_calc();

  $(window).on('load', function(event) {
      height_calc();
  });
  $(window).resize(function(event) {
      height_calc();
  });


  $(".request_btn").click(function(){
    $(this).parent().find(".position_form").toggleClass("active")
  })

    $('#table_id').DataTable();




//   if ($('.js-example-tags').length) {
//     $(".js-example-tags").select2({
//       tags: true
//     });
//   }

//   $(".case_slide_change").change(function(){
//     var item=$(this);
//     if (item.is(':checked')) {

//         setTimeout(function () {
//       window.location.href = item.data("target");
//       }, 100);
//       setTimeout(function () {
//         $('.case_slide_change').prop('checked', false);
//         $('.case_slide_change').prop('disabled', false);
//     }, 200);
//     }

//   });

  $(".form_ipp_passwordd").each(function(){
    var clicker = $(this).find(".pass_chk_toggler"),
    password_chng = $(this).find(".pass_chk");
    clicker.on("click", function(){
      if(password_chng.attr('type')==='password'){
        password_chng.attr('type','text');
        clicker.addClass("active");
      }
      else{
        password_chng.attr('type','password');
        clicker.removeClass("active");
      }
    });
  });




});
