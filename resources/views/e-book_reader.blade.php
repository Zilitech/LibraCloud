@include('head')

<body>
@include('switcher')
<div class="page">
    @include('header')
    @include('nav_sidebar')

    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                <div class="my-auto">
                    <h5 class="page-title fs-21 mb-1">E-Book Reader</h5>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Library</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Read E-Book</li>
                        </ol>
                    </nav>
                </div>
                <div class="d-flex my-xl-auto right-content align-items-center">
                    <a href="{{ url('e-book') }}" class="btn btn-secondary">
                        <i class="ri-arrow-left-line me-1"></i> Back to E-Books
                    </a>
                </div>
            </div>

            <!-- Reader Card -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Reading: Data Structures in C</h5>
                        </div>
                        <div class="card-body">
                            <!-- PDF Toolbar -->
                            <div class="d-flex justify-content-between mb-2">
                                <div>
                                    <button id="prevPage" class="btn btn-primary btn-sm">Prev</button>
                                    <button id="nextPage" class="btn btn-primary btn-sm">Next</button>
                                </div>
                                <div>
                                    <span>Page: <span id="pageNum">1</span> / <span id="pageCount">--</span></span>
                                </div>
                                <div>
                                    <input type="number" id="goToPage" class="form-control form-control-sm" placeholder="Go to page" style="width: 100px; display:inline-block;">
                                    <button id="gotoBtn" class="btn btn-secondary btn-sm">Go</button>
                                </div>
                            </div>

                            <!-- PDF Canvas -->
                            <canvas id="pdf-render" class="w-100 border" style="height:600px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @include('footer')
</div>

<!-- Scroll To Top -->
<div class="scrollToTop">
    <span class="arrow"><i class="las la-angle-double-up"></i></span>
</div>
<div id="responsive-overlay"></div>

<!-- JS Files -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- PDF.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.6.172/pdf.min.js"></script>

<script>
const url = '/path/to/ebooks/data_structures_c.pdf'; // Replace with dynamic PDF path

let pdfDoc = null,
    pageNum = 1,
    pageRendering = false,
    pageNumPending = null,
    scale = 1.5,
    canvas = document.getElementById('pdf-render'),
    ctx = canvas.getContext('2d');

// Render page
function renderPage(num) {
    pageRendering = true;
    pdfDoc.getPage(num).then(function(page) {
        const viewport = page.getViewport({ scale: scale });
        canvas.height = viewport.height;
        canvas.width = viewport.width;

        const renderCtx = {
            canvasContext: ctx,
            viewport: viewport
        };
        const renderTask = page.render(renderCtx);
        renderTask.promise.then(function() {
            pageRendering = false;
            if (pageNumPending !== null) {
                renderPage(pageNumPending);
                pageNumPending = null;
            }
        });
    });

    document.getElementById('pageNum').textContent = num;
}

// Queue render page
function queueRenderPage(num) {
    if (pageRendering) {
        pageNumPending = num;
    } else {
        renderPage(num);
    }
}

// Previous page
document.getElementById('prevPage').addEventListener('click', () => {
    if (pageNum <= 1) return;
    pageNum--;
    queueRenderPage(pageNum);
});

// Next page
document.getElementById('nextPage').addEventListener('click', () => {
    if (pageNum >= pdfDoc.numPages) return;
    pageNum++;
    queueRenderPage(pageNum);
});

// Go to page
document.getElementById('gotoBtn').addEventListener('click', () => {
    let goTo = parseInt(document.getElementById('goToPage').value);
    if (goTo >= 1 && goTo <= pdfDoc.numPages) {
        pageNum = goTo;
        queueRenderPage(pageNum);
    }
});

// Load PDF
pdfjsLib.getDocument(url).promise.then(function(pdfDoc_) {
    pdfDoc = pdfDoc_;
    document.getElementById('pageCount').textContent = pdfDoc.numPages;
    renderPage(pageNum);
});
</script>
</body>
</html>
