<?php
use Illuminate\Support\Facades\Session;
?>
@extends('layouts.dashboard')

@section('content')       
          
    <section id="main-content">
        <section class="wrapper">
          <div class="row">
            <div class="col-lg-12">
              <h3 class="page-header"><i class="fa fa-edit"></i>Edit User</h3>
              <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="{{ route('admin.home') }}">Home</a></li>
                <li><i class="fa fa-question"></i>User</li>
              <li><i class="fa fa-plus"></i>Edit</li>
              </ol>
            </div>
          </div>

<div id="edit-profile" class="tab-pane">
  <section class="panel">
    <div class="panel-body bio-graph-info">
        @if (session()->has('errors'))
            @foreach ($errors as $error)
                {{$error}}
            @endforeach
        @endif
      @if(\Session::has('message'))

      <p class="alert
      {{ Session::get('alert-class', 'alert-success') }}">{{Session::get('message') }}
      </p>
      
      @endif
      @if ($user)


      <form class="form-horizontal" method="POST" action="{{ route('dashboard.user.update', $user->id)}}" enctype="multipart/form-data">
          @csrf
      
        <div class="form-group">
          <label class="col-lg-2 control-label">Name</label>
          <div class="col-lg-10">
          <input name="name" class="form-control" value="{{$user->name}}"/>
          </div>
        </div>

        <div class="form-group">
          <label class="col-lg-2 control-label">Email</label>
          <div class="col-lg-10">
          <input name="email" class="form-control" value="{{$user->email}}"/>
          </div>
        </div> 
        
        <div class="form-group">
          <label class="col-lg-2 control-label">Student No</label>
          <div class="col-lg-10">
          <input name="student_no" class="form-control" value="{{$user->student_no}}"/>
          </div>
        </div>

        <div class="form-group">
          <div class="col-lg-offset-2 col-lg-10">
            <button type="submit" class="btn btn-success">Update</button>
            <a href="/dashboard/home" class="btn btn-danger">Cancel</a>
          </div>
        </div>
      </form>
      @endif
    </div>
  </section>
</div>


        </section>
      </section>
      
@endsection
