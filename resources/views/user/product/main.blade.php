@extends('user.layout')
@section('bookPage')
    <section class="booklastPage">
        <div class="lrContainer">
            @if (!empty($product->sideImage1) && !empty($product->sideImage2))
                <div class="left">
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide cover">
                                <img src="{{ asset('/storage/books/' . $product->image) }}" />
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('/storage/books/' . $product->sideImage1) }}" alt="" />
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('/storage/books/' . $product->sideImage2) }}" alt="" />
                            </div>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>
            @else
                <div class="left" >
                    <div class="oneImage" style="width:80%;height:300px;margin:0 auto;display:flex;justify-content:right;">
                        <img src="{{ asset('/storage/books/' . $product->image) }}" width="300px " />
                    </div>
                </div>
            @endif
            <div class="right">
                <div class="title">{{ $product->name }}</div>
                <div class="arthur"><a href="">{{ $product->arthur }}</a></div>
                <div class="react">
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
                    <div class="totalcomment">( {{ $product->total_comments }} မှတ်ချက်)</div>
                    <div class="price">{{ $product->price }} (ကျပ်)</div>
                </div>
                <div class="description">
                    <p>
                        {{ $product->description }}
                    </p>
                </div>
                <table>
                    <tr>
                        <td>pages</td>
                        <td><i>{{ $product->pages }}</i></td>
                    </tr>
                    <tr>
                        <td>စာအုပ်အရွယ်အစား</td>
                        <td><i>{{ $product->size }} inches</i></td>
                    </tr>
                    <tr>
                        <td>ပုံနှိပ်မှတ်တမ်း</td>
                        <td><i>{{ $product->print_record }}</i></td>
                    </tr>
                </table>
                <div class="backorder">
                    <span>{{ $product->in_stock }}</span>
                    in stock (can be backordered)
                </div>
                <div class="btnGp">
                    <div class="addCartBtn">ဝယ်ယူမည့်စာရင်းထဲကို ထည့်မည်</div>
                    <input type="button" value="-" class="calculateBtn" />
                    <input type="text" value="0" class="total" />
                    <input type="button" value="+" class="calculateBtn" />
                </div>
                @if ($tempOrderList != null)
                    <div class="checkCart">
                        <div class="checkList">စာရင်းကြည့်မယ်</div>
                        <div class="order">အမှာတင်မယ်</div>
                    </div>
                    {{-- <div class="likeShare">
                        <div class="likeBtn"><i class="bx bxs-heart"></i></div>
                        <div class="share"><a href="">Share</a></div>
                    </div> --}}
                @endif
            </div>
        </div>

        </div>

        </div>
        <div class="reviewContainer">
            <div class="reviewTitle">ဝေဖန်သုံးသပ်ချက်များ({{ $product->total_comments }})</div>

            @if ($comments->count() <= 0)
                <div class="reviewHere">
                    <div class="review">ဝေဖန်သုံးသပ်မှုများ</div>
                    ဒီစာအုပ်မှာ ဝေဖန်အကြံပြုချက်များ မရှိသေးပါ “{{ $product->name }}”
                    စာအုပ်အပေါ် လူကြီးမင်း၏ အမြင်ကို ဝေဖန်သုံးသပ်နိုင်ပါသည်...
                </div>
            @else
                <div class="reviewHere">
                    '{{ $product->name }}' အပေါ် ဝေဖန်သုံးသပ်ချက် {{ $product->total_comments }} ရှိပါသည်
                </div>
                <div class="commentList">
                    @foreach ($comments as $item)
                        <div class="comment">
                            <div class="left">
                                <div class="imgContainer">
                                    <img src="{{ asset('storage/user_profile/' . $item->image) }}" alt=""
                                        width="100%" height="100%">
                                </div>
                            </div>
                            <div class="right">
                                <div class="topper">
                                    <div class="topperLeft">{{ $item->user_name }} -
                                        {{ $item->created_at->format('d F Y') }}</div>
                                    <div class="topperRight">
                                        @php
                                            $fullStars = min($item->rating_count, 5); // Determine the number of full stars
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
                                </div>
                                <p>{{ $item->comment }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            @if (Auth::check())
                <div class="formContainer">
                    <form action="{{ route('reaction') }}" class="reviewTextBox" method="post">
                        @csrf
                        <div class="rateGp">
                            <div class="rateTitle">တန်ဖိုးထားရှိမှုနှုန်း</div>
                            <div class="rate">
                                <input type="radio" id="star5" name="rate" value="5" />
                                <label for="star5" title="text">5 stars</label>
                                <input type="radio" id="star4" name="rate" value="4" />
                                <label for="star4" title="text">4 stars</label>
                                <input type="radio" id="star3" name="rate" value="3" />
                                <label for="star3" title="text">3 stars</label>
                                <input type="radio" id="star2" name="rate" value="2" />
                                <label for="star2" title="text">2 stars</label>
                                <input type="radio" id="star1" name="rate" value="1" />
                                <label for="star1" title="text">1 star</label>
                            </div>
                        </div>
                        <input type='hidden' value='{{ $product->id }}' name='productId'>
                        <div class="inputContainer">
                            <label for="reviewText">ဝေဖန်သုံးသပ်လိုသောစာကို ရေးပါ</label>
                            <textarea id="reviewText" cols="30" rows="10" name="comment"></textarea>
                        </div>
                        @if ($errors->has('rate'))
                            <script>
                                alert('Rating must be filled.')
                            </script>
                        @endif
                        <input class="btn" type="submit" value="ဝေဖန်သုံးသပ်ချက်ပေးပို့မည်" />
                    </form>
                </div>
            @else
                {{-- Handle the case when the user is not authenticated --}}
                <a href="{{ route('registerPage') }}"> ဝေဖန်သုံးသပ်လိုသောစာကို ရေးရန် အကောင့်ဝင်မည်</a>
            @endif


            <div class="swiperContainer">
                <div class="swiperArthur">{{ $product->arthur }} စာအုပ်များ</div>
                <div class="swiper2 swiper mySwiper" >
                    <div class="swiper-wrapper" style="width: 100%;">
                        @if (count($suggest) >= 4)
                            @foreach ($suggest as $item)
                                <div class="swiper-slide">
                                    <div class="box">
                                        <div class="imgContainer">
                                            <img src="{{ asset('storage/books/' . $item->image) }}" alt="" />
                                        </div>
                                        <div class="title"><a href="">{{ $item->arthur }}</a></div>
                                        <div class="category">{{ $item->name }}</div>
                                        <div class="price">{{ $item->price }} (ကျပ်)</div>
                                        <div class="react">
                                            <div class="rating">
                                                <i class="bx bx-star"></i>
                                                <i class="bx bx-star"></i>
                                                <i class="bx bx-star"></i>
                                                <i class="bx bx-star"></i>
                                                <i class="bx bx-star"></i>
                                            </div>
                                            <div class="comment">( 0 မှတ်ချက်)</div>
                                        </div>
                                        <div class="btnGp">
                                            <div class="cardAdd">
                                                <i class="bx bxs-cart-alt"></i>
                                                <span>စျေးခြင်းထဲထည့်မယ်</span>
                                            </div>
                                            <div class="likeBtn">
                                                <i class="bx bxs-heart"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            @foreach ($suggest as $item)
                                <div class="box">
                                    <div class="imgContainer">
                                        <a href="{{ route('bookPage', $item->id) }}">
                                            <img src="{{ asset('storage/books/' . $item->image) }}" alt=""
                                                width="100%" />
                                    </div>
                                    <div class="title"><a href="">{{ $item->arthur }}</a></div>
                                    <div class="category">{{ $item->name }}</div>
                                    <div class="price">{{ $item->price }} (ကျပ်)</div>
                                    {{-- <div class="react">
                                        <div class="rating">
                                            <i class="bx bx-star"></i>
                                            <i class="bx bx-star"></i>
                                            <i class="bx bx-star"></i>
                                            <i class="bx bx-star"></i>
                                            <i class="bx bx-star"></i>
                                        </div>
                                        <div class="comment">( 0 မှတ်ချက်)</div>
                                    </div>
                                    <div class="btnGp">
                                        <div class="cardAdd">
                                            <i class="bx bxs-cart-alt"></i>
                                            <span>စျေးခြင်းထဲထည့်မယ်</span>
                                        </div>
                                        <div class="likeBtn">
                                            <i class="bx bxs-heart"></i>
                                        </div>
                                    </div> --}}
                                </div>
                            @endforeach
                        @endif

                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
                <div class="seemoreBtn">ပိုမိုရှာရန်</div>
            </div>
        </div>
    </section>
@endsection
@section('jquery')
    <script>
        $(document).ready(function() {
            $('.calculateBtn').on('click', function() {
                // Get the current value in the input field
                var currentValue = parseInt($('.total').val());

                // Check if currentValue is a valid number
                if (!isNaN(currentValue)) {
                    // Increment or decrement the value based on the button's value
                    if ($(this).val() === "+") {
                        currentValue++;
                    } else {
                        currentValue = Math.max(currentValue - 1, 1);
                    }

                    // Update the input field with the new value
                    $('.total').val(currentValue);
                } else {
                    // If currentValue is not a valid number, set it to 1
                    $('.total').val(1);
                }
            });

            var product = {!! json_encode($product) !!};
            var productId = product.id;
            var productPrice = product.price;
            var productImage = product.image;
            var productName = product.name;
            var productPrice = product.price;

            $('.addCartBtn').on('click', function() {
                // Retrieve the total value from the input field
                var totalAmount = $('.total').val();
                totalAmount = parseInt(totalAmount);
                totalPrice = productPrice * totalAmount;

                // Send a GET request to the server
                $.get('/getCart', {
                        quantity: totalAmount,
                        productId: productId,
                        total: totalPrice,
                        image: productImage,
                        name: productName,
                        price: productPrice
                    })
                    .done(function(response) {
                        // Handle success response here
                        console.log('Cart updated successfully:', response);
                        // Reload the page after updating the cart
                        // Reload the top-level window (the entire website)
                        window.location.reload();

                    })
                    .fail(function(xhr, status, error) {
                        // Handle failure response here
                        console.error('Error updating cart:', error);
                    });
            });
        })
    </script>
@endsection
