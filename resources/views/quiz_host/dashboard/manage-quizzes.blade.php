
@extends('quiz_host.dashboard.layout.app')

@section('title', 'Manage Quizzes')

@section('container_content')

@section('breadcrumb', 'Manage Quizzes')

<style>

  in-display {
    display: inline-block !important;
  }

</style>
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

  @if (session()->has('quizDeleted'))
  <div class="alert alert-success">
      {{ session('quizDeleted') }}
  </div>
  @endif

  @if (count($quizzes) != 0)
    
  <table class="table table-striped" data-toggle="dataTable" data-form="deleteForm">
  <thead>
    <tr>
      <th scope="col">PIN</th>
      <th scope="col">Quiz Name</th>
      <th scope="col">Active</th>
      <th scope="col">Questions</th>
      <th scope="col">Quiz Tools</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($quizzes as $quiz) 
    <tr>
      <th scope="row">{{ $quiz->quiz_pin }}</th>
      <td data-toggle="tooltip" data-placement="top" title="{{ $quiz->quiz_description }}">{{ $quiz->quiz_name }}</td>
      <td>@if ($quiz->active == '0') <a href="" style="color: red;" data-toggle="tooltip" data-placement="top" title="Click to activate">Not active</a> @else <a href="" data-toggle="tooltip" data-placement="top" title="Click to deactivate" style="color: green;">Active</a> @endif</td>
      <td>
        <button type="submit" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="Add questions to this quiz">
        Add <span class="fas fa-plus-circle" aria-hidden="true"></span>
      </button>
      <button type="submit" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="View questions for this quiz">
        View All <span class="fas fa-eye" aria-hidden="true"></span>
      </button>
</td>
      <td>
        <div class="btn-toolbar">
      <button type="button" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="Edit this quiz">
      Edit <span class="fas fa-pen-square" aria-hidden="true"></span>
      </button>
      &nbsp;
      {!! Form::model($quiz, ['method' => 'delete', 'route' => ['quiz_host.dashboard.quiz.delete', $quiz->quiz_id], 'class' => 'form-inline form-delete']) !!}
      {!! Form::hidden('id', $quiz->quiz_id) !!}
      {!! Form::button('Delete <i class="fas fa-trash-alt"></i>', ['data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => 'Delete this quiz', 'type' => 'submit', 'class' => 'btn btn-sm btn-info', 'name' => 'delete_modal']) !!}
      {!! Form::close() !!}
</div>
    </td>
    </tr>
    @endforeach
    </tbody>
</table>
  @else
  <div class="alert alert-info">
      You don't seem to have any quizzes, why not <a href="{{ route('quiz_host.dashboard.quiz.create') }}">create one</a>?
  </div>
  @endif
  
  <div class="callout callout-info">
    <h5>Quick tips:</h5>
    <p>
      <li>Hover your cursor over the quiz name to view the description.</li>
      <li>Click the <span style="color: green" >active</span> and <span style="color: red">not active</span>
    links respectively to toggle between activating and deactivating your quizzes!
    </li>
  </p>
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





  <!-- QUIZ CREATION MODAL -->
  <!-- Modal -->
  <div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="deleteQuizConfirmLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteQuizConfirmLabel">Delete Quiz <i class="fas fa-trash-alt"></i></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        Are you sure you want to delete this quiz?

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-danger" id="delete-btn">Delete Quiz <i class="fas fa-trash-alt"></i></button>
      </div>
    </div>
  </div>
</div>


<script>

  $('table[data-form="deleteForm"]').on('click', '.form-delete', function(e){
    e.preventDefault();
    var $form=$(this);
    $('#confirm').modal({ backdrop: 'static', keyboard: false })
        .on('click', '#delete-btn', function(){
            $form.submit();
        });
});
</script>



@endsection