@extends('layouts.app')

@section('content')
    <div class="container">
    <nav class="breadcrumb">
        <a href="{{ route('user.home') }}" class="breadcrumb-item">Home</a>
        <a href="{{ route('user.topicoverview', ['category' => $category]) }}" class="breadcrumb-item">{{ $category->title }}</a>
        <span class="breadcrumb-item active">New Topic</span>
    </nav>

        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <!-- Category one -->
                    <div class="col-lg-12">
                        <!-- second section  -->
                        <!-- Display the topics for the specified category -->
                        <h4 class="text-white bg-black mb-0 p-4 rounded-top">{{ $category->title }}</h4>

                        <form action="{{ route('topic.store', $category) }}" method="POST" class="mb-3">
                            @csrf
                            <div class="form-group">
                                <label for="post">Write your post</label>
                                <textarea class="form-control" name="post" rows="3" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary mt-2 mb-lg-5">
                                Submit post
                            </button>
                            <button type="reset" class="btn btn-danger mt-2 mb-lg-5">
                                Reset
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
