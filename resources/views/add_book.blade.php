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

    <!-- Messages -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form Card -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">Add New Book</div>
                </div>

                <div class="card-body">
                    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row gy-4">

                            <!-- Book Title -->
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="bookTitle" class="form-label">Book Title:</label>
                                <input type="text" name="book_title" class="form-control" id="bookTitle" value="{{ old('book_title') }}" placeholder="Enter Book Title" required>
                            </div>

                            <!-- Book Code -->
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="bookCode" class="form-label">Book Code:</label>
                                <input type="text" name="book_code" class="form-control" id="bookCode" value="{{ old('book_code') }}" placeholder="e.g. CHM101">
                            </div>

                            <!-- ISBN -->
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="isbn" class="form-label">ISBN Number:</label>
                                <input type="text" name="isbn" class="form-control" id="isbn" value="{{ old('isbn') }}" placeholder="Enter ISBN Number">
                            </div>

                            <!-- Author -->
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="author" class="form-label">Author:</label>
                                <select name="author_id" class="form-select" id="author" required>
                                    <option selected disabled>-- Select Author --</option>
                                    @foreach($authors as $author)
                                        <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>{{ $author->author_name }}</option>
                                    @endforeach
                                </select>
                                @error('author_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Publisher -->
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="publisher" class="form-label">Publisher:</label>
                                <input type="text" name="publisher" class="form-control" id="publisher" value="{{ old('publisher') }}" placeholder="Publisher Name">
                            </div>

                            <!-- Category -->
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="category" class="form-label">Category:</label>
                                <select name="category_id" class="form-select" id="category" required>
                                    <option selected disabled>-- Select Category --</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Subject -->
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="subject" class="form-label">Subject:</label>
                                <input type="text" name="subject" class="form-control" id="subject" value="{{ old('subject') }}" placeholder="Enter Subject or Course Code">
                            </div>

                            <!-- Rack Number -->
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="rackNumber" class="form-label">Rack Number:</label>
                                <input type="text" name="rack_number" class="form-control" id="rackNumber" value="{{ old('rack_number') }}" placeholder="Enter Rack Number">
                            </div>

                            <!-- Quantity -->
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="quantity" class="form-label">Quantity:</label>
                                <input type="number" name="quantity" class="form-control" id="quantity" value="{{ old('quantity') }}" placeholder="Total Copies" required>
                            </div>

                            <!-- Price -->
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="price" class="form-label">Book Price (₹):</label>
                                <input type="number" name="price" class="form-control" id="price" value="{{ old('price') }}" placeholder="Enter Price">
                            </div>

                            <!-- Purchase Date -->
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="purchaseDate" class="form-label">Purchase Date:</label>
                                <input type="date" name="purchase_date" class="form-control" id="purchaseDate" value="{{ old('purchase_date') }}">
                            </div>

                            <!-- Condition -->
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="condition" class="form-label">Book Condition:</label>
                                <select name="condition" class="form-select" id="condition">
                                    <option selected disabled>-- Select Condition --</option>
                                    <option value="New" {{ old('condition') == 'New' ? 'selected' : '' }}>New</option>
                                    <option value="Good" {{ old('condition') == 'Good' ? 'selected' : '' }}>Good</option>
                                    <option value="Damaged" {{ old('condition') == 'Damaged' ? 'selected' : '' }}>Damaged</option>
                                    <option value="Lost" {{ old('condition') == 'Lost' ? 'selected' : '' }}>Lost</option>
                                </select>
                            </div>

                            <!-- Cover Image -->
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="coverImage" class="form-label">Book Cover Image:</label>
                                <input class="form-control" type="file" name="cover_image" id="coverImage" accept="image/*">
                                @error('cover_image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- E-Book File -->
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="ebookFile" class="form-label">Upload E-Book (PDF):</label>
                                <input class="form-control" type="file" name="ebook_file" id="ebookFile" accept="application/pdf">
                                @error('ebook_file')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <label for="description" class="form-label">Book Description:</label>
                                <textarea class="form-control" name="description" id="description" rows="4" placeholder="Write a short summary about the book...">{{ old('description') }}</textarea>
                            </div>

                        </div>

                        <!-- Card Footer -->
                        <div class="card-footer text-end mt-4">
                            <button type="reset" class="btn btn-secondary me-2"><i class="ri-refresh-line me-1"></i>Reset</button>
                            <button type="submit" class="btn btn-primary"><i class="ri-save-line me-1"></i>Save Book</button>
                        </div>

                    </form>
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
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
