@extends('admin/layout/main')
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

                        <div class="col-lg-6 offset-3">
                            <div class="card">

                                <div class="card-body">
                                     <i class="fa-solid fa-arrow-left text-primary" onclick="history.back()"></i>
                                    <div class="card-title">

                                        <h3 class="text-center title-2">Password Change</h3>
                                    </div>
                                    <hr>
                                    <form action="{{route('passUpdate')}}" method="post" novalidate="novalidate">
                                        @csrf
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="oldPassword" class="control-label mb-1">oldPassword</label>
                                                    <input id="oldPassword" name="oldPassword" type="password" class="form-control"  aria-required="true" aria-invalid="false" placeholder="Enter  oldPassword">
                                                    @error('oldPassword')
                                                        <small class="text-danger">{{$message}}</small>
                                                    @enderror
                                                    @if(session('old password')) <small class="text-danger">{{session('old password')}}</small> @endif

                                                </div>
                                                <div class="form-group">
                                                    <label for="newPassword" class="control-label mb-1">newPassword</label>
                                                    <input id="newPassword" name="newPassword" type="password" class="form-control"  aria-required="true" aria-invalid="false" placeholder="Enter  newPassword">
                                                    @error('newPassword')
                                                        <small class="text-danger">{{$message}}</small>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="newPasswordConfirmation" class="control-label mb-1">Confirm new password</label>
                                                    <input id="newPasswordConfirmation" name="newPasswordConfirmation" type="password" class="form-control"  aria-required="true" aria-invalid="false" placeholder="Enter  newPassword">
                                                    @error('newPasswordConfirmation')
                                                        <small class="text-danger">{{$message}}</small>
                                                    @enderror
                                                    @if(session('confirm password')) <small class="text-danger">{{session('confirm password')}}</small> @endif
                                                </div>
                                                <div class="float-end mx-3">
                                                    <button type="submit" class="btn btn-info">save</button>
                                                </div>

                                            </div>


                                        </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
@endsection



