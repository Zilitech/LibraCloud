@include('head')

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
                    <h5 class="page-title fs-21 mb-1">System Backup</h5>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">LibraCloud</a></li>
                            <li class="breadcrumb-item active" aria-current="page">System Backup</li>
                        </ol>
                    </nav>
                </div>
            </div>
<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="card-title">System Backup</div>
                <div>
                    <button class="btn btn-sm btn-primary" id="runBackupBtn">
                        <i class="ri-refresh-line me-1"></i> Run Backup
                    </button>
                </div>
            </div>
            <div class="card-body">

                <!-- Backup Info -->
                <div class="alert alert-info mb-4">
                    You can create a manual backup of the library system database and files. Automatic backups can be scheduled via cron jobs.
                </div>

                <!-- Manual Backup -->
                <div class="mb-4">
                    <h5 class="mb-3">Manual Backup</h5>
                    <button class="btn btn-success" id="manualBackupBtn">
                        <i class="ri-download-2-line me-1"></i> Download Latest Backup
                    </button>
                    <span class="ms-2 text-muted">Last backup: 2025-11-10 02:30 AM</span>
                </div>

                <!-- Automatic Backup -->
                <div class="mb-4">
                    <h5 class="mb-3">Automatic Backup</h5>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="autoBackupSwitch" checked>
                        <label class="form-check-label" for="autoBackupSwitch">Enable Automatic Daily Backup</label>
                    </div>
                    <small class="text-muted">Backups will run daily at 2:00 AM.</small>
                </div>

                <!-- Backup History Table -->
                <div class="table-responsive">
                    <table id="backup-table" class="table table-bordered text-nowrap w-100">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Backup Name</th>
                                <th>Type</th>
                                <th>Date & Time</th>
                                <th>Size</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Dummy Data -->
                            <tr>
                                <td>1</td>
                                <td>backup_2025-11-10_0230.sql</td>
                                <td>Database</td>
                                <td>2025-11-10 02:30 AM</td>
                                <td>12 MB</td>
                                <td class="text-center"><span class="badge bg-success">Completed</span></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-success"><i class="ri-download-2-line"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="ri-delete-bin-line"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>backup_2025-11-09_0230.sql</td>
                                <td>Database</td>
                                <td>2025-11-09 02:30 AM</td>
                                <td>11.8 MB</td>
                                <td class="text-center"><span class="badge bg-success">Completed</span></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-success"><i class="ri-download-2-line"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="ri-delete-bin-line"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>backup_2025-11-08_0230.sql</td>
                                <td>Database</td>
                                <td>2025-11-08 02:30 AM</td>
                                <td>12.1 MB</td>
                                <td class="text-center"><span class="badge bg-danger">Failed</span></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-success"><i class="ri-download-2-line"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="ri-delete-bin-line"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- DataTables Script -->
<script>
$(document).ready(function() {
    $('#backup-table').DataTable({
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
        language: { searchPlaceholder: 'Search...', sSearch: '' },
        pageLength: 10,
        responsive: true
    });

    // Dummy backup actions
    $('#manualBackupBtn, #runBackupBtn').on('click', function() {
        alert('Backup process started... (Dummy action)');
    });

    $('#autoBackupSwitch').on('change', function() {
        if(this.checked) {
            alert('Automatic backups enabled');
        } else {
            alert('Automatic backups disabled');
        }
    });
});
</script>

<!-- DataTables Scripts -->
<script>
$(document).ready(function() {
    var table = $('#activity-table').DataTable({
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
        language: { searchPlaceholder: 'Search...', sSearch: '' },
        pageLength: 10,
        responsive: true
    });

    // Filter functionality
    $('#applyFilters').on('click', function() {
        var user = $('#filterUser').val();
        var action = $('#filterAction').val();
        var date = $('#filterDate').val();

        table.rows().every(function() {
            var data = this.data();
            var show = true;

            if(user && !data[1].includes(user)) show = false;
            if(action && !data[2].includes(action)) show = false;
            if(date && !data[4].includes(date)) show = false;

            if(show) $(this.node()).show();
            else $(this.node()).hide();
        });
    });
});
</script>


            </div>
        </div>
        <!-- End::app-content -->

        <!-- Footer Start -->
        @include('footer')
        <!-- Footer End -->

    </div>

    
   @include('foot')



</body>

</html>