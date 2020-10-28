@extends('layouts.app')
@section('style')
    <style type="text/css">
        .fa-trash:before {
            color: #fff;
        }
   </style>
@endsection
@section('content')
<div class="form-group">
    <div class="text-text">
        <p> Please choose Your Board </p>
    </div>
    <div class="col-sm-offset-3 col-sm-6">
        @foreach($board as  $boards)
            <a href="{{ url('cart/'.$boards->id) }}">
            <div class="col-sm-2 tile-box" style="background-color:{{ $boards->image }};">
                <span>{{ $boards->title }}</span>
                <div class="delete-board">
                    <a href="{{ Route('boards.delete', $boards->id) }}"  class="delete"
                    onclick="return confirm('Are you sure you want to delete this board')"><i class="fas fa-trash"></i></a>
                </div>
            </div>
            </a>
        @endforeach
    </div>
</div>
@endsection

