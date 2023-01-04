{{-- Header --}}
@include('product.layouts.header')

<body>
    <div class="container my-10">

        {{-- Navbar --}}
        @include('product.layouts.navbar')

        @yield('content')

    </div>

    {{-- Footer --}}
    @include('product.layouts.footer')
