<div>
    <section class="profile-banner cmn-gap pb-0 ban-up ">
        <div class="container">
          <div class="form-points">
            @php
            $step = 0;$current_step = auth()->user()->current_step;
            @endphp
            @include('inc.steps',compact('step', 'current_step'))
          </div>
          <div class="profile-outr">
            <span>CHOOSE ONE OF OUR THREE OPTIONS</span>
            <h1 class="mt-3">
              How Will You Upload <br />
              Your Resume Information?
            </h1>

            <img src="{{asset('assets/fe/images/pr-b1.svg')}}" alt="" class="pic6" />
             <div class="skop_text_wrppt">
                <!-- <a href="{{route('candidatestep4')}}" class="skip new"
                >Skip <em><img src="{{asset('assets/fe/images/skip-arrw.svg')}}" alt="" /></em
              ></a> -->

              <a href="{{route('candidatestep2')}}" class="back-btn-yellow skip"
                >
                <em class="margin-right-25px"><img src="{{asset('assets/fe/images/prev.svg')}}" alt="" /></em
              >
                Back

              </a>
            </div>
          </div>
        </div>
      </section>

      <div class="manual-sec cmn-gap pt-0">
        <div class="container">
          <div class="mainual-outr">
            <ul class="m-list">
              <li class="m-list-li">
                <div class="manual-inr" wire:click="updateUploadType('file')">
                  <figure>
                    <img src="{{asset('assets/fe/images/cd1.svg')}}" alt="" />
                  </figure>
                  <div class="manual-btm-resume">
                    <div class="customfile_input_resume">
                      <span class="customfile_label_resume"
                        >Upload Resume <em>(.pdf or .doc)</em></span
                      >
                    </div>
                  </div>
                </div>
              </li>
              <li class="m-list-li" wire:click="updateUploadType('manual')">
                <div class="manual-inr">
                  <figure>
                    <img src="{{asset('assets/fe/images/cd2.svg')}}" alt="" />
                  </figure>
                  <div class="manual-btm-manually">
                    <span>Enter Info Manually</span>
                  </div>
                </div>
              </li>
              <li class="m-list-li" wire:click="updateUploadType('linkedin')">
                <div class="manual-inr">
                  <figure>
                    <img src="{{asset('assets/fe/images/cd3.svg')}}" alt="" />
                  </figure>
                  <div class="manual-btm-linkedin">
                    <span>Import Via Linkedin</span>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <section class="resume-sec cmn-gap">
        <div class="container">
          <div class="resume-outr">
            @if($upload_type == 'file')
            <h4>Upload your Resume here</h4>
            <p>Any .pdf or .doc file is upload-acceptable on our platform.</p>
            <div class="resume-inr">
              <figure>
                <img src="{{asset('assets/fe/images/r1.svg')}}" alt="" />
              </figure>
              <h5>Drag and Drop Your Resume</h5>
              <div class="resume-warning">
                <span><img src="{{asset('assets/fe/images/warning.svg')}}" alt="" /></span>
                <p>
                  Our automated software rips information from your file,
                  resulting in a profile that may not be 100% accurate. Your
                  review is required to ensure the best possible results.
                </p>
              </div>
              @if($resume_path)
              <div class="text-center mt-2">
                  <embed src="{{asset($resume_path)}}" type="">
              </div>
              @endif
              <div class="up-btn-center">
                <div class="manual-btm-btn">
                  <div class="customfile_input2">
                    <input type="file" id="myfile2" class="customfile_inputin2" wire:model.lazy="resume"/>
                    <span class="customfile_label2">Upload Resume</span>
                  </div>
                </div>
              </div>
            </div>
            @elseif ($upload_type == 'linkedin')
            <form>
              <div class="resume-form">
                <div class="row align-items-end">
                  <div class="col-lg-10">
                    <div class="form-group">
                      <label>LinkedIn URL</label>
                      <input
                        type="url"
                        placeholder="Linkedin url"
                        class="form-control"
                      />
                    </div>
                  </div>
                  <div class="col-lg-2">
                    <div class="import-btn">
                      <input
                        type="submit"
                        value="Import Profile"
                        class="imp-btn"
                      />
                    </div>
                  </div>
                </div>
                <div class="whole-btn-wrap dual-btn">
                  <input type="submit" value="Go Back" class="prev-btn" />
                  <input type="submit" value="Next" class="nxt-btn"/>
                </div>
              </div>
            </form>
            @else
            @endif
          </div>
        </div>
      </section>
</div>

@push('scripts')
<script>
    $(".prev-btn").click(function(e) {
        e.preventDefault();
        // location.replace('/candidate/position-preferences')
        window.location.href='{{url("/candidate/position-preferences")}}';
    })
    $(".nxt-btn").click(function(e) {
        e.preventDefault();
        // location.replace('/candidate/education')
        window.location.href='{{url("/candidate/education")}}';
    })
</script>
@endpush
