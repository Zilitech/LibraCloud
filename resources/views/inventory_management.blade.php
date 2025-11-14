
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
        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuDate1"
            data-bs-toggle="dropdown" aria-expanded="false">
            Inventory Filter
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuDate1">
<li><a class="dropdown-item {{ $filter=='all' ? 'active' : '' }}" href="{{ route('inventory.index', ['filter'=>'all']) }}">All</a></li>
<li><a class="dropdown-item {{ $filter=='available' ? 'active' : '' }}" href="{{ route('inventory.index', ['filter'=>'available']) }}">Available</a></li>
<li><a class="dropdown-item {{ $filter=='low' ? 'active' : '' }}" href="{{ route('inventory.index', ['filter'=>'low']) }}">Low Stock</a></li>
<li><a class="dropdown-item {{ $filter=='out' ? 'active' : '' }}" href="{{ route('inventory.index', ['filter'=>'out']) }}">Out of Stock</a></li>

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
    @foreach($inventories as $index => $inventory)
        @php
            $available = $inventory->current_stock ?? 0;
            $status = '';

            if ($available > 3) {
                $status = '<span class="badge bg-success-transparent">Available</span>';
            } elseif ($available > 0 && $available <= 3) {
                $status = '<span class="badge bg-warning-transparent">Low Stock</span>';
            } else {
                $status = '<span class="badge bg-danger-transparent">Out of Stock</span>';
            }
        @endphp

        <tr>
           
    <td>{{ $index + 1 }}</td>
    <td>{{ $inventory->book->book_title }}</td>
    <td>{{ $inventory->book->author_name ?? 'N/A' }}</td>
    <td>{{ $inventory->book->category_name ?? 'N/A' }}</td>
    <td>{{ $inventory->current_stock }}</td>
    <td>{{ $inventory->current_stock }}</td>
    <td>{{ $inventory->current_stock }}</td>
    <td>{{ $inventory->damaged }}</td>
    <td>{!! $status !!}</td>

            <td>
                <div class="hstack gap-2 flex-wrap">
                    <a href="{{ url('add_inventory') }}" class="text-warning fs-14 lh-1" title="Edit">
                        <i class="ri-edit-line"></i>
                    </a>
                    <!-- Delete Inventory Icon -->
<a href="javascript:void(0);" 
   class="me-2 text-danger" 
   data-bs-toggle="tooltip" 
   title="Delete" 
   onclick="confirmDelete({{ $inventory->id }})">
    <i class="ri-delete-bin-5-line fs-16"></i>
</a>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        Are you sure you want to delete this inventory entry?
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
    function confirmDelete(inventoryId) {
        const form = document.getElementById('deleteForm');
        form.action = '/inventory/' + inventoryId; // Dynamic delete route for inventory
        const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
        modal.show();
    }
</script>

                </div>
            </td>
        </tr>
    @endforeach
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



