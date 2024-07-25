@extends('user.acc.main')
@section('vouncherList')
    <div class="main-content">
        <div class="section__content section__content--p30">
            @if (!empty($orderList) && count($orderList) > 0)
                <table rule="all">
                    <tr>
                        <th>ရက်စွဲ</th>
                        <th>အုပ်ရေ</th>
                        <th>စုစုပေါင်း</th>
                        <th>ပို့ဆောင်မှု</th>
                        <th></th>
                    </tr>

                    @foreach ($orderList as $order)
                        <tr>
                            <td>
                                {{ $order->created_at->format('d.m.Y') }}
                            </td>
                            <td>
                                {{ $order->total_quantity }}
                            </td>
                            <td>
                                {{ $order->total_amount }} ကျပ်
                            </td>
                            <td>
                                @if ($order->status == '2')
                                    ပို့ဆောင်ပြီးပါပြီ
                                @else
                                    ပို့ဆောင်စဲ
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('orderDetail', $order->orderCode) }}">
                                    <i class="fa-solid fa-angles-right"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            @else
                <div style="text-algin:center;">အမှာများ မရှိသေးပါ..</div>
            @endif
        </div>
    </div>
@endsection
