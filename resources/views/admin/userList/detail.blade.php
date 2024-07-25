@extends('admin/layout/main')
@section('userDetail')
    <!-- MAIN CONTENT-->
    <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="card col-6 offset-3">
                            <i class="fa-solid fa-arrow-left text-primary mt-3" onclick="history.back()"></i>
                            <div class=" text-center h3">
                                Account Info
                            </div>
                            <div class="card-body  d-flex">
                                <div class="col-5 ">
                                    <img @if($user->image == null)src="{{asset('storage/user_profile/userpf.png')}}"@else src="{{asset('storage/'.$user->image)}}"@endif class="rounded " width="300px">
                                </div>
                                <div class="col-7 ">
                                    <div class="mt-5">
                                        <div class="d-flex justify-content-between">
                                            <div>Name </div>
                                            <div>{{$user->name}}</div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <div>Eamil </div>
                                            <div>@if( $user->email != null) {{ $user->email }} @else no data @endif</div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <div>Gender </div>
                                            <div>@if( $user->gender != null) {{ $user->gender }} @else no data @endif</div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <div>Phone </div>
                                            <div>@if( $user->phone != null) {{ $user->phone }} @else no data @endif</div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <div>Address </div>
                                            <div>@if( $user->address != null) {{ $user->address }} @else no data @endif</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection

