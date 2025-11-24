@include('head')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">

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
                    <h5 class="page-title fs-21 mb-1">Admin / Roles & Permissions</h5>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Settings</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Roles & Permissions</li>
                        </ol>
                    </nav>
                </div>
                <div class="d-flex my-xl-auto right-content align-items-center">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRoleModal">
                        <i class="ri-add-line me-1"></i> Add Role
                    </button>
                </div>
            </div>
            <!-- Page Header End -->

            <div class="alert alert-solid-secondary alert-dismissible fs-15 fade show mb-4">
                Manage <strong class="text-fixed-black">roles and permissions</strong>. Assign what each role can do in the library system.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="bi bi-x"></i></button>
            </div>

            <!-- Roles Table -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="card-header">
                            <div class="card-title">Roles List</div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="roles-table" class="table table-bordered text-nowrap w-100">
    <thead>
        <tr>
            <th>ID</th>
            <th>Role Name</th>
            <th>Permissions</th>
            <th class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($roles as $role)
            <tr>
                <td>{{ $role->id }}</td>
                <td>{{ $role->name }}</td>
                <td>
                    @if($role->permissions->count() > 0)
                        @foreach($role->permissions as $permission)
                            <span class="badge {{ $role->id == 1 ? 'bg-primary' : 'bg-success' }} mb-1">{{ $permission->name }}</span>
                        @endforeach
                    @else
                        <span class="text-muted">No Permissions</span>
                    @endif
                </td>
                <td class="text-center">
                    <!-- Edit Button -->
                    <button class="btn btn-sm btn-info me-1" data-bs-toggle="modal" data-bs-target="#editRoleModal{{ $role->id }}">
                        <i class="ri-pencil-line"></i>
                    </button>

                    <!-- Delete Button -->
                    <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete this role?')">
                            <i class="ri-delete-bin-line"></i>
                        </button>
                    </form>
                </td>
            </tr>

            <!-- Optional: Edit Modal for each role -->
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
</div>

<!-- Add Role Modal -->
<div class="modal fade" id="addRoleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('roles.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label class="form-label">Role Name</label>
        <input type="text" class="form-control" name="role_name" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Permissions</label>
        <div class="row">
            <div class="col-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="permissions[]" value="manage_books" id="permBooks">
                    <label class="form-check-label" for="permBooks">Add/Edit Books</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="permissions[]" value="manage_categories" id="permCategories">
                    <label class="form-check-label" for="permCategories">Manage Categories</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="permissions[]" value="manage_authors" id="permAuthors">
                    <label class="form-check-label" for="permAuthors">Manage Authors</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="permissions[]" value="manage_inventory" id="permInventory">
                    <label class="form-check-label" for="permInventory">Inventory Management</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="permissions[]" value="issue_return" id="permIssueReturn">
                    <label class="form-check-label" for="permIssueReturn">Issue / Return Books</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="permissions[]" value="manage_members" id="permMembers">
                    <label class="form-check-label" for="permMembers">Manage Members</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="permissions[]" value="view_reports" id="permReports">
                    <label class="form-check-label" for="permReports">View Reports</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="permissions[]" value="fine_management" id="permFines">
                    <label class="form-check-label" for="permFines">Fine Management</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="permissions[]" value="library_settings" id="permSettings">
                    <label class="form-check-label" for="permSettings">Library Settings</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="permissions[]" value="user_management" id="permUsers">
                    <label class="form-check-label" for="permUsers">User Management</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="permissions[]" value="barcode_management" id="permBarcode">
                    <label class="form-check-label" for="permBarcode">Barcode / QR Management</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="permissions[]" value="ebook_management" id="permEbooks">
                    <label class="form-check-label" for="permEbooks">E-Book Management</label>
                </div>
            </div>
        </div>
    </div>

    <div class="text-end">
        <button type="submit" class="btn btn-primary">Add Role</button>
    </div>
</form>

            </div>
        </div>
    </div>
</div>


<!-- Edit Role Modal for Admin -->
<div class="modal fade" id="editRoleModal1" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Role: Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">Role Name</label>
                        <input type="text" class="form-control" name="role_name" value="Admin" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Permissions</label>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="manage_books" id="editPermBooks1" checked>
                                    <label class="form-check-label" for="editPermBooks1">Add/Edit Books</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="manage_categories" id="editPermCategories1" checked>
                                    <label class="form-check-label" for="editPermCategories1">Manage Categories</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="manage_authors" id="editPermAuthors1" checked>
                                    <label class="form-check-label" for="editPermAuthors1">Manage Authors</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="manage_inventory" id="editPermInventory1" checked>
                                    <label class="form-check-label" for="editPermInventory1">Inventory Management</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="issue_return" id="editPermIssueReturn1" checked>
                                    <label class="form-check-label" for="editPermIssueReturn1">Issue / Return Books</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="manage_members" id="editPermMembers1" checked>
                                    <label class="form-check-label" for="editPermMembers1">Manage Members</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="view_reports" id="editPermReports1" checked>
                                    <label class="form-check-label" for="editPermReports1">View Reports</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="fine_management" id="editPermFines1" checked>
                                    <label class="form-check-label" for="editPermFines1">Fine Management</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="library_settings" id="editPermSettings1" checked>
                                    <label class="form-check-label" for="editPermSettings1">Library Settings</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="user_management" id="editPermUsers1" checked>
                                    <label class="form-check-label" for="editPermUsers1">User Management</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="barcode_management" id="editPermBarcode1" checked>
                                    <label class="form-check-label" for="editPermBarcode1">Barcode / QR Management</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="ebook_management" id="editPermEbooks1" checked>
                                    <label class="form-check-label" for="editPermEbooks1">E-Book Management</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Update Role</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Role Modal for Librarian -->
<div class="modal fade" id="editRoleModal2" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Role: Librarian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">Role Name</label>
                        <input type="text" class="form-control" name="role_name" value="Librarian" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Permissions</label>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="manage_books" id="editPermBooks2" checked>
                                    <label class="form-check-label" for="editPermBooks2">Add/Edit Books</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="manage_categories" id="editPermCategories2">
                                    <label class="form-check-label" for="editPermCategories2">Manage Categories</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="manage_authors" id="editPermAuthors2">
                                    <label class="form-check-label" for="editPermAuthors2">Manage Authors</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="manage_inventory" id="editPermInventory2">
                                    <label class="form-check-label" for="editPermInventory2">Inventory Management</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="issue_return" id="editPermIssueReturn2" checked>
                                    <label class="form-check-label" for="editPermIssueReturn2">Issue / Return Books</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="manage_members" id="editPermMembers2">
                                    <label class="form-check-label" for="editPermMembers2">Manage Members</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="view_reports" id="editPermReports2" checked>
                                    <label class="form-check-label" for="editPermReports2">View Reports</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="fine_management" id="editPermFines2">
                                    <label class="form-check-label" for="editPermFines2">Fine Management</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="library_settings" id="editPermSettings2">
                                    <label class="form-check-label" for="editPermSettings2">Library Settings</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="user_management" id="editPermUsers2">
                                    <label class="form-check-label" for="editPermUsers2">User Management</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="barcode_management" id="editPermBarcode2">
                                    <label class="form-check-label" for="editPermBarcode2">Barcode / QR Management</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="ebook_management" id="editPermEbooks2">
                                    <label class="form-check-label" for="editPermEbooks2">E-Book Management</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Update Role</button>
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
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>

<script>
$(document).ready(function() {
    $('#roles-table').DataTable({
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
