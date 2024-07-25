@extends('user.layout')
@section('dropSearch')
    <section class="searchPage">
        <div class="title">{{ $title }}</div>
        <form class="inputContainer" style="position: relative" action="{{ route('arthurSearchInput') }}" method="GET">
            <input type="text" placeholder="ရှာဖွေရန်" id="arthur" name="arthur_name"/>
            <div class="suggestBoxAr"
                style="top:40px;background-color:#EAEAEA;visibility:hidden;max-height:100px;width:32%;overflow:scroll;overflow-x:hidden;position:absolute;z-index:999;">
            </div>
        </form>
        @foreach ($mainList as $item)
            <div class="dropdownContainer">
                <div class="dropdowntitlecontainer">
                    <div class="dropdowntitle">{{ $item['name'] }}</div>
                    <div class="downdownbtn ">
                        <div class="varti"></div>
                        <div class="hori"></div>
                    </div>
                </div>
                <div class="dorpdownContentBox">
                    <ul>
                        @foreach ($list as $c)
                            @if (isset($c[$item['name']]))
                                @foreach ($c[$item['name']] as $item)
                                    <li>
                                        <a href="{{ route('arthurSearch', $item['name']) }}">{{ $item['name'] }}</a>
                                        <div class="count">
                                            @foreach ($productCounts as $p)
                                                @if ($p->arthur == $item->name)
                                                    {{ $p->product_count }}
                                                @endif
                                            @endforeach
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach


    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const arthurInput = document.querySelector('#arthur');
            const suggestBoxAr = document.querySelector('.suggestBoxAr');
            const arthurs = <?php echo json_encode($arthurs); ?>;

            arthurInput.addEventListener('input', function(event) {
                handleInputEvent(event, arthurInput, suggestBoxAr, arthurs);
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
                    }
                });
                suggestBox.style.visibility = inputValue.length > 0 ? 'visible' : 'hidden';
            }
        });
    </script>
@endsection
