@include('head')

<body>

    @include('switcher')

    <!-- Loader -->
    <div id="loader">
        <img src="{{ asset('images/media/loader.svg') }}" alt="">
    </div>
    <!-- Loader -->

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
                        <h5 class="page-title fs-21 mb-1">Issue Book</h5>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Library</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Issue Book</li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <!-- Issue Form -->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card custom-card">
                            <div class="card-header justify-content-between">
                                <div class="card-title">Issue Book to Member</div>
                            </div>

                            <div class="card-body">
                                <div class="row gy-4">

                                    <!-- Issue ID -->
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <label class="form-label">Issue ID:</label>
                                        <input type="text" class="form-control" placeholder="Auto-generated" readonly>
                                    </div>

                                    <!-- Member -->
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <label class="form-label">Select Member:</label>
                                        <select class="form-select">
                                            <option selected disabled>-- Choose Member --</option>
                                            <option>John Doe (M001)</option>
                                            <option>Mary Smith (M002)</option>
                                            <option>Rahul Patil (M003)</option>
                                        </select>
                                    </div>

                                    <!-- Book -->
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <label class="form-label">Select Book:</label>
                                        <select class="form-select">
                                            <option selected disabled>-- Choose Book --</option>
                                            <option>Organic Chemistry Vol 2 (CHM101)</option>
                                            <option>Data Structures in C (CSC203)</option>
                                            <option>Indian Polity (POL102)</option>
                                        </select>
                                    </div>

                                    <!-- Book Code / ISBN -->
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <label class="form-label">Book Code / ISBN:</label>
                                        <input type="text" class="form-control" placeholder="Auto-filled from book" readonly>
                                    </div>

                                    <!-- Issue Date -->
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <label class="form-label">Issue Date:</label>
                                        <input type="date" class="form-control" value="{{ date('Y-m-d') }}">
                                    </div>

                                    <!-- Due Date -->
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <label class="form-label">Due Date:</label>
                                        <input type="date" class="form-control">
                                    </div>

                                    <!-- Quantity -->
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <label class="form-label">Quantity:</label>
                                        <input type="number" class="form-control" min="1" max="5" value="1">
                                    </div>

                                    <!-- Remarks -->
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <label class="form-label">Remarks:</label>
                                        <textarea class="form-control" rows="3" placeholder="Optional remarks or purpose"></textarea>
                                    </div>

                                    <!-- Status -->
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <label class="form-label">Status:</label>
                                        <select class="form-select">
                                            <option>Issued</option>
                                            <option>Returned</option>
                                            <option>Overdue</option>
                                        </select>
                                    </div>

                                    <!-- Generate Issue Slip -->
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <label class="form-label">Generate Issue Slip:</label>
                                        <div class="form-check form-switch mt-2">
                                            <input class="form-check-input" type="checkbox" id="issueSlip">
                                            <label class="form-check-label" for="issueSlip">Yes</label>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- Buttons -->
                            <div class="card-footer text-end">
                                <button type="reset" class="btn btn-secondary me-2">
                                    <i class="ri-refresh-line me-1"></i>Reset
                                </button>
                                <button type="submit" class="btn btn-success">
                                    <i class="ri-bookmark-3-line me-1"></i>Save & Issue
                                </button>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- End::app-content -->

        <!-- Footer -->
        @include('footer')

    </div>

    <!-- Scroll To Top -->
    <div class="scrollToTop">
        <span class="arrow"><i class="las la-angle-double-up"></i></span>
    </div>
    <div id="responsive-overlay"></div>

    <!-- JS Files -->
    <script src="{{ asset('libs/@popperjs/core/umd/popper.min.js') }}"></script>
    <script src="{{ asset('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/defaultmenu.min.js') }}"></script>
    <script src="{{ asset('libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('js/sticky.js') }}"></script>
    <script src="{{ asset('libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('js/simplebar.js') }}"></script>
    <script src="{{ asset('libs/@simonwep/pickr/pickr.es5.min.js') }}"></script>
    <script src="{{ asset('js/custom-switcher.min.js') }}"></script>
    <script src="{{ asset('libs/prismjs/prism.js') }}"></script>
    <script src="{{ asset('js/prism-custom.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>

</body>
</html>
