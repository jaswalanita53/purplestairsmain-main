<div class="modal fade" id="saveSearchModal" aria-hidden="true" aria-label="exampleModalToggleLabel2"
    tabindex="-1" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Name This Search</h5>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div class="cmn-form">
                        <div class="form-sec gl-form">
                            <form wire:submit.prevent="saveSearch()">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="gl-frm-outr mb-0">
                                            <div class="form-group">
                                                <input type="text" placeholder="" class="form-control"
                                                    wire:model.lazy="search_name" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-submit-btn mb-0 mt-2">
                                    <input type="submit" value="Save" class="submit-btn" wire:loading.remove wire:target="saveSearch"/>
                                    <input type="button" value="Saving..." class="submit-btn" wire:loading wire:target="saveSearch"/>
                                </div>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/customer/www/demo.purplestairs.com/app/resources/views/inc/saveSearch.blade.php ENDPATH**/ ?>