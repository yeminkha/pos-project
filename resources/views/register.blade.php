@extends('user/layout')
@section('content')
<section class="loginSection ">
    <div class="explain explainRegister">
      <p>

        အကောင့်ဝင်ရန်အတွက် ပန်းဆက်လမ်းအကောင့် ဖွင့်ထားဖို့လိုအပ်ပါသည်။ အကောင့်သစ်ဖွင့်ရန်နေရာတွင် လွယ်ကူစွာ ဖွင့်နိုင်ပါသည်။
        သို့မဟုတ် Facebook Acc ဖြင့်လည်း ဝင်ရောက်နိုင်ပါသည်။ အကောင့်ဖွင့်ထားခြင်းအားဖြင့် ပို့ဆောင်မှုခြေရာခံကြည့်နိုင်ခြင်း၊
        လျော့ဈေးကူပွန်များလက်ခံနိုင်ခြင်း... စသည့်အကျိုးများရရှိမှာဖြစ်ပါသည်။
        ( အခက်အခဲတစ်စုံတစ်ရာရှိပါက Support Team 09788397540 သို့ ဆက်သွယ် အကူအညီတောင်းနိုင်ပါသည်။)
      </p>
    </div>
    <div class="explain explainName">
        <p>
            User Name တွင် မိမိနာမည် (သို့မဟုတ်) ထားရှိလိုသော နာမည်တစ်ခုခု ဖြည့်ရပါမည်။
            English လို ဖြစ်ရပါမည်။
        </p>
      </div>
      <div class="explain explainPhone">
        <p>
            Phone No. (သို့မဟုတ်) Email ကို ဖြည့်ပေးရပါမည်။
            အဆိုပါ ဖုန်းနံပါတ် (သို့မဟုတ်) အီးမေးလ်သို့ OTP Code ပေးပို့မှာဖြစ်ပါသည်။
             (ပြည်ပမှ အကောင့်ဖွင့်သူများ အနေဖြင့် Email ဖြည့်သွင်းပေးရပါမည်။)
        </p>
      </div>
    <div class="card ">
      <div class="card-back">
        <div class="cardHeader">
          <div class="title">ပန်းဆက်လမ်း အကောင့် ဖွင့်ရန်</div>
          <div class="about aboutRegister"><i class="fa-solid fa-question"></i></div>
        </div>
        <div class="cardBody">
          <form action="{{route('register')}}" method="POST" >
            @csrf
            <div class="usernameGp">
              <div>
                <input type="text" placeholder="User Name (English only)" name="name" required/>
              </div>
              <div class="about aboutName"><i class="fa-solid fa-question"></i></div>
            </div>
            @error('name')
                <small style='color:red;font-size:10px;' class="error">{{ $message }}</small>
            @enderror
            <div class="ph-emailGp">
              <div><input type="text" value="09" disabled /></div>
              <div class="inputGp">
                <div><input type="text" placeholder="----"  name="phone"/></div>
                <div class="about aboutPhone"><i class="fa-solid fa-question"></i></div>
              </div>
            </div>
            @error('phone')
                <small style='color:red;font-size:10px;' class="error">{{ $message }}</small>
            @enderror
            <div>(or)</div>
            <input type="email" placeholder="Email" name="email" />
            @error('email')
                <small style='color:red;font-size:10px;' class="error">{{ $message }}</small>
            @enderror
            <input type="password" placeholder="Password" name="password" required/>
            @error('password')
                <small style='color:red;font-size:10px;' class="error">{{ $message }}</small>
            @enderror
            <input type="password" placeholder="Confirm Password" name='password_confirmation' required/>
            @error('password_confirmation')
                <small style='color:red;font-size:10px;' class="error">{{ $message }}</small>
            @enderror
            <input type="submit" value="အကောင့်သစ်ဖွင့်မည်" class="btn" />
          </form>
          <a href="{{route('loginPage')}}" class="flitBtn">အကောင့်ဝင်ရန်</a>
        </div>
      </div>
    </div>
  </section>

@endsection
