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
                    <button class="btn btn-sm btn-secondary" onclick="$('#activity-table').DataTable().ajax.reload()">Refresh</button>
                </div>
            </div>
            <div class="card-body">
                <!-- Filters -->
                <div class="row mb-3">
                    <div class="col-md-3">
                        <select class="form-select" id="filterUser">
                            <option value="">All Users</option>
                            <option>Admin</option>
                            <option>Librarian</option>
                        </select>
                    </div>
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
                    <div class="col-md-3">
                        <input type="date" class="form-control" id="filterDate">
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-primary w-100" id="applyFilters">Apply Filters</button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="activity-table" class="table table-bordered text-nowrap w-100">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Action</th>
                                <th>Details</th>
                                <th>Date & Time</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Dummy Data -->
                            <tr>
                                <td>1</td>
                                <td>Admin</td>
                                <td>Add Book</td>
                                <td>Added "Organic Chemistry Volume 2" by Dr. B. Kumar</td>
                                <td>2025-11-10 09:15 AM</td>
                                <td class="text-center"><span class="badge bg-success">Success</span></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Librarian</td>
                                <td>Issue Book</td>
                                <td>Issued "Mathematics 101" to Student: Rocky</td>
                                <td>2025-11-10 10:30 AM</td>
                                <td class="text-center"><span class="badge bg-success">Success</span></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Admin</td>
                                <td>Delete Member</td>
                                <td>Removed member: Jane Doe (ID: 105)</td>
                                <td>2025-11-09 04:20 PM</td>
                                <td class="text-center"><span class="badge bg-danger">Failed</span></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Librarian</td>
                                <td>Return Book</td>
                                <td>Returned "Physics Fundamentals" from Student: John</td>
                                <td>2025-11-08 11:45 AM</td>
                                <td class="text-center"><span class="badge bg-success">Success</span></td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Admin</td>
                                <td>Update Role</td>
                                <td>Updated role "Librarian" permissions</td>
                                <td>2025-11-07 02:10 PM</td>
                                <td class="text-center"><span class="badge bg-success">Success</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

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