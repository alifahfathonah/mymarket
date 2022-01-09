<div>
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>

            <li class="nav-item d-none d-sm-inline-block">
                @if(Auth::user()->role_id == '1')
                    <a href="{{route('admin.dashboard')}}" class="nav-link">Home</a>
                @endif
            </li>

        </ul>


        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">

            <li class="nav-item">
                <a class="nav-link"  href="{{route('logout')}}" role="button">
                    <i class="fas fa-th-large"></i> Logout
                </a>
            </li>
        </ul>
    </nav>
</div>
