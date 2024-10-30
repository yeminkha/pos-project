@extends('user/layout')
@section('content')
    <section class="home">
        <div class="imgContainer">
            @if (count($mostSoldProducts) > 0)
                <img src="https://www.pannsattlann.com/wp-content/uploads/2023/05/Bestseller-Header-May-4.png"
                    alt="" />
            @endif
        </div>
        @if (count($mostSoldProducts))
            <div class="bookContainerOuter">
                <div class="bookContainer">
                    @foreach ($mostSoldProducts as $item)
                        <a href="{{ route('bookPage', $item->id) }}">
                            <img src="{{ asset('/storage/books/' . $item->image) }}" alt="{{ $item->name }}">
                        </a>
                    @endforeach
                    <div class="line1"></div>
                    @if (count($newProducts) > 5)
                        <div class="line2"></div>
                    @endif
                </div>
                <a href="{{ route('mostSell') }}" class="btn">အ‌ရောင်းရဆုံးစာအုပ်များကြည့်ရန်</a>
            </div>
        @endif
        @if (count($newProducts))
            <div class="swiperContainer">
                <div class="title">Preorder နှင့် အသစ်ထွက်စာအုပ်များ</div>
                <!-- Slider main container -->
                <div class="swiperContainerInner">
                    <div class="swiper homeswiper">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            @foreach ($newProducts as $item)
                                <div class="swiper-slide" >
                                    <a href="{{ route('bookPage', $item->id) }}">
                                        <img src="{{ asset('/storage/books/' . $item->image) }}" alt="{{ $item->name }}">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <!-- If we need navigation buttons -->
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                    <div class="line"></div>
                </div>
                <div class="btnContainer">
                    <a href="{{ route('newBooks') }}" class="btn">ပိုမိုရှာရန်</a>
                </div>
            </div>
        @endif
        @if (count($topRatedProducts))
            <div class="swiperContainer">
                <div class="title">Top Rated Books</div>
                <!-- Slider main container -->
                <div class="swiperContainerInner">
                    <div class="swiper homeswiper">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            @foreach ($topRatedProducts as $item)
                                <div class="swiper-slide">
                                    <a href="{{ route('bookPage', $item->id) }}">
                                        <img src="{{ asset('/storage/books/' . $item->image) }}" alt="{{ $item->name }}">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <!-- If we need navigation buttons -->
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                    <div class="line"></div>
                </div>
                <div class="btnContainer">
                    <a href="{{route('topRatedBooks')}}" class="btn">ပိုမိုရှာရန်</a>
                </div>
            </div>
        @endif
        @if (count($editorChoiceProducts))
            <div class="swiperContainer">
                <div class="title">အယ်ဒီတာအဖွဲ့ စိတ်ကြိုက်စာအုပ်များ</div>
                <!-- Slider main container -->
                <div class="swiperContainerInner">
                    <div class="swiper homeswiper">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            @foreach ($editorChoiceProducts as $item)
                                <div class="swiper-slide">
                                    <a href="{{ route('bookPage', $item->id) }}">
                                        <img src="{{ asset('/storage/books/' . $item->image) }}"
                                            alt="{{ $item->name }}">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <!-- If we need navigation buttons -->
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                    <div class="line"></div>
                </div>
                <div class="btnContainer">
                    <a href="{{ route('editorFav') }}" class="btn">ပိုမိုရှာရန်</a>
                </div>
            </div>
        @endif
        @if (count($mainCategory))
            @foreach ($mainCategory as $mainCategoryName)
                @php
                    $normalizedCategoryName = mb_strtolower(trim(json_decode($mainCategoryName)->id));
                    $topRatedProductsForCategory = $topRatedProducts->where(
                        'main_category_name',
                        $normalizedCategoryName,
                    );
                @endphp

                @if ($topRatedProductsForCategory->isNotEmpty())

                    <div class="swiperContainer">
                        <div class="title">{{ json_decode($mainCategoryName)->name }}စာအုပ်ကောင်းများ</div>
                        <!-- Slider main container -->
                        <div class="swiperContainerInner">
                            <div class="swiper homeswiper">
                                <!-- Additional required wrapper -->
                                <div class="swiper-wrapper">
                                    <!-- Slides -->
                                    @foreach ($topRatedProductsForCategory as $topitem)
                                        <div class="swiper-slide">
                                            <a href="{{ route('bookPage', $topitem->id) }}">
                                                <img src="{{ asset('/storage/books/' . $topitem->image) }}"
                                                    alt="{{ $topitem->name }}">
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                                <!-- If we need navigation buttons -->
                                <div class="swiper-button-prev"></div>
                                <div class="swiper-button-next"></div>
                            </div>
                            <div class="line"></div>
                        </div>
                        <div class="btnContainer">
                            <a href="{{route('ratedBooksOnCati',['key' => json_decode($mainCategoryName)->id])}}" class="btn">ပိုမိုရှာရန်</a>
                        </div>
                    </div>
                @endif
            @endforeach
            <div class="category">
                <div class="title">စာအုပ်အမျိုးအစားများ(book categories)</div>
                <div class="categoriesContainer">
                    @foreach ($mainCategoryList as $item)
                        <a>
                            <img src="{{ asset('storage/mainCategory/' . $item->image) }}" alt="" />
                            <div class="title">{{ $item->name }}</div>
                        </a>
                    @endforeach
                </div>
                <a href="{{ route('dropSearchList', ['key' => 'cati']) }}" class="btn">ပိုမိုရှာရန်</a>
            </div>
        @endif

    </section>
@endsection
