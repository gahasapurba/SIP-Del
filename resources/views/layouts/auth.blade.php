<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />
        <meta name="description" content="" />
        <meta name="author" content="" />

        <title>SIP Del - @yield('title')</title>

        {{-- Style --}}
        @stack('prepend-style')
        @include('includes.auth-style')
        @stack('addon-style')

    </head>

    <body>
        <div class="page-content page-auth" id="register">
            <div class="section-store-auth" data-aos="fade-up">
                <div class="container">

                    {{-- Content --}}
                    @yield('content')

                </div>
            </div>
        </div>

        {{-- Footer --}}
        @include('includes.auth-footer')

        
        {{-- Script --}}
        @stack('prepend-script')
        @include('includes.auth-script')
        @stack('addon-script')

        @include('sweetalert::alert')
    </body>
</html>
