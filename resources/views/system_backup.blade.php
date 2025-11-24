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

                        <!-- Info -->
                        <div class="alert alert-info mb-4">
                            You can create a manual backup of the library system database and files.
                        </div>

                        <!-- Manual Backup -->
                        <div class="mb-4">
                            <h5 class="mb-3">Manual Backup</h5>
                            <button id="backupAndDownloadBtn" class="btn btn-success">
    <i class="ri-download-2-line me-1"></i> Backup & Download Latest
</button>
                            <span id="lastBackupInfo" class="ms-2 text-muted">
                                @if($backups->first())
                                    Last backup: {{ $backups->first()->created_at->format('Y-m-d h:i A') }}
                                @else
                                    No backups yet
                                @endif
                            </span>
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
                                    @foreach($backups as $backup)
                                    <tr>
                                        <td>{{ $backup->id }}</td>
                                        <td>{{ $backup->name }}</td>
                                        <td>{{ ucfirst($backup->type) }}</td>
                                        <td>{{ $backup->created_at->format('Y-m-d h:i A') }}</td>
                                        <td>{{ $backup->size }}</td>
                                        <td class="text-center">
                                            @if($backup->status === 'completed')
                                                <span class="badge bg-success">Completed</span>
                                            @else
                                                <span class="badge bg-danger">Failed</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('system.backup.download', $backup->id) }}" class="btn btn-sm btn-success"><i class="ri-download-2-line"></i></a>
                                            <form action="{{ route('system.backup.delete', $backup->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="ri-delete-bin-line"></i></button>
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

    </div>
</div>

@include('footer')
@include('foot')

<script>
$(document).ready(function() {

    // DataTable
    $('#backup-table').DataTable({
        dom: 'Bfrtip',
        buttons: ['copy','csv','excel','pdf','print'],
        pageLength: 10,
        responsive: true
    });

    // Backup & Download Latest
    $('#backupAndDownloadBtn').on('click', function() {
        var $btn = $(this);
        $btn.prop('disabled', true).html('<i class="ri-refresh-line me-1"></i> Running Backup...');

        $.ajax({
            url: "{{ route('system.backup.run') }}",
            type: "POST",
            data: {_token: '{{ csrf_token() }}'},
            success: function(res) {
                alert(res.message);

                // Reload page to refresh backup table
                location.reload();
            },
            error: function(err) {
                alert('Backup failed!');
                console.error(err);
                $btn.prop('disabled', false).html('<i class="ri-download-2-line me-1"></i> Backup & Download Latest');
            }
        });
    });

    // Auto Backup Switch
    $('#autoBackupSwitch').on('change', function() {
        alert(this.checked ? 'Automatic backups enabled' : 'Automatic backups disabled');
    });

});
</script>

<script>
    <script>
$(document).ready(function() {
    $('#backupAndDownloadBtn').on('click', function() {
        var $btn = $(this);
        $btn.prop('disabled', true).html('<i class="ri-refresh-line me-1"></i> Running Backup...');

        $.ajax({
            url: "{{ route('system.backup.run') }}",
            type: "POST",
            data: {_token: '{{ csrf_token() }}'},
            success: function(res) {
                if(res.success){
                    alert(res.message);
                    // Automatically download latest backup
                    window.location.href = "{{ route('system.backup.download', $backups->first()?->id ?? 0) }}";
                    location.reload(); // Refresh table to show new backup
                } else {
                    alert('Backup failed!');
                    $btn.prop('disabled', false).html('<i class="ri-download-2-line me-1"></i> Backup & Download Latest');
                }
            },
            error: function(err) {
                alert('Backup failed!');
                console.error(err);
                $btn.prop('disabled', false).html('<i class="ri-download-2-line me-1"></i> Backup & Download Latest');
            }
        });
    });
});
</script>
</script>
</body>
</html>
