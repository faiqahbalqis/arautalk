@extends('layouts.dashboard')

@section('content')

<section id="main-content">
    <section class="wrapper">

        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"><i class="fa fa-laptop"></i> Dashboard</h3>
                <ol class="breadcrumb">
                    <li><i class="fa fa-home"></i><a href="{{ route('admin.home') }}">Home</a></li>
                    <li><i class="fa fa-comments"></i>Topics</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2><i class="fa fa-comments"></i><strong>Topics List</strong></h2>
                    </div>
                    <div class="panel-body">
                        @if ($topics && $topics->count() > 0)
                            <table class="table bootstrap-datatable countries">
                                <thead>
                                    <tr>
                                        <th>Category Title</th>
                                        <th>Topic</th>
                                        <th>User</th>
                                        <th>Created At</th>
                                        <th>Post Deleted</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($topics as $topic)
                                    <tr>
                                        <td>{{ $topic->category->title }}</td>
                                        <td>{{ $topic->post }}</td>
                                        <td>{{ $topic->user->name }}</td>
                                        <td>{{ $topic->created_at }}</td>
                                        <td style="text-align: center;">
                                            @if ($topic->post_deleted)
                                                <i class="fa fa-check text-success"></i>
                                            @else
                                                <i class="fa fa-times text-danger"></i>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{ $topics->links() }}
                        @else
                            <p>No reports found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </section>
</section>

@endsection
