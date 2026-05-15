@extends('admin/layout/master')
@section('mainContent')
    <!-- MAIN CONTENT-->
    <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        @if(session('success'))
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
                                    {{-- <img src="{{asset('storage/'.Auth::user()->image)}}" class="rounded " width="300px"> --}}
                                    {{-- <img src="{{ Auth::user()->image }}"   class="rounded " width="300px"> --}}
                                    @php
        $userImage = Auth::user()->image;
    @endphp

    @if($userImage && str_starts_with($userImage, 'http'))
        {{-- Cloudinary URL ဖြစ်ခဲ့ရင် တိုက်ရိုက်ပြမယ် --}}
        <img src="{{ $userImage }}" class="rounded" width="300px">
    @elseif($userImage)
        {{-- Local storage ထဲက ပုံအဟောင်း ဖြစ်ခဲ့ရင် (ဥပမာ default_pf.png) --}}
        <img src="{{ asset('storage/profile_images/' . $userImage) }}" class="rounded" width="300px">
    @else
        {{-- ပုံ လုံးဝ မရှိခဲ့ရင် Default ပုံပြမယ် --}}
        <img src="{{ asset('storage/default_images/pf/default_pf.png') }}" class="rounded" width="300px">
    @endif
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
                                        <a href="{{route('account#edit#page')}}" class="col-5 offset-7 my-3">
                                            <button class=" btn btn-dark" >
                                                <i class="fa-solid fa-pen-to-square"></i>
                                                Edit
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection

