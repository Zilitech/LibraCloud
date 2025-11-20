@include('head')

<body>
    @include('switcher')

    <!-- Loader -->
    <div id="loader">
        <img src="{{ asset('images/media/loader.svg') }}" alt="">
    </div>

    <div class="page">
        @include('header')
        @include('nav_sidebar')

        <!-- Start::app-content -->
        <div class="main-content app-content">
            <div class="container-fluid py-4">

                <!-- Page Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                        <div class="my-auto">
                            <h5 class="page-title fs-21 mb-1">Book Lookup by Barcode</h5>
                            <nav>
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="javascript:void(0);">Barcode Management</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Book Lookup by Barcode</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <a href="{{ url('scan_barcode') }}" class="btn btn-secondary">
                        <i class="ri-arrow-left-line"></i> Back to Scan Barcode
                    </a>
                </div>

                <!-- Info Alert -->
                <div class="alert alert-info">
                    Enter or paste a book barcode below to view its complete details.
                </div>

                <div class="row">
                    <!-- Lookup Section -->
                    <div class="col-md-5 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">Enter Barcode</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="barcodeInput" class="form-label">Book Barcode / ISBN</label>
                                    <input type="text" id="barcodeInput" class="form-control" placeholder="e.g. CHM101">
                                </div>
                                <button class="btn btn-success w-100" id="lookupBtn">
                                    <i class="ri-search-line"></i> Search Book
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Result Section -->
                    <div class="col-md-7 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-header bg-info text-white">
                                <h5 class="mb-0">Book Details</h5>
                            </div>
                            <div class="card-body" id="bookDetails" style="min-height: 250px;">
                                <p class="text-muted text-center">No book selected yet.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- End::app-content -->

        @include('footer')
    </div>

    @include('foot')

    <!-- AJAX Book Lookup Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const lookupBtn = document.getElementById('lookupBtn');
            const barcodeInput = document.getElementById('barcodeInput');
            const bookDetails = document.getElementById('bookDetails');

            function displayBook(book) {
                bookDetails.innerHTML = `
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <tbody>
                                <tr><th>📘 Title</th><td>${book.book_title}</td></tr>
                                <tr><th>✍️ Author</th><td>${book.author_name || 'N/A'}</td></tr>
                                <tr><th>🏷️ Category</th><td>${book.category_name || 'N/A'}</td></tr>
                                <tr><th>🔢 ISBN / Code</th><td>${book.isbn || book.book_code}</td></tr>
                                <tr><th>💰 Price</th><td>₹${book.price || 0}</td></tr>
                                <tr><th>📦 Total Copies</th><td>${book.quantity || 0}</td></tr>
                                <tr><th>✅ Available</th><td>${book.available || 0}</td></tr>
                                <tr><th>📕 Issued</th><td>${book.issued || 0}</td></tr>
                            </tbody>
                        </table>
                    </div>
                `;
            }

            function displayNotFound(code) {
                bookDetails.innerHTML = `
                    <div class="alert alert-danger text-center">
                        ❌ No book found for barcode <strong>${code}</strong>.
                    </div>
                `;
            }

            function lookupBook() {
                const code = barcodeInput.value.trim();
                if (!code) {
                    alert("Please enter a barcode or ISBN.");
                    return;
                }

                fetch(`/barcode/book/data/${code}`)
                    .then(res => res.json())
                    .then(res => {
                        if (res.success) {
                            displayBook(res.book);
                        } else {
                            displayNotFound(code);
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        alert('Something went wrong. Try again!');
                    });
            }

            lookupBtn.addEventListener('click', lookupBook);

            // Lookup on Enter key
            barcodeInput.addEventListener('keyup', (e) => {
                if (e.key === 'Enter') {
                    lookupBook();
                }
            });

        });
    </script>

</body>
</html>
