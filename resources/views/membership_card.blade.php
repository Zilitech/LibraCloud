@include('head')

<body>

@include('switcher')

<!-- Loader -->
<div id="loader">
    <img src="{{ asset('images/media/loader.svg') }}" alt="">
</div>
<!-- Loader -->

<div class="page">
    @include('header')
    @include('nav_sidebar')

    <!-- Start::app-content -->
    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                <div class="my-auto">
                    <h5 class="page-title fs-21 mb-1">Issue Membership Card</h5>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ url('membership_cards') }}">Members</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Issue New Card</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- End Page Header -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">New Membership Card Details</div>
                        </div>

                        <div class="card-body">
                            <form>

                                <div class="row gy-4">

                                    <!-- Card Number -->
                                    <div class="col-xl-4 col-lg-6 col-md-6">
                                        <label for="cardNumber" class="form-label">Card Number:</label>
                                        <input type="text" id="cardNumber" class="form-control" value="LIB2025-004" readonly>
                                    </div>

                                    <!-- Member Name -->
                                    <div class="col-xl-4 col-lg-6 col-md-6">
                                        <label for="memberName" class="form-label">Select Member:</label>
                                        <select class="form-select" id="memberName">
                                            <option selected disabled>-- Choose Member --</option>
                                            <option>Ananya Rao</option>
                                            <option>Riya Sharma</option>
                                            <option>Arjun Patel</option>
                                            <option>Priya Nair</option>
                                        </select>
                                    </div>

                                    <!-- Member Category -->
                                    <div class="col-xl-4 col-lg-6 col-md-6">
                                        <label for="memberCategory" class="form-label">Member Category:</label>
                                        <select class="form-select" id="memberCategory">
                                            <option selected disabled>-- Select Category --</option>
                                            <option value="Student">Student</option>
                                            <option value="Faculty">Faculty</option>
                                            <option value="Guest">Guest</option>
                                        </select>
                                    </div>

                                    <!-- Issued Date -->
                                    <div class="col-xl-4 col-lg-6 col-md-6">
                                        <label for="issuedDate" class="form-label">Issued Date:</label>
                                        <input type="date" id="issuedDate" class="form-control" value="{{ date('Y-m-d') }}">
                                    </div>

                                    <!-- Expiry Date -->
                                    <div class="col-xl-4 col-lg-6 col-md-6">
                                        <label for="expiryDate" class="form-label">Expiry Date:</label>
                                        <input type="date" id="expiryDate" class="form-control" value="{{ date('Y-m-d', strtotime('+1 year')) }}">
                                    </div>

                                    <!-- Membership Type -->
                                    <!-- <div class="col-xl-4 col-lg-6 col-md-6">
                                        <label for="membershipType" class="form-label">Membership Type / Plan:</label>
                                        <select class="form-select" id="membershipType">
                                            <option selected disabled>-- Select Plan --</option>
                                            <option>Regular</option>
                                            <option>Premium</option>
                                            <option>Temporary</option>
                                        </select>
                                    </div> -->

                                    <!-- Status -->
                                    <div class="col-xl-4 col-lg-6 col-md-6">
                                        <label for="status" class="form-label">Card Status:</label>
                                        <select class="form-select" id="status">
                                            <option>Active</option>
                                            <option>Inactive</option>
                                            <option>Lost</option>
                                            <option>Blocked</option>
                                        </select>
                                    </div>

                                    <!-- Barcode / QR Code -->
                                    <div class="col-xl-4 col-lg-6 col-md-6">
                                        <label for="barcode" class="form-label">Barcode / QR Code:</label>
                                        <input type="text" id="barcode" class="form-control" value="AUTO-GENERATED" readonly>
                                    </div>

                                    <!-- Library Card Issued -->
                                    <div class="col-xl-4 col-lg-6 col-md-6">
                                        <label class="form-label d-block">Library Card Issued:</label>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="cardIssued" checked>
                                            <label class="form-check-label" for="cardIssued">Yes</label>
                                        </div>
                                    </div>

                                    <!-- Upload Profile Photo -->
                                    <div class="col-xl-4 col-lg-6 col-md-6">
                                        <label for="photo" class="form-label">Upload Member Photo:</label>
                                        <input class="form-control" type="file" id="photo" accept="image/*">
                                    </div>

                                    <!-- Remarks -->
                                    <div class="col-xl-12">
                                        <label for="remarks" class="form-label">Remarks / Notes:</label>
                                        <textarea class="form-control" id="remarks" rows="3" placeholder="Any special note or ID remarks..."></textarea>
                                    </div>

                                </div>

                            </form>
                        </div>

                        <div class="card-footer text-end">
                            <button type="reset" class="btn btn-secondary me-2"><i class="ri-refresh-line me-1"></i>Reset</button>
                            <button type="submit" class="btn btn-primary"><i class="ri-save-line me-1"></i>Save & Issue Card</button>
                        </div>

                    </div>
                </div>
            </div>

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

<!-- Scripts -->
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
