@extends('layouts.app')
@section('content')
<section class="heightof_section">
    <section class="banner-sec inner-banner ban-up">
      <div class="container">
        <div class="banner-outr">
          <div class="row align-items-center ">
            <div class="col-md-6">
              <div class="ban-lft">
                <div class="ban-hdr">
                  <h1>Frequently asked <span>Questions </span></h1>
                  <img src="{{asset('assets/fe/images/pic1.svg')}}" alt="" class="pic1 ">
                </div>


              </div>
            </div>
            <div class="col-md-6 bn-md2">
              <div class="ban-rgt ">
                <figure>
                  <img src="{{asset('assets/fe/images/fq-ban.png')}}" alt="" class="ban-dsng"/>
                </figure>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <div class="aqaud-sec cmn-gap">
        <div class="container">
            <div class="accor-wrap">
                <div class="accordion" id="accordionExample">
                   <div class="accordion-item">
                     <h2 class="accordion-header" id="headingOne">
                       <button class="accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                        Why was Purple Stairs Created?
                       </button>
                     </h2>
                     <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                       <div class="accordion-body">
                        <p>Acutely aware of recurring issues that discourage sought-after talent from seeking new opportunities, Purple Stairs transforms the traditional hiring approach into something better. Intent on overhauling the system, we present state-of-the-art options to counter the challenges, while simplifying the entire process.  </p>
                       </div>
                     </div>
                   </div>
                   <div class="accordion-item">
                     <h2 class="accordion-header" id="headingTwo">
                       <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Why would a candidate post their profile on Purple Stairs?
                       </button>
                     </h2>
                     <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample" style="">
                       <div class="accordion-body">
                           <p>Purple Stairs uses an advanced process by incorporating a safety feature into its software to enable candidates to block information they do not wish to share. Candidates can hide their identity, place of employment and other details until they are comfortable sharing it with specific employers. Moreover, our focus in accentuating both hard and soft skills as well as job preferences, unleashes career opportunities candidates never would have been considered for. </p>
                       </div>
                     </div>
                   </div>
                   <div class="accordion-item">
                     <h2 class="accordion-header" id="headingThree">
                       <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        What type of candidate is your platform geared towards?
                       </button>
                     </h2>
                     <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                       <div class="accordion-body">
                           <p>Our platform was created for every type of candidate. Our innovative safety-feature enables currently employed individuals to list on our site as well. </p>
                       </div>
                     </div>
                   </div>

                     <div class="accordion-item">
                       <h2 class="accordion-header" id="headingFive">
                         <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                          Why did you choose Purple Stairs as the name of your company?
                         </button>
                       </h2>
                       <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                         <div class="accordion-body">
                             <p>Purple Stairs is not just a cookie-cutter, black-and-white job board. We’re a revolution in the industry, designed as a staircase to advancement, elevating you to the next rungs of your career. </p>
                         </div>
                       </div>
                     </div>
                     <div class="accordion-item">
                       <h2 class="accordion-header" id="headingSix">
                         <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                          How does a hiring employer access masked information about a potential candidate?
                         </button>
                       </h2>
                       <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample">
                         <div class="accordion-body">
                             <p>While every candidate has control over masking certain information, a hiring employer can submit a request for unmasked access. Once the request is granted by the candidate and the information is unmasked to that employer, the candidate has the ability to remask at any time. </p>
                         </div>
                       </div>
                     </div>
                     <div class="accordion-item">
                       <h2 class="accordion-header" id="headingSeven">
                         <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                          What end-results can clients on both ends of the hiring spectrum expect to achieve?
                         </button>
                       </h2>
                       <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#accordionExample">
                         <div class="accordion-body">
                             <p>In a class of its own, our process ensures a safe, smooth, streamlined route to exceptional hiring, presenting opportunities that significantly grow businesses and advance careers.  </p>
                         </div>
                       </div>
                     </div>



                 </div>
            </div>
        </div>
    </div>
  </section>

@endsection
