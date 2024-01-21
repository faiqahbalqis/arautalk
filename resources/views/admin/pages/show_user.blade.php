@extends('layouts.dashboard')
@section('content')

<section id="main-content">
    <section class="wrapper">

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
                        <h2><i class="fa fa-flag-o red"></i><strong>View User</strong></h2>
                        <div class="panel-actions">
                            <a href="/dashboard/home" class="btn-setting"><i class="fa fa-rotate-right"></i></a>
                            <a href="/dashboard/home" class="btn-minimize"><i class="fa fa-chevron-up"></i></a>
                            <a href="/dashboard/home" class="btn-close"><i class="fa fa-times"></i></a>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-2">
                                    <h4>{{$user->name}}</h4>
                                    <p>{!!$user->email!!}</p>
                                    <p>{!!$user->student_no!!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>
</section>

@endsection
