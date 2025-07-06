<footer class="footer">
    <div class="ftr-top">
      <div class="container">
        <div class="ftr-hdr">
          <div class="ftr-logo">
            <a href="<?php echo e(route('welcome')); ?>"><img src="<?php echo e(asset("assets/fe/images/ftr-logo.svg")); ?>" alt="" /></a>
          </div>
          <div class="ftr-nav">
            <ul>

              <li>
                <a href="<?php echo e(route('faq')); ?>">FAQ </a>
              </li>
              <li>
                <a href="<?php echo e(route('contact')); ?>"> CONTACT US </a>
              </li>
              <li>
                <a href="/">TERMS</a>
              </li>
              <li>
                <a href="<?php echo e(route('privacy')); ?>">PRIVACY</a>
              </li>
              <li><a href="<?php echo e(route('login')); ?>">  Candidate login </a></li>
              <li><a href="<?php echo e(url('/employer/login')); ?>">  Employer Login</a></li>
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
              <p>© 2023 Purple Stairs</p>
              <span>Website by <a href="https://www.brand-right.com/" target="_blank"> BrandRight Marketing Group</a></span>
            </div>
          </div>

        </div>
      </div>
    </div>
  </footer>
<?php /**PATH /var/www/html/app/resources/views/inc/footer.blade.php ENDPATH**/ ?>