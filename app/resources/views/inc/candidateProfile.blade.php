@if(!empty($candidate->id))
<div id="{{$candidate->id}}">
<style>

.cpi{
  height: 100vh;
}
.popup-prof-cut span{
  color:var(--purple);
  font-size: 28px;
}
.popup-prof-cut{
  text-align: right;
  /* margin-right: 13%; */
  opacity: 1 !important;
  /* position: fixed; */
  top: 20px;
  right: 0%;
  z-index: 99;
}
.arrow-box {
    top: calc(50% - 24px);
}
button.close.popup-prof-cut {
    float: none;
    position: absolute;
    right: 20px;
    top: 10px;
}

</style>
{{-- @if(!empty($candidate->id)) data-id={{$candidate->id}} @else data-id="" @endif --}}
<div data-id="{{$candidate->id}}" class=" modal not_in_searches- fade condidate-profile-modal exampleModalToggle{{$candidate->id}}" aria-hidden="true" aria-label="exampleModalToggleLabel2" @if(!empty($candidate->id)) data-id={{$candidate->id}} @else data-id="" @endif tabindex="-1" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered modal-fullscreen- modal-xl">


        <div class="modal-content">
            <button type="button" class="close popup-prof-cut" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <div class="modal-body p-1 d-flex">

            <div class="position-absolute start-0 arrow-box"> <a href="javascript:void(0)" class="eyeball22 left-arrow px-4" data-id="{{$candidate->id}}"><i class="fa fa-chevron-left" aria-hidden="true"></i></a></div>

            <iframe id="" class="cpi cpi{{$candidate->id}}" src="{{url('/')}}/company/candidate/profile/{{ $candidate->id }}" frameborder="0" height="100%" width="100%" onload='hideHeader("{{$candidate->id }}")'></iframe>

                <div class=" position-absolute end-0 arrow-box"><a href="javascript:void(0)" class="eyeball22 px-4 right-arrow" data-id=""><i class="fa fa-chevron-right" aria-hidden="true"></i></a></div>
            </div>

        </div>


    </div>
</div>
</div>
@endif


