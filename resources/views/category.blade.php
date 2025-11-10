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
                <form>
                    <div class="mb-3">
                        <label for="categoryName" class="form-label fs-14 text-dark">Category Name</label>
                        <input type="text" class="form-control" id="categoryName" placeholder="Enter category name">
                    </div>
                    <button class="btn btn-primary" type="submit"><i class="ri-save-line me-1"></i>Save Category</button>
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
                            <tr>
                                <td>1</td>
                                <td>Science</td>
                                <td>
                                    <div class="hstack gap-2 flex-wrap">
                                        <a href="javascript:void(0);" class="text-info fs-14 lh-1">
                                            <i class="ri-edit-line"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="text-danger fs-14 lh-1">
                                            <i class="ri-delete-bin-5-line"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Commerce</td>
                                <td>
                                    <div class="hstack gap-2 flex-wrap">
                                        <a href="javascript:void(0);" class="text-info fs-14 lh-1">
                                            <i class="ri-edit-line"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="text-danger fs-14 lh-1">
                                            <i class="ri-delete-bin-5-line"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Literature</td>
                                <td>
                                    <div class="hstack gap-2 flex-wrap">
                                        <a href="javascript:void(0);" class="text-info fs-14 lh-1">
                                            <i class="ri-edit-line"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="text-danger fs-14 lh-1">
                                            <i class="ri-delete-bin-5-line"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Technology</td>
                                <td>
                                    <div class="hstack gap-2 flex-wrap">
                                        <a href="javascript:void(0);" class="text-info fs-14 lh-1">
                                            <i class="ri-edit-line"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="text-danger fs-14 lh-1">
                                            <i class="ri-delete-bin-5-line"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
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
 
 
 
 
 
 
 
