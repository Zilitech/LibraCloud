@include('head')

<body>
@include('switcher')

<div id="loader"><img src="{{ asset('images/media/loader.svg') }}"></div>

<div class="page">
@include('header')
@include('nav_sidebar')

<div class="main-content app-content">
    <div class="container-fluid py-4">

        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="my-auto">
                <h5 class="page-title fs-21 mb-1">Generate Book Barcode</h5>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">Barcode Management</li>
                    <li class="breadcrumb-item active">Generate Book Barcode</li>
                </ol>
            </div>
        </div>

        <div class="alert alert-info">
            Select a book and generate barcode labels for printing.
        </div>

        <div class="row">
            <!-- Select Book Panel -->
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5>Select Book</h5>
                    </div>
                    <div class="card-body">

                        <!-- Book Dropdown -->
                        <label class="form-label">Choose Book</label>
                        <select id="bookSelect" class="form-select">
                            <option value="">-- Select a Book --</option>
                            @foreach($books as $book)
                                <option value="{{ $book->id }}">
                                    {{ $book->book_title }} ({{ $book->isbn }})
                                </option>
                            @endforeach
                        </select>

                        <!-- Quantity -->
                        <label class="form-label mt-3">Number of Labels</label>
                        <input type="number" id="barcodeQty" class="form-control" value="1" min="1">

                        <button class="btn btn-success mt-3" id="generateBarcode">
                            <i class="ri-barcode-line"></i> Generate Barcode
                        </button>

                        <!-- Generate All Button -->
                        <button class="btn btn-warning mt-2" id="generateAllBtn">
                            <i class="ri-barcode-line"></i> Generate All
                        </button>

                    </div>
                </div>
            </div>

            <!-- Barcode Preview -->
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-info text-white">
                        <h5>Barcode Preview</h5>
                    </div>
                    <div class="card-body" id="barcodePreview" style="min-height:250px;text-align:center;">
                        <p>Select a book and click Generate</p>
                    </div>
                    <div class="text-center mt-3">
                        <button class="btn btn-primary" id="printBarcode">
                            <i class="ri-printer-line"></i> Print Barcodes
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@include('footer')
</div>
@include('foot')

<!-- Generate All Modal -->
<div class="modal fade" id="generateAllModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Select Books to Generate Barcode</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="allBooksList" style="max-height:400px;overflow-y:auto;">
        <!-- Book list will be injected here via JS -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="generateSelectedBooks">
            <i class="ri-barcode-line"></i> Generate
        </button>
      </div>
    </div>
  </div>
</div>

<!-- JsBarcode -->
<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const bookSelect = document.getElementById('bookSelect');
    const qtyInput = document.getElementById('barcodeQty');
    const preview = document.getElementById('barcodePreview');

    // Generate Barcode Button
    document.getElementById('generateBarcode').addEventListener('click', function () {

        const bookId = bookSelect.value;
        const qty = parseInt(qtyInput.value);

        if (!bookId || qty <= 0) {
            alert('Choose book & enter valid quantity');
            return;
        }

        fetch(`/barcode/book/data?id=${bookId}`)
            .then(res => res.json())
            .then(book => {
                preview.innerHTML = ""; // Clear previous

                for (let i = 0; i < qty; i++) {
                    const card = document.createElement('div');
                    card.style.width = "420px";
                    card.style.border = "1px solid #222";
                    card.style.padding = "12px";
                    card.style.borderRadius = "6px";
                    card.style.margin = "10px auto";
                    card.style.background = "#fff";
                    card.style.fontSize = "13px";
                    card.style.textAlign = "left";

                    card.innerHTML += `<div style="font-size:17px;font-weight:bold;margin-bottom:6px;">
                        ${book.book_title}
                    </div>`;

                    card.innerHTML += `
                        <table style="width:100%;font-size:13px;">
                            <tr><td>Author</td><td>: ${book.author_name}</td></tr>
                            <tr><td>Category</td><td>: ${book.category_name}</td></tr>
                            <tr><td>Available</td><td>: ${book.quantity}</td></tr>
                            <tr><td>Price</td><td>: ₹${book.price}</td></tr>
                            <tr><td>ISBN / Code</td><td>: ${book.isbn}</td></tr>
                        </table>
                    `;

                    const svg = document.createElementNS("http://www.w3.org/2000/svg", "svg");
                    svg.style.marginTop = "15px";
                    svg.style.width = "100%";
                    JsBarcode(svg, book.isbn, { format: "CODE128", displayValue: false, height: 60 });
                    card.appendChild(svg);

                    const valueDiv = document.createElement('div');
                    valueDiv.style.textAlign = "center";
                    valueDiv.style.marginTop = "4px";
                    valueDiv.style.letterSpacing = "2px";
                    valueDiv.innerText = book.isbn;
                    card.appendChild(valueDiv);

                    preview.appendChild(card);
                }

            });

    });

    // Print Barcode Stickers
    document.getElementById('printBarcode').addEventListener('click', () => {
        const printContent = preview.innerHTML;
        const original = document.body.innerHTML;
        document.body.innerHTML = printContent;
        window.print();
        document.body.innerHTML = original;
        location.reload();
    });

    // Generate All Modal
    const generateAllBtn = document.getElementById('generateAllBtn');
    const allBooksList = document.getElementById('allBooksList');

    generateAllBtn.addEventListener('click', () => {
        allBooksList.innerHTML = '';
        @json($books).forEach(book => {
            const div = document.createElement('div');
            div.style.marginBottom = "8px";
            div.innerHTML = `
                <input type="checkbox" class="book-checkbox" value="${book.id}" id="book_${book.id}">
                <label for="book_${book.id}" style="margin-left:5px;">
                    ${book.book_title} (${book.isbn}) - ${book.author_name || 'N/A'}
                </label>
            `;
            allBooksList.appendChild(div);
        });

        const modal = new bootstrap.Modal(document.getElementById('generateAllModal'));
        modal.show();
    });

    // Generate selected books from modal
    document.getElementById('generateSelectedBooks').addEventListener('click', () => {
        const selected = Array.from(document.querySelectorAll('.book-checkbox:checked')).map(cb => cb.value);

        if (selected.length === 0) {
            alert('Select at least one book');
            return;
        }

        preview.innerHTML = '';

        selected.forEach(bookId => {
            fetch(`/barcode/book/data?id=${bookId}`)
                .then(res => res.json())
                .then(book => {
                    const card = document.createElement('div');
                    card.style.width = "420px";
                    card.style.border = "1px solid #222";
                    card.style.padding = "12px";
                    card.style.borderRadius = "6px";
                    card.style.margin = "10px auto";
                    card.style.background = "#fff";
                    card.style.fontSize = "13px";
                    card.style.textAlign = "left";

                    card.innerHTML += `<div style="font-size:17px;font-weight:bold;margin-bottom:6px;">
                            ${book.book_title}
                        </div>
                        <table style="width:100%;font-size:13px;">
                            <tr><td>Author</td><td>: ${book.author_name}</td></tr>
                            <tr><td>Category</td><td>: ${book.category_name}</td></tr>
                            <tr><td>Available</td><td>: ${book.quantity}</td></tr>
                            <tr><td>Price</td><td>: ₹${book.price}</td></tr>
                            <tr><td>ISBN / Code</td><td>: ${book.isbn}</td></tr>
                        </table>
                    `;

                    const svg = document.createElementNS("http://www.w3.org/2000/svg", "svg");
                    svg.style.marginTop = "15px";
                    svg.style.width = "100%";
                    JsBarcode(svg, book.isbn, { format: "CODE128", displayValue: false, height: 60 });
                    card.appendChild(svg);

                    const valueDiv = document.createElement('div');
                    valueDiv.style.textAlign = "center";
                    valueDiv.style.marginTop = "4px";
                    valueDiv.style.letterSpacing = "2px";
                    valueDiv.innerText = book.isbn;
                    card.appendChild(valueDiv);

                    preview.appendChild(card);
                });
        });

        const modalEl = document.getElementById('generateAllModal');
        const modal = bootstrap.Modal.getInstance(modalEl);
        modal.hide();
    });

});
</script>

</body>
</html>
