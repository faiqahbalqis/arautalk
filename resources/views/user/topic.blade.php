@extends('layouts.app')

@section('content')

    @php
        use App\Notifications\TelegramNotification;
        use Illuminate\Support\Facades\Notification;
    @endphp

    <div class="container">
        @if(Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
        <nav class="breadcrumb">
            <a href="{{ route('user.home') }}" class="breadcrumb-item">Home</a>
            <a href="{{ route('user.topicoverview', ['category' => $category]) }}" class="breadcrumb-item">{{ $category->title }}</a>
            <span class="breadcrumb-item active">View Post</span>
        </nav>

        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- display topic for the specified category -->
                        @if ($topic->post_deleted)
                            <div class="alert alert-danger mt-4">This post has been deleted.</div>
                        @else
                            <!-- display main post -->
                            <table class="table table-bordered mt-4 style=table-layout: fixed;">
                                <thead style="background-color: #8D62A7; color: white;">
                                    <tr>
                                        <th class="author-col" style="width: 200px">Author</th>
                                        <th class="post-col" style="width: 600px">Post</th>
                                        <th class="date-col" style="width: 150px">Date</th>
                                        <th class="action-col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="author-col">by {{ optional($topic->user)->name }}</td>
                                        <td class="post-col">{{ $topic->post }}</td>
                                        <td class="date-col">{{ $topic->created_at->format('d-m-Y H:i:s') }}</td>
                                        <td class="action-col">
                                            @if (auth()->check() && auth()->user()->id === $topic->user_id)
                                                <!-- Add delete button for the author of the post -->
                                                <form action="{{ route('topic.delete', ['category' => $category, 'topic' => $topic]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            @else
                                                <!-- report button for main post -->
                                                <button type="button" class="btn btn-warning report-btn" data-toggle="modal" data-target="#reportModal{{ $topic->id }}" data-reply-id="{{ $topic->id }}" style="width: 100px">Report</button>
                                                <!-- Report Modal -->
                                                <div class="modal fade" id="reportModal{{ $topic->id }}" tabindex="-1" role="dialog" aria-labelledby="reportModalLabel{{ $topic->id }}" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="reportModalLabel{{ $topic->id }}">Report Post</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="reason{{ $topic->id }}">Reason:</label>
                                                                    <select name="reason" id="reason{{ $topic->id }}" class="form-control">
                                                                        <option value="spam">Spam</option>
                                                                        <option value="offensive">Offensive language</option>
                                                                        <option value="inappropriate">Inappropriate content</option>
                                                                        <option value="other">Other</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="otherReason{{ $topic->id }}">Other Reason:</label>
                                                                    <input type="text" name="otherReason" id="otherReason{{ $topic->id }}" class="form-control" placeholder="Please specify the reason">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="button" class="btn btn-primary" data-reply-id="{{ $topic->id }}">Submit</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        @endif

                        <!-- display replies -->
                        <div class="mt-4">
                            <table class="table table-bordered mt-4 style=table-layout: fixed;">
                                <thead style="background-color: #8D62A7; color: white;">
                                    <tr>
                                        <th class="author-col" style="width: 200px">Author</th>
                                        <th class="post-col" style="width: 600px">Reply</th>
                                        <th class="date-col" style="width: 150px">Date</th>
                                        <th class="action-col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($topic->replies->isEmpty())
                                        <tr>
                                            <td colspan="4">No replies yet.</td>
                                        </tr>
                                    @else
                                        @foreach ($topic->replies as $reply)
                                            @if (!$reply->post_deleted)
                                                <tr>
                                                    <td class="author-col">by {{ $reply->user->name }}</td>
                                                    <td class="post-col">{{ $reply->reply }}</td>
                                                    <td class="date-col">{{ $reply->created_at->format('d-m-Y H:i:s') }}</td>
                                                    <td class="action-col">
                                                        @if (auth()->check() && auth()->user()->id === $reply->user_id)
                                                            <!-- delete button for the author of the reply -->
                                                            <form action="{{ route('reply.delete', ['category' => $category, 'topic' => $topic, 'reply' => $reply]) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">Delete</button>
                                                            </form>
                                                        @else
                                                            <!-- report button for replies -->
                                                            <button type="button" class="btn btn-warning report-btn" data-toggle="modal" data-target="#reportModal{{ $reply->id }}" data-reply-id="{{ $reply->id }}" style="width: 100px">Report</button>
                                                            <!-- Report Modal -->
                                                            <div class="modal fade" id="reportModal{{ $reply->id }}" tabindex="-1" role="dialog" aria-labelledby="reportModalLabel{{ $reply->id }}" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="reportModalLabel{{ $reply->id }}">Report Reply</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="form-group">
                                                                                <label for="reason{{ $reply->id }}">Reason:</label>
                                                                                <select name="reason"                                                                                 id="reason{{ $reply->id }}" class="form-control">
                                                                                    <option value="spam">Spam</option>
                                                                                    <option value="offensive">Offensive language</option>
                                                                                    <option value="inappropriate">Inappropriate content</option>
                                                                                    <option value="other">Other</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="otherReason{{ $reply->id }}">Other Reason:</label>
                                                                                <input type="text" name="otherReason" id="otherReason{{ $reply->id }}" class="form-control" placeholder="Please specify the reason">
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                            <button type="button" class="btn btn-primary" data-reply-id="{{ $reply->id }}">Submit</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        <form action="{{ route('topic.reply', ['category' => $category, 'topic' => $topic]) }}" method="POST" class="mb-3">
                            @csrf
                            <div class="form-group">
                                <label for="reply">Write your reply</label>
                                <textarea class="form-control" name="reply" rows="3" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary mt-2 mb-lg-5">Submit reply</button>
                            <button type="reset" class="btn btn-danger mt-2 mb-lg-5">Reset</button>
                        </form>
                        <a href="https://t.me/+2SFHLuO-Cgw5YjRl" target="_blank" class="btn btn-success mt-2 mb-lg-5">Join Group</a>
                        <button type="button" onclick="subscribeToNotification('{{ route('subscribe') }}');" class="btn btn-success mt-2 mb-lg-5">Subscribe to notification</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const reportButtons = document.querySelectorAll('.report-btn');

            reportButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    const replyId = this.getAttribute('data-reply-id');
                    const modalId = `#reportModal${replyId}`;
                    const reportReasonSelect = document.querySelector(`#reason${replyId}`);
                    const otherReasonInput = document.querySelector(`#otherReason${replyId}`);

                    // Reset the report form on modal open
                    $(modalId).on('show.bs.modal', function () {
                        reportReasonSelect.value = 'spam'; // Set default option
                        otherReasonInput.value = '';
                    });

                    // Show or hide the "Other" reason input field based on selection
                    reportReasonSelect.addEventListener('change', function () {
                        if (this.value === 'other') {
                            otherReasonInput.style.display = 'block';
                        } else {
                            otherReasonInput.style.display = 'none';
                        }
                    });

                    // Submit the report
                    $(modalId).find('.btn-primary').on('click', function () {
                        const reason = reportReasonSelect.value;
                        const otherReason = otherReasonInput.value;

                        // Send an AJAX request to submit the report
                        $.ajax({
                            url: "{{ route('submit.report', ['post_id' => $topic->id, 'reply_id' => 'REPLY_ID']) }}".replace('REPLY_ID', replyId),
                            type: "POST",
                            data: {
                                reason: reason,
                                otherReason: otherReason,
                                _token: "{{ csrf_token() }}",
                            },
                            success: function (response) {
                                // Handle the response or perform any necessary actions
                                // For example, display a success message or refresh the page

                                // Display a success message
                                if (response.success) {
                                    alert('Report has been submitted successfully.');
                                }

                                // Refresh the page
                                location.reload();
                            },
                            error: function (xhr, status, error) {
                                // Handle the error or display an error message
                                console.error(error);
                                alert('An error occurred while submitting the report. Please try again later.');
                            }
                        });

                        // Close the modal
                        $(modalId).modal('hide');
                    });
                });
            });
        });
    </script>
    <script>
    function subscribeToNotification(subscribeUrl) {
        // Send an AJAX request to subscribe the user
        $.ajax({
            url: subscribeUrl,
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                // Handle the response or perform any necessary actions
                // For example, display a success message or show an alert

                // Display a success message
                alert('Subscription successful. An email notification will be sent.');

                // You can also update the button text or do other DOM manipulations
                // For example, change the button text to "Subscribed"
                // $("#subscribeBtn").text("Subscribed");

                // Refresh the page (optional)
                // location.reload();
            },
            error: function (xhr, status, error) {
                // Handle the error or display an error message
                console.error(error);
                alert('An error occurred while subscribing. Please try again later.');
            }
        });
    }
    </script>

    

@endsection

