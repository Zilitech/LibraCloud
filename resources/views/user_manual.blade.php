@include('head')

<body>
    @include('switcher')

    <!-- Loader -->
    <div id="loader">
        <img src="{{ asset('images/media/loader.svg') }}" alt="">
    </div>

    <div class="page">
        @include('header')
        @include('nav_sidebar')

        <!-- Start::app-content -->
        <div class="main-content app-content">
            <div class="container-fluid py-4">

                <!-- Page Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="page-title mb-0">User Manual</h4>
                    <a href="{{ url('/') }}" class="btn btn-secondary">
                        <i class="ri-arrow-left-line"></i> Back to Dashboard
                    </a>
                </div>

                <!-- Info -->
                <div class="alert alert-info mb-4">
                    Welcome to the <strong>LibraCloud User Manual</strong>.  
                    This guide helps admins and librarians understand and operate all modules efficiently.
                </div>

                <!-- Manual Sections -->
                <div class="accordion" id="manualAccordion">

                    <!-- Dashboard -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingDashboard">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDashboard">
                                Dashboard Overview
                            </button>
                        </h2>
                        <div id="collapseDashboard" class="accordion-collapse collapse show" data-bs-parent="#manualAccordion">
                            <div class="accordion-body">
                                <ul>
                                    <li>Displays key library statistics like <strong>Total Books, Members, and Fines Collected</strong>.</li>
                                    <li>Shows <strong>Recent Activity</strong> such as added books or recent returns.</li>
                                    <li>Includes <strong>Monthly charts</strong> for issued/returned book trends.</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Book Management -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingBook">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBook">
                                 Book Management
                            </button>
                        </h2>
                        <div id="collapseBook" class="accordion-collapse collapse" data-bs-parent="#manualAccordion">
                            <div class="accordion-body">
                                <ul>
                                    <li>Use <strong>All Books</strong> to view, search, or filter books.</li>
                                    <li><strong>Add New Book</strong> to add book details like title, author, category, and quantity.</li>
                                    <li>Manage <strong>Categories</strong> and <strong>Authors</strong> for easy organization.</li>
                                    <li>Track stock, damaged, or missing books using <strong>Inventory Management</strong>.</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Barcode Management -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingBarcode">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBarcode">
                                 Barcode Management
                            </button>
                        </h2>
                        <div id="collapseBarcode" class="accordion-collapse collapse" data-bs-parent="#manualAccordion">
                            <div class="accordion-body">
                                <ul>
                                    <li><strong>Scan Book Barcode</strong>: Use a barcode scanner or webcam to identify a book instantly.</li>
                                    <li><strong>Generate Barcode</strong>: Create and print barcode labels for any book.</li>
                                    <li><strong>Book Lookup</strong>: Enter or scan a barcode to view complete book details.</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Member Management -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingMembers">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMembers">
                                 Member Management
                            </button>
                        </h2>
                        <div id="collapseMembers" class="accordion-collapse collapse" data-bs-parent="#manualAccordion">
                            <div class="accordion-body">
                                <ul>
                                    <li>Manage all library members, including <strong>Students, Faculty, and Guests</strong>.</li>
                                    <li>Add new members and generate <strong>Membership Cards</strong> with barcodes or QR codes.</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Issue & Return -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingIssue">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseIssue">
                                 Issue & Return Management
                            </button>
                        </h2>
                        <div id="collapseIssue" class="accordion-collapse collapse" data-bs-parent="#manualAccordion">
                            <div class="accordion-body">
                                <ul>
                                    <li><strong>Issue Book</strong>: Select a member and book to issue, system auto-sets due date.</li>
                                    <li><strong>Return Book</strong>: Scan or search to mark returned and calculate any overdue fines.</li>
                                    <li>View <strong>Overdue Books</strong> and manage fines from one place.</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Reports -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingReports">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseReports">
                                 Reports & Analytics
                            </button>
                        </h2>
                        <div id="collapseReports" class="accordion-collapse collapse" data-bs-parent="#manualAccordion">
                            <div class="accordion-body">
                                <ul>
                                    <li>Generate detailed reports by category, author, or member type.</li>
                                    <li>Export reports to <strong>PDF or Excel</strong> easily.</li>
                                    <li>Track issued and returned books monthly.</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Notifications -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingNotifications">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNotifications">
                                 Notifications
                            </button>
                        </h2>
                        <div id="collapseNotifications" class="accordion-collapse collapse" data-bs-parent="#manualAccordion">
                            <div class="accordion-body">
                                <ul>
                                    <li>Send <strong>Due Date Alerts</strong> for pending returns.</li>
                                    <li>Notify members about <strong>New Arrivals</strong> via email or SMS.</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- E-Books -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingEbooks">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEbooks">
                                 E-Books Module
                            </button>
                        </h2>
                        <div id="collapseEbooks" class="accordion-collapse collapse" data-bs-parent="#manualAccordion">
                            <div class="accordion-body">
                                <ul>
                                    <li><strong>Upload E-Books</strong> in PDF format.</li>
                                    <li><strong>E-Book Reader</strong> allows students to read online directly.</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Settings -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingSettings">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSettings">
                                 Library Settings
                            </button>
                        </h2>
                        <div id="collapseSettings" class="accordion-collapse collapse" data-bs-parent="#manualAccordion">
                            <div class="accordion-body">
                                <ul>
                                    <li>Update library name, logo, and contact details.</li>
                                    <li>Set <strong>Fine Rules, Issue/Return Durations</strong>, and <strong>Theme Preferences</strong>.</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- User Management -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingUsers">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseUsers">
                                 User Management
                            </button>
                        </h2>
                        <div id="collapseUsers" class="accordion-collapse collapse" data-bs-parent="#manualAccordion">
                            <div class="accordion-body">
                                <ul>
                                    <li>Add or edit admin and librarian accounts.</li>
                                    <li>Assign roles and permissions for restricted module access.</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Logs & Maintenance -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingLogs">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLogs">
                                 Logs & Maintenance
                            </button>
                        </h2>
                        <div id="collapseLogs" class="accordion-collapse collapse" data-bs-parent="#manualAccordion">
                            <div class="accordion-body">
                                <ul>
                                    <li>View <strong>Activity Logs</strong> of all staff actions.</li>
                                    <li>Check <strong>Error Logs</strong> and perform <strong>Database Backups</strong>.</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <!-- End::app-content -->

        @include('footer')
    </div>

    @include('foot')
</body>
</html>
