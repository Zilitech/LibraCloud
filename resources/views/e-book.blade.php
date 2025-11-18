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
                     @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                </div>
                <div class="d-flex my-xl-auto right-content align-items-center">
                    <div class="pe-1 mb-xl-0">
                        <a href="#uploadEbookModal" data-bs-toggle="modal" class="btn btn-primary">
                            <i class="ri-add-line me-1"></i> Add E-Book
                        </a>
                          
                </div>
                    </div>
                 
                    <!-- Success / Error Messages -->
                
            </div>

            <!-- Info Alert -->
            <div class="alert alert-solid-secondary alert-dismissible fade show mb-4">
                Manage all library eBooks. Upload, preview, edit, or delete eBooks.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <!-- E-Book Table -->
    <!-- File Export Datatable -->

<!-- E-Book List Table -->
<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card shadow-sm mb-4">
            <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">E-Book List</h5>
                <small class="text-white-50">Manage E-Books</small>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="ebooks-table" class="table table-hover table-striped table-bordered text-nowrap w-100">
    <thead class="table-light">
        <tr>
            <th>E-Book ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>Category</th>
            <th>Upload Date</th>
            <th>Price</th>
            <th>Status</th>
            <th class="text-center">Actions</th>
        </tr>
    </thead>

    <tbody>
        @foreach($ebooks as $book)
        <tr>
            <td>{{ $book->id }}</td>

            <td>{{ $book->book_title }}</td>

            <td>{{ $book->author_name }}</td>

            <td>{{ $book->category_name }}</td>

            <td>{{ $book->created_at->format('Y-m-d') }}</td>

            <td>
                @if($book->price)
                    ₹{{ number_format($book->price, 2) }}
                @else
                    Free
                @endif
            </td>

            <td><span class="badge bg-success">Active</span></td>

            <td class="text-center">
                <!-- READ -->
                <a href="{{ asset('storage/' . $book->file_path) }}" 
                   class="btn btn-sm btn-info me-1"
                   target="_blank" title="Read E-Book">
                    <i class="ri-book-read-line"></i>
                </a>

                <!-- EDIT -->
<button class="btn btn-sm btn-warning me-1 editBookBtn"
    data-id="{{ $book->id }}"
    data-title="{{ $book->book_title }}"
    data-author="{{ $book->author_name }}"
    data-category="{{ $book->category_name }}"
    data-description="{{ $book->description }}"
    data-file="{{ $book->file_path }}"
    data-price="{{ $book->price }}"
    data-pages="{{ $book->total_pages }}"
    data-bs-toggle="modal" 
    data-bs-target="#ebookModal"
    title="Edit">
<i class="ri-pencil-line"></i>
</button>






                <!-- DELETE -->
<button class="btn btn-sm btn-danger me-1"
        data-bs-toggle="modal"
        data-bs-target="#deleteEbookModal{{ $book->id }}"
        title="Delete">
    <i class="ri-delete-bin-line"></i>
</button>


                <!-- DOWNLOAD -->
           <a href="{{ route('ebooks.download', $book->id) }}"
   class="btn btn-sm btn-primary"
   title="Download PDF">
    <i class="ri-download-line"></i>
</a>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteEbookModal{{ $book->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title">Delete E-Book</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <p>Are you sure you want to delete the e-book <strong>{{ $book->book_title }}</strong>?</p>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                <form action="{{ route('ebooks.destroy', $book->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                </form>
            </div>

        </div>
    </div>
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
                <!-- Success / Error Messages -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Validation Errors -->
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- E-Book Upload Form -->
                <form method="POST" action="{{ route('ebooks.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Book Title</label>
                            <input type="text" name="book_title" class="form-control" value="{{ old('book_title') }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Author</label>
                            <select name="author_name" class="form-select" required>
                                <option value="">Select author</option>
                                @foreach($authors as $author)
                                    <option value="{{ $author->author_name }}" {{ old('author_name') == $author->author_name ? 'selected' : '' }}>
                                        {{ $author->author_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Category</label>
                            <select name="category_name" class="form-select" required>
                                <option value="">Select category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->category_name }}" {{ old('category_name') == $category->category_name ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Upload PDF</label>
                            <input type="file" name="file_path" class="form-control" accept="application/pdf" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Total Pages</label>
                            <input type="number" name="total_pages" class="form-control" value="{{ old('total_pages') }}" placeholder="Optional">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Price</label>
                            <input type="text" name="price" class="form-control" value="{{ old('price') }}" placeholder="Optional">
                        </div>

                        <div class="col-12">
                            <label class="form-label">Description / Notes</label>
                            <textarea name="description" class="form-control" rows="3" placeholder="Optional">{{ old('description') }}</textarea>
                        </div>

                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-primary">Upload E-Book</button>
                        </div>
                    </div>
                </form>
                <!-- End Form -->
            </div>
        </div>
    </div>
</div>

<!-- Auto-open modal if errors exist -->
<script>
    @if ($errors->any() || session('error'))
        var uploadModal = new bootstrap.Modal(document.getElementById('uploadEbookModal'));
        uploadModal.show();
    @endif
</script>



<!-- DataTables JS -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>


<!-- Include CSS -->
<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" rel="stylesheet">

<!-- Include JS -->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

<script>
$(document).ready(function() {
    $('#file-export, #ebooks-table').DataTable({
        dom: 'Bfrtip', // This is required to show the buttons
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        responsive: true,
        pageLength: 10,
        lengthMenu: [5, 10, 25, 50, 100],
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search records..."
        }
    });
});
</script>

</body>
</html>
