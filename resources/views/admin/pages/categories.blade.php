@extends('layouts.dashboard')
@section('content')

    <section id="main-content">
        <section class="wrapper">

            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><i class="fa fa-laptop"></i> Dashboard</h3>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="{{ route('admin.home') }}">Home</a></li>
                        <li><i class="fa fa-list"></i>Categories</li>
                    </ol>
                </div>
            </div>

            <div class="row">

                <div class="col-lg-12 col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2><i class="fa fa-list"></i><strong>Categories List</strong></h2>
                        </div>
                        <div class="panel-body">
                            <table class="table bootstrap-datatable countries">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>View</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($categories)> 0)
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td>{{$category->title}}</td>
                                                <td>{!!$category->desc!!}</td>
                                                <td><a href="{{route('category', $category->id)}}"><i class="fa fa-eye text-success"></i></a></td>
                                                <td><a href="{{route('category.update', $category->id)}}"><i class="fa fa-edit text-info"></i></a></td>
                                                <td><a href="{{route('category.destroy', $category->id)}}" class="text-danger"><i class="fa fa-trash"></i>Delete</a></td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>

                            {{ $categories->links() }}
                        </div>
                    </div>
                </div>

                </div>
  
            </div>
  
        </section>
    </section>

@endsection