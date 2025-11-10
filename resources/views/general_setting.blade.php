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
                            <form>
                                <div class="row g-3">

                                    <!-- Library Info -->
                                    <div class="col-md-6">
                                        <label class="form-label">Library Name *</label>
                                        <input type="text" class="form-control" placeholder="Enter Library Name" value="LibraCloud">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Library Code</label>
                                        <input type="text" class="form-control" placeholder="Library Code" value="LIB001">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Address *</label>
                                        <textarea class="form-control" rows="2" placeholder="Library Address">123 Main St, City</textarea>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Phone *</label>
                                        <input type="text" class="form-control" placeholder="Phone Number" value="8050061666">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Email *</label>
                                        <input type="email" class="form-control" placeholder="Email Address" value="library@domain.com">
                                    </div>

                                    <!-- Library Rules -->
                                    <div class="col-md-4">
                                        <label class="form-label">Max Books Per Member *</label>
                                        <input type="number" class="form-control" placeholder="Max books a member can issue" value="5">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Issue Duration (Days) *</label>
                                        <input type="number" class="form-control" placeholder="Number of days a book can be issued" value="14">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Daily Fine Amount (₹) *</label>
                                        <input type="number" class="form-control" placeholder="Fine per day for overdue books" value="5">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Grace Period (Days)</label>
                                        <input type="number" class="form-control" placeholder="Days before fine is applied" value="2">
                                    </div>

                                    <!-- Notifications -->
                                    <div class="col-md-4">
                                        <label class="form-label">Due Date Alerts</label>
                                        <select class="form-select">
                                            <option>Enable</option>
                                            <option>Disable</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">New Arrival Alerts</label>
                                        <select class="form-select">
                                            <option>Enable</option>
                                            <option>Disable</option>
                                        </select>
                                    </div>

                                    <!-- Library Appearance -->
                                    <div class="col-md-6">
                                        <label class="form-label">Logo Upload</label>
                                        <input type="file" class="form-control" accept="image/*">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Login Page Background</label>
                                        <input type="file" class="form-control" accept="image/*">
                                    </div>

                                    <!-- Save Button -->
                                    <div class="col-12 text-end">
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
