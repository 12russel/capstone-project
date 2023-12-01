@extends('layout.master')

@section('content')
<div class="container shadow">
    <div class="row">
        <div class="col-md-8">
            <h1>All Courses</h1>
        </div>
        <div class="col-md-4 my-3">
            <a href="{{ route('instructor.course.course-create') }}" class="btn btn-primary float-md-end">Create Course</a>
        </div>
    </div>

   <!-- Live Search Bar -->
   <form action="{{ route('instructor.course.course') }}" method="GET" class="my-3 row">
        <div class="col-md-4 offset-md-8">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search" name="search" value="{{ request('search') }}" id="liveSearchInput">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </div>
    </form>
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr class="text-center">
                <th onclick="sortTable(0)" class="text-center">Title <span id="titleSortIcon">&#8593;</span></th>
                <th onclick="sortTable(1)" class="text-center">Summary <span id="summarySortIcon">&#8593;</span></th>
                <th onclick="sortTable(2)" class="text-center">Difficulty <span id="difficultySortIcon">&#8593;</span></th>
                <th>Paid</th>
                <th>Amount</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($courses as $course)
            <tr class="text-center">
                <td>{{ $course->title }}</td>
                <td>{{ $course->summary }}</td>
                <td>{{ $course->difficulty }}</td>
                <td>{{ $course->paid == 1 ? 'Paid' : '' }}</td>
                <td>{{ $course->sales->sum('amount') }}</td>
                <td>
                    <!-- Edit Button -->
                    <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editCourseModal{{ $course->id }}"><i class="fas fa-edit fa-sm x-2"></i></button>
                    <!-- Delete Button -->
                    <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteCourseModal{{ $course->id }}"><i class="fas fa-trash fa-sm"></i></button>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination d-flex justify-content-center mt-4">
    <ul class="pagination">
        @if($courses->currentPage() > 1)
            <li class="page-item"><a class="page-link" href="{{ $courses->url(1) }}">«</a></li>
            <li class="page-item"><a class="page-link" href="{{ $courses->previousPageUrl() }}">‹</a></li>
        @endif

        @for ($i = max(1, $courses->currentPage() - 2); $i <= min($courses->currentPage() + 2, $courses->lastPage()); $i++)
            <li class="page-item {{ ($courses->currentPage() == $i) ? ' active' : '' }}">
                <a class="page-link" href="{{ $courses->url($i) }}">{{ $i }}</a>
            </li>
        @endfor

        @if($courses->currentPage() < $courses->lastPage())
            <li class="page-item"><a class="page-link" href="{{ $courses->nextPageUrl() }}">›</a></li>
            <li class="page-item"><a class="page-link" href="{{ $courses->url($courses->lastPage()) }}">»</a></li>
        @endif
    </ul>
</div>
</div>

</div>

@foreach ($courses as $course)
    <!-- Edit Modal -->
    <div class="modal fade" id="editCourseModal{{ $course->id }}" tabindex="-1" role="dialog" aria-labelledby="editCourseModalLabel{{ $course->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editCourseModalLabel{{ $course->id }}">Edit Course</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" id="title" name="title" class="form-control" value="{{ $course->title }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="summary" class="form-label">Summary</label>
                            <textarea id="summary" name="summary" class="form-control" rows="6" required>{{ $course->summary }}</textarea>
                        </div>
                        <div class="container border p-3 mb-3" style="border-radius: 15px;">
                            <div class="mb-3">
                                <label for="amount" class="form-label">Amount</label>
                                <input type="text" id="amount" name="sales_amount" class="form-control" value="{{ $course->sales->sum('amount') }}" required>
                            </div>
                        </div>
                        <div class="container border p-3" style="border-radius: 15px;">
                            <div class="mb-3">
                                <label class="form-label">Difficulty</label><br>
                                <div class="form-check form-check-inline">
                                    <input type="radio" id="beginner_{{ $course->id }}" name="difficulty" class="form-check-input" value="beginner" @if ($course->difficulty === 'beginner') checked @endif required>
                                    <label for="beginner_{{ $course->id }}" class="form-check-label">Beginner</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" id="intermediate_{{ $course->id }}" name="difficulty" class="form-check-input" value="intermediate" @if ($course->difficulty === 'intermediate') checked @endif required>
                                    <label for="intermediate_{{ $course->id }}" class="form-check-label">Intermediate</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" id="expert_{{ $course->id }}" name="difficulty" class="form-check-input" value="expert" @if ($course->difficulty === 'expert') checked @endif required>
                                    <label for="expert_{{ $course->id }}" class="form-check-label">Expert</label>
                                </div>
                            </div>
                        </div>
                        <div class="container border p-1 mt-3 mb-3" style="border-radius: 10px;">
                        <div class="mb-3">
                        <label for="tags" class="form-label p-2">Tags</label>
                        <div class="container">
                            @foreach ($tags as $tag)
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" id="tag_{{ $tag->id }}" name="tags[]" class="form-check-input" value="{{ $tag->id }}" @if(in_array($tag->id, $course->tags->pluck('id')->toArray())) checked @endif>
                                    <label for="tag_{{ $tag->id }}" class="form-check-label">{{ $tag->name }}</label>
                                </div>
                            @endforeach
                        </div>
                        </div>
                    </div>
                    <div class="container border p-1" style="border-radius: 10px;">
                    <div class="mb-3">
                        <label for="categories" class="form-label p-2">Categories</label>
                        <div class="container">
                            @foreach ($categories as $category)
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" id="category_{{ $category->id }}" name="categories[]" class="form-check-input" value="{{ $category->id }}" @if(in_array($category->id, $course->categories->pluck('id')->toArray())) checked @endif>
                                    <label for="category_{{ $category->id }}" class="form-check-label">{{ $category->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
</div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteCourseModal{{ $course->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteCourseModalLabel{{ $course->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('course.destroy', $course->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteCourseModalLabel{{ $course->id }}">Delete Course</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this course: {{ $course->title }}?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
<script>
    // Sorting function
    function sortTable(columnIndex) {
        var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
        table = document.querySelector("table");
        switching = true;
        // Set the sorting direction to ascending:
        dir = "asc";
        // Loop until no switching has been done:
        while (switching) {
            switching = false;
            rows = table.rows;
            // Loop through all table rows (except the first, which contains table headers):
            for (i = 1; i < rows.length - 1; i++) {
                shouldSwitch = false;
                // Get the two elements you want to compare, one from the current row and one from the next:
                x = rows[i].getElementsByTagName("td")[columnIndex];
                y = rows[i + 1].getElementsByTagName("td")[columnIndex];
                // Check if the two rows should switch place, based on the direction, and update the direction accordingly:
                if (dir == "asc" && x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                } else if (dir == "desc" && x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }
            }
            if (shouldSwitch) {
                // If a switch has been marked, make the switch and mark that a switch has been done:
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                // Each time a switch is done, increase this count by 1:
                switchcount++;
            } else {
                // If no switching has been done and the direction is "asc", set the direction to "desc" and run the while loop again:
                if (switchcount == 0 && dir == "asc") {
                    dir = "desc";
                    switching = true;
                }
            }
        }
        // Update sorting icons
        updateSortIcons(columnIndex, dir);
    }

    // Update sorting icons
    function updateSortIcons(columnIndex, direction) {
        var sortIconIds = ['titleSortIcon', 'summarySortIcon', 'difficultySortIcon'];
        // Reset all icons
        sortIconIds.forEach(function (iconId) {
            document.getElementById(iconId).innerHTML = '&#8593;';
        });
        // Set the icon for the current column based on the sorting direction
        document.getElementById(sortIconIds[columnIndex]).innerHTML = direction === 'asc' ? '&#8593;' : '&#8595;';
    }

    // Function to show sorting icons
    function showSortIcons(row) {
        var icons = row.getElementsByClassName('sort-icon');
        for (var i = 0; i < icons.length; i++) {
            icons[i].style.visibility = 'visible';
        }
    }

    // Function to hide sorting icons
    function hideSortIcons(row) {
        var icons = row.getElementsByClassName('sort-icon');
        for (var i = 0; i < icons.length; i++) {
            icons[i].style.visibility = 'hidden';
        }
    }
    
    // Live Search
    document.getElementById('liveSearchInput').addEventListener('input', function () {
        var filter, table, tr, td, i, txtValue;
        filter = this.value.toUpperCase();
        table = document.querySelector("table");
        tr = table.getElementsByTagName("tr");
        // Loop through all table rows, and hide those who don't match the search query:
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0]; // Change the index to the column you want to search
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                    // Add fade-in animation
                    tr[i].classList.add("fade-in");
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    });
    
</script>
<style>
    table th {
        cursor: pointer;
    }

    .fade-in {
        animation: fadeIn ease 2s;
        -webkit-animation: fadeIn ease 2s;
        -moz-animation: fadeIn ease 2s;
        -o-animation: fadeIn ease 2s;
        -ms-animation: fadeIn ease 2s;
        transition: opacity 0.5s;
    }

    @keyframes fadeIn {
        0% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }

    @-moz-keyframes fadeIn {
        0% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }

    @-webkit-keyframes fadeIn {
        0% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }

    @-o-keyframes fadeIn {
        0% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }

    @-ms-keyframes fadeIn {
        0% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }
</style>
@endsection
