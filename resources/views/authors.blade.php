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

<!-- Page Header -->
<div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
    
    <div class="my-auto">
        <h5 class="page-title fs-21 mb-1">Authors List</h5>
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Books</a></li>
                <li class="breadcrumb-item active" aria-current="page">Authors</li>
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
            <button type="button" class="btn btn-warning btn-icon me-2"><i class="mdi mdi-refresh"></i></button>
        </div>
      <div class="mb-xl-0">
    <form method="POST" action="{{ route('author.import') }}" enctype="multipart/form-data">
        @csrf
        <div class="input-group">
            <input type="file" class="form-control" name="csv_file" accept=".csv" required>
            <button class="btn btn-primary" type="submit">
                <i class="ri-upload-2-line me-1"></i> Import CSV
            </button>
        </div>
    </form>
</div>

    </div>
</div>
<!-- Page Header Close -->

<!-- Alert -->
<div class="alert alert-solid-secondary alert-dismissible fs-15 fade show mb-4">
    All <strong class="text-fixed-black">Authors</strong> data is displayed on this page using <strong class="text-fixed-black">jquery</strong> DataTables.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="bi bi-x"></i></button>
</div>

<!-- Start:: row -->
<div class="row">
    <div class="col-xl-6">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">Add New Author</div>
            </div>

            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <form method="POST" action="{{ route('author.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="authorName" class="form-label fs-14 text-dark">Author Name</label>
                        <input type="text" class="form-control" id="authorName" name="author_name" placeholder="Enter author name" required>
                    </div>
                    <button class="btn btn-primary" type="submit">
                        <i class="ri-save-line me-1"></i>Save Author
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">Authors List</div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="file-export" class="table table-bordered text-nowrap w-100">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Author Name</th>
                                <th>Books Count</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($authors as $index => $author)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $author->author_name }}</td>
                                    <td>0</td> {{-- Replace with real count later --}}
                                    <td><span class="badge bg-success-transparent">Active</span></td>
                                    <td>
                                        <div class="hstack gap-2 flex-wrap">
                                                                  <a href="javascript:void(0);" 
                       class="text-info fs-14 lh-1 editBtn"
                       data-id="{{ $author->id }}"
                       data-name="{{ $author->author_name }}">
                        <i class="ri-edit-line"></i>
                    </a>
                                                                                   <a href="javascript:void(0);" 
   class="text-danger fs-14 lh-1" 
   onclick="confirmDelete({{ $author->id }})">
   <i class="ri-delete-bin-5-line"></i>
</a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No authors found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editAuthorModal" tabindex="-1" aria-labelledby="editAuthorLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('author.update') }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="editAuthorLabel">Edit Author</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Author ID</label>
            <input type="text" class="form-control" id="editAuthorId" name="id" readonly>
          </div>
          <div class="mb-3">
            <label class="form-label">Author Name</label>
            <input type="text" class="form-control" id="editAuthorName" name="author_name" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Update Author</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this author?
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
    function confirmDelete(id) {
        const form = document.getElementById('deleteForm');
        form.action = '/authors/' + id; // Set dynamic route
        const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
        modal.show();
    }
</script>


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


 <script>
document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.editBtn');
    const modal = new bootstrap.Modal(document.getElementById('editAuthorModal'));
    const idField = document.getElementById('editAuthorId');
    const nameField = document.getElementById('editAuthorName');

    editButtons.forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');

            idField.value = id;
            nameField.value = name;

            modal.show();
        });
    });
});
</script>



</body>

</html>
                
                
                
              