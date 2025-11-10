@include('head')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">

<body>

@include('switcher')

<!-- Loader -->
<div id="loader">
    <img src="{{ asset('images/media/loader.svg') }}" alt="">
</div>
<!-- Loader -->

<div class="page">

    <!-- Header -->
    @include('header')
    @include('nav_sidebar')

    <!-- Main Content -->
    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                <div class="my-auto">
                    <h5 class="page-title fs-21 mb-1">Returned Books</h5>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Library</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Returned Books</li>
                        </ol>
                    </nav>
                </div>

                <div class="d-flex my-xl-auto right-content align-items-center">
                    <div class="pe-1 mb-xl-0">
                        <a href="{{ url('return_book') }}" class="btn btn-primary">
                            <i class="ri-add-line me-1"></i> Assign Book
                        </a>
                    </div>
                </div>
            </div>
            <!-- End Page Header -->

            <!-- Info Alert -->
            <div class="alert alert-solid-secondary alert-dismissible fade show mb-4">
                View and manage all <strong>Returned Books</strong> records below.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <!-- Returned Books Table -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">Returned Books List</div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="returned-books-table" class="table table-bordered text-nowrap w-100">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Issue ID</th>
                                            <th>Book Title</th>
                                            <th>Member</th>
                                            <th>Issue Date</th>
                                            <th>Return Date</th>
                                            <th>Status</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>ISS-0012</td>
                                            <td>Organic Chemistry Vol 2 (CHM101)</td>
                                            <td>John Doe (M001)</td>
                                            <td>2025-10-05</td>
                                            <td>2025-10-20</td>
                                            <td><span class="badge bg-success">Returned</span></td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-info me-1" data-bs-toggle="tooltip" title="View"><i class="ri-eye-line"></i></button>
                                                <button class="btn btn-sm btn-warning me-1" data-bs-toggle="tooltip" title="Re-Issue"><i class="ri-refresh-line"></i></button>
                                                <button class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Delete"><i class="ri-delete-bin-5-line"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>ISS-0013</td>
                                            <td>Data Structures in C (CSC203)</td>
                                            <td>Mary Smith (M002)</td>
                                            <td>2025-10-08</td>
                                            <td>2025-10-25</td>
                                            <td><span class="badge bg-warning">Pending</span></td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-info me-1"><i class="ri-eye-line"></i></button>
                                                <button class="btn btn-sm btn-warning me-1"><i class="ri-refresh-line"></i></button>
                                                <button class="btn btn-sm btn-danger"><i class="ri-delete-bin-5-line"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>ISS-0014</td>
                                            <td>Indian Polity (POL102)</td>
                                            <td>Rahul Patil (M003)</td>
                                            <td>2025-10-10</td>
                                            <td>2025-10-25</td>
                                            <td><span class="badge bg-danger">Overdue</span></td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-info me-1"><i class="ri-eye-line"></i></button>
                                                <button class="btn btn-sm btn-warning me-1"><i class="ri-refresh-line"></i></button>
                                                <button class="btn btn-sm btn-danger"><i class="ri-delete-bin-5-line"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Returned Books Table -->

        </div>
    </div>
    <!-- End::app-content -->

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

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

<script>
$(document).ready(function() {
    $('#returned-books-table').DataTable({
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
        language: {
            searchPlaceholder: 'Search returned books...',
            sSearch: '',
        },
        pageLength: 10,
        responsive: true
    });
});
</script>

<!-- Template JS -->
<script src="{{ asset('js/defaultmenu.min.js') }}"></script>
<script src="{{ asset('libs/node-waves/waves.min.js') }}"></script>
<script src="{{ asset('js/sticky.js') }}"></script>
<script src="{{ asset('libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('js/simplebar.js') }}"></script>
<script src="{{ asset('libs/@simonwep/pickr/pickr.es5.min.js') }}"></script>
<script src="{{ asset('js/custom-switcher.min.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>

</body>
</html>
