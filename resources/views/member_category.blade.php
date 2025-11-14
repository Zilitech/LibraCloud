@include('head')

<body>

   @include('switcher')

    <!-- Loader -->
    <div id="loader">
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
                        <h5 class="page-title fs-21 mb-1">Add Member Category</h5>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Members</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Add Member Category</li>
                            </ol>
                        </nav>
                    </div>
      <div class="mb-xl-0">
    <form method="POST" action="{{ route('membercategory.import') }}" enctype="multipart/form-data">
        @csrf
        <div class="input-group">
            <input type="file" class="form-control" name="csv_file" accept=".csv" required>
            <button class="btn btn-primary" type="submit">
                <i class="ri-upload-2-line me-1"></i> Import CSV
            </button>
                            <a href="{{ url('all_member') }}" class="btn btn-secondary"><i class="ri-arrow-left-line"></i> Back to All Member</a>

        </div>

    </form>

</div>


                </div>
                
                @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

                <!-- Page Content -->
                <div class="row">

                    <!-- LEFT SIDE: Add Member Category Form -->
                    <div class="col-xl-6">
                        <div class="card custom-card">
                            <div class="card-header justify-content-between">
                                <div class="card-title">
                                    Add New Member Category
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('membercategory.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="memberCategoryName" class="form-label fs-14 text-dark">Member Category Name</label>
                                        <input type="text" class="form-control" name="membercategoryname" id="memberCategoryName" placeholder="Enter member category name">
                                    </div>

                                    <div class="mb-3">
                                        <label for="maxBooks" class="form-label fs-14 text-dark">Maximum Books Allowed</label>
                                        <input type="number" class="form-control" name="maxbooks" id="maxBooks" placeholder="Enter maximum books allowed">
                                    </div>

                                    <!-- <div class="mb-3">
                                        <label for="borrowDays" class="form-label fs-14 text-dark">Borrow Duration (Days)</label>
                                        <input type="number" class="form-control" name="borrowdays" id="borrowDays" placeholder="Enter number of days">
                                    </div> -->

                                    <div class="mb-3">
                                        <label for="finePerDay" class="form-label fs-14 text-dark">Fine Per Day (₹)</label>
                                        <input type="number" class="form-control" name="fineperday" id="finePerDay" placeholder="Enter fine amount per day">
                                    </div>

                                    <button class="btn btn-primary" type="submit" name="submit">
                                        <i class="ri-save-line me-1"></i>Save Member Category
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- RIGHT SIDE: Member Category List Table -->
                    <div class="col-xl-6">
                        <div class="card custom-card">
                            <div class="card-header justify-content-between">
                                <div class="card-title">
                                    Member Category List
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table text-nowrap table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">S.No</th>
                                                <th scope="col">Category Name</th>
                                                <th scope="col">Max Books</th>
                                                <th scope="col">Fine/Day (₹)</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($membercategories as $index  => $category)
                                            <tr>
                                                <td>{{$index+1}}</td>
                                                <td>{{$category->membercategoryname}}</td>
                                                <td>{{$category->maxbooks}}</td>
                                                <td>{{$category->fineperday}}</td>
                                                <td>
                                                    <div class="hstack gap-2 flex-wrap">
                                                      <a href="javascript:void(0);" 
   class="text-info fs-14 lh-1 editBtn"
   data-id="{{ $category->id }}"
   data-name="{{ $category->membercategoryname }}"
   data-maxbooks="{{ $category->maxbooks }}"
   data-fineperday="{{ $category->fineperday }}">
    <i class="ri-edit-line"></i>
</a>

                                                        <a href="javascript:void(0);" 
   class="text-danger fs-14 lh-1 deleteBtn" 
   data-id="{{ $category->id }}">
    <i class="ri-delete-bin-5-line"></i>
</a>

                                                    </div>
                                                </td>
                                                @empty
                                                <td colspan="5" class="text-center">No Member Categories Found.</td>
                                            </tr>
      
    @endforelse
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- 🧾 Edit Category Modal -->
<div class="modal fade" id="editMemberCategoryModal" tabindex="-1" aria-labelledby="editMemberCategoryLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('membercategory.update') }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">Edit Member Category</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        

        <div class="modal-body">
          
          <div class="mb-3">
            <label class="form-label">Category ID</label>
            <input type="text" class="form-control" id="editMemberCategoryId" name="id" readonly>
          </div>

          <div class="mb-3">
            <label class="form-label">Category Name</label>
            <input type="text" class="form-control" id="editMemberCategoryName" name="membercategoryname" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Max Books</label>
            <input type="text" class="form-control" id="editMemberCategoryMaxBooks" name="maxbooks" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Fine Per Day</label>
            <input type="text" class="form-control" id="editMemberCategoryFinePerDay" name="fineperday" required>
          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Update Category</button>
        </div>

      </form>
    </div>
  </div>
</div>


<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteMemberCategoryModal" tabindex="-1" aria-labelledby="deleteMemberCategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="deleteMemberCategoryModalLabel">Confirm Deletion</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this member category?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <form id="deleteForm" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">Yes, Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- JS to handle delete -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.deleteBtn');
    const deleteForm = document.getElementById('deleteForm');
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteMemberCategoryModal'));

    deleteButtons.forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
deleteForm.action = "{{ route('membercategory.destroy', ':id') }}".replace(':id', id);
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

    <!-- Scroll To Top -->
    <div class="scrollToTop">
        <span class="arrow"><i class="las la-angle-double-up"></i></span>
    </div>
    <div id="responsive-overlay"></div>

    <!-- Scripts -->
    <script src="{{ asset('libs/@popperjs/core/umd/popper.min.js') }}"></script>
    <script src="{{ asset('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/defaultmenu.min.js') }}"></script>
    <script src="{{ asset('libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('js/sticky.js') }}"></script>
    <script src="{{ asset('libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('js/simplebar.js') }}"></script>
    <script src="{{ asset('libs/@simonwep/pickr/pickr.es5.min.js') }}"></script>
    <script src="{{ asset('js/custom-switcher.min.js') }}"></script>
    <script src="{{ asset('libs/prismjs/prism.js') }}"></script>
    <script src="{{ asset('js/prism-custom.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.editBtn');
    const modal = new bootstrap.Modal(document.getElementById('editMemberCategoryModal'));

    const idField = document.getElementById('editMemberCategoryId');
    const nameField = document.getElementById('editMemberCategoryName');
    const maxBooksField = document.getElementById('editMemberCategoryMaxBooks');
    const finePerDayField = document.getElementById('editMemberCategoryFinePerDay');

    editButtons.forEach(btn => {
        btn.addEventListener('click', function () {

            idField.value = this.dataset.id;
            nameField.value = this.dataset.name;
            maxBooksField.value = this.dataset.maxbooks;
            finePerDayField.value = this.dataset.fineperday;

            modal.show();
        });
    });
});
</script>



</body>
</html>
