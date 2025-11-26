@include('head')

<body>

    @include('switcher')

    <!-- Loader -->
    <div id="loader">
        <img src="{{ asset('images/media/loader.svg') }}" alt="">
    </div>
    <!-- Loader -->

    <div class="page">

        <!-- Header -->
        @include('header')
        @include('nav_sidebar')

        <!-- Main Content -->
        <div class="main-content app-content">
            <div class="container-fluid">

                <!-- Page Header -->
                <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                    <div class="my-auto">
                        <h5 class="page-title fs-21 mb-1">Issue Book</h5>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Library</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Issue Book</li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <!-- Issue Form -->
           <form action="{{ route('issue-book.store') }}" method="POST">
    @csrf
    <div class="row">

        <!-- Issue ID -->
        <div class="col-md-6 mb-3">
            <label>Issue ID:</label>
            <input type="text" class="form-control" name="issue_id" value="{{ $issue_id }}" readonly>
        </div>

        <!-- Member -->
        <div class="col-md-6 mb-3">
            <label>Select Member:</label>
            <select class="form-select" id="memberSelect" name="member_name" required>
                <option selected disabled>-- Choose Member --</option>
                @foreach($members as $member)
                    <option value="{{ $member->fullname }}" data-id="{{ $member->memberid }}">
                        {{ $member->fullname }} ({{ $member->member_code }})
                    </option>
                @endforeach
            </select>
            <input type="hidden" id="memberID" name="member_id">
        </div>

        <!-- Book -->
        <div class="col-md-6 mb-3">
            <label>Select Book:</label>
            <select class="form-select" id="bookSelect" name="book_name" required>
                <option selected disabled>-- Choose Book --</option>
                @foreach($books as $book)
                    <option value="{{ $book->book_title }}" data-isbn="{{ $book->isbn }}" data-author="{{ $book->author_name }}">
                        {{ $book->book_title }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Book ISBN -->
        <div class="col-md-6 mb-3">
            <label>Book Code / ISBN:</label>
            <input type="text" class="form-control" id="bookISBN" name="book_isbn" readonly>
        </div>

        <!-- Author Name -->
        <div class="col-md-6 mb-3">
            <label>Author Name:</label>
            <input type="text" class="form-control" id="bookAuthor" name="author_name" readonly>
        </div>

        <!-- Issue Date -->
        <div class="col-md-6 mb-3">
            <label>Issue Date:</label>
            <input type="date" class="form-control" name="issue_date" value="{{ date('Y-m-d') }}">
        </div>

        <!-- Due Date -->
        <div class="col-md-6 mb-3">
            <label>Due Date:</label>
            <input type="date" class="form-control" name="due_date" required>
        </div>

        <!-- Quantity -->
        <div class="col-md-6 mb-3">
            <label>Quantity:</label>
            <input type="number" class="form-control" name="quantity" min="1" max="5" value="1">
        </div>

        <!-- Remarks -->
        <div class="col-md-12 mb-3">
            <label>Remarks:</label>
            <textarea class="form-control" name="remarks" rows="3"></textarea>
        </div>

        <!-- Status -->
        <div class="col-md-6 mb-3">
            <label>Status:</label>
            <select class="form-select" name="status">
                <option value="Issued">Issued</option>
                <option value="Returned">Returned</option>
                <option value="Overdue">Overdue</option>
            </select>
        </div>

        <div class="col-md-12 text-end">
            <button type="reset" class="btn btn-secondary me-2">Reset</button>
            <button type="submit" class="btn btn-success">Save & Issue</button>
        </div>
    </div>
</form>

<script>
    // Auto-fill ISBN and Author
    document.getElementById('bookSelect').addEventListener('change', function() {
        let selected = this.options[this.selectedIndex];
        document.getElementById('bookISBN').value = selected.dataset.isbn;
        document.getElementById('bookAuthor').value = selected.dataset.author;
    });

    // Auto-fill member_id
    document.getElementById('memberSelect').addEventListener('change', function() {
        let selected = this.options[this.selectedIndex];
        document.getElementById('memberID').value = selected.dataset.id;
    });
</script>



            </div>
        </div>
        <!-- End::app-content -->

        <!-- Footer -->
        @include('footer')

    </div>

    <!-- Scroll To Top -->
    <div class="scrollToTop">
        <span class="arrow"><i class="las la-angle-double-up"></i></span>
    </div>
    <div id="responsive-overlay"></div>

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
