@extends('admin.layout.main')
@section('mainContent')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Product List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('categoryCreatePage') }}">
                                <button class="au-btn au-btn-icon  au-btn--small btn">
                                    <i class="zmdi zmdi-plus"></i>add Category
                                </button>
                            </a>
                        </div>
                    </div>
                    <div>
                        <form action="" method="get">
                            @csrf
                            <div class="input-group col-md-4 mb-3">
                                <input type="text" class="form-control p-2" name="key" placeholder="Search..">
                                <button class="btn btn-dark" type="submit">search</button>
                            </div>
                        </form>
                    </div>
                    <!-- Category List -->
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            @if (count($categoryList) != 0)
                                <h3 style="margin-top: 50px">category list</h3>
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Category</th>
                                        <th>Main Category</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categoryList as $p)
                                        <tr class="tr-shadow">
                                            <input type="hidden" class="id" value="{{ $p->id }}">

                                            <td>
                                                {{-- <img src="{{ asset('storage/mainCategory/' . $p->image) }}" class="rounded"
                                                    width="100px"> --}}
                                                    {{-- <img src="{{ $p->image }}" width="100px" > --}}
                                                    {{dd($p->image)}}
                                            </td>

                                            <td>{{ $p->name }}</td>
                                            <td>{{ $p->main_category_name }}</td>

                                            <td>
                                                <div class="table-data-feature">
                                                    <a href="{{ route('categoryEditPage', $p->id) }}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Edit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                    </a>
                                                    <button class="item delete" data-toggle="tooltip" data-placement="top"
                                                        title="Delete">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>

                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="spacer"></tr>
                                    @endforeach
                                </tbody>
                            @else
                                <div class=" d-flex justify-content-center align-items-center col-12 mt-5">
                                    <h1>no category yet!</h1>
                                </div>
                            @endif
                        </table>
                        <!-- Pagination links for category list -->
                        @if ($categoryList && $categoryList->count() > 0)
                            {{ $categoryList->appends(['category_page' => $categoryList->currentPage()])->links() }}
                        @endif
                    </div>
                    <!-- Main Category List -->
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            @if (count($mainCategoryList) != 0)
                                <h3 style="margin-top: 50px">main category list</h3>
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Main Category</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mainCategoryList as $p)
                                        <tr class="tr-shadow">
                                            <input type="hidden" class="id" value="{{ $p->id }}">
                                            <td><img src="{{ asset('storage/mainCategory/' . $p->image) }}" class="rounded"
                                                    width="100px"></td>
                                            <td>{{ $p->name }}</td>
                                            <td>
                                                <div class="table-data-feature">
                                                    <a href="{{ route('mainCategoryEditPage', $p->id) }}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Edit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                    </a>
                                                    <button class="item maindelete" data-toggle="tooltip"
                                                        data-placement="top" title="Delete">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>

                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="spacer"></tr>
                                    @endforeach
                                </tbody>
                            @else
                                <div class=" d-flex justify-content-center align-items-center col-12 mt-5">
                                    <h1>no main category yet!</h1>
                                </div>
                            @endif
                        </table>
                        <!-- Pagination links for main category list -->
                        @if ($mainCategoryList && $mainCategoryList->count() > 0)
                            {{ $mainCategoryList->appends(['main_category_page' => $mainCategoryList->currentPage()])->links() }}
                        @endif
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
@section('jquery')
    <script>
        $(document).ready(function() {
            $('.delete').click(function() {
                parent = $(this).parents('tr');
                $id = parent.find('.id').val();
                $.ajax({
                    type: 'get',
                    url: '/category/delete',
                    data: {
                        'id': $id
                    },
                    dataType: 'json'
                })
                parent.html('');
            })
            $('.maindelete').click(function() {
                parent = $(this).parents('tr');
                $id = parent.find('.id').val();
                $.ajax({
                    type: 'get',
                    url: '/mainCategory/delete',
                    data: {
                        'id': $id
                    },
                    dataType: 'json'
                })
                parent.html('');
            })
        });
    </script>
@endsection
