@yield('css')
{{-- <link rel="stylesheet" href="{{asset('assets/fonts/amazon_webfonts/font.css')}}"> --}}
<!-- Bootstrap Css -->
<link href="{{ URL::asset('build/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="{{ URL::asset('build/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="{{ URL::asset('build/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
<!-- App js -->
<script src="{{ URL::asset('build/js/plugin.js') }}"></script>

<style>
    @import url('{{ asset("assets/fonts/amazon_webfonts/font.css") }}');

    * {
        font-family: 'Amazon Ember', sans-serif;
    }
</style>
