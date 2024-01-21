@extends('layouts.dashboard')

@section('content')

<section id="main-content">
    <section class="wrapper">

        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"><i class="fa fa-laptop"></i> Dashboard</h3>
                <ol class="breadcrumb">
                    <li><i class="fa fa-home"></i><a href="{{ route('admin.home') }}">Home</a></li>
                    <li><i class="fa fa-flag"></i>Reports</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2><i class="fa fa-flag"></i><strong>Reports List</strong></h2>
                    </div>
                    <div class="panel-body">
                        @if ($reports && $reports->count() > 0)
                            <table class="table bootstrap-datatable countries">
                                <thead>
                                    <tr>
                                        <th>Category Title</th>
                                        <th>Topic</th>
                                        <th>Reply</th>
                                        <th>Reason</th>
                                        <th>Other Reason</th>
                                        <th>Reporter</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reports as $report)
                                        <tr>
                                            <td>
                                                @php
                                                    $category = \App\Models\Category::find($report->category_id);
                                                    if ($category) {
                                                        echo $category->title;
                                                    } else {
                                                        echo 'N/A';
                                                    }
                                                @endphp
                                            </td>
                                            <td>
                                                @php
                                                    $topic = \App\Models\Topic::find($report->topic_id);
                                                    if ($category) {
                                                        echo $topic->post;
                                                    } else {
                                                        echo 'N/A';
                                                    }
                                                @endphp
                                            </td>
                                            <td>
                                                @php
                                                    $reply = \App\Models\PostReply::find($report->reply_id);
                                                    if ($category) {
                                                        echo $reply->reply;
                                                    } else {
                                                        echo 'N/A';
                                                    }
                                                @endphp
                                            </td>
                                            <td>{{ $report->reason }}</td>
                                            <td>{{ $report->other_reason }}</td>
                                            <td>
                                                @php
                                                    $user = \App\Models\User::find($report->user_id);
                                                    if ($category) {
                                                        echo $user->name;
                                                    } else {
                                                        echo 'N/A';
                                                    }
                                                @endphp
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{ $reports->links() }}
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
