
<header class="header">
    <nav class="nav">
        <ul class="header_menu">
            <li class="nav-link">{{Auth::user()->name }}</li>
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
                        <label for="listing" class="control-label">List name</label>
                        <input type="text" name="board" class="form-control" value="{{old('board')}}">
                        <button type="submit" class="btn btn-default button-create"><i class="glyphicon glyphicon-plus"></i>Create Borad</button>
                </form>
            </div>
        </div>
    </div>
</div>
