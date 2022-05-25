<style>
    .fixat {
        position:fixed;
        top: 0;
        bottom:0;
    }
</style>
<div class="fixat">
    <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px; height:100vh">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <svg class="bi pe-none me-2" width="40" height="32">
                <use xlink:href="#bootstrap"></use>
            </svg>
            <span class="fs-4">Sidebar</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">

            <li class="nav-item">
                <a href="{{ route('home.index') }}" class="nav-link active" aria-current="page">Home</a>
            </li>
            @auth
            <li class="nav-item">
                <a href="{{ route('users.index') }}" class="nav-link active">Users</a>
            </li>
            @endauth
        </ul>
        <hr>
        <div class="dropdown">
            @auth
                <strong>{{auth()->user()->name}}</strong>
                <div class="text-start">
                    <a href="{{ route('logout.perform') }}" class="btn btn-outline-light me-2">Logout</a>
                </div>
            @endauth

            @guest
                <div class="text-start">
                    <a href="{{ route('login.perform') }}" class="btn btn-outline-light me-2">Login</a>

                </div>
                <div class="text-start">
                    <a href="{{ route('register.perform') }}" class="btn btn-warning">Sign-up</a>

                </div>
            @endguest
        </div>
    </div>
</div>

