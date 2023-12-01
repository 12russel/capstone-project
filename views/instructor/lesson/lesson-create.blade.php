@extends('layout.master')

@section('content')
    <div class="container shadow">
        <div class="row">
            <div class="col-md-8">
                <h1>Create Lesson</h1>
            </div>
        </div>

        <form action="{{ route('instructor.lesson.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="course_id" class="form-label">Course</label>
                <select class="form-select" id="course_id" name="course_id" required>
                    @foreach ($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">Lesson Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Lesson Content</label>
                <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
            </div>

            <div class="mb-3">
                <label for="attachment" class="form-label">Attachment (Optional)</label>
                <input type="file" class="form-control" id="attachment" name="attachment">
            </div>

            <div class="mb-3">
                <label for="video_source" class="form-label">Video Source (Optional)</label>
                <input type="text" class="form-control" id="video_source" name="video_source">

                <div class="mb-3">
                    <label for="video_file">Video File (MP4, etc.)</label>
                    <input type="file" class="form-control" id="video_file" name="video_file">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Create Lesson</button>
        </form>
    </div>
@endsection
