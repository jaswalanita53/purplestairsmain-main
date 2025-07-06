<?php $__env->startSection('content'); ?>
    <div class="login-sec sign-up log-h-sec ban-up ban-up2 ht_center_div">
        <div class="login-sec-wrap">
            <div class="container">
                <div class="log-wrap log-wrap2" style="background-image: url(assets/fe/images/log-back2.png)">
                    <div class="login-outr">
                        <h2>Hello!</h2>
                        <p class="blk-p">Get started by creating an account.</p>
                        <form>
                            <div class="form-input sn-up">
                                <input value="I AM A CANDIDATE" class="sub-btn sub2" />
                            </div>
                            <div class="form-input sn-up">
                                <input type="submit" value="I AM AN EMPLOYER" class="sub-btn sub3" />
                            </div>
                        </form>
                        <div class="not-acnt">
                            <p>Already have an account? <a href="<?php echo e(route('login')); ?>">Login</a></p>
                        </div>
                    </div>
                    <img src="<?php echo e(asset('assets/fe/images/log1.png')); ?>" alt="" class="mobile-v log1 log12">
                    <img src="<?php echo e(asset('assets/fe/images/log2.png')); ?>" alt="" class="mobile-v log2 log21">
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
        $(".sub2").click(function(e) {
            var usr_type = createSlug(e.target.value);
            e.preventDefault();
            location.replace('/register?usr_type=' + usr_type);
        });

        $(".sub3").click(function(e) {
            e.preventDefault();
            location.replace('/employer/login');
        });

        function createSlug(str) {
            str = str.replace(/^\s+|\s+$/g, ''); // trim
            str = str.toLowerCase();

            // remove accents, swap ñ for n, etc
            var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
            var to = "aaaaeeeeiiiioooouuuunc------";
            for (var i = 0, l = from.length; i < l; i++) {
                str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
            }

            str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
                .replace(/\s+/g, '-') // collapse whitespace and replace by -
                .replace(/-+/g, '-'); // collapse dashes

            return str;
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/pages/singupselect.blade.php ENDPATH**/ ?>