@extends('admin.layout.main')
@section('categoryCreatePage')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3 offset-8">
                        <a href="{{ route('categoryListPage') }}"><button class="btn bg-dark text-white my-3">category
                                list</button></a>
                    </div>
                </div>
                <div class="col-lg-6 offset-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Main Category Form</h3>
                            </div>
                            <hr>
                            <form action="{{ route('mainCategoryUpdate') }}" method="post" novalidate="novalidate"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{$mainCategory->id}}">
                                <div class="form-group">
                                    <img id="previewImage" src="{{ asset('storage/mainCategory/' . $mainCategory->image) }}"
                                        class="rounded my-3" width="200px;">
                                    <label for="image" class="control-label mb-1"
                                        style='color:white;display:block;'>Image</label>
                                    <input type="file" name="image" class="form-control" id="image"
                                        onchange="previewFile()" value="{{ $mainCategory->image }}">
                                    @error('image')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name" class="control-label mb-1" style='color:white;'>Name</label>
                                    <input id="name" name="name" type="text" class="form-control"
                                        value="{{ $mainCategory->name }}" aria-required="true" aria-invalid="false"
                                        placeholder="enter main category">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                        <span id="payment-button-amount">Create</span>
                                        <span id="payment-button-sending" style="display:none;">Sending…</span>
                                        <i class="fa-solid fa-circle-right"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewFile() {
            var input = document.getElementById('image');
            var preview = document.getElementById('previewImage');

            var reader = new FileReader();
            reader.onloadend = function() {
                preview.src = reader.result;
            }

            if (input.files[0]) {
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = "{{ asset('storage/books/' . $mainCategory->image) }}";
            }
        }
    </script>
    <!-- END MAIN CONTENT-->
@endsection
