
<header class="header">
    <nav class="nav">
        <ul class="header_menu">
            <li class="nav-link">{{Auth::user()->name }}</li>
            <li class="nav-links"><a class="nav-link listNew" href="{{Route('boards') }}">Board</a></li>
            <li class="header_menu_title">
                <a class="nav-link listNew" href="/">Laravel Trello New</a>
            </li>
            <li>
                <ul class="header_menu_inner">
                    <li>
                        <a class="nav-link" data-toggle="modal" data-target="#createboard">Create a Board</a>　　
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                         Log out
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</header>

<div class="modal fade checklist" id="createboard" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Create New Board</h4>
            </div>
            <div class="modal-body">
                <form action="{{url('boards/add')}}" method="POST" class="form-horizontal">
                    {{csrf_field()}}
                        <label for="listing" class="control-label"> List Name</label>
                        <input type="text" name="board" class="form-control board-color" value="{{old('board')}}">
                        <label for="listing" class="control-label"> Color </label>
                        <div class="store-color">
                        <label class="container">
                            <input type="checkbox" value="#808080" style="display:none;" name="grayButton">
                            <span class="checkmark markcheck"></span>
                          </label>
                          <label class="container">
                            <input type="checkbox" value="#026aa7" style="display:none;" name="grayButton">
                            <span class="checkmark check"></span>
                          </label>
                          <label class="container">
                            <input type="checkbox" value="#bb3c3c" style="display:none;" name="grayButton">
                            <span class="checkmark marks"></span>
                          </label>
                          <label class="container">
                            <input type="checkbox" value="#ff0000" style="display:none;" name="grayButton">
                            <span class="checkmark checkmarks"></span>
                          </label>
                          <label class="container">
                            <input type="checkbox" value="#0000ff" style="display:none;" name="grayButton">
                            <span class="checkmark checkm"></span>
                          </label>
                        </div>
                        <button type="submit" class="btn btn-default button-create"><i class="glyphicon glyphicon-plus"></i>Create Borad</button>
                </form>
            </div>
        </div>
    </div>
</div>


@if(count($errors)> 0)
    <!--Form Error List -->
    <div class="alert alert-danger">
        <div><strong>Please correct the characters you typed</strong></div>
        <div>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
