<div>
<section class="banner-sec inner-banner con-inr ban-up">
    <div class="container">
      <div class="banner-outr">
        <div class="row align-items-center">
          <div class="col-sm-6 pr-col">
            <div class="ban-lft">
              <div class="ban-hdr">
                <h1>
                  Contact <br />
                  <span><em> US </em></span>
                </h1>
                <img src="<?php echo e(asset('assets/fe/images/pic2.svg')); ?>" alt="" class="pic1 des" />
              </div>
            </div>
          </div>
          <div class="col-sm-6  pr-col2">
            <div class="ban-rgt">
              <figure>
                <img src="<?php echo e(asset('assets/fe/images/con-bck.png')); ?>" alt="" class="ban-dsng desktop-v"/>
                <img src="<?php echo e(asset('assets/fe/images/con-mob.png')); ?>" alt="" class="ban-dsng mobile-v">
              </figure>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="contact-sec cmn-gap pt-0">
    <div class="container">
        <div>
            
        </div>
      <div class="contact-outr">
        <div class="contact-top">
          <ul>
            <li>
              <div class="cont-top-lft">
                <span>Phone Number</span>
                <a href="tel:7323720404">(732) 372-0404</a>
              </div>
              <figure>
                <img src="<?php echo e(asset('assets/fe/images/con1.svg')); ?>" alt="" />
              </figure>
            </li>
            <li>
              <div class="cont-top-lft">
                <span>Email Address</span>
                <a href="mailto:info@purplestairs.com"
                  >info@purplestairs.com</a
                >
              </div>
              <figure>
                <img src="<?php echo e(asset('assets/fe/images/con2.png')); ?>" alt="" />
              </figure>
            </li>
          </ul>
        </div>
        <div class="contact-form">
          <form wire:submit.prevent="saveContact()">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Name*</label>
                  <input
                    type="text"
                    placeholder=""
                    class="form-control2"
                    wire:model.lazy="name"
                  />
                  <?php echo $__env->make('inc.error', [
                    'field_name' => 'name',
                  ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Email*</label>
                  <input
                    type="email"
                    placeholder=""
                    class="form-control2"
                    wire:model.lazy="email"
                  />
                  <?php echo $__env->make('inc.error', [
                    'field_name' => 'email',
                  ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Phone Number</label>
                  <input
                    type="text"
                    placeholder=""
                    class="form-control2 telle"
                    wire:model.lazy="phone_number"
                    maxlength="12"
                    

                  />
                  <?php echo $__env->make('inc.error', [
                    'field_name' => 'phone_number',
                  ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Subject</label>
                  <input
                    type="text"
                    placeholder=""
                    class="form-control2"
                    wire:model.lazy="subject"
                  />
                  <?php echo $__env->make('inc.error', [
                    'field_name' => 'subject',
                  ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-wrap">
                  <div class="form-group">
                    <label>Message</label>
                    <textarea placeholder=""
                    wire:model.lazy="message"
                    ></textarea>
                    <?php echo $__env->make('inc.error', [
                        'field_name' => 'message',
                      ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                  </div>

                  <div class="submit-inn">
                    <input type="submit" class="sub-btn"/>
                  </div>
                </div>
              </div>

            </div>
          </form>
          <?php if(session()->has('message')): ?>
              <p class="color-primary">
                    <?php echo e(session('message')); ?>

                </p>

            <?php endif; ?>
        </div>


        <img src="<?php echo e(asset('assets/fe/images/cin1.png')); ?>" alt="" class="c-desng1">
        <img src="<?php echo e(asset('assets/fe/images/cin2.png')); ?>" alt="" class="c-desng2">
      </div>
    </div>
  </div>
</div>

<script>
    
            $("body").delegate(".telle", "input", function(e) {
                  var v = $(this).val().replace(/\D/g, ''); // Remove non-numerics
                  if(v.length<10){
                  v = v.replace(/(\d{3})(?=\d)/g, '$1-'); // Add dashes every 4th digit
                  $(this).val(v)
                  }
                  v = v.replace(/(\d{3})(\d{3})(\d{4})/, "$1-$2-$3"); // Add dashes every 4th digit
                  $(this).val(v.substr(0, 12))
            });
            $("body").delegate(".telle", "keypress", function(e) {
            var v = $(this).val(); // Remove non-numerics
                  if(v.length>12){
                return false;
                  }

            });
</script>
<?php /**PATH /var/www/html/app/resources/views/livewire/contact.blade.php ENDPATH**/ ?>