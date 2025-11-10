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
                    <h5 class="page-title fs-21 mb-1">Fine Management</h5>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Library</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Fine Management</li>
                        </ol>
                    </nav>
                </div>

                <div class="d-flex my-xl-auto right-content align-items-center">
                    <div class="pe-1 mb-xl-0">
                        <a href="{{ url('fine_setting') }}" class="btn btn-secondary">
                            <i class="ri-settings-3-line me-1"></i> Fine Settings
                        </a>
                    </div>
                </div>
            </div>
            <!-- End Page Header -->

            <!-- Info Alert -->
            <div class="alert alert-solid-info alert-dismissible fade show mb-4">
                Manage and track all fines collected from overdue books. You can update, clear, or view fine details here.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <!-- Fine Summary Cards -->
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card custom-card">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <span class="avatar bg-primary-transparent"><i class="ri-money-rupee-circle-line fs-24"></i></span>
                            </div>
                            <div>
                                <p class="mb-1 text-muted">Total Fines Collected</p>
                                <h5 class="mb-0 fw-semibold">₹12,450</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card custom-card">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <span class="avatar bg-warning-transparent"><i class="ri-time-line fs-24"></i></span>
                            </div>
                            <div>
                                <p class="mb-1 text-muted">Pending Fines</p>
                                <h5 class="mb-0 fw-semibold">₹2,150</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card custom-card">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <span class="avatar bg-success-transparent"><i class="ri-check-double-line fs-24"></i></span>
                            </div>
                            <div>
                                <p class="mb-1 text-muted">Cleared Fines</p>
                                <h5 class="mb-0 fw-semibold">₹10,300</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card custom-card">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <span class="avatar bg-info-transparent"><i class="ri-user-line fs-24"></i></span>
                            </div>
                            <div>
                                <p class="mb-1 text-muted">Members with Fines</p>
                                <h5 class="mb-0 fw-semibold">18</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Fine Summary Cards -->

            <!-- Fine Records Table -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">Fine Records</div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="fine-table" class="table table-bordered text-nowrap w-100">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Fine ID</th>
                                            <th>Member</th>
                                            <th>Book Title</th>
                                            <th>Issue Date</th>
                                            <th>Due Date</th>
                                            <th>Return Date</th>
                                            <th>Days Overdue</th>
                                            <th>Fine Amount (₹)</th>
                                            <th>Status</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>FINE-0012</td>
                                            <td>John Doe (M001)</td>
                                            <td>Organic Chemistry Vol 2</td>
                                            <td>2025-09-25</td>
                                            <td>2025-10-10</td>
                                            <td>2025-10-15</td>
                                            <td>5</td>
                                            <td>₹50</td>
                                            <td><span class="badge bg-success">Paid</span></td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-info me-1" data-bs-toggle="tooltip" title="View"><i class="ri-eye-line"></i></button>
                                                <button class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" title="Print Receipt"><i class="ri-printer-line"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>FINE-0013</td>
                                            <td>Mary Smith (M002)</td>
                                            <td>Data Structures in C</td>
                                            <td>2025-10-01</td>
                                            <td>2025-10-15</td>
                                            <td>2025-10-25</td>
                                            <td>10</td>
                                            <td>₹100</td>
                                            <td><span class="badge bg-warning">Pending</span></td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-success me-1" data-bs-toggle="tooltip" title="Mark as Paid"><i class="ri-check-line"></i></button>
                                                <button class="btn btn-sm btn-info me-1" data-bs-toggle="tooltip" title="View"><i class="ri-eye-line"></i></button>
                                                <button class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Delete"><i class="ri-delete-bin-5-line"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>FINE-0014</td>
                                            <td>Rahul Patil (M003)</td>
                                            <td>Indian Polity</td>
                                            <td>2025-09-28</td>
                                            <td>2025-10-10</td>
                                            <td>2025-10-20</td>
                                            <td>10</td>
                                            <td>₹100</td>
                                            <td><span class="badge bg-danger">Overdue</span></td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-warning me-1" data-bs-toggle="tooltip" title="Send Reminder"><i class="ri-mail-send-line"></i></button>
                                                <button class="btn btn-sm btn-info me-1" data-bs-toggle="tooltip" title="View"><i class="ri-eye-line"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Fine Records Table -->

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
    $('#fine-table').DataTable({
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
        language: {
            searchPlaceholder: 'Search fines...',
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
