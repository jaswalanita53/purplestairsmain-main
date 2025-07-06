<div >
    {{-- wire:poll.5s --}}
<style>
    @media (max-width: 1200px) {
    li.r-left.left-menu-one11 a {
        font-size: 10px !important;
    }
}
</style>
    <ul class="sidebar-tabs sidebar-tabs-show- text-center d-flex">
        <li class="r-left left-menu-one11"><a href="{{ route('company.requested') }}"
                class="{{ Route::is('company.requested') ? 'active' : '' }} left-menu-one ">
                <span class="sidebar-tabs-icon menu-icon"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                <em class="sidebar-tabs-text">Requested (<span class="req-count">{{ $requested_count }}</span>)</em>
            </a>

        </li>
        <li class="r-left left-menu-one11"><a href="{{ route('company.unmasked') }}"
                class="{{ Route::is('company.unmasked') ? 'active' : '' }} left-menu-one unmasked_icon">
                <span class="sidebar-tabs-icon icon-container menu-icon">
                    <img class="sidebar-tabs-icon" src="{{ asset('assets/be/images/new_dash_icon1.svg') }}"
                        alt="" height="14" width="20" />
                    {{-- <img class="sidebar-tabs-icon" src="{{ asset('assets/be/images/new_dash_icon-check-svg.svg') }}" alt="" /> --}}
                </span>
                <em class="sidebar-tabs-text">Unmasked (<span class="unm-count">{{ $unmasked_count }}</span>)
                    @if ($new_unmask_candidates)
                        <small style="font-size:10px;">NEW {{ $new_unmask_candidates }}</small>
                    @endif
                </em>
            </a>
        </li>
    </ul>
</div>
