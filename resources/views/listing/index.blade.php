@extends('layouts.app')
@section('style')
    <style type="text/css">

    </style>
@endsection

@section('content')
    <div class="topPage">
        <div class="listWrapper">
            @foreach ($listings as $listing)
                <div class="list">
                    <div class="list_header">
                        <h2 class="list_header_title">{{ $listing->title }}</h2>
                        <div class="list_header_action">
                            <a onclick="return confirm('{{ $listing->title }} delete?')"
                                href="{{ url('/listingsdelete', $listing->id) }}"><i class="fas fa-trash"></i></a>
                            <a href="{{ url('/listingsedit', $listing->id) }}"><i class="fas fa-pen"></i></a>
                        </div>
                    </div>
                    <div class="cardWrapper">
                        @foreach ($listing->cards as $card)
                            <div class="cardDetail_link">
                                <div class="card" draggable="true">
                                    <a href="#myModal" role="button" class="cardWrappers" data-toggle="modal" cart_id="{{ $card->id }}">
                                        <h3 class="card_title">{{ $card->title }}</h3>
                                        <div class="card_detail is-exist"><i class="fas fa-bars"></i></div>
                                        <div class="card_detail is-exist left"><a class="cardDetail_link"href="listing/{{ $listing->id }}/card/{{ $card->id }}"><i class="fas fa-pen"></i></a></div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                        <div class="add_Card">
                            <a class="addCard_link" href="/listing/{{ $listing->id }}/card/new"><i class="far fa-plus-square"></i>Add more cards</a>
                        </div>
                    </div>
                </div>
            @endforeach
            @include('listing.model')
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ url('js/jquery.min.js') }}"></script>
    <script src="{{ url('js/script.js') }}">
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.9/jquery-ui.js" type="text/javascript"></script>
    <link href="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.9/themes/blitzer/jquery-ui.css" rel="stylesheet" type="text/css" />

    <script type="text/javascript">
    </script>
@endsection
