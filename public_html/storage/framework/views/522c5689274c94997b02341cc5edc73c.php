                <ul>
                    <li class="<?php echo e($step == 1 ? 'active center' : ''); ?>">
                        <a href="<?php echo e(url('/candidate/personal-information')); ?>">
                        <div class="outr-points">
                            <div class="point-wrap"><span>1</span></div>
                            <h5>
                                    Personal Information
                                </h5>
                        </div>
                        </a>
                    </li>
                    <li class="<?php echo e($step == 2 ? 'active center' : ''); ?>">
                        <a href="<?php echo e(url('/candidate/position-preferences')); ?>">
                        <div class="outr-points">
                            <div class="point-wrap"><span>2</span></div>
                            <h5>Preferences</h5>
                        </div>
                        </a>
                    </li>

                    <li class="<?php echo e($step == 3 || $step == 4 || $step == 5 ? 'active center' : ''); ?>">
                        
                        <a href="<?php echo e(url('/candidate/education')); ?>">
                        <div class="outr-points">
                            <div class="point-wrap"><span>3</span></div>
                            <h5>Employment</h5>
                        </div>
                        </a>
                    </li>
                    <li class="<?php echo e($step == 6 ? 'active center' : ''); ?>">
                        <a href="<?php echo e(url('/candidate/skills')); ?>">
                        <div class="outr-points">
                            <div class="point-wrap"><span>4</span></div>
                            <h5>Skills</h5>
                        </div>
                        </a>
                    </li>
                    <li class="<?php echo e($step == 7 ? 'active center' : ''); ?>">
                        <a href="<?php echo e(url('/candidate/references')); ?>">
                        <div class="outr-points">
                            <div class="point-wrap"><span>5</span></div>
                            <h5>References</h5>
                        </div>
                        </a>
                    </li>
                    <li class="<?php echo e($step == 9 ? 'active center' : ''); ?>">
                        <a href="<?php echo e(url('/candidate/approval')); ?>">
                        <div class="outr-points">
                            <div class="point-wrap"><span>6</span></div>
                            <h5>Approval</h5>
                        </div>
                        </a>
                    </li>
                </ul>
<?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/inc/steps.blade.php ENDPATH**/ ?>