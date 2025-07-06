<div class="unmask-sec back-clr cmn-gap ban-up ban-up3 p-0">
    <style>
        table .odd {

            background: #f6f5f8 !important;

        }

        .showme {
            opacity: 0;
            transform: translateY(100%);
            transition: transform 0.5s, opacity 0.5s;
            position: absolute;
            left: 0;
            bottom: 0;
            right: 0;
            top: 0;
            visibility: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .opacity-05, .hoverme{
            position: relative;
        }

        .opacity-05:hover .hoverme {
            display:none;
        }

        .opacity-05:hover .showme {
          opacity: 1;
          transform: translateY(0);
          visibility: visible;
          position: relative;
          display: block;
        }
    </style>
    <div class="container" >
        <div class="height_ofunmask">
            <div class="height_ofunmask_inr p-0 m-0" >
                <div class="sec-hdr mt-5 pt-5" >
                <?php if(!$mode): ?>
                    <h1>You have <span><?php echo e(Auth::user()->pending_unmask_request->count()); ?> NEW</span> Employer Requests</h1>
                    <?php else: ?>
                    <h1 class="sec-hdr mb-3">Archive Requests</h1>
                    <?php endif; ?>
                </div>
                <?php if(!$mode): ?>
                <div class="noti-outr" data-id='6fdsaq#'>
                    <div class="notification">
                        <figure>
                            <img src="<?php echo e(asset('assets/fe/images/bell.svg')); ?>" alt="" />
                        </figure>
                        <p>

                            Below are employers who are requesting to view your fully unmasked profile. Press the unmask button located next to each request to provide a fully unmasked profile with ALL INFORMATION UNMASKED (FULLY SHOWN). Your profile will ONLY BE UNMASKED FOR THE REQUESTING COMPANY and will remain hidden to all others.
                        </p>
                    </div>
                </div>
                <?php endif; ?>
                <div class="unmask-table neww desktop-v" >
                    <div class="responsive-table" wire:ignore.self>
                        <table id="table_id" class="display" wire:ignore.self>
                            <thead>
                                <tr>


                                    <th data-orderable="false" class="sort2Action"> &nbsp;</th>

                                    <th data-orderable="true" class="sort2 sorting" aria-sort="descending">Date</th>
                                    <th data-orderable="false">Employer Requesting</th>
                                    <th data-orderable="false">Position Hiring</th>
                                    <th data-orderable="false">Message</th>
                                    <th data-orderable="false" class="sort2 allow-deny-icon">Allow/Deny Access</th>
                                    <th data-orderable="false">Current Status</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php $__currentLoopData = $unmaskRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $unmask): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <tr wire:key="<?php echo e($key); ?>" class="<?php echo e(($unmask->pivot->status == 2) ? 'opacity-05' : ''); ?>">

                                    <td>
                                        <?php if(!$mode): ?>
                                            <a href="#" wire:click="delete(<?php echo e($unmask->pivot->company_id); ?>)">
                                            <img src="<?php echo e(asset('assets/fe/images/dele.svg')); ?>" class="del-pic" alt="" /></a>
                                        <?php else: ?> 
                                            <a href="#" wire:click="restore(<?php echo e($unmask->pivot->company_id); ?>)">
                                            <img src="<?php echo e(asset('assets/fe/images/recover.svg')); ?>" class="del-pic" alt="" /></a>
                                        <?php endif; ?>
                                    </td>

                                    <td><?php if(!empty($unmask->pivot->created_at)): ?><?php echo e($unmask->pivot->created_at->format('m-d-Y')); ?> <?php endif; ?></td>
                                    <td>
                                        <a href="<?php echo e(route('company.viewprofile')); ?>?id=<?php echo e($unmask->user_id); ?>" class="stdio">
                                            <?php if(!empty(getUserById($unmask->user_id)->profile_photo_path)): ?>
                                            <img src="<?php echo e(asset(getUserById($unmask->user_id)->profile_photo_path)); ?>" alt="" class="rounded-circle"/>
                                            <?php else: ?>
                                            <img src="<?php echo e(asset('assets/fe/images/default_user.png')); ?>" alt="" />
                                            <?php endif; ?>
                                            <span><?php echo e($unmask->company_name); ?></span>
                                        </a>
                                    </td>
                                    <td>
                                        <p class="p1">
                                            <?php echo e($unmask->pivot->position_hiring); ?>

                                        </p>
                                    </td>
                                    <td>
                                        <p class="p2">
                                            <?php echo e($unmask->pivot->message); ?>&nbsp;
                                            <a data-fancybox data-src="#open<?php echo e($unmask->id); ?>" href="javascript:;" wire:click="viewNote(<?php echo e($unmask); ?>)">
                                                READ MORE
                                            </a>
                                        </p>
                                    </td>
                                    <td>
                                        <?php if($unmask->pivot->status == 0): ?>
                                        <a href="#" class="btn" wire:click="unmaskProfile(<?php echo e($unmask->pivot->company_id); ?>,1)">Unmask My Profile</a><br>
                                        <?php elseif($unmask->pivot->status == 1): ?>
                                        <a href="#" class="btn trans-btn" wire:click="unmaskProfile(<?php echo e($unmask->pivot->company_id); ?>,0)">Mask My Profile</a><br>
                                        <?php endif; ?>
                                        <a href="#" class="btn block-emp-btn mt-2 hoverme" <?php echo e(($unmask->pivot->status == 2) ? 'disabled' : ''); ?> <?php if($unmask->pivot->status != 2): ?>wire:click="unmaskProfile(<?php echo e($unmask->pivot->company_id); ?>,2)"<?php endif; ?>><?php echo e(($unmask->pivot->status == 2) ? 'Permanently Blocked' : 'Permanently Block Employer'); ?></a>

                                        <div class="showme">
                                            <a href="javascript:;" class="btn trans-btn" wire:click="unmaskProfile(<?php echo e($unmask->pivot->company_id); ?>,0)">Undo Block</a><br>
                                        </div>
                                    </td>
                                    <?php if($unmask->pivot->status == 0 || $unmask->pivot->status == 2): ?>
                                    <td><img src="<?php echo e(asset('assets/fe/images/ma1.svg')); ?>" alt="" class="mask" /></td>
                                    <?php endif; ?>
                                    <?php if($unmask->pivot->status == 1): ?>
                                    <td><img src="<?php echo e(asset('assets/fe/images/ma2.svg')); ?>" alt="" class="mask" /></td>
                                    <?php endif; ?>

                                </tr>
                                <div class="modal1">
                                    <div class="fancy-modal-body" id="open<?php echo e($unmask->id); ?>">
                                        <div class="modal-wrap text-center">
                                            <figure>
                                                <img src="<?php echo e(asset('assets/fe/images/chat.svg')); ?>" alt="" />
                                            </figure>
                                            <h4>Message From Requester</h4>
                                            <p>
                                                <?php echo e($unmask->pivot->message); ?>

                                            </p>
                                            <a href="<?php echo e(route('company.viewprofile')); ?>?id=<?php echo e($unmask->user_id); ?>">Message from: <?php echo e($unmask->company_name); ?></a>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="un-mob mobile-v">
                    <?php $__currentLoopData = $unmaskRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $unmask): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="unmask-mobile unmask-table">
                        <div class="unmask-mob-wrap">
                            <div class="unmask_quoted_sectn_new">
                                <div class="row unmask_quoted_sectn_new_row gy-3">
                                    <div class="col-7 lft">
                                        <a href="#url" class="studeio_sec_mbl">
                                            <span class="fig_img">
                                            <?php if(!empty(getUserById($unmask->user_id)->profile_photo_path)): ?>
                                            <img src="<?php echo e(asset(getUserById($unmask->user_id)->profile_photo_path)); ?>" alt="" class="rounded-circle"/>
                                            <?php else: ?>
                                            <img src="<?php echo e(asset('assets/fe/images/default_user.png')); ?>" alt="" />
                                            <?php endif; ?>
                                            </span>
                                            <span class="studeo_Sec_cnt"><?php echo e($unmask->company_name); ?></span>
                                        </a>
                                    </div>

                                    <div class="col-5 rtt">
                                        <?php if(!$mode): ?>
                                            <a href="#" wire:click="delete(<?php echo e($unmask->pivot->company_id); ?>)">
                                            <img src="<?php echo e(asset('assets/fe/images/dele.svg')); ?>" class="del-pic" alt="" /></a>
                                        <?php else: ?> 
                                            <a href="#" wire:click="restore(<?php echo e($unmask->pivot->company_id); ?>)">
                                            <img src="<?php echo e(asset('assets/fe/images/recover.svg')); ?>" class="del-pic" alt="" /></a>
                                        <?php endif; ?>
                                    </div>

                                    <div class="col-7 lft">
                                        <?php if($unmask->pivot->status == 0): ?>
                                        <a href="#" class="btn" wire:click="unmaskProfile(<?php echo e($unmask->pivot->company_id); ?>,1)">Unmask My Profile</a><br>
                                        <?php elseif($unmask->pivot->status == 1): ?>
                                        <a href="#" class="btn trans-btn" wire:click="unmaskProfile(<?php echo e($unmask->pivot->company_id); ?>,0)">Mask My Profile</a><br>
                                        <?php endif; ?>
                                    </div>

                                    <div class="col-5 rtt">
                                        <span class="date_part_qt"><?php if(!empty($unmask->pivot->created_at)): ?><?php echo e($unmask->pivot->created_at->format('m-d-Y')); ?> <?php endif; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <div class="delete-btn">

                    <?php if(!$mode): ?>
                    <a href="#" wire:click="$set('mode', true)"><em><img src="<?php echo e(asset('assets/fe/images/del2.svg')); ?>" alt="" /></em>Show Archived
                        Requests</a>
                    <?php else: ?>
                    <a href="#" wire:click="$set('mode', false)" class="activeRequests"><em><img src="<?php echo e(asset('assets/fe/images/mask.png')); ?>" alt=""></em>Show Active
                        Requests</a>
                    <?php endif; ?>

                </div>
            </div>
        </div>

        <div class="cmn-form-btm">
            <div class="ftr-btm-lft">
                <p>© 2023 Purple Stairs</p>
                <span>Website by
                    <a href="https://www.brand-right.com/" target="_blank">
                        BrandRight Marketing Group</a></span>
            </div>
        </div>
    </div>
</div>
<script>

    function sortTable(table, order) {
        var asc   = order === 'asc',
            tbody = table.find('tbody');

        tbody.find('tr').sort(function(a, b) {
            console.log($('td:nth-child(2)'), $('td:nth-child(2)', a));
            if (asc) {
                return $('td:nth-child(2)', a).text().localeCompare($('td:first', b).text());
            } else {
                return $('td:nth-child(2)', b).text().localeCompare($('td:first', a).text());
            }
        }).appendTo(tbody);
    }

    sortTable($('#table_id'), 'asc');

    $(document).on('click', '#table_id th.sorting', function(e){
        let odr = $(this).attr('aria-sort') == "descending" ? "desc" : "asc";
        alert(odr);
        sortTable($('#table_id'), odr);
    });

   /*window.addEventListener('initTable', event => {
    $('body').append('<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"><\/script>')
    var table = $('#table_id').DataTable();
    if ($.fn.DataTable.isDataTable('#table_id')) {
        //table.destroy(); dfgdfgdfgdfgdf // Destroy the existing DataTable instance
    }

    var tblInterval = setInterval(function () {
        if(!$.fn.DataTable.isDataTable('#table_id')) {
            clearInterval(tblInterval);
            // Initialize DataTable with date sorting options
            $('#table_id').dataTable({
                "language": {
                    "emptyTable": "There are currently no employer requests"
                },
                order: [[1, 'asc']],
                columnDefs: [
                    { type: 'date', targets: 1 } // Assuming column index 1 is the date column
                ]
            });
        }
    }, 250);
});*/

</script>
<?php /**PATH /var/www/html/app/resources/views/livewire/candidate-requests.blade.php ENDPATH**/ ?>