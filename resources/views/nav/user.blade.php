<!-- Navbar For Authenticated Users -->
<nav class="nav" v-if="user">
    <div class="nav-left">
        <a class="nav-item" href="/">
            {{--<img src="/img/logos/little_logo_black.png" alt="Booknshelf logo">--}}
            Booknshelf
        </a>
        <a class="nav-item is-tab" href="/books">
            Books
        </a>
        <a class="nav-item is-tab" href="/bookshelves">
            Bookshelves
        </a>
        <a class="nav-item is-tab" href="/topics">
            Topics
        </a>
        <a class="nav-item is-tab" href="{{ route('bookshelves_path', ['username' => Auth::user()->username]) }}">
            Search
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
    <div class="nav-right nav-menu">
        <a class="nav-item" @click="showNewShelfModal = true">
            <span class="icon">
                <i class="fa fa-plus"></i>
            </span>
        </a>
        <a class="nav-item" href="{{ route('bookshelves_path', ['username' => Auth::user()->username]) }}">
            My Bookshelves
        </a>
        <a class="nav-item" href="/friends">
            Friends
        </a>
        <a class="nav-item" href="{{ route('profile_path', ['username' => Auth::user()->username]) }}">
            <figure class="image is-24x24" style="margin-right: 8px;">
                <img src="{{ Auth::user()->avatar }}">
            </figure>
            Profile
        </a>

        </span>
    </div>
</nav>
