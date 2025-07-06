<?php $__env->startSection('content'); ?>
<style>
    /* .mission-sec-toggle .toggle-switch-block>span:last-child {
        order: 1 !important;
    }

    .mission-sec-toggle .toggle-switch-block>span:first-child {
        order: 0 !important;
    } */
    .mission-0-text{
  color: #ffae1a !important;
}
</style>
<section class="banner-sec inner-banner ban-up new_bnr_pdg">
    <div class="container">
        <div class="banner-outr msn-outr">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="ban-msn-lft">
                        <div class="ban-hdr">
                            <h1>
                                Our <br>
                                <span><em >Mission</em> </span>
                            </h1>
                            <p class="blk-p">
                                Inspired by a pressing need, Purple Stairs uses a progressive method that matches talent with untapped opportunity.
                            </p>
                        </div>

                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="ban-rgt">
                        <figure>
                            <img src="<?php echo e(asset("assets/fe/images/msn-back.png")); ?>" alt="" />
                        </figure>
                        <div class="m-lft">
                            <div class="sec-hdr">
                                <span>windows of growth</span>
                                <h2>Unprecedented <br> Career Opportunity</h2>
                            </div>
                            <p>
                                Purple Stairs knows about and understands candidates’ and hiring employers’ challenges. Presenting a different approach, we empower both sides of the hiring spectrum with all-empowering solutions.
                            </p>
                            <!-- <a href="#" class="btn">Get Started</a> -->
                        </div>
                    </div>
                </div>
            </div>
            <img src="<?php echo e(asset("assets/fe/images/msn1.png")); ?>" alt="" class="pic8">
        </div>
    </div>
</section>

<section class="mission-sec mission-sec-toggle cmn-gap">
    <div class="container">
        <div class="logo-btm pt-0">
            <div class="row align-items-center">
                <div class="col-md-5">
                    <div class="m-lft">
                        <div class="sec-hdr">
                            <span>ENTER PURPLE STAIRS</span>
                            <h2>Passionate about addressing those problems...</h2>
                        </div>
                        <p>
                        …we developed a viable solution. Utilizing cutting-edge technology, we created a feature which hides sensitive information upon the candidate’s discretion and highlights factors that really matter: years of experience, actual skills, fluency in languages, and more.
                        </p>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="msn-wrap">
                        <figure><img src="<?php echo e(asset("assets/fe/images/m-bck.png")); ?>" alt="" class="desktop-v" /></figure>

                        <div class="m-rgt m-rgt-w">
                            <form>
                                <div class="form-group">
                                    <input type="text" placeholder="Name" class="form-control" />
                                    <div class="toggle-switch-block">
                                        <span>show</span>
                                        <div class="switch_box box_1">
                                            <input type="checkbox" class="switch_1" />
                                        </div>
                                        <span>Hide</span>
                                    </div>
                                    
                                </div>
                                <div class="form-group">
                                    <input type="text" placeholder="Current Title" class="form-control" />
                                    <div class="toggle-switch-block">
                                        <span>show</span>
                                        <div class="switch_box box_1">
                                            <input type="checkbox" class="switch_1" checked="" />
                                        </div>
                                        <span>Hide</span>
                                    </div>
                                    
                                </div>
                                <div class="form-group">
                                    <input type="text" placeholder="Company of Employment" class="form-control" />
                                    <div class="toggle-switch-block">
                                        <span>show</span>
                                        <div class="switch_box box_1">
                                            <input type="checkbox" class="switch_1" />
                                        </div>
                                        <span>Hide</span>
                                    </div>
                                    
                                </div>
                                <div class="form-group">
                                    <input type="text" placeholder="Education" class="form-control" />
                                    <div class="toggle-switch-block">
                                        <span>show</span>
                                        <div class="switch_box box_1">
                                            <input type="checkbox" class="switch_1" checked="" />
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
</section>

<div class="talent-sec cmn-gap">
    <div class="container">
        <div class="talent-outr text-center">
            <span class="mission-0-text">A GROUNDBREAKING PROCESS</span>
            <h2>A Tailored Solution</h2>
            <p>
                Our process is easy, built on an efficient and effective response <br>
                to hiring companies and job-seeking candidates.
            </p>
            <div class="talnt-btm-wrap">
             
                <a href="<?php echo e(url('/')); ?>/signup-candidate" class="ylw-btn">Become A Candidate</a>
                <a href="<?php echo e(url('/')); ?>/employer/signup" class="btn">Find Fresh Talent</a>
            </div>
        </div>
    </div>
    <img src="<?php echo e(asset("assets/fe/images/pic4.svg")); ?>" alt="" class="pic2" />
    <img src="<?php echo e(asset("assets/fe/images/pic5.svg")); ?>" alt="" class="pic3" />
</div>


<script>
    $("body").delegate(".switch_1", "change", function(e) {

        if ($(this).is(":checked")) {
            $(this).parents('.form-group').find('.show-text').removeClass('show')
            // Perform actions when the checkbox is checked
        } else {
            $(this).parents('.form-group').find('.show-text').addClass('show')
            // Perform actions when the checkbox is unchecked
        }
    })
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/admin-5/Sites/purplestairsmain/app/resources/views/pages/mission.blade.php ENDPATH**/ ?>