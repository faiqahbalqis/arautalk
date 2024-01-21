@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            
            <table class="table table-striped table-responsive table-bordered">
                <thead style="background-color: #8D62A7; color: white;">
                    <tr>
                        <th scope="col">Forum</th>
                        <th scope="col">Description</th>
                        <th scope="col">Posts</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr>
                        <td>
                            <p class="mb-0">
                                {!! $category->title !!}
                            </p>
                        </td>
                        <td>
                            <p class="mb-0">
                                {!! $category->desc !!}
                            </p>
                        </td>
                        <td>
                            <div>{{ $category->topics->where('post_deleted', 0)->count() }}</div>
                        </td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection