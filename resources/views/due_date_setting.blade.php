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
                    <h5 class="page-title fs-21 mb-1">Fine & Due Date Settings</h5>
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
                Configure library fine rates, grace period, and due date alert notifications for members.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <!-- Settings Form -->
            <div class="row">
                <div class="col-xl-8 mx-auto">
                    <div class="card custom-card">
                        <div class="card-header">
                            <div class="card-title">Fine & Due Settings</div>
                        </div>
                        <div class="card-body">
                            <form>
                                <!-- Daily Fine Rate -->
                                <div class="mb-3">
                                    <label for="dailyFine" class="form-label">Daily Fine Rate</label>
                                    <input type="number" class="form-control" id="dailyFine" placeholder="Enter daily fine (₹)" value="5">
                                    <small class="form-text text-muted">Amount charged per day for overdue books.</small>
                                </div>

                                <!-- Grace Period -->
                                <div class="mb-3">
                                    <label for="gracePeriod" class="form-label">Grace Period</label>
                                    <input type="number" class="form-control" id="gracePeriod" placeholder="Enter grace period (days)" value="2">
                                    <small class="form-text text-muted">Number of days allowed beyond the due date before fines start.</small>
                                </div>

                                <!-- Alert Reminder Days -->
                                <div class="mb-3">
                                    <label for="alertDays" class="form-label">Alert Reminder Days</label>
                                    <input type="number" class="form-control" id="alertDays" placeholder="Enter days before due date" value="3">
                                    <small class="form-text text-muted">Number of days before the due date to send a reminder notification.</small>
                                </div>

                                <!-- Notification Method -->
                                <div class="mb-3">
                                    <label for="notificationMethod" class="form-label">Notification Method</label>
                                    <select class="form-select" id="notificationMethod">
                                        <option value="email" selected>Email</option>
                                        <option value="sms">SMS</option>
                                        <option value="both">Email & SMS</option>
                                    </select>
                                    <small class="form-text text-muted">Choose how members will be notified about due dates and fines.</small>
                                </div>

                                <!-- Maximum Fine -->
                                <div class="mb-3">
                                    <label for="maxFine" class="form-label">Maximum Fine Limit</label>
                                    <input type="number" class="form-control" id="maxFine" placeholder="Enter max fine (₹)" value="500">
                                    <small class="form-text text-muted">Maximum fine that can be applied per book.</small>
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
