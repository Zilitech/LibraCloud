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
                    <h5 class="page-title fs-21 mb-1">Add New Book</h5>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Books</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add New Book</li>
                        </ol>
                    </nav>
                </div>
            </div>
                <!-- Page Header -->
<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">
                    Add New Book
                </div>

            </div>

            <div class="card-body">
                <div class="row gy-4">

                    <!-- Book Title -->
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <label for="bookTitle" class="form-label">Book Title:</label>
                        <input type="text" class="form-control" id="bookTitle" placeholder="Enter Book Title">
                    </div>

                    <!-- Book Code -->
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <label for="bookCode" class="form-label">Book Code:</label>
                        <input type="text" class="form-control" id="bookCode" placeholder="e.g. CHM101">
                    </div>

                    <!-- ISBN -->
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <label for="isbn" class="form-label">ISBN Number:</label>
                        <input type="text" class="form-control" id="isbn" placeholder="Enter ISBN Number">
                    </div>

                    <!-- Author -->
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <label for="author" class="form-label">Author:</label>
                        <select class="form-select" id="author">
                            <option selected disabled>-- Select Author --</option>
                            <option value="Science">A P J Abdul Kalam</option>
                            <option value="Commerce">R. K. Narayan</option>
                            <option value="Literature">Rabindranath Tagore</option>
                            <option value="Technology">S. K. Narayan</option>
                        </select>
                    </div>

                    <!-- Publisher -->
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <label for="publisher" class="form-label">Publisher:</label>
                        <input type="text" class="form-control" id="publisher" placeholder="Publisher Name">
                    </div>

                    <!-- Category -->
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <label for="category" class="form-label">Category:</label>
                        <select class="form-select" id="category">
                            <option selected disabled>-- Select Category --</option>
                            <option value="Science">Science</option>
                            <option value="Commerce">Commerce</option>
                            <option value="Literature">Literature</option>
                            <option value="Technology">Technology</option>
                        </select>
                    </div>

                    <!-- Subject -->
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <label for="subject" class="form-label">Subject:</label>
                        <input type="text" class="form-control" id="subject" placeholder="Enter Subject or Course Code">
                    </div>

                    <!-- Rack Number -->
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <label for="rackNumber" class="form-label">Rack Number:</label>
                        <input type="text" class="form-control" id="rackNumber" placeholder="Enter Rack Number">
                    </div>

                    <!-- Quantity -->
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <label for="quantity" class="form-label">Quantity:</label>
                        <input type="number" class="form-control" id="quantity" placeholder="Total Copies">
                    </div>

                    <!-- Price -->
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <label for="price" class="form-label">Book Price (₹):</label>
                        <input type="number" class="form-control" id="price" placeholder="Enter Price">
                    </div>

                    <!-- Purchase Date -->
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <label for="purchaseDate" class="form-label">Purchase Date:</label>
                        <input type="date" class="form-control" id="purchaseDate">
                    </div>

                    <!-- Condition -->
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <label for="condition" class="form-label">Book Condition:</label>
                        <select class="form-select" id="condition">
                            <option selected disabled>-- Select Condition --</option>
                            <option value="New">New</option>
                            <option value="Good">Good</option>
                            <option value="Damaged">Damaged</option>
                            <option value="Lost">Lost</option>
                        </select>
                    </div>

                    <!-- Cover Image -->
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <label for="coverImage" class="form-label">Book Cover Image:</label>
                        <input class="form-control" type="file" id="coverImage" accept="image/*">
                    </div>

                    <!-- E-Book File -->
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <label for="ebookFile" class="form-label">Upload E-Book (PDF):</label>
                        <input class="form-control" type="file" id="ebookFile" accept="application/pdf">
                    </div>

                    <!-- Description -->
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <label for="description" class="form-label">Book Description:</label>
                        <textarea class="form-control" id="description" rows="4" placeholder="Write a short summary about the book..."></textarea>
                    </div>
                </div>
            </div>

            <!-- Card Footer -->
            <div class="card-footer text-end">
                <button type="reset" class="btn btn-secondary me-2"><i class="ri-refresh-line me-1"></i>Reset</button>
                <button type="submit" class="btn btn-primary"><i class="ri-save-line me-1"></i>Save Book</button>
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
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
