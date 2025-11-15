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

<div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
    <div class="my-auto">
        <h5 class="page-title fs-21 mb-1">All Members</h5>
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Members</a></li>
                <li class="breadcrumb-item active" aria-current="page">All Members</li>
            </ol>
        </nav>
    </div>

    <div class="mt-3 mt-md-0">
        <a href="{{ url('add_member') }}" class="btn btn-primary">
            <i class="ri-add-line me-1"></i> Add New Member
        </a>
    </div>
</div>
 @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

<div class="card custom-card">
    <div class="card-header justify-content-between align-items-center">
        <div class="card-title">Members List</div>
        <div>
<form method="GET" action="{{ url('members') }}" class="d-flex align-items-center">

    <!-- Search -->
    <input type="text" 
           name="search" 
           value="{{ request('search') }}"
           class="form-control form-control-sm d-inline-block w-auto me-2" 
           placeholder="Search Member...">

    <!-- Filter Dropdown -->
    <select name="filter" class="form-select form-select-sm d-inline-block w-auto" onchange="this.form.submit()">
        
        <option value="All">All</option>

        <!-- Dynamic Member Categories -->
        @foreach($membercategories as $category)
            <option value="{{ $category->membercategoryname }}"
                {{ request('filter') == $category->membercategoryname ? 'selected' : '' }}>
                {{ $category->membercategoryname }}
            </option>
        @endforeach

        <option value="Active" {{ request('filter')=='Active'?'selected':'' }}>Active</option>
        <option value="Inactive" {{ request('filter')=='Inactive'?'selected':'' }}>Inactive</option>

    </select>

</form>


        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-bordered text-nowrap mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th>SI</th>
                        <th>Member ID</th>
                        <th>Full Name</th>
                        <th>Category</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Department / Class</th>
                        <th>Books Issued</th>
                        <th>Fines (₹)</th>
                        <th>Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
<tbody>
@forelse($members as $index => $member)
    <tr>
        <td>{{ $index + 1 }}</td>
        <td><span class="fw-semibold">{{ $member->memberid }}</span></td>
        <td>{{ $member->fullname }}</td>
        <td><span class="badge bg-primary-transparent text-primary">{{ $member->membertype }}</span></td>
        <td>{{ $member->email }}</td>
        <td>{{ $member->phone }}</td>
        <td>{{ $member->departmentclass }}</td>
        <td>{{ $member->cardIssued }}</td>
        <td>₹0</td>
        <td><span class="badge bg-success">{{ $member->status }}</span></td>
        <td class="text-center">
<!-- Edit Member Action -->
<a href="#"
   class="editMemberBtn text-info"
   data-id="{{ $member->id }}"
   data-member='@json($member)'>
   <i class="ri-edit-line fs-16"></i>
</a>


<a href="#" 
   class="deleteMemberBtn text-danger"
   data-id="{{ $member->id }}"
   data-name="{{ $member->fullname }}">
   <i class="ri-delete-bin-line fs-16"></i>
</a>

            <a href="#" class="me-2 text-primary"><i class="ri-eye-line fs-16"></i></a>
            <a href="#" class="text-success"><i class="ri-id-card-line fs-16"></i></a>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="11" class="text-center">No members found</td>
    </tr>

@endforelse
</tbody>


            </table>
        </div>
    </div>

    <div class="card-footer text-end">
        <nav>
            <ul class="pagination justify-content-end mb-0">
                <li class="page-item disabled"><a class="page-link" href="#">Prev</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </nav>
    </div>
</div>


<!-- Edit Member Modal -->
<div class="modal fade" id="editMemberModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <form id="editMemberForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Edit Member</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">

                        <input type="hidden" id="editMemberId">

                         <div class="col-md-6 d-flex align-items-center">
                            <label class="form-label me-2" style="width:120px;">ID:</label>
                            <input type="text" class="form-control" id="editMemberId" placeholder="Hidden data" readonly>
                        </div>

                        <!-- Member ID -->
                        <div class="col-md-6">
                            <label class="form-label">Member ID</label>
                            <input type="text" id="edit_memberid" name="memberid" class="form-control">
                        </div>

                        <!-- Full Name -->
                        <div class="col-md-6">
                            <label class="form-label">Full Name</label>
                            <input type="text" id="edit_fullname" name="fullname" class="form-control" required>
                        </div>

                        <!-- Gender -->
                        <div class="col-md-6">
                            <label class="form-label">Gender</label>
                            <select id="edit_gender" name="gender" class="form-select">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>

                        <!-- DOB -->
                        <div class="col-md-6">
                            <label class="form-label">Date of Birth</label>
                            <input type="date" id="edit_dateofbirth" name="dateofbirth" class="form-control">
                        </div>

                        <!-- Member Type -->
                        <div class="col-md-6">
                            <label class="form-label">Member Type</label>
                            <select id="edit_membertype" name="membertype" class="form-select">
                                @foreach($membercategories as $category)
                                    <option value="{{ $category->membercategoryname }}">{{ $category->membercategoryname }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Department -->
                        <div class="col-md-6">
                            <label class="form-label">Department/Class</label>
                            <input type="text" id="edit_departmentclass" name="departmentclass" class="form-control">
                        </div>

                        <!-- Roll No -->
                        <div class="col-md-6">
                            <label class="form-label">Roll No / Employee ID</label>
                            <input type="text" id="edit_rollnoemployeeid" name="rollnoemployeeid" class="form-control">
                        </div>

                        <!-- Year Semester -->
                        <div class="col-md-6">
                            <label class="form-label">Year / Semester</label>
                            <input type="text" id="edit_yearsemester" name="yearsemester" class="form-control">
                        </div>

                        <!-- Email -->
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" id="edit_email" name="email" class="form-control">
                        </div>

                        <!-- Phone -->
                        <div class="col-md-6">
                            <label class="form-label">Phone</label>
                            <input type="text" id="edit_phone" name="phone" class="form-control">
                        </div>

                        <!-- Address -->
                        <div class="col-12">
                            <label class="form-label">Address</label>
                            <textarea id="edit_address" name="address" class="form-control"></textarea>
                        </div>

                        <!-- City -->
                        <div class="col-md-4">
                            <label class="form-label">City</label>
                            <input type="text" id="edit_city" name="city" class="form-control">
                        </div>

                        <!-- State -->
                        <div class="col-md-4">
                            <label class="form-label">State</label>
                            <input type="text" id="edit_state" name="state" class="form-control">
                        </div>

                        <!-- Pincode -->
                        <div class="col-md-4">
                            <label class="form-label">Pincode</label>
                            <input type="text" id="edit_pincode" name="pincode" class="form-control">
                        </div>

                        <!-- Joining Date -->
                        <div class="col-md-6">
                            <label class="form-label">Joining Date</label>
                            <input type="date" id="edit_joiningdate" name="joiningdate" class="form-control">
                        </div>

                        <!-- Status -->
                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select id="edit_status" name="status" class="form-select">
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>

                        <!-- Photo -->
                        <div class="col-md-6">
                            <label class="form-label">Profile Photo</label>
                            <input type="file" id="edit_profilephoto" name="profilephoto" class="form-control">
                        </div>

                        <!-- Card Issued -->
                        <div class="col-md-6 mt-4">
                            <label class="form-label">Card Issued</label>
                            <input type="checkbox" id="edit_cardIssued" name="cardIssued" value="1">
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary">Update Member</button>
                </div>

            </form>

        </div>
    </div>
</div>

<!-- Delete Member Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title">Confirm Deletion</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body" id="deleteMessage">
        Are you sure you want to delete this member?
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <form id="deleteForm" method="POST">
          @csrf
          @method('DELETE')
          <button class="btn btn-danger">Yes, Delete</button>
        </form>
      </div>

    </div>
  </div>
</div>



<script>
document.addEventListener("DOMContentLoaded", () => {

    const deleteButtons = document.querySelectorAll('.deleteMemberBtn');
    const deleteForm = document.getElementById('deleteForm');
    const deleteMessage = document.getElementById('deleteMessage');
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));

    deleteButtons.forEach(btn => {
        btn.addEventListener('click', function () {

            let id = this.getAttribute('data-id');
            let name = this.getAttribute('data-name');

            deleteForm.action = `/members/${id}`;
            deleteMessage.innerHTML = `Are you sure you want to delete <b>${name}</b>?`;

            deleteModal.show();
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

    
 </div>
    
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    
    
    <!-- Scroll To Top -->
    <div class="scrollToTop">
        <span class="arrow"><i class="las la-angle-double-up"></i></span>
    </div>
    <div id="responsive-overlay"></div>
    <!-- Scroll To Top -->

    <!-- Popper JS -->
    <script src="{{ asset('libs/@popperjs/core/umd/popper.min.js') }}"></script>

    <!-- Bootstrap JS -->
    <script src="{{ asset('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Defaultmenu JS -->
    <script src="{{ asset('js/defaultmenu.min.js') }}"></script>

    <!-- Node Waves JS-->
    <script src="{{ asset('libs/node-waves/waves.min.js') }}"></script>

    <!-- Sticky JS -->
    <script src="{{ asset('js/sticky.js') }}"></script>

    <!-- Simplebar JS -->
    <script src="{{ asset('libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('js/simplebar.js') }}"></script>

    <!-- Color Picker JS -->
    <script src="{{ asset('libs/@simonwep/pickr/pickr.es5.min.js') }}"></script>


    
    <!-- Custom-Switcher JS -->
    <script src="{{ asset('js/custom-switcher.min.js') }}"></script>

    <!-- Jquery Cdn -->

    <!-- Datatables Cdn -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>


    <!-- Internal Datatables JS -->
    <script src="{{ asset('js/datatables.js') }}"></script>
    
    <!-- Custom JS -->
    <script src="{{ asset('js/custom.js') }}"></script>


<script>
document.addEventListener('DOMContentLoaded', function () {

    const editMemberButtons = document.querySelectorAll('.editMemberBtn');
    const editMemberModal = new bootstrap.Modal(document.getElementById('editMemberModal'));
    const editMemberForm = document.getElementById('editMemberForm');

    editMemberButtons.forEach(button => {
        button.addEventListener('click', function () {

            const memberData = JSON.parse(this.getAttribute('data-member'));

            // Set form action
            editMemberForm.action = `/members/${memberData.id}`;

            // Hidden ID field
            document.getElementById('editMemberId').value = memberData.id;

            // All form fields
            document.getElementById('edit_memberid').value = memberData.memberid ?? '';
            document.getElementById('edit_fullname').value = memberData.fullname ?? '';
            document.getElementById('edit_gender').value = memberData.gender ?? '';
            document.getElementById('edit_dateofbirth').value = memberData.dateofbirth ?? '';
            document.getElementById('edit_membertype').value = memberData.membertype ?? '';
            document.getElementById('edit_departmentclass').value = memberData.departmentclass ?? '';
            document.getElementById('edit_rollnoemployeeid').value = memberData.rollnoemployeeid ?? '';
            document.getElementById('edit_yearsemester').value = memberData.yearsemester ?? '';
            document.getElementById('edit_email').value = memberData.email ?? '';
            document.getElementById('edit_phone').value = memberData.phone ?? '';
            document.getElementById('edit_address').value = memberData.address ?? '';
            document.getElementById('edit_city').value = memberData.city ?? '';
            document.getElementById('edit_state').value = memberData.state ?? '';
            document.getElementById('edit_pincode').value = memberData.pincode ?? '';
            document.getElementById('edit_joiningdate').value = memberData.joiningdate ?? '';
            document.getElementById('edit_status').value = memberData.status ?? '';

            // Checkbox (convert 1/0, true/false)
            document.getElementById('edit_cardIssued').checked =
                memberData.cardIssued == "1" || memberData.cardIssued == 1;

            // SHOW the modal
            editMemberModal.show();
        });
    });

});
</script>





</body>

</html>
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
