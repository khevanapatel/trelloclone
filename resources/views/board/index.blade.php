@extends('layouts.app')
@section('style')
    <style type="text/css">
        .col-sm-2.tile-box {
            border: 1px solid;
            margin: 15px;
            padding: 30px;
            border-radius: 10px;
            background-color: #026aa7;
            color: #fff;
        }
        .col-sm-2.tile-box span {
            font-size: 17px;
            font-family: sans-serif;
            font-weight: bold;
        }
        .text-text {
            text-align: center;
            font-size: 23px;
            font-family: sans-serif;
            margin-top: 70px;
        }

    </style>
@endsection
@section('content')
<div class="form-group">
    <div class="text-text">
        <p> Plase choose Your Board </p>
    </div>
    <div class="col-sm-offset-3 col-sm-6">
        @foreach($board as $key => $value)
            <a href="{{ url('cart/'.$value->id) }}">
            <div class="col-sm-2 tile-box">
                <span>{{ $value->title }}</span>
            </div>
            </a>
        @endforeach
    </div>
</div>
@endsection

