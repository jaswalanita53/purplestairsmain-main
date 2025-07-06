                <ul>

                    <li class="<?php echo e($step == 1 ? 'active center' : ''); ?>">

                        <a href="<?php if(Auth::user()->step_reached>=1): ?> <?php echo e(url('/candidate/personal-information')); ?> <?php endif; ?>">
                        <div class="outr-points">
                            <div class="point-wrap"><span style="background: <?php echo e(($current_step < $step && $step > 1) || $step == 0 ? 'rgba(229, 220, 237)' : ''); ?>;">1</span></div>
                            <h5>
                                    Personal Information
                                </h5>
                        </div>
                        </a>
                    </li>
                    <li class="<?php echo e($step == 2 ? 'active center' : ''); ?>">
                        <a href="<?php if(Auth::user()->step_reached>=2): ?> <?php echo e(url('/candidate/position-preferences')); ?> <?php endif; ?>">
                        <div class="outr-points">
                            <div class="point-wrap"><span style="background: <?php echo e(($current_step < $step && $step > 2) || $step == 0 ? 'rgba(229, 220, 237)' : ''); ?>;">2</span></div>
                            <h5>Preferences</h5>
                        </div>
                        </a>
                    </li>

                    <li class="<?php echo e($step == 3 || $step == 4 || $step == 5 || $step == 0 ? 'active center' : ''); ?>">
                        
                        <a href="<?php if(Auth::user()->step_reached>=3 || Auth::user()->step_reached>=4 || Auth::user()->step_reached>=5): ?> <?php echo e(url('/candidate/education')); ?> <?php endif; ?>">
                        <div class="outr-points">
                            <div class="point-wrap"><span style="background: <?php echo e($current_step < $step && $step > 5 ? 'rgba(229, 220, 237)' : ''); ?>;">3</span></div>
                            <h5>Education & Employment</h5>
                        </div>
                        </a>
                    </li>
                    <li class="<?php echo e($step == 6 ? 'active center' : ''); ?>">
                        <a href="<?php if($step == 5): ?> javascript:void(0); <?php else: ?> <?php if(Auth::user()->step_reached>=6): ?> <?php echo e(url('/candidate/skills')); ?> <?php else: ?> javascript:void(0);<?php endif; ?> <?php endif; ?>">
                        <div class="outr-points">
                            <div class="point-wrap <?php if($step == 5): ?> skills-step-btn <?php endif; ?>"><span style="background: <?php echo e($current_step < $step && $step > 6 ? 'rgba(229, 220, 237)' : ''); ?>;">4</span></div>
                            <h5>Skills</h5>
                        </div>
                        </a>
                    </li>
                    <li class="<?php echo e($step == 7 || $step == 8 ? 'active center' : ''); ?>">
                        <a href=" <?php if(Auth::user()->step_reached>=7 || Auth::user()->step_reached>=8): ?> <?php echo e(url('/candidate/references')); ?> <?php endif; ?>">
                        <div class="outr-points">
                            <div class="point-wrap"><span style="background: <?php echo e($current_step < $step && $step > 8 ? 'rgba(229, 220, 237)' : ''); ?>;">5</span></div>
                            <h5>References
& About Me</h5>
                        </div>
                        </a>
                    </li>
                    <li class="<?php echo e($step == 9 ? 'active center' : ''); ?>">
                        <a href="<?php if(Auth::user()->step_reached>=9): ?> <?php echo e(url('/candidate/approval')); ?> <?php endif; ?>">
                        <div class="outr-points">
                            <div class="point-wrap"><span style="background: <?php echo e($current_step < $step && $step > 9 ? 'rgba(229, 220, 237)' : ''); ?>;">6</span></div>
                            <h5>Approval</h5>
                        </div>
                        </a>
                    </li>
                </ul>
<?php /**PATH /var/www/html/app/resources/views/inc/steps.blade.php ENDPATH**/ ?>