<nav class="navbar navbar-default navbar-fixed-top" style="background-color: #5CB572;margin-bottom: 0;">
    <div class="container-fluid">
        <div class="navbar-header">
            <p style="cursor:default;padding: 10px 0px 0px 0px;font-size: 18px;">
                <a style="color: black;text-decoration: none;" href="{{ url('customerinfo') }}">凱特夫人 Flower Shop</a>
            </p>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a style="color: black;" href="{{ url('headinfo') }}">管理者</a></li>
                <li><a style="color: black" href="#" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">登出</a></li>
                {{--
                <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
                --}}
            </ul>
        </div>
    </div>
</nav>
