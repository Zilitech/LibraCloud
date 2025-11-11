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

        <div class="main-content app-content">
            <div class="container-fluid py-4">

            

                <!-- Page Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <!-- <h4 class="page-title mb-0">📷 Scan Book Barcode</h4> -->
                                              <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                <div class="my-auto">
                    <h5 class="page-title fs-21 mb-1">Scan Book Barcode</h5>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Barcode Management</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Scan Book Barcode</li>
                        </ol>
                    </nav>
                </div>
            </div>
                    <a href="{{ url('all_books') }}" class="btn btn-secondary"><i class="ri-arrow-left-line"></i> Back to Books</a>
                </div>

                <!-- Info Alert -->
                <div class="alert alert-info">
                    Scan a barcode using a scanner or your webcam. The book details will appear automatically.
                </div>

                <div class="row">

                    <!-- Scanner & Input -->
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">Scan Barcode</h5>
                            </div>
                            <div class="card-body">

                                <!-- Manual input with submit button -->
                                <div class="input-group mb-3">
                                    <input type="text" id="barcodeInput" class="form-control form-control-lg" placeholder="Scan or enter barcode" autofocus>
                                    <button class="btn btn-success" id="submitBarcode"><i class="ri-check-line"></i> Scan</button>
                                </div>
                                <small class="text-muted d-block mb-3">Use a barcode scanner, mobile camera, or type manually.</small>

                                <!-- Webcam Scanner -->
                                <div id="scannerContainer" style="display:none;">
                                    <video id="scannerPreview" width="100%" height="250" style="border:1px solid #ccc;"></video>
                                    <button class="btn btn-danger mt-2" id="stopScanner"><i class="ri-close-line"></i> Stop Scanner</button>
                                </div>
                                <button class="btn btn-primary mt-2" id="startScanner"><i class="ri-camera-line"></i> Use Webcam Scanner</button>

                            </div>
                        </div>
                    </div>

                    <!-- Book Details -->
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-header bg-info text-white">
                                <h5 class="mb-0">Book Details</h5>
                            </div>
                            <div class="card-body">

                                <!-- Book Cover -->
                                <div class="text-center mb-3">
                                    <img id="bookCover" src="{{ asset('images/media/default_book.png') }}" alt="Book Cover" class="img-fluid" style="max-height:200px;">
                                </div>

                                <!-- Book Info Table -->
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr><th>Title</th><td id="bookTitle">-</td></tr>
                                        <tr><th>Author</th><td id="bookAuthor">-</td></tr>
                                        <tr><th>Category</th><td id="bookCategory">-</td></tr>
                                        <tr><th>Total Copies</th><td id="bookTotal">-</td></tr>
                                        <tr><th>Available</th><td id="bookAvailable">-</td></tr>
                                        <tr><th>Issued</th><td id="bookIssued">-</td></tr>
                                        <tr><th>Price</th><td id="bookPrice">-</td></tr>
                                        <tr><th>ISBN / Code</th><td id="bookCode">-</td></tr>
                                        <tr><th>Status</th><td><span id="bookStatus" class="badge bg-secondary">-</span></td></tr>
                                    </tbody>
                                </table>

                                <!-- Action Buttons -->
                                <div id="bookActions" class="mt-3" style="display:none;">
                                    <button class="btn btn-success me-2" id="issueBook"><i class="ri-login-box-line"></i> Issue Book</button>
                                    <button class="btn btn-warning" id="returnBook"><i class="ri-refresh-line"></i> Return Book</button>
                                </div>

                                <div id="notFound" class="text-danger mt-2" style="display:none;">Book not found!</div>
                            </div>
                        </div>

                        <!-- Recent Scans -->
                        <div class="card shadow-sm mt-3">
                            <div class="card-header bg-dark text-white">
                                <h5 class="mb-0">Recent Scans</h5>
                            </div>
                            <div class="card-body">
                                <ul id="recentScans" class="list-group list-group-flush"></ul>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        @include('footer')
    </div>

    @include('foot')

    <!-- ZXing Barcode Library -->
    <script src="https://unpkg.com/@zxing/library@latest"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const barcodeInput = document.getElementById('barcodeInput');
        const submitBtn = document.getElementById('submitBarcode');
        const startScannerBtn = document.getElementById('startScanner');
        const stopScannerBtn = document.getElementById('stopScanner');
        const scannerContainer = document.getElementById('scannerContainer');
        const videoElement = document.getElementById('scannerPreview');
        const recentScans = document.getElementById('recentScans');

        let codeReader;

        function updateBookDetails(data) {
            document.getElementById('bookTitle').innerText = data.title;
            document.getElementById('bookAuthor').innerText = data.author;
            document.getElementById('bookCategory').innerText = data.category;
            document.getElementById('bookTotal').innerText = data.total_copies;
            document.getElementById('bookAvailable').innerText = data.available;
            document.getElementById('bookIssued').innerText = data.issued;
            document.getElementById('bookPrice').innerText = '₹' + data.price;
            document.getElementById('bookCode').innerText = data.code;
            document.getElementById('bookCover').src = data.cover || '{{ asset("images/media/default_book.png") }}';

            const statusBadge = document.getElementById('bookStatus');
            if(data.available == 0) {
                statusBadge.innerText = 'Out of Stock';
                statusBadge.className = 'badge bg-danger';
            } else if(data.available < 5) {
                statusBadge.innerText = 'Low Stock';
                statusBadge.className = 'badge bg-warning';
            } else {
                statusBadge.innerText = 'Available';
                statusBadge.className = 'badge bg-success';
            }

            document.getElementById('notFound').style.display = 'none';
            document.getElementById('bookActions').style.display = 'block';

            const li = document.createElement('li');
            li.className = 'list-group-item';
            li.innerText = `${data.title} (${data.code})`;
            recentScans.prepend(li);
            if(recentScans.childElementCount > 5) recentScans.removeChild(recentScans.lastChild);
        }

        function clearBookDetails() {
            ['bookTitle','bookAuthor','bookCategory','bookTotal','bookAvailable','bookIssued','bookPrice','bookCode'].forEach(id=>{
                document.getElementById(id).innerText = '-';
            });
            document.getElementById('bookCover').src = '{{ asset("images/media/default_book.png") }}';
            document.getElementById('bookStatus').innerText = '-';
            document.getElementById('bookStatus').className = 'badge bg-secondary';
            document.getElementById('bookActions').style.display = 'none';
            document.getElementById('notFound').style.display = 'block';
        }

        function fetchBook(barcode) {
            fetch(`/books/barcode/${barcode}`)
                .then(res => res.json())
                .then(data => {
                    if(data.success) updateBookDetails(data.book);
                    else clearBookDetails();
                });
        }

        // Manual Scan
        submitBtn.addEventListener('click', ()=>fetchBook(barcodeInput.value.trim()));
        barcodeInput.addEventListener('keypress', e=>{ if(e.key==='Enter') fetchBook(barcodeInput.value.trim()); });

        // Webcam Scanner
        startScannerBtn.addEventListener('click', ()=>{
            scannerContainer.style.display = 'block';
            codeReader = new ZXing.BrowserBarcodeReader();
            codeReader.decodeFromVideoDevice(null, videoElement, (result, err)=>{
                if(result) {
                    fetchBook(result.text);
                    codeReader.reset();
                    scannerContainer.style.display = 'none';
                }
            });
        });

        stopScannerBtn.addEventListener('click', ()=>{
            if(codeReader) codeReader.reset();
            scannerContainer.style.display = 'none';
        });
    });
    </script>
</body>
</html>
