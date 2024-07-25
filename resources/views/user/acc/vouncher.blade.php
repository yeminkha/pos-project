@extends('user.acc.main')
@section('vouncher')
    <div class="main-content">
        <div class="section__content section__content--p30">
            {{-- <table rules="all" class="vouncher" style="width:100%">
                <tr>
                    <th>စာအုပ်</th>
                    <th>တန်ဖိုး</th>
                    <th>အရေအတွက်</th>
                    <th>စုစုပေါင်း</th>
                </tr>

                @foreach ($vouncher as $item)
                    <tr class="item">
                        <input type="hidden" class="productId" value="{{ $item['productId'] }}">
                        <input type="hidden" class="name" value="{{ $item['name'] }}">
                        <input type="hidden" class="price" value="{{ $item['price'] }}">
                        <input type="hidden" class="image" value="{{ $item['image'] }}">
                        <td style="width:40%;">
                            <img src="{{ asset('storage/books/' . $item['image']) }}" alt="" width="100%" />
                        </td>
                        <td>{{ $item['price'] }} (ကျပ်)</td>
                        <td title="အရေအတွက်">
                            {{ $item['quantity'] }}
                        </td>
                        <td>{{ $item['total'] }} (ကျပ်)</td>
                    </tr>
                @endforeach
            </table> --}}

            <table rules="all" id="orderTable">
                <tr>
                    <th>စာအုပ်</th>
                    <th>တန်ဖိုး</th>
                </tr>
                @php
                    $tempOrderList = session('tempOrderList');
                    $totalPrice = 0;
                    $totalQuantity = 0;
                    $deli = 0;
                    $isGift = false;

                    foreach ($vouncher as $item) {
                        // Cast to integers before performing multiplication
                        $totalPrice += (int) $item['price'] * (int) $item['quantity'];
                        $totalQuantity += (int) $item['quantity'];
                        if ($item->smile_gift == 'on') {
                            $isGift = true;
                        }
                    }

                    // Calculate delivery charges
                    if ($totalQuantity > 1) {
                        $deli = 2000 + 100 * ($totalQuantity - 1);
                    } else {
                        $deli = 2000;
                    }

                    // Calculate total
                    if ($isGift) {
                        $totalPrice = $totalPrice + $deli+1000;
                    }
                @endphp
                @foreach ($vouncher as $item)
                    <tr>
                        <td>{{ $item->product_name }} x {{ $item->quantity }}</td>
                        <td>{{ $item->total }}</td>
                    </tr>
                @endforeach
                @if ($isGift)
                    <tr id="packingPrice">
                        <td>လက်ဆောင်ထုပ်ပိုးမှု ဝန်ဆောင်ခ</td>
                        <td>1000(ကျပ်)</td>
                    </tr>
                @endif
                <tr id="deli">
                    <td>ပို့ဆောင်ခ(ခန့်မှန်းခြေ) 1X2000, 1X100</td>
                    <td> {{ $deli }}(ကျပ်)</td>
                </tr>
                <tr id="total">
                    <td>စုစုပေါင်း</td>
                    <td> {{ $totalPrice }}(ကျပ်)</td>
                </tr>
            </table>
        </div>
    </div>
@endsection
