jQuery(document).ready(function ($) {

  
  var milliseconds = "";
  var filterSelected = 0;

  function initFilters() {
    $(".industries_filter_btn").select2({
      // width: (('Industries'.length * 12)+10)+ 'px',
      containerCssClass: "industries-container",
      dropdownAutoWidth: true,
      closeOnSelect: false,
      placeholder: "Industries",
      allowHtml: true,
      allowClear: true,
      tags: false,
    });

    $(".hard_skills_filter_btn").select2({
      // width: (('Hard Skills'.length * 12)+4)+ 'px',
      containerCssClass: "h-skill-container",
      dropdownAutoWidth: true,
      closeOnSelect: false,
      placeholder: "Hard Skills",
      allowHtml: true,
      allowClear: true,
      tags: false,
    });
    $(".soft_skills_filter_btn").select2({
      // width: (('Soft Skills'.length * 12))+ 'px',
      containerCssClass: "s-skill-container",
      selectionCssClass: "s-skills",
      dropdownAutoWidth: true,
      closeOnSelect: false,
      placeholder: "Soft Skills",
      allowHtml: true,
      allowClear: true,
      tags: false,
    });
    $(".soft_skills_filter_btn").on('select2:open', function(event) {
      $('.select2-container--open').addClass('s-skill-container-open');
    });

    $(".interest_filter_btn").select2({
      // width: (('Fields of Interest'.length * 9)+12)+ 'px',
      containerCssClass: "interest-container",
      dropdownAutoWidth: true,
      closeOnSelect: false,
      placeholder: "Fields of Interest",
      allowHtml: true,
      allowClear: true,
      tags: false,
    });

    $(".languages_filter_btn").select2({
      // width: (('Languages'.length * 15)+2)+ 'px',
      containerCssClass: "languages-container",
      dropdownAutoWidth: true,
      closeOnSelect: false,
      placeholder: "Languages ",
      allowHtml: true,
      allowClear: true,
      tags: false,
    });

    $(".distance_filter_btn").select2({
      dropdownAutoWidth: true,
      closeOnSelect: false,
      placeholder: "Distance",
      allowHtml: true,
      allowClear: true,
      tags: false,
    });

    $(".seeking_position_filter_btn").select2({
      containerCssClass: "s-p-container",
      
      dropdownCssClass: "d-none",
      dropdownAutoWidth: true,
      closeOnSelect: true,
      selectOnClose: true,
      placeholder: "Position/Title Seeking",
      allowHtml: true,
      allowClear: true,
      tags: true,
      tokenSeparators: [',']
    });

    $(".schedule_filter_btn").select2({
      // width: (('Schedule'.length * 14)+10)+ 'px',
      containerCssClass: "schedule-container",
      dropdownAutoWidth: true,
      closeOnSelect: false,
      placeholder: "Schedule",
      allowHtml: true,
      allowClear: true,
      tags: false,
    });
    $(".zipcode_filter_btn").select2({
      // width: (('Schedule'.length * 14)+10)+ 'px',
      containerCssClass: "zipcode-container",
      dropdownAutoWidth: true,
      closeOnSelect: false,
      placeholder: "Zipcode",
      allowHtml: true,
      allowClear: true,
      tags: false,
    });

    $(".salary_range_filter_btn").select2({
      // width: (('Salary Range'.length * 12)+4)+ 'px',
      containerCssClass: "salary-range-container",
      dropdownAutoWidth: true,
      closeOnSelect: false,
      placeholder: "Salary Range",
      allowHtml: true,
      allowClear: true,
      tags: false,
    });
    $(".work_environment_filter_btn").select2({
      // width: (('Work Setting'.length * 11)+7)+ 'px',
      containerCssClass: "work-environment-container",
      dropdownAutoWidth: true,
      closeOnSelect: false,
      placeholder: "Work Setting",
      allowHtml: true,
      allowClear: true,
      tags: false,
    });

    $(".college_name_filter_btn").select2({
      dropdownAutoWidth: true,
      closeOnSelect: false,
      placeholder: "College Name",
      allowHtml: true,
      allowClear: true,
      tags: false,
    });

    $(".ideal_benefits_filter_btn").select2({
      dropdownAutoWidth: true,
      closeOnSelect: false,
      placeholder: "Ideal Benefits",
      allowHtml: true,
      allowClear: true,
      tags: false,
    });

    $(".compensation_filter_btn").select2({
      // width: (('Compensation type'.length * 11)+7)+ 'px',
      containerCssClass: "compensation-container",
      dropdownAutoWidth: true,
      closeOnSelect: false,
      placeholder: "Compensation Type",
      allowHtml: true,
      allowClear: true,
      tags: false,
    });
  }

  initFilters();

  // task - 86a1uf3ar
  $(document).on('select2:select', ".industries_filter_btn, .hard_skills_filter_btn, .soft_skills_filter_btn, .interest_filter_btn, .languages_filter_btn, .distance_filter_btn, .seeking_position_filter_btn, .schedule_filter_btn,.zipcode_filter_btn, .salary_range_filter_btn, .work_environment_filter_btn, .college_name_filter_btn, .ideal_benefits_filter_btn, .compensation_filter_btn", function () {
    // console.log('Select', $(this).val());
    var _OPTS = $(this).val();
    if (_OPTS.length > 1) {
      $(this).select2('open');

      let CLS_OPT = $('.select2-container.select2-container--open .select2-dropdown .select2-results').find('.close-open-select2');
      
      if (CLS_OPT.length == 0) {
        $('.select2-container.select2-container--open .select2-dropdown .select2-results').prepend('<span class="close-open-select2 pull-right"><i class="fa fa-times"></i></span>');
      }
    }
  });

  $(document).on('click', '.close-open-select2', function () {
    $(document).find('.select2.select2-container.select2-container--open').parent().find('select').select2('close');
  });

  $(document).on('click', '.select2-selection.select2-selection--multiple', function () {
    $(this).parent().parent().closest('select').select2('open');
  });

  $(document).on('select2:unselect', ".industries_filter_btn, .hard_skills_filter_btn, .soft_skills_filter_btn, .interest_filter_btn, .languages_filter_btn, .distance_filter_btn, .seeking_position_filter_btn, .schedule_filter_btn,.zipcode_filter_btn, .salary_range_filter_btn, .work_environment_filter_btn, .college_name_filter_btn, .ideal_benefits_filter_btn, .compensation_filter_btn", function () {
      $(this).select2('open');
  });
  // task - 86a1uf3ar

  $("body").delegate(".js-select2:not(.max-range,.min-range, .max-range-distance, .min-range-distance)", "change", function (e, isTrigger = false) {
    // if(trigger !== true) {
      var selectedOptions = $(this).find(":selected");
      var industiesIds = [];
      var industiesNames = [];
      var html = "";
      $.each(selectedOptions, function (index, option) {
        industiesNames.push(option.text);
      });
     
      $('#is_submit').val('0');
      if(!isTrigger) {
        $('.clear-filter-btn').addClass('hide-clr-btn');
        $('#is_run').val(0); // task - 86a0qfnhg
      }

      // task - 86a0w9r38
      var valueLength = $(".js-select2:not(.max-range,.min-range, .max-range-distance, .min-range-distance)").filter(function () {
          if($.trim($(this).val()).length > 0) { return $(this); }
      });

      if(isTrigger == false && valueLength.length == 0 && $('#filterDistance').val() == '0' && $('#filterYearOfExperience').val() == '0') {
        $('#filters-form').trigger('submit', true);
      }
      // task - 86a0w9r38 end

      hideClearFilterBtn(isTrigger);

      var first = $.trim(industiesNames[0]);
      firstItem = first;

      // task - 86a26mx9v
      if($(this).hasClass('current_position_filter_btn2')) {
        let _val_ = $(this).val();
        __tags = _val_.split(',');

        let _updated = []; diff2 = [];
        $.each(old_tags, function(index, val) {
          if($.inArray(val, __tags) === -1) { _updated = $.grep(old_tags, function(value) { return value != val; }); }
          if($.inArray(val, __tags) === -1) { diff2.push(val); }
        });
        if(_updated.length) { old_tags = _updated; }
        
        diff = [];
        $.each(__tags, function(index, val) {
          if($.inArray(val, old_tags) === -1) { old_tags.push(val); diff.push(val); }
        });
      }
      
       if((!isTrigger && !$(this).hasClass('current_position_filter_btn2')) || (!isTrigger && $(this).hasClass('current_position_filter_btn2') && (diff.length || diff2.length))) { // task - 86a26mx9v
        $(".hidden-btn-filter").css("display", "none");
        $('.save-search-btn').css({'display': 'flex', 'animation-iteration-count': 'infinite', 'float': 'right'}); // task - 862k2tf2f
        $('.save-search-btn.shake').css('animation-iteration-count', 'infinite'); // task - 862k2tf2f
        $(".save-search-btn").addClass("shake");
        $('.save-search-btn').addClass("enable-save-btn");
      }

      setTimeout(function () {
        // $(".save-search-btn").removeClass("shake"); task - 862k2tf2f
      }, 4000);
      if (industiesNames.length <= 1) {
        currentTime = new Date();
        milliseconds = currentTime.getTime(); // Get the milliseconds from the date
        html = '<span class="select2-selection__choice">' + first + "</span";
      } else {
        html =
          '<span class="select2-selection__choice">' +
          first +
          "+" +
          (industiesNames.length - 1) +
          "</span";
      }
      $(this)
        .parents(".filter-col-box")
        .find(".select2-selection__rendered")
        .find(".select2-search__field")
        .css("height", "35px");

      if (firstItem !== "") {
        $(this)
          .parents(".filter-col-box")
          .find(".select2-selection__rendered")
          .addClass("selecedItems");
        $(this)
          .parents(".filter-col-box")
          .find(".select2-selection__rendered")
          .find(".select2-selection__choice")
          .remove();
        $(this)
          .parents(".filter-col-box")
          .find(".select2-selection__rendered")
          .find(".select2-search__field")
          .css("height", "0px");
        $(this)
          .parents(".filter-col-box")
          .find(".select2-selection__rendered")
          .find(".select2-search")
          .prepend(html);
      } else {
        $(this)
          .parents(".filter-col-box")
          .find(".select2-selection__rendered")
          .removeClass("selecedItems");
        $(this)
          .parents(".filter-col-box")
          .find(".select2-selection__rendered")
          .find(".select2-selection__choice")
          .remove();
      }
    // }
  });

  $("body").delegate(".clear-filter-btn", "click", function (e) {
    $('#running_search').val(0);

    $('#is_submit').val('0');
    $(".js-select2:not(.max-range,.min-range, .max-range-distance, .min-range-distance)").val("");
    $('.salary_range_filter_btn').select2('destroy');
    $(".industries_filter_btn").select2('destroy');
    $(".hard_skills_filter_btn").select2('destroy');
    $(".soft_skills_filter_btn").select2('destroy');
    $(".interest_filter_btn").select2('destroy');
    $(".languages_filter_btn").select2('destroy');
    $(".distance_filter_btn").select2('destroy');
    $(".seeking_position_filter_btn").select2('destroy');
    $(".schedule_filter_btn").select2('destroy');
    $(".zipcode_filter_btn").select2('destroy');
    $(".work_environment_filter_btn").select2('destroy');
    $(".college_name_filter_btn").select2('destroy');
    $(".ideal_benefits_filter_btn").select2('destroy');
    $(".compensation_filter_btn").select2('destroy');
    initFilters();

    $(".max-range").val(40).trigger("input", true);
    $(".min-range").val(0).trigger("input", true);
    $(".max-range-distance").val(100).trigger("input", true);
    $(".min-range-distance").val(0).trigger("input", true);

    $(".hidden-btn-filter").css("display", "none");
    $(".sec_head_mn-all").show();
    $('.sec_head_mn-filter').hide();

    var html2 = '<script src="'+b_url_+'/assets/be/taginput/bootstrap-tagsinput.min.js">'+
        '<\/script><link rel="stylesheet" href="'+b_url_+'/assets/be/taginput/bootstrap-tagsinput.css" />' + 
    '<div class="col- filter-col-box form-group position-input ">' + 
        '<input class="current_position_filter_btn2 form-control js-select2" data-role="tagsinput" value="" placeholder="Search by Current Title"/>' + 
    '</div>';

    $('.tag-input-field').html(html2);
    $(document).find('.current_position_filter_btn2').val("").trigger("change", true);

    // $('.save-search-btn').click(); // task - 86a0m0kfy
    $('#filters-form').trigger('submit', true);
    $('#is_filtered').val('0');
  });

  $("body").delegate(".cut-range", "click", function (e) {
    $(".max-range").val(40).trigger("input");
    $(".min-range").val(0).trigger("input");

    // task - 86a0w9r38
    var valueLength = $(".js-select2:not(.max-range,.min-range, .max-range-distance, .min-range-distance)").filter(function () {
        // console.log($(this)[0].tagName, $(this).val().length, $.trim($(this).val()) == "");
        if($.trim($(this).val()).length > 0) { return $(this); }
    });

    if(isTrigger == false && valueLength.length == 0 && $('#filterDistance').val() == '0' && $('#filterYearOfExperience').val() == '0') {
      $('#filters-form').trigger('submit', true);
    }
    // task - 86a0w9r38 end

    hideClearFilterBtn(false);
    
  });
  $("body").delegate(".cut-range-dist", "click", function (e) {
    $(".max-range-distance").val(100).trigger("input");
    $(".min-range-distance").val(0).trigger("input");

    // task - 86a0w9r38
    var valueLength = $(".js-select2:not(.max-range,.min-range, .max-range-distance, .min-range-distance)").filter(function () {
        // console.log($(this)[0].tagName, $(this).val().length, $.trim($(this).val()) == "");
        if($.trim($(this).val()).length > 0) { return $(this); }
    });

    if(isTrigger == false && valueLength.length == 0 && $('#filterDistance').val() == '0' && $('#filterYearOfExperience').val() == '0') {
      $('#filters-form').trigger('submit', true);
    }
    // task - 86a0w9r38 end

    hideClearFilterBtn(false);
    
  });
  $("body").delegate(".select2-selection__clear", "click", function (e) {
   
    $(this)
      .parents(".filter-col-box")
      .find(".select2-selection__rendered")
      .removeClass("selecedItems");
    $(this)
      .parents(".filter-col-box")
      .find(".select2-selection__rendered")
      .find(".select2-selection__choice")
      .remove();
  });

  /*$(".current_position_filter_btn").on("select2:unselect", function (e) {
    $(".current_position_filter_btn").html("");
  });*/

  $(".seeking_position_filter_btn").on("select2:unselect", function (e) {
    $(".seeking_position_filter_btn").html("");
  });

  $("body").delegate(".dist_cut", "click", function (e) {
    $(".cut-range-dist").trigger("click");
  });
  $("body").delegate(".exp_cut", "click", function (e) {
    $(".cut-range").trigger("click");
  });

  // setInterval(function() {
  //     date = new Date();
  //     var mSeconds = date.getTime();
  //     if(milliseconds>0){
  //     if(mSeconds-milliseconds>4000){
  //         $('.save-btn').trigger('click');
  //         milliseconds=0;
  //     }
  // }
  //     console.log('fdasf');
  // }, 500);
});

$("body").delegate(".max-range,.min-range", "input", function (e, isTrigger = false) {
  // hideClearFilterBtn();
  var min = $(this).parents(".filter-col-box").find(".min-range").val();
  var max = $(this).parents(".filter-col-box").find(".max-range").val();
  if (!isTrigger) { // task - 86a0qfnhg
    $('#is_run').val(0);
  }
  $('#is_submit').val('0');
  $(this)
    .parents(".filter-col-box")
    .find(".dd_year_of_exp")
    .removeClass("selecedItems");
  $('#filterYearOfExperience').val('0');
  $(this)
    .parents(".filter-col-box")
    .find(".dd_year_of_exp")
    .addClass("selecedItems");
  $('#filterYearOfExperience').val('1');
  if (max - min == 1) {
    $(this)
      .parents(".filter-col-box")
      .find(this)
      .parents(".filter-col-box")
      .find(".dd_year_of_exp")
      .html(
        '<span class="range-text">' +
          min +
          "-" +
          max +
          ' Year</span> <span class="select2-selection__clear_range exp_cut  float-right"><i class="fa fa-times"></span>'
      );
  } else if (max - min > 1 && max - min < 40) {
    $(this)
      .parents(".filter-col-box")
      .find(".dd_year_of_exp")
      .html(
        '<span class="range-text">' +
          min +
          "-" +
          max +
          ' Years</span> <span class="select2-selection__clear_range exp_cut float-right"><i class="fa fa-times"></span>'
      );
  } else {
    $(this)
      .parents(".filter-col-box")
      .find(".dd_year_of_exp")
      .text("Yrs of exp")
      .removeClass("selecedItems");

    $('#filterYearOfExperience').val('0');
  }

  // console.log('.max-range,.min-range', isTrigger);
  if (!isTrigger) {
    $(".hidden-btn-filter").css("display", "none");
    // console.log('save - 2');
    $('.save-search-btn').css({'display': 'flex', 'animation-iteration-count': 'infinite', 'float': 'right'}); // task - 862k2tf2f
    $('.save-search-btn.shake').css('animation-iteration-count', 'infinite');
    $(".save-search-btn").addClass("shake");
  }

  hideClearFilterBtn(isTrigger); // task - 86a0kdnun
  // task - 86a0w9r38
  var valueLength = $(".js-select2:not(.max-range,.min-range, .max-range-distance, .min-range-distance)").filter(function () {
      // console.log($(this)[0].tagName, $(this).val().length, $.trim($(this).val()) == "");
      if($.trim($(this).val()).length > 0) { return $(this); }
  });

  console.log(isTrigger, valueLength.length, $('#filterDistance').val(), $('#filterYearOfExperience').val());
  if(isTrigger == false && valueLength.length == 0 && $('#filterDistance').val() == '0' && $('#filterYearOfExperience').val() == '0') {
    $('#filters-form').trigger('submit', true);
  }
  // task - 86a0w9r38 end

  // $('.clear-filter-btn').removeClass('hide-clr-btn');
$('.save-search-btn').addClass("enable-save-btn");
  currentTime = new Date();
  milliseconds = currentTime.getTime(); // Get the milliseconds from the date
  setTimeout(function () {
    // $(".save-search-btn").removeClass("shake");
  }, 4000);
});
$("select").on("select2:opening", function() {
  $('.dropdown-menu').removeClass('show');
});
$("body").delegate(
  ".max-range-distance,.min-range-distance",
  "input",
  function (e, isTrigger = false) {
    // hideClearFilterBtn();
    if (!isTrigger) { // task - 86a0qfnhg
      $('#is_run').val(0);
    }
    $('#is_submit').val('0');
    var min = $(this)
      .parents(".filter-col-box")
      .find(".min-range-distance")
      .val();
    var max = $(this)
      .parents(".filter-col-box")
      .find(".max-range-distance")
      .val();
    $(this)
      .parents(".filter-col-box")
      .find(".dd_year_of_exp-dist")
      .removeClass("selecedItems");
    $('#filterDistance').val('0');
    $(this)
      .parents(".filter-col-box")
      .find(".dd_year_of_exp-dist")
      .addClass("selecedItems");
    $('#filterDistance').val('1');

    if (max - min == 1) {
      $(this)
        .parents(".filter-col-box")
        .find(".dd_year_of_exp-dist")
        .html(
          '<span class="range-text">' +
            min +
            "-" +
            max +
            ' Mile</span> <span class="select2-selection__clear_range dist_cut float-right"><i class="fa fa-times"></span>'
        );
    } else if (max - min > 1 && max - min < 100) {
      $(this)
        .parents(".filter-col-box")
        .find(".dd_year_of_exp-dist")
        .html(
          '<span class="range-text">' +
            min +
            "-" +
            max +
            ' Miles</span> <span class="select2-selection__clear_range dist_cut float-right"><i class="fa fa-times"></span>'
        );
    } else {
      $(this)
        .parents(".filter-col-box")
        .find(".dd_year_of_exp-dist")
        .text("Distance")
        .removeClass("selecedItems");
      $('#filterDistance').val('0');
    }

    // console.log('.max-range-distance,.min-range-distance', isTrigger);
    if (!isTrigger) {
      $(".hidden-btn-filter").css("display", "none");
      // console.log('save - 3');
      $('.save-search-btn').css({'display': 'flex', 'animation-iteration-count': 'infinite', 'float': 'right'}); // task - 862k2tf2f
      $('.save-search-btn.shake').css('animation-iteration-count', 'infinite');
      $(".save-search-btn").addClass("shake");
    }

    // task - 86a0w9r38
    var valueLength = $(".js-select2:not(.max-range,.min-range, .max-range-distance, .min-range-distance)").filter(function () {
        // console.log($(this)[0].tagName, $(this).val().length, $.trim($(this).val()) == "");
        if($.trim($(this).val()).length > 0) { return $(this); }
    });

    if(isTrigger == false && valueLength.length == 0 && $('#filterDistance').val() == '0' && $('#filterYearOfExperience').val() == '0') {
      $('#filters-form').trigger('submit', true);
    }
    // task - 86a0w9r38 end
    
    hideClearFilterBtn(isTrigger); // task - 86a0kdnun
    // $('.clear-filter-btn').removeClass('hide-clr-btn');
$('.save-search-btn').addClass("enable-save-btn");
    setTimeout(function () {
      // $(".save-search-btn").removeClass("shake");
      currentTime = new Date();
      milliseconds = currentTime.getTime(); // Get the milliseconds from the date
    }, 4000);
  }
);


function hideClearFilterBtn(isTrigger){
  let total_js_select2 = $(".js-select2:not(.max-range,.min-range, .max-range-distance, .min-range-distance)").length;
  var valueLength = $(".js-select2:not(.max-range,.min-range, .max-range-distance, .min-range-distance)").filter(function () {
      // console.log($(this)[0].tagName, $(this).val().length, $.trim($(this).val()) == "");
      if($.trim($(this).val()).length > 0) { return $(this); }
  });

  let hide_btn = false;

  // if(isTrigger == false) {
  var filterLength = $(".js-select2:not(.max-range,.min-range, .max-range-distance, .min-range-distance)").filter(function () {
      return $.trim($(this).val()).length == 0
  }).length;

  // task - 86a0m8a3f
  let current_url = window.location.href;
  if(current_url.includes("saved-searches")) {
    total_js_select2 = $('.modal.show .js-select2:not(.max-range,.min-range, .max-range-distance, .min-range-distance)').length;
    
    valueLength = $(".modal.show .js-select2:not(.max-range,.min-range, .max-range-distance, .min-range-distance)").filter(function () {
      if($.trim($(this).val()).length > 0) { return $(this); }
    });

    filterLength = $(".modal.show .js-select2:not(.max-range,.min-range, .max-range-distance, .min-range-distance)").filter(function () {
      return $.trim($(this).val()).length == 0
    }).length;
  }
  // task - 86a0m8a3f end

  if(total_js_select2 == filterLength) {
    hide_btn = true;
  }

  if ($('#filterDistance').val() == '1' || $('#filterYearOfExperience').val() == '1') {
    hide_btn = false;
  }
  // }

  // console.log(total_js_select2, filterLength);
  /*console.log('valueLength', valueLength.length);
  console.log('hide_btn', hide_btn);
  console.log('is_trigger', isTrigger);
  console.log('is run : ', $('#is_run').val());*/
  // console.log($('#filterDistance').val(), $('#filterYearOfExperience').val());

  /*if(isTrigger == false && valueLength.length == 0 && $('#filterDistance').val() == '0' && $('#filterYearOfExperience').val() == '0') {
    alert('Not selection !');
    $('#filters-form').trigger('submit', true);
  }*/

  $('select').select2("close");
 
  if (hide_btn === true) {
    setTimeout(function () {
      $('.clear-filter-btn').addClass('hide-clr-btn');
      $('.save-search-btn').removeClass("enable-save-btn");
    }, 100);  
    
  } else { // task - 86a0kdnun
    if((valueLength.length > 0 || $('#filterDistance').val() == '1' || $('#filterYearOfExperience').val() == '1') && $('#is_run').val() == '1') {
      setTimeout(function () {
        
        $('.dropdown-menu').removeClass("show");
        $('.clear-filter-btn').removeClass('hide-clr-btn');
        $('.save-search-btn').css('display', 'none'); // task - 862k2tf2f
        $('.hidden-btn-filter').attr('style', 'display:inline-block !important;margin-top:60px;');
        $('.hidden-btn-filter a.open-save-search-btn').addClass("shake");
      }, 100);
    } 
    setTimeout(function () {
      $('.clear-filter-btn').removeClass('hide-clr-btn');
    }, 100);
    /*setTimeout(function () {
      $('.save-search-btn').css('display', 'none'); // task - 862k2tf2f
      $('.hidden-btn-filter').attr('style', 'display:inline-block !important;margin-top:60px;');
      $('.hidden-btn-filter a.open-save-search-btn').addClass("shake");
    }, 100); */
  }

  if (valueLength.length > 0 || $('#filterDistance').val() == '1' || $('#filterYearOfExperience').val() == '1') {
    // console.log('here');
    setTimeout(function () {
      $('.clear-filter-btn').removeClass('hide-clr-btn');
      if($('#is_run').val() == '1') { // task - 86a0qfnhg
        $('.save-search-btn').css('display', 'none'); 
        $('.hidden-btn-filter').attr('style', 'display:inline-block !important;margin-top:60px;');
        $('.hidden-btn-filter a.open-save-search-btn').addClass("shake");
      }
    }, 250);
  }

  /*console.log(valueLength.length);
  console.log($('#filterDistance').val());
  console.log($('#filterYearOfExperience').val());*/
  if ((valueLength.length == 0 && $('#filterDistance').val() == '0' && $('#filterYearOfExperience').val() == '0')/* && !isTrigger */) {
    setTimeout(function () {
      // console.log('save - 4');
      $('.save-search-btn').css('display', 'inline-flex');
      $('.save-search-btn').css('float', 'right');
      $('.hidden-btn-filter').removeAttr('style');
    }, 150);
  }

  /*filterSelected=0;
  $(".js-select2:not(.max-range,.min-range, .max-range-distance, .min-range-distance)").each(function(){
   var val= $(this).val();
   if(val!=""){
    filterSelected++;
   }
  })
  if($(".max-range").val()-$(".min-range").val()<100 && $(".max-range").val()-$(".min-range").val()>0){
    filterSelected++;
  }
  if($(".max-range-distance").val()-$(".min-range-distance").val()<100 && $(".max-range-distance").val()-$(".min-range-distance").val()>0){
    filterSelected++;
  }
  console.log('distance',$(".max-range-distance").val()-$(".min-range-distance").val());
  console.log('dist',filterSelected);

  if(filterSelected<1){
    console.log('filterSelected==',filterSelected  );
    setTimeout(function () {
      $('.clear-filter-btn').addClass('hide-clr-btn');
    }, 100);    
  }*/  
}


