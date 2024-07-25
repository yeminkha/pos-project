@extends('user.layout')
@section('accountMainPage')
    <section class="acc">
        <div class="container">
            <div class="left">
                <div class="left-inner">
                    <a href="{{route('accMain')}}">မိမိအကောင့်</a>
                    <a href="/orderedBookPage">မှာယူထားသည့်စာအုပ်များ</a>
                    <a href="{{route('accInfo')}}">မိမိအချက်အလက်များ</a>
                </div>
            </div>
            <div class="right">
                @yield('about')
                @yield('vouncherList')
                @yield('vouncher')
                @yield('accInfo')
            </div>
        </div>
    </section>
@endsection
