@extends('layouts.admin')

<!-- @section('user')
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
@endsection -->


@section('content')
    <div class="container" style="user-select: none;margin-left:95px;">
        <div class="row justify-content-center">
            <div class="col-md-12">
               
               <div>
                <h3 style="font-family: 'Francois One', sans-serif;text-align: center;">Project/Thesis List</h3>
                
                
                <table class="table" style="margin-top:40px">
                  <thead class="thead-dark">
                    <tr>
                      <th scope="col">Type</th>
                      <th scope="col">Namey</th>
                      <th scope="col">Team Member</th>
                      <th scope="col">Thesis supervisor</th>
                      <th scope="col">Doc</th>
                      <th scope="col">Source File</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($files as $file)

                    <tr>
                      <th scope="row">
                        @if($file->type=="project")
                    <h5>
                      Project
                    </h5>
                    @endif

                 @if($file->type=="thesis")
                     <h5>
                       Thesis
                     </h5>         
                  @endif
                      </th>
                      <td>
                          @php
                                    $req_tech = $file->required_technology;
                                    $names = explode(",", $req_tech);
                                @endphp
                                @foreach($names as $name)
                                 <dd style="color: black;padding-left: 15px"><i class="fas fa-angle-double-right"> {{$name}}</i></dd>
                                 @endforeach
                      </td>
                      <td>
                          {{$file->contributor_name1}} <i class="fas fa-angle-right"></i>
                          {{$file->contributor_id1}} <br> 
                          {{$file->contributor_name2}} <i class="fas fa-angle-right"></i>
                          {{$file->contributor_id2}}
                      </td>
                      <td>{{$file->supervisor_name}}</td>
                      <td>
                        <form action="{{route('downloadDocFile')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="fileId" value="{{$file->id}}">
                                    <button  class="btn btn-primary">
                                    <i class="glyphicon glyphicon-download">
                                        Download Doc
                                    </i>
                                    </button>
                                </form>
                      </td>
                      <td>
                        

                                <form action="{{route('downloadZipFile')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="fileId" value="{{$file->id}}">
                                    <button  class="btn btn-primary">
                                    <i class="glyphicon glyphicon-download">
                                        Download Zip
                                    </i>
                                    </button>
                                </form>
                            
                      </td>

                    </tr>
                @endforeach
                    
                  </tbody>
                </table>
                   
                
               </div>

               <div class="row">
                   <div class="col-lg-5 col-md-5"></div>
                   <div class="col-lg-3 col-md-3">
                       {{$files->links()}}
                   </div>
                   <div class="col-lg-4 col-md-4"></div>
               </div>
                        
               </div>
        </div>
    </div>
@endsection