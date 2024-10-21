@extends('admin/layout/main')
@section('adminListPage')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">@if ($role == 'admin')
                                    Admin List
                                @else
                                    Customer List
                                @endif</h2>
                            </div>
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
                    <div class="table-responsive table-responsive-data2">
                        @if (count($list) != 0)
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Gender</th>
                                        <th>Phone</th>
                                        {{-- <th>Address</th> --}}
                                        <th>Role</th>
                                        {{-- <th>Joined Date</th> --}}
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($list as $d)
                                        <tr class="tr-shadow">
                                            <input type="hidden" class="id" value="{{ $d->id }}">
                                            <td>{{ $d->name }}</td>
                                            <td>
                                                @if ($d->email != null)
                                                    {{ $d->email }}
                                                @else
                                                    no data
                                                @endif
                                            </td>
                                            <td>
                                                @if ($d->gender != null)
                                                    {{ $d->gender }}
                                                @else
                                                    no data
                                                @endif
                                            </td>
                                            <td>
                                                @if ($d->phone != null)
                                                    {{ $d->phone }}
                                                @else
                                                    no data
                                                @endif
                                            </td>
                                            {{-- <td>{{ $d->address }}</td> --}}
                                            <td>
                                                <select name="role" class="form-select bg-black  role">
                                                    @if (Auth::user()->id != $d->id)
                                                        <option value="admin"
                                                            @if ($d->role == 'admin') selected @endif>Admin</option>
                                                        <option value="user"
                                                            @if ($d->role == 'user') selected @endif>Customer
                                                        </option>
                                                    @else
                                                        <option value="user"
                                                            @if ($d->role == 'user') selected @endif>
                                                            {{ $d->role }}
                                                        </option>
                                                    @endif
                                                </select>
                                            </td>
                                            <td>
                                                <div class="table-data-feature">
                                                    @if (Auth::user()->id != $d->id)
                                                        <button class="item delete" data-toggle="tooltip"
                                                            data-placement="top" title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    @endif
                                                    <a href="{{ route('userDetail', $d->id) }}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="More detail">
                                                            <i class="zmdi zmdi-more"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="spacer"></tr>
                                    @endforeach

                                </tbody>
                            </table>
                        @else
                            <div class=" d-flex justify-content-center align-items-center col-12 mt-5">
                                <h1>nd data found</h1>
                            </div>

                        @endif
                        {{ $list->links() }}
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
                    url: '/user/delete',
                    data: {
                        'id': $id
                    },
                    dataType: 'json'
                })
                parent.html('');
            })

            $('.role').change(function() {
                parent = $(this).parents('tr');
                $id = parent.find('.id').val();
                $role = parent.find('.role').val();
                $.ajax({
                    type: 'get',
                    url: '/user/role',
                    data: {
                        'id': $id,
                        'role': $role
                    },
                    dataType: 'json'
                })
                parent.html('')
            })
        })
    </script>
@endsection
