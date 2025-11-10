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

<div class="page">
    @include('header')
    @include('nav_sidebar')

    <!-- Main Content -->
    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                <div class="my-auto">
                    <h5 class="page-title fs-21 mb-1">New Arrival Alerts</h5>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Library</a></li>
                            <li class="breadcrumb-item active" aria-current="page">New Arrival Alerts</li>
                        </ol>
                    </nav>
                </div>
                <div class="d-flex my-xl-auto right-content align-items-center">
                    <div class="pe-1 mb-xl-0">
                        <a href="{{ url('new_arrival_setting') }}" class="btn btn-primary">
                            <i class="ri-settings-3-line me-1"></i> Settings
                        </a>
                    </div>
                </div>
            </div>

            <!-- Info Alert -->
            <div class="alert alert-solid-secondary alert-dismissible fade show mb-4">
                View the latest new arrivals in the library. Send alerts to members manually if needed.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <!-- Dashboard Cards -->
            <div class="row">
                <div class="col-xl-4 col-md-6">
                    <div class="card custom-card">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <span class="avatar bg-success-transparent"><i class="ri-book-line fs-24"></i></span>
                            </div>
                            <div>
                                <p class="mb-1 text-muted">Total New Arrivals</p>
                                <h5 class="mb-0 fw-semibold">25</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="card custom-card">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <span class="avatar bg-primary-transparent"><i class="ri-mail-send-line fs-24"></i></span>
                            </div>
                            <div>
                                <p class="mb-1 text-muted">Alerts Sent Today</p>
                                <h5 class="mb-0 fw-semibold">12</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="card custom-card">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <span class="avatar bg-warning-transparent"><i class="ri-user-line fs-24"></i></span>
                            </div>
                            <div>
                                <p class="mb-1 text-muted">Members Subscribed</p>
                                <h5 class="mb-0 fw-semibold">150</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alerts Table -->
            <div class="row mt-4">
                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">New Arrival Alerts List</div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="new-arrivals-table" class="table table-bordered text-nowrap w-100">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Book ID</th>
                                            <th>Book Title</th>
                                            <th>Category</th>
                                            <th>Arrival Date</th>
                                            <th>Status</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>BK-101</td>
                                            <td>Data Structures in C (CSC203)</td>
                                            <td>Computer Science</td>
                                            <td>2025-11-07</td>
                                            <td><span class="badge bg-success">New</span></td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-info me-1" data-bs-toggle="tooltip" title="View"><i class="ri-eye-line"></i></button>
                                                <button class="btn btn-sm btn-primary me-1" data-bs-toggle="tooltip" title="Send Alert"><i class="ri-mail-send-line"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>BK-102</td>
                                            <td>Organic Chemistry Vol 2 (CHM101)</td>
                                            <td>Science</td>
                                            <td>2025-11-05</td>
                                            <td><span class="badge bg-success">New</span></td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-info me-1"><i class="ri-eye-line"></i></button>
                                                <button class="btn btn-sm btn-primary me-1"><i class="ri-mail-send-line"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>BK-103</td>
                                            <td>Indian Polity (POL102)</td>
                                            <td>Political Science</td>
                                            <td>2025-11-04</td>
                                            <td><span class="badge bg-success">New</span></td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-info me-1"><i class="ri-eye-line"></i></button>
                                                <button class="btn btn-sm btn-primary me-1"><i class="ri-mail-send-line"></i></button>
                                            </td>
                                        </tr>
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
    $('#new-arrivals-table').DataTable({
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
        language: {
            searchPlaceholder: 'Search new arrivals...',
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
