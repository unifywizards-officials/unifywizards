@extends('layouts.app')

@section('content')

    @php
        $cards = $pricing->pricing_cards ?? [];
    @endphp

    <div class="container-fluid">

        <h1 class="page-header mb-4">
            Manage Pricing Section
        </h1>

        <div class="panel panel-inverse">

            <div class="panel-heading">

                <h4 class="panel-title">
                    Home Pricing CMS
                </h4>

            </div>

            <div class="panel-body">

                <form action="{{ route('admin.home.pricing.update') }}" method="POST" enctype="multipart/form-data">

                    @csrf

                    {{-- SECTION HEADER --}}

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <label>
                                Section Title
                            </label>

                            <input type="text" name="title" class="form-control" value="{{ $pricing->title ?? '' }}"
                                placeholder="Our Pricing">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label>
                                Highlight Text
                            </label>

                            <input type="text" name="highlight_text" class="form-control"
                                value="{{ $pricing->highlight_text ?? '' }}" placeholder="Pricing">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label>
                                Status
                            </label>

                            <select name="status" class="form-control">

                                <option value="1" {{ ($pricing->status ?? 1) == 1 ? 'selected' : '' }}>
                                    Active
                                </option>

                                <option value="0" {{ ($pricing->status ?? 1) == 0 ? 'selected' : '' }}>
                                    Inactive
                                </option>

                            </select>

                        </div>

                    </div>

                    <hr>

                    {{-- CARDS --}}

                    <div class="d-flex justify-content-between align-items-center mb-4">

                        <h3>
                            Pricing Cards
                        </h3>

                        <button type="button" class="btn btn-primary" id="addCard">

                            Add Pricing Card

                        </button>

                    </div>

                    <div id="cardWrapper">

                        @if (count($cards))
                            @foreach ($cards as $index => $card)
                                <div class="card mb-5 pricing-card">

                                    <div class="card-header d-flex justify-content-between align-items-center">

                                        <h4>
                                            Card {{ $index + 1 }}
                                        </h4>

                                        <button type="button" class="btn btn-danger removeCard">

                                            Remove

                                        </button>

                                    </div>

                                    <div class="card-body">

                                        <div class="row">

                                            {{-- CARD TITLE --}}

                                            <div class="col-md-4 mb-3">

                                                <label>
                                                    Card Title
                                                </label>

                                                <input type="text" name="card_title[]" class="form-control"
                                                    value="{{ $card['title'] ?? '' }}" placeholder="SEO">

                                            </div>

                                            {{-- SUBTITLE --}}

                                            <div class="col-md-4 mb-3">

                                                <label>
                                                    Card Subtitle
                                                </label>

                                                <input type="text" name="card_subtitle[]" class="form-control"
                                                    value="{{ $card['subtitle'] ?? '' }}"
                                                    placeholder="Search Engine Optimization">

                                            </div>

                                            {{-- PRICE --}}

                                            <div class="col-md-4 mb-3">

                                                <label>
                                                    Price
                                                </label>

                                                <input type="text" name="card_price[]" class="form-control"
                                                    value="{{ $card['price'] ?? '' }}" placeholder="$250">

                                            </div>

                                            {{-- PRICE UNIT --}}

                                            <div class="col-md-4 mb-3">

                                                <label>
                                                    Price Unit
                                                </label>

                                                <input type="text" name="card_price_unit[]" class="form-control"
                                                    value="{{ $card['price_unit'] ?? '' }}" placeholder="/mo">

                                            </div>

                                            {{-- ICON CLASS --}}

                                            <div class="col-md-4 mb-3">

                                                <label>
                                                    Icon Class
                                                </label>

                                                <input type="text" name="card_icon[]" class="form-control"
                                                    value="{{ $card['icon'] ?? '' }}" placeholder="fa-solid fa-chart-line">

                                            </div>

                                            {{-- COLOR --}}

                                            <div class="col-md-4 mb-3">

                                                <label>
                                                    Color Theme
                                                </label>

                                                <select name="card_color[]" class="form-control">

                                                    <option value="blue"
                                                        {{ ($card['color'] ?? '') == 'blue' ? 'selected' : '' }}>
                                                        Blue
                                                    </option>

                                                    <option value="red"
                                                        {{ ($card['color'] ?? '') == 'red' ? 'selected' : '' }}>
                                                        Red
                                                    </option>

                                                    <option value="yellow"
                                                        {{ ($card['color'] ?? '') == 'yellow' ? 'selected' : '' }}>
                                                        Yellow
                                                    </option>

                                                    <option value="green"
                                                        {{ ($card['color'] ?? '') == 'green' ? 'selected' : '' }}>
                                                        Green
                                                    </option>

                                                </select>

                                            </div>

                                            {{-- FEATURED --}}

                                            <div class="col-md-4 mb-3">

                                                <label>
                                                    Featured Card
                                                </label>

                                                <select name="card_featured[]" class="form-control">

                                                    <option value="0"
                                                        {{ ($card['featured'] ?? 0) == 0 ? 'selected' : '' }}>
                                                        No
                                                    </option>

                                                    <option value="1"
                                                        {{ ($card['featured'] ?? 0) == 1 ? 'selected' : '' }}>
                                                        Yes
                                                    </option>

                                                </select>

                                            </div>

                                            {{-- LAYOUT --}}

                                            <div class="col-md-4 mb-3">

                                                <label>
                                                    Layout Type
                                                </label>

                                                <select name="card_layout[]" class="form-control">

                                                    <option value="normal"
                                                        {{ ($card['layout'] ?? '') == 'normal' ? 'selected' : '' }}>
                                                        Normal
                                                    </option>

                                                    <option value="wide"
                                                        {{ ($card['layout'] ?? '') == 'wide' ? 'selected' : '' }}>
                                                        Wide
                                                    </option>

                                                    <option value="full"
                                                        {{ ($card['layout'] ?? '') == 'full' ? 'selected' : '' }}>
                                                        Full Width
                                                    </option>

                                                </select>

                                            </div>

                                            {{-- EXPLORE BUTTON TEXT --}}

                                            <div class="col-md-6 mb-3">

                                                <label>
                                                    Explore Button Text
                                                </label>

                                                <input type="text" name="explore_button_text[]" class="form-control"
                                                    value="{{ $card['explore_button_text'] ?? '' }}" placeholder="Explore">

                                            </div>

                                            {{-- EXPLORE BUTTON LINK --}}

                                            <div class="col-md-6 mb-3">

                                                <label>
                                                    Explore Button Link
                                                </label>

                                                <input type="text" name="explore_button_link[]" class="form-control"
                                                    value="{{ $card['explore_button_link'] ?? '' }}" placeholder="#">

                                            </div>

                                            {{-- CONTACT BUTTON TEXT --}}

                                            <div class="col-md-6 mb-3">

                                                <label>
                                                    Contact Button Text
                                                </label>

                                                <input type="text" name="contact_button_text[]" class="form-control"
                                                    value="{{ $card['contact_button_text'] ?? '' }}"
                                                    placeholder="Contact Us">

                                            </div>

                                            {{-- CONTACT BUTTON LINK --}}

                                            <div class="col-md-6 mb-3">

                                                <label>
                                                    Contact Button Link
                                                </label>

                                                <input type="text" name="contact_button_link[]" class="form-control"
                                                    value="{{ $card['contact_button_link'] ?? '' }}" placeholder="#">

                                            </div>

                                        </div>

                                        <hr>

                                        {{-- TAGS --}}

                                        <div class="d-flex justify-content-between align-items-center mb-3">

                                            <h5>
                                                Platform Tags
                                            </h5>

                                            <button type="button" class="btn btn-success addTag">

                                                Add Tag

                                            </button>

                                        </div>

                                        <div class="tagWrapper">

                                            @if (!empty($card['tags']))
                                                @foreach ($card['tags'] as $tagIndex => $tag)
                                                    <div class="row mb-3 tag-item">

                                                        <div class="col-md-5">

                                                            <input type="text"
                                                                name="card_tags[{{ $index }}][{{ $tagIndex }}][text]"
                                                                class="form-control" placeholder="Instagram"
                                                                value="{{ $tag['text'] ?? '' }}">

                                                        </div>

                                                        <div class="col-md-5">

                                                            <input type="text"
                                                                name="card_tags[{{ $index }}][{{ $tagIndex }}][icon]"
                                                                class="form-control" placeholder="fa-brands fa-instagram"
                                                                value="{{ $tag['icon'] ?? '' }}">

                                                        </div>

                                                        <div class="col-md-2">

                                                            <button type="button" class="btn btn-danger removeTag">

                                                                Remove

                                                            </button>

                                                        </div>

                                                    </div>
                                                @endforeach
                                            @endif

                                        </div>

                                    </div>

                                </div>
                            @endforeach
                        @endif

                    </div>

                    <button type="submit" class="btn btn-success mt-4">

                        Save Pricing Section

                    </button>

                </form>

            </div>

        </div>

    </div>

@endsection

@push('scripts')
    <script>
        let cardIndex = {{ count($cards) }};

        /*
        |--------------------------------------------------------------------------
        | ADD CARD
        |--------------------------------------------------------------------------
        */

        $('#addCard').click(function() {

            let html = `

                <div class="card mb-5 pricing-card">

                    <div class="card-header d-flex justify-content-between align-items-center">

                        <h4>
                            New Card
                        </h4>

                        <button type="button"
                            class="btn btn-danger removeCard">

                            Remove

                        </button>

                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-4 mb-3">

                                <label>
                                    Card Title
                                </label>

                                <input type="text"
                                    name="card_title[]"
                                    class="form-control">

                            </div>

                            <div class="col-md-4 mb-3">

                                <label>
                                    Card Subtitle
                                </label>

                                <input type="text"
                                    name="card_subtitle[]"
                                    class="form-control">

                            </div>

                            <div class="col-md-4 mb-3">

                                <label>
                                    Price
                                </label>

                                <input type="text"
                                    name="card_price[]"
                                    class="form-control">

                            </div>

                            <div class="col-md-4 mb-3">

                                <label>
                                    Price Unit
                                </label>

                                <input type="text"
                                    name="card_price_unit[]"
                                    class="form-control">

                            </div>

                            <div class="col-md-4 mb-3">

                                <label>
                                    Icon Class
                                </label>

                                <input type="text"
                                    name="card_icon[]"
                                    class="form-control"
                                    placeholder="fa-solid fa-chart-line">

                            </div>

                            <div class="col-md-4 mb-3">

                                <label>
                                    Color Theme
                                </label>

                                <select name="card_color[]"
                                    class="form-control">

                                    <option value="blue">
                                        Blue
                                    </option>

                                    <option value="red">
                                        Red
                                    </option>

                                    <option value="yellow">
                                        Yellow
                                    </option>

                                    <option value="green">
                                        Green
                                    </option>

                                </select>

                            </div>

                            <div class="col-md-4 mb-3">

                                <label>
                                    Featured
                                </label>

                                <select name="card_featured[]"
                                    class="form-control">

                                    <option value="0">
                                        No
                                    </option>

                                    <option value="1">
                                        Yes
                                    </option>

                                </select>

                            </div>

                            <div class="col-md-4 mb-3">

                                <label>
                                    Layout Type
                                </label>

                                <select name="card_layout[]"
                                    class="form-control">

                                    <option value="normal">
                                        Normal
                                    </option>

                                    <option value="wide">
                                        Wide
                                    </option>

                                    <option value="full">
                                        Full Width
                                    </option>

                                </select>

                            </div>

                            <div class="col-md-6 mb-3">

                                <label>
                                    Explore Button Text
                                </label>

                                <input type="text"
                                    name="explore_button_text[]"
                                    class="form-control">

                            </div>

                            <div class="col-md-6 mb-3">

                                <label>
                                    Explore Button Link
                                </label>

                                <input type="text"
                                    name="explore_button_link[]"
                                    class="form-control">

                            </div>

                            <div class="col-md-6 mb-3">

                                <label>
                                    Contact Button Text
                                </label>

                                <input type="text"
                                    name="contact_button_text[]"
                                    class="form-control">

                            </div>

                            <div class="col-md-6 mb-3">

                                <label>
                                    Contact Button Link
                                </label>

                                <input type="text"
                                    name="contact_button_link[]"
                                    class="form-control">

                            </div>

                        </div>

                        <hr>

                        <div class="d-flex justify-content-between align-items-center mb-3">

                            <h5>
                                Platform Tags
                            </h5>

                            <button type="button"
                                class="btn btn-success addTag">

                                Add Tag

                            </button>

                        </div>

                        <div class="tagWrapper"></div>

                    </div>

                </div>

            `;

            $('#cardWrapper').append(html);

            cardIndex++;

        });

        /*
        |--------------------------------------------------------------------------
        | REMOVE CARD
        |--------------------------------------------------------------------------
        */

        $(document).on('click', '.removeCard', function() {

            $(this)
                .closest('.pricing-card')
                .remove();

        });

        /*
        |--------------------------------------------------------------------------
        | ADD TAG
        |--------------------------------------------------------------------------
        */

        $(document).on('click', '.addTag', function() {

            let wrapper = $(this)
                .closest('.card-body')
                .find('.tagWrapper');

            let card = $(this)
                .closest('.pricing-card');

            let cardIndex = $('.pricing-card')
                .index(card);

            let tagCount = wrapper
                .find('.tag-item')
                .length;

            let html = `

                <div class="row mb-3 tag-item">

                    <div class="col-md-5">

                        <input type="text"
                            name="card_tags[` + cardIndex + `][` + tagCount + `][text]"
                            class="form-control"
                            placeholder="Instagram">

                    </div>

                    <div class="col-md-5">

                        <input type="text"
                            name="card_tags[` + cardIndex + `][` + tagCount + `][icon]"
                            class="form-control"
                            placeholder="fa-brands fa-instagram">

                    </div>

                    <div class="col-md-2">

                        <button type="button"
                            class="btn btn-danger removeTag">

                            Remove

                        </button>

                    </div>

                </div>

            `;

            wrapper.append(html);

        });

        /*
        |--------------------------------------------------------------------------
        | REMOVE TAG
        |--------------------------------------------------------------------------
        */

        $(document).on('click', '.removeTag', function() {

            $(this)
                .closest('.tag-item')
                .remove();

        });
    </script>
@endpush
