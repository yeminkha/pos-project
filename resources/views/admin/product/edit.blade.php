@extends('admin/layout/main')
@section('productEditPage')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show col-3 offset-9" role="alert">
                        <strong>{{ session('success') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="col-lg-8 offset-2">
                    <div class="card">
                        <div class="card-body">
                            <i class="fa-solid fa-arrow-left text-primary" onclick="history.back()"></i>
                            <div class="card-title">
                                <h3 class="text-center title-2">Edit Product</h3>
                            </div>
                            <hr>
                            <form action="{{ route('productUpdate') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-5">
                                        <div class="form-group my-3">
                                            <img id="previewImage" src="{{ asset('storage/books/' . $product->image) }}"
                                                class="rounded my-3" width="300px">
                                            <input type="file" name="image" class="form-control" id="image"
                                                onchange="previewFile(this, 'previewImage')">
                                            @error('image')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <img id="previewImage1"
                                                src="{{ asset('storage/books/' . $product->sideImage1) }}"
                                                class="rounded my-3" width="300px">
                                            <input type="file" name="sideImage1" class="form-control" id="sideImage1"
                                                onchange="previewFile(this, 'previewImage1')">
                                            @error('sideImage1')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <img id="previewImage2"
                                                src="{{ asset('storage/books/' . $product->sideImage2) }}"
                                                class="rounded my-3" width="300px">
                                            <input type="file" name="sideImage2" class="form-control" id="sideImage2"
                                                onchange="previewFile(this, 'previewImage2')">
                                            @error('sideImage2')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-7">
                                        <div class="form-group">
                                            <label for="name" class="control-label mb-1">Name</label>
                                            <input id="name" name="name" type="text" class="form-control"
                                                value='{{ $product->name }}' aria-required="true" aria-invalid="false"
                                                placeholder="Enter product name">
                                            @error('name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group" style="position: relative;">
                                            <label for="arthur" class="control-label mb-1">Arthur</label>
                                            <input type="text" name="arthur" class="form-control mainCati"
                                                id="arthur" placeholder="Enter product arthur"
                                                value="{{ $product->arthur }}">
                                            <div class="suggestBox"
                                                style="background-color:white;visibility:hidden;max-height:100px;width:100%;overflow:scroll;overflow-x:hidden;position:absolute;z-index:3;">
                                            </div>
                                            @error('arthur')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror

                                        </div>
                                        {{-- <div class="form-group" style="position: relative;">
                                            <label for="mainCategory" class="control-label mb-1">Main Category</label>
                                            <input type="text" name="mainCategory" class="form-control mainCati"
                                                id="mainCategory" value="{{ $product->main_category_name }}">
                                            <div class="suggestBoxMain"
                                                style="background-color:white;visibility:hidden;max-height:100px;width:100%;overflow:scroll;overflow-x:hidden;position:absolute;z-index:3;">
                                            </div>
                                            @error('mainCategory')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror

                                        </div>
                                        <div class="form-group">
                                            <label for="category" class="control-label mb-1">Category</label>
                                            <input type="text" name="category" class="form-control cati" id="category"
                                                value="{{ $product->category_name }}">
                                            <div class="suggestBoxCati"
                                                style="background-color:white;visibility:hidden;max-height:100px;width:100%;overflow:scroll;overflow-x:hidden;position:absolute;z-index:3;">
                                            </div>
                                            @error('category')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div> --}}
                                        <div class="form-group" style="position: relative;">
                                            <label for="mainCategory" class="control-label mb-1">Main Category</label>
                                            <select name="mainCategoryId" class="form-control" id="mainCategory">
                                                @foreach ($mainCategories as $c)
                                                    <option value="{{ $c['id'] }}" @if ($c->id == $product->main_category_name)
                                                        selected
                                                    @endif>{{ $c['name'] }}</option>
                                                @endforeach
                                            </select>
                                            {{-- <input type="text" name="mainCategory" class="form-control mainCati"
                                                id="mainCategory">
                                            <div class="suggestBoxMain"
                                                style="background-color:white;visibility:hidden;max-height:100px;width:100%;overflow:scroll;overflow-x:hidden;position:absolute;z-index:3;">
                                            </div> --}}
                                            @error('mainCategory')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror

                                        </div>
                                        <div class="form-group">
                                            <label for="category" class="control-label mb-1">Category</label>
                                            <select name="categoryId" class="form-control" id="category">
                                                @foreach ($categories as $c)
                                                    <option value="{{ $c['id'] }}" @if ($c->id == $product->category_name)
                                                        selected
                                                    @endif>{{ $c['name'] }}</option>
                                                @endforeach
                                            </select>
                                            {{-- <input type="text" name="category" class="form-control cati" id="category">
                                            <div class="suggestBoxCati"
                                                style="background-color:white;visibility:hidden;max-height:100px;width:100%;overflow:scroll;overflow-x:hidden;position:absolute;z-index:3;">
                                            </div> --}}
                                            @error('category')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <div class="checkBoxContainer"
                                                style="display: flex;justify-content:space-between">
                                                <div class="checkBox">
                                                    <label for="editorChoice">Editor Choice</label>
                                                    <input type="hidden" name="editorChoice" value="False">
                                                    <input type="checkbox" name="editorChoice" id="editorChoice"
                                                        value="True" @if ($product->editor_choice == 'True') checked @endif>
                                                </div>
                                                <div class="checkBox">
                                                    <label for="reward">Reward</label>
                                                    <input type="hidden" name="reward" value="False">
                                                    <input type="checkbox" name="reward" id="reward" value="True"
                                                        @if ($product->reward == 'True') checked @endif>
                                                </div>
                                                <div class="checkBox">
                                                    <label for="classic">Classic</label>
                                                    <input type="hidden" name="classic" value="False">
                                                    <input type="checkbox" name="classic" id="classic" value="True"
                                                        @if ($product->classic == 'True') checked @endif>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group" style="position: relative;">
                                            <label for="readingGuide" class="control-label mb-1">Reading Guide</label>

                                            <input type="text" name="readingGuide" class="form-control mainCati"
                                                value="{{ $product->reading_guide }}" id="readingGuide">
                                            <div class="suggestBoxRg"
                                                style="background-color:white;visibility:hidden;max-height:100px;width:100%;overflow:scroll;overflow-x:hidden;position:absolute;z-index:3;">
                                            </div>
                                            @error('readingGuide')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="pages" class="control-label mb-1">Pages</label>
                                            <input id="pages" name="pages" type="number" class="form-control"
                                                value="{{ $product->pages }}" aria-required="true" aria-invalid="false"
                                                placeholder="Enter product pages">
                                            @error('pages')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="inStock" class="control-label mb-1">inStock</label>
                                            <input id="inStock" name="inStock" type="number" class="form-control"
                                                value="{{ $product->in_stock }}" aria-required="true"
                                                aria-invalid="false" placeholder="Enter product inStock">
                                            @error('inStock')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="printRecord" class="control-label mb-1">Print Record</label>
                                            <input id="printRecord" name="printRecord" type="text"
                                                value="{{ $product->print_record }}" class="form-control"
                                                aria-required="true" aria-invalid="false"
                                                placeholder="Enter product printRecord">
                                            @error('printRecord')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group" style="position: relative;">
                                            <label for="size" class="control-label mb-1">Book size</label>
                                            <input type="text" name="size" class="form-control mainCati"
                                                id="size" value="{{ $product->size }}">
                                            <div class="suggestBoxBs"
                                                style="background-color:white;visibility:hidden;max-height:100px;width:100%;overflow:scroll;overflow-x:hidden;position:absolute;z-index:3;">
                                            </div>
                                            @error('size')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror

                                        </div>
                                        <div class="form-group">
                                            <label for="description" class="control-label mb-1">Description</label>
                                            <textarea name="description" id="description" class="form-control" placeholder="Enter product description"
                                                cols="30" rows="10">{{ $product->description }}</textarea>
                                            @error('description')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="price" class="control-label mb-1">Price</label>
                                            <input id="price" name="price" type="number" class="form-control"
                                                value='{{ $product->price }}' aria-required="true" aria-invalid="false"
                                                placeholder="Enter product price">
                                            @error('price')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <input type="hidden" name="productId" value="{{ $product->id }}">
                                        <div class="float-end">
                                            <button type="submit" class="btn btn-info">save</button>
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
    </div>
    <!-- END MAIN CONTENT-->
    {{-- autocom --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // const mainCategoryInput = document.querySelector('#mainCategory');
            // const categoryInput = document.querySelector('#category');
            const readingGuideInput = document.querySelector('#readingGuide');
            const sizeInput = document.querySelector('#size'); // Added size input
            // const suggestBoxMain = document.querySelector('.suggestBoxMain');
            // const suggestBoxCati = document.querySelector('.suggestBoxCati');
            const suggestBoxRg = document.querySelector('.suggestBoxRg');
            const suggestBoxBs = document.querySelector('.suggestBoxBs'); // Added suggestBoxBs

            // const mainCategories = <?php echo json_encode($mainCategories); ?>;
            // const categories = <?php echo json_encode($categories); ?>;
            const readingGuides = <?php echo json_encode($readingGuides); ?>;
            const bookSize = <?php echo json_encode($bookSize); ?>; // Replace with your actual data

            // mainCategoryInput.addEventListener('input', function(event) {
            //     handleInputEvent(event, mainCategoryInput, suggestBoxMain, mainCategories);
            // });

            // categoryInput.addEventListener('input', function(event) {
            //     handleInputEvent(event, categoryInput, suggestBoxCati, categories);
            // });

            readingGuideInput.addEventListener('input', function(event) {
                handleInputEvent(event, readingGuideInput, suggestBoxRg, readingGuides);
            });

            sizeInput.addEventListener('input', function(event) {
                handleInputEvent(event, sizeInput, suggestBoxBs, bookSize);
            });

            function handleInputEvent(event, inputField, suggestBox, options) {
                const inputValue = event.target.value.toLowerCase();
                suggestBox.innerHTML = '';

                options.forEach(function(option) {
                    const optionValue = option.toLowerCase();

                    if (optionValue.includes(inputValue)) {
                        const itemDiv = document.createElement('div');
                        itemDiv.classList.add('item');
                        itemDiv.style.padding = '5px';
                        itemDiv.style.cursor = 'pointer';
                        itemDiv.textContent = optionValue;

                        itemDiv.addEventListener('click', function() {
                            inputField.value = optionValue;
                            suggestBox.style.visibility = 'hidden';
                        });

                        suggestBox.appendChild(itemDiv);
                    }
                });

                suggestBox.style.visibility = inputValue.length > 0 ? 'visible' : 'hidden';
            }
        });
    </script>
    // image
    <script>
        function previewFile(input, previewId) {
            var preview = document.getElementById(previewId);
            var reader = new FileReader();

            reader.onloadend = function() {
                preview.src = reader.result;
            }

            if (input.files[0]) {
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = "{{ asset('storage/books/' . $product->image) }}";
            }
        }
    </script>
@endsection
