@extends('user/layout')
@section('content')
    <section class="loginSection ">
        <div class="explain explainLogin">
            <p>

                အကောင့်ဝင်ရန်အတွက် ပန်းဆက်လမ်းအကောင့် ဖွင့်ထားဖို့လိုအပ်ပါသည်။
                အကောင့်သစ်ဖွင့်ရန်နေရာတွင် လွယ်ကူစွာ ဖွင့်နိုင်ပါသည်။
                သို့မဟုတ် Facebook Acc ဖြင့်လည်း ဝင်ရောက်နိုင်ပါသည်။
                အကောင့်ဖွင့်ထားခြင်းအားဖြင့် ပို့ဆောင်မှုခြေရာခံကြည့်နိုင်ခြင်း၊
                လျော့ဈေးကူပွန်များလက်ခံနိုင်ခြင်း... စသည့်အကျိုးများရရှိမှာဖြစ်ပါသည်။
                ( အခက်အခဲတစ်စုံတစ်ရာရှိပါက Support Team 09788397540 သို့ ဆက်သွယ် အကူအညီတောင်းနိုင်ပါသည်။)
            </p>
        </div>
        <div class="card ">
            <div class="card-front">
                <div class="cardHeader">
                    <div class="title">ပန်းဆက်လမ်း အကောင့် ဝင်ရန်</div>
                    <div class="about aboutLogin"><i class="fa-solid fa-question"></i></div>
                </div>
                <div class="cardBody">
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        {{-- <input type="phone" placeholder="phone" name="phone" />
                        @error('phone')
                            <small style="color: red;font-size:10px;">{{ $message }}</small>
                        @enderror --}}
                        <input  type="text"  name="login" value="{{ old('login') }}" required autocomplete="login" autofocus placeholder="phone or email">

                        @error('login')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <input type="password" placeholder="Password" name='password' />
                        @error('password')
                            <small style="color: red;font-size:10px;">{{ $message }}</small>
                        @enderror

                        <input type="submit" value="ဝင်ရောက်ရန်" class="btn" />
                    </form>
                    <a href="{{ route('registerPage') }}" class="flitBtn">အကောင့်ဖွင့်ရန်</a>
                    <div class="rememberBtn">
                        <input type="checkbox" name="" id="" />
                        <small>နောက်ထပ်ဝင်မည် password မှတ်သားထားပါ</small>
                    </div>
                    <a href="" class="forgotPw"><small>Password မေ့နေပါသလား</small></a>
                </div>
            </div>
        </div>
    </section>
@endsection
