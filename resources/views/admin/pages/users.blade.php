@extends('layouts.dashboard')

@section('content')
      <!--main content start-->
      <section id="main-content">
        <section class="wrapper">

              <!--overview start-->
          <div class="row">
            <div class="col-lg-12">
              <h3 class="page-header"><i class="fa fa-laptop"></i> Dashboard</h3>
              <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="{{ route('admin.home') }}">Home</a></li>
                <li><i class="fa fa-users"></i>Users</li>
              </ol>
            </div>
          </div>

          <div class="row">

            <div class="col-lg-12 col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h2><i class="fa fa-users"></i><strong>Registered Users</strong></h2>
                </div>
                <div class="panel-body">
                  <table class="table bootstrap-datatable countries">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Student No</th>
                        <th>View</th>
                        <th>Edit</th>
                        <th>Delete</th>
                        <th>Block</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                        @if (count($users)> 0)
                            @foreach ($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->student_no}}</td>
                                <td><a href="{{route('dashboard.user', $user->id)}}"><i class="fa fa-eye text-success"></i></a></td>
                                <td><a href="{{route('dashboard.user.edit', $user->id)}}"><i class="fa fa-edit text-info"></i></a></td>
                                <td><a href="{{route('dashboard.user.destroy', $user->id)}}" class="text-danger"><i class="fa fa-trash"></i>Delete</a></td>
                                <td>
                                  @if ($user->is_blocked)
                                    <a href="{{ route('dashboard.user.unblock', $user->id) }}" class="text-warning" title="Unblock">
                                      <i class="fa fa-unlock"></i>
                                    </a>
                                  @else
                                    <a href="{{ route('dashboard.user.block', $user->id) }}" class="text-danger" title="Block">
                                      <i class="fa fa-ban"></i>
                                    </a>
                                  @endif
                                </td>
                              </tr>
                            @endforeach
                        @endif
                    </tbody>
                  </table>

                  {{ $users->links() }}
                </div>
  
              </div>
  
            </div>
            
            </div>
  
          </div>
  


        </section>


      </section>
@endsection