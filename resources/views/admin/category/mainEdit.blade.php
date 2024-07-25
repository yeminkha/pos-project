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
                                <h3 class="text-center title-2">maiin category Form</h3>
                            </div>
                            <hr>
                            <form action="{{ route('categoryUpdate') }}" method="post" novalidate="novalidate">
                                @csrf
                                <div class="form-group">
                                    <input type="hidden" value="{{$category->id}}" name="categoryId">
                                    <label class="control-label mb-1" style='color:white;'>Select main category</label>
                                    <select name="main_category" id="" class="form-control">
                                        @foreach ($list as $item)
                                            <option value="{{ $item->id }}" @if ($item->id == $category->main_category_id)
                                                selected
                                            @endif>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('main_category')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-1" style='color:white;'>Name</label>
                                    <input name="category" type="text" class="form-control" aria-required="true"
                                        aria-invalid="false" placeholder="enter category" value="{{$category->name}}">
                                    @error('category')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                        <span id="payment-button-amount">Update</span>
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

    <!-- END MAIN CONTENT-->
@endsection
