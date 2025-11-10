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
                    <h5 class="page-title fs-21 mb-1">E-Books</h5>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Library</a></li>
                            <li class="breadcrumb-item active" aria-current="page">E-Books</li>
                        </ol>
                    </nav>
                </div>
                <div class="d-flex my-xl-auto right-content align-items-center">
                    <div class="pe-1 mb-xl-0">
                        <a href="#uploadEbookModal" data-bs-toggle="modal" class="btn btn-primary">
                            <i class="ri-add-line me-1"></i> Add E-Book
                        </a>
                    </div>
                </div>
            </div>

            <!-- Info Alert -->
            <div class="alert alert-solid-secondary alert-dismissible fade show mb-4">
                Manage all library eBooks. Upload, preview, edit, or delete eBooks.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <!-- E-Book Table -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">E-Book List</div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="ebooks-table" class="table table-bordered text-nowrap w-100">
                                    <thead class="table-light">
                                        <tr>
                                            <th>E-Book ID</th>
                                            <th>Title</th>
                                            <th>Author</th>
                                            <th>Category</th>
                                            <th>Upload Date</th>
                                            <th>File Size</th>
                                            <th>Status</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>EB-001</td>
                                            <td>Data Structures in C</td>
                                            <td>Mary Smith</td>
                                            <td>Computer Science</td>
                                            <td>2025-11-10</td>
                                            <td>2.1 MB</td>
                                            <td><span class="badge bg-success">Active</span></td>
                                            <td class="text-center">
    <a href="{{ url('e-book_reader') }}" class="btn btn-sm btn-info me-1" title="Read">
        <i class="ri-book-read-line"></i>
    </a>
    <a href="{{ url('e-book') }}" class="btn btn-sm btn-warning me-1" title="Edit">
        <i class="ri-pencil-line"></i>
    </a>
    <a href="{{ url('e-book/delete/EB-001') }}" class="btn btn-sm btn-danger me-1" title="Delete">
        <i class="ri-delete-bin-line"></i>
    </a>                        
                                                <button class="btn btn-sm btn-primary"><i class="ri-download-line"></i></button>
                                            </td>
                                            
                                        </tr>
                                        <!-- Add more rows dynamically -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @include('footer')
</div>

<!-- Upload E-Book Modal -->
<div class="modal fade" id="uploadEbookModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload New E-Book</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Book Title</label>
                            <input type="text" class="form-control" placeholder="Enter book title">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Author</label>
                            <input type="text" class="form-control" placeholder="Enter author name">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Category</label>
                            <select class="form-select">
                                <option value="">Select category</option>
                                <option>Science</option>
                                <option>Commerce</option>
                                <option>Literature</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Upload PDF</label>
                            <input type="file" class="form-control" accept="application/pdf">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Total Pages</label>
                            <input type="number" class="form-control" placeholder="Optional">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Price</label>
                            <input type="text" class="form-control" placeholder="Optional">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Description / Notes</label>
                            <textarea class="form-control" rows="3" placeholder="Optional notes about the eBook"></textarea>
                        </div>
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-primary">Upload E-Book</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- DataTables JS -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function() {
    $('#ebooks-table').DataTable({
        pageLength: 10,
        responsive: true
    });
});
</script>
</body>
</html>
