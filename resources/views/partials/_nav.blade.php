<!-- Default Bootstrap Navbar -->
<nav class="navbar navbar-default">
  <div class="container-fluid">

    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href={{ url('/') }} style="display: flex; align-items: center;">
        <img alt="Brand" src="../img/coding.png" width="40px">
        <span style="font-family: 'Oswald', sans-serif; font-size: 24px; color: darkcyan;">Brentwood Coding</span>
      </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li class="{{ Request::is('/') ? "active" : ""}}"><a href={{ url('/') }}>Home</a></li>
          <li><a href="https://github.com/brentwoodcoding/machine-learning">Machine Learning</a></li>
          <li class="{{ Request::is('contact') ? "active" : ""}}"><a href={{ url('/contact') }}>Contact</a></li>
          <li class="{{ Request::is('about') ? "active" : ""}}"><a href={{ url('/about') }}>About</a></li>
          <li class="{{ Request::is('release_history') ? "active" : ""}}"><a href={{ url('/release_history') }}>Release History</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            @if (Auth::check())
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hello {{ Auth::user()->name }} <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            @else
                <li><a href="{{ url('/login') }}"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                <li><a href="{{ url('/register') }}"><span class="glyphicon glyphicon-user"></span> Register</a></li>
            @endif
        </ul>
    </div><!-- /.navbar-collapse -->

  </div><!-- /.container-fluid -->
</nav>
