<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from phantom-themes.com/connect/theme/templates/admin1/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Aug 2021 13:58:46 GMT -->
    <head>
        @include('includes.head')
        @stack('styles')
    </head>

    <body>
        <div class='loader'>
           @include('partials.loader')
        </div>
        <div class="connect-container align-content-stretch d-flex flex-wrap">
            <div class="page-sidebar">
                @include('partials.sidebar')
            </div>
            <div class="page-container">
                <div class="page-header">
                    @include('partials.navbar')
                </div>
                <div class="page-content">
                    <div class="main-wrapper">
                        @yield('content')
                    </div>
                </div>

                @include('partials.footer')
            </div>
        </div>

        <!-- Javascripts -->
        @include('includes.script')
        @stack('scripts')
    </body>

<!-- Mirrored from phantom-themes.com/connect/theme/templates/admin1/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Aug 2021 13:59:19 GMT -->
</html>
