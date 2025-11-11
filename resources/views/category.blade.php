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
                    <h5 class="page-title fs-21 mb-1">Add New Category</h5>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Books</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add New Category</li>
                        </ol>
                    </nav>
                </div>
            </div>
                <!-- Page Header -->
<div class="row">
    <!-- LEFT SIDE: Add Category Form -->
    <div class="col-xl-6">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">
                    Add New Category
                </div>

            </div>
            <div class="card-body">
                   @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

          <form action="{{ route('category.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="categoryName" class="form-label fs-14 text-dark">Category Name</label>
        <input type="text" class="form-control" id="categoryName"
               name="category_name"
               placeholder="Enter category name" required>
    </div>
    <button class="btn btn-primary" type="submit">
        <i class="ri-save-line me-1"></i>Save Category
    </button>
</form>

            </div>

            <div class="card-footer d-none border-top-0">
                <!-- Prism Code -->
                <pre class="language-html"><code class="language-html">&lt;form&gt;
    &lt;div class="mb-3"&gt;
        &lt;label for="categoryName" class="form-label fs-14 text-dark"&gt;Category Name&lt;/label&gt;
        &lt;input type="text" class="form-control" id="categoryName" placeholder="Enter category name"&gt;
    &lt;/div&gt;
    &lt;button class="btn btn-primary" type="submit"&gt;&lt;i class="ri-save-line me-1"&gt;&lt;/i&gt;Save Category&lt;/button&gt;
&lt;/form&gt;</code></pre>
                <!-- Prism Code -->
            </div>
        </div>
    </div>

    <!-- RIGHT SIDE: Category List Table -->
    <div class="col-xl-6">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">
                    Category List
                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table text-nowrap table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">S.No</th>
                                <th scope="col">Category Name</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $key => $cat)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $cat->category_name }}</td>
                                <td>
                                    <div class="hstack gap-2 flex-wrap">
                                          <a href="javascript:void(0);" 
                       class="text-info fs-14 lh-1 editBtn"
                       data-id="{{ $cat->id }}"
                       data-name="{{ $cat->category_name }}">
                        <i class="ri-edit-line"></i>
                    </a>
                                       <a href="javascript:void(0);" 
   class="text-danger fs-14 lh-1" 
   onclick="confirmDelete({{ $cat->id }})">
   <i class="ri-delete-bin-5-line"></i>
</a>

                                    </div>
                                </td>
                            </tr>
                           
                             @empty
        <tr>
            <td colspan="3" class="text-center text-muted">No categories found</td>
        </tr>
                                @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer d-none border-top-0">
                <!-- Prism Code -->
                <pre class="language-html"><code class="language-html">&lt;table class="table text-nowrap table-bordered"&gt;
    &lt;thead&gt;
        &lt;tr&gt;
            &lt;th&gt;S.No&lt;/th&gt;
            &lt;th&gt;Category Name&lt;/th&gt;
            &lt;th&gt;Action&lt;/th&gt;
        &lt;/tr&gt;
    &lt;/thead&gt;
&lt;/table&gt;</code></pre>
                <!-- Prism Code -->
            </div>
        </div>
    </div>
</div>

<!-- 🧾 Edit Category Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('category.update') }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="editCategoryLabel">Edit Category</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Category ID</label>
            <input type="text" class="form-control" id="editCategoryId" name="id" readonly>
          </div>
          <div class="mb-3">
            <label class="form-label">Category Name</label>
            <input type="text" class="form-control" id="editCategoryName" name="category_name" required>
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
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this category?
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
    function confirmDelete(id) {
        const form = document.getElementById('deleteForm');
        form.action = '/category/' + id; // Set dynamic route
        const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
        modal.show();
    }
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

    <!-- Prism JS -->
    <script src="{{ asset('libs/prismjs/prism.js') }}"></script>
    <script src="{{ asset('js/prism-custom.js') }}"></script>

    <!-- Custom JS -->
    <script src="{{ asset('js/custom.js') }}"></script>

    <script>
document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.editBtn');
    const modal = new bootstrap.Modal(document.getElementById('editCategoryModal'));
    const idField = document.getElementById('editCategoryId');
    const nameField = document.getElementById('editCategoryName');

    editButtons.forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');

            idField.value = id;
            nameField.value = name;

            modal.show();
        });
    });
});
</script>


</body>

</html> 
 
 
 
 
 
 
 
