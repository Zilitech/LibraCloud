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
                    <h5 class="page-title fs-21 mb-1">Library Settings</h5>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Settings</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Library Setting</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <!-- Success Alert -->
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="card-body">
                            <form action="{{ url('library.setting.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('POST')

                                <ul class="nav nav-tabs" id="librarySettingsTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="general-tab" data-bs-toggle="tab" data-bs-target="#general" type="button" role="tab">Library Info</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <!-- <button class="nav-link" id="fine-tab" data-bs-toggle="tab" data-bs-target="#fine" type="button" role="tab">Fine Settings</button> -->
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <!-- <button class="nav-link" id="issue-tab" data-bs-toggle="tab" data-bs-target="#issue" type="button" role="tab">Issue / Return Rules</button> -->
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="notification-tab" data-bs-toggle="tab" data-bs-target="#notification" type="button" role="tab">Notifications</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="theme-tab" data-bs-toggle="tab" data-bs-target="#theme" type="button" role="tab">Theme & Language</button>
                                    </li>
                                </ul>

                                <div class="tab-content mt-4" id="librarySettingsTabContent">
                                    
                                    <!-- Library Info -->
                                    <div class="tab-pane fade show active" id="general" role="tabpanel">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Library Name *</label>
                                                <input type="text" class="form-control" name="library_name" value="{{ old('library_name', $settings->library_name ?? '') }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Library Code</label>
                                                <input type="text" class="form-control" name="library_code" value="{{ old('library_code', $settings->library_code ?? '') }}">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label">Address *</label>
                                                <textarea class="form-control" name="address" rows="2" required>{{ old('address', $settings->address ?? '') }}</textarea>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Phone *</label>
                                                <input type="text" class="form-control" name="phone" value="{{ old('phone', $settings->phone ?? '') }}" required>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Email *</label>
                                                <input type="email" class="form-control" name="email" value="{{ old('email', $settings->email ?? '') }}" required>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Logo</label>
                                                <input type="file" class="form-control" name="logo" accept="image/*">
                                                @if(!empty($settings->logo))
                                                    <img src="{{ asset('storage/'.$settings->logo) }}" alt="Logo" class="mt-2" height="50">
                                                @endif
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label">Login Page Background</label>
                                                <input type="file" class="form-control" name="login_background" accept="image/*">
                                                @if(!empty($settings->login_background))
                                                    <img src="{{ asset('storage/'.$settings->login_background) }}" alt="Background" class="mt-2" height="50">
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Fine Settings -->
                                    <!-- <div class="tab-pane fade" id="fine" role="tabpanel">
                                        <div class="row g-3 mt-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Daily Fine Rate *</label>
                                                <input type="number" step="0.01" class="form-control" name="daily_fine" value="{{ old('daily_fine', $settings->daily_fine ?? '') }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Grace Period (Days)</label>
                                                <input type="number" class="form-control" name="grace_period" value="{{ old('grace_period', $settings->grace_period ?? '') }}">
                                            </div>
                                        </div>
                                    </div> -->

                                    <!-- Issue / Return Rules -->
                                    <!-- <div class="tab-pane fade" id="issue" role="tabpanel">
                                        <div class="row g-3 mt-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Max Books per Member *</label>
                                                <input type="number" class="form-control" name="max_books_per_member" value="{{ old('max_books_per_member', $settings->max_books_per_member ?? '') }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Issue Duration (Days) *</label>
                                                <input type="number" class="form-control" name="issue_duration_days" value="{{ old('issue_duration_days', $settings->issue_duration_days ?? '') }}" required>
                                            </div>
                                        </div>
                                    </div> -->

                                    <!-- Notifications -->
                                    <div class="tab-pane fade" id="notification" role="tabpanel">
                                        <div class="row g-3 mt-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Due Date Alerts</label>
                                                <select class="form-select" name="due_date_alert">
                                                    <option value="1" {{ (old('due_date_alert', $settings->due_date_alert ?? 0)==1)?'selected':'' }}>Enable</option>
                                                    <option value="0" {{ (old('due_date_alert', $settings->due_date_alert ?? 0)==0)?'selected':'' }}>Disable</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">New Arrival Alerts</label>
                                                <select class="form-select" name="new_arrival_alert">
                                                    <option value="1" {{ (old('new_arrival_alert', $settings->new_arrival_alert ?? 0)==1)?'selected':'' }}>Enable</option>
                                                    <option value="0" {{ (old('new_arrival_alert', $settings->new_arrival_alert ?? 0)==0)?'selected':'' }}>Disable</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Theme & Language -->
                                    <div class="tab-pane fade" id="theme" role="tabpanel">
                                        <div class="row g-3 mt-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Backend Theme</label>
                                                <select class="form-select" name="theme">
                                                    <option value="light" {{ (old('theme', $settings->theme ?? '')=='light')?'selected':'' }}>Light</option>
                                                    <option value="dark" {{ (old('theme', $settings->theme ?? '')=='dark')?'selected':'' }}>Dark</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Language</label>
                                                <select class="form-select" name="language">
                                                    <option value="en" {{ (old('language', $settings->language ?? '')=='en')?'selected':'' }}>English</option>
                                                    <option value="hi" {{ (old('language', $settings->language ?? '')=='hi')?'selected':'' }}>Hindi</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="mt-4 text-end">
                                    <button type="submit" class="btn btn-primary">Save Settings</button>
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
