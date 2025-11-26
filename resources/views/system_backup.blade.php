@include('head')
<body>
@include('switcher')
<div class="page">
@include('header')
@include('nav_sidebar')

<div class="main-content app-content">
    <div class="container-fluid">

        @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <div class="my-auto">
                <h5 class="page-title fs-21 mb-1">System Backup</h5>
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">LibraCloud</a></li>
                        <li class="breadcrumb-item active">System Backup</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="card custom-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="card-title">System Backup</div>
                <button class="btn btn-sm btn-primary" id="runBackupBtn">
                    <i class="ri-refresh-line me-1"></i> Run Backup
                </button>
            </div>
            <div class="card-body">

                <div class="alert alert-info mb-4">
                    You can create a manual backup of the library system database and files.
                </div>

                <div class="mb-4">
                    <h5 class="mb-3">Download Latest Backup (2 AM)</h5>
                    <button id="backupAndDownloadBtn" class="btn btn-success">
                        <i class="ri-download-2-line me-1"></i> Download Latest (2 AM)
                    </button>
                    <span class="ms-2 text-muted">
                        @if($backups->first())
                            Last backup: {{ $backups->first()->created_at->format('Y-m-d h:i A') }}
                        @else
                            No backups yet
                        @endif
                    </span>
                </div>

                <div class="mb-4">
                    <h5 class="mb-3">Automatic Backup</h5>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="autoBackupSwitch" checked>
                        <label class="form-check-label" for="autoBackupSwitch">Enable Automatic Daily Backup</label>
                    </div>
                    <small class="text-muted">Backups will run daily at 2:00 AM.</small>
                </div>

                <div class="table-responsive">
                    <table id="backup-table" class="table table-bordered text-nowrap w-100">
                        <thead>
                            <tr>
                                <th>ID</th><th>Backup Name</th><th>Type</th>
                                <th>Date & Time</th><th>Size</th><th class="text-center">Status</th>
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
                                    <span class="badge {{ $backup->status==='completed' ? 'bg-success' : 'bg-danger' }}">
                                        {{ ucfirst($backup->status) }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('system.backup.download',$backup->id) }}" class="btn btn-sm btn-success">
                                        <i class="ri-download-2-line"></i>
                                    </a>
                                    <form action="{{ route('system.backup.delete',$backup->id) }}" method="POST" style="display:inline-block;">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                            <i class="ri-delete-bin-line"></i>
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

@include('footer')
@include('foot')

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

<script>
    $('#runBackupBtn').click(function(){
    var $btn = $(this);
    $btn.prop('disabled',true).html('<i class="ri-refresh-line me-1"></i> Running Backup...');
    
    $.ajax({
        url: "{{ route('system.backup.run') }}",
        type: "POST",
        data: {_token: '{{ csrf_token() }}'},
        success: function(res){
            if(res.message){
                if(res.success){
                    alert(res.message);
                } else {
                    // Show detailed error
                    alert(res.message + "\n\n" + (res.error_details || 'No further info.'));
                }
            }

            if(res.success && res.download_url){
                const link = document.createElement('a');
                link.href = res.download_url;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }

            // Reload page after backup attempt
            location.reload();
        },
        error: function(err){
            alert('Backup request failed!');
            console.error(err);
        },
        complete: function(){
            $btn.prop('disabled',false).html('<i class="ri-refresh-line me-1"></i> Run Backup');
        }
    });
});

</script>


</body>
</html>
