<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="oRlwQCWDSEBrMAdKd3t3_3pCA9sFayLgZdgLer2TKfM" />
    <link rel="canonical" href="https://www.booknshelf.com/" />
    <meta name="description" content="Booknshelf is a place to discover great books, bookshelves and share them with your friends."/>
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="Booknshelf" />
    <meta property="og:description"   content="Discover great books on specific topics" />
    <meta property="og:image"         content="https://booknshelf.com/img/logo.png" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Booknshelf') }}</title>
    <link rel="icon" href="/img/favicon.ico" />

    <!--     Fonts and icons     -->
   	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ elixir('css/booknshelf.css') }}">

    <!-- Scripts -->
    <script>
        window.App = <?php echo json_encode([
            'csrfToken' => csrf_token(),
            'userId' => Auth::id(),
            'state' => [
                'user' => Auth::user()
            ]
        ]); ?>
    </script>
</head>
<body class="landing-page">
    <div id="app">
        <nav class="navbar navbar-primary navbar-transparent navbar-absolute">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-main">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="/img/small-logo-white.png" height="35" width="35" alt="brand">
                    </a>
                </div>
                <div class="navbar-collapse collapse" id="navbar-collapse-main">

                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        @if (Auth::check())
                            <li><a href="profile/index.html">About</a></li>
                            <li><a href="notifications/index.html">Blog</a></li>
                            <form class="navbar-form navbar-right app-search" method="GET"
                                  action="{{ url('/books/search') }}" role="search">
                                <div class="form-group">
                                    <input id="book-search" type="text" value="{{ $q or '' }}" class="form-control"
                                           data-action="grow" placeholder="Search for great books ...">
                                </div>
                            </form>
                        @else
                            <li><a href="https://www.indiehackers.com/about">About</a></li>
                            <li><a href="https://www.indiehackers.com/blog">Blog</a></li>
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right m-r-0 hidden-xs">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Sign In</a></li>
                            <li><a href="{{ url('/register') }}" type="button" class="btn btn-info btn-round navbar-btn">Sign Up</a></li>
                        @else
                            <li>
                              <button class="btn btn-default navbar-btn navbar-btn-avitar" data-toggle="popover">
                                <img class="img-circle" src="{{ Auth::user()->avatar }}">
                              </button>
                            </li>
                        @endif
                    </ul>

                    @if(Auth::user())
                        @includeIf('nav.user-right')
                    @endif
                </div>
            </div>
        </nav>

        @yield('content')

        <footer class="footer">
       		<div class="container">
       			<a class="footer-brand" href="#pablo">Material Kit PRO</a>


       			<ul class="pull-center">
       				<li>
       					<a href="#pablo">
       					   Blog
       					</a>
       				</li>
       				<li>
       					<a href="#pablo">
       						Presentation
       					</a>
       				</li>
       				<li>
       					<a href="#pablo">
       					   Discover
       					</a>
       				</li>
       				<li>
       					<a href="#pablo">
       						Payment
       					</a>
       				</li>
       				<li>
       					<a href="#pablo">
       						Contact Us
       					</a>
       				</li>
       			</ul>

       			<ul class="social-buttons pull-right">
       				<li>
       					<a href="https://twitter.com/CreativeTim" target="_blank" class="btn btn-just-icon btn-twitter btn-simple">
       						<i class="fa fa-twitter"></i>
       					</a>
       				</li>
       				<li>
       					<a href="https://www.facebook.com/CreativeTim" target="_blank" class="btn btn-just-icon btn-facebook btn-simple">
       						<i class="fa fa-facebook-square"></i>
       					</a>
       				</li>
       				<li>
       					<a href="https://www.instagram.com/CreativeTimOfficial" target="_blank" class="btn btn-just-icon btn-google btn-simple">
       						<i class="fa fa-google"></i>
       					</a>
       				</li>
       			</ul>

       		</div>
       	</footer>

    </div>

    <!-- Scripts -->
    <script src="{{ elixir('js/app.js') }}"></script>
    <script src="https://use.fontawesome.com/d28dd28e24.js"></script>
</body>
</html>
