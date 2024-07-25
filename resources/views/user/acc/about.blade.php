@extends('user.acc.main')
@section('about')
    <div class="main-content">
        <div class="section__content section__content--p30">
            {{-- <div class="container-fluid">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show col-3 offset-9" role="alert">
                    <strong>{{session('success')}}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="card col-6 offset-3">
                <i class="fa-solid fa-arrow-left text-primary mt-3" onclick="history.back()"></i>
                <div class=" text-center h3">
                    Account Info
                </div>
                <div class="card-body  d-flex">
                    <div class="col-5 ">
                        <img src="{{asset('storage/'.Auth::user()->image)}}" class="rounded " width="300px">
                    </div>
                    <div class="col-7 ">
                        <div class="mt-5">
                            <div class="d-flex justify-content-between">
                                <div>Name </div>
                                <div>{{Auth::user()->name}}</div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div>Eamil </div>
                                <div>{{Auth::user()->email}}</div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div>Gender </div>
                                <div>{{Auth::user()->gender}}</div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div>Phone </div>
                                <div>{{Auth::user()->phone}}</div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div>Address </div>
                                <div>{{Auth::user()->address}}</div>
                            </div>
                            <a href="" class="col-5 offset-7 my-3">
                                <button class=" btn btn-dark" >
                                    <i class="fa-solid fa-pen-to-square"></i>
                                    Edit
                                </button>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div> --}}
            <div style="margin-bottom: 30px">မင်္ဂလာပါ စာချစ်သူ {{ Auth::user()->name }}ရေ....</div>
            <small>
                လူကြီးမင်း၏ အကောင့်ထိန်းချုပ်မှုနေရာမှ မှာယူထားသည့် စာအုပ်အမှာများ ကြည့်ရှုနိုင်သည့်အပြင်၊
                စာအုပ်လက်ခံယူမည့်လိပ်စာ၊ ဖုန်းနံပါတ် စသဖြင့် အကောင့်အချက်အလက်တို့ကို လူကြီးမင်းစိတ်တိုင်းကျ
                ပြင်ဆင်ထိန်းချုပ်နိုင်ပါသည်။
            </small>
        </div>
    </div>
@endsection
