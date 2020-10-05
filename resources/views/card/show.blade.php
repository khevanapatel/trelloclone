@extends('layouts.app')
@section('content')
    <div class='carddetailPage'>
        <div class="container">
            <div class="cardContents">
                <div class="cardContents_title">
                    <div>title</div>
                    <h2>{{ $card->title }}</h2>
                </div>
                <div class="cardContents_memo">
                    <div>Note</div>
                    <div>{{ $card->memo }}</div>
                </div>
                <div class="cardContents_listStatus">
                    <div>List name</div>
                    <div>{{ $listing->title }}</div>
                </div>
                <div class="cardContents_btnArea">
                    <a class="edit_btn" href="/listing/{{ $listing->id }}/card/{{ $card->id }}/edit">Edit</a>
                    <a class="text-danger delete_btn"  onclick="return confirm('Is it okay to delete this card?')" rel="nofollow" data-method="delete" href="/listing/{{ $listing->id }}/card/{{ $card->id }}/delete">Delete</a>
                </div>
            </div>
        </div>
    </div>
@endsection