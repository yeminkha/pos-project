@extends('user.layout')
@section('dropSearch')
    <section class="searchPage">
        <div class="title" style="margin-bottom: 20px;">{{ $title }}</div>
        @foreach ($mainList as $item)
            <div class="dropdownContainer">
                <div class="dropdowntitlecontainer">
                    <div class="dropdowntitle">{{ $item->name }}</div>
                    <div class="downdownbtn ">
                        <div class="varti"></div>
                        <div class="hori"></div>
                    </div>
                </div>
                <div class="dorpdownContentBox">
                    <ul>
                        @foreach ($list as $c)
                            @if ($c->main_category_id == $item->id)
                                <li>
                                    <a href="{{ route('bookSearch', $item->id) }}">{{ $c->name }}</a>
                                    <div class="count">
                                        @foreach ($productCounts as $p)
                                            @if ($p->category_name == $c->id)
                                                {{ $p->product_count }}
                                            @endif
                                        @endforeach
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach


    </section>
@endsection
