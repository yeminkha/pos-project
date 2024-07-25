@extends('admin/layout/main')
@section('orderListPage')
    <!-- MAIN CONTENT-->
    <div class="col-md-12" style="display:flex;justify-content:center;align-item:center;">
        <div class="col-md-10"
            style="background: #FBBC0F;margin-top:90px;border-radious:20px;padding:20px;border-radius:20px;color:white;">
            @if (count($orderLists) != 0)
                <div class="title " style="text-align:center;font-size:20px;border-bottom:2px solid white;">Order Code :
                    {{ $orderLists[0]->orderCode }}</div>
                <table rules='all' style="width:100%;margin:20px;padding:20px;">
                    <tr>
                        <th>စာအုပ်</th>
                        <th>စုစုပေါင်း</th>
                    </tr>
                    @php
                        $totalPrice = 0;
                        foreach ($orderLists as $item) {
                            // Cast to integers before performing multiplication
                            $totalPrice += (int) $item['price'] * (int) $item['quantity'];
                        }
                    @endphp
                    @foreach ($orderLists as $item)
                        <tr>
                            <th>{{ $item['product_name'] }} × {{ $item['quantity'] }}</th>
                            <td>{{ $item['total'] }} (ကျပ်)</td>
                        </tr>
                    @endforeach
                    @php
                        $total = 0;
                        $totalQuantity = 0;
                        $deli = 0;

                        foreach ($orderLists as $item) {
                            // Cast to integers before performing multiplication
                            $total += (int) $item['price'] * (int) $item['quantity'];
                            $totalQuantity += (int) $item['quantity'];
                        }

                        // Calculate delivery charges
                        if ($totalQuantity > 1) {
                            $deli = 2000 + 100 * ($totalQuantity - 1);
                        } else {
                            $deli = 2000;
                        }

                        if ($orderLists[0]['smile_gift'] == 'on') {
                            $totalPrice = $total + $deli + 1000;
                        } else {
                            // Calculate total
                            $totalPrice = $total + $deli;
                        }

                    @endphp
                    <tr>
                        <th>စာအုပ်တန်ဖိုး</th>
                        <td>{{ $total }} (ကျပ်)</td>
                    </tr>
                    @if ($orderLists[0]['smile_gift'] == 'on')
                        <tr>
                            <th>လက်ဆောင်ထုပ်ပိုးမှု ဝန်ဆောင်ခ </th>
                            <td>{{ 1000 }} ကျပ်</td>
                        </tr>
                    @endif
                    <tr id="deli">
                        <th>ပို့ဆောင်ခ(ခန့်မှန်းခြေ) 1X2000, 1X100</th>
                        <td> {{ $deli }}(ကျပ်)</td>
                    </tr>
                    <tr id="total">
                        <th>စုစုပေါင်း</th>
                        <td> {{ $totalPrice }}(ကျပ်)</td>
                    </tr>
                </table>
                @if ($orderLists[0]['smile_gift'] == 'on')
                    <div style="margin: 20px 0;;padding:10px;border-top:2px solid white;">
                        <label for="wish">wish letter</label>
                        <textarea id="wish" disabled
                            @if ($orderLists[0]['theme'] == 'light') style="background-color:white;width:100%;border-radius:10px;"
                        @else
                        style="background-color:black;width:100%;border-radius:10px;color:white;" @endif>
                            {{ $orderLists[0]['wish'] }}
                        </textarea>
                    </div>
                @endif
                @if ($orderLists[0]['message'])
                    <div style="margin: 20px 0;;padding:10px;border-top:2px solid white;">
                        <label for="message">message</label>
                        <textarea id="message" disabled
                            @if ($orderLists[0]['theme'] == 'light') style="background-color:white;width:100%;border-radius:10px;"
                        @else
                        style="background-color:black;width:100%;border-radius:10px;color:white;" @endif>
                        {{ $orderLists[0]['message'] }}
                        </textarea>
                    </div>
                @endif
                <div style="text-align: right;padding:20px;">
                    <select name="status" id="status"
                        style="outline:none;border:none;padding:5px 10px;border-radius:5px;">
                        <option value="0" @if ($orderLists[0]['status'] == '0') selected @endif>reject</option>
                        <option value="1" @if ($orderLists[0]['status'] == '1') selected @endif>pending..</option>
                        <option value="2" @if ($orderLists[0]['status'] == '2') selected @endif>success</option>
                    </select>
                    <input type="hidden" class="orderCode" value="{{ $orderLists[0]['orderCode'] }}">
                </div>
                {{-- <div class="chartContianer">
                                <div class="chart">
                                    <div class="title">စာရင်း စုစုပေါင်း</div>
                                    <table rules="rows">
                                        <tr>
                                            <th>စာအုပ်တန်ဖိုး</th>
                                            @php
                                                $tempOrderList = session('tempOrderList');
                                                $totalPrice = 0;
                                                $totalQuantity = 0;
                                                $deli = 0;

                                                foreach ($tempOrderList as $item) {
                                                    // Cast to integers before performing multiplication
                                                    $totalPrice += (int) $item['price'] * (int) $item['quantity'];
                                                    $totalQuantity += (int) $item['quantity'];
                                                }

                                                // Calculate delivery charges
                                                if ($totalQuantity > 1) {
                                                    $deli = 2000 + 100 * ($totalQuantity - 1);
                                                } else {
                                                    $deli = 2000;
                                                }

                                                // Calculate total
                                                $total = $totalPrice + $deli;
                                            @endphp
                                            <td>{{ $totalPrice }} (ကျပ်)</td>
                                        </tr>
                                        <tr>
                                            <th>ပို့ဆောင်ခ(ခန့်မှန်းခြေ) 1X2000, 1X100</th>
                                            <td>{{ $deli }} (ကျပ်)</td>
                                        </tr>
                                        <tr>
                                            <th>စုစုပေါင်း</th>
                                            <td>{{ $total }} (ကျပ်)</td>
                                        </tr>
                                    </table>
                                    <div class="continueOrderBtn">အမှာတင်ဖို့ဆက်သွားမည်..</div>
                                </div>
                            </div> --}}
            @endif
        </div>
    </div>
@endsection
@section('jquery')
    <script>
        $(document).ready(function() {
            $('#status').change(function() {
                var selectedValue = $(this).val();
                var orderCode = $(this).parent().find('.orderCode').val();
                switch (selectedValue) {
                    case '0':
                        $(this).css('background-color', '#EA3A4B');

                        break;
                    case '1':
                        $(this).css('background-color', '#F7CD77');
                        break;
                    case '2':
                        $(this).css('background-color', '#23C68B');
                        break;

                    default:
                        break;
                }
                $.ajax({
                type: 'get',
                url: '/order/status/update',
                data: {
                    'status': selectedValue,
                    'orderCode': orderCode
                },
                dataType: 'json',
                success: function(response) {
                    location.reload(); // Log the response for debugging
                    // Handle success response if needed
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText); // Log the error response
                    // Handle error response if needed
                }
            });
            });
        });
    </script>
@endsection
