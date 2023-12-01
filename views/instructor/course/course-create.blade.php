@extends('layout.master')

@section('content')
<div class="container border" style="border-radius: 20px;">
    <h1>Create Course</h1>
    <form action="{{ route('instructor.course.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-md-9">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" id="title" name="title" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="summary" class="form-label">Summary</label>
                    <textarea id="summary" name="summary" class="form-control" rows="6" required></textarea>
                </div>

                <div class="container border p-3" style="border-radius: 15px;">
                    <div class="mb-3">
                        <label class="form-label">Difficulty</label><br>
                        <div class="form-check form-check-inline">
                            <input type="radio" id="beginner" name="difficulty" class="form-check-input" value="beginner" required>
                            <label for="beginner" class="form-check-label">Beginner</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" id="intermediate" name="difficulty" class="form-check-input" value="intermediate" required>
                            <label for="intermediate" class="form-check-label">Intermediate</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" id="expert" name="difficulty" class="form-check-input" value="expert" required>
                            <label for="expert" class="form-check-label">Expert</label>
                        </div>
                    </div>
                </div>
                <div class="container p-0 mt-3 mb-3" style="border-radius: 15px;">
                    <button type="submit" class="btn btn-primary">Create Course</button>
                </div>
            </div>
            <div class="col-md-3">
                <div class="container border p-3 mb-3" style="border-radius: 15px;">
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" id="image" name="image" class="form-control">
                    </div>
                </div>
                <hr>
                <div class="container border p-3 mb-3" style="border-radius: 15px;">
    <div class="mb-3">
        <label for="tag" class="form-label">Tag</label>
        @foreach ($tags as $tag)
            <div class="form-check">
                <input type="checkbox" id="tag_{{ $tag->id }}" name="tags[]" class="form-check-input" value="{{ $tag->id }}">
                <label for="tag_{{ $tag->id }}" class="form-check-label">{{ $tag->name }}</label>
            </div>
        @endforeach
    </div>
</div>

<div class="container border p-3 mb-3" style="border-radius: 15px;">
    <div class="mb-3">
        <label for="category" class="form-label">Category</label>
        @foreach ($categories as $category)
            <div class="form-check">
                <input type="checkbox" id="category_{{ $category->id }}" name="categories[]" class="form-check-input" value="{{ $category->id }}">
                <label for="category_{{ $category->id }}" class="form-check-label">{{ $category->name }}</label>
            </div>
        @endforeach
    </div>
</div>


                <hr>

                <div class="container border p-3" style="border-radius: 15px;">
                    <h7>Paid Course</h7>
                    <hr>
                    <div class="mb-3 form-check">
                        <input type="hidden" name="paid" value="0">
                        <input type="checkbox" id="paid" name="paid" class="form-check-input" value="1" checked>
                        <label for="paid" class="form-check-label">Paid Course</label>
                    </div>
                    <hr class="mt-4">
                    <div class="mb-3 mt-4 input-group">
    <span class="input-group-text">₱</span>
    <label for="sales_amount" class="form-label visually-hidden">Course Amount</label>
    <input type="number" id="sales_amount" name="sales_amount" class="form-control" step="0.01" placeholder="Course Amount">
</div>

                </div>
            </div>
        </div>
    </form>
</div>
</div>
@endsection
