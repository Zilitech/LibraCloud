@include('head')

<body>
@include('switcher')

<div class="page">
    @include('header')
    @include('nav_sidebar')

    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                <div class="my-auto">
                    <h5 class="page-title fs-21 mb-1">Issue / Return Rules</h5>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Settings</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Issue / Return Rules</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <!-- Info Alert -->
            <div class="alert alert-solid-secondary alert-dismissible fade show mb-4">
                Set rules for book issue, return, and renewals.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>

            @php
                // Dummy data
                $settings = (object) [
                    'max_books_per_member' => 5,
                    'issue_duration_days' => 14,
                    'allow_renewal' => 1,
                    'max_renewals' => 2,
                    'overdue_fine_apply' => 1,
                ];
            @endphp

            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="card-header">
                            <div class="card-title">Update Issue / Return Rules</div>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('library.issue_return.update') }}" method="POST">
                                @csrf
                                @method('POST')

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Max Books per Member</label>
                                        <input type="number" class="form-control" name="max_books_per_member" value="{{ old('max_books_per_member', $settings->max_books_per_member) }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Issue Duration (Days)</label>
                                        <input type="number" class="form-control" name="issue_duration_days" value="{{ old('issue_duration_days', $settings->issue_duration_days) }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Allow Renewal</label>
                                        <select class="form-select" name="allow_renewal">
                                            <option value="1" {{ ($settings->allow_renewal) ? 'selected' : '' }}>Yes</option>
                                            <option value="0" {{ (!$settings->allow_renewal) ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Max Renewals per Book</label>
                                        <input type="number" class="form-control" name="max_renewals" value="{{ old('max_renewals', $settings->max_renewals) }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Apply Overdue Fine</label>
                                        <select class="form-select" name="overdue_fine_apply">
                                            <option value="1" {{ ($settings->overdue_fine_apply) ? 'selected' : '' }}>Yes</option>
                                            <option value="0" {{ (!$settings->overdue_fine_apply) ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mt-4 text-end">
                                    <button type="submit" class="btn btn-primary">Save Issue / Return Rules</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @include('footer')
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
