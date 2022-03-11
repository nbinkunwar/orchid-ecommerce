@push('head')
    <meta name="robots" content="noindex" />
    <link
          href="{{ asset('/admin/images/logo.png') }}"
          sizes="any"
          type="image/png"
          id="favicon"
          rel="icon"
    >

    <!-- For Safari on iOS -->
    <meta name="theme-color" content="#21252a">
@endpush

<div class="h2 fw-light d-flex align-items-center">
   {{-- <x-orchid-icon path="orchid" width="1.2em" height="1.2em"/> --}}
   <img src="{{ asset('admin/images/logo.png') }}"/>

    <p class="ms-3 my-0 d-none d-sm-block">
        Youth
        <small class="align-top opacity">Collection</small>
    </p>
</div>
