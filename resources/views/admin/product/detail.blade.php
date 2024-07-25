@extends('admin/layout/master')
@section('mainContent')
    <!-- MAIN CONTENT-->
    <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">

                        <div class="card col-6 offset-3">
                            <i class="fa-solid fa-arrow-left text-primary mt-3" onclick="history.back()"></i>
                            <div class=" text-center h3">
                                Product Info
                            </div>
                            <div class="card-body  d-flex">
                                <div class="col-5 ">
                                    <img src="{{asset('storage/'.$data->image)}}" class="rounded my-3" width="300px">
                                </div>
                                <div class="col-7 ">
                                    <div class="col my-2 fs-5 btn btn-danger">
                                        {{$data->name}}
                                    </div>
                                    <div class="my-2  btn btn-dark">
                                        <i class="fa-solid fa-list mr-2"></i>{{$data->category_name}}
                                    </div>
                                    <div class="my-2  btn btn-dark">
                                        <i class="fa-solid fa-sack-dollar mr-2"></i>{{$data->price}} kyats
                                    </div>
                                    <div class="my-2  btn btn-dark">
                                        <i class="fa-solid fa-clock mr-2"></i>{{$data->wating_time}} mins
                                    </div>
                                    <div class="my-2">
                                        <strong class=" btn btn-warning">Description -</strong>
                                        <p class="text-justify mb-3">{{$data->description}}</p>
                                    </div>
                                    <a href="{{route('product#edit#page',$data->id)}}" class="col-5 offset-7">
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
    <!-- END MAIN CONTENT-->
@endsection

