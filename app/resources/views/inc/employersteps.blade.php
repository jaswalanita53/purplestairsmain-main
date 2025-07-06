<ul class="justify-content-center">
    <li class="{{$step == 1 ? 'active center' : ''}}">
    <a href="{{ url('/company/contact-info')}}">
      <div class="outr-points">
        <div class="point-wrap"><span style="background: {{ $current_step < $step && $step > 1 ? 'rgba(229, 220, 237)' : '' }};">1</span></div>
        <h5>Create Account</h5>
      </div>
    </a>
    </li>
    <li class="{{$step == 2 ? 'active center' : ''}}">
    <a href="{{ url('/company/company-info')}}">
      <div class="outr-points">
        <div class="point-wrap"><span style="background: {{ $current_step < $step && $step > 2 ? 'rgba(229, 220, 237)' : '' }};">2</span></div>
        <h5>Add Profile</h5>
      </div>
    </a>
    </li>
    <li class="{{$step == 3 ? 'active center' : ''}}">
      <a href="{{ url('/company/choose-plan')}}">
      <div class="outr-points">
        <div class="point-wrap"><span style="background: {{ $current_step < $step && $step > 3 ? 'rgba(229, 220, 237)' : '' }};">3</span></div>
        <h5>Choose Plan</h5>
      </div>
      </a>
    </li>
    <li class="{{$step == 4 ? 'active center' : ''}}">
      <div class="outr-points">
        <div class="point-wrap" ><span style="background: {{ $current_step < $step && $step > 4 ? 'rgba(229, 220, 237)' : '' }};">4</span></div>
        <h5>Payment</h5>
      </div>
    </li>
    {{-- task - 862k30j2e <li class="{{$step == 5 ? 'active center' : ''}}">
    <a href="{{ url('/company/review')}}">
      <div class="outr-points">
        <div class="point-wrap"><span style="background: {{ $current_step < $step && $step > 5 ? 'rgba(229, 220, 237)' : '' }};">5</span></div>
        <h5>Preview Profile</h5>
      </div>
    </a>
    </li> --}}
  </ul>
