@yield('css')
{{-- <link rel="stylesheet" href="{{asset('assets/fonts/amazon_webfonts/font.css')}}"> --}}
<!-- Bootstrap Css -->
<link href="{{ asset('build/css/bootstrap.min.css') }}"  rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="{{ asset('build/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="{{ asset('build/css/app.min.css') }}"  rel="stylesheet" type="text/css" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
<link href="{{ asset('assets/css/style-override.css') }}"  rel="stylesheet" type="text/css" />
<!-- App js -->
<script src="{{ asset('build/js/plugin.js') }}"></script>

<style>
    @import url('{{ asset("assets/fonts/amazon_webfonts/font.css") }}');

    * {
        font-family: 'Amazon Ember', sans-serif;
    }
</style>
