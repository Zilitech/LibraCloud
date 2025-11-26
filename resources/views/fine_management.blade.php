@include('head')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">

<style>
    .status-badge {
        white-space: nowrap;
        overflow: visible;
        text-overflow: clip;
        display: inline-block;
    }

    table.dataTable tbody td {
        vertical-align: middle;
    }

    .actions-cell .btn {
        padding: 0.25rem 0.5rem;
        font-size: 0.85rem;
    }

    .actions-cell .d-flex {
        flex-wrap: nowrap;
        gap: 0.25rem;
        justify-content: center;
    }

    .actions-cell [data-bs-toggle="tooltip"] {
        pointer-events: auto;
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
                                            <th>Issue ID</th>
                                            <th>Member</th>
                                            <th>Member ID</th>
                                            <th>Book Title</th>
                                            <th>Issue Date</th>
                                            <th>Due Date</th>
                                            <th>Days Overdue</th>
                                            <th>Fine Amount (₹)</th>
                                            <th>Status</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($all_fines as $fine)
                                        <tr>
                                            <td>{{ $fine->issue_id }}</td>
                                            <td>{{ $fine->member_name }}</td>
                                            <td>{{ $fine->member_id }}</td>
                                            <td>{{ $fine->book_name }}</td>
                                            <td>{{ $fine->issue_date }}</td>
                                            <td>{{ $fine->due_date }}</td>
                                            <td>{{ $fine->days_overdue }}</td>
                                            <td>₹{{ $fine->fine_amount ?? $fine->fine }}</td>
                                            <td class="text-center status-badge">
    @php
        // Find the fine status for this row's issue_id
        $fineStatus = $fines_status->firstWhere('issue_id', $fine->issue_id);
    @endphp

    @if($fineStatus)
        @if($fineStatus->status === 'Paid')
            <span class="badge bg-success">Paid</span>
        @elseif($fineStatus->status === 'Pending')
            <span class="badge bg-warning">Pending</span>
        @else
            <span class="badge bg-danger">Overdue</span>
        @endif
    @else
            <span class="badge bg-danger">Overdue</span>
    @endif
</td>

</td>
<td class="text-center actions-cell">
    <div class="d-flex flex-wrap gap-1 justify-content-center">

        {{-- Mark as Paid --}}
        @if($fine->status !== 'Paid')
            <form action="{{ route('fines.markAsPaid', $fine->issue_id) }}" method="POST" class="d-inline mark-paid-form" data-issue-id="{{ $fine->issue_id }}">
                @csrf
                <button type="submit" class="btn btn-sm btn-success" title="Mark as Paid">
                    <i class="ri-check-line"></i>
                </button>
            </form>
        @else
            {{-- Print Receipt --}}
            <a href="{{ route('fines.printReceipt', $fine->id) }}" class="btn btn-sm btn-secondary print-receipt-btn" title="Print Receipt">
                <i class="ri-printer-line"></i>
            </a>
        @endif

        {{-- Delete Fine --}}
        <form action="{{ route('fines.destroy', $fine->id) }}" method="POST" class="d-inline delete-fine-form" onsubmit="return confirm('Are you sure you want to delete this fine?');">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-danger" title="Delete">
                <i class="ri-delete-bin-5-line"></i>
            </button>
        </form>

    </div>
</td>
<script>
$(document).ready(function() {

    // Initialize DataTable
    var table = $('#fine-table').DataTable({
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
        pageLength: 10,
        responsive: true,
        columnDefs: [
            { width: '100px', targets: 8 },
            { width: '180px', targets: -1 }
        ]
    });

    // Mark as Paid via AJAX
    $('#fine-table').on('submit', '.mark-paid-form', function(e) {
        e.preventDefault();

        let form = $(this);
        let issueId = form.data('issue-id');
        let token = form.find('input[name="_token"]').val();
        let row = table.row(form.closest('tr')); // get DataTable row

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: { _token: token },
            success: function(response) {
                // Update status badge column (8th index)
                let rowData = row.data();
                rowData[8] = '<span class="badge bg-success">Paid</span>';

                // Replace Mark as Paid button with Print button in actions column (9th index)
                rowData[9] = `<div class="d-flex justify-content-center">
                                    <a href="/fines/${response.fine_id}/print" class="btn btn-sm btn-secondary print-receipt-btn" title="Print Receipt">
                                        <i class="ri-printer-line"></i>
                                    </a>
                                </div>`;

                // Update the row in DataTable
                row.data(rowData).draw(false);

                // Optional: show a toast or alert
                alert('Fine marked as paid successfully.');
            },
            error: function(xhr) {
                console.error(xhr.responseText);
                alert('Something went wrong while marking fine as paid.');
            }
        });
    });

});
</script>




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
            { width: '100px', targets: 8 },
            { width: '180px', targets: -1 }
        ]
    });

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
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
