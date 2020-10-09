
<header class="header">
    <nav class="nav">
        <ul class="header_menu">
            <li class="nav-link">{{Auth::user()->name }}</li>
            <li class="header_menu_title">
                <a class="nav-link listNew" href="/">Laravel Trello</a>
            </li>
            <li>
                <ul class="header_menu_inner">

                    <li>
                        <a class="nav-link" href="{{ route('carts') }}">Cart</a>　　
                    </li>

                    <li>
                        <a class="nav-link listNew" href="{{ route('new') }}">Create a list</a>　　
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
