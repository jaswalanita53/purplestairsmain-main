<div>
    <style type="text/css">
        .custom-tool {
            right: 505px; top: unset !important;
        }
        {{-- Task 86a1jh8z4 --}}
        .text-purple {
            color: var(--purple);
        }
         {{-- Task 86a1jh8z4 --}}
    </style>

    <section class="profile-banner cmn-gap pb-0 ban-up">
        <div class="container">
          <div class="form-points">
            @php
            $step = 6; $current_step = auth()->user()->current_step;
            @endphp
            @include('inc.steps',compact('step', 'current_step'))
          </div>
        </div>
      </section>

      <div class="common-form-wrap cmn-gap pt-0">
        <div class="container">
          <div class="common-form-outr">
            <div class="form-hdr">
              <h5>Skills</h5>
              <div>
                {{-- task - 86a0hxg00 @include('inc.autoSaveLoader') --}}
                <!-- <a
                  class="skip"
                  {{-- data-fancybox
                  data-src="#open3" --}}
                  href="{{route('candidatestep7')}}"
                  >Skip <em><img src="{{asset('assets/fe/images/skip-arrw.svg')}}" alt="" /></em
                ></a> -->
                {{-- <a
                  class="skip"

                  href="javascript:void(0)"
                  >Skip <em><img src="{{asset('assets/fe/images/skip-arrw.svg')}}" alt="" /></em
                ></a> --}}

                {{-- task - 86a1hvpcy --}}
                <button type="button" class="btn save-later" wire:click="finish_later" style="" >
                    <img src="{{ url('assets/be/images/save-icon.svg') }}" /> &nbsp;{{ $profileSaved ? 'Profile Saved' : 'Finish Later' }}
                </button>
              </div>
            </div>
            <form  id="skill-save-form">
            <div class="gl-form form-sec">
              <!-- <div class="warn-txt ">
                <img src="{{asset('assets/fe/images/warn.svg')}}" alt="" />
                <span>Add most recent first</span>
              </div> -->
              <div class="gl-frm-outr mb-3 bottom-none-interest-gl">
                <label class="">Hard Skills*
                </label>
                <span class="custom-tool">
                        <span>?</span>

                        <div class="tool-info">
                            <p>
                                <strong>Hard skills </strong>are technical skills
                                aquired through education or experience.
                            </p>
                        </div>
                    </span>
                    {{-- Task 86a1jh8z4 --}}
                    <span class="text-purple" style="margin-left: 40px;">Select 1-5 Hard Skills</span>
                    {{-- Task 86a1jh8z4 --}}
                <div class="form-group">
                  <select class="js-example-tags hard_skills" multiple="multiple"  id="selectedHardSkills">
                    @foreach ($all_hard_skills as $key => $skill)
                        <option value={{ $skill }} @if(in_array($skill,$selectedHardSkills))  selected @endif >{{ $key }} </option>
                    @endforeach
                  </select>
                </div>
              </div>

              <!-- Task 862k42apk
              <div class="form-bulb">
                <span><img src="{{asset('assets/fe/images/graduation-cap2.png')}}" alt="" /></span>
                <p>
                  Hard Skills are technical skills acquired through education or
                  experience.
                </p>
              </div> -->
              <div class="gl-frm-outr mb-3 bottom-none-interest-gl">
                <label class="">Soft Skills* </label>
                <span class="custom-tool">
                        <span>?</span>

                        <div class="tool-info">
                            <p>
                            <strong>Soft skills  </strong>are personal qualities and people skills.
                            </p>
                        </div>
                    </span>
                    {{-- Task 86a1jh8z4 --}}
                    <span class="text-purple" style="margin-left: 40px;">Select 1-10 Soft Skills</span>
                    {{-- Task 86a1jh8z4 --}}
                <div class="form-group">
                  <select class="js-example-tags soft_skills" multiple="multiple" id="selectedSoftSkills">
                    @foreach ($all_soft_skills as $key => $skill)
                        <option value={{ $skill }} @if(in_array($skill,$selectedSoftSkills))  selected @endif> {{ $key }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <!-- Task 862k42apk
              <div class="form-bulb">
                <span><img src="{{asset('assets/fe/images/happiness-face.png')}}" alt="" /></span>
                <p>
                  Soft skills are personal qualities and Interactive people skills
                </p>
              </div> -->
              <div class="gl-frm-outr">
                <label>Languages</label> <span class="text-grey" >(select multiple)</span>
                <div class="form-group">
                  <select class="js-example-tags languages" multiple="multiple" id="selectedLanguages">
                    @foreach ($all_languages as $key => $language)
                        <option value={{ $language }} @if(in_array($language,$selectedLanguages))  selected @endif>{{ $key }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="whole-btn-wrap dual-btn">
                <input type="submit" value="Back" class="prev-btn" />
                <input type="submit" value="Next" class="nxt-btn" />

                <!-- <input type="button" value="Saving..." class="nxt-btn" wire:loading wire:target="saveSkills"/> -->
              </div>
            </div>
            </form>
          </div>
        </div>
      </div>
</div>

@push('scripts')
<script>
/* task 86a1gwqft */
    $('select').select2({
                closeOnSelect: false,
                tags: false,

            });
/* task 86a1gwqft */


    // task - 86a114e9r
    $('select').on('select2:select', function (e) {
        $('.save-later').html('<img src="{{ url('assets/be/images/save-icon.svg') }}" /> &nbsp; Finish Later');
        $('textarea[aria-controls="select2-'+$(this).attr('id')+'-results"]').val('');
    });

    // task - 86a1gwqft
    $('.hard_skills').on('select2:open', function (e) {
        var _val = $(this).val();
        if(_val.length) {
            $('button[aria-describedby="select2-selectedHardSkills-container"]').show();
        } else {
            $('button[aria-describedby="select2-selectedHardSkills-container"]').hide();
        }
    });

    $('.soft_skills').on('select2:open', function (e) {
        var _val = $(this).val();
        if(_val.length) {
            $('button[aria-describedby="select2-selectedSoftSkills-container"]').show();
        } else {
            $('button[aria-describedby="select2-selectedSoftSkills-container"]').hide();
        }
    });

    $('.languages').on('select2:open', function (e) {
        var _val = $(this).val();
        if(_val.length) {
            $('button[aria-describedby="select2-selectedLanguages-container"]').show();
        } else {
            $('button[aria-describedby="select2-selectedLanguages-container"]').hide();
        }
    });

    $('.hard_skills').on('select2:close', function (e) {
        $('button[aria-describedby="select2-selectedHardSkills-container"]').hide();
    });

    $('.soft_skills').on('select2:close', function (e) {
        $('button[aria-describedby="select2-selectedSoftSkills-container"]').hide();
    });

    $('.languages').on('select2:close', function (e) {
        $('button[aria-describedby="select2-selectedLanguages-container"]').hide();
    });
    // task - 86a1gwqft end


    // // task - 862k3f2fe
    // var hardSelect2, softSelect2, languageSelect2;
    // var openHard = false;
    // var openSoft = false;
    // var openLang = false;

    // var parent_id, child_id;
    // let selected1 = [];
    // let selected2 = [];
    // let selected3 = [];

    // //initiate languages select2
    // document.addEventListener("livewire:load", () => {
    //     // initSelect2Languages();
    //     let el = $('.languages');
    //     initSelect();

    //     let el1 = $('.soft_skills');
    //     initSelectSoft();

    //     let el2 = $('.hard_skills');
    //     initSelectHard();

    //     $(document).on('click', '.select2-results__option', function(event) {
    //         parent_id = $(this).parent().attr('id');
    //         child_id = $(this).text();
    //     });

    //     initSelect();
    //     $('.languages').on('change', function(e) {
    //         var data = $('.languages').select2("val");
    //         var _old = @this.get('selectedLanguages');

    //         var tmp_data = data.map(Number);
    //         _old = _old.map(Number);
    //         let diff1 = tmp_data.filter(x => _old.indexOf(x) === -1);
    //         let diff2 = _old.filter(x => tmp_data.indexOf(x) === -1);

    //         const values = tmp_data;
    //         selected1 = selected1.filter((value) => values.includes(value));
    //         const lastSelected = values.filter((value) => !selected1.includes(value));
    //         selected1.push(lastSelected[0]);

    //         let child_ = $('.languages option[value='+lastSelected[0]+']').text();
    //         parent_id = $(".select2-results__option:contains('"+child_+"')").parent().attr('id');
    //         child_id = child_;

    //         if(diff1.length > 0 || diff2.length > 0) { @this.set('selectedLanguages', data); }
    //     });
    //     Livewire.hook('message.processed', (message, component) => {
    //         if(openLang) { initSelect(1); }
    //     });

    //     window.addEventListener('keep-open-language', event => {
    //         openLang = true;
    //         openSoft = false;
    //         openHard = false;
    //     });

    //     function initSelect(open = 0) {
    //         languageSelect2 = el.select2({
    //             closeOnSelect: false,
    //             tags: false
    //         });

    //         if(open) {
    //             languageSelect2.select2("open");
    //             if(document.getElementById(parent_id)) {
    //                 document.getElementById(parent_id).scrollTop = $(".select2-results__option:contains('"+child_id+"')").outerHeight() * $(".select2-results__option:contains('"+child_id+"')").index() - 100;
    //             }
    //             initSelectSoft();//initSelect2Soft();
    //             initSelectHard();//initSelect2Hard();
    //         }
    //     }

    //     initSelectSoft();
    //     $('.soft_skills').on('change', function(e) {
    //         var data = $('.soft_skills').select2("val");
    //         var _old = @this.get('selectedSoftSkills');

    //         var tmp_data = data.map(Number);
    //         _old = _old.map(Number);
    //         let diff1 = tmp_data.filter(x => _old.indexOf(x) === -1);
    //         let diff2 = _old.filter(x => tmp_data.indexOf(x) === -1);

    //         const values = tmp_data;
    //         selected2 = selected2.filter((value) => values.includes(value));
    //         const lastSelected = values.filter((value) => !selected2.includes(value));
    //         selected2.push(lastSelected[0]);

    //         let child_ = $('.soft_skills option[value='+lastSelected[0]+']').text();
    //         parent_id = $(".select2-results__option:contains('"+child_+"')").parent().attr('id');
    //         child_id = child_;

    //         if(diff1.length > 0 || diff2.length > 0) { @this.set('selectedSoftSkills', data); }
    //     });
    //     Livewire.hook('message.processed', (message, component) => {
    //         if(openSoft) { initSelectSoft(1); }
    //     });

    //     window.addEventListener('keep-open-soft', event => {
    //         openLang = false;
    //         openSoft = true;
    //         openHard = false;
    //         // initSelectSoft(1);
    //     });

    //     function initSelectSoft(open = 0) {
    //         softSelect2 = el1.select2({
    //             closeOnSelect: false,
    //             tags: false
    //         });

    //         if(open) {
    //             softSelect2.select2("open");
    //             if(document.getElementById(parent_id)) {
    //                 /*if($(".select2-results__option:contains('"+child_id+"')").length > 1) {
    //                     let exact_match = $(".select2-results__option:contains('"+child_id+"')").filter(function(){
    //                         return $(this).text() === child_id ? child_id : $(this).text();
    //                     });
    //                     console.log(exact_match);
    //                 } else {*/
    //                     document.getElementById(parent_id).scrollTop = $(".select2-results__option:contains('"+child_id+"')").outerHeight() * $(".select2-results__option:contains('"+child_id+"')").index() - 100;
    //                 // }
    //             }
    //             initSelect(); // initSelect2Languages();
    //             initSelectHard(); // initSelect2Hard();
    //         }
    //     }

    //     initSelectHard();
    //     $('.hard_skills').on('change', function(e) {
    //         var data = $('.hard_skills').select2("val");
    //         var _old = @this.get('selectedHardSkills');

    //         var tmp_data = data.map(Number);
    //         _old = _old.map(Number);
    //         let diff1 = tmp_data.filter(x => _old.indexOf(x) === -1);
    //         let diff2 = _old.filter(x => tmp_data.indexOf(x) === -1);

    //         const values = tmp_data;
    //         selected3 = selected3.filter((value) => values.includes(value));
    //         const lastSelected = values.filter((value) => !selected3.includes(value));
    //         selected3.push(lastSelected[0]);

    //         let child_ = $('.hard_skills option[value='+lastSelected[0]+']').text();
    //         parent_id = $(".select2-results__option:contains('"+child_+"')").parent().attr('id');
    //         child_id = child_;

    //         if(diff1.length > 0 || diff2.length > 0) { @this.set('selectedHardSkills', data); }
    //     });
    //     Livewire.hook('message.processed', (message, component) => {
    //         if(openHard) { initSelectHard(1); }
    //     });

    //     window.addEventListener('keep-open-hard', event => {
    //         openLang = false;
    //         openSoft = false;
    //         openHard = true;
    //         // initSelectHard(1);
    //     });

    //     function initSelectHard(open = 0) {
    //         hardSelect2 = el2.select2({
    //             closeOnSelect: false,
    //             tags: false
    //         });

    //         if(open) {
    //             hardSelect2.select2("open");
    //             console.log($(".select2-results__option:contains('"+child_id+"')").length, document.getElementById(parent_id));
    //             if(document.getElementById(parent_id)) {
    //                 document.getElementById(parent_id).scrollTop = $(".select2-results__option:contains('"+child_id+"')").outerHeight() * $(".select2-results__option:contains('"+child_id+"')").index() - 100;
    //             }
    //             initSelect(); //initSelect2Languages();
    //             initSelectSoft();//initSelect2Soft();
    //         }
    //     }

    // })
</script>

<script>
    $(".prev-btn").click(function(e) {
        e.preventDefault();
        location.replace('/candidate/employment')
    })
    // $(".nxt-btn").click(function(e) {
    //     e.preventDefault();
    //     location.replace('/candidate/references')
    // })

    window.addEventListener('init-select', event => {
        $('select').select2({
            closeOnSelect: false,
            tags: false,
        });
    });

    $(".nxt-btn,.skip").click(function(e) {
        // e.preventDefault();
        var count = 0;
        $(this)
            .parents(".common-form-outr")
            .find(".gl-frm-outr")
            .each(function() {
                var label = $(this).find("label").text();

                if (label.includes("*")) {
                    if ($(this).find('input ').val() == "" || $(this).find('select').val() == "") {
                        $(this).find(".form-group").find(".text-danger").remove();
                        $(this).find(".form-group").find("select:first").focus();
                        $(this)
                            .find(".form-group")
                            .append(
                                '<div class="text-danger" style=""> This field is required.</div>'
                            );
                        count++;

                    }
                 }

            });

        if (count > 0) {
            $('html, body').animate({
                scrollTop: $(".text-danger:first").offset().top - 200
            }, 500);
            return false;
        }
        var errosCount = $(".text-danger").length;
        if (errosCount < 1) {
            // location.replace('/candidate/references')
            // window.location.href='{{url("/candidate/references")}}';
            return true;
        } else {
            // task - 86a0d8f9t
            $('html, body').animate({
                scrollTop: $("div.text-danger:first").offset().top - 200
            }, 500);

            $(".text-danger").each(function() {
                $(this).parents(".form-group").find("input").focus();
                return false;
            });
        }
        return false;
    });
    $('.save-later').click(function (e) {
        var selectedHardSkills = $('#selectedHardSkills').val();
        var selectedLanguages = $('#selectedLanguages').val();
        var selectedSoftSkills = $('#selectedSoftSkills').val();

        console.log(selectedHardSkills,selectedLanguages,selectedSoftSkills);
        @this.set('selectedHardSkills', selectedHardSkills);
        @this.set('selectedLanguages', selectedLanguages);
        @this.set('selectedSoftSkills', selectedSoftSkills);
        console.log(@this.get('selectedHardSkills'),@this.get('selectedLanguages'),@this.get('selectedSoftSkills'));
    });
    document.addEventListener("livewire:load", () => {

    // task - 86a1hvpcy

    $("body").delegate("#skill-save-form", "submit", function() {
            $('.nxt-btn').val('Saving...');
            var selectedHardSkills = $('#selectedHardSkills').val();
            var selectedLanguages = $('#selectedLanguages').val();
            var selectedSoftSkills = $('#selectedSoftSkills').val();


            @this.set('selectedHardSkills', selectedHardSkills);
            @this.set('selectedLanguages', selectedLanguages);
            @this.set('selectedSoftSkills', selectedSoftSkills);

            Livewire.hook('message.processed', (message, component) => {
                $('select').select2({
                closeOnSelect: false,
                tags: false,

                /* task 86a1gwqft */
                {{-- allowClear: true --}}
                /* task 86a1gwqft */
            });
            {{-- $('.nxt-btn').val('Next'); --}}

            window.location.href='{{url("/candidate/references")}}';

            })

            return false;
            e.preventDefault();
        });
    });

    $('select').on('change', function(e) {
        $(this).parents('.gl-frm-outr').find(".form-group").find('.text-danger').remove();

    })
    // $('.select2-selection__choice__remove').on('click', function(e) {
    //     $(this).parents('.form-group').find('.search__field').focus();
    //     console.log('12121212');

    // })
    $('select').on('select2:unselect', function (e) {
        $(this).select2('close');
        $('.save-later').html('<img src="{{ url('assets/be/images/save-icon.svg') }}" /> &nbsp; Finish Later');
    });
</script>
@endpush
