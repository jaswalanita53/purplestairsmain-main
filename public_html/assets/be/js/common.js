jQuery(document).ready(function ($) {
  // document start

  // Navbar
  $("<span class='clickD'></span>").insertAfter(
    ".sidebar-nav li.menu-item-has-children > a"
  );
  $(".sidebar-nav li .clickD").click(function (e) {
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
    if ($(this).width() > 10) {
      $("html").click(function () {
        $(".sidebar-nav li .clickD").removeClass("toggled");
        $(".toggled").removeClass("toggled");
        $(".sub-menu").removeClass("show");
      });
      $(document).click(function () {
        $(".sidebar-nav li .clickD").removeClass("toggled");
        $(".toggled").removeClass("toggled");
        $(".sub-menu").removeClass("show");
      });
      $(".sidebar-nav").click(function (e) {
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

  // fixed nav bar
  $(window).scroll(function () {
    var scroll = $(window).scrollTop();
    if (scroll > 100) {
      $(".c-head").addClass("fixed");
    } else {
      $(".c-head").removeClass("fixed");
    }
  });

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

  $(".review_wrap_slider").slick({
    dots: false,
    arrows: true,
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: false,
    autoplaySpeed: 3000,
    centerMode: false,
    adaptiveHeight: true,
    centerPadding: "0px",
    responsive: [
      {
        breakpoint: 767,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        },
      },
    ],
  });

  $(".nav-link").click(function () {
    $(".review_wrap_slider").slick("refresh");
    $(".review_wrap_slider").resize();
  });

  $(function () {
    var dateFormat = "mm/dd/yy";
    
    if ($("#from").length) {
      var from = $("#from")
        .datepicker({
          defaultDate: "+1w",
          changeMonth: true,
          numberOfMonths: 3,
        })
        .on("change", function () {
          to.datepicker("option", "minDate", getDate(this));
        });
    }

    if ($("#to").length) {
      var to = $("#to")
        .datepicker({
          defaultDate: "+1w",
          changeMonth: true,
          numberOfMonths: 3,
        })
        .on("change", function () {
          from.datepicker("option", "maxDate", getDate(this));
        });
    }

    function getDate(element) {
      var date;
      try {
        date = $.datepicker.parseDate(dateFormat, element.value);
      } catch (error) {
        date = null;
      }

      return date;
    }
  });

  // data table
  if($("#myTable").length) {
    $("#myTable").DataTable({
      searching: false,
      paging: false,
      info: false,
    });
  }

  // overlay for body on menu toggle

  $(".menu_toggle").on("click", function () {
    $("body,html").toggleClass("sidebar_show");
  });

  $(function () {
    var handle = $("#custom-handle");
    let popup = $(".custom-value");
    if($("#slider-range-min").length) {
      $("#slider-range-min").slider({
        range: "min",
        value: 13,
        min: 1,
        max: 100,
        create: function () {
          handle.text($(this).slider("value"));
          popup.text($(this).slider("value"));
        },
        slide: function (event, ui) {
          $("#amount").val("$" + ui.value);
          handle.text(ui.value);
          popup.text(ui.value);
        },
      });
    }
  });

  if($("#table_id").length) { $("#table_id").DataTable(); }

  $(".plan_vbtn").on("click", function () {
    $(".plan_details_inner").removeClass("active");
    $(this).parents(".plan_details_inner").addClass("active");
  });

  $(".list_grid_wrapper li button").click(function () {
    $(".listgrid_cnt").removeClass("active");
    $("#" + $(this).data("target")).addClass("active");
    $(".list_grid_wrapper li").removeClass("active");
    $(this).parent("li").addClass("active");
  });
  $(document).on("click", ".clickd_tgl_searches", function (e) {
    console.log($(this).closest(".candidate_grid_ppl_icn"));
    if ($(this).closest(".candidate_grid_ppl_icn").length) {
      $(this).closest(".candidate_grid_ppl_icn").find(".clickd_tgl_searches_open").toggleClass("active");
      $(".candidate_grid_ppl_icn .clickd_tgl_searches").not($(this)).next(".clickd_tgl_searches_open").removeClass("active");
    } else if ($(this).closest(".candidate_grid_ppl_icn-top").length) {
      $(this).closest(".candidate_grid_ppl_icn-top").find(".clickd_tgl_searches_open").toggleClass("active");
      $(".candidate_grid_ppl_icn-top .clickd_tgl_searches").not($(this)).next(".clickd_tgl_searches_open").removeClass("active");
    }
    
    e.stopPropagation();
    return false;
  });

  // task - 86a2vx5er
  $(document).on("click", ".inc_clickd_tgl_searches", function (e) {
      $(this).closest(".inc_saved_searches").find(".clickd_tgl_searches_open").toggleClass("active");
      $(".inc_saved_searches .inc_clickd_tgl_searches").not($(this)).next(".clickd_tgl_searches_open").removeClass("active");
      e.stopPropagation();
      return false;
  });

  $("body").on("click", function (e) {
    if (
      !$(e.target).closest("a").hasClass("clickd_tgl_searches") &&
      !$(e.target).closest("a").hasClass("inc_clickd_tgl_searches") &&
      !$(e.target).is(".clickd_tgl_searches_open") &&
      !$(e.target).is(".clickd_tgl_searches") &&
      !$(e.target).is(".inc_clickd_tgl_searches") &&
      $(".clickd_tgl_searches_open").has(e.target).length === 0
    ) {
      $(".clickd_tgl_searches_open").removeClass("active");
      //e.stopPropagation();
    }
  });

  $(".not_searches_slider_ptt").slick({
    dots: false,
    arrows: true,
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: false,
    autoplaySpeed: 3000,
    centerMode: false,
    adaptiveHeight: true,
    centerPadding: "0px",
    responsive: [
      {
        breakpoint: 767,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        },
      },
    ],
  });

  $(".modal").on("shown.bs.modal", function (e) {
    // $(".not_searches_slider_ptt").slick("setPosition");
  });

  function height_calc() {
    if ($(".left-panel-main").length) {
      var header_height = document.querySelector(".top-logo1").clientHeight,
        footer_height = document.querySelector(".float_menu").clientHeight;
      var total_value = header_height + footer_height;
      // $(".left-menu").css("height", "calc(98vh - " + total_value + "px)");
    }
  }
  height_calc();

  $(window).on("load", function (event) {
    height_calc();
  });
  $(window).resize(function (event) {
    height_calc();
  });

  // document end
});

$("body").delegate(".saved_searches_accountant_outr", "click", function (e) {
  var url = $(this).attr("data-url");
  window.location.href = url;
});
$("body").delegate(".archived-count", "click", function (e) {
  var url = $(this).attr("data-url");
  window.location.href = url;
});

$("body").delegate(
  ".saved_searches_accountant_outr .dropdown-toggle",
  "click",
  function (e) {
    e.stopPropagation();
  }
);

$("body").delegate(
  ".saved_searches_accountant_outr .dropdown-item",
  "click",
  function (e) {
    var id = $(this).attr("data-target");
    $(id).modal("show");
    e.stopPropagation();
  }
);

$("body").delegate(".close", "click", function (e) {
  $(".modal").modal("hide");
});

$("body").delegate(".archive-btn", "click", function (e) {
  //   setTimeout(function() {
  //     location.reload();
  //   }, 5000);
  location.reload();
});

$("body").delegate(".edit_search", "click", function (e) { // ,.dropdown-item            
  $("#edit-search").modal("show");
  init_filters(); // task - 86a1uf3ar
});

// task - 86a21hge8
$("#add-search, .edit-search").on("shown.bs.modal", function (e) { // #edit-search,.edit-search,
  $('.js-select2:not(.max-range,.min-range, .max-range-distance, .min-range-distance)').each(function() {
    console.log('select22');
    if( $(this).val()[0]=='null'){
        $(this).val('').trigger('change', true);
    } else {
        $(this).val($(this).val()).trigger('change', true);
    }
  })

  init_filters(); // task - 86a1uf3ar
});

$(document).ready(function () {
  $("body").delegate(".req_mask_btn_list", "click", function (e) {
    $(".modal").modal("hide");

    $(this).parents(".listview_candidate_details_w").find("#send-request-modal").find('form')[0].reset();
      
    $(this)
      .parents(".listview_candidate_details_w")
      .find("#send-request-modal")
      .css("display", "inline-table")
      .modal("show");
    $(this).parents(".gr_fl3").css("height", "44px");
    var current = $(this);
    $(".modal-backdrop.show").css("opacity", 0).css("display", "none");
    setTimeout(function () {
      current
        .parents(".listview_candidate_details_w")
        .find("#send-request-modal")
        .css("display", "inline-table");
      $(".modal-open").css("padding-left", "0px");
      $(".modal-open").css("padding-right", "0px");
    }, 200);
  });

  $("body").delegate(".active .req_mask_btn_grid", "click", function (e) {
    $(".modal").modal("hide");
   
    $(this).parents(".candiate_list_view_parent_col ").find("#send-request-modal").find('form')[0].reset();
      
    $(this)
      .parents(".candiate_list_view_parent_col ")
      .find("#send-request-modal")
      .css("display", "inline-table")
      .modal("show");
    $(this).parents(".gr_fl3").css("height", "44px");
    var current = $(this);
    $(".modal-backdrop.show").css("opacity", 0).css("display", "none");
    setTimeout(function () {
      current
        .parents(".candiate_list_view_parent_col ")
        .find("#send-request-modal")
        .css("display", "inline-table");
      $(".modal-open").css("padding-left", "0px");
      $(".modal-open").css("padding-right", "0px");
    }, 200);
  });
});

$(".inline-table-modal").on("hidden.bs.modal", function () {
  $(this).css("display", "none");
});


    $("body").delegate(".position_submit_btn", "click", function(e) {
        var title = $(this).parents('form').find('.form-group:first').find('input[type="text"]').val();
        var message = $(this).parents('form').find('.form-group').find('textarea').val();
        if (title == "" || message == "") {
          if(title==""){
            $(this).parents('form').find('.form-group:first').find('.text-danger').remove();
            $(this).parents('form').find('.form-group:first').append(
              '<div class="text-danger" style=""> This field is required.</div>'
            );
          }
          if(message==""){
            $(this).parents('form').find('.form-group:last').find('.text-danger').remove();
            $(this).parents('form').find('.form-group').find('textarea').after(
              '<div class="text-danger" style=""> This field is required.</div>'
            );
          }
            return false;
        }
    })

    $("body").delegate(".modal.show form .form-group:first input[type='text']", "keyup", function(e) {
      $('.modal.show form').find('.form-group:first').find('.text-danger').remove();
    })
    $("body").delegate(".modal.show form .form-group:last textarea", "keyup", function(e) {
      $('.modal.show form').find('.form-group:last').find('.text-danger').remove();
    })

    $(document).ready(function() {
 

      $("body").delegate(".candidate_grid_ppl_wppt,.listview_candidate_details,req_mask_btn", "click", function (e) {
       

        var url = $(this).attr("data-url");
        var uId = $(this).attr("data-id");
        var modal=$('.exampleModalToggle'+uId)
        // task - 86a2vxac0
        if (!$(e.target).is('.clickd_tgl_searches svg, .clickd_tgl_searches circle,.eyeBall,.eyeBall img,.clickd_tgl_searches_open,.clickd_tgl_searches_open label,.clickd_tgl_searches_open h5,.clickd_tgl_searches_open h5 small,.clickd_tgl_searches_open input,.clickd_tgl_searches_open span,.candidate_grid_ppl_icn a,.candidate_grid_ppl_icn svg,.candidate_grid_ppl_icn path,.req_mask_btn,.req_mask_btn i,.req_mask_btn img,.req_mask_btn .req_mask_btn_rtt,.modal.show div,.modal.show button,.modal.show form,.modal.show input,.modal.show label,.modal.show- textarea,span[aria-hidden="true"],.popup-prof-cut,.position_form textarea')) {
      
          if ($('.loadSpan').length > 0) {
            if ($('.loadSpan').text() == 'Loading...Loading...') {
                if ($('.listview_candidate_details:last').attr('data-id') == uId) {
                    $('.exampleModalToggle' + uId).find('.right-arrow').html(
                        '<div class="spinner-border" role="status" style="width: 1rem;height: 1rem;"><span class="sr-only">Loading...</span></div>'
                    ).attr('disabled', true);
                }
            } 
        }else {
          $('.exampleModalToggle' + uId).find('.right-arrow').hide();
      }
          setTimeout(function() {
            modal.modal('show')
          },100 );         
        }
      });

    });

    $('#exampleModalToggle2-,#add-search,#edit-search').on('show.bs.modal', function () {
      $('#overlay').hide();
      $('body').addClass('no-scroll');
    });
    
    $('#exampleModalToggle2-,#add-search,#edit-search').on('hide.bs.modal', function () {
      $('body').removeClass('no-scroll');
    });
    

    $(document).ready(function () {
      $('.inline-table-modal').on('show.bs.modal', function () {
        setTimeout(function() {
          $('#overlay').hide();
  },100 );

        // $('body').addClass('position-fixed');
      });
   
        $("body").delegate(".condidate-profile-modal,.edit-search", "show.bs.modal", function(e) {
          // 86a2yxuh3
          $('.listview_candidate_details').removeClass('activeCard');
          $('.candidate_grid_ppl_wppt').removeClass('activeCard');
          activeCardId= $(this).attr('data-id');
          openModal=$(this);
          $('.listview_candidate_details[data-id="' + activeCardId + '"]').addClass('activeCard');
          $('.candidate_grid_ppl_wppt[data-id="' + activeCardId + '"]').addClass('activeCard');
          var activeElement = $('.listview_candidate_details[data-id="' + activeCardId + '"]');
          if(activeElement.length>0){
          var elementOffset = activeElement.offset().top;
          var elementHeight = activeElement.outerHeight();
          var viewportHeight = $(window).height();
          var scrollTop = $(window).scrollTop();

          var elementBottom = elementOffset + elementHeight;
          if (elementBottom > (scrollTop + viewportHeight)) {
              var targetScrollTop = window.innerHeight + Math.round(window.scrollY) + 200;
              $('html, body').animate({
                  scrollTop: targetScrollTop
              }, 100);
          }
        }

          setTimeout(function() {
            $('#overlay').hide(); 
            // $('body').addClass('position-fixed');
    },400 );
        
      });
    
      $("body").delegate(".condidate-profile-modal,.edit-search", "hidden.bs.modal", function(e) {
        //  $('body').removeClass('position-fixed');
        // $('.popup-prof-cut').click(); task - 86a2qw5xt
      });
    });
    
    
    function hideHeader(userId) {
      // Find the iframe by its class
      const iframe = $('.cpi.cpi' + userId);
    
      // Check if the iframe exists
      if (iframe.length > 0) {
       iframe.each(function () {
          const iframeContentWindow = this.contentWindow;
    
          if (iframeContentWindow) {
            const iframeDocument = iframeContentWindow.document;
    
            // Example: hide header and footer elements
            const headerElements = $(iframeDocument).find('.main-head');
            const footerElements = $(iframeDocument).find('.footer');
    
            headerElements.each(function () {
              $(this).remove();
            });
    
            footerElements.each(function () {
              $(this).remove();
            });
          }
        });
      }
    }
    
    // task - 86a3ajg52
    $('.condidate-profile-modal').on('shown.bs.modal', function(event) {
      var id = $(this).attr('data-id');
      var ttl_rows = $('.candidate_box_parent').find(".candidate-card").length;
      var current_index = $('.candidate_box_parent').find('.candidate-card[data-id="' + id + '"]').index();
      
      if (ttl_rows === (current_index + 1)) {

        if ($('.load_more').length >0) {
          $(this).find('.right-arrow').html('<div class="spinner-border" role="status" style="width: 1rem;height: 1rem;"><span class="sr-only">Loading...</span></div>').attr('disabled',true)
        }else{
          $(this).find('.right-arrow').hide();
        }
      } else {
        $(this).find('.right-arrow').show();
      }
    });

    document.addEventListener("livewire:load", () => {
      $("body").delegate(".right-arrow", "click", function(e) {
        var id = $(this).parents('.candidate-card').attr('data-id');
        var listItem = $('.candidate_box_parent').find('.candidate-card[data-id="' + id + '"]');
        listItem = $('.candidate_box_parent').find(".candidate-card").index(listItem);
        var uId = $('.candidate_box_parent').find(".candidate-card:eq(" + (listItem + 1) + ")").attr('data-id');
        var modal = $('.exampleModalToggle' + uId);
        // $('body').addClass('position-fixed');
        $('.custom_modal').hide(); // task - 86a22j70y
        if(modal.length>0){
          
          $('.condidate-profile-modal').modal('hide')
          // $('body').addClass('position-fixed');
          // $('#overlay').show();

          // task - 86a3ajg52
          var current_index = (listItem + 1);
          var next_uId = $('.candidate_box_parent').find(".candidate-card:eq(" + (current_index+1) + ")").attr('data-id');
          if (next_uId === undefined) {
            if ($('.load_more').length > 0) {
              modal.find('.right-arrow').html('<div class="spinner-border" role="status" style="width: 1rem;height: 1rem;"><span class="sr-only">Loading...</span></div>').attr('disabled',true)
            }else{
              modal.find('.right-arrow').hide();
            }
          } else {
            modal.find('.right-arrow').show();
          }
        }
       
      setTimeout(function() {
        // $('body').addClass('position-fixed');
        modal.modal('show');
        }, 50);
      });
    
      $("body").delegate(".left-arrow", "click", function(e) {
        var id = $(this).parents('.candidate-card').attr('data-id');
        var listItem = $('.candidate_box_parent').find('.candidate-card[data-id="' + id + '"]');
        listItem = $('.candidate_box_parent').find(".candidate-card").index(listItem);
        console.log((listItem - 1));

        if((listItem-1) < 0) { return false; } // task - 86a114ff1

        var uId = $('.candidate_box_parent').find(".candidate-card:eq(" + (listItem - 1) + ")").attr('data-id');
        var modal = $('.exampleModalToggle' + uId);
        // $('body').addClass('position-fixed');
        $('.custom_modal').hide(); // task - 86a22j70y
        if(modal.length>0){
          
          $('.condidate-profile-modal').modal('hide')
          // $('body').addClass('position-fixed');
          // $('#overlay').show();

          // task - 86a3ajg52
          var current_index = (listItem - 1);
          var next_uId = $('.candidate_box_parent').find(".candidate-card:eq(" + (current_index-1) + ")").attr('data-id');
          if (next_uId === undefined) {
            modal.find('.right-arrow').hide();
          } else {
            modal.find('.right-arrow').show();
          }
        }
         
        setTimeout(function() {
          // $('body').addClass('position-fixed');
          modal.modal('show');
        }, 50);
      });
    });

  

    $("body").delegate(".modal-note textarea", "keypress", function(e) {
      $(this).parents('.form-group').find('.text-danger').remove();
  })
  $("body").delegate(".modal-note textarea", "keyup", function(e) {
       $(this).val($(this).val().trimStart())
  })
  $("body").delegate(".position_form textarea", "keyup", function(e) {
     $(this).val($(this).val().trimStart())
  })
  $("body").delegate(".position_form input", "keyup", function(e) {
      $(this).val($(this).val().trimStart())
  })
  $("body").delegate(".form-control", "keyup", function(e) {
      $(this).val($(this).val().trimStart())
  })
  $("body").delegate(".form-control", "focusout", function(e) {
    $(this).val($.trim($(this).val()))
})
  $("body").delegate(".modal-backdrop", "focusout", function(e) {

    $('.modal').modal('hide');
    $('.modal.show').find('.popup-prof-cut').trigger('click');
})
    
$("body").delegate("input[type='password']", "keypress", function(e) {
  if (e.which === 32) { // Check if the key pressed is the spacebar
      var inputVal = $(this).val();
      if (inputVal.endsWith(" ")) {
          e.preventDefault(); // Prevent the spacebar from being entered
      }
  }
});

$("select").on('select2:unselecting', function (e) {
  $("select").on('select2:opening', function (ev) {
    ev.preventDefault();
    $("select").off('select2:opening');
  });
});

// 86a2vc33m
// 86a2vc33m
$(document).on('click', function(event) {
  if($('.condidate-profile-modal.show').length > 0){
      if ($(event.target).closest('.condidate-profile-modal.show').length === 0 &&
          $(event.target).closest('.list, .grid').length === 0) {
          $('.condidate-profile-modal.show').find('.popup-prof-cut').trigger('click');
      }
  }
});
$(document).ready(function() {
  $('.req_mask_btn').on('click', function () {
    $('.listview_candidate_details').removeClass('activeCard');
    $('.candidate_grid_ppl_wppt').removeClass('activeCard');
    $(this).parents('.listview_candidate_details').addClass('activeCard');
    $(this).parents('.candidate_grid_ppl_wppt').addClass('activeCard');
  });
});

window.addEventListener('initAfterload', event => {
  $('.condidate-profile-modal').find('.right-arrow').html('<i class="fa fa-chevron-right" aria-hidden="true"></i>').attr('disabled',true)
});
