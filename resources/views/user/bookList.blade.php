@extends('user.layout')
@section('bookListPage')
    <section class="haveBook">
        <div class="titleGp">
            <div class="title">{{ $title }}</div>
            <div class="totalBook">(စာအုပ် {{ count($list) }} အုပ်ရှိပါသည်)</div>
        </div>
        <div class="books">
            @foreach ($list as $item)
                <div class="box">
                    <div class="imgContainer">
                        <a href="{{ route('bookPage', $item->id) }}">
                            <img src="{{ asset('storage/books/' . $item->image) }}" alt="" />
                    </div>
                    <input type="hidden" name="bookId" value="{{ $item->id }}">
                    <input type="hidden" name="image" value="{{ $item->image }}">
                    <div class="title"><a href="{{ route('arthurSearch', $item->arthur) }}" class="titleLink">{{ $item->arthur }}</a></div>
                    <div class="category">{{ $item->name }}</div>
                    <div class="price">{{ $item->price }} (ကျပ်)</div>
                    <div class="react">
                        <div class="rating">
                            @php
                                $fullStars = min($item->average_rating, 5); // Determine the number of full stars
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
                        <div class="comment">( @if ($item->comment_count == null)
                                0
                            @else
                                {{ $item->comment_count }}
                            @endif မှတ်ချက်)</div>
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
            @endforeach
        </div>
    </section>
@endsection
@section('jquery')
    <script>
        $(document).ready(function() {


            $('.cardAdd').on('click', function() {
                var productId = $(this).closest('.box').find('input[name="bookId"]').val();
                var productImage = $(this).closest('.box').find('input[name="image"]').val();
                var priceText = $(this).closest('.box').find('.price').text();
                var price = parseInt(priceText.replace(/[^0-9]/g, ''));
                var name = $(this).closest('.box').find('.category').text();
                console.log(productId, productImage, name, price);
                $.get('/getCart', {
                        quantity: 1,
                        productId: productId,
                        total: price,
                        image: productImage,
                        name: name,
                        price: price
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
