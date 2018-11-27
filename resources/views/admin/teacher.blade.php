@extends('layouts.admin')

@section('user')
   @foreach($users as $user)
       @if($user->role==3)
           <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="users icon"></i>
                <span>Users</span>
              </a>
              <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                <h6 class="dropdown-header">Users:</h6>
                <a class="dropdown-item" href="{{route('admin.student')}}">Students</a>
                <a class="dropdown-item" href="{{route('admin.teacher')}}">Teachers</a>
              </div>
         </li>
       @endif
    @endforeach    
@endsection

@section('content')
    <div class="container" style="user-select: none;margin-left:95px;">
        <div class="row justify-content-center">
        	@if (\Session::has('success'))
			    <div class="alert alert-success">
			        <ul>
			            <li>{!! \Session::get('success') !!}</li>
			        </ul>
			    </div>
			@endif
            <table class="ui celled structured table">

  <thead>
    <tr>
      <th rowspan="2">Name</th>
      <th rowspan="2">Email</th>
      <th colspan="3">Action</th>
    </tr>
  </thead>
  <tbody>
  	@foreach($users as $user)
      @if($user->role==2)
      @if($user->verified==1)
    <tr>
      <td>{{$user->name}}</td>
      <td>{{$user->email}}</td>
      <td>
	        
	      <a href="{{route('admin.delete',$user->id)}}">Delete</a>
	    </td>

    </tr> 
     @endif
     @endif
    @endforeach 
  </tbody>
</table>
        </div>
    </div>
@endsection
