                @include('head')
                <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
 <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">


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
        <h5 class="page-title fs-21 mb-1">Authors List</h5>
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Books</a></li>
                <li class="breadcrumb-item active" aria-current="page">Authors</li>
            </ol>
        </nav>
    </div>

    <div class="d-flex my-xl-auto right-content align-items-center">
        <div class="pe-1 mb-xl-0">
            <button type="button" class="btn btn-info btn-icon me-2 btn-b"><i class="mdi mdi-filter-variant"></i></button>
        </div>
        <div class="pe-1 mb-xl-0">
            <button type="button" class="btn btn-danger btn-icon me-2"><i class="mdi mdi-star"></i></button>
        </div>
        <div class="pe-1 mb-xl-0">
            <button type="button" class="btn btn-warning btn-icon me-2"><i class="mdi mdi-refresh"></i></button>
        </div>
        <div class="mb-xl-0">
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuDate" data-bs-toggle="dropdown" aria-expanded="false">
                    14 Aug 2019
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuDate">
                    <li><a class="dropdown-item" href="javascript:void(0);">2015</a></li>
                    <li><a class="dropdown-item" href="javascript:void(0);">2016</a></li>
                    <li><a class="dropdown-item" href="javascript:void(0);">2017</a></li>
                    <li><a class="dropdown-item" href="javascript:void(0);">2018</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Page Header Close -->

<!-- Alert -->
<div class="alert alert-solid-secondary alert-dismissible fs-15 fade show mb-4">
    All <strong class="text-fixed-black">Authors</strong> data is displayed on this page using <strong class="text-fixed-black">jquery</strong> DataTables.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="bi bi-x"></i></button>
</div>

<!-- Start:: row -->
<div class="row">
        <div class="col-xl-6">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">
                    Add New Author
                </div>

            </div>
            <div class="card-body">
                <form>
                    <div class="mb-3">
                        <label for="authorName" class="form-label fs-14 text-dark">Author Name</label>
                        <input type="text" class="form-control" id="authorName" placeholder="Enter author name">
                    </div>
                    <button class="btn btn-primary" type="submit"><i class="ri-save-line me-1"></i>Save Author</button>
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
    <div class="col-xl-6">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">Authors List</div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="file-export" class="table table-bordered text-nowrap w-100">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Author Name</th>
                                <th>Books Count</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Dr. B. Kumar</td>
                                <td>12</td>
                                <td><span class="badge bg-success-transparent">Active</span></td>
                                <td>
                                    <div class="hstack gap-2 flex-wrap">
                                        <a href="javascript:void(0);" class="text-info fs-14 lh-1"><i class="ri-edit-line"></i></a>
                                        <a href="javascript:void(0);" class="text-danger fs-14 lh-1"><i class="ri-delete-bin-5-line"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>R. K. Narayan</td>
                                <td>8</td>
                                <td><span class="badge bg-success-transparent">Active</span></td>
                                <td>
                                    <div class="hstack gap-2 flex-wrap">
                                        <a href="javascript:void(0);" class="text-info fs-14 lh-1"><i class="ri-edit-line"></i></a>
                                        <a href="javascript:void(0);" class="text-danger fs-14 lh-1"><i class="ri-delete-bin-5-line"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>A. P. J. Abdul Kalam</td>
                                <td>5</td>
                                <td><span class="badge bg-success-transparent">Active</span></td>
                                <td>
                                    <div class="hstack gap-2 flex-wrap">
                                        <a href="javascript:void(0);" class="text-info fs-14 lh-1"><i class="ri-edit-line"></i></a>
                                        <a href="javascript:void(0);" class="text-danger fs-14 lh-1"><i class="ri-delete-bin-5-line"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Unknown</td>
                                <td>0</td>
                                <td><span class="badge bg-danger-transparent">Inactive</span></td>
                                <td>
                                    <div class="hstack gap-2 flex-wrap">
                                        <a href="javascript:void(0);" class="text-info fs-14 lh-1"><i class="ri-edit-line"></i></a>
                                        <a href="javascript:void(0);" class="text-danger fs-14 lh-1"><i class="ri-delete-bin-5-line"></i></a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End:: row -->


            </div>
        </div>
        <!-- End::app-content -->

        <!-- Footer Start -->
        @include('footer')
        <!-- Footer End -->

    </div>

    
<!-- ✅ Scroll To Top -->
<div class="scrollToTop">
    <span class="arrow"><i class="las la-angle-double-up"></i></span>
</div>
<div id="responsive-overlay"></div>
<!-- Scroll To Top -->

<!-- ✅ jQuery (must be first) -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- ✅ Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- ✅ DataTables + Extensions -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

<!-- ✅ Your DataTable Initialization -->
<script>
$(document).ready(function() {
    // file export datatable (your main table)
    $('#file-export').DataTable({
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
        language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
        },
        pageLength: 10,
        responsive: true
    });
});
</script>

<!-- ✅ Other Libraries (optional from your template) -->
<script src="{{ asset('js/defaultmenu.min.js') }}"></script>
<script src="{{ asset('libs/node-waves/waves.min.js') }}"></script>
<script src="{{ asset('js/sticky.js') }}"></script>
<script src="{{ asset('libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('js/simplebar.js') }}"></script>
<script src="{{ asset('libs/@simonwep/pickr/pickr.es5.min.js') }}"></script>
<script src="{{ asset('libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
<script src="{{ asset('libs/jsvectormap/maps/world-merc.js') }}"></script>
<script src="{{ asset('js/us-merc-en.js') }}"></script>
<script src="{{ asset('js/index.js') }}"></script>
<script src="{{ asset('js/custom-switcher.min.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>





</body>

</html>
                
                
                
              