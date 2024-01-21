@extends('layouts.app')

@section('content')

    <div class="container">
        <nav class="breadcrumb">
            <a href="{{ route('user.home') }}" class="breadcrumb-item">Home</a>
            <span class="breadcrumb-item active">{{ $category->title }}</span>
        </nav>

        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        @if ($topics->isEmpty())
                            <div class="alert alert-info mt-4">
                                No topics found.
                            </div>
                        @else
                            <table class="table table-striped table-responsivelg table-bordered">
                                <thead style="background-color: #8D62A7; color: white;">
                                    <tr>
                                        <th scope="col">Topic</th>
                                        <th scope="col">Created</th>
                                        <th scope="col">Statistics</th>
                                        <th scope="col">Latest Reply</th>
                                        <th scope="col">View Reply</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($topics as $topic)
                                        @php
                                            $repliesCount = $topic->replies->count();
                                            $deletedRepliesCount = $topic->replies->where('post_deleted', 1)->count();
                                        @endphp

                                        @if ($topic->post_deleted)
                                            @if ($repliesCount > 0 && $repliesCount != $deletedRepliesCount)
                                                <tr>
                                                    <td>
                                                        <h3 class="h6">
                                                            <div style="color: red;">Topic has been deleted</div>
                                                        </h3>
                                                    </td>
                                                    <td>
                                                        <div>by <div>{{ optional($topic->user)->name }}</div></div>
                                                        <div>{{ $topic->created_at }}</div>
                                                    </td>
                                                    <td>
                                                        <div>{{ $repliesCount - $deletedRepliesCount }} {{ Str::plural('reply', $repliesCount - $deletedRepliesCount) }}</div>
                                                    </td>
                                                    <td>
                                                        @if ($repliesCount > 0)
                                                            <div>{{ $topic->replies->last()->user->name }}</div>
                                                            <div>{{ $topic->replies->last()->created_at->format('d/m/Y H:i') }}</div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-primary" onclick="window.location.href='{{ route('user.topic', ['category' => $category->id, 'topic' => $topic->id]) }}'" style="background-color: #D5652E; border-color: #D5652E; width: 100px;">
                                                            View
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endif
                                        @else
                                            <tr>
                                                <td>
                                                    <h3 class="h6">
                                                        <div>{{ $topic->post }}</div>
                                                    </h3>
                                                </td>
                                                <td>
                                                    <div>by <div>{{ optional($topic->user)->name }}</div></div>
                                                    <div>{{ $topic->created_at }}</div>
                                                </td>
                                                <td>
                                                    <div>{{ $repliesCount }} {{ Str::plural('reply', $repliesCount) }}</div>
                                                </td>
                                                <td>
                                                    @if ($repliesCount > 0)
                                                        <div>{{ $topic->replies->last()->user->name }}</div>
                                                        <div>{{ $topic->replies->last()->created_at->format('d/m/Y H:i') }}</div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button class="btn btn-primary" onclick="window.location.href='{{ route('user.topic', ['category' => $category->id, 'topic' => $topic->id]) }}'" style="background-color: #3384AA; border-color: #3384AA; width:100px;">
                                                        View
                                                    </button>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-3 clearfix">
            <form action="" class="form-inline float-lg-left d-block d-sm-flex">
                <!-- Remaining form code -->
            </form>
        </div>
        <a href="{{ route('user.newtopic', ['category' => $category]) }}" class="btn btn-lg btn-primary mb-2">New Topic</a>
    </div>

@endsection
