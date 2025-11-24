@include('head')

<body>
    @include('switcher')

    <!-- Loader -->
    <div id="loader">
        <img src="{{ asset('images/media/loader.svg') }}" alt="">
    </div>
    <!-- Loader -->

    <div class="page">
        @include('header')
        @include('nav_sidebar')

        <!-- Start::app-content -->
        <div class="main-content app-content">
            <div class="container-fluid">

                <!-- Page Header -->
                <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                    <div class="my-auto">
                        <h5 class="page-title fs-21 mb-1">Activity Logs</h5>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">LibraCloud</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Activity Logs</li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <div class="card custom-card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div class="card-title">Activity Logs</div>
                                <div>
                                    <button class="btn btn-sm btn-secondary" id="refreshTable">Refresh</button>
                                </div>
                            </div>

                            <div class="card-body">

                                <!-- Filters -->
                                <div class="row mb-3">
                                    <!-- USER FILTER -->
                                    <div class="col-md-3">
                                        <select class="form-select" id="filterUser">
                                            <option value="">All Users</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- ACTION FILTER -->
                                    <div class="col-md-3">
                                        <select class="form-select" id="filterAction">
                                            <option value="">All Actions</option>
                                            <option>Add Book</option>
                                            <option>Edit Book</option>
                                            <option>Issue Book</option>
                                            <option>Return Book</option>
                                            <option>Add Member</option>
                                            <option>Update Role</option>
                                            <option>Clear Fine</option>
                                        </select>
                                    </div>

                                    <!-- DATE FILTER -->
                                    <div class="col-md-3">
                                        <input type="date" class="form-control" id="filterDate">
                                    </div>

                                    <!-- APPLY FILTER BUTTON -->
                                    <div class="col-md-3">
                                        <button class="btn btn-primary w-100" id="applyFilters">Apply Filters</button>
                                    </div>
                                </div>

                                <!-- Activity Log Table -->
                                <div class="table-responsive">
                                    <table class="table table-bordered text-nowrap w-100" id="activityLogTable">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>User</th>
                                                <th>Action</th>
                                                <th>Details</th>
                                                <th>Status</th>
                                                <th>Date & Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($logs as $log)
                                                <tr>
                                                    <td>{{ $log->id }}</td>
                                                    <td>{{ $log->user->name ?? 'N/A' }}</td>
                                                    <td>{{ $log->action }}</td>
                                                    <td>{{ $log->details }}</td>

                                                    <td>
                                                        @if($log->status == 'success')
                                                            <span class="badge bg-success">Success</span>
                                                        @else
                                                            <span class="badge bg-danger">Failed</span>
                                                        @endif
                                                    </td>

                                                    <td>{{ $log->created_at->format('Y-m-d h:i A') }}</td>
                                                </tr>
                                            @endforeach
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

        @include('footer')
    </div>

    @include('foot')

    <!-- DataTables AJAX -->
   <script>
$(document).ready(function() {
    var table = $('#activityLogTable').DataTable({
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
        language: { searchPlaceholder: 'Search...', sSearch: '' },
        pageLength: 10,
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route("activity.logs.fetch") }}', // Make sure this route exists
            data: function(d) {
                d.user_id = $('#filterUser').val();
                d.action = $('#filterAction').val();
                d.date = $('#filterDate').val();
            }
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'user', name: 'user' },
            { data: 'action', name: 'action' },
            { data: 'details', name: 'details' },
            { data: 'status', name: 'status', orderable: false, searchable: false }, // remove render
            { data: 'created_at', name: 'created_at' }
        ]
    });

    // Apply Filters
    $('#applyFilters').on('click', function() {
        table.ajax.reload();
    });

    // Reset Filters
    $('#refreshTable').on('click', function() {
        $('#filterUser').val('');
        $('#filterAction').val('');
        $('#filterDate').val('');
        table.ajax.reload();
    });
});
</script>

</body>
</html>
