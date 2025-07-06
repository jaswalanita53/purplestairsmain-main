<div>
    @if (Auth::user()->isPublished() && Auth::user()->isCandidate())
        <div class="mask-btn ms-btn">
            <a href="{{ route('candidates.requests') }}"><span class="emp-req-text d-md-inline d-none">Employer Requests</span><em class="ms-md-1 ms-0"><img
                        src="{{ asset('assets/fe/images/mask.png') }}" alt="" /></em>
                <sub>{{ Auth::user()->pending_unmask_request->count() }}</sub></a>
        </div>
    @endif
</div>
