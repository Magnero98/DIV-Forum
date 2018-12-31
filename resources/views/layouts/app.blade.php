<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>dIV Forum</title>

    <!-- Styles -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css" >

</head>
<body>
<div id="app">
    <nav class="navbar navbar-inverse ">
        <div class="container">
            <div class="navbar-header">

              <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    dIV-Forum
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">

                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">

                    @roles('Admin')
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                            Master <span class="fa fa-caret-down"></span>
                        </a>

                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{ route('users.index') }}">User Page</a>
                            </li>
                            <li>
                                <a href="{{ route('masterForum')}}">Master Forum</a>
                            </li>
                            <li>
                                <a href="{{ route('categories.index')}}">Master Category</a>
                            </li>
                        </ul>
                    </li>
                    @endroles

                    @roles(['Member', 'Admin'])
                    <li><a href="{{ route('myForum') }}">My Forum</a></li>
                    @endroles
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @guest
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @else
                        <li class="nav">
                            <a href="{{route('users.show', ['id' => authUserDomain()->getId()])}}">
                                <img width="25px" height="25px" src="{{ asset('uploads\\profile_pictures\\' . authUserDomain()->getProfilePicture()->getFileName()) }}"> {{ authUserDomain()->getName() }}
                            </a>
                        </li>
                        <li class="nav">
                            <a href="{{route('messages.index')}}">Inbox</a>
                        </li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                <span class="fa fa-caret-square-o-down"></span>
                            </a>

                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    @yield('content')
</div>

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
