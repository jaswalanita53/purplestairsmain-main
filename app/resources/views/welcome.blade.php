@extends('layouts.app')

@section('content')
    <section class="banner-sec ban-up">
        <div class="container">
            <div class="banner-outr">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <div class="ban-lft">
                            <div class="ban-hdr">
                                <h1 class="home-heading-1">Don't Lose Your<br> Current Job While<br> Looking For A <br> <span><em>New One! </em> </span> </h1>
                            </div>
                            <div class="hide">
                                <em class="home-heading-2">For those looking discreetly or publicly.</em>
                            </div>
                            <div class="profile-time nw_pf nw_pf-pl-1">
                                <!-- <p class="desktop-v">Upload Your Profile In Less Than <span>3 Minutes</span></p> -->
                                <!-- <p class="mobile-v">Join In Less Than <span>3 Minutes</span></p> -->

                                {{-- Task #86a0gbv9f --}}
                                <a href="{{ url('/signup-candidate') }}" class="start-btn pl-1">Create Your Profile <img
                                        src="{{ asset('assets/fe/images/rock.svg') }}" alt="" /></a>

                            </div>
                            <div class="important-wrap desktop-v">
                                <h3>WHAT IS IMPORTANT TO YOU?</h3>
                                <ul>
                                    {{-- task #86a1krpk7 --}}
                                    <style>
                                        .what-important {
                                            color: #8f8f8f;
                                            font-weight: 400;
                                        }

                                        .what-important:hover li {
                                            color: #484848;
                                        }

                                        .modal-body {
                                            position: relative;
                                        }

                                        .promo-video-popup {
                                            width: 100%;
                                            /* Make the video element fill the container */
                                        }

                                        #toggleMuteContainer {
                                            position: absolute;
                                            top: 50%;
                                            left: 50%;
                                            transform: translate(-50%, -50%);
                                            z-index: 1;
                                            /* Ensure the container appears above the video */
                                        }

                                        .shake {
                                            /* Add the shake class here */
                                            animation: shake 0.5s infinite;
                                            /* Adjust the duration as needed */
                                        }

                                        @keyframes shake {

                                            0%,
                                            100% {
                                                transform: translateX(0);
                                            }

                                            25%,
                                            75% {
                                                transform: translateX(-5px);
                                            }

                                            50% {
                                                transform: translateX(5px);
                                            }
                                        }

                                        #toggleMuteButton {
                                            width: 50px;
                                            height: 50px;
                                            background-color: red;
                                            border: 2px solid #ccc;
                                            cursor: pointer;
                                            display: flex;
                                            align-items: center;
                                            justify-content: center;
                                        }

                                        #toggleMuteButton.play::before {
                                            content: '\25B6';
                                            /* Unicode character for the "play" symbol */
                                            font-size: 24px;
                                            color: #333;
                                        }

                                        #toggleMuteButton.pause::before {
                                            content: '\II';
                                            /* Unicode character for the "pause" symbol */
                                            font-size: 24px;
                                            color: #333;
                                        }

                                        /* Optional: Add styles for the button's appearance when hovered or clicked */
                                        #toggleMuteButton:hover {
                                            background-color: #eee;
                                        }

                                        #toggleMuteButton:active {
                                            background-color: #ddd;
                                        }
                                    </style>
                                    <a href="{{ url('/signup-candidate') }}" class="what-important">
                                        <li>Remote Position</li>
                                    </a>
                                    <a href="{{ url('/signup-candidate') }}" class="what-important">
                                        <li>Full Time</li>
                                    </a>
                                    <a href="{{ url('/signup-candidate') }}" class="what-important">
                                        <li>Insurance Benefits</li>
                                    </a>
                                    <a href="{{ url('/signup-candidate') }}" class="what-important">
                                        <li>Location</li>
                                    </a>
                                    <a href="{{ url('/signup-candidate') }}" class="what-important">
                                        <li>Professional Environment</li>
                                    </a>
                                    <a href="{{ url('/signup-candidate') }}" class="what-important">
                                        <li>Established Company</li>
                                    </a>
                                    {{-- task #86a1krpk7 --}}
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">

                        <div class="ban-rgt">
                            <figure class="figg1">
                                <img src="{{ asset('assets/fe/images/ban-img.png') }}" alt="" />
                            </figure>
                            <div class="cmnt-solo yellow speak-box">
                                <div class="cmnt-lft">
                                    <span class="head-yellow-span"><img src="{{ asset('assets/fe/images/m3.svg') }}"
                                            alt="" class="speak"></span>
                                    {{-- <h3>120</h3> --}}
                                </div>
                                <div class="cmnt-rgt">
                                    {{-- task 86a1jvukt --}}
                                    <h5 class="head-yellow">
                                        THE FUTURE OF HIRING
                                        <span>FIND OUT MORE</span>
                                    </h5>
                                    {{-- task 86a1jvukt --}}
                                </div>
                            </div>
                            <div class="cmnt-solo blue">
                                <div class="cmnt-lft">
                                    <span class="play_parent">

                                        <div class="wrapper">
                                            <div class="video-main">
                                                <div class="promo-video">
                                                    <div class="waves-block">
                                                        <div class="waves wave-1"></div>
                                                        <div class="waves wave-2"></div>
                                                        <div class="waves wave-3"></div>
                                                    </div>
                                                </div>
                                                <a href="javascript:void(0)" class="video video-popup mfp-iframe color_play"
                                                    data-lity type="button" data-bs-toggle="modal"
                                                    data-bs-target="#videoModal"><i
                                                        class="fa fa-play play-icon-animate"></i></a>
                                            </div>
                                        </div>
                                    </span>


                                    {{-- <span class="play_parent"><i class="fa fa-play color_play" aria-hidden="true"></i></span> --}}
                                    {{-- <h3>312</h3> --}}
                                </div>
                                <div class="cmnt-rgt">
                                    {{-- <h5>Endless Opportunity<span>For Candidates</span></h5> --}}
                                    <h5>MUST WATCH<span>PROMO VIDEO</span></h5>
                                </div>
                            </div>
                        </div>

                        <div class="ban-links-btm">

                            <div class="important-wrap mobile-v">
                                <h3>WHAT IS IMPORTANT TO YOU?</h3>
                                <ul>
                                    <li>Work from home</li>
                                    <li>Full Time</li>
                                    <li>Room For Growth</li>
                                    <li>Insurance Benefits</li>
                                    <li>Location</li>
                                    <li>Professional Environment</li>
                                    <li>Established Company</li>
                                </ul>
                            </div>
                        </div>

                        {{-- TEMPORARILY HIDE 86a3bkby7 --}}
                        {{-- <div class="ban-top-logo  mt-4">
                            <div class="logo-outr mobile-v">
                                <ul class="social-slider">
                                    <li>

                                        <a href="javascript:void(0)"><img src="{{ asset('assets/fe/images/image1.png') }}"
                                                alt="" /></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)"><img src="{{ asset('assets/fe/images/image2.png') }}"
                                                alt="" /></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)"><img src="{{ asset('assets/fe/images/image3.png') }}"
                                                alt="" /></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)"><img src="{{ asset('assets/fe/images/image4.png') }}"
                                                alt="" /></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)"><img src="{{ asset('assets/fe/images/image5.png') }}"
                                                alt="" /></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)"><img src="{{ asset('assets/fe/images/image6.png') }}"
                                                alt="" /></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)"><img src="{{ asset('assets/fe/images/image1.png') }}"
                                                alt="" /></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)"><img src="{{ asset('assets/fe/images/image2.png') }}"
                                                alt="" /></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)"><img src="{{ asset('assets/fe/images/image3.png') }}"
                                                alt="" /></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)"><img src="{{ asset('assets/fe/images/image4.png') }}"
                                                alt="" /></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)"><img src="{{ asset('assets/fe/images/image5.png') }}"
                                                alt="" /></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)"><img src="{{ asset('assets/fe/images/image6.png') }}"
                                                alt="" /></a>
                                    </li>
                                </ul>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="logo-sec cmn-gap pt-0">
        <div class="container">
        {{-- TEMPORARILY HIDE 86a3bkby7 --}}
            {{-- <div class="logo-outr desktop-v">
                <ul>
                    <li>
                        <a href="javascript:void(0)"><img src="{{ asset('assets/fe/images/image1.png') }}"
                                alt="" /></a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><img src="{{ asset('assets/fe/images/image2.png') }}"
                                alt="" /></a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><img src="{{ asset('assets/fe/images/image3.png') }}"
                                alt="" /></a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><img src="{{ asset('assets/fe/images/image4.png') }}"
                                alt="" /></a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><img src="{{ asset('assets/fe/images/image5.png') }}"
                                alt="" /></a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><img src="{{ asset('assets/fe/images/image6.png') }}"
                                alt="" /></a>
                    </li>
                </ul>
            </div> --}}
            <div class="logo-btm">
                <div class="row">
                    <div class="col-md-6">
                        <div class="logo-lft">
                            <figure class="l-fig">
                                <img src="{{ asset('assets/fe/images/o-img.png') }}" alt=""
                                    class="desktop-v toggle-bg" />
                                <img src="{{ asset('assets/fe/images/omg2.png') }}" alt=""
                                    class="mobile-v toggle-bg" />
                            </figure>
                            <style>
                                .profile-pop-new input.switch_1 {
                                    width: 80px;
                                    height: 42px;

                                }

                                .profile-pop-new input[type="checkbox"].switch_1:checked:after {
                                    left: 29px;
                                }

                                .profile-pop-new input[type="checkbox"].switch_1:after {
                                    right: 29px;
                                }

                                .profile-pop-new input[type="checkbox"].switch_1:after {
                                    height: 50px !important;
                                    width: 50px !important;
                                }

                                .cmnt-wrap.profile-pop-new span {
                                    font-weight: 400;
                                    font-size: 30px;
                                    color: #383838;
                                }

                                .profile-pop-new .toggle-switch-block>span:last-child {
                                    order: 1 !important;
                                }

                                .profile-pop-new .toggle-switch-block>span:first-child {
                                    order: 0 !important;
                                }

                                .cmnt-solo.yellow:hover .head-yellow {
                                    color: purple;
                                }

                                .cmnt-solo.yellow:hover .speak {
                                    filter: brightness(10);
                                }

                                .cmnt-solo.yellow:hover .head-yellow-span {
                                    background-color: rgb(255 175 26 / 97%);
                                }

                                .cmnt-solo.yellow {
                                    cursor: pointer;
                                }
                            </style>
                            <div class="cmnt-wrap profile-popup- profile-pop-new prfle-pop2">

                                <div class="toggle-switch-block">
                                    <span>Hide</span>
                                    <div class="switch_box box_1">
                                        <input type="checkbox" class="switch_1" wire:model.lazy="name_status"
                                            tabindex="-1" checked />

                                    </div>
                                    <span>Show</span>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 logo-col">
                        <div class="logo-rgt">
                            <div class="sec-hdr">
                                <span>Your Employment Advances</span>
                                <h2>Opportunity
                                    Knocks
                                </h2>
                            </div>
                            <p class="mb-4">
                                Purple Stairs is an exciting and innovative platform that serves candidates
                                without compromising on personal and information privacy. When you’ve got talent and you
                                want to move on without your current boss finding out, Purple Stairs has your back.
                            </p>
                            <ul>
                                <li>Masks choice sensitive information</li>
                                <li>Presents hard and soft skills</li>
                                <li>Lists ideal job preferences</li>
                            </ul>
                            {{-- Task #86a0gbv9f --}}
                            <a href="{{ url('/') }}/signup-candidate" class="btn">Upload Profile Securely</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="candidate-sec cmn-gap">
        <div class="container">
            <div class="logo-btm">
                <div class="row align-items-center">
                    <div class="col-md-5">
                        <div class="logo-rgt">
                            <div class="sec-hdr">
                                <span>Easy Sorting</span>
                                <h2>To Find Your
                                    <br> Perfect Candidate
                                </h2>
                            </div>
                            <p class="mb-4">
                                We present candidates’ abilities in relation to their present positions, as well as personal
                                experience, attributes, performance skills, and accomplishments. Before Purple Stairs,
                                candidates refrained from posting their names as looking for a job, due to concerns about
                                their current employer finding out.
                            </p>

                            <a href="{{ url('/') }}/feature?type=employer" class="btn">Find Out More</a>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="logo-lft">
                            <figure class="text-end">
                                <img src="{{ asset('assets/fe/images/o-mg2.png') }}" alt="" class="desktop" />
                                {{-- <img src="{{ asset('assets/fe/images/omg1.png') }}" alt="" class="mobile-v" /> --}}
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-fullscreen-md-down">
            <div class="modal-content bg-transparent border-0">

                <div class="modal-body p-0">
                    <button type="button" class="btn-close promo-btn" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                    <video width="100%" height="100%" controls class="promo-video-popup rounded-3" preload="auto" playsinline>
                        <source src="{{ asset('assets/fe/videos/promo-video.mp4') }}" type="video/mp4">
                        <source src="{{ asset('assets/fe/videos/promo-video.mp4') }}" type="video/ogg">
                        Your browser does not support the video tag.
                    </video>
                    {{-- <div id="toggleMuteContainer">
                        <button id="toggleMuteButton" class="btn shake "><i class="fas fa-volume-mute"></i>
                            <!-- Muted state icon --><span class="sr-only">Unmute</span></button>
                    </div> --}}
                </div>

            </div>
        </div>
    </div>
    <script>

        $(document).ready(function() {
            {{-- Task #86a209jd2 --}}
            localStorage.setItem("visitedBefore", true);

            // Check if it's the user's first visit using localStorage
            if (!localStorage.getItem("visitedBefore")) {
                // Set a flag indicating that the user has visited
                localStorage.setItem("visitedBefore", true);

                // Show the modal after 1 second
                setTimeout(function() {

                    $('#toggleMuteButton').show();
                    var videoElement = $('.promo-video-popup').get(0);
                       // Check if the video element exists before attempting to play
                    if (videoElement) {
                        videoElement.muted = true;
                        var playPromise = videoElement.play();

                    }
                    $('#videoModal').modal('show');
                }, 1000);
            } else {
                $('#toggleMuteButton').hide();
            }

            var videoElement = $('.promo-video-popup').get(0);
            var toggleMuteButton = $('#toggleMuteButton');

            // Check if the video element exists
            if (videoElement) {
                // Set the initial state to muted
                videoElement.muted = true;
                toggleMuteButton.html('<i class="fas fa-volume-mute"></i>');

                // Add click event for the toggle mute button
                toggleMuteButton.on('click', function() {
                    {{-- videoElement.muted = true; --}}
                    var playPromise = videoElement.play();
                    // Toggle the muted property of the video
                    videoElement.muted = !videoElement.muted;

                    // Update the button icon based on mute state
                    if (videoElement.muted) {
                        toggleMuteButton.addClass('shake');
                        toggleMuteButton.html('<i class="fas fa-volume-mute"></i>');
                    } else {
                        toggleMuteButton.removeClass('shake');
                        toggleMuteButton.html('<i class="fas fa-volume-up"></i>');
                    }
                });
            }

            $("body").on("shown.bs.modal", "#videoModal", function(e) {
                var videoElement = $('.promo-video-popup').get(0);
                videoElement.muted = false;
                var playPromise = videoElement.play();
            });
            $("body").on("hide.bs.modal", "#videoModal", function(e) {
                var videoElement = $('.promo-video-popup').get(0);
                var playPromise = videoElement.pause();
            });
        });


        $("body").delegate(".switch_1", "change", function(e) {
            if ($(this).is(":checked")) {
                $('.toggle-bg').css('filter', 'unset')
                // Perform actions when the checkbox is checked
            } else {
                $('.toggle-bg').css('filter', 'blur(25px)').css('-webkit-backdrop-filter', 'blur(25px)')
                // Perform actions when the checkbox is unchecked
            }
        })
        {{-- task 86a1jvukt --}}
        $("body").delegate(".speak-box", "click", function(e) {
            window.location.href = "{{ url('/') }}/feature?type=employer";
        })
        {{-- task 86a1jvukt --}}
    </script>
@endsection
