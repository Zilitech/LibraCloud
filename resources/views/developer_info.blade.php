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
                    <h5 class="page-title fs-21 mb-1">Developer Information</h5>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Help/About</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Developer Information</li>
                        </ol>
                    </nav>
                </div>
            </div>


<div class="container mt-4">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-primary text-white py-3 rounded-top-4">
            <h4 class="mb-0"> Developer Information</h4>
        </div>

        <div class="card-body p-4">

            <!-- Project Overview -->
            <section class="mb-5">
                <h5 class="fw-bold text-primary mb-3"> Project Overview</h5>
                <p>
                    <strong>LibraCloud</strong> is a modern web-based Library Management System built using 
                    <strong>Laravel 10</strong> and <strong>Bootstrap 5</strong>.  
                    It’s designed for schools, colleges, and institutions to manage books, members, and library operations efficiently.
                </p>
                <p>
                    The system supports barcode scanning, e-book integration, issue/return management, and real-time reporting.
                </p>
            </section>

            <!-- Development Info -->
            <section class="mb-5">
                <h5 class="fw-bold text-primary mb-3"> Developed By</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <strong>Developed By:</strong> SRZili Technology Private Limited
                    </li>
                    <li class="list-group-item">
                        <strong>Developer:</strong> Tukaram (Software Engineer)
                    </li>
                    <li class="list-group-item">
                        <strong>Email:</strong> <a href="mailto:zilitechy@gmail.com">support@zilitech.in</a>
                    </li>
                    <li class="list-group-item">
                        <strong>Website:</strong> <a href="https://zilitech.com/" target="_blank">www.zilitech.com</a>
                    </li>
                    <li class="list-group-item">
                        <strong>GitHub:</strong> <a href="https://github.com/Zilitech" target="_blank">github.com/Zilitech</a>
                    </li>
                </ul>
            </section>

            <!-- Technical Details -->
            <section class="mb-5">
                <h5 class="fw-bold text-primary mb-3"> Technical Stack</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Framework:</strong> Laravel 10</li>
                    <li class="list-group-item"><strong>Frontend:</strong> Bootstrap 5, jQuery, Blade Templates</li>
                    <li class="list-group-item"><strong>Database:</strong> MySQL / PostgreSQL</li>
                    <li class="list-group-item"><strong>Authentication:</strong> Laravel Breeze / Custom Auth</li>
                    <li class="list-group-item"><strong>Charts:</strong> Chart.js / ApexCharts</li>
                    <li class="list-group-item"><strong>PDF Export:</strong> barryvdh/laravel-dompdf</li>
                    <li class="list-group-item"><strong>Barcode Generator:</strong> milon/barcode</li>
                </ul>
            </section>

            <!-- Contribution -->
            <section class="mb-5">
                <h5 class="fw-bold text-primary mb-3"> Contribute</h5>
                <p>
                    We welcome contributions and improvements!  
                    You can fork the project, report issues, or suggest new features via our 
                    <a href="https://github.com/Zilitech/LibraCloud" target="_blank">GitHub Repository</a>.
                </p>
            </section>

            <!-- Version Info -->
            <section class="mb-5">
                <h5 class="fw-bold text-primary mb-3"> Version Info</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Version:</strong> 1.0.0 (Single Institution Edition)</li>
                    <li class="list-group-item"><strong>Release Date:</strong> November 2025</li>
                    <li class="list-group-item"><strong>License:</strong> Zilitech Software License (For Institutional Use Only)</li>
                </ul>
            </section>

            <!-- Contact -->
            <section>
                <h5 class="fw-bold text-primary mb-3"> Contact & Support</h5>
                <p>
                    For technical assistance, customization, or enterprise installation:
                </p>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Email:</strong> <a href="mailto:zilitechy@gmail.com">zilitechy@gmail.com</a></li>
                    <li class="list-group-item"><strong>Phone:</strong> +91 9449675050</li>
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