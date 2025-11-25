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

                <div class="my-auto">
        <h5 class="page-title fs-21 mb-1">Library Report</h5>
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="javascript:void(0);">LibraCloud</a></li>
                <li class="breadcrumb-item active" aria-current="page">Library Report</li>  
            </ol>
        </nav>
    </div>
                <!-- Page Header -->
 <div class="row">
        <!-- Sidebar: Modules -->
        <div class="col-md-3 mb-4">
            <div class="list-group" id="moduleList" role="tablist">
                <a class="list-group-item list-group-item-action active" data-bs-toggle="list" href="#bookReports" role="tab">Book Management</a>
                <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#memberReports" role="tab"> Member Management</a>
                <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#issueReports" role="tab">Issue & Return</a>
                <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#barcodeReports" role="tab"> Barcode Management</a>
                <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#ebookReports" role="tab"> E-Books</a>
                <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#notificationReports" role="tab">Notifications</a>
                <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#settingsReports" role="tab">Settings</a>
                <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#userReports" role="tab">User Management</a>
                <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#logReports" role="tab"> Logs & Maintenance</a>
                <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#dashboardReports" role="tab">Dashboard</a>
            </div>
        </div>

        <!-- Report Content -->
        <div class="col-md-9">
            <div class="tab-content">

                <!-- Book Management Reports -->
<!-- Book Management Reports -->
<div class="tab-pane fade show active" id="bookReports" role="tabpanel">
    <h4>Book Management Reports</h4>
    <div class="table-responsive">
        <table id="bookTable" class="table table-bordered text-nowrap w-100">
            <thead>
                <tr>
                    <th>S.No</th>
                                        <th>Code</th>

                    <th>Book Title</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Total Copies</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @forelse($libraryBooks as $index => $book)
    <tr>
        <td>{{ $index + 1 }}</td>
                <td>{{ $book->book_code }}</td>

        <td>{{ $book->book_title }}</td>
        <td>{{ $book->author_name }}</td>
        <td>{{ $book->category_name }}</td>
        <td>{{ $book->quantity }}</td>
        <td>{{ $book->price }}</td>
    </tr>
@empty
<tr>
    <td colspan="10" class="text-center">No books found in the library</td>
</tr>
@endforelse

            </tbody>
        </table>
    </div>
</div>

                <!-- Member Management Reports -->
                <div class="tab-pane fade" id="memberReports" role="tabpanel">
    <h4>Member Management Reports</h4>
    <table id="memberTable" class="table table-bordered table-striped w-100">
        <thead>
            <tr>
                <th>Member ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Email</th>
                <th>Phone</th>
                <th>department</th>
            </tr>
        </thead>
        <tbody>
            @forelse($members as $member)
            <tr>
                <td>{{ $member->memberid ?? $member->id }}</td>
                <td>{{ $member->fullname }}</td>
                <td>{{ $member->membertype ?? '-' }}</td>
                <td>{{ $member->email ?? '-' }}</td>
                <td>{{ $member->phone}}</td>
                <td>{{ $member->departmentclass }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">No members found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>


                <!-- Issue & Return Reports -->
                <div class="tab-pane fade" id="issueReports" role="tabpanel">
                    <h4>Issued Reports</h4>
                    <table id="issueTable" class="table table-bordered table-striped w-100">
                        <thead>
                            <tr>
                                <th>Transaction ID</th>
                                <th>Book</th>
                                <th>Member</th>
                                <th>Issue Date</th>
                                <th>Due Date</th>
                                <th>Status</th>
                                <th>Fine</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($issued_books as $issue)
                            <tr>
                                <td>{{$issue->issue_id}}</td>
                                <td>{{$issue->book_name}}</td>
                                <td>{{$issue->book_isbn}}</td>
                                <td>{{$issue->author_name}}</td>
                                <td>{{$issue->member_name}}</td>
                                <td>{{$issue->issue_date}}</td>
                                <td>{{$issue->due_date}}</td>
                            </tr>
                             @empty
            <tr>
                <td colspan="6" class="text-center">No members found.</td>
            </tr>
            @endforelse
                        </tbody>
                    </table>
                    <h4> Returnd Reports</h4>
                    <table id="issueTable" class="table table-bordered table-striped w-100">
                        <thead>
                            <tr>
                                <th>Issue ID</th>
                                <th>Book</th>
                                <th>ISBN</th>
                                <th>Author</th>
                                <th>Member</th>
                                <th>Issue Date</th>
                                <th>Return Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($returned_books as $return)
                            <tr>
                                <td>{{$return->issue_id}}</td>
                                <td>{{$return->book_name}}</td>
                                <td>{{$return->book_isbn}}</td>
                                <td>{{$return->author_name}}</td>
                                <td>{{$return->member_name}}</td>
                                <td>{{$return->issue_date}}</td>
                                <td>{{$return->due_date}}</td>
                            </tr>
                     
                             @empty
            <tr>
                <td colspan="6" class="text-center">No members found.</td>
            </tr>
            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Barcode Management Reports -->
                <div class="tab-pane fade" id="barcodeReports" role="tabpanel">
                    <h4>Barcode Management Reports</h4>
                    <table id="barcodeTable" class="table table-bordered table-striped w-100">
                        <thead>
                            <tr>
                                <th>Barcode ID</th>
                                <th>Book</th>
                                <th>Generated Date</th>
                                <th>Scanned Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>BC101</td>
                                <td>Organic Chemistry Volume 2</td>
                                <td>2025-11-01</td>
                                <td>15</td>
                            </tr>
                            <tr>
                                <td>BC102</td>
                                <td>World History</td>
                                <td>2025-11-03</td>
                                <td>8</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- E-Books Reports -->
                <div class="tab-pane fade" id="ebookReports" role="tabpanel">
                    <h4>E-Books Reports</h4>
                    <table id="ebookTable" class="table table-bordered table-striped w-100">
                        <thead>
                            <tr>
                                <th>E-Book ID</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Uploaded</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ebooks as $ebook)
                            <tr>
                                <td>{{$ebook->id}}</td>
                                <td>{{$ebook->book_title}}</td>
                                <td>{{$ebook->author_name}}</td>
                                <td>{{$ebook->category_name}}</td>
                                <td>{{$ebook->price}}</td>
                                <td>{{$ebook->created_at}}</td>
                            </tr>
                            @empty
            <tr>
                <td colspan="6" class="text-center">No members found.</td>
            </tr>
            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Notifications Reports -->
                <div class="tab-pane fade" id="notificationReports" role="tabpanel">
                    <h4>Notifications Reports</h4>
                    <table id="notificationTable" class="table table-bordered table-striped w-100">
                        <thead>
                            <tr>
                                <th>Notification ID</th>
                                <th>Type</th>
                                <th>Target</th>
                                <th>Status</th>
                                <th>Sent On</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>NT101</td>
                                <td>Due Date Alert</td>
                                <td>Riya Sharma</td>
                                <td>Sent</td>
                                <td>2025-11-05</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Settings Reports -->
                <div class="tab-pane fade" id="settingsReports" role="tabpanel">
                    <h4>Settings Reports</h4>
                    <table id="settingsTable" class="table table-bordered table-striped w-100">
                        <thead>
                            <tr>
                                <th>Setting</th>
                                <th>Value</th>
                                <th>Updated By</th>
                                <th>Updated On</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Daily Fine Rate</td>
                                <td>₹5/day</td>
                                <td>Admin</td>
                                <td>2025-11-01</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- User Management Reports -->
                <div class="tab-pane fade" id="userReports" role="tabpanel">
                    <h4>User Management Reports</h4>
                    <table id="userTable" class="table table-bordered table-striped w-100">
                        <thead>
                            <tr>
                                <th>Emp ID</th>
                                <th>Name</th>
                                <th>D.O.B</th>
                                <th>department</th>
                                <th>Role</th>
                                <th>Phone</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($all_staff as $staff)
                            <tr>
                                <td>{{$staff->employee_id}}</td>
                                <td>{{$staff->name}}</td>
                                <td>{{$staff->dob}}</td>
                                <td>{{$staff->department}}</td>
                                <td>{{$staff->role_name}}</td>
                                <td>{{$staff->phone}}</td>
                            </tr>
                           @empty
            <tr>
                <td colspan="6" class="text-center">No members found.</td>
            </tr>
            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Logs & Maintenance Reports -->
                <div class="tab-pane fade" id="logReports" role="tabpanel">
                    <h4>Logs & Maintenance Reports</h4>
                    <table id="logTable" class="table table-bordered table-striped w-100">
                        <thead>
                            <tr>
                                <th>Log ID</th>
                                <th>User ID</th>
                                <th>Action</th>
                                <th>Details</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($activity_logs as $logs)
                            <tr>
                                <td>{{$logs->id}}</td>
                                <td>{{$logs->user_id}}</td>
                                <td>{{$logs->action}}</td>
                                <td>{{$logs->details}}</td>
                                <td>{{$logs->created_at}}</td>
                            </tr>
                           @empty
            <tr>
                <td colspan="6" class="text-center">No members found.</td>
            </tr>
            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Dashboard Reports -->
                <div class="tab-pane fade" id="dashboardReports" role="tabpanel">
                    <h4>Dashboard Reports</h4>
                    <table id="dashboardTable" class="table table-bordered table-striped w-100">
                        <thead>
                            <tr>
                                <th>Total Books</th>
                                <th>Available</th>
                                <th>Issued</th>
                                <th>Total Members</th>
                                <th>Total Fines</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>50</td>
                                <td>30</td>
                                <td>20</td>
                                <td>100</td>
                                <td>₹500</td>
                            </tr>
                        </tbody>
                    </table>
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

    
<!-- JS Libraries -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize DataTables with export buttons
    $('#bookTable, #memberTable, #issueTable, #barcodeTable, #ebookTable, #notificationTable, #settingsTable, #userTable, #logTable, #dashboardTable').DataTable({
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
        pageLength: 5,
        responsive: true
    });
});
</script>
</body>
</html>



</body>

</html>





