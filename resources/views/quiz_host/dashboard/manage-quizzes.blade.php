
@extends('quiz_host.dashboard.layout.app')

@section('title', 'Manage Quizzes')

@section('container_content')

@section('breadcrumb', 'Manage Quizzes')


<h2>
    Manage your quizzes
  </h2>
  <p>
   Welcome to your quiz management page! From here you can manage all your
   quizzes and questions, as well as activating quizzes for users to partake in.
  </p>

  <p>
  <a href="javascript:void(null);" class="btn btn-primary" data-toggle="modal" data-target="#createQuizModal">
            Create New Quiz <i class="fas fa-plus"></i>
          </a>
  </p>

  @if (session()->has('quizCreated'))
  <div class="alert alert-success">
      {{ session('quizCreated') }}
  </div>
  @endif

  @if (count($quizzes) != 0)
    
  <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Quiz Name</th>
      <th scope="col">Quiz Description</th>
      <th scope="col">Active</th>
      <th scope="col">Tools</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($quizzes as $quiz) 
    <tr>
      <th scope="row">{{ $quiz->quiz_id }}</th>
      <td>{{ $quiz->quiz_name }}</td>
      <td>{{ $quiz->quiz_description }}</td>
      <td>{{ $quiz->active }}</td>
      <td><a href="" style="color: #34495e; display: inline-block !important;"><i class="fas fa-pen-square" data-toggle="tooltip" title="Edit"></i></a>&nbsp;<a href="" style="color: #34495e; display: inline-block !important;"><i class="fas fa-trash-alt" data-toggle="tooltip" title="Delete"></i></a></td>
    </tr>
    @endforeach
    </tbody>
</table>
  @else
  You do not have any quizzes!
  @endif
  
  <div class="callout callout-info">
    <h5>Need some assistance?</h5>
    <p>You can view our NoBrainer documentation <a href="#">here</a>.</p>
  </div>


  <!-- QUIZ CREATION MODAL -->
  <!-- Modal -->
<div class="modal fade" id="createQuizModal" tabindex="-1" role="dialog" aria-labelledby="createQuizModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createQuizModalLabel">Create Quiz <i class="fas fa-plus"></i></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Want to create a cracking new quiz do we? Well, fill out some basic info below and you're on 
        your way to being a quiz crafting champion...
        <br /><br />
    

        <form method="post" action="{{ route('quiz_host.dashboard.quiz.store') }}">
        {{ csrf_field() }}
        <div class="form-group">
    <label for="exampleInputEmail1">Quiz Name</label>
    <input type="text" maxlength="30" class="form-control" name="quiz_name" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Quiz name...">
    <small id="emailHelp" class="form-text text-muted">Choose a descriptive yet simple name for your quiz (Max 30 chars)</small>
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Quiz Description</label>
    <textarea class="form-control" maxlength="500" name="quiz_description" id="exampleFormControlTextarea1" placeholder="And write a nice description..." rows="3"></textarea>
    <small id="emailHelp" class="form-text text-muted">Enter a description for the quiz so people know what it's about</small>
  </div>



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-success">Create Quiz <i class="fas fa-plus"></i></button>
      </div>
      </form>
    </div>
  </div>
</div>


@endsection