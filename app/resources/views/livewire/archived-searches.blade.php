<div>
    {{-- <div id="overlay"  wire:loading><span class="loader"></span></div> --}}
    <!-- select2 filters -->
    <link rel="stylesheet" href="{{asset('assets/be/search-page.css')}}" />
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.full.js"></script> --}}
    <div class="mid-contain">
        <div class="container-fluid">
            <div class="main-body">
                <div class="main-body-upper">
                    <div class="add_searches_home">
                        <div class="row add_searches_home_row">
                            <div class="col-lg-6 add_searches_home_col_lft">
                                <div class="sec_head_mn">
                                    <h2>Archived Searches</h2>
                                </div>
                            </div>
                        </div>

                        {{-- task - 86a0hxg00 --}}
                        @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                        @endif

                        @if (session('error'))
                        <span class="alert alert-danger">

                            <strong>{{ session('error') }}</strong>
                        </span>
                        @endif
                        {{-- task - 86a0hxg00 end --}}
                    </div>
 <style>
.select2-container--open, span.select2-dropdown {
    z-index: 99999 !important;
}
    </style>
                    <div class="saved_searches_accountant">

                        @foreach($savedSearches as $searches)
                        <div class="saved_searches_accountant_outr" id="saved_search_{{$searches['search']->id}}" data-url="{{url('/company/saved-search/')}}/{{$searches['search']->slug}}">
                            <div class="saved_sc_accountant_outr_top">
                                <div class="saved_sc_accountant_outr_top_row row">
                                    <div class="col-lg-6 saved_sc_accountant_outr_top_col_lft text-capitalize">
                                        <a href="{{url('/company/saved-search/')}}/{{$searches['search']->slug}}">
                                            <h4>{{$searches['search']->name}}</h4>
                                        </a>
                                    </div>

                                    <div class="col-lg-6 saved_sc_accountant_outr_top_col_rght">
                                        <div class="dowpdown_click_bts">
                                            <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                <img src="{{asset('assets/be/images/toggle_ic.svg')}}" alt="">
                                            </button>
                                            <ul class="dropdown-menu">
                                                <!-- <li>
                                                    <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#edit-search{ {$searches['search']->id}}">
                                                        <i class="icon"><img src="{ {asset('assets/be/images/search_e_ico.svg')}}" alt=""></i>Edit Search
                                                    </a>
                                                </li> -->
                                                <li>
                                                    <a class="dropdown-item" href="#" wire:click.prevent="unArchiveSearch({{$searches['search']->id}})">
                                                        <i class="icon"><img src="{{asset('assets/be/images/search_e_ico2.svg')}}" alt=""></i>Unarchive Search
                                                    </a>

                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="saved_sc_accountant_outr_mdll">
                                <div class="row saved_sc_accountant_outr_mdll_row">
                                    <div class="col-lg-6 saved_sc_accountant_outr_mdll_col_lft">
                                        <div class="candidate_numners_list">
                                            <span class="candidate_numners_list1">{{$searches['new_match_count']}}</span>
                                            <div class="candidate_numners_list1_rt">
                                                <h6>New Candidates</h6>
                                                <span class="total_match_nm">{{$searches['all_matches']}} Total Matches</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 saved_sc_accountant_outr_mdll_col_rt">
                                        <div class="all_candidates_igs_sc">
                                                    @foreach($searches['candidates_profile_image_path'] as $key => $img_path)
                                                        @if($key < $searches['all_matches'] && $key < 15)
                                                            @if($img_path['profile_photo_path'])

                                                            <figure class="maind_img">
                                                            @if(!empty($img_path->companyStatus()->first()->pivot->status))
                                                            @if($img_path->companyStatus()->first()->pivot->status==1)
                                                            {{-- uncomment for (if user want to show his profile image)  --}}
                                                            {{-- @if($img_path['personal']['profile_status'])   --}}
                                                            <img src="{{asset($img_path['profile_photo_path'])}}" alt="">
                                                            {{-- @else --}}
                                                            {{-- <img src="{{asset('assets/be/images/searches_im2.png')}}" alt=""> --}}
                                                            {{-- @endif --}}
                                                            @endif
                                                            @else
                                                            <img src="{{asset('assets/be/images/searches_im2.png')}}" alt="">
                                                            @endif

                                                            </figure>
                                                            @else
                                                            <figure class="maind_img"><img src="{{asset('assets/be/images/searches_im2.png')}}" alt="">
                                                            </figure>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                @if(count($searches['candidates_profile_image_path'])>15)
                                                <a href="#url" class="extra_add_pl m-0">+</a>
                                                @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="saved_sc_accountant_outr_bttm">
                                <span class="date_ctt">Date created: {{$searches['search']->created_at->format('m-d-Y')}}</span>
                            </div>

                        </div>


                        @endforeach
                        <!-- Modal -->
                        <div class="modal fade edit-search"  tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" wire:ignore.self>
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <form wire:submit.prevent="saveSearch()">
                                <div class="modal-content edit-search-form">

                                </div>
                                 </form>
                            </div>
                        </div>
                    </div>

                                    @if(!empty($countSearches))
                                        <a href="#url" class="load_more" wire:click="loadMore">
                                            <i><img src="{{ asset('assets/be/images/load_ic.svg') }}" alt="" /></i>
                                            <span class="loadSpan">Load More </span>
                                        </a>
                                     @else
                                        <p class="text-center text-muted m-2">No More Searches Found</p>
                                    @endif

                </div>
                <div class="main-body-footer">
                    <div class="footer-para new">
                        <p><span class="copyrite-text">© 2024 Purple Stairs</span>Website by <a href="https://www.brand-right.com/" target="_blank" class="brand">
                                BrandRight Marketing Group</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <span class="filter-out">
        <!-- <script src="{{asset('assets/be/js/filters.js')}}"></script> -->
    </span>

</div>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
<script>
    var old_tags = [], diff = [], diff2 = [], __tags = []; // task - 86a26mx9v

    function afterLoad(element) {
        var html = " <script src='https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js'><\/script><script src='{{asset('assets/be/js/filters.js')}}'><\/script>";
        $('.filter-out').html(html);
        setTimeout(function() {

            $('.js-select2:not(.max-range,.min-range, .max-range-distance, .min-range-distance)').each(function() {
                $(this).val($(this).val()).trigger('change', true);
            })
            element.find('.max-range').val(element.find('.max-range').val()).trigger('input', true);
            element.find('.min-range').val(element.find('.min-range').val()).trigger('input', true);

            $('.max-range-distance').val($('.max-range-distance').val()).trigger('input', true);
            $('.min-range-distance').val($('.min-range-distance').val()).trigger('input', true);
        }, 100);
    }
    document.addEventListener("livewire:load", () => {
        $("body").delegate(".search-update-btn", "click", function(e) {
            $(this).parents('.modal-content').find('#search_name_error').html(''); // task - 86a0wte46
            var search_name = $(this).parents('.modal-content').find('.edit-search-name').val();
            if(search_name==""){
                $(this).parents('.modal-content').find('#search_name_error').html('The search name field is required.'); // task - 86a0wte46
                return false;
            }
            var search_id = $(this).parents('.modal-content').find('.search_id').val();
            var industries_filter_btn = $(this).parents('.modal-content').find('.industries_filter_btn').val();
            var interest_filter_btn = $(this).parents('.modal-content').find('.interest_filter_btn').val();
            var hard_skills_filter_btn = $(this).parents('.modal-content').find('.hard_skills_filter_btn').val();
            var soft_skills_filter_btn = $(this).parents('.modal-content').find('.soft_skills_filter_btn').val();
            var languages_filter_btn = $(this).parents('.modal-content').find('.languages_filter_btn').val();
            var distance_filter_btn = $(this).parents('.modal-content').find('.distance_filter_btn').val();
            var current_position_filter_btn = $(this).parents('.modal-content').find('.current_position_filter_btn2').val(); // task - 86a21hge8
            // var current_position_filter_btn = $(this).parents('.modal-content').find('.current_position_filter_btn').val();
            var seeking_position_filter_btn = $(this).parents('.modal-content').find('.seeking_position_filter_btn').val();
            var schedule_filter_btn = $(this).parents('.modal-content').find('.schedule_filter_btn').val();
            var salary_range_filter_btn = $(this).parents('.modal-content').find('.salary_range_filter_btn').val();

            var work_environment_filter_btn = $(this).parents('.modal-content').find('.work_environment_filter_btn').val();
            var min_range = $(this).parents('.modal-content').find('.min-range').val();
            var max_range = $(this).parents('.modal-content').find('.max-range ').val();
            var min_distance = $('.min-range-distance').val();
            var max_distance = $('.max-range-distance').val();

            var compensation_filter_btn = $('.compensation_filter_btn ').val();

            var filterDistance = $('#filterDistance').val(); // task - 86a0m8a3f
            var filterYearOfExperience = $('#filterYearOfExperience').val(); // task - 86a0m8a3f

            @this.set('selectedIndustries', industries_filter_btn)
            @this.set('selectedInterests', interest_filter_btn);
            @this.set('selectedInterests', interest_filter_btn);
            @this.set('selectedHardSkills', hard_skills_filter_btn);
            @this.set('selectedSoftSkills', soft_skills_filter_btn);
            @this.set('selectedLanguages', languages_filter_btn);
            @this.set('selectDistance', distance_filter_btn);
            @this.set('selectSeekingPosition', seeking_position_filter_btn);
            @this.set('selectCurrentPosition', current_position_filter_btn);
            @this.set('selectSchedule', schedule_filter_btn);
            @this.set('selectSalaryRange', salary_range_filter_btn);
            @this.set('selectWorkEnvironment', work_environment_filter_btn);
            @this.set('selectMinYearOfExperience', min_range);
            @this.set('selectMaxYearOfExperience', max_range);
            @this.set('selectMaxYearOfExperience', max_range);
            @this.set('selectMinDistance', min_distance);
            @this.set('selectMaxDistance', max_distance);
            @this.set('selectCompensation', compensation_filter_btn);
            @this.set('search_name', search_name);
            @this.set('search_id', search_id);
            @this.set('filterDistance', filterDistance); // task - 86a0m8a3f
            @this.set('filterYearOfExperience', filterYearOfExperience); // task - 86a0m8a3f

            Livewire.hook('message.processed', (message, component) => {
            $(this).parents('.modal').modal('hide');
                afterLoad($(this));

            })
            // return false;
            // e.preventDefault();
        });
    });

    // task - 86a0wtefb
    $(document).on('hide.bs.modal', '#add-search', function(event) {
        $(this).find('.edit-search-name').val(''); // task - 86a0wtefb
        $(this).find('#search_name_error').html(''); // task - 86a0wte46

        $('.js-select2:not(.max-range,.min-range, .max-range-distance, .min-range-distance)').each(function() {
            $(this).val('').trigger('change', true);
        });

        $('.bootstrap-tagsinput > span.tag').remove();

        $(".max-range").val(40).trigger("input");
        $(".min-range").val(0).trigger("input");
        $(".max-range-distance").val(100).trigger("input");
        $(".min-range-distance").val(0).trigger("input");
    });

    $(document).on('hide.bs.modal', '.edit-search', function(event) {
        $(this).find('form')[0].reset();
        $(this).find('#search_name_error').html(''); // task - 86a0wte46
    });





    window.addEventListener('closeModal', event => {
        $('.modal').modal('hide');

    });
    window.addEventListener('close-notes', event => {
        $('#notesModal').modal('hide');
        $('#exampleModalToggle2').modal('show');
    });

    function profile_modal(id) {
        Livewire.emit('viewProfile', id);
    }

    window.addEventListener('open-profile-modal', event => {
        $('#exampleModalToggle2').modal('show');
    })
    $("body").delegate(".dropdown-toggle", "click", function(e) {
        var modalId=$(this).parents('.dowpdown_click_bts').find('.dropdown-item:first').attr('data-target');
        $(modalId).find('.js-select2:not(.max-range,.min-range, .max-range-distance, .min-range-distance)').each(function() {
            $(this).val($(this).val()).trigger('change', true);

        })
        $(modalId).find('.max-range').val($(modalId).find('.max-range').val()).trigger('input', true);
        $(modalId).find('.min-range').val($(modalId).find('.min-range').val()).trigger('input', true);

        $(modalId).find('.max-range-distance').val($(modalId).find('.max-range-distance').val()).trigger('input', true);
        $(modalId).find('.min-range-distance').val($(modalId).find('.min-range-distance').val()).trigger('input', true);

})
    window.addEventListener('element_id', function(event) {
            var elementId = event.detail;
            $('#' + elementId).hide('slow', function() {
                $('#' + elementId).remove();
            });
        });

        $(document).ready(function() {
            $('.deleteButton').on('click', function() {
                var delId=$(this).attr('data-id');
                var elementId = 'saved_search_'+delId;
                $('#' + elementId).hide('slow', function() {
                    $('#' + elementId).remove();
                });
                setTimeout(function() {
                    Livewire.emit('deleteSearch', delId);
                }, 1000); // 2000 milliseconds = 2 seconds
            });
        });
var load_more_complete = 0;
document.addEventListener("livewire:load", (e) => {
    $(window).scroll(function() {
        if ((window.innerHeight + Math.round(window.scrollY) + 100 >= document.body.offsetHeight) && $('.load_more').length && load_more_complete === 0) {
            load_more_complete = 1;
            $('.load_more').html('<span class="spinner-grow spinner-grow-sm mr-2" role="status" aria-hidden="true" style="margin-right:10px;"></span><span class="loadSpan">Loading...</span>');

            Livewire.emit('loadMore');

            Livewire.hook('message.processed', (message, component) => {

                load_more_complete = 0;
                $('.load_more').html('<i><img src="{{ asset('assets/be/images/load_ic.svg') }}" alt=""></i><span class="loadSpan">Load More</span>');
            });
        }
    });
});
    $("body").delegate(".edit-search-btn", "click", function(e) {
        var srchid=$(this).attr('data-id');
        $('.edit-search').modal('show');
        $('.filter-row .filter-col-box:not(.filter-btn)').addClass('animated-background')
        $.ajax({
            url: '{{ url('company/edit_search') }}/' + srchid,
            type: 'GET',
            dataType: 'html',
            success: function(modal) {
                $('.edit-search-form').html(modal);

                let prefilled_tags = $('.current_position_filter_btn2').val();
                var html = " <script src='https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js'><\/script><script src='{{asset('assets/be/js/filters.js')}}'><\/script>";
                $('.filter-out').html(html);
                setTimeout(function() {

                var html2 = '<script src="{{asset('assets/be/taginput/bootstrap-tagsinput.min.js')}}"><\/script><link rel="stylesheet" href="{{asset('assets/be/taginput/bootstrap-tagsinput.css')}}"/>' +
            '<div class="col- filter-col-box form-group position-input ">' +
                '<input class="current_position_filter_btn2 form-control js-select2" data-role="tagsinput" value="'+prefilled_tags+'" placeholder="Search by Current Title"/>' +
            '</div>';
                $('.tag-input-field').html(html2);
                $('.filter-row .filter-col-box:not(.filter-btn)').removeClass('animated-background');
                afterLoad();
                }, 1000);
                }

        });
    })


</script>
