@extends('layouts.studentDashboard')

@section('dashboard')
        @auth
            @if($user->role==1)
               <a class="nav-link item" href="{{route('student.dashboard')}}">{{ __('Student Dashboard') }}</a>
            @endif
        @endauth
@endsection

@section('content')
<div class="container" style="user-select: none;">
        <div class="row justify-content-center">
           <h2 style="font-family: 'Francois One', sans-serif; margin-bottom: 20px">Project Idea List</h2>
            <table class="ui celled padded table">
  <thead>
    <tr><th scope="col" style="text-align: center;" class="single line">Idea Type</th>
    <th scope="col" style="text-align: center;">Name</th>
    <th scope="col" style="text-align: center;">Idea Detail</th>
    
  </tr></thead>
  <tbody>
    @foreach($ideas as $idea)
    <tr>
      <td class="text-center">
        @if($idea->type=="project")
            <h5>
              Project
            </h5>
         @endif

         @if($idea->type=="thesis")
             <h5>
               Thesis
             </h5>         
          @endif
      </td>
      <td>
        <div> {{$idea->name}}</div>
      </td>
      <td class="right aligned text-center ">

         @if($idea->type=="project")
            <a class="ui button" href="{{url('project_idea/details/' . $idea->id)}}">View Idea Detail</a>
         @endif

         @if($idea->type=="thesis")
             <a class="ui button" href="{{url('thesis_idea/details/' . $idea->id)}}">View Idea Detail</a>
         @endif
      </td>
      
    </tr>
    @endforeach 
  </tbody>

</table>
        </div>
    </div>
@endsection