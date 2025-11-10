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
    @include('header')
    @include('nav_sidebar')

    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                <div class="my-auto">
                    <h5 class="page-title fs-21 mb-1">Admin / Librarians</h5>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Settings</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Staff Management</li>
                        </ol>
                    </nav>
                </div>
                <div class="d-flex my-xl-auto right-content align-items-center">
                    <div class="pe-1 mb-xl-0">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStaffModal">
                            <i class="ri-add-line me-1"></i> Add Staff
                        </button>
                    </div>
                </div>
            </div>
            <!-- Page Header End -->

            <div class="alert alert-solid-secondary alert-dismissible fs-15 fade show mb-4">
                Manage all <strong class="text-fixed-black">library staff</strong>. Add new admin or librarian, assign roles, edit or deactivate accounts.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="bi bi-x"></i></button>
            </div>

            <!-- Staff Table -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="card-header">
                            <div class="card-title">Staff List</div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="staff-table" class="table table-bordered text-nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>John Doe</td>
                                            <td>john@example.com</td>
                                            <td>Admin</td>
                                            <td><span class="badge bg-success">Active</span></td>
                                            <td class="text-center">
                                                <button href="{{url('edit_staff/')}}" class="btn btn-sm btn-info me-1"><i class="ri-pencil-line"></i></button>
                                                <button href="{{url('delete_staff/')}}" class="btn btn-sm btn-danger"><i class="ri-delete-bin-line"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Jane Smith</td>
                                            <td>jane@example.com</td>
                                            <td>Librarian</td>
                                            <td><span class="badge bg-success">Active</span></td>
                                            <td class="text-center">
                                                <button href="{{url('edit_staff/')}}" class="btn btn-sm btn-info me-1"><i class="ri-pencil-line"></i></button>
                                                <button href="{{url('delete_staff/')}}" class="btn btn-sm btn-danger"><i class="ri-delete-bin-line"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Mike Johnson</td>
                                            <td>mike@example.com</td>
                                            <td>Librarian</td>
                                            <td><span class="badge bg-danger">Inactive</span></td>
                                            <td class="text-center">
                                                <button href="{{url('edit_staff/')}}" class="btn btn-sm btn-info me-1"><i class="ri-pencil-line"></i></button>
                                                <button href="{{url('delete_staff/')}}" class="btn btn-sm btn-danger"><i class="ri-delete-bin-line"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Emily Davis</td>
                                            <td>emily@example.com</td>
                                            <td>Admin</td>
                                            <td><span class="badge bg-success">Active</span></td>
                                            <td class="text-center">
                                                <button href="{{url('edit_staff/')}}" class="btn btn-sm btn-info me-1"><i class="ri-pencil-line"></i></button>
                                                <button href="{{url('delete_staff/')}}" class="btn btn-sm btn-danger"><i class="ri-delete-bin-line"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>Robert Brown</td>
                                            <td>robert@example.com</td>
                                            <td>Librarian</td>
                                            <td><span class="badge bg-success">Active</span></td>
                                            <td class="text-center">
                                                <button href="{{url('edit_staff/')}}" class="btn btn-sm btn-info me-1"><i class="ri-pencil-line"></i></button>
                                                <button href="{{url('delete_staff/')}}" class="btn btn-sm btn-danger"><i class="ri-delete-bin-line"></i></button>
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

<!-- Add Staff Modal -->
<div class="modal fade" id="addStaffModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- bigger modal for more fields -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Staff</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <!-- Personal Info -->
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <!-- <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" required>
                    </div> -->
                    <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" name="phone">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" name="dob">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gender</label>
                        <select class="form-select" name="gender">
                            <option value="">Select</option>
                            <option>Male</option>
                            <option>Female</option>
                            <option>Other</option>
                        </select>
                    </div>

                    <!-- Job Info -->
                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select class="form-select" name="role">
                            <option>Admin</option>
                            <option>Librarian</option>
                            <option>Support Staff</option>
                            <option>Other</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Department</label>
                        <input type="text" class="form-control" name="department">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Joining Date</label>
                        <input type="date" class="form-control" name="joining_date">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Employee ID</label>
                        <input type="text" class="form-control" name="employee_id">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status">
                            <option>Active</option>
                            <option>Inactive</option>
                            <option>On Leave</option>
                        </select>
                    </div>

                    <!-- Address Info -->
                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <textarea class="form-control" name="address" rows="2"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">City</label>
                        <input type="text" class="form-control" name="city">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">State</label>
                        <input type="text" class="form-control" name="state">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">ZIP / Postal Code</label>
                        <input type="text" class="form-control" name="zip">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Country</label>
                        <input type="text" class="form-control" name="country">
                    </div>

                    <!-- Submit -->
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Add Staff</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

<script>
$(document).ready(function() {
    $('#staff-table').DataTable({
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
        language: { searchPlaceholder: 'Search...', sSearch: '' },
        pageLength: 10,
        responsive: true
    });
});
</script>

<script src="{{ asset('js/custom.js') }}"></script>
</body>
