@extends('user.layout')
@section('content')
    <section class="acc-chart">
        {{-- @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show col-3 offset-9" role="alert">
                <strong>{{ session('success') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif --}}
        <form action="{{ route('order') }}" method="post">
            @csrf
            @if (!Auth::user())
                <a class="drop" style="margin-bottom:20px;" href="registerPage">
                    <div class="logo"></div>
                    <div class="title">
                        Account ဖြင့် ဝယ်ယူပါမည်လား?
                        <span id="accDropBtn">Account ဝင်ရန်</span>
                    </div>
                </a>
            @endif
            {{-- <div class="card-container">
                <div class="card">
                    <div class="card-front">
                        <div class="cardHeader">
                            <div class="title">ပန်းဆက်လမ်း အကောင့် ဝင်ရန်</div>
                        </div>
                        <div class="cardBody">
                            <form action="">
                                <input type="text" placeholder="User Name" />
                                <input type="text" placeholder="Password" />
                                <input type="submit" value="ဝင်ရောက်ရန်" class="btn" />
                            </form>
                            <a href="#" class="flitBtn">အကောင့်ဖွင့်ရန်</a>
                            <div class="rememberBtn">
                                <input type="checkbox" name="" id="" />
                                <small>နောက်ထပ်ဝင်မည် password မှတ်သားထားပါ</small>
                            </div>
                            <a href="" class="forgotPw"><small>Password မေ့နေပါသလား</small></a>
                        </div>
                    </div>
                    <div class="card-back">
                        <div class="cardHeader">
                            <div class="title">ပန်းဆက်လမ်း အကောင့် ဖွင့်ရန်</div>
                        </div>
                        <div class="cardBody">
                            <form action="">
                                <div class="usernameGp">
                                    <div>
                                        <input type="text" placeholder="User Name (English only)" />
                                    </div>
                                </div>
                                <div class="ph-emailGp">
                                    <div><input type="text" value="09" disabled /></div>
                                    <div class="inputGp">
                                        <div><input type="text" placeholder="----" /></div>
                                    </div>
                                </div>
                                <div>(or)</div>
                                <input type="email" placeholder="Email" />
                                <input type="password" placeholder="Password" />
                                <input type="password" placeholder="Confirm Password" />
                                <input type="submit" value="အကောင့်သစ်ဖွင့်မည်" class="btn" />
                            </form>
                            <a href="#" class="flitBtn">အကောင့်ဝင်ရန်</a>
                        </div>
                    </div>
                </div>
            </div> --}}
            {{-- <div class="drop">
                <div class="logo"></div>
                <div class="title">
                    Gift Voucher ရှိပါသလား?
                    <span id="couponDropBtn">Code နံပါတ်ထည့်မည်</span>
                </div>
            </div>
            <div class="couponDrop">
                <div class="title">Gift Voucher Code ရှိပါက ထည့်သွင်းနိုင်ပါသည်</div>
                <form action="">
                    <input type="text" />
                    <button type="submit">Apply Coupon</button>
                </form>
            </div> --}}
            <div class="getInfo">
                <div class="header">လူကြီးမင်း၏ အချက်အလက်များကို စစ်ဆေးရန်</div>
                <div>
                    <div class="inputGp">
                        <label for="">နာမည်</label>
                        <input type="text" name="userName"
                            @if (Auth::user()) value="{{ Auth::user()->name }}" @endif />
                        @error('userName')
                            <small style='color:red;'>{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="inputGp">
                        <label for="">Email (ပြည်ပမှမှာယူမှုအတွက်သာ)</label>
                        <input type="email" name="email"
                            @if (Auth::user()) value="{{ Auth::user()->email }}" @endif />
                        @error('email')
                            <small style='color:red;'>{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="inputGp">
                        <label for="">ဖုန်းနံပါတ်</label>
                        <input type="text" name="phone"
                            @if (Auth::user()) value="{{ Auth::user()->phone }}" @endif />
                        @error('phone')
                            <small style='color:red;'>{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="inputGp">
                        <label for="">လက်ခံယူမည့်လိပ်စာ</label>
                        <textarea name="address">
                            @if (Auth::user())
{{ Auth::user()->address }}
@endif
                        </textarea>
                        @error('address')
                            <small style='color:red;'>{{ $message }}</small>
                        @enderror
                    </div>
                    {{-- @if (Auth::user())
                        <button class="register">မိမိအကောင့်မှအချက်အလက်ရယူမည်</button>
                    @endif --}}
                    {{-- <button class="register">အကောင့်သစ်ဖွင့်မည်</button> --}}
                </div>
            </div>
            <div class="gift-card">
                <div class="header">
                    <input type="checkbox" class="cb" name="smileGift" />

                    <span>'အပြုံးလက်ဆောင်' ထုပ်ပိုးမှုဖြင့် ပို့ဆောင်ပါ</span>
                    <div class="about"><i class="fa-solid fa-question"></i></div>
                </div>
                <div class="text-photo">
                    <textarea name="wishLetter" disabled></textarea>
                    <img src="https://www.pannsattlann.com/wp-content/uploads/2022/01/Icon-Final.png" alt="" />
                </div>
                <div class="radioGp">
                    <small>Wish Card တွင် ရေးသားလိုသော အမှတ်တရစာသား</small>
                    <div class="radio" name='giftTheme'>
                        <input type="radio" id="light" name="theme" value="light" disabled />
                        <label for="light">Light Theme Package
                            <i class="bx bx-photo-album"></i> </label><br />
                        <input type="radio" id="dark" name="theme" value="dark" disabled />
                        <label for="dark">Dark Theme Package
                            <i class="bx bx-photo-album"></i> </label><br />
                    </div>
                </div>
            </div>
            <div class="tableGp ">
                <div class="title">လူကြီးမင်း ဝယ်ယူလိုသော</div>
                <table rules="all" id="orderTable">
                    <tr>
                        <th>စာအုပ်</th>
                        <th>တန်ဖိုး</th>
                    </tr>
                    @php
                        $tempOrderList = session('tempOrderList');
                        $totalPrice = 0;
                        foreach ($tempOrderList as $item) {
                            // Cast to integers before performing multiplication
                            $totalPrice += (int) $item['price'] * (int) $item['quantity'];
                        }
                    @endphp
                    @foreach ($tempOrderList as $key => $item)
                        <tr>
                            <th>{{ $item['name'] }} × {{ $item['quantity'] }}</th>
                            <td>{{ $item['total'] }} (ကျပ်)</td>
                        </tr>
                    @endforeach
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
                        $totalPrice = $totalPrice + $deli;
                    @endphp
                    <tr id="deli">
                        <th>ပို့ဆောင်ခ(ခန့်မှန်းခြေ) 1X2000, 1X100</th>
                        <td> {{ $deli }}(ကျပ်)</td>
                    </tr>
                    <tr id="total">
                        <th>စုစုပေါင်း</th>
                        <td> {{ $totalPrice }}(ကျပ်)</td>
                    </tr>
                </table>
            </div>
            <div class="noteGp">
                <div class="title">ပန်းဆက်လမ်းသို့ ပြောကြားလိုသောမှတ်စု</div>
                <div>
                    <textarea name="message"></textarea>
                    <button type="submit">အမှာတင်မည်</button>
                </div>
            </div>
        </form>
    </section>
@endsection
@section('jquery')
    <script>
        $(document).ready(function() {
            $('.cb').change(function() {
                if ($(this).is(':checked')) {
                    $('#light, #dark, [name="wishLetter"]').prop('disabled', false);
                    $('#light').prop('checked', true);
                    var totalPrice = parseInt("{{ $totalPrice }}") + 1000;
                    var newRow =
                        `<tr id="packingPrice"><th>လက်ဆောင်ထုပ်ပိုးမှု ဝန်ဆောင်ခ</th><td>1000(ကျပ်)</td></tr>
                <tr id='total'>
                <th>စုစုပေါင်း</th>
                <td> ${totalPrice}(ကျပ်)</td>
            </tr>`;
                    $('#orderTable').append(newRow);
                    $('#total').remove();
                } else {
                    var totalPrice = parseInt("{{ $totalPrice }}");
                    $('#packingPrice').remove();
                    $('#total').remove();
                    var newRow =
                        `<tr id='total'>
                <th>စုစုပေါင်း</th>
                <td> ${totalPrice}(ကျပ်)</td>
            </tr>`;
                    $('#orderTable').append(newRow);
                    $('#light, #dark, [name="wishLetter"]').prop('disabled', true);
                }
            });
        });
    </script>
@endsection
