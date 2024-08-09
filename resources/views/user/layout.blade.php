<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PannsatlanClone</title>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('user/usermain.css') }}" />
    <script>
        window.addEventListener("pageshow", function(event) {
            var historyTraversal = event.persisted ||
                (typeof window.performance != "undefined" &&
                    window.performance.navigation.type === 2);
            if (historyTraversal) {
                // Handle page restore.
                window.location.reload();
            }
        });
    </script>
</head>

<body>
    <header>
        <div class="logo">
            <img src="https://www.pannsattlann.com/wp-content/uploads/2022/01/cropped-cropped-cropped-Logo-2-10.png"
                alt="" />
        </div>
        <div class="inputGp" style="position: relative">
            @php
                $tempOrderList = session('tempOrderList');
                $totalPrice = 0;
                if ($tempOrderList != null) {
                    foreach ($tempOrderList as $item) {
                        // Cast to integers before performing multiplication
                        $totalPrice += (int) $item['price'] * (int) $item['quantity'];
                    }
                }
            @endphp
            <i class="fa-solid fa-bars menu"></i>

            <form action="{{ route('book') }}" method="POST">
                @csrf
                <input type="text" name="name" id="search" placeholder="စာအုပ်ရှာရန်..." />
                <button type="submit"><i class="bx bx-search-alt"></i></button>
            </form>
            <div class="suggestBoxAll"
                style="left:320px;top:85px;background-color:#EAEAEA;visibility:visible;max-height:300px;width:44%;overflow:scroll;overflow-x:hidden;position:absolute;z-index:999;">
            </div>
            <div class="noti">
                <a @if (session()->has('tempOrderList')) href="{{ route('tempOrderListPage') }}" @endif>
                    <div class="number">
                        @if (session()->has('tempOrderList'))
                            {{ count(session('tempOrderList')) }}
                        @else
                            0
                        @endif
                    </div>
                    <i class="bx bx-shopping-bag">
                    </i>
                </a>
                <div class="chart">
                    <p>စုစုပေါင်း</p>
                    <div class="total">{{ $totalPrice }}<span>(ကျပ်)</span></div>
                </div>
            </div>
        </div>

        <div class="nav-container">
            <nav>
                <a class="dropbtn" href="{{ route('homePage') }}">Pan Home</a>
                <div class="dropdown">
                    <button class="dropbtn">စာအုပ်များအားလုံး</button>
                    <div class="dropdown-content">
                        <a href="{{ route('newBooks') }}">အသစ်ထွက်စာအုပ်များ</a>
                        <a href="{{ route('mostSell') }}">အရောင်းရဆုံးစာအုပ်များ</a>
                        <a href="{{ route('editorFav') }}">အယ်ဒီတာအဖွဲ့စိတ်ကြိုက်စာအုပ်များ</a>
                        <a href="{{ route('suya') }}">စာပေဆုရစာအုပ်များ</a>
                        <a href="{{ route('classic') }}">မြန်မာစာပေ ဂန္ထဝင်စာအုပ်များ</a>
                    </div>
                </div>
                <div class="dropdown">
                    <a class="dropbtn" href="{{ route('dropSearchList', ['key' => 'cati']) }}">စာအုပ်အမျိုးအစား</a>
                    <div class="dropdown-content">
                        @if (!empty($mainCategoryList))
                            @foreach ($mainCategoryList as $m)
                                <a href="{{ route('bookSearchMain', $m->id) }}"
                                    class="mainCategory">{{ $m->name }}</a>
                                @if (!empty($categoryList))
                                    @foreach ($categoryList as $c)
                                        @if ($c->main_category_id == $m->id)
                                            <a href="{{ route('bookSearch', $c->id) }}"
                                                style="margin-left: 10px;">{{ $c->name }}</a>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="dropdown">
                    <a href="{{ route('dropSearchList', ['key' => 'arthur']) }}" class="dropbtn">စာရေးဆရာများ</a>
                    <div class="dropdown-content">
                        @if (!empty($arthurList))
                            @foreach ($arthurList as $item)
                                <a href="{{ route('arthurSearch', $item->arthur) }}">{{ $item->arthur }}</a>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="dropdown">
                    <a href='{{ route('readingGuide') }}' class="dropbtn">စာအုပ်ဖတ်ညွှန်းများ</a>
                    <div class="dropdown-content">
                        <ul>
                            @foreach ($readingGuideList as $item)
                                <li><a
                                        href="{{ route('readingGuideSearch', $item->reading_guide) }}">{{ $item->reading_guide }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="dropdown">
                    <a href="{{ route('servicePage') }}" class="dropbtn">ဝန်ဆောင်မှုများ</a>
                    <div class="dropdown-content">
                        <a href="{{ url('/servicePage#book_mark_card') }}">စာအုပ်ဖုံး စာမှတ်ကဒ်လက်ဆောင်</a>
                        <a href="{{ url('/servicePage#tracking') }}">ပို့ဆောင်မှုခြေရာခံစနစ်</a>
                        <a href="{{ url('/servicePage#local_deli') }}">ပြည်တွင်းပို့ဆောင်မှုစနစ်</a>
                        <a href="{{ url('/servicePage#inter_deli') }}">နိုင်ငံတကာပို့ဆောင်မှုစနစ်</a>
                        <a href="{{ url('/servicePage#deli_charges') }}">ပို့ခနှုန်းထားနှင့် ငွေပေးချေမှုစနစ်</a>
                        <a href="{{ url('/servicePage#deli_time') }}">ပို့ဆောင်မှုကြာမြင့်ချိန်</a>
                        <a href="{{ url('/servicePage#responsibility') }}">တာဝန်ယူမှုများ</a>
                        <a href="{{ url('/servicePage#copyright') }}">မှုပိုင်ခွင့်ကာကွယ်ပေးမှု</a>
                    </div>
                </div>
                <div class="wishList">
                    <a class="dropbtn">WISHLIST</a>
                </div>
                <div class="myAcc">
                    <div class="dropdown">
                        <button class="dropbtn">MY ACCOUNT</button>
                        <div class="dropdown-content">
                            @if (Auth::check() && Auth::user()->role != null)
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    {{-- <i class="fa-solid fa-right-to-bracket" style="margin-right: -5px"></i> --}}
                                    <input type="submit" value="အကောင့်ထွက်ရန်" style="display:inline;border:none;">
                                </form>
                                <a href="{{ route('accMain') }}">မိမိအကောင့်</a>
                            @else
                                <a href="{{ route('loginPage') }}">
                                    <i class="fa-solid fa-right-to-bracket" style="margin-right: 2px"></i>အကောင့်ဝင်ရန်
                                </a>
                                <a href="{{ route('registerPage') }}">
                                    <i class="fa-solid fa-user" style="margin-right: 2px"></i>အကောင့်သစ်ဖ္ငင့်ရန်
                                </a>
                            @endif
                        </div>

                    </div>
                    <div class="profile">
                        @if (Auth::check() && Auth::user()->role != null)
                            <img src="{{ asset('storage/user_profile/', Auth::user()->image) }}" alt="" />
                        @else
                            <img src="{{ asset('\storage\user_profile\userpf.png') }}" alt="" />
                        @endif

                    </div>
                </div>
            </nav>
        </div>
    </header>
    <div class="menuSlider">
        <a class="dropbtn" href="{{ route('homePage') }}">Pan Home</a>
        <button class="dropbtn">စာအုပ်များအားလုံး</button>
        <a class="dropbtn" href="{{ route('dropSearchList', ['key' => 'cati']) }}">စာအုပ်အမျိုးအစား</a>
        <a href="{{ route('dropSearchList', ['key' => 'arthur']) }}" class="dropbtn">စာရေးဆရာများ</a>
        <a href='{{ route('readingGuide') }}' class="dropbtn">စာအုပ်ဖတ်ညွှန်းများ</a>
        <a href="{{ route('servicePage') }}" class="dropbtn">ဝန်ဆောင်မှုများ</a>

        <button class="dropbtn">WISHLIST</button>
        <button class="dropbtn">My Account</button>

    </div>
    <div class="busket">
        <i class="fa-solid fa-basket-shopping"></i>
        <div class="number">
            @if (session()->has('tempOrderList'))
                {{ count(session('tempOrderList')) }}
            @else
                0
            @endif
        </div>
    </div>
    <div class="slider">
        <div class="sliderHeader">
            <div class="logoContainer">
                <div class="logo">
                    <i class="bx bx-shopping-bag"></i>
                </div>
                <div class="number">0</div>
            </div>
            <div class="title">လူကြီးမင်း၏စျေးခြင်း</div>
            <div class="closeBtn">
                <i class="bx bx-x"></i>
            </div>
        </div>

        <div class="sliderBody">
            @if (session()->has('tempOrderList'))
                @php
                    $tempOrderList = session('tempOrderList');
                @endphp
                @foreach ($tempOrderList as $key => $item)
                    <div class="item">
                        <img src="{{ asset('storage/books/' . $item['image']) }}" alt="" />
                        <div class="priceTag">
                            <div class="desc">
                                <div class="title">{{ $item['name'] }}</div>
                                <div class="price">
                                    <div class="amount">{{ $item['quantity'] }} X {{ $item['price'] }} (ကျပ်)</div>
                                    <div class="total">= {{ $item['total'] }} (ကျပ်)</div>
                                </div>
                            </div>

                            <div class="delete ">
                                <input type="hidden" class="voucherCode" value="{{ $item['voucherCode'] }}">
                                <i class="bx bx-trash-alt"></i>
                            </div>
                        </div>
                    </div>
                @endforeach

            @endif
        </div>

        <div class="sliderFooter">
            <div class="subTotal">Subtotal: {{ $totalPrice }} (ကျပ်)</div>

            <a style='display:block;'
                @if (session()->has('tempOrderList') && count(session('tempOrderList')) > 0) href="{{ route('tempOrderListPage') }}" @endif
                class="seeList">စာရင်းကြည့်မယ်</a>
            <a style='display:block;' class="order"
                @if (session()->has('tempOrderList') && count(session('tempOrderList')) > 0) href="{{ route('orderPage') }}" @endif>အမှာတင်မယ်</a>
        </div>


    </div>
    </div>
    @yield('content')
    @yield('bookListPage')
    @yield('bookPage')
    @yield('servicePage')
    @yield('dropSearch')
    @yield('readingGuide')
    @yield('reviewPage')
    @yield('accountMainPage')
    @yield('noBook')
    <footer>
        <div class="pageLinks">
            <ul>
                <li><a href="{{ route('homePage') }}">စာအုပ်ဖတ်ညျွန်းများ</a></li>
                <li><a href="">စာအုပ်အားလုံး</a></li>
                <li><a href="{{ route('dropSearchList', ['key' => 'cati']) }}">စာအုပ်အမျိုးအစား</a></li>
                <li><a href="{{ route('dropSearchList', ['key' => 'arthur']) }}">စာရေးဆရာများ</a></li>
                <li><a href="">မိမိအကောင့်</a></li>
                <li><a href="">ပင်မစာမျက်နှာ</a></li>
            </ul>
        </div>
        <div class="service">
            <ul>
                <li><a href="">ဝန်ဆောင်မှုများ</a></li>
                <li><a href="{{ url('/servicePage#local_deli') }}">ပြည်တွင်းပို့ဆောင်မှု</a></li>
                <li><a href="{{ url('/servicePage#inter_deli') }}">ပြည်ပပို့ဆောင်မှု</a></li>
                <li><a href="{{ url('/servicePage#payment') }}">ငွေပေးချေမှု</a></li>
                <li><a href="{{ url('/servicePage#deli_charges') }}">ပို့ခနှုန်းထား</a></li>
                <li><a href="{{ url('/servicePage#responsibility') }}">တာဝန်ယူမှုများ</a></li>
            </ul>
        </div>
        <div class="address">
            <p>
                No.(454), Myintawthar Rd, Tharketa Tsp,Yangon. Ph: +95 9788397540, +95
                9880526703 info@pannsattlann.com, www.pannsattlann.com Copyright ©
                2019 Pann Satt Lann Co.,Ltd.
            </p>
        </div>
    </footer>
    <script src="https://kit.fontawesome.com/6142173158.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://kit.fontawesome.com/6142173158.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('user/usermain.js') }}"></script>
</body>
@yield('jquery')
<script>
    $(document).ready(function() {

        $(' .delete').on('click', function() {
            var voucherCode = $(this).find('.voucherCode').val();
            var $item = $(this).closest('.item');

            // Send the voucherCode to the server via AJAX
            $.get('/deleteTempList', {
                voucherCode: voucherCode
            }, function(response) {
                // Handle the response from the server
                if (response.success) {
                    $item.remove(); // Remove the item from the DOM if deletion was successful
                    location.reload();
                } else {
                    console.error('Failed to delete item');
                }
            });
        });

    });
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.querySelector('#search');
        const suggestBoxAll = document.querySelector('.suggestBoxAll');
        const books = <?php echo json_encode($books); ?>;

        searchInput.addEventListener('input', function(event) {
            handleInputEvent(event, searchInput, suggestBoxAll, books);
        });

        function handleInputEvent(event, inputField, suggestBox, options) {
            const inputValue = event.target.value.toLowerCase();

            suggestBox.innerHTML = '';

            options.forEach(function(option) {
                // Ensure option is a string
                if (typeof option === 'string') {
                    const optionValue = option.toLowerCase();

                    if (optionValue.includes(inputValue)) {
                        const itemDiv = document.createElement('div');
                        itemDiv.classList.add('item');
                        itemDiv.style.padding = '5px';
                        itemDiv.style.cursor = 'pointer';
                        itemDiv.textContent = option;

                        itemDiv.addEventListener('click', function() {
                            inputField.value = option;
                            suggestBox.style.visibility = 'hidden';
                        });



                        suggestBox.appendChild(itemDiv);
                    }

                    console.log(suggestBox);
                }
            });
            suggestBox.style.visibility = inputValue.length > 0 ? 'visible' : 'hidden';
        }
    });
</script>


</html>
