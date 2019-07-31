<nav class="navbar navbar-expand-lg text-light fixed-top main-navbar">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">
            @section('pageTitle') Simple Recipes @show
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
            <ul class="navbar-nav mr-auto">

            </ul>

            <ul class="navbar-nav ml-auto">
                @guest
                    <li class="nav-item">{{ Html::link(route('login'), 'Login', ['class' => 'logged-in']) }}</li>
                    <li class="nav-item">{{ Html::link(route('register'), 'Register', ['class' => 'logged-in']) }}</li>
                @else
                    <li class="nav-item">{{ Html::link('#', 'Logout', ['id' => 'logout-btn', 'class' => 'logged-in']) }}</li>
                    <li class="nav-item"><i class="fa fa-list" aria-hidden="true"></i></li>
                    <li class="nav-item add-category"><i class="fa fa-plus" aria-hidden="true"></i></li>
                    <li class="nav-item sidebar-toggle"><i class="fa fa-bars" aria-hidden="true"></i></li>
                @endif
            </ul>
        </div>
    </div>
</nav>
