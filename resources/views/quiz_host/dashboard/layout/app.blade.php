<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <!-- <link rel="stylesheet" type="text/css" href="{{ asset('css/theme.css') }}"> -->
  <link rel="stylesheet" href="{{ asset('css/admin4bpanel.css') }}">
  <!-- <link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}"> -->
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="icon"
  type="image/png"
  href="{{ asset('img/favicon.png') }}">
  <title>NoBrainer - @yield('title')</title>
</head>

<body>
<div class="app">
  <div class="app-body">
    <div class="app-sidebar sidebar-dark sidebar-slide-left">
  <div class="text-right">
    <button type="button" class="btn btn-sidebar" data-dismiss="sidebar">
      <span class="x"></span>
    </button>
  </div>
  <div class="sidebar-header">
    <img src="{{ Avatar::create(Auth::user()->username) }}" class="user-photo">
    <p class="username">{{ Auth::user()->username }}</p>
  </div>
  <div id="sidebar-nav" class="sidebar-nav" data-children=".sidebar-nav-group">
    <a href="{{ route('quiz_host.dashboard') }}" class="sidebar-nav-link">
    <i class="fas fa-home"></i> Dashboard
    </a>
    <a href="{{ route('quiz_host.dashboard.manage-quizzes') }}" class="sidebar-nav-link">
    <i class="fas fa-comments"></i> My Quizzes
    </a>
    <!-- <div class="sidebar-nav-group">
      <a href="#components" class="sidebar-nav-link collapsed" data-toggle="collapse" data-parent="#sidebar-nav">
      <i class="fas fa-comments"></i> My Quizzes
      </a>
      <div id="components" class="sidebar-nav-group collapse">
      <a href="./pages/components/input-suggestion.html" class="sidebar-nav-link"><i class="fas fa-plus"></i> Create new quiz</a>
        <a href="{{ route('quiz_host.dashboard.manage-quizzes') }}" class="sidebar-nav-link"><i class="fas fa-eye"></i> Manage quizzes</a>
      </div>
    </div> -->
    <div class="sidebar-nav-group">
      <a href="#content" class="sidebar-nav-link collapsed" data-toggle="collapse" data-parent="#sidebar-nav">
        <i class="fas fa-list-ul"></i> My Subjects
      </a>
      <div id="content" class="sidebar-nav-group collapse">
        <a href="./pages/content/dashboard.html" class="sidebar-nav-link"><i class="fas fa-plus"></i> Add new subject</a>
        <a href="./pages/content/timeline.html" class="sidebar-nav-link"><i class="fas fa-eye"></i> Manage Subjects</a>
      </div>
    </div>
    
  </div>
  <div class="sidebar-footer">
  <span data-toggle="modal" data-target="#aboutModal">
  <a href="javascript:void(null);" data-toggle="tooltip" title="About">
      <i class="fas fa-info-circle"></i>
    </a>
    </span>
    <a href="./pages/sample-pages/settings.html" data-toggle="tooltip" title="Settings">
      <i class="fa fa-cog"></i>
    </a>
    <a href="{{ route('logout') }}?_token={{ csrf_token() }}" data-toggle="tooltip" title="Logout">
      <i class="fa fa-power-off"></i>
    </a>
    <br /><br />
    <small style="color: #fff">Version 0.1.0-Alpha-1</small>
  </div>
</div>

    <div class="app-content">
      <nav class="navbar navbar-expand navbar-light bg-white">
  <button type="button" class="btn btn-sidebar" data-toggle="sidebar">
    <i class="fa fa-bars"></i>
  </button>
  <div class="navbar-brand">
    NoBrainer
  </div>
  <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown">
      <a href="#" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Welcome, <strong>{{ Auth::user()->username }}</strong>
      </a>
      <div class="dropdown-menu dropdown-menu-right">
        <a href="#" class="dropdown-item">
          My Profile
        </a>
        <a href="#" class="dropdown-item">
          My Settings
        </a>
        <div class="dropdown-divider"></div>
        <a href="{{ route('logout') }}?_token={{ csrf_token() }}" class="dropdown-item">
          Logout
        </a>
      </div>
    </li>
  </ul>
</nav>


<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">@yield('breadcrumb')</li>
  </ol>
</nav>

<div class="container-fluid">

@yield('container_content')

</div>


<!-- Modal -->
<div class="modal fade" id="aboutModal" tabindex="-1" role="dialog" aria-labelledby="aboutModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="aboutModalLabel">About NoBrainer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        NoBrainer is the brainchild of 4 Computer Science students from the University of Portsmouth, UK.
        It's goal is to be easy to use but also offer a realtime quiz experience. If you have any feedback or feature
        suggestions we'd absolutely love to hear them! Visit our <a href="https://github.com/NoBrainerQuiz" target="_blank">GitHub</a> to take a look at the project and its progress or see
        the table below for a bit about us.
        <br /><br/>
        
        <table class="table table-striped">
  <tbody>
    <tr>
      <td><strong>Matt Kent</strong></td>
      <td>Core Developer</td>
    </tr>
    <tr>
      <td><strong>Ben Spring</strong></td>
      <td>Core Developer</td>
    </tr>
    <tr>
      <td><strong>Glenn Hamilton-Smith</strong></td>
      <td>UI Designer</td>
    </tr>
  </tbody>
</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="{{ asset('js/admin4b.js') }}"></script>
    <script src="{{ asset('js/admin4b.docs.js') }}"></script>
    <!--End External Scripts-->
    <script>
       $(function () {
          $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
</body>

</html>
