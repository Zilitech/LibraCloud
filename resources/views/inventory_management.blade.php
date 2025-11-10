
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
<!-- Page Header -->
<div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
    <div class="my-auto">
        <h5 class="page-title fs-21 mb-1">Inventory Management</h5>
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Books</a></li>
                <li class="breadcrumb-item active" aria-current="page">Inventory</li>
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
<div class="d-flex align-items-center">
    <div class="mb-xl-0 me-2">
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuDate1" data-bs-toggle="dropdown" aria-expanded="false">
                Inventory Filter
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuDate1">
                <li><a class="dropdown-item" href="javascript:void(0);">All</a></li>
                <li><a class="dropdown-item" href="javascript:void(0);">Available</a></li>
                <li><a class="dropdown-item" href="javascript:void(0);">Low Stock</a></li>
                <li><a class="dropdown-item" href="javascript:void(0);">Out of Stock</a></li>
            </ul>
        </div>
    </div>

    <div class="mb-xl-0">
        <div class="dropdown">
               <a href="{{ url('add_inventory') }}" class="btn btn-success">
        <i class="ri-add-line me-1"></i> Add Inventory
    </a>
        </div>
    </div>
</div>

        </div>
    </div>
</div>
<!-- Page Header Close -->

<!-- Alert -->
<div class="alert alert-solid-secondary alert-dismissible fs-15 fade show mb-4">
    All <strong class="text-fixed-black">Inventory</strong> data is displayed on this page using 
    <strong class="text-fixed-black">jquery</strong> DataTables. You can manage book stock, view low stock alerts, and update quantities here.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
        <i class="bi bi-x"></i>
    </button>
</div>

<!-- Start:: row -->
<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">Inventory List</div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="file-export" class="table table-bordered text-nowrap w-100">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Book Title</th>
                                <th>Author</th>
                                <th>Category</th>
                                <th>Total Copies</th>
                                <th>Available</th>
                                <th>Issued</th>
                                <th>Damaged/Lost</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Organic Chemistry Vol 2</td>
                                <td>Dr. B. Kumar</td>
                                <td>Science</td>
                                <td>12</td>
                                <td>8</td>
                                <td>4</td>
                                <td>0</td>
                                <td><span class="badge bg-success-transparent">Available</span></td>
                                <td>
                                    <div class="hstack gap-2 flex-wrap">
                                        <a href="javascript:void(0);" class="text-info fs-14 lh-1" title="View"><i class="ri-eye-line"></i></a>
                                        <a href="javascript:void(0);" class="text-warning fs-14 lh-1" title="Edit"><i class="ri-edit-line"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Physics for Engineers</td>
                                <td>Prof. S. Rao</td>
                                <td>Engineering</td>
                                <td>10</td>
                                <td>2</td>
                                <td>7</td>
                                <td>1</td>
                                <td><span class="badge bg-warning-transparent">Low Stock</span></td>
                                <td>
                                    <div class="hstack gap-2 flex-wrap">
                                        <a href="javascript:void(0);" class="text-info fs-14 lh-1"><i class="ri-eye-line"></i></a>
                                        <a href="javascript:void(0);" class="text-warning fs-14 lh-1"><i class="ri-edit-line"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Modern Economics</td>
                                <td>R. Mehta</td>
                                <td>Commerce</td>
                                <td>6</td>
                                <td>0</td>
                                <td>5</td>
                                <td>1</td>
                                <td><span class="badge bg-danger-transparent">Out of Stock</span></td>
                                <td>
                                    <div class="hstack gap-2 flex-wrap">
                                        <a href="javascript:void(0);" class="text-info fs-14 lh-1"><i class="ri-eye-line"></i></a>
                                        <a href="javascript:void(0);" class="text-warning fs-14 lh-1"><i class="ri-edit-line"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>World History Atlas</td>
                                <td>A. Sharma</td>
                                <td>History</td>
                                <td>15</td>
                                <td>14</td>
                                <td>1</td>
                                <td>0</td>
                                <td><span class="badge bg-success-transparent">Available</span></td>
                                <td>
                                    <div class="hstack gap-2 flex-wrap">
                                        <a href="javascript:void(0);" class="text-info fs-14 lh-1"><i class="ri-eye-line"></i></a>
                                        <a href="javascript:void(0);" class="text-warning fs-14 lh-1"><i class="ri-edit-line"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Advanced Mathematics</td>
                                <td>Dr. K. Patil</td>
                                <td>Mathematics</td>
                                <td>9</td>
                                <td>3</td>
                                <td>5</td>
                                <td>1</td>
                                <td><span class="badge bg-warning-transparent">Low Stock</span></td>
                                <td>
                                    <div class="hstack gap-2 flex-wrap">
                                        <a href="javascript:void(0);" class="text-info fs-14 lh-1"><i class="ri-eye-line"></i></a>
                                        <a href="javascript:void(0);" class="text-warning fs-14 lh-1"><i class="ri-edit-line"></i></a>
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

    
   @include('foot')



</body>

</html>



