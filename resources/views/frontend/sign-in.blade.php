@extends('layouts.frontend.layout_plain')

@section('title', __('website.sign_in'))

@section('content')


    <!-- registration section start   -->
{{--    <section class="section registration" style="padding: 0px">--}}
        <div class="container-fluid"  style="height: 100%">
            <div class="row" style="height: 100%">
                {{-- Signing Form --}}
                <x-auth.signin-form/>

                {{-- Signup Content  --}}
                <x-auth.content/>


            </div>
        </div>
{{--    </section>--}}
    <!-- registration section  end    -->
@endsection

@section('frontend_script')
<script src="{{ asset('frontend') }}/js/plugins/passwordType.js"></script>
@endsection

