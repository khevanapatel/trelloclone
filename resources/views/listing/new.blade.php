@extends('layouts.app')
@section('content')
    <div class="panel-body">
        {{--Displayed in case of validation error--}}
        @include('common.errors')
        {{--Listing Form--}}
        <form action="{{url('listings')}}" method="POST" class="form-horizontal">
            {{csrf_field()}}
            <div class="form-group">
                <label for="listing" class="col-sm-3 control-label">List name</label>
                <div class="col-sm-6">
                    <input type="text" name="list_name" class="form-control" value="{{old('list_name')}}">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="glyphicon glyphicon-plus"></i>Create
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
