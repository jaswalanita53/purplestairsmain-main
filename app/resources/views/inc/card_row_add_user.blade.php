<div class="row mt-3 px-3 custom-check">
    <div class="col-10 p-0">
        <div class="card-info py-3">
            <div class="row">
                <div class="col-1">
                    <span class="card-num">
                        <!-- <img src="{{asset('assets/fe/images/credit.svg')}}" alt=""> -->
                    </span>
                </div>
                <div class="col-2">
                    <span class="card-num">xxxx</span>
                </div>
                <div class="col-2">
                    <span class="card-num">xxxx</span>
                </div>
                <div class="col-2">
                    <span class="card-num">xxxx</span>
                </div>
                <div class="col-2">
                    <span class="card-num">{{ substr($cc['card_number'],-4)  }}</span>
                </div>
                {{-- <div class="col-2">
                    @if(count($cards) > 1)
                    <span class="card-num delete-icon-info" wire:click="removeCard({{$cc['id']}})"><i class="fa fa-trash float-right" aria-hidden="true"></i></span>
                    @endif
                </div> --}}
            </div>
        </div>
    </div>
    <div class="col-2 d-flex align-items-center">
        <div class="form-check p-0">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault-{{$cc['id']}}" {{ $cc['active'] ? 'checked' : '' }} {{ count($cards) <= 1 ? 'disabled' : '' }} wire:change="updateDeaultCard({{$cc['id']}}, {{$cc['active']}})"/>
        </div>
    </div>
</div>
