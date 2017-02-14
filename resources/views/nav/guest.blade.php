<!-- NavBar For Guest Users -->
<nav class="nav">
    <div class="nav-left" style="padding-left: 30px;">
        <a class="nav-item is-active" href="/">
            <span class="icon">
              <i class="fa fa-home"></i>
            </span>
            <span style="margin-left: 4px;">Home</span>
        </a>
        {{--<a class="nav-item" style="font-weight: normal;" href="/about">--}}
            {{--About--}}
        {{--</a>--}}
        <a class="nav-item" href="/topics">
            Topics
        </a>
    </div>

    <!-- This "nav-toggle" hamburger menu is only visible on mobile -->
    <!-- You need JavaScript to toggle the "is-active" class on "nav-menu" -->
    <span class="nav-toggle">
    <span></span>
    <span></span>
    <span></span>
  </span>

    <!-- This "nav-menu" is hidden on mobile -->
    <!-- Add the modifier "is-active" to display it on mobile -->
    <div id="right-navbar" class="nav-right nav-menu" style="padding-right: 30px;">
    <span class="nav-item">
        <a class="button" href="/login">
                Login
        </a>
        <a class="button is-primary" href="/register">
            <span class="icon">
                <i class="fa fa-flash"></i>
            </span>
            <span><strong>Join</strong></span>
        </a>
    </span>
    </div>
</nav>

