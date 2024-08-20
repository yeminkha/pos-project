@extends('user.layout')
@section('reviewPage')
    <section class="ReviewPage">
        <div class="container">
            <div class="imgContainer">
                <img src="{{ asset('storage/books/' . $product->image) }}" alt="" />
            </div>
            <div class="descContainer">
                <div class="desc">
                    <div class="title">BOOK REVIEWS</div>
                    <div class="bookTitle">
                        <i>{{ $product->name }}</i>
                    </div>
                    <div class="arthur">{{ $product->arthur }}</div>
                    {{-- <div class="reviewer">Review by <i>Toe Tet Lynn</i></div> --}}
                    <div class="date">
                        Date
                        <i>{{ $product->created_at }}</i>
                    </div>
                </div>
            </div>
        </div>
        <div class="secContainer">
            <div class="paraContainer">
                <p>
                    {{ $product->description }}
                </p>
            </div>
            <div class="bookContainer">
                <div class="imgContainer"></div>
                <div class="descContainer">
                    <div class="innerContainer">
                        <div class="imgContainer">
                            <img src="{{ asset('storage/books/' . $product->image) }}" alt="" />
                        </div>
                        <div class="descContainer">
                            <div class="bookTitle">
                                <i>{{ $product->name }}</i>
                            </div>
                            <div class="arthur"><a href="">{{ $product->arthur }}</a></div>
                            <div class="category">
                                <a href="">{{ $product->reading_guide }}</a>
                            </div>
                            <div class="price">တန်ဖိုး({{ $product->price }})ကျပ်</div>
                            <div class="rating">
                                @php
                                    $fullStars = min($product->max_rating_count, 5); // Determine the number of full stars
                                    $emptyStars = 5 - $fullStars; // Calculate the number of empty stars
                                @endphp

                                @for ($i = 0; $i < $fullStars; $i++)
                                    <i class="fa-solid fa-star"></i>
                                    <!-- Render full stars -->
                                @endfor

                                @for ($i = 0; $i < $emptyStars; $i++)
                                    <i class="fa-regular fa-star"></i>
                                    <!-- Render empty stars -->
                                @endfor
                            </div>
                            <a href="{{ route('bookPage', $product->id) }}" class="orderBtn">စာအုပ်မှာမည်</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="moreBooks">
            @if (count($productList) > 1)
                <div class="title">စာပေကဏ္ဍတူဖတ်ညွှန်းများ</div>
            @endif
            <div class="innerContainer">
                @if (count($productList) > 1)
                    @for ($i = 0;$i < 3 && $i < count($productList); $i++)
                    @php $item = $productList[$i]; @endphp
                        <div class="bookContainer">
                            <div class="imgContainer">
                                <img src="{{ asset('storage/books/' . $item->image) }}" alt="" />
                            </div>
                            <div class="descContainer">
                                <div class="title">
                                    <a href="">{{ $item->name }}</a>
                                </div>
                                <div class="arthur">{{ $item->arthur }}</div>
                                <div class="desc">
                                    {{ mb_strimwidth($item->description, 0, 100, '...') }}
                                </div>
                            </div>
                        </div>
                    @endfor
                @endif
            </div>

            <div class="allbookBtn"><a href="{{ route('readingGuide') }}">All BOOKS REVIEWS</a></div>
        </div>
    </section>
@endsection
