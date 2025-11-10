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

<div class="card custom-card">
    <div class="card-header justify-content-between align-items-center">
        <div class="card-title">Members List</div>
        <div>
            <input type="text" class="form-control form-control-sm d-inline-block w-auto me-2" placeholder="Search Member...">
            <select class="form-select form-select-sm d-inline-block w-auto">
                <option>All</option>
                <option>Student</option>
                <option>Faculty</option>
                <option>Guest</option>
                <option>Active</option>
                <option>Inactive</option>
            </select>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-bordered text-nowrap mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
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
    <tr>
        <td>1</td>
        <td><span class="fw-semibold">MEM001</span></td>
        <td>Ananya Rao</td>
        <td><span class="badge bg-primary-transparent text-primary">Student</span></td>
        <td>ananya.rao@college.edu</td>
        <td>9876543210</td>
        <td>B.Sc Physics</td>
        <td>2</td>
        <td>₹0</td>
        <td><span class="badge bg-success">Active</span></td>
        <td class="text-center">
            <a href="javascript:void(0);" class="me-2 text-info"><i class="ri-edit-line fs-16"></i></a>
            <a href="javascript:void(0);" class="me-2 text-danger"><i class="ri-delete-bin-5-line fs-16"></i></a>
            <a href="javascript:void(0);" class="me-2 text-primary"><i class="ri-eye-line fs-16"></i></a>
            <a href="javascript:void(0);" class="text-success"><i class="ri-id-card-line fs-16"></i></a>
        </td>
    </tr>

    <tr>
        <td>2</td>
        <td><span class="fw-semibold">MEM002</span></td>
        <td>Prof. K. Sharma</td>
        <td><span class="badge bg-secondary-transparent text-secondary">Faculty</span></td>
        <td>k.sharma@college.edu</td>
        <td>9823456712</td>
        <td>Chemistry Dept</td>
        <td>1</td>
        <td>₹20</td>
        <td><span class="badge bg-warning text-dark">Active</span></td>
        <td class="text-center">
            <a href="javascript:void(0);" class="me-2 text-info"><i class="ri-edit-line fs-16"></i></a>
            <a href="javascript:void(0);" class="me-2 text-danger"><i class="ri-delete-bin-5-line fs-16"></i></a>
            <a href="javascript:void(0);" class="me-2 text-primary"><i class="ri-eye-line fs-16"></i></a>
            <a href="javascript:void(0);" class="text-success"><i class="ri-id-card-line fs-16"></i></a>
        </td>
    </tr>

    <tr>
        <td>3</td>
        <td><span class="fw-semibold">MEM003</span></td>
        <td>Rajesh Kumar</td>
        <td><span class="badge bg-info-transparent text-info">Guest</span></td>
        <td>rajeshk@gmail.com</td>
        <td>9001234567</td>
        <td>—</td>
        <td>0</td>
        <td>₹0</td>
        <td><span class="badge bg-danger">Inactive</span></td>
        <td class="text-center">
            <a href="javascript:void(0);" class="me-2 text-info"><i class="ri-edit-line fs-16"></i></a>
            <a href="javascript:void(0);" class="me-2 text-danger"><i class="ri-delete-bin-5-line fs-16"></i></a>
            <a href="javascript:void(0);" class="me-2 text-primary"><i class="ri-eye-line fs-16"></i></a>
            <a href="javascript:void(0);" class="text-success"><i class="ri-id-card-line fs-16"></i></a>
        </td>
    </tr>

    <tr>
        <td>4</td>
        <td><span class="fw-semibold">MEM004</span></td>
        <td>Neha Patil</td>
        <td><span class="badge bg-primary-transparent text-primary">Student</span></td>
        <td>neha.patil@college.edu</td>
        <td>9912345678</td>
        <td>B.A English</td>
        <td>3</td>
        <td>₹10</td>
        <td><span class="badge bg-success">Active</span></td>
        <td class="text-center">
            <a href="javascript:void(0);" class="me-2 text-info"><i class="ri-edit-line fs-16"></i></a>
            <a href="javascript:void(0);" class="me-2 text-danger"><i class="ri-delete-bin-5-line fs-16"></i></a>
            <a href="javascript:void(0);" class="me-2 text-primary"><i class="ri-eye-line fs-16"></i></a>
            <a href="javascript:void(0);" class="text-success"><i class="ri-id-card-line fs-16"></i></a>
        </td>
    </tr>

    <tr>
        <td>5</td>
        <td><span class="fw-semibold">MEM005</span></td>
        <td>Dr. R. Mehta</td>
        <td><span class="badge bg-secondary-transparent text-secondary">Faculty</span></td>
        <td>r.mehta@college.edu</td>
        <td>9876501234</td>
        <td>Mathematics Dept</td>
        <td>4</td>
        <td>₹0</td>
        <td><span class="badge bg-success">Active</span></td>
        <td class="text-center">
            <a href="javascript:void(0);" class="me-2 text-info"><i class="ri-edit-line fs-16"></i></a>
            <a href="javascript:void(0);" class="me-2 text-danger"><i class="ri-delete-bin-5-line fs-16"></i></a>
            <a href="javascript:void(0);" class="me-2 text-primary"><i class="ri-eye-line fs-16"></i></a>
            <a href="javascript:void(0);" class="text-success"><i class="ri-id-card-line fs-16"></i></a>
        </td>
    </tr>

    <tr>
        <td>6</td>
        <td><span class="fw-semibold">MEM006</span></td>
        <td>Sunil Das</td>
        <td><span class="badge bg-info-transparent text-info">Guest</span></td>
        <td>sunildas@gmail.com</td>
        <td>9123456789</td>
        <td>—</td>
        <td>1</td>
        <td>₹0</td>
        <td><span class="badge bg-warning text-dark">Active</span></td>
        <td class="text-center">
            <a href="javascript:void(0);" class="me-2 text-info"><i class="ri-edit-line fs-16"></i></a>
            <a href="javascript:void(0);" class="me-2 text-danger"><i class="ri-delete-bin-5-line fs-16"></i></a>
            <a href="javascript:void(0);" class="me-2 text-primary"><i class="ri-eye-line fs-16"></i></a>
            <a href="javascript:void(0);" class="text-success"><i class="ri-id-card-line fs-16"></i></a>
        </td>
    </tr>

    <tr>
        <td>7</td>
        <td><span class="fw-semibold">MEM007</span></td>
        <td>Priya Nair</td>
        <td><span class="badge bg-primary-transparent text-primary">Student</span></td>
        <td>priya.nair@college.edu</td>
        <td>9789012345</td>
        <td>B.Com</td>
        <td>0</td>
        <td>₹0</td>
        <td><span class="badge bg-success">Active</span></td>
        <td class="text-center">
            <a href="javascript:void(0);" class="me-2 text-info"><i class="ri-edit-line fs-16"></i></a>
            <a href="javascript:void(0);" class="me-2 text-danger"><i class="ri-delete-bin-5-line fs-16"></i></a>
            <a href="javascript:void(0);" class="me-2 text-primary"><i class="ri-eye-line fs-16"></i></a>
            <a href="javascript:void(0);" class="text-success"><i class="ri-id-card-line fs-16"></i></a>
        </td>
    </tr>

    <tr>
        <td>8</td>
        <td><span class="fw-semibold">MEM008</span></td>
        <td>Prof. A. George</td>
        <td><span class="badge bg-secondary-transparent text-secondary">Faculty</span></td>
        <td>a.george@college.edu</td>
        <td>9812340099</td>
        <td>Computer Science</td>
        <td>5</td>
        <td>₹30</td>
        <td><span class="badge bg-success">Active</span></td>
        <td class="text-center">
            <a href="javascript:void(0);" class="me-2 text-info"><i class="ri-edit-line fs-16"></i></a>
            <a href="javascript:void(0);" class="me-2 text-danger"><i class="ri-delete-bin-5-line fs-16"></i></a>
            <a href="javascript:void(0);" class="me-2 text-primary"><i class="ri-eye-line fs-16"></i></a>
            <a href="javascript:void(0);" class="text-success"><i class="ri-id-card-line fs-16"></i></a>
        </td>
    </tr>

    <tr>
        <td>9</td>
        <td><span class="fw-semibold">MEM009</span></td>
        <td>Manoj Tiwari</td>
        <td><span class="badge bg-primary-transparent text-primary">Student</span></td>
        <td>manoj.tiwari@college.edu</td>
        <td>9798123456</td>
        <td>B.Sc Chemistry</td>
        <td>1</td>
        <td>₹0</td>
        <td><span class="badge bg-success">Active</span></td>
        <td class="text-center">
            <a href="javascript:void(0);" class="me-2 text-info"><i class="ri-edit-line fs-16"></i></a>
            <a href="javascript:void(0);" class="me-2 text-danger"><i class="ri-delete-bin-5-line fs-16"></i></a>
            <a href="javascript:void(0);" class="me-2 text-primary"><i class="ri-eye-line fs-16"></i></a>
            <a href="javascript:void(0);" class="text-success"><i class="ri-id-card-line fs-16"></i></a>
        </td>
    </tr>

    <tr>
        <td>10</td>
        <td><span class="fw-semibold">MEM010</span></td>
        <td>Vikram Joshi</td>
        <td><span class="badge bg-info-transparent text-info">Guest</span></td>
        <td>vikramjoshi@gmail.com</td>
        <td>9087654321</td>
        <td>—</td>
        <td>0</td>
        <td>₹0</td>
        <td><span class="badge bg-danger">Inactive</span></td>
        <td class="text-center">
            <a href="javascript:void(0);" class="me-2 text-info"><i class="ri-edit-line fs-16"></i></a>
            <a href="javascript:void(0);" class="me-2 text-danger"><i class="ri-delete-bin-5-line fs-16"></i></a>
            <a href="javascript:void(0);" class="me-2 text-primary"><i class="ri-eye-line fs-16"></i></a>
            <a href="javascript:void(0);" class="text-success"><i class="ri-id-card-line fs-16"></i></a>
        </td>
    </tr>
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


</body>

</html>
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
