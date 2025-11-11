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
                    <h5 class="page-title fs-21 mb-1">Generate Book Barcode</h5>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Barcode Management</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Generate Book Barcode</li>
                        </ol>
                    </nav>
                </div>
            </div>
                    <a href="#" class="btn btn-secondary"><i class="ri-arrow-left-line"></i> Back to Books</a>
                </div>

                <!-- Alert -->
                <div class="alert alert-info">
                    Select a book and generate barcode labels for printing.
                </div>

                <div class="row">
                    <!-- Select Book & Generate -->
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">Select Book</h5>
                            </div>
                            <div class="card-body">

                                <!-- Book Selection -->
                                <div class="mb-3">
                                    <label for="bookSelect" class="form-label">Choose Book</label>
                                    <select id="bookSelect" class="form-select">
                                        <option value="">-- Select a Book --</option>
                                        <option value="CHM101" data-title="Organic Chemistry Vol. 2">Organic Chemistry Vol. 2 (CHM101)</option>
                                        <option value="PHY201" data-title="Physics Fundamentals">Physics Fundamentals (PHY201)</option>
                                        <option value="MTH301" data-title="Advanced Mathematics">Advanced Mathematics (MTH301)</option>
                                        <option value="LIT120" data-title="Modern English Literature">Modern English Literature (LIT120)</option>
                                        <option value="CSC210" data-title="Introduction to Programming">Introduction to Programming (CSC210)</option>
                                    </select>
                                </div>

                                <!-- Quantity -->
                                <div class="mb-3">
                                    <label for="barcodeQty" class="form-label">Number of Labels</label>
                                    <input type="number" id="barcodeQty" class="form-control" min="1" value="1">
                                </div>

                                <button class="btn btn-success" id="generateBarcode">
                                    <i class="ri-barcode-line"></i> Generate Barcode
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Barcode Preview -->
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-header bg-info text-white">
                                <h5 class="mb-0">Barcode Preview</h5>
                            </div>
                            <div class="card-body" id="barcodePreview" style="min-height:250px; text-align:center;">
                                <p>Select a book and click Generate</p>
                            </div>
                            <div class="text-center mt-3">
                                <button class="btn btn-primary" id="printBarcode"><i class="ri-printer-line"></i> Print Barcodes</button>
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

    <!-- Barcode Generation Script -->
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const generateBtn = document.getElementById('generateBarcode');
            const bookSelect = document.getElementById('bookSelect');
            const qtyInput = document.getElementById('barcodeQty');
            const preview = document.getElementById('barcodePreview');
            const printBtn = document.getElementById('printBarcode');

            generateBtn.addEventListener('click', () => {
                const bookCode = bookSelect.value;
                const bookTitle = bookSelect.options[bookSelect.selectedIndex].dataset.title;
                const qty = parseInt(qtyInput.value);

                if(!bookCode || qty <= 0) {
                    alert('Please select a book and enter a valid quantity.');
                    return;
                }

                // Clear previous preview
                preview.innerHTML = '';

                // Generate multiple barcodes
                for(let i=0; i<qty; i++){
                    const div = document.createElement('div');
                    div.style.margin = "10px";
                    div.style.display = "inline-block";
                    div.style.textAlign = "center";
                    div.style.border = "1px solid #ccc";
                    div.style.padding = "10px";
                    div.style.borderRadius = "8px";
                    div.style.background = "#f8f9fa";

                    const svg = document.createElementNS("http://www.w3.org/2000/svg", "svg");
                    JsBarcode(svg, bookCode, {
                        format: "CODE128",
                        displayValue: true,
                        fontSize: 14,
                        height: 60
                    });

                    const titleDiv = document.createElement('div');
                    titleDiv.style.marginTop = "5px";
                    titleDiv.style.fontWeight = "500";
                    titleDiv.innerText = bookTitle;

                    div.appendChild(svg);
                    div.appendChild(titleDiv);
                    preview.appendChild(div);
                }
            });

            // Print Functionality
            printBtn.addEventListener('click', () => {
                const printContent = preview.innerHTML;
                const originalContent = document.body.innerHTML;

                document.body.innerHTML = printContent;
                window.print();
                document.body.innerHTML = originalContent;
                location.reload();
            });
        });
    </script>

</body>
</html>
