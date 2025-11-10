@include('head')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">

<body>

@include('switcher')

<!-- Loader -->
<div id="loader">
    <img src="{{ asset('images/media/loader.svg') }}" alt="">
</div>
<!-- Loader -->

<div class="page">
    <!-- app-header -->
    @include('header')
    @include('nav_sidebar')

    <!-- Start::app-content -->
    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                <div class="my-auto">
                    <h5 class="page-title fs-21 mb-1">Add Inventory</h5>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Books</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Inventory</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- Page Header Close -->

            <!-- Card -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">Add / Update Inventory</div>
                        </div>

                        <div class="card-body">
                            <form id="addInventoryForm">
                                <div class="row gy-4">

                                    <!-- Select Book -->
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <label for="bookSelect" class="form-label">Select Book:</label>
                                        <select class="form-select" id="bookSelect">
                                            <option selected disabled>-- Choose Book --</option>
                                            <option value="1">Organic Chemistry Vol 2</option>
                                            <option value="2">Physics for Engineers</option>
                                            <option value="3">Modern Economics</option>
                                            <option value="4">World History Atlas</option>
                                            <option value="5">Advanced Mathematics</option>
                                        </select>
                                    </div>

                                    <!-- Current Stock -->
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <label for="currentStock" class="form-label">Current Stock:</label>
                                        <input type="number" class="form-control" id="currentStock" placeholder="Auto-filled from database" readonly>
                                    </div>

                                    <!-- Add Quantity -->
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <label for="addQuantity" class="form-label">Add Quantity:</label>
                                        <input type="number" class="form-control" id="addQuantity" placeholder="Enter quantity to add">
                                    </div>

                                    <!-- Damaged / Lost -->
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <label for="damaged" class="form-label">Damaged / Lost Copies:</label>
                                        <input type="number" class="form-control" id="damaged" placeholder="Enter damaged or lost count">
                                    </div>

                                    <!-- Rack Number -->
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <label for="rackNumber" class="form-label">Rack Number:</label>
                                        <input type="text" class="form-control" id="rackNumber" placeholder="e.g. R-12A">
                                    </div>

                                    <!-- Condition -->
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <label for="condition" class="form-label">Condition:</label>
                                        <select class="form-select" id="condition">
                                            <option selected disabled>-- Select Condition --</option>
                                            <option value="Good">Good</option>
                                            <option value="Average">Average</option>
                                            <option value="Damaged">Damaged</option>
                                        </select>
                                    </div>

                                    <!-- Supplier -->
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <label for="supplier" class="form-label">Supplier / Vendor:</label>
                                        <input type="text" class="form-control" id="supplier" placeholder="Enter Supplier Name">
                                    </div>

                                    <!-- Purchase Date -->
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <label for="purchaseDate" class="form-label">Purchase Date:</label>
                                        <input type="date" class="form-control" id="purchaseDate">
                                    </div>

                                    <!-- Remarks -->
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <label for="remarks" class="form-label">Remarks / Notes:</label>
                                        <textarea class="form-control" id="remarks" rows="3" placeholder="Optional notes about inventory update..."></textarea>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="card-footer text-end">
                            <button type="reset" class="btn btn-secondary me-2">
                                <i class="ri-refresh-line me-1"></i>Reset
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="ri-save-line me-1"></i>Save Inventory
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End:: row -->

        </div>
    </div>
    <!-- End::app-content -->

    <!-- Footer Start -->
    @include('footer')
    <!-- Footer End -->

</div>

<!-- ✅ Scroll To Top -->
<div class="scrollToTop">
    <span class="arrow"><i class="las la-angle-double-up"></i></span>
</div>
<div id="responsive-overlay"></div>

<!-- ✅ Scripts -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('libs/node-waves/waves.min.js') }}"></script>
<script src="{{ asset('js/defaultmenu.min.js') }}"></script>
<script src="{{ asset('js/sticky.js') }}"></script>
<script src="{{ asset('libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('js/simplebar.js') }}"></script>
<script src="{{ asset('libs/@simonwep/pickr/pickr.es5.min.js') }}"></script>
<script src="{{ asset('js/custom-switcher.min.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>

<!-- Optional: form validation or AJAX handling -->
<script>
$(document).ready(function(){
    $('#addInventoryForm').on('submit', function(e){
        e.preventDefault();
        alert('✅ Inventory record saved successfully!');
    });
});
</script>

</body>
</html>
