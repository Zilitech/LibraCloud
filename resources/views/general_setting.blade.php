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
                    <h5 class="page-title fs-21 mb-1">Library General Settings</h5>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Settings</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Library General Setting</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <!-- Info Alert -->
            <div class="alert alert-solid-secondary alert-dismissible fade show mb-4">
                After saving General Settings, please logout and login again for changes to take effect.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <!-- General Setting Form -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="card-header">
                            <div class="card-title">Update Library Settings</div>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('general.settings.update') }}" enctype="multipart/form-data">
    @csrf
    <div class="row g-3">

        <div class="col-md-4">
            <label class="form-label">Library Name *</label>
            <input type="text" class="form-control" name="library_name" value="{{ $settings->library_name ?? '' }}">
        </div>

        <div class="col-md-4">
            <label class="form-label">Library Code</label>
            <input type="text" class="form-control" name="library_code" value="{{ $settings->library_code ?? '' }}">
        </div>

        <div class="col-md-4">
            <label class="form-label">Site Name *</label>
            <input type="text" class="form-control" name="site_name" value="{{ $settings->site_name ?? '' }}">
        </div>

        <div class="col-md-12">
            <label class="form-label">Address *</label>
            <textarea class="form-control" name="address" rows="2">{{ $settings->address ?? '' }}</textarea>
        </div>

        <div class="col-md-4">
            <label class="form-label">Phone *</label>
            <input type="text" class="form-control" name="contact_no" value="{{ $settings->contact_no ?? '' }}">
        </div>

        <div class="col-md-4">
            <label class="form-label">Email *</label>
            <input type="email" class="form-control" name="email" value="{{ $settings->email ?? '' }}">
        </div>

        <div class="col-md-4">
            <label class="form-label">Max Books Per Member *</label>
            <input type="number" class="form-control" name="max_book_issue" value="{{ $settings->max_book_issue ?? '' }}">
        </div>

        <div class="col-md-4">
            <label class="form-label">Daily Fine Amount (₹) *</label>
            <input type="number" class="form-control" step="0.01" name="daily_fine" value="{{ $settings->daily_fine ?? '' }}">
        </div>

        <div class="col-md-4">
            <label class="form-label">Grace Period (Days)</label>
            <input type="number" class="form-control" name="grace_period" value="{{ $settings->grace_period ?? '' }}">
        </div>

        <div class="col-md-4">
            <label class="form-label">Due Date Alerts</label>
            <select class="form-select" name="due_date_alerts">
                <option value="Enable" {{ ($settings->due_date_alerts ?? '') == 'Enable' ? 'selected' : '' }}>Enable</option>
                <option value="Disable" {{ ($settings->due_date_alerts ?? '') == 'Disable' ? 'selected' : '' }}>Disable</option>
            </select>
        </div>

        <div class="col-md-4">
            <label class="form-label">New Arrival Alerts</label>
            <select class="form-select" name="new_arrival_alerts">
                <option value="Enable" {{ ($settings->new_arrival_alerts ?? '') == 'Enable' ? 'selected' : '' }}>Enable</option>
                <option value="Disable" {{ ($settings->new_arrival_alerts ?? '') == 'Disable' ? 'selected' : '' }}>Disable</option>
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">Logo Upload</label>
            <input type="file" class="form-control" name="logo" accept="image/*">
            @if(!empty($settings->logo))
                <img src="{{ asset($settings->logo) }}" alt="Logo" class="mt-2" height="80">
            @endif
        </div>

        <div class="col-md-6">
            <label class="form-label">Login Page Background</label>
            <input type="file" class="form-control" name="background_image" accept="image/*">
            @if(!empty($settings->background_image))
                <img src="{{ asset($settings->background_image) }}" alt="Background" class="mt-2" height="80">
            @endif
        </div>

        <div class="col-12 text-end mt-3">
            <button type="submit" class="btn btn-primary">Save Settings</button>
        </div>

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
