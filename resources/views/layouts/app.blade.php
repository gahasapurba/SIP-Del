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
        @include('includes.app-style')
        @stack('addon-style')

    </head>

    <body>
        <div class="page-dashboard">
            <div class="d-flex" id="wrapper" data-aos="fade-right">
                <!-- Sidebar -->
                <div class="border-right" id="sidebar-wrapper">
                    <div class="sidebar-heading text-center">
                        <a href="{{ route('home') }}">
                            <img
                                src="/images/itdel.png"
                                alt="Store Logo"
                                class="my-4"
                                style="max-width: 150px;"
                            />
                        </a>
                    </div>

                    {{-- Sidebar --}}
                    @include('includes.app-sidebar')

                </div>

                <!-- Page Content -->
                <div id="page-content-wrapper">
                    
                    {{-- Navbar --}}
                    @include('includes.app-navbar')

                    {{-- Content --}}
                    @yield('content')
                    
                </div>
            </div>
        </div>

        {{-- Script --}}
        @stack('prepend-script')
        @include('includes.app-script')
        @stack('addon-script')

        @include('sweetalert::alert')
    </body>
</html>