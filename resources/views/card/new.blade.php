@extends('layouts.app')
@section('content')
    <!-- Validation error -->
    @include('common.errors')
    <div class="cardnewPgae">
        <div class='container'>
            <form class="cardnewForm" action="/listing/{{ $listing_id }}/card" accept-charset="UTF-8" data-remote="true" method="post">
                {{csrf_field()}}
                <input value="{{ $listing_id }}" type="hidden" name="listing_id">
                <div class="cardnewForm_title">
                    <label for="card_title">title</label>
                    <input autofocus="autofocus" class="form-control" placeholder="card name" type="text" name="card_title" value="{{ old('card_title') }}">
                </div>
                <div class="cardnewForm_memo">
                    <label for="card_memo">Note</label>
                    <textarea autofocus="autofocus" class="form-control" placeholder="Details" name="card_memo">{{ old('card_memo') }}</textarea>
                    <div class="text-center"><input type="submit" name="commit" value="create" class="submitBtn" data-disable-with="create"></div>
                </div>
            </form>
        </div>
    </div>
@endsection

