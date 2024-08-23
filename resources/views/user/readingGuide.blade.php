@extends('user.layout')
@section('readingGuide')
    <section class="readingGuide">
        <div class="container">
            <div class="left">
                @foreach ($productList as $item)
                    <div class="item">
                        <div class="item-left">
                            <img src="{{ asset('storage/books/' . $item->image) }}" alt="" />
                        </div>
                        <div class="item-right">
                            <div class="item-right-inner">
                                <div class="title">
                                    <a href=""><i>{{ $item->name }}</i></a>
                                </div>
                                <div class="readingGuideTitle">
                                    <a href="">{{ $item->reading_guide }}</a>
                                </div>
                                <div class="readingGuidepara">
                                    <p>
                                        {{ mb_strimwidth($item->description, 0, 250, '...') }} </p>
                                </div>
                                <a href="{{ route('readingGuideBookPage', $item->id) }}" class="bookBtn">ဖတ်ညွှန်းဖတ်မည်</a>
                            </div>
                        </div>
                        <div class=" add">
                            <p>
                                {{ mb_strimwidth($item->description, 0, 250, '...') }} </p>
                            </div>

                    </div>
                @endforeach
            </div>
            <div class="right">
                <div class="rightInner">
                    <div class="title">စာဖတ်သူတို့ညွှန်းသောဖတ်ညွှန်းများ</div>
                    <div class="category"><i>စာအုပ်ကဏ္ဍအမျိုးအစား</i></div>
                    <ul>
                        @foreach ($readingGuideList as $item)
                            <li><a
                                    href="{{ route('readingGuideSearch', $item->reading_guide) }}">{{ $item->reading_guide }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection
