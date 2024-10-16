@extends('user/layout')
@section('content')
    <section class="orderListPage">
        @if (session()->has('tempOrderList') && count(session('tempOrderList')) > 0)
            <div class="title">လူကြီးမင်း၏ ဈေးဝယ်ခြင်း</div>
            <table rules="all" class="repoHidTable">
                <tr>
                    <th colspan="2" class="border-remove"></th>
                    <th>စာအုပ်</th>
                    <th>တန်ဖိုး</th>
                    <th>အရေအတွက်</th>
                    <th>စုစုပေါင်း</th>
                </tr>
                @php
                    $tempOrderList = session('tempOrderList');
                @endphp
                @foreach ($tempOrderList as $key => $item)
                    <tr class="item">
                        <input type="hidden" class="productId" value="{{ $item['productId'] }}">
                        <input type="hidden" class="name" value="{{ $item['name'] }}">
                        <input type="hidden" class="price" value="{{ $item['price'] }}">
                        <input type="hidden" class="image" value="{{ $item['image'] }}">
                        <td class="deleBtn delete">
                            <input type="hidden" class="voucherCode" value="{{ $item['voucherCode'] }}">
                            <i class="fa-solid fa-circle-xmark"></i>
                        </td>
                        <td class="imgCon">
                            <img src="{{ asset('storage/books/' . $item['image']) }}" alt="" />
                        </td>
                        <td>
                            <a href="">{{ $item['name'] }}</a>
                        </td>
                        <td>{{ $item['price'] }} (ကျပ်)</td>
                        <td class="ipCon" title="အရေအတွက်">
                            <input type="number" min="0" value="{{ $item['quantity'] }}" />
                        </td>
                        <td class='total'>{{ $item['total'] }} (ကျပ်)</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="6">
                        <div class="tbFooter">
                            <div class="couponSer">
                                {{-- <input type="text" placeholder="Coupon code" />
                coupon:
                <div class="couponBtn">Apply coupon</div> --}}
                            </div>
                            <div class="save">ဝယ်ယူမည့်စာရင်းကို ထပ်မှန်သိမ်းဆည်းမည်</div>
                        </div>
                    </td>
                </tr>
            </table>
            <table rules="rows" class="repoVisiTable" style="display: none">
                @php
                    $tempOrderList = session('tempOrderList');
                @endphp
                @foreach ($tempOrderList as $key => $item)
                    <tbody class="item">
                        <input type="hidden" class="productId" value="{{ $item['productId'] }}">
                        <input type="hidden" class="name" value="{{ $item['name'] }}">
                        <input type="hidden" class="price" value="{{ $item['price'] }}">
                        <input type="hidden" class="image" value="{{ $item['image'] }}">
                        <tr>
                            <td class="deleBtn delete" style="text-align: start">
                                <input type="hidden" class="voucherCode" value="{{ $item['voucherCode'] }}">
                                <i class="fa-solid fa-circle-xmark"></i>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="imgCon">
                                <img style="width:70%;margin:0 auto;display:block;"
                                    src="{{ asset('storage/books/' . $item['image']) }}" alt="" />
                            </td>
                        </tr>
                        <tr>
                            <th>စာအုပ်</th>
                            <td> <a href="">{{ $item['name'] }}</a>
                            </td>
                        </tr>
                        <tr>
                            <th>တန်ဖိုး</th>
                            <td>{{ $item['price'] }} (ကျပ်)</td>
                        </tr>
                        <tr>
                            <th>အရေအတွက်</th>
                            <td class="ipCon" title="အရေအတွက်">
                                <input type="number" min="0" value="{{ $item['quantity'] }}" />
                            </td>
                        </tr>
                        <tr>
                            <th>စုစုပေါင်း</th>
                            <td class='total'>{{ $item['total'] }} (ကျပ်)</td>
                        </tr>
                    </tbody>
                @endforeach
                <tr>
                    <td colspan="6">
                        <div class="tbFooter">
                            <div class="couponSer">
                            </div>
                            <div class="save">ဝယ်ယူမည့်စာရင်းကို ထပ်မှန်သိမ်းဆည်းမည်</div>
                        </div>
                    </td>
                </tr>
            </table>
            <div class="chartContianer">
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
                    <div class="warning">
                        ပို့ဆောင်ခမှာ အခြေခံတစ်အုပ် ၂၀၀၀ နှင့် *ထပ်တိုးတစ်အုပ် ၁၀၀
                        ကျပ်*နှုန်း ဖြစ်ပါသည်။ (ကားနှစ်ဆင့်ပို့ မြို့နယ်များအတွက်သာ
                        ထပ်ဆောင်းပို့ခ ၅၀၀ ကျပ် ကောက်ခံပါသည်။ နှစ်ဆင့်ပို့မြို့များ -
                        ကလေးမြို့၊ တမူးမြို့၊ ရေဦးမြို့၊ စစ်တွေမြို့၊တောင်ကုတ်မြို့၊
                        မြေပုံမြို့၊ မာန်အောင်မြို့၊ မြစ်ကြီးနားမြို့၊ ဗန်းမော်မြို့၊
                        မိုးညှင်း-နမ္မားမြို့၊ ဟိုပင်မြို့၊ ဝိုင်းမော်မြို့၊ တာချီလိတ်မြို့၊
                        နမ့်စန်မြို့၊ ကျိုင်းတုံမြို့၊ ထားဝယ်မြို့၊ မြိတ်မြို့၊
                        ကော့သောင်းမြို့)
                    </div>
                </div>
            </div>
        @else
            <div class="title">လူကြီးမင်း၏ ဈေးဝယ်ခြင်း ပစ္စည်းများမရှိသေးပါ</div>
            <hr style='margin-bottom:20px;'>
        @endif
    </section>
@endsection
@section('jquery')
    <script>
        $(document).ready(function() {

            $('.save').click(function() {
                var items = [];

                if ($('.orderListPage .repoVisiTable').lenght > 0) {
                    $('.orderListPage .repoVisiTable .item').each(function(index) {
                        var image = $(this).find('.image').val();
                        var name = $(this).find('.name').val();
                        var price = $(this).find('.price').val();
                        var productId = $(this).find('.productId').val();
                        var voucherCode = $(this).find('.voucherCode').val();
                        var quantity = $(this).find('input[type="number"]').val();

                        var item = {
                            productId: productId,
                            voucherCode: voucherCode,
                            quantity: quantity,
                            image: image,
                            name: name,
                            price: price,
                            total: parseInt(price) * quantity,
                        };

                        items.push(item);
                    });
                    console.log('small');
                    console.log(items);
                };

                if ($('.orderListPage .repoHidTable').lenght > 0) {
                    $('.orderListPage .repoHidTable .item').each(function(index) {
                        var image = $(this).find('.image').val();
                        var name = $(this).find('.name').val();
                        var price = $(this).find('.price').val();
                        var productId = $(this).find('.productId').val();
                        var voucherCode = $(this).find('.voucherCode').val();
                        var quantity = $(this).find('input[type="number"]').val();

                        var item = {
                            productId: productId,
                            voucherCode: voucherCode,
                            quantity: quantity,
                            image: image,
                            name: name,
                            price: price,
                            total: parseInt(price) * quantity,
                        };

                        items.push(item);
                    });
                    console.log('large');
                    console.log(items);
                }

                // $.ajax({
                //     url: 'updateSessionData',
                //     type: 'get',
                //     dataType: 'json',
                //     data: {
                //         items: items
                //     },
                //     success: function(response) {
                //         // Handle success response
                //         location.reload();
                //     },
                //     error: function(xhr, status, error) {
                //         // Handle error response
                //         console.error('Error updating session data:', error);
                //     }
                // });

            });
        });
    </script>
@endsection
