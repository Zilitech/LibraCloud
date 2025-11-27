                @include('head')
                <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
 <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">


<body>

   @include('switcher')

    <!-- Loader -->
    <div id="loader" >
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

            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                    <div class="my-auto">
                        <h5 class="page-title fs-21 mb-1">Data Tables</h5>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Data Tables</li>
                            </ol>
                        </nav>
                    </div>
    
                    <div class="d-flex my-xl-auto right-content align-items-center">
                        <div class="pe-1 mb-xl-0">
                            <button type="button" class="btn btn-info btn-icon me-2 btn-b"><i class="mdi mdi-filter-variant"></i></button>
                        </div>
                        <div class="pe-1 mb-xl-0">
                            <button type="button" class="btn btn-danger btn-icon me-2"><i class="mdi mdi-star"></i></button>
                        </div>
                        <div class="pe-1 mb-xl-0">
                            <button type="button" class="btn btn-warning  btn-icon me-2"><i class="mdi mdi-refresh"></i></button>
                        </div>
                        <div class="mb-xl-0">
                            <!-- Import Books Dropdown -->
<div class="dropdown">
    <button class="btn btn-success dropdown-toggle" type="button" id="importDropdown" data-bs-toggle="dropdown" aria-expanded="false">
        Import Books
    </button>
    <ul class="dropdown-menu p-3" aria-labelledby="importDropdown">
        <li>
            <form action="{{ route('books.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-2">
                    <input type="file" name="import_file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Upload</button>
            </form>
        </li>
    </ul>
</div>

                        </div>
                    </div>
                </div>
                <!-- Page Header Close -->

                <div class="alert alert-solid-secondary alert-dismissible fs-15 fade show mb-4">
                    All Books <strong class="text-fixed-black">Data</strong> only in this page by using <strong class="text-fixed-black">jquery</strong> cdn link.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="bi bi-x"></i></button>
                </div>


  
                <!-- Start:: row-4 -->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card custom-card">
                            <div class="card-header">
                                <div class="card-title">All Books Data</div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="file-export" class="table table-bordered text-nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th>Book Name</th>
                                                <th>Code</th>
                                                <th>Category</th>
                                                <th>Author</th>
                                                <th>Available</th>
                                                <th>Price</th>
                                                                        <th class="text-center">Action</th>

                                                
                                            </tr>
                                        </thead>
                                       <tbody>
    @forelse($books as $book)
        <tr>
            <td>{{ $book->book_title }}</td>
            <td>{{ $book->book_code ?? '-' }}</td>
            <td>{{ $book->category_name ?? 'N/A' }}</td>
            <td>{{ $book->author_name ?? 'N/A' }}</td>
            <td>{{ $book->quantity }}</td>
            <td>{{ $book->price ? '₹'.$book->price : '-' }}</td>
        <td class="text-center">
    <!-- Edit Icon -->
<a href="javascript:void(0);" class="me-2 text-info" data-bs-toggle="modal" data-bs-target="#editBookModal-{{ $book->id }}" title="Edit">
    <i class="ri-edit-line fs-16"></i>
</a>

<!-- Edit Book Modal -->
<div class="modal fade" id="editBookModal-{{ $book->id }}" tabindex="-1"
     aria-labelledby="editBookModalLabel-{{ $book->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="editBookModalLabel-{{ $book->id }}">Edit Book</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row g-3">

                            <!-- Book ID -->
                            <div class="col-md-6 d-flex align-items-center">
                                <label class="form-label me-2" style="width:120px;">Book ID:</label>
                                <input type="text" class="form-control" value="{{ $book->id }}" readonly>
                            </div>

                            <!-- Book Title -->
                            <div class="col-md-6 d-flex align-items-center">
                                <label class="form-label me-2" style="width:120px;">Title:</label>
                                <input type="text" name="book_title" class="form-control"
                                       value="{{ $book->book_title }}" required>
                            </div>

                            <!-- Book Code -->
                            <div class="col-md-6 d-flex align-items-center">
                                <label class="form-label me-2" style="width:120px;">Book Code:</label>
                                <input type="text" name="book_code" class="form-control"
                                       value="{{ $book->book_code }}">
                            </div>

                            <!-- ISBN -->
                            <div class="col-md-6 d-flex align-items-center">
                                <label class="form-label me-2" style="width:120px;">ISBN:</label>
                                <input type="text" name="isbn" class="form-control"
                                       value="{{ $book->isbn }}">
                            </div>

                            <!-- Author Name -->
                            <div class="col-md-6 d-flex align-items-center">
                                <label class="form-label me-2" style="width:120px;">Author:</label>
                                <input type="text" name="author_name" class="form-control"
                                       value="{{ $book->author_name }}">
                            </div>

                            <!-- Publisher -->
                            <div class="col-md-6 d-flex align-items-center">
                                <label class="form-label me-2" style="width:120px;">Publisher:</label>
                                <input type="text" name="publisher" class="form-control"
                                       value="{{ $book->publisher }}">
                            </div>

                            <!-- Category Name -->
                            <div class="col-md-6 d-flex align-items-center">
                                <label class="form-label me-2" style="width:120px;">Category:</label>
                                <input type="text" name="category_name" class="form-control"
                                       value="{{ $book->category_name }}">
                            </div>

                            <!-- Subject -->
                            <div class="col-md-6 d-flex align-items-center">
                                <label class="form-label me-2" style="width:120px;">Subject:</label>
                                <input type="text" name="subject" class="form-control"
                                       value="{{ $book->subject }}">
                            </div>

                            <!-- Rack No -->
                            <div class="col-md-6 d-flex align-items-center">
                                <label class="form-label me-2" style="width:120px;">Rack No:</label>
                                <input type="text" name="rack_number" class="form-control"
                                       value="{{ $book->rack_number }}">
                            </div>

                            <!-- Quantity -->
                            <div class="col-md-6 d-flex align-items-center">
                                <label class="form-label me-2" style="width:120px;">Quantity:</label>
                                <input type="number" name="quantity" class="form-control"
                                       value="{{ $book->quantity }}">
                            </div>

                            <!-- Price -->
                            <div class="col-md-6 d-flex align-items-center">
                                <label class="form-label me-2" style="width:120px;">Price (₹):</label>
                                <input type="number" name="price" class="form-control"
                                       value="{{ $book->price }}">
                            </div>

                            <!-- Purchase Date -->
                            <div class="col-md-6 d-flex align-items-center">
                                <label class="form-label me-2" style="width:120px;">Purchase Date:</label>
                                <input type="date" name="purchase_date" class="form-control"
                                       value="{{ $book->purchase_date ? \Carbon\Carbon::parse($book->purchase_date)->format('Y-m-d') : '' }}">
                            </div>

                            <!-- Condition -->
                            <div class="col-md-6 d-flex align-items-center">
                                <label class="form-label me-2" style="width:120px;">Condition:</label>
                                <select name="condition" class="form-select">
                                    <option value="">-- Select Condition --</option>
                                    <option value="New" {{ $book->condition == 'New' ? 'selected' : '' }}>New</option>
                                    <option value="Good" {{ $book->condition == 'Good' ? 'selected' : '' }}>Good</option>
                                    <option value="Old" {{ $book->condition == 'Old' ? 'selected' : '' }}>Old</option>
                                </select>
                            </div>

                            <!-- Cover Image -->
                            <div class="col-md-6 d-flex align-items-center">
                                <label class="form-label me-2" style="width:120px;">Cover Image:</label>
                                <div>
                                    @if($book->cover_image)
                                        <p class="mb-1"><a href="{{ asset('storage/' . $book->cover_image) }}" target="_blank">View Current</a></p>
                                    @endif
                                    <input type="file" name="cover_image" class="form-control">
                                </div>
                            </div>

                            <!-- E-Book -->
                            <div class="col-md-6 d-flex align-items-center">
                                <label class="form-label me-2" style="width:120px;">E-Book (PDF):</label>
                                <div>
                                    @if($book->ebook_file)
                                        <p class="mb-1"><a href="{{ asset('storage/' . $book->ebook_file) }}" target="_blank">View Current</a></p>
                                    @endif
                                    <input type="file" name="ebook_file" class="form-control">
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="col-12 d-flex align-items-start">
                                <label class="form-label me-2" style="width:120px;">Description:</label>
                                <textarea name="description" class="form-control" rows="3">{{ $book->description }}</textarea>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Book</button>
                </div>

            </form>
        </div>
    </div>
</div>


<!-- Delete Book Icon -->
<a href="javascript:void(0);" class="me-2 text-danger" data-bs-toggle="tooltip" title="Delete"
   onclick="confirmDelete({{ $book->id }})">
    <i class="ri-delete-bin-5-line fs-16"></i>
</a>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        Are you sure you want to delete this book?
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

        <form id="deleteForm" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">Yes, Delete</button>
        </form>

      </div>

    </div>
  </div>
</div>


<!-- JS to handle delete -->
<script>
    function confirmDelete(bookId) {
        const form = document.getElementById('deleteForm');
        form.action = '/books/' + bookId; // Dynamic route for deleting the book
        const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
        modal.show();
    }
</script>


    <!-- View Book Details -->
    <a href="{{ route('books.show', $book->id) }}" class="me-2 text-primary" data-bs-toggle="tooltip" title="View">
        <i class="ri-eye-line fs-16"></i>
    </a>

    <!-- Update Inventory (check if route exists to avoid errors) -->

</td>

        </tr>
    @empty
        <tr>
            <td colspan="7" class="text-center">No books found.</td>
        </tr>
    @endforelse
</tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

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
<!-- Scroll To Top -->

<!-- ✅ jQuery (must be first) -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- ✅ Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- ✅ DataTables + Extensions -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

<!-- ✅ Your DataTable Initialization -->
<script>
$(document).ready(function() {
    // file export datatable (your main table)
    $('#file-export').DataTable({
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
        language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
        },
        pageLength: 10,
        responsive: true
    });
});
</script>

<!-- ✅ Other Libraries (optional from your template) -->
<script src="{{ asset('js/defaultmenu.min.js') }}"></script>
<script src="{{ asset('libs/node-waves/waves.min.js') }}"></script>
<script src="{{ asset('js/sticky.js') }}"></script>
<script src="{{ asset('libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('js/simplebar.js') }}"></script>
<script src="{{ asset('libs/@simonwep/pickr/pickr.es5.min.js') }}"></script>
<script src="{{ asset('libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
<script src="{{ asset('libs/jsvectormap/maps/world-merc.js') }}"></script>
<script src="{{ asset('js/us-merc-en.js') }}"></script>
<script src="{{ asset('js/index.js') }}"></script>
<script src="{{ asset('js/custom-switcher.min.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>








</body>

</html>
                
                
                
              