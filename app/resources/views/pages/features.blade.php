@extends('layouts.app')
@section('content')
<section class="loop-sec cmn-gap ban-up pb-0 loop-sec-ft">
    <div class="sec-hdr loop_sec_main_hdr">
      <div class="container">
        <h1>Features</h1>
      </div>
    </div>
    <div class="nav-tabs-otr">
      <div class="container">

        <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link @if(empty(request('type'))) active @endif candidate-nav" data-bs-toggle="tab" href="#home"
              >Candidate</a
            >
          </li>
          <li class="nav-item">
            <a class="nav-link employer-nav  @if(!empty(request('type'))) active @endif" data-bs-toggle="tab" href="#menu1"
              >Employer</a
            >
          </li>
        </ul>


      </div>
    </div>


    <!-- Tab panes -->
    <div class="tab-content">

      <div class="tab-pane @if(empty(request('type'))) active @else fade @endif " id="home">

        <div class="loop_sec_total for_candidate">
          <div class="loop_sec_each">
            <div class="container">
              <div class="loop_sec_wrap">
                <div class="row loop_row">
                  <div class="col-lg-5">
                    <div class="loop_txt loop_full">
                      <div class="sec-hdr">
                        <span> INNOVATIVE SOLUTION</span>
                        <h3>
                        Get in front of employers while still maintaining privacy.
                        </h3>
                      </div>
                      <p>
                      Decide which information to show and which information to hide. You may hide your name, current position, and any other revealing details.
                      </p>
                    </div>
                  </div>
                  <div class="col-lg-7">
                    <div class="loop_fig">
                      <div class="back_img">
                        <figure>
                          <img src="{{asset("assets/fe/images/dm7.png")}}" alt="" />
                        </figure>
                      </div>
                      <div class="front_img w-100 front_img_mob">
                        <figure>
                          {{-- <img src="{{asset("assets/fe/images/candi_demo7.png")}}" alt="" /> --}}
                        </figure>
                        <div class="f-rgt m-rgt m-rgt-w">
                            <form>
                                <div class="form-group">
                                    <input type="text" placeholder="Name" class="form-control current_hidden">
                                    <div class="toggle-switch-block">
                                        <span>show</span>
                                        <div class="switch_box box_1">
                                            <input type="checkbox" class="switch_1">
                                        </div>
                                        <span>Hide</span>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <input type="text" placeholder="Current Title" class="form-control current_hidden">
                                    <div class="toggle-switch-block">
                                        <span>show</span>
                                        <div class="switch_box box_1">
                                            <input type="checkbox" class="switch_1" checked="">
                                        </div>
                                        <span>Hide</span>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <input type="text" placeholder="Company of Employment" class="form-control current_hidden">
                                    <div class="toggle-switch-block">
                                        <span>show</span>
                                        <div class="switch_box box_1">
                                            <input type="checkbox" class="switch_1">
                                        </div>
                                        <span>Hide</span>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <input type="text" placeholder="Education" class="form-control current_hidden">
                                    <div class="toggle-switch-block">
                                        <span>show</span>
                                        <div class="switch_box box_1">
                                            <input type="checkbox" class="switch_1" checked="">
                                        </div>
                                        <span>Hide</span>
                                    </div>

                                </div>
                            </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="loop_sec_each lp-sec2">
            <div class="container">
              <div class="loop_sec_wrap">
                <div class="row loop_row">
                  <div class="col-lg-5">
                    <div class="loop_txt loop_full">
                      <div class="sec-hdr">
                        <span>FREE RESUME CREATION</span>
                        <h3>Create a professional resume, and download a copy to keep.</h3>
                      </div>
                      <p>
                        Based on your profile selections and work history, Purple Stairs generates a beautifully designed resume for you to download and use as you wish.
                      </p>
                    </div>
                  </div>
                  <div class="col-lg-7">
                    <div class="loop_fig">
                      <div class="back_img">
                        <figure>
                          <img src="{{asset("assets/fe/images/dm8.png")}}" alt="" />
                        </figure>
                      </div>
                      <div class="front_img small_img2">
                        <figure>
                          <img src="{{asset("assets/fe/images/candi_demo8.png")}}" alt="" />
                        </figure>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          {{-- <div class="loop_sec_each">
            <div class="container">
              <div class="loop_sec_wrap">
                <div class="row loop_row">
                  <div class="col-lg-5">
                    <div class="loop_txt loop_full">
                      <div class="sec-hdr">
                        <span>n/A</span>
                        <h3>Easily UPLOAD your information</h3>
                      </div>
                      <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing
                        elit. Maecenas vulputate justo consectetur viverra
                        rutrum. Aliquam at sodales odio, non hendrerit quam.
                      </p>
                    </div>
                  </div>
                  <div class="col-lg-7">
                    <div class="loop_fig">
                      <div class="back_img">
                        <figure>
                          <img src="{{asset("assets/fe/images/dm9.png")}}" alt="" />
                        </figure>
                      </div>
                      <div class="front_img small_img3">
                        <figure>
                          <img src="{{asset("assets/fe/images/candi_demo9.png")}}" alt="" />
                        </figure>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div> --}}
          <div class="loop_sec_each">
            <div class="container">
              <div class="loop_sec_wrap">
                <div class="row loop_row">
                  <div class="col-lg-5">
                    <div class="loop_txt loop_full">
                      <div class="sec-hdr">
                        <span>ACCOMPLISHMENT ATTRACTION</span>
                        <h3>Include job accomplishments because it matters!</h3>
                      </div>
                      <p>
                      As an addition to the traditional work history, you may specify your compelling accomplishments for each position, which can make you a more appealing candidate to potential employers.
                      </p>
                      {{-- 86a2mbxd6 --}}
                      <a href="{{ url('/our-mission') }}" class="btn mt-3 mb-3">Learn More</a>
                    </div>
                  </div>
                  <div class="col-lg-7">
                    <div class="loop_fig">
                      <div class="back_img">
                        <figure>
                          <img src="{{asset("assets/fe/images/candi_demo-diff1.png")}}" alt="" />
                        </figure>
                      </div>
                      <!-- <div class="front_img small_img3">
                                              <figure>
                                                  <img src="images/candi_demo9.png" alt="">
                                              </figure>
                                          </div> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="loop_sec_each">
            <div class="container">
              <div class="loop_sec_wrap">
                <div class="row loop_row">
                  <div class="col-lg-5">
                    <div class="loop_txt loop_full">
                      <div class="sec-hdr">
                        <span>SKILL SET EXPOSURE</span>
                        <h3>
                        Get noticed for your skills, experience and preferences.
                        </h3>
                      </div>
                      <p>
                      Your job preferences give employers an idea of the type of position that you are looking for and allow for the right employers to find you. In addition, get noticed for your hard skills, soft skills, and languages that affect your position capabilities.
                      </p>
                    </div>
                  </div>
                  <div class="col-lg-7">
                    <div class="loop_fig">
                      <div class="back_img">
                        <figure>
                          <img src="{{asset("assets/fe/images/dm10.png")}}" alt="" />
                        </figure>
                      </div>
                      <div class="front_img small_img3">
                        <figure>
                          <img src="{{asset("assets/fe/images/candi_demo10.png")}}" alt="" />
                        </figure>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="loop_sec_each">
            <div class="container">
              <div class="loop_sec_wrap">
                <div class="row loop_row">
                  <div class="col-lg-5">
                    <div class="loop_txt loop_full">
                      <div class="sec-hdr">
                        <span> POWER OF THE PLATFORM</span>
                        <h3>
                        Fully Control who has access to your information.
                        </h3>
                      </div>
                      <p>
                      You hold the power of the platform by allowing selectively who gets to see your revealing details. After an employer requests additional information, you can decide if they and their available position are a good fit before unmasking yourself for that specific employer.
                      </p>
                    </div>
                  </div>
                  <div class="col-lg-7">
                    <div class="loop_fig loop_fig_right">
                      <div class="back_img">
                        <figure>
                          <img src="{{asset("assets/fe/images/dm11.png")}}" alt="" />
                        </figure>
                      </div>
                      <div class="front_img front_img_right">
                        <figure>
                          <img src="{{asset("assets/fe/images/candi_demo11.png")}}" alt="" />
                        </figure>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="tab-pane  @if(!empty(request('type'))) active @else fade @endif" id="menu1">

        <div class="loop_sec_total for_next_tab_content">
          <div class="loop_sec_each">
            <div class="container">
              <div class="loop_sec_wrap">
                <div class="row loop_row">
                  <div class="col-lg-7">
                    <div class="loop_fig">
                      <div class="back_img" style="visibility: hidden;">
                        <figure>
                          <img src="{{asset("assets/fe/images/dm1.png")}}" alt="" />
                        </figure>
                      </div>
                      <div class="front_img">
                        <figure>
                          <img src="{{asset("assets/fe/images/candi_demo1.png")}}" alt="" />
                        </figure>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-5">
                    <div class="loop_txt loop_full">
                      <div class="sec-hdr">
                        <span>GENIUS SOFTWARE</span>
                        <h3>
                        First of its kind database of candidates you won't find anywhere else.
                        </h3>
                      </div>
                      <p>
                      An employer-driven database is where you’ll find the talent you want. Entry and High-level candidates can be discovered on Purple Stairs, as they have the ability to showcase themselves effectively while maintaining a degree of discretion securing their current employment.
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="loop_sec_each">
            <div class="container">
              <div class="loop_sec_wrap">
                <div class="row loop_row">
                  <div class="col-lg-7">
                    <div class="loop_fig">
                      <div class="back_img">
                        <figure>
                          <img src="{{asset("assets/fe/images/dm2.png")}}" alt="" />
                        </figure>
                      </div>
                      <div class="front_img">
                        <figure>
                          <img src="{{asset("assets/fe/images/candi_demo2.png")}}" alt="" />
                        </figure>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-5">
                    <div class="loop_txt loop_full">
                      <div class="sec-hdr">
                        <span>SAFE COMMUNICATION</span>
                        <h3>
                        Communicate directly with selected candidates.
                        </h3>
                      </div>
                      <p>
                      There’s no middle man. Personally contact as many candidates as you want to obtain additional information and to schedule interviews.
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="loop_sec_each">
            <div class="container">
              <div class="loop_sec_wrap">
                <div class="row loop_row">
                  <div class="col-lg-7">
                    <div class="loop_fig diff_loop_fig">
                      <div class="back_img bck2-img">
                        <figure>
                          <img src="{{asset("assets/fe/images/dm3.png")}}" alt="" />
                        </figure>
                      </div>
                      <div class="front_img">
                        <figure>
                          <img src="{{asset("assets/fe/images/candi_demo3.png")}}" alt="" />
                        </figure>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-5">
                    <div class="loop_txt loop_full">
                      <div class="sec-hdr">
                        <span>SPECIFIC FOCUS</span>
                        <h3>
                        Search candidates based on skills, experience and other preferences.
                        </h3>
                      </div>
                      <p>
                      Utilize a robust search feature. Filter by criteria, skills, experience, and preference to find the candidate that is the best fit for your company.
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="loop_sec_each">
            <div class="container">
              <div class="loop_sec_wrap">
                <div class="row loop_row">
                  <div class="col-lg-7">
                    <div class="loop_fig">
                      <div class="back_img">
                        <figure>
                          <img src="{{asset("assets/fe/images/dm4.png")}}" alt="" />
                        </figure>
                      </div>
                      <div class="front_img diff_front_img">
                        <figure>
                          <img src="{{asset("assets/fe/images/candi_demo4.png")}}" alt="" />
                        </figure>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-5">
                    <div class="loop_txt loop_full">
                      <div class="sec-hdr">
                        <span>FUTURE IN MIND</span>
                        <h3>
                        Create and Save filters to find candidates for multiple positions.
                        </h3>
                      </div>
                      <p>
                      Save multiple filtered searches so that you can revisit them to manage your candidates, and see new candidates that match your filters at a later date.
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="loop_sec_each">
            <div class="container">
              <div class="loop_sec_wrap">
                <div class="row loop_row">
                  <div class="col-lg-7">
                    <div class="loop_fig">
                      <div class="back_img">
                        <figure>
                          <img src="{{asset("assets/fe/images/candi_demo-diff.png")}}" alt="" />
                        </figure>
                      </div>
                      <!-- <div class="front_img ">
                                              <figure>
                                                  <img src="images/candi_demo5.png" alt="">
                                              </figure>
                                          </div> -->
                    </div>
                  </div>
                  <div class="col-lg-5">
                    <div class="loop_txt loop_full">
                      <div class="sec-hdr">
                        <span>TEAM COLLABORATION</span>
                        <h3>
                        Customize notes to communicate within your HR team.
                        </h3>
                      </div>
                      <p>
                      Internal notes help you remember details about candidates and allow you to collaborate with others (within your company’s account) on filling open positions.
                      </p>
                      <!-- <a href="#" class="btn">Learn More</a> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="loop_sec_each">
            <div class="container">
              <div class="loop_sec_wrap">
                <div class="row loop_row">
                  <div class="col-lg-7">
                    <div class="loop_fig">
                      <div class="back_img">
                        <figure>
                          {{-- <img src="{{asset("assets/fe/images/dm6.png")}}" alt="" />
                           --}}
                           <img src="{{asset("assets/fe/images/candi_demo6.png")}}" alt="" />
                        </figure>
                      </div>
                      <div class="front_img sml_max_width">
                        <figure>
                          {{-- <img src="{{asset("assets/fe/images/candi_demo6.png")}}" alt="" /> --}}
                        </figure>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-5">
                    <div class="loop_txt loop_full">
                      <div class="sec-hdr">
                        <span>ONE-STOP CONVENIENCE</span>
                        <h3>
                        Access resumes with references and position accomplishments.
                        </h3>
                      </div>
                      <p>
                      Gain access to an abundance of resumes with the information you need, all in one clean location with an easy-to-use interface. This is sure to streamline your hiring process.
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="loop_sec_each">
            <div class="container">
              <div class="loop_sec_wrap">
                <div class="row loop_row">
                  <div class="col-lg-7">
                    <div class="loop_fig">
                      <div class="back_img">
                        <figure>
                          <img src="{{asset("assets/fe/images/candi_demo-alert.png")}}" alt="" />
                        </figure>
                      </div>
                      <div class="front_img ">
                                              <figure>
                                                  {{-- <img src="images/candi_demo5.png" alt=""> --}}
                                              </figure>
                                          </div>
                    </div>
                  </div>
                  <div class="col-lg-5">
                    <div class="loop_txt loop_full">
                      <div class="sec-hdr">
                        <span>MATCH ALERTS</span>
                        <h3>
                        Receive email notifications when a new match joins.
                        </h3>
                      </div>
                      <p>
                      Each time a new candidate matches your saved filter criteria, you will receive an email in your inbox containing the relevant information about the new candidate.
                      </p>
                      <!-- <a href="#" class="btn">Learn More</a> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </section>

    <div class="loop_ftr_sec cmn-gap bg-white">
        <div class="container">
        <div class="loop_ftr_wrap">
            <div class="loop_ftr_txt text-center">
            <div class="sec-hdr">
                <span class="mission-0-text">A GROUNDBREAKING PROCESS</span>
                <h2>A Tailored Solution</h2>
            </div>
            <p>
                Our process is easy, built on an efficient and effective response <br>to hiring companies and job-seeking candidates.
            </p>
            <a href="{{url('/signup-select')}}" class="btn mb-2 mt-3">Sign Up Now</a>
            </div>
        </div>
        </div>
        <img src="{{asset("assets/fe/images/sed_nec_back.png")}}" class="sed_neck_img" alt="" />
    </div>


  <script>
    $("body").delegate(".employer-nav", "click", function(e) {
        $('.loop_ftr_sec').addClass('bg-white')
    })
    $("body").delegate(".candidate-nav", "click", function(e) {
        $('.loop_ftr_sec').removeClass('bg-white')
    })
</script>
<script>
    $(document).ready(function() {
        // Check the initial state of the checkbox on page load
        $(".switch_1").each(function() {
            if ($(this).is(":checked")) {
            $(this).parents('.form-group').find('.show-text').removeClass('show');
            $(this).parents('.form-group').find('.current_hidden').css('filter', 'unset');
            $(this).parents('.form-group').find('.current_hidden').attr('disabled', false);
            // Perform actions when the checkbox is checked
            } else {
            $(this).parents('.form-group').find('.show-text').addClass('show');
            $(this).parents('.form-group').find('.current_hidden').css('filter', 'blur(3px)');
            $(this).parents('.form-group').find('.current_hidden').attr('disabled', true);
            // Perform actions when the checkbox is unchecked
            }
        });
        $("body").delegate(".switch_1", "change", function(e) {
            if ($(this).is(":checked")) {
                $(this).parents('.form-group').find('.show-text').removeClass('show');
                $(this).parents('.form-group').find('.current_hidden').css('filter', 'unset');
                $(this).parents('.form-group').find('.current_hidden').attr('disabled', false);
                // Perform actions when the checkbox is checked
            } else {
                $(this).parents('.form-group').find('.show-text').addClass('show');
                $(this).parents('.form-group').find('.current_hidden').css('filter', 'blur(3px)');
                $(this).parents('.form-group').find('.current_hidden').attr('disabled', true);
                // Perform actions when the checkbox is unchecked
            }
        });
    });

</script>


<script>
document.addEventListener("DOMContentLoaded", function() {
    const paramName = 'type';
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has(paramName)) {
        urlParams.delete(paramName);
        const newUrl = window.location.pathname + (urlParams.toString() !== '' ? '?' + urlParams.toString() : '');
        history.replaceState({}, document.title, newUrl);
    }
});
</script>

  @endsection
