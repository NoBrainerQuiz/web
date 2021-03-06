@extends('quiz_host.auth.layout.auth')
@section('title', 'Ey-oh!')

@section('container_content')
<!--
  If no quiz data, then redirect the user elsewhere.. Worry about authentication later.
-->
@if (session()->has('quizData'))
  <h2 style="margin: 0 auto;">{{ session('quizData')->quiz_name }}</h4>
  <small>{{ session('quizData')->quiz_description }}</small><br /><br />
@endif
<h5 style="margin: 0 auto;" id="waitMessage">Please wait for the host to start the quiz..</h5></br></br>

@if ($errors->all())
<div class="alert alert-danger alert-dismissible fade show" role="alert" style="width: 50%; margin: 0 auto; text-align: left;">
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <strong>Ooops, please correct the below errors before continuing:</strong><br />
    @foreach ($errors->all() as $error)
      {{ $error }} <br />
    @endforeach
  </div>
  @endif

@if (session()->has('pin_error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert" style="width: 50%; margin: 0 auto; text-align: left;">
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <strong>Ooops, please correct the below errors before continuing:</strong><br />
    {{ session('pin_error') }}
  </div>
  @endif

  <!-- Model for username -->
  <div class="modal fade" id="assignName">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Please enter a username to enter the quiz..</h5>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label style="float: left;">Username:&nbsp;&nbsp;<a href="#" class="badge badge-danger" data-toggle="tooltip" data-placement="right" title="This will appear as your name in the game.">?</a></label><br />
            <input id="username" class="form-control" type="text" name="username" placeholder="Enter username..." autofocus>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="submit-username">Submit Username</button>
        </div>
      </div>
    </div>
  </div>

  <script src="//{{ Request::getHost() }}:3000/socket.io/socket.io.js"></script>
  <script>var socket = io('//{{ Request::getHost() }}:3000');</script>
  <script src="js/sockets.js"></script>

  <script src="js/functions.js"></script>
  <script>
    let valid = false; //Variable to determine a users authentication
    let username; //stores their username
    let allUserInfo; //stores all other users currently playing
    let id = getCookie("randomVal"); //This calls a function to get their cookie ID. This validates the user.

    //Upon loading the page, it communicates with the server to determine if the user is valid and exists on the server too.
    socket.on('connect', function(data) {
      socket.emit('validateUser', {id: id})
    })

    //When the server passes the users information, it updates the javascript variables for my other functions to use.
    socket.on('userInfo', function(data) {
      username = data.username
      allUserInfo = data.allUsers
    })
  </script>

@endsection
