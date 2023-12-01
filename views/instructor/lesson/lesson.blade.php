@extends('layout.master')

@section('content')
<div class="container shadow">
    <div class="row">
        <div class="col-md-8">
            <h1>Lessons</h1>
        </div>
        <div class="col-md-4 my-3">
            <a href="{{ route('instructor.lesson.lesson-create') }}" class="btn btn-primary float-md-end">Create Lesson</a>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Course</th>
                <th>Title</th>
                <th>Content</th>
                <th>Attachment</th>
                <th>Video</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lessons as $lesson)
                <tr>
                    <td>{{ $lesson->course->title }}</td>
                    <td>{{ $lesson->title }}</td>
                    <td>{{ $lesson->content }}</td>
                    <td>
                    @if ($lesson->attachment)
                        <div class="mb-3">
                            <a href="{{ asset('storage/' . $lesson->attachment) }}" class="btn btn-primary" target="_blank" download>
                                Download Attachment
                            </a>
                        </div>
                    @endif
                    </td>
                    <td>
                        @if ($lesson->video_source)
                            {{-- Convert YouTube link to embed link --}}
                            @php
                                $videoId = explode('v=', $lesson->video_source)[1] ?? null;
                                $embedLink = $videoId ? "https://www.youtube.com/embed/$videoId" : null;
                            @endphp

                            @if ($embedLink)
                                {{-- Embed YouTube video --}}
                                <iframe width="200" height="100" src="{{ $embedLink }}" frameborder="0" allowfullscreen></iframe>
                            @else
                                N/A
                            @endif
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        <!-- Edit Button Triggering Modal -->
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $lesson->id }}">
                            Edit
                        </button>

                        <!-- Delete Button Triggering Modal -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $lesson->id }}">
                            Delete
                        </button>
                    </td>
                </tr>

               <!-- Edit Modal -->
<div class="modal fade" id="editModal{{ $lesson->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $lesson->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $lesson->id }}">Edit Lesson</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Edit form content -->
                <form action="{{ route('instructor.lesson.update', $lesson->id) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="edit_title{{ $lesson->id }}" class="form-label">Lesson Title</label>
                        <input type="text" class="form-control" id="edit_title{{ $lesson->id }}" name="edit_title" value="{{ $lesson->title }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_content{{ $lesson->id }}" class="form-label">Lesson Content</label>
                        <textarea class="form-control" id="edit_content{{ $lesson->id }}" name="edit_content" rows="5" required>{{ $lesson->content }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="attachment" class="form-label">Attachment (Optional)</label>
                        <input type="file" class="form-control" id="attachment" name="attachment">
                    </div>

                    <div class="mb-3">
                        <label for="video_source" class="form-label">Video Source (Optional)</label>
                        <input type="text" class="form-control" id="video_source" name="video_source" value="{{ $lesson->video_source }}">
                    </div>

                    <div class="mb-3">
                        <label for="video_file">Video File (MP4, etc.)</label>
                        <input type="file" class="form-control" id="video_file" name="video_file">
                    </div>

                    <button type="submit" class="btn btn-primary">Update Lesson</button>
                </form>
            </div>
        </div>
    </div>
</div>


                <!-- Delete Modal -->
                <div class="modal fade" id="deleteModal{{ $lesson->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $lesson->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel{{ $lesson->id }}">Confirm Deletion</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete this lesson?</p>
                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('instructor.lesson.destroy', $lesson->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')

                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
