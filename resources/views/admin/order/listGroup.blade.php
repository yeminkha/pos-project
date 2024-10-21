@extends('admin/layout/main')
@section('orderListPage')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Order List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            {{-- <a href="{{ route('productCreatePage') }}">
                                <button class="au-btn au-btn-icon  au-btn--small btn">
                                    <i class="zmdi zmdi-plus"></i>add Product
                                </button>
                            </a> --}}
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
                        <table class="table table-data2">
                            @if (count($groupList) != 0)
                                <thead>
                                    <tr>
                                        <th>User Name</th>
                                        <th>Phone</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th>status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($groupList as $p)
                                        <tr class="tr-shadow">
                                            <td>{{ $p->user_name }}</td>
                                            <td>{{ $p->phone }}</td>
                                            @php
                                                $total = 2000;
                                                $quantity = 0;
                                                foreach ($orderList as $list) {
                                                    foreach ($list as $item) {
                                                        // Cast to integers before performing multiplication
                                                        if ($item->orderCode == $p->orderCode) {
                                                            $quantity += $item->quantity;
                                                            $total += $item->total;

                                                        }
                                                    }
                                                }
                                                if ($p->smile_gift == 'on') {
                                                                $total += 1000;
                                                            }
                                                if ($quantity>1) {
                                                    $total += ($quantity-1)*100;
                                                }
                                                // $total = 0;
                                                // $totalQuantity = 0;
                                                // $deli = 0;

                                                // foreach ($orderList as $list) {
                                                //     foreach ($list as $item) {
                                                //         // Cast to integers before performing multiplication
                                                //         $total += (int) $item->price * (int) $item->quantity;
                                                //         $totalQuantity += (int) $item['quantity'];
                                                //     }
                                                // }

                                                // // Calculate delivery charges
                                                // if ($totalQuantity > 1) {
                                                //     $deli = 2000 + 100 * ($totalQuantity - 1);
                                                // } else {
                                                //     $deli = 2000;
                                                // }

                                                // if ($orderList[0]['smile_gift'] == 'on') {
                                                //     $totalPrice = $total + $deli + 1000;
                                                // } else {
                                                //     // Calculate total
                                                //     $totalPrice = $total + $deli;
                                                // }
                                            @endphp
                                            <td>{{ $quantity }}</td>
                                            <td>{{ $total }}</td>
                                            {{-- <td>
                                                @if ($p->smile_gift)
                                                    <i class="fa-solid fa-gifts" style="color: #F8BA0F"></i>
                                                @endif
                                            </td> --}}


                                            <td
                                                @switch($p->status)
                                                    @case('0')
                                                        style='background-color:#FF8D78'
                                                        @break
                                                    @case('1')
                                                        style='background-color:#FFE582'
                                                        @break
                                                    @case('2')
                                                        style='background-color:#81FAE1'
                                                        @break
                                                @endswitch>

                                                @switch($p->status)
                                                    @case(1)
                                                        pending..
                                                    @break

                                                    @case(2)
                                                        success..
                                                    @break

                                                    @case(0)
                                                        reject..
                                                    @break

                                                    @default
                                                @endswitch
                                            </td>
                                            {{-- <td>
                                                <div class="table-data-feature">
                                                    @if ($p->reward == 'True')
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="reward">
                                                            <i class="fa-solid fa-award"></i>
                                                        </button>
                                                    @endif
                                                    @if ($p->editor_choice == 'True')
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="editor fav">
                                                            <i class="fa-solid fa-heart"></i>
                                                        </button>
                                                    @endif
                                                    @if ($p->classic == 'True')
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="classic">
                                                            <i class="fa-solid fa-star"></i>
                                                        </button>
                                                    @endif


                                                </div>
                                            </td> --}}
                                            <td>
                                                <div class="table-data-feature">
                                                    <button class="item delete" data-toggle="tooltip" data-placement="top"
                                                        title="Delete">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>
                                                    <a href="{{ route('seeOrderPage', $p->orderCode) }}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="detail">
                                                            <i class="fa-solid fa-angles-right"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="spacer"></tr>
                                    @endforeach
                                </tbody>
                                {{ $groupList->links() }}
                            @else
                                <div class=" d-flex justify-content-center align-items-center col-12 mt-5">
                                    <h1>no product yet!</h1>
                                </div>
                            @endif
                        </table>

                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
{{-- @section('jquery')
    <script>
        $(document).ready(function() {
            $('.delete').click(function() {
                parent = $(this).parents('tr');
                $id = parent.find('.id').val();
                $.ajax({
                    type: 'get',
                    url: '/product/delete',
                    data: {
                        'id': $id
                    },
                    dataType: 'json'
                })
                parent.html('');
            })
        });
    </script>
@endsection --}}
