<footer class="footer">
    <div class="ftr-top">
      <div class="container">
        <div class="ftr-hdr">
          <div class="ftr-logo">
            <a href="{{route('welcome')}}"><img src="{{asset("assets/fe/images/ftr-logo.svg")}}" alt="" /></a>
          </div>
          <div class="ftr-nav">
            <ul>

              {{-- <li>
                <a href="{{route('faq')}}">FAQ </a>
              </li> --}}
              <li>
                <a href="{{route('contact')}}"> CONTACT US </a>
              </li>
              <li>
                <a href="{{route('terms')}}">TERMS</a>
              </li>
              <li>
                <a href="{{route('privacy')}}">PRIVACY</a>
              </li>
              <li><a href="{{route('login')}}">  Candidate login </a></li>
              <li><a href="{{url('/employer/login')}}">  Employer Login</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="ftr-btm">
      <div class="container">
        <div class="row align-items-center justify-content-between">
          <div class="col-md-12">
            <div class="ftr-btm-lft">
              <p>© 2024 Purple Stairs</p>
              <span>Website by <a href="https://www.brand-right.com/" target="_blank"> BrandRight Marketing Group</a></span>
            </div>
          </div>

        </div>
      </div>
    </div>
  </footer>
