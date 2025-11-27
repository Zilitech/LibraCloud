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

                <!-- Page Header -->
                <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                    <div class="my-auto">
                        <h5 class="page-title fs-21 mb-1">Add New Member</h5>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Members</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Add New Member</li>
                            </ol>
                        </nav>
                    </div>
                          <div class="mb-xl-0">
    <form method="POST" action="{{ route('member.import') }}" enctype="multipart/form-data">
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

                <form method="POST" action="{{ route('member.store') }}" enctype="multipart/form-data">
    @csrf
     
                @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Add New Member
                    </div>
                </div>

                <div class="card-body">
                    <div class="row gy-4">

                        <!-- Member ID -->
                        <div class="col-xl-6">
                            <label class="form-label">Member ID:</label>
                            <input type="text" class="form-control" name="memberid" placeholder="Leave blank if auto-generator is enabled.">
                        </div>

                        <!-- Full Name -->
                        <div class="col-xl-6">
                            <label class="form-label">Full Name:</label>
                            <input type="text" class="form-control" name="fullname" placeholder="Enter full name">
                        </div>

                        <!-- Gender -->
                        <div class="col-xl-6">
                            <label class="form-label">Gender:</label>
                            <select class="form-select" name="gender">
                                <option selected disabled>-- Select Gender --</option>
                                <option>Male</option>
                                <option>Female</option>
                                <option>Other</option>
                            </select>
                        </div>

                        <!-- Date of Birth -->
                        <div class="col-xl-6">
                            <label class="form-label">Date of Birth:</label>
                            <input type="date" class="form-control" name="dateofbirth">
                        </div>

                        <!-- Member Type -->
                        <div class="col-xl-6">
                            <label class="form-label">Member Type:</label>
                            <select class="form-select" name="membertype">
                                <option selected disabled>-- Select Type --</option>
                                @foreach($membercategories as $category)
                                    <option value="{{ $category->membercategoryname}}">{{ $category->membercategoryname }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Department / Class -->
                        <div class="col-xl-6">
                            <label class="form-label">Department / Class:</label>
                            <input type="text" class="form-control" name="departmentclass" placeholder="e.g. Computer Science / B.Sc Physics">
                        </div>

                        <!-- Roll No / Employee ID -->
                        <div class="col-xl-6">
                            <label class="form-label">Roll No / Employee ID:</label>
                            <input type="text" class="form-control" name="rollnoemployeeid" placeholder="e.g. PH2021-05">
                        </div>

                        <!-- Year / Semester -->
                        <div class="col-xl-6">
                            <label class="form-label">Year / Semester:</label>
                            <select class="form-select" name="yearsemester">
                                <option selected disabled>-- Select Year/Semester --</option>
                                <option>1st Year / Sem 1</option>
                                <option>2nd Year / Sem 2</option>
                                <option>3rd Year / Sem 3</option>
                                <option>4th Year / Sem 4</option>
                            </select>
                        </div>

                        <!-- Email -->
                        <div class="col-xl-6">
                            <label class="form-label">Email:</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter email address">
                        </div>

                        <!-- Phone -->
                        <div class="col-xl-6">
                            <label class="form-label">Phone:</label>
                            <input type="number" class="form-control" name="phone" placeholder="Enter phone number">
                        </div>

                        <!-- Address -->
                        <div class="col-xl-12">
                            <label class="form-label">Address:</label>
                            <textarea class="form-control" name="address" rows="3" placeholder="Enter full address"></textarea>
                        </div>

                        <!-- City -->
                        <div class="col-xl-4">
                            <label class="form-label">City:</label>
                            <input type="text" class="form-control" name="city">
                        </div>

                        <!-- State -->
                        <div class="col-xl-4">
                            <label class="form-label">State:</label>
                            <input type="text" class="form-control" name="state">
                        </div>

                        <!-- PIN -->
                        <div class="col-xl-4">
                            <label class="form-label">PIN Code:</label>
                            <input type="number" class="form-control" name="pincode">
                        </div>

                        <!-- Joining Date -->
                        <div class="col-xl-6">
                            <label class="form-label">Joining Date:</label>
                            <input type="date" class="form-control" name="joiningdate">
                        </div>

                        <!-- Status -->
                        <div class="col-xl-6">
                            <label class="form-label">Status:</label>
                            <select class="form-select" name="status">
                                <option selected disabled>-- Select Status --</option>
                                <option>Active</option>
                                <option>Inactive</option>
                            </select>
                        </div>

                        <!-- Profile Photo -->
                        <div class="col-xl-6">
                            <label class="form-label">Profile Photo:</label>
                            <input class="form-control" name="profilephoto" type="file" accept="image/*">
                        </div>

                        <!-- Library Card Issued -->
                        <div class="col-xl-6">
                            <label class="form-label">Library Card Issued:</label>
                            <div class="form-check form-switch mt-2">
                                <input class="form-check-input" type="checkbox" name="cardIssued" value="1">
                                <label class="form-check-label">Yes</label>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Footer -->
                <div class="card-footer text-end">
                    <button type="reset" class="btn btn-secondary">Reset</button>
                    <button type="submit" class="btn btn-primary">Save Member</button>
                </div>

            </div>
        </div>
    </div>

</form>


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

    <!-- JS Files -->
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

</body>
</html>
