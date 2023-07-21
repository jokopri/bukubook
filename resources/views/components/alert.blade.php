<div>
    {{-- Alert --}}
    @if (session('success'))
    <div class="alert alert-success mb-3 alert-dismissible fade show" role="alert">
        {{ session('success')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @elseif (session('error'))
    <div class="alert alert-danger mb-3 alert-dismissible fade show" role="alert">
        {{ session('error')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
</div>
