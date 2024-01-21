@extends('layouts.dashboard')

@section('content')
<section id="main-content">
  <section class="wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-laptop"></i> Dashboard</h3>
        <ol class="breadcrumb">
          <li><i class="fa fa-home"></i><a href="{{ url('/') }}">Home</a></li>
          <li><i class="fa fa-laptop"></i>Admin Dashboard</li>
        </ol>
      </div>
    </div>

    <div class="flash-message">
      @if(\Session::has('message'))
      <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message') }}</p>
      @endif
    </div> <!-- end .flash-message -->

    <div class="row">

      <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <div class="info-box brown-bg">
          <i class="fa fa-users"></i>
          <div class="count">{{ App\Models\User::count() }}</div>
          <div class="title">Users</div>
        </div>
      </div>

      <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <div class="info-box purple-bg">
          <i class="fa fa-list"></i>
          <div class="count">{{ App\Models\Category::count() }}</div>
          <div class="title">Categories</div>
        </div>
      </div>

      <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <div class="info-box green-bg">
          <i class="fa fa-flag"></i>
          <div class="count">{{ App\Models\Report::count() }}</div>
          <div class="title">Reports</div>
        </div>
      </div>

    </div>
  </section>
</section>
@endsection