<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="light" data-menu-styles="light" data-toggled="close">

<head>

    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Valex - Bootstrap 5 Premium Admin & Dashboard Template </title>
    <meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
    <meta name="Author" content="Spruko Technologies Private Limited">
	<meta name="keywords" content="admin dashboard template,admin panel html,bootstrap dashboard,admin dashboard,html template,template dashboard html,html css,bootstrap 5 admin template,bootstrap admin template,bootstrap 5 dashboard,admin panel html template,dashboard template bootstrap,admin dashboard html template,bootstrap admin panel,simple html template,admin dashboard bootstrap">


    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/brand-logos/favicon.ico') }}" type="image/x-icon">
    
    <!-- Choices JS -->
    <script src="{{ asset('libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>

    <!-- Main Theme Js -->
    <script src="{{ asset('js/main.js') }}"></script>
    
    <!-- Bootstrap Css -->
    <link id="style" href="{{ asset('libs/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" >

    <!-- Style Css -->
    <link href="{{ asset('css/styles.min.css') }}" rel="stylesheet" >

    <!-- Icons Css -->
    <link href="{{ asset('css/icons.css') }}" rel="stylesheet" >

    <!-- Node Waves Css -->
    <link href="{{ asset('libs/node-waves/waves.min.css') }}" rel="stylesheet" > 

    <!-- Simplebar Css -->
    <link href="{{ asset('libs/simplebar/simplebar.min.css') }}" rel="stylesheet" >
    
    <!-- Color Picker Css -->
    <link rel="stylesheet" href="{{ asset('libs/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('libs/@simonwep/pickr/themes/nano.min.css') }}">



    <!-- Choices Css -->
    <link rel="stylesheet" href="{{ asset('libs/choices.js/public/assets/styles/choices.min.css') }}">



<!-- Jsvector Maps -->
<link rel="stylesheet" href="{{ asset('libs/jsvectormap/css/jsvectormap.min.css') }}">

</head>

<body>
        <!-- Start::app-content -->
        <div class="main-content app-content">
            <div class="container-fluid">
                <!-- Page Header -->
                <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                    <div>
                        <h4 class="mb-0">Hi, welcome back!</h4>
                        <p class="mb-0 text-muted">LibraCloud Library Management System.</p>
                    </div>
                    <div class="main-dashboard-header-right">
						<div>
							<label class="fs-13 text-muted">Customer Ratings</label>
							<div class="main-star">
								<i class="bi bi-star-fill fs-13 text-warning"></i> 
                                <i class="bi bi-star-fill fs-13 text-warning"></i> 
                                <i class="bi bi-star-fill fs-13 text-warning"></i> 
                                <i class="bi bi-star-fill fs-13 text-warning"></i> 
                                <i class="bi bi-star-fill fs-13 text-muted op-8"></i> <span>(14,873)</span>
							</div>
						</div>
						<div>
							<label class="fs-13 text-muted">Online Sales</label>
							<h5 class="mb-0 fw-semibold">563,275</h5>
						</div>
						<div>
							<label class="fs-13 text-muted">Offline Sales</label>
							<h5 class="mb-0 fw-semibold">783,675</h5>
						</div>
					</div>
                </div>
                <!-- End Page Header -->

                <!-- row -->
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                        <div class="card overflow-hidden sales-card bg-primary-gradient">
                            <div class="px-3 pt-3  pb-2 pt-0">
                                <div >
                                    <h6 class="mb-3 fs-12 text-fixed-white">Total Institutions</h6>
                                </div>
                                <div class="pb-0 mt-0">
                                    <div class="d-flex">
                                        <div >
                                            <h4 class="fs-20 fw-bold mb-1 text-fixed-white">57,412</h4>
                                            <p class="mb-0 fs-12 text-fixed-white op-7">Compared to last year</p>
                                        </div>
                                        <span class="float-end my-auto ms-auto">
                                            <i class="fas fa-arrow-circle-up text-fixed-white"></i>
                                            <span class="text-fixed-white op-7"> +427</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div id="compositeline"></div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                        <div class="card overflow-hidden sales-card bg-danger-gradient">
                            <div class="px-3 pt-3  pb-2 pt-0">
                                <div >
                                    <h6 class="mb-3 fs-12 text-fixed-white">Total Earnings</h6>
                                </div>
                                <div class="pb-0 mt-0">
                                    <div class="d-flex">
                                        <div >
                                            <h4 class="fs-20 fw-bold mb-1 text-fixed-white">$1230.17</h4>
                                            <p class="mb-0 fs-12 text-fixed-white op-7">Compared to last year</p>
                                        </div>
                                        <span class="float-end my-auto ms-auto">
                                            <i class="fas fa-arrow-circle-up text-fixed-white"></i>
                                            <span class="text-fixed-white op-7"> 23.09%</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div id="compositeline2"></div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                        <div class="card overflow-hidden sales-card bg-success-gradient">
                            <div class="px-3 pt-3  pb-2 pt-0">
                                <div >
                                    <h6 class="mb-3 fs-12 text-fixed-white">Total Books</h6>
                                </div>
                                <div class="pb-0 mt-0">
                                    <div class="d-flex">
                                        <div >
                                            <h4 class="fs-20 fw-bold mb-1 text-fixed-white">7,12,57,970</h4>
                                            <p class="mb-0 fs-12 text-fixed-white op-7">Compared to last year</p>
                                        </div>
                                        <span class="float-end my-auto ms-auto">
                                            <i class="fas fa-arrow-circle-up text-fixed-white"></i>
                                            <span class="text-fixed-white op-7"> 5.09%</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div id="compositeline3"></div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                        <div class="card overflow-hidden sales-card bg-warning-gradient">
                            <div class="px-3 pt-3  pb-2 pt-0">
                                <div >
                                    <h6 class="mb-3 fs-12 text-fixed-white">Total Renevals</h6>
                                </div>
                                <div class="pb-0 mt-0">
                                    <div class="d-flex">
                                        <div >
                                            <h4 class="fs-20 fw-bold mb-1 text-fixed-white">46,980</h4>
                                            <p class="mb-0 fs-12 text-fixed-white op-7">Compared to last yaer</p>
                                        </div>
                                        <span class="float-end my-auto ms-auto">
                                            <i class="fas fa-arrow-circle-up text-fixed-white"></i>
                                            <span class="text-fixed-white op-7"> 15.3</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div id="compositeline4"></div>
                        </div>
                    </div>
                </div>
                <!-- row closed -->





            </div>
        </div>
        <!-- End::app-content -->




    
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
    <!-- <script src="{{ asset('js/defaultmenu.min.js') }}"></script> -->

    <!-- Node Waves JS-->
    <script src="{{ asset('libs/node-waves/waves.min.js') }}"></script>

    <!-- Sticky JS -->
    <!-- <script src="{{ asset('js/sticky.js') }}"></script> -->

    <!-- Simplebar JS -->
    <!-- <script src="{{ asset('libs/simplebar/simplebar.min.js') }}"></script> -->
    <!-- <script src="{{ asset('js/simplebar.js') }}"></script> -->

    <!-- Color Picker JS -->
    <script src="{{ asset('libs/@simonwep/pickr/pickr.es5.min.js') }}"></script>

    
    <!-- Apex Charts JS -->
    <script src="{{ asset('libs/apexcharts/apexcharts.min.js') }}"></script>
    
    <!-- JSVector Maps JS -->
    <script src="{{ asset('libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
    
    <!-- JSVector Maps MapsJS -->
    <script src="{{ asset('libs/jsvectormap/maps/world-merc.js') }}"></script>
    <script src="{{ asset('js/us-merc-en.js') }}"></script>

    <!-- Chartjs Chart JS -->
    <!-- <script src="{{ asset('js/index.js') }}"></script> -->
    
    
    <!-- Custom-Switcher JS -->
    <!-- <script src="{{ asset('js/custom-switcher.min.js') }}"></script> -->
    <!-- Custom JS -->
    <!-- <script src="{{ asset('js/custom.js') }}"></script>    -->

</body>

</html>