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
                <a href="{{ url('inventory_management') }}" class="btn btn-secondary"><i class="ri-arrow-left-line"></i> Back to Inventory</a>

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



   @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

 <form id="addInventoryForm" method="POST" action="{{ route('inventory.store') }}">
    @csrf
    <input type="hidden" id="currentStock" name="current_stock" value="0">

    <div class="row gy-4">

        <!-- Select Book -->
        <div class="col-xl-6">
            <label for="bookSelect" class="form-label">Select Book:</label>
            <select class="form-select" id="bookSelect" name="book_id" required>
                <option selected disabled>-- Choose Book --</option>
                @foreach($books as $book)
                    <option value="{{ $book->id }}">{{ $book->book_title }}</option>
                @endforeach
            </select>
        </div>

        <!-- Add Quantity -->
        <div class="col-xl-6">
            <label for="addQuantity" class="form-label">Add Quantity:</label>
            <input type="number" class="form-control" id="addQuantity" name="added_quantity" required>
        </div>

        <!-- Damaged -->
        <div class="col-xl-6">
            <label for="damaged" class="form-label">Damaged / Lost Copies:</label>
            <input type="number" class="form-control" id="damaged" name="damaged">
        </div>

        <!-- Rack Number -->
        <div class="col-xl-6">
            <label for="rackNumber" class="form-label">Rack Number:</label>
            <input type="text" class="form-control" id="rackNumber" name="rack_number">
        </div>

        <!-- Condition -->
        <div class="col-xl-6">
            <label for="condition" class="form-label">Condition:</label>
            <select class="form-select" id="condition" name="condition">
                <option selected disabled>-- Select Condition --</option>
                <option value="Good">Good</option>
                <option value="Average">Average</option>
                <option value="Damaged">Damaged</option>
            </select>
        </div>

        <!-- Supplier -->
        <div class="col-xl-6">
            <label for="supplier" class="form-label">Supplier / Vendor:</label>
            <input type="text" class="form-control" id="supplier" name="supplier">
        </div>

        <!-- Purchase Date -->
        <div class="col-xl-6">
            <label for="purchaseDate" class="form-label">Purchase Date:</label>
            <input type="date" class="form-control" id="purchaseDate" name="purchase_date">
        </div>

        <!-- Remarks -->
        <div class="col-xl-12">
            <label for="remarks" class="form-label">Remarks / Notes:</label>
            <textarea class="form-control" id="remarks" name="remarks" rows="3"></textarea>
        </div>

        <div class="col-12 text-end mt-3">
            <button type="reset" class="btn btn-secondary me-2">Reset</button>
            <button type="submit" class="btn btn-primary">Save Inventory</button>
        </div>
    </div>
</form>


<!-- Script to update current stock dynamically -->
<script>
document.getElementById('bookSelect').addEventListener('change', function() {
    const bookName = this.value;

    fetch(`/books/${encodeURIComponent(bookName)}/stock`)
        .then(res => {
            if (!res.ok) throw new Error("Failed to fetch stock data");
            return res.json();
        })
        .then(data => {
            document.getElementById('currentStock').value = data.current_stock ?? 0;
        })
        .catch(error => {
            console.error(error);
            document.getElementById('currentStock').value = 0;
        });
});
</script>

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


</body>
</html>
