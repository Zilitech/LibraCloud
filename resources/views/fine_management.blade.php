@include('head')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">

<style>
    /* Ensure Status badges fully visible */
    .status-badge {
        white-space: nowrap;
        overflow: visible;
        text-overflow: clip;
        display: inline-block;
    }

    /* Optional: Responsive table scroll for small screens */
    table.dataTable tbody td {
        vertical-align: middle;
    }

    /* Fix Actions column width for better visibility */
    table.dataTable td:last-child {
        white-space: nowrap;
    }
</style>

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
                    <h5 class="page-title fs-21 mb-1">Fine Management</h5>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Library</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Fine Management</li>
                        </ol>
                    </nav>
                </div>
                <div class="d-flex my-xl-auto right-content align-items-center">
                    <a href="{{ url('fine_setting') }}" class="btn btn-secondary">
                        <i class="ri-settings-3-line me-1"></i> Fine Settings
                    </a>
                </div>
            </div>

            <!-- Info Alert -->
            <div class="alert alert-solid-info alert-dismissible fade show mb-4">
                Manage and track all fines collected from overdue books. Update, clear, or view fine details here.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <!-- Fine Summary Cards -->
            <div class="row">
                @php
                    $totalFines = $fines->sum('fine_amount');
                    $pendingFines = $fines->where('status','Pending')->sum('fine_amount');
                    $clearedFines = $fines->where('status','Paid')->sum('fine_amount');
                    $membersWithFines = $fines->pluck('member')->unique()->count();
                @endphp

                @foreach ([
                    ['title'=>'Total Fines Collected','value'=>$totalFines,'icon'=>'ri-money-dollar-circle-line','color'=>'primary-transparent'],
                    ['title'=>'Pending Fines','value'=>$pendingFines,'icon'=>'ri-time-line','color'=>'warning-transparent'],
                    ['title'=>'Cleared Fines','value'=>$clearedFines,'icon'=>'ri-check-double-line','color'=>'success-transparent'],
                    ['title'=>'Members with Fines','value'=>$membersWithFines,'icon'=>'ri-user-line','color'=>'info-transparent']
                ] as $card)
                <div class="col-xl-3 col-md-6">
                    <div class="card custom-card">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <span class="avatar bg-{{ $card['color'] }}">
                                    <i class="{{ $card['icon'] }} fs-24"></i>
                                </span>
                            </div>
                            <div>
                                <p class="mb-1 text-muted">{{ $card['title'] }}</p>
                                <h5 class="mb-0 fw-semibold">{{ is_numeric($card['value']) ? '₹'.number_format($card['value'],2) : $card['value'] }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

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
                                        @foreach($fines as $fine)
                                        <tr>
                                            <td>{{ $fine['fine_id'] }}</td>
                                            <td>{{ $fine['member'] }}</td>
                                            <td>{{ $fine['book_title'] }}</td>
                                            <td>{{ \Carbon\Carbon::parse($fine['issue_date'])->format('Y-m-d') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($fine['due_date'])->format('Y-m-d') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($fine['return_date'])->format('Y-m-d') }}</td>
                                            <td>{{ $fine['days_overdue'] }}</td>
                                            <td>₹{{ number_format($fine['fine_amount'],2) }}</td>
                                            <td class="text-center status-badge">
                                                @if($fine['status'] == 'Paid')
                                                    <span class="badge bg-success">Paid</span>
                                                @elseif($fine['status'] == 'Pending')
                                                    <span class="badge bg-warning">Pending</span>
                                                @else
                                                    <span class="badge bg-danger">Overdue</span>
                                                @endif
                                            </td>
                                           <td class="text-center">
    @if($fine['status'] == 'Pending')
        <!-- Mark as Paid -->
        <form action="{{ route('fines.markPaid', $fine['id']) }}" method="POST" style="display:inline-block;">
            @csrf
            <button class="btn btn-sm btn-success me-1" title="Mark as Paid">
                <i class="ri-check-line"></i>
            </button>
        </form>
    @elseif($fine['status'] == 'Overdue')
        <!-- Send Reminder -->
        <button class="btn btn-sm btn-warning me-1" data-bs-toggle="tooltip" title="Send Reminder">
            <i class="ri-mail-send-line"></i>
        </button>
        <!-- Mark as Paid -->
        <form action="{{ route('fines.markPaid', $fine['id']) }}" method="POST" style="display:inline-block;">
            @csrf
            <button class="btn btn-sm btn-success me-1" title="Mark as Paid">
                <i class="ri-check-line"></i>
            </button>
        </form>
    @endif

    <!-- View -->
    <a href="{{ route('fines.show', $fine['id']) }}" class="btn btn-sm btn-info me-1" title="View">
        <i class="ri-eye-line"></i>
    </a>

    <!-- Optional: Print Receipt -->
    @if($fine['status'] == 'Paid')
    <a href="{{ route('fines.printReceipt', $fine['id']) }}" class="btn btn-sm btn-secondary me-1" title="Print Receipt">
        <i class="ri-printer-line"></i>
    </a>
    @endif

    <!-- Delete -->
    <form action="{{ route('fines.destroy', $fine['id']) }}" method="POST" style="display:inline-block;">
        @csrf
        @method('DELETE')
        <button class="btn btn-sm btn-danger" title="Delete">
            <i class="ri-delete-bin-5-line"></i>
        </button>
    </form>
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
            <!-- End Fine Records Table -->

        </div>
    </div>

    @include('footer')
</div>

<div class="scrollToTop"><span class="arrow"><i class="las la-angle-double-up"></i></span></div>

<!-- JS Files -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
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
        pageLength: 10,
        responsive: true,
        columnDefs: [
            { width: '100px', targets: 8 }, // Status
            { width: '150px', targets: -1 } // Actions
        ]
    });
});
</script>

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
