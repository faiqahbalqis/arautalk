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
                        <th scope="col">Join Forum</th>
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
                        <td>
                            @if (!Auth::guest() && !$category->forums->contains('user_id', Auth::id()))
                                <form action="{{ route('category.join', $category->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary" style="background-color: #D5652E; border-color: #D5652E; width: 100px;">Join</button>
                                </form>
                            @else
                                <a href="{{ route('user.topicoverview', $category) }}" class="btn btn-primary" style="background-color: #3384AA; border-color: #3384AA; width: 100px;">Joined</a>
                            @endif
                        </td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection