@extends('layout.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-user-graduate fa-4x me-3 text-primary"></i>
                    <div class="ms-auto">
                        <h6 class="card-title">Enrolled Courses</h6>
                        <h1 class="card-number">200</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-check-circle fa-4x me-3 text-success"></i>
                    <div class="ms-auto">
                        <h6 class="card-title">Completed Courses</h6>
                        <h1 class="card-number">50</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-users fa-4x me-3 text-warning"></i>
                    <div class="ms-auto">
                        <h6 class="card-title">Total Students</h6>
                        <h1 class="card-number">1000</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-book fa-4x me-3 text-secondary"></i>
                    <div class="ms-auto">
                        <h6 class="card-title">Total Courses</h6>
                        <h1 class="card-number">150</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-chalkboard-teacher fa-4x me-3 text-info"></i>
                    <div class="ms-auto">
                        <h6 class="card-title">Total Lessons</h6>
                        <h1 class="card-number">30</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-question-circle fa-4x me-3 text-danger"></i>
                    <div class="ms-auto">
                        <h6 class="card-title">Total Questions</h6>
                        <h1 class="card-number">75</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-clipboard-list fa-4x me-3 text-success"></i>
                    <div class="ms-auto">
                        <h6 class="card-title">Total Quizzes</h6>
                        <h1 class="card-number">10</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card">
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-coins fa-4x me-3 text-warning"></i>
                    <div class="ms-auto">
                        <h6 class="card-title">Total Earnings</h6>
                        <h1 class="card-number">5000</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
