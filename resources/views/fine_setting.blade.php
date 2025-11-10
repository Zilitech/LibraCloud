@include('head')

<body>
@include('switcher')

<!-- Loader -->
<div id="loader">
    <img src="{{ asset('images/media/loader.svg') }}" alt="">
</div>

<div class="page">

    <!-- Header -->
    @include('header')
    @include('nav_sidebar')

    <!-- Main Content -->
    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                <div class="my-auto">
                    <h5 class="page-title fs-21 mb-1">Fine Settings</h5>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Library</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Fine Settings</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <!-- Info Alert -->
            <div class="alert alert-solid-info alert-dismissible fade show mb-4">
                Configure library fine rules: due days, overdue start, and daily fines.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <!-- Fine Settings Form -->
            <div class="row">
                <div class="col-xl-6 col-md-8">
                    <div class="card custom-card">
                        <div class="card-header">
                            <div class="card-title">Library Fine Rules</div>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="mb-3">
                                    <label for="due_days" class="form-label">Book Due Period (days)</label>
                                    <input type="number" class="form-control" id="due_days" placeholder="14" min="1">
                                    <small class="text-muted">Number of days a book can be kept without fine.</small>
                                </div>

                                <div class="mb-3">
                                    <label for="overdue_start" class="form-label">Overdue Start (days)</label>
                                    <input type="number" class="form-control" id="overdue_start" placeholder="1" min="0">
                                    <small class="text-muted">Fine calculation starts after this many days past due date.</small>
                                </div>

                                <div class="mb-3">
                                    <label for="daily_fine" class="form-label">Daily Fine Amount (₹)</label>
                                    <input type="number" class="form-control" id="daily_fine" placeholder="10" min="0">
                                    <small class="text-muted">Amount charged per day for overdue books.</small>
                                </div>

                                <div class="mb-3">
                                    <label for="max_fine" class="form-label">Maximum Fine (₹)</label>
                                    <input type="number" class="form-control" id="max_fine" placeholder="500" min="0">
                                    <small class="text-muted">Optional: maximum fine limit per book.</small>
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    <i class="ri-save-line me-1"></i> Save Settings
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Fine Settings Form -->

        </div>
    </div>
    <!-- End::app-content -->

    @include('footer')

</div>

<!-- Scroll To Top -->
<div class="scrollToTop">
    <span class="arrow"><i class="las la-angle-double-up"></i></span>
</div>
<div id="responsive-overlay"></div>

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
