@include('head')
<meta name="csrf-token" content="{{ csrf_token() }}">


<body>
@include('switcher')
<div class="page">
    @include('header')
    @include('nav_sidebar')

    <div class="main-content app-content">
        <div class="container-fluid py-4">

            <!-- Page Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
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

            <div class="alert alert-info">
                Scan a barcode using a scanner or your webcam. The book details will appear automatically.
            </div>

            <div class="row">

                <!-- Scanner Input -->
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Scan Barcode</h5>
                        </div>
                        <div class="card-body">
                            <div class="input-group mb-3">
                                <input type="text" id="barcodeInput" class="form-control form-control-lg" placeholder="Scan or enter barcode" autofocus>
                                <button class="btn btn-success" id="submitBarcode"><i class="ri-check-line"></i> Scan</button>
                            </div>
                            <small class="text-muted d-block mb-3">Use a barcode scanner, mobile camera, or type manually.</small>

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
                            <div class="text-center mb-3">
                                <img id="bookCover" src="{{ asset('images/media/default_book.png') }}" alt="Book Cover" class="img-fluid" style="max-height:200px;">
                            </div>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr><th>Title</th><td id="bookTitle">-</td></tr>
                                    <tr><th>Author</th><td id="bookAuthor">-</td></tr>
                                    <tr><th>Category</th><td id="bookCategory">-</td></tr>
                                    <tr><th>Total Copies</th><td id="bookTotal">-</td></tr>
                                    <tr><th>Available</th><td id="bookAvailable">-</td></tr>
                                    <tr><th>Issued</th><td id="bookIssued">-</td></tr>
                                    <tr><th>Price</th><td id="bookPrice">-</td></tr>
                                    <tr><th>ISBN / Code</th><td id="isbn">-</td></tr>
                                    <tr><th>Status</th><td><span id="bookStatus" class="badge bg-secondary">-</span></td></tr>
                                </tbody>
                            </table>

                            <div id="bookActions" class="mt-3" style="display:none;">
<button class="btn btn-success me-2" id="issueBook">
    <i class="ri-login-box-line"></i> Issue Book
</button>

<!-- Issue Book Modal -->
<div class="modal fade" id="issueBookModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Issue Book</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <form id="issueBookForm">

            <input type="hidden" id="book_name" name="book_name">
            <input type="hidden" id="book_isbn" name="book_isbn">
            <input type="hidden" id="author_name" name="author_name">

            <div class="mb-3">
                <label class="form-label">Member Name</label>
                <input type="text" class="form-control" name="member_name" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Issue Date</label>
                <input type="date" class="form-control" name="issue_date" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Due Date</label>
                <input type="date" class="form-control" name="due_date" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Quantity</label>
                <input type="number" class="form-control" name="quantity" required min="1">
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-control">
                     <option value="Issued">Issued</option>
                     <option value="Pending">Pending</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Remarks</label>
                <textarea name="remarks" class="form-control"></textarea>
            </div>
        <button type="button" class="btn btn-primary" id="saveIssue">Issue</button>


        </form>
      </div>

     

    </div>
  </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {

    // Open Modal and Fill Book Data
    const issueBookBtn = document.getElementById('issueBook');
    issueBookBtn.addEventListener('click', function () {
        document.getElementById('book_name').value = document.getElementById('bookTitle').innerText;
        document.getElementById('book_isbn').value = document.getElementById('isbn').innerText;
        document.getElementById('author_name').value = document.getElementById('bookAuthor').innerText;

        var myModal = new bootstrap.Modal(document.getElementById('issueBookModal'));
        myModal.show();
    });

    // Submit Issue Book Form via AJAX
 document.getElementById('saveIssue').addEventListener('click', function(e) {
    e.preventDefault(); // prevent default form submission

    let form = document.getElementById('issueBookForm');
    let formData = new FormData(form);

    // If issue_id is not in the form, generate it dynamically
    if(!formData.get('issue_id')) {
        let issueId = 'ISS' + Math.random().toString(36).substring(2, 8).toUpperCase();
        formData.append('issue_id', issueId);
    }

    fetch("{{ route('issue-book.store') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document.querySelector("meta[name='csrf-token']").content
        },
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if(data.status === 'success') {
            alert(data.message); // Success message
            var modalEl = document.getElementById('issueBookModal');
            var modal = bootstrap.Modal.getInstance(modalEl);
            modal.hide(); // Close the modal
            form.reset(); // Reset form fields
            location.reload(); // Reload page or update UI dynamically
        } else {
            // Show Laravel validation errors
            let messages = data.errors ? Object.values(data.errors).flat().join("\n") : data.message;
            alert(messages);
        }
    })
    .catch(err => {
        console.error(err);
        alert("Something went wrong. Please try again.");
    });
});


});
</script>





<button class="btn btn-warning" id="returnBook">
    <i class="ri-refresh-line"></i> Return Book
</button>

<div id="tableContainer" class="mt-4" style="display: none;">
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Issue ID</th>
                <th>Member Name</th>
                <th>Issue Date</th>
                <th>Due Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="tableBody"></tbody>
    </table>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {

    // ================================
    // 1️⃣ Load issued books by ISBN
    // ================================
    $('#returnBook').click(function() {

        var isbn = $('#isbn').text().trim();

        if (!isbn || isbn === '-') {
            alert("No book selected! Please scan a book first.");
            return;
        }

        $.ajax({
            url: "{{ route('get.issued.books') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                isbn: isbn
            },
            success: function(data) {

                let html = '';
                data.forEach(book => {
                    html += `
                        <tr>
                            <td>${book.issue_id}</td>
                            <td>${book.member_name}</td>
                            <td>${book.issue_date}</td>
                            <td>${book.due_date}</td>
                            <td>
                                <a href="/issue-book/return/${book.id}" 
                                   class="btn btn-sm btn-warning"
                                   onclick="return confirm('Are you sure you want to return this book?')">
                                    <i class="ri-refresh-line"></i> Return
                                </a>
                            </td>
                        </tr>
                    `;
                });

                $('#tableBody').html(html);
                $('#tableContainer').show();
            },

            error: function() {
                $('#tableBody').html('<tr><td colspan="5" class="text-center">No record found!</td></tr>');
                $('#tableContainer').show();
            }
        });

    });

});
</script>







                            <div id="notFound" class="text-danger mt-2" style="display:none;">Book not found!</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('footer')
</div>
@include('foot')

<script src="https://unpkg.com/@zxing/library@latest"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const barcodeInput = document.getElementById('barcodeInput');
    const submitBtn = document.getElementById('submitBarcode');
    const startScannerBtn = document.getElementById('startScanner');
    const stopScannerBtn = document.getElementById('stopScanner');
    const scannerContainer = document.getElementById('scannerContainer');
    const videoElement = document.getElementById('scannerPreview');

    let codeReader;

    function updateBookDetails(data) {
        document.getElementById('bookTitle').innerText = data.title;
        document.getElementById('bookAuthor').innerText = data.author;
        document.getElementById('bookCategory').innerText = data.category;
        document.getElementById('bookTotal').innerText = data.total_copies;
        document.getElementById('bookAvailable').innerText = data.available;
        document.getElementById('bookIssued').innerText = data.issued;
        document.getElementById('bookPrice').innerText = '₹' + data.price;
        document.getElementById('isbn').innerText = data.isbn;
        document.getElementById('bookCover').src = data.cover;

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
    }

    function clearBookDetails() {
        ['bookTitle','bookAuthor','bookCategory','bookTotal','bookAvailable','bookIssued','bookPrice','isbn'].forEach(id=>{
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
            })
            .catch(err => clearBookDetails());
    }

    submitBtn.addEventListener('click', ()=>fetchBook(barcodeInput.value.trim()));
    barcodeInput.addEventListener('keypress', e=>{ if(e.key==='Enter') fetchBook(barcodeInput.value.trim()); });

    startScannerBtn.addEventListener('click', ()=>{
        scannerContainer.style.display = 'block';
        codeReader = new ZXing.BrowserBarcodeReader();
        codeReader.decodeFromVideoDevice(null, videoElement, (result, err)=>{
            if(result){
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
