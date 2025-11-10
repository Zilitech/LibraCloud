@include('head')

<body>
@include('switcher')

<div class="page">
    @include('header')
    @include('nav_sidebar')

    <!-- Main Content -->
    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                <div class="my-auto">
                    <h5 class="page-title fs-21 mb-1">New Arrival Alerts</h5>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Settings</a></li>
                            <li class="breadcrumb-item active" aria-current="page">New Arrival Alerts</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <!-- Info Alert -->
            <div class="alert alert-solid-secondary alert-dismissible fade show mb-4">
                Configure how members are notified when new books arrive in the library.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <!-- Settings Form -->
            <div class="row">
                <div class="col-xl-8 mx-auto">
                    <div class="card custom-card">
                        <div class="card-header">
                            <div class="card-title">New Arrival Notification Settings</div>
                        </div>
                        <div class="card-body">
                            <form>
                                <!-- Notification Method -->
                                <div class="mb-3">
                                    <label for="notificationMethod" class="form-label">Notification Method</label>
                                    <select class="form-select" id="notificationMethod">
                                        <option value="email" selected>Email</option>
                                        <option value="sms">SMS</option>
                                        <option value="both">Email & SMS</option>
                                    </select>
                                    <small class="form-text text-muted">Choose how members will be notified about new arrivals.</small>
                                </div>

                                <!-- Notify Categories -->
                                <div class="mb-3">
                                    <label for="notificationMethod" class="form-label">Notify To</label>
                                    <select class="form-select" id="notificationMethod">
                                        <option value="all" selected>All Members</option>
                                        <option value="student">Student</option>
                                        <option value="faculty">Faculty</option>
                                        <option value="guest">Guest</option>
                                    </select>
                                    <small class="form-text text-muted">Choose how members will be notified about new arrivals.</small>
                                </div>

                                <!-- Alert Frequency -->
                                <div class="mb-3">
                                    <label for="alertFrequency" class="form-label">Alert Frequency</label>
                                    <select class="form-select" id="alertFrequency">
                                        <option value="immediate" selected>Immediate (as soon as new books arrive)</option>
                                        <option value="daily">Daily Summary</option>
                                        <option value="weekly">Weekly Summary</option>
                                    </select>
                                    <small class="form-text text-muted">How often members should be notified about new arrivals.</small>
                                </div>

                                <!-- Email Subject -->
                                <div class="mb-3">
                                    <label for="emailSubject" class="form-label">Email Subject</label>
                                    <input type="text" class="form-control" id="emailSubject" placeholder="New Arrivals at Your Library" value="New Arrivals at Your Library">
                                </div>

                                <!-- Message Template -->
                                <div class="mb-3">
                                    <label for="messageTemplate" class="form-label">Message Template</label>
                                    <textarea class="form-control" id="messageTemplate" rows="4">Dear , new books have arrived in the library. Check them out now!</textarea>
                                    <small class="form-text text-muted">Replace with the member's name for personalization.</small>
                                </div>

                                <!-- Submit -->
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary"><i class="ri-save-line me-1"></i> Save Settings</button>
                                    <button type="reset" class="btn btn-outline-secondary ms-2">Reset</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Settings Form -->

        </div>
    </div>

    @include('footer')
</div>

<!-- JS Files -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/defaultmenu.min.js') }}"></script>
<script src="{{ asset('libs/node-waves/waves.min.js') }}"></script>
<script src="{{ asset('js/sticky.js') }}"></script>
<script src="{{ asset('libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('js/simplebar.js') }}"></script>
<script src="{{ asset('libs/@simonwep/pickr/pickr.es5.min.js') }}"></script>
<script src="{{ asset('js/custom-switcher.min.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>

</body>
</html>
