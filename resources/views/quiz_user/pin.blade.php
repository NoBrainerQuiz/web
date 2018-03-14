@extends('quiz_user.layout.app')

@section('title', 'Enter PIN')

@section('container_content')

     <div class="page-sign h-100 w-100">

      <form action="{{ route('pin-enter') }}" method="post" class="form-signin" style="max-height: 100% !important;">
      {{ csrf_field() }}
      <a href="{{ route('welcome') }}">
        <h1 class="display-4 text-center mb-5">
        <img style="max-width:50%; max-height:50%;" src="{{ asset('img/noBrainerWhite.png') }}" id="noBrainer" alt="logo" />
        </h1>
</a>

@if (session('status'))
<div class="alert alert-success alert-dismissible fade show" role="alert" style="">
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
<strong>{{ session('status') }}</strong>
</div>
@endif

  @if ($errors->all())
<div class="alert alert-danger alert-dismissible fade show" role="alert" style="">
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
  @foreach ($errors->all() as $error)
   <strong>{{ $error }}</strong> <br />
  @endforeach
</div>
@endif

@if (session()->has('pin_error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert" id="pinError">
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
    <strong>{{ session('pin_error') }}</strong>
  </div>
  @endif
  @if (session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
        {{ session('success') }}
      </div>
      @endif
        <div class="form-group">
          <div class="label-floating">
            <input id="pin" type="text" name="pin" value="{{ old('pin') }}" class="form-control" placeholder="Enter PIN" autofocus>
            <label for="pin">Enter PIN</label>
          </div>
        </div>

        <button type="submit" name="submit" class="btn btn-lg btn-primary btn-block btnColour" />Let's go <i class="fas fa-arrow-right"></i></button>
        <!-- <a href="../../index.html" class="btn btn-lg btn-primary btn-block btnColour">
        Sign in <i class="fas fa-arrow-right"></i>
        </a> -->
        <div class="mt-3 mb-3 text-center">
          <p class="mb-4">
            Wanna go back? <a href="{{ route('welcome') }}">to the homepage</a>
          </p>
      </div>
      </form>
    </div>

@endsection
