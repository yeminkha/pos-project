@extends('admin/layout/main')
@section('mainContent')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-8 offset-2">
                    <div class="card">
                        <div class="card-body">
                            <i class="fa-solid fa-arrow-left text-primary" onclick="history.back()"></i>
                            <div class="card-title">
                                <h3 class="text-center title-2">Edit Account</h3>
                            </div>
                            <hr>
                            <form action="{{ route('accUpdate') }}" method="post" novalidate="novalidate"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-5">
                                        <div class="form-group my-3">
                                            <div class="imgContainer"
                                                style="border-radius: 50%; width: 200px; height: 200px; overflow: hidden; margin: 20px auto; background: white; display: flex; align-items: center; justify-content: center;">

                                                @if (Auth::user()->image == null)
                                                    <img id="imagePreview"
                                                        src="{{ asset('storage/default_images/pf/default_pf.png') }}"
                                                        style="max-width: 100%; max-height: 100%; display: block;">
                                                @else
                                                    <img id="imagePreview"
                                                        src="{{ asset('storage/profile_images/' . Auth::user()->image) }}"
                                                        style="max-width: 100%; max-height: 100%; display: block;">
                                                @endif
                                            </div>
                                            <input type="file" name="image" class="form-control" id="image"
                                                onchange="previewImage()">
                                            @error('image')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>



                                    </div>
                                    <div class="col-7">
                                        <div class="form-group">
                                            <label for="name" class="control-label mb-1">Name</label>
                                            <input id="name" name="name" type="text" class="form-control"
                                                value='{{ Auth::user()->name }}' aria-required="true" aria-invalid="false"
                                                placeholder="Enter product name">
                                            @error('name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="email" class="control-label mb-1">email</label>
                                            <input id="email" name="email" type="email" class="form-control"
                                                value='{{ Auth::user()->email }}' aria-required="true" aria-invalid="false"
                                                placeholder="Enter product waiting time">
                                            @error('email')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="gender" class="control-label mb-1">Gender</label>
                                            <select name="gender" class="form-control" id="gender">
                                                <option value="male" @if (Auth::user()->gender == 'male') selected @endif>
                                                    male</option>
                                                <option value="female" @if (Auth::user()->gender == 'female') selected @endif>
                                                    female</option>
                                            </select>
                                            @error('gender')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="phone" class="control-label mb-1">phone</label>
                                            <input id="phone" name="phone" type="number" class="form-control"
                                                value='{{ Auth::user()->phone }}' aria-required="true" aria-invalid="false"
                                                placeholder="Enter product phone">
                                            @error('phone')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="address" class="control-label mb-1">address</label>
                                            <textarea name="address" id="address" class="form-control" placeholder="Enter product address" cols="30"
                                                rows="10">{{ Auth::user()->address }}</textarea>
                                            @error('address')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="pass">

                                        </div>

                                        <div class="float-end mx-3">
                                            <button type="submit" class="btn btn-info">save</button>
                                        </div>
                                        {{-- <div class="float-end mx-3 passwordBtn">
                                                    <button type="button" class="btn btn-info">wanna change your password</button>
                                                </div> --}}
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


    <script>
        function previewImage() {
            var input = document.getElementById('image');
            var preview = document.getElementById('imagePreview');

            var reader = new FileReader();
            reader.onload = function() {
                preview.src = reader.result;
                preview.style.display = 'block'; // Show the preview image
            }

            if (input.files && input.files[0]) {
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src =
                    '{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('storage/user_profile/userpf.png') }}';
                preview.style.display = '{{ Auth::user()->image ? 'block' : 'none' }}'; // Show or hide the preview image
            }
        }
    </script>
@endsection
