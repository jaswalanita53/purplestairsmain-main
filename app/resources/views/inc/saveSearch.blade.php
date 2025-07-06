<div class="modal fade" id="saveSearchModal" aria-hidden="true" aria-label="exampleModalToggleLabel2"
    tabindex="-1" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header name-this-search-head">
            <h5 class="modal-title">Name This Search</h5>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <span class="color-primary save-search-info">Access your search later and receive notifications when new matching candidates upload their profiles to Purple Stairs.</span>
            <div class="">
                <div class="cmn-form">
                        <div class="form-sec gl-form pt-0 pb-4 px-4">
                            <form wire:submit.prevent="saveSearch()" id="save-search-form">
                                <div class="row">
                                    <div class="col-md-12 p-0">
                                        <div class="gl-frm-outr mb-0">
                                            <div class="form-group">
                                                <input type="text" placeholder="" class="form-control search-name" wire:model.defer="search_name" wire:ignore/>

                                                @include('inc.error', [
                                                    'field_name' => 'search_name',
                                                ])

                                                <span id="search_name_error" style="color: red;"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-submit-btn mb-0 mt-2">
                                    <input type="submit" value="Save" class="submit-btn savesearchbtn"/>
                                    {{-- <input type="submit" value="Save" class="submit-btn savesearchbtn" wire:loading.remove wire:target="saveSearch"/>
                                    <input type="button" value="Saving..." class="submit-btn" wire:loading wire:target="saveSearch"/> --}}
                                </div>
                           </form>
                        </div>
                </div>
                </div>

        </div>
    </div>
</div>
