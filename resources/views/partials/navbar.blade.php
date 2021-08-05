<nav class="navbar navbar-expand">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <ul class="navbar-nav">
        <li class="nav-item small-screens-sidebar-link">
            <a href="#" class="nav-link"><i class="material-icons-outlined">menu</i></a>
        </li>
        <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="{{ asset('assets/images/avatars/profile-image-1.png') }}" alt="profile image">
                <span>Nancy Moore</span><i class="material-icons dropdown-icon">keyboard_arrow_down</i>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Settings</a>
                <a class="dropdown-item" href="#">Change Password</a>
                <a class="dropdown-item" href="#">Change Avatar</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Log out</a>
            </div>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link" id="dark-theme-toggle"><i class="material-icons-outlined">brightness_2</i><i class="material-icons">brightness_2</i></a>
        </li>
    </ul>
</nav>
