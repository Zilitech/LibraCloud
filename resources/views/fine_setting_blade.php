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
                    <h5 class="page-title fs-21 mb-1">Fine Settings</h5>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Settings</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Fine Settings</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <!-- Info Alert -->
            <div class="alert alert-solid-secondary alert-dismissible fade show mb-4">
                Configure the daily fine and grace period for overdue books.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="card-header">
                            <div class="card-title">Update Fine Settings</div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('library.fine.update') }}" method="POST">
                                @csrf
                                @method('POST')

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Daily Fine Rate (₹)</label>
                                        <input type="number" step="0.01" class="form-control" name="daily_fine" value="{{ old('daily_fine', $settings->daily_fine ?? '') }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Grace Period (Days)</label>
                                        <input type="number" class="form-control" name="grace_period" value="{{ old('grace_period', $settings->grace_period ?? '') }}">
                                    </div>
                                </div>

                                <div class="mt-4 text-end">
                                    <button type="submit" class="btn btn-primary">Save Fine Settings</button>
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
