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
                    <h5 class="page-title fs-21 mb-1">Version Information</h5>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Help/About</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Version Information</li>
                        </ol>
                    </nav>
                </div>
            </div>


<div class="container mt-4">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-primary text-white py-3 rounded-top-4">
            <h4 class="mb-0"> LibraCloud Version Information</h4>
        </div>

        <div class="card-body p-4">

            <!-- System Overview -->
            <section class="mb-5">
                <h5 class="fw-bold text-primary mb-3">System Overview</h5>
                <p>
                    <strong>LibraCloud</strong> is a next-generation Library Management System developed by 
                    <strong>Zilitech Technologies</strong>.  
                    This version is designed for single institutions such as schools, colleges, or universities 
                    that manage their own library infrastructure.
                </p>
            </section>

            <!-- Version Details -->
            <section class="mb-5">
                <h5 class="fw-bold text-primary mb-3">Version Details</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Application Name:</strong> LibraCloud Admin Panel</li>
                    <li class="list-group-item"><strong>Version:</strong> 1.0.0 (Single Institution Edition)</li>
                    <li class="list-group-item"><strong>Build Date:</strong> November 2025</li>
                    <li class="list-group-item"><strong>Framework:</strong> Laravel 10.x (PHP 8.2)</li>
                    <li class="list-group-item"><strong>Frontend:</strong> Bootstrap 5.3 + Blade Templates</li>
                    <li class="list-group-item"><strong>Database Supported:</strong> MySQL, PostgreSQL</li>
                    <li class="list-group-item"><strong>License Type:</strong> Institutional License (Non-Commercial)</li>
                </ul>
            </section>

            <!-- Change Log -->
            <section class="mb-5">
                <h5 class="fw-bold text-primary mb-3"> Change Log (v1.0.0)</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">✅ Added Dashboard with real-time statistics & charts</li>
                    <li class="list-group-item">✅ Implemented Book Management (Add, Edit, Delete, Search)</li>
                    <li class="list-group-item">✅ Barcode scanning and generation module integrated</li>
                    <li class="list-group-item">✅ Member Management with category & ID card generation</li>
                    <li class="list-group-item">✅ Issue & Return tracking with fine calculation</li>
                    <li class="list-group-item">✅ Reports module with PDF/Excel export</li>
                    <li class="list-group-item">✅ Notifications (due date & new arrival alerts)</li>
                    <li class="list-group-item">✅ E-Book upload and online reading feature</li>
                    <li class="list-group-item">✅ Library settings with theme, language, and fine rules</li>
                    <li class="list-group-item">✅ User roles, permissions, and activity logs</li>
                    <li class="list-group-item">✅ System backup & maintenance utilities</li>
                </ul>
            </section>

            <!-- Upcoming Features -->
            <section class="mb-5">
                <h5 class="fw-bold text-primary mb-3"> Upcoming Features (v1.1.0 - Planned)</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">🔹 Multi-branch support (for group institutions)</li>
                    <li class="list-group-item">🔹 SMS Gateway & WhatsApp Notifications</li>
                    <li class="list-group-item">🔹 Mobile-friendly responsive dashboard</li>
                    <li class="list-group-item">🔹 AI-powered book recommendations</li>
                    <li class="list-group-item">🔹 Bulk import/export of members and books (CSV/Excel)</li>
                </ul>
            </section>

            <!-- License Info -->
            <section class="mb-5">
                <h5 class="fw-bold text-primary mb-3"> License & Usage</h5>
                <p>
                    LibraCloud is licensed under the <strong>Zilitech Institutional License</strong>.  
                    It is provided for internal library use within one institution. Redistribution, resale, or
                    multi-domain usage without written consent is prohibited.
                </p>
            </section>

            <!-- Credits -->
            <section>
                <h5 class="fw-bold text-primary mb-3"> Credits</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Developed By:</strong> SRZili Technology Private Limited</li>
                    <li class="list-group-item"><strong>Developer:</strong> Tukaram (Software Engineer)</li>
                    <li class="list-group-item"><strong>Support:</strong> <a href="mailto:zilitechy@gmail.com">support@zilitech.in</a></li>
                    <li class="list-group-item"><strong>Website:</strong> <a href="https://zilitech.com" target="_blank">www.zilitech.com</a></li>
                </ul>
            </section>

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

    
   @include('foot')



</body>

</html>