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

    <!-- Start Switcher -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="switcher-canvas" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title text-default" id="offcanvasRightLabel">Switcher</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <nav class="border-bottom border-block-end-dashed">
                <div class="nav nav-tabs nav-justified" id="switcher-main-tab" role="tablist">
                    <button class="nav-link active" id="switcher-home-tab" data-bs-toggle="tab" data-bs-target="#switcher-home"
                        type="button" role="tab" aria-controls="switcher-home" aria-selected="true">Theme Styles</button>
                    <button class="nav-link" id="switcher-profile-tab" data-bs-toggle="tab" data-bs-target="#switcher-profile"
                        type="button" role="tab" aria-controls="switcher-profile" aria-selected="false">Theme Colors</button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active border-0" id="switcher-home" role="tabpanel" aria-labelledby="switcher-home-tab"
                    tabindex="0">
                    <div class="">
                        <p class="switcher-style-head">Theme Color Mode:</p>
                        <div class="row switcher-style gx-0">
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-light-theme">
                                        Light
                                    </label>
                                    <input class="form-check-input" type="radio" name="theme-style" id="switcher-light-theme"
                                        checked>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-dark-theme">
                                        Dark
                                    </label>
                                    <input class="form-check-input" type="radio" name="theme-style" id="switcher-dark-theme">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <p class="switcher-style-head">Directions:</p>
                        <div class="row switcher-style gx-0">
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-ltr">
                                        LTR
                                    </label>
                                    <input class="form-check-input" type="radio" name="direction" id="switcher-ltr" checked>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-rtl">
                                        RTL
                                    </label>
                                    <input class="form-check-input" type="radio" name="direction" id="switcher-rtl">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <p class="switcher-style-head">Navigation Styles:</p>
                        <div class="row switcher-style gx-0">
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-vertical">
                                        Vertical
                                    </label>
                                    <input class="form-check-input" type="radio" name="navigation-style" id="switcher-vertical"
                                        checked>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-horizontal">
                                        Horizontal
                                    </label>
                                    <input class="form-check-input" type="radio" name="navigation-style"
                                        id="switcher-horizontal">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="navigation-menu-styles">
                        <p class="switcher-style-head">Vertical & Horizontal Menu Styles:</p>
                        <div class="row switcher-style gx-0 pb-2 gy-2">
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-menu-click">
                                        Menu Click
                                    </label>
                                    <input class="form-check-input" type="radio" name="navigation-menu-styles"
                                        id="switcher-menu-click">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-menu-hover">
                                        Menu Hover
                                    </label>
                                    <input class="form-check-input" type="radio" name="navigation-menu-styles"
                                        id="switcher-menu-hover">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-icon-click">
                                        Icon Click
                                    </label>
                                    <input class="form-check-input" type="radio" name="navigation-menu-styles"
                                        id="switcher-icon-click">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-icon-hover">
                                        Icon Hover
                                    </label>
                                    <input class="form-check-input" type="radio" name="navigation-menu-styles"
                                        id="switcher-icon-hover">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sidemenu-layout-styles">
                        <p class="switcher-style-head">Sidemenu Layout Styles:</p>
                        <div class="row switcher-style gx-0 pb-2 gy-2">
                            <div class="col-sm-6">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-default-menu">
                                        Default Menu
                                    </label>
                                    <input class="form-check-input" type="radio" name="sidemenu-layout-styles"
                                        id="switcher-default-menu" checked>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-closed-menu">
                                        Closed Menu
                                    </label>
                                    <input class="form-check-input" type="radio" name="sidemenu-layout-styles"
                                        id="switcher-closed-menu">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-icontext-menu">
                                        Icon Text
                                    </label>
                                    <input class="form-check-input" type="radio" name="sidemenu-layout-styles"
                                        id="switcher-icontext-menu">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-icon-overlay">
                                        Icon Overlay
                                    </label>
                                    <input class="form-check-input" type="radio" name="sidemenu-layout-styles"
                                        id="switcher-icon-overlay">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-detached">
                                        Detached
                                    </label>
                                    <input class="form-check-input" type="radio" name="sidemenu-layout-styles"
                                        id="switcher-detached">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-double-menu">
                                        Double Menu
                                    </label>
                                    <input class="form-check-input" type="radio" name="sidemenu-layout-styles"
                                        id="switcher-double-menu">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <p class="switcher-style-head">Page Styles:</p>
                        <div class="row switcher-style gx-0">
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-regular">
                                        Regular
                                    </label>
                                    <input class="form-check-input" type="radio" name="page-styles" id="switcher-regular"
                                        checked>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-classic">
                                        Classic
                                    </label>
                                    <input class="form-check-input" type="radio" name="page-styles" id="switcher-classic">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-modern">
                                        Modern
                                    </label>
                                    <input class="form-check-input" type="radio" name="page-styles" id="switcher-modern">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <p class="switcher-style-head">Layout Width Styles:</p>
                        <div class="row switcher-style gx-0">
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-full-width">
                                        Full Width
                                    </label>
                                    <input class="form-check-input" type="radio" name="layout-width" id="switcher-full-width"
                                        checked>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-boxed">
                                        Boxed
                                    </label>
                                    <input class="form-check-input" type="radio" name="layout-width" id="switcher-boxed">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <p class="switcher-style-head">Menu Positions:</p>
                        <div class="row switcher-style gx-0">
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-menu-fixed">
                                        Fixed
                                    </label>
                                    <input class="form-check-input" type="radio" name="menu-positions" id="switcher-menu-fixed"
                                        checked>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-menu-scroll">
                                        Scrollable
                                    </label>
                                    <input class="form-check-input" type="radio" name="menu-positions" id="switcher-menu-scroll">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <p class="switcher-style-head">Header Positions:</p>
                        <div class="row switcher-style gx-0">
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-header-fixed">
                                        Fixed
                                    </label>
                                    <input class="form-check-input" type="radio" name="header-positions"
                                        id="switcher-header-fixed" checked>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-header-scroll">
                                        Scrollable
                                    </label>
                                    <input class="form-check-input" type="radio" name="header-positions"
                                        id="switcher-header-scroll">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <p class="switcher-style-head">Loader:</p>
                        <div class="row switcher-style gx-0">
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-loader-enable">
                                        Enable
                                    </label>
                                    <input class="form-check-input" type="radio" name="page-loader"
                                        id="switcher-loader-enable" checked>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check switch-select">
                                    <label class="form-check-label" for="switcher-loader-disable">
                                        Disable
                                    </label>
                                    <input class="form-check-input" type="radio" name="page-loader"
                                        id="switcher-loader-disable" checked>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade border-0" id="switcher-profile" role="tabpanel" aria-labelledby="switcher-profile-tab" tabindex="0">
                    <div>
                        <div class="theme-colors">
                            <p class="switcher-style-head">Menu Colors:</p>
                            <div class="d-flex switcher-style pb-2">
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-white" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Light Menu" type="radio" name="menu-colors"
                                        id="switcher-menu-light" checked>
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-dark" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Dark Menu" type="radio" name="menu-colors"
                                        id="switcher-menu-dark">
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-primary" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Color Menu" type="radio" name="menu-colors"
                                        id="switcher-menu-primary">
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-gradient" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Gradient Menu" type="radio" name="menu-colors"
                                        id="switcher-menu-gradient">
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-transparent"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Transparent Menu"
                                        type="radio" name="menu-colors" id="switcher-menu-transparent">
                                </div>
                            </div>
                            <div class="px-4 pb-3 text-muted fs-11">Note:If you want to change color Menu dynamically change from below Theme Primary color picker</div>
                        </div>
                        <div class="theme-colors">
                            <p class="switcher-style-head">Header Colors:</p>
                            <div class="d-flex switcher-style pb-2">
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-white" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Light Header" type="radio" name="header-colors"
                                        id="switcher-header-light" checked>
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-dark" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Dark Header" type="radio" name="header-colors"
                                        id="switcher-header-dark">
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-primary" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Color Header" type="radio" name="header-colors"
                                        id="switcher-header-primary">
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-gradient" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Gradient Header" type="radio" name="header-colors"
                                        id="switcher-header-gradient">
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-transparent" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Transparent Header" type="radio" name="header-colors"
                                        id="switcher-header-transparent">
                                </div>
                            </div>
                            <div class="px-4 pb-3 text-muted fs-11">Note:If you want to change color Header dynamically change from below Theme Primary color picker</div>
                        </div>
                        <div class="theme-colors">
                            <p class="switcher-style-head">Theme Primary:</p>
                            <div class="d-flex flex-wrap align-items-center switcher-style">
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-primary-1" type="radio"
                                        name="theme-primary" id="switcher-primary">
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-primary-2" type="radio"
                                        name="theme-primary" id="switcher-primary1">
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-primary-3" type="radio" name="theme-primary"
                                        id="switcher-primary2">
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-primary-4" type="radio" name="theme-primary"
                                        id="switcher-primary3">
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-primary-5" type="radio" name="theme-primary"
                                        id="switcher-primary4">
                                </div>
                                <div class="form-check switch-select ps-0 mt-1 color-primary-light">
                                    <div class="theme-container-primary"></div>
                                    <div class="pickr-container-primary"></div>
                                </div>
                            </div>
                        </div>
                        <div class="theme-colors">
                            <p class="switcher-style-head">Theme Background:</p>
                            <div class="d-flex flex-wrap align-items-center switcher-style">
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-bg-1" type="radio"
                                        name="theme-background" id="switcher-background">
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-bg-2" type="radio"
                                        name="theme-background" id="switcher-background1">
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-bg-3" type="radio" name="theme-background"
                                        id="switcher-background2">
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-bg-4" type="radio"
                                        name="theme-background" id="switcher-background3">
                                </div>
                                <div class="form-check switch-select me-3">
                                    <input class="form-check-input color-input color-bg-5" type="radio"
                                        name="theme-background" id="switcher-background4">
                                </div>
                                <div class="form-check switch-select ps-0 mt-1 tooltip-static-demo color-bg-transparent">
                                    <div class="theme-container-background"></div>
                                    <div class="pickr-container-background"></div>
                                </div>
                            </div>
                        </div>
                        <div class="menu-image mb-3">
                            <p class="switcher-style-head">Menu With Background Image:</p>
                            <div class="d-flex flex-wrap align-items-center switcher-style">
                                <div class="form-check switch-select m-2">
                                    <input class="form-check-input bgimage-input bg-img1" type="radio"
                                        name="theme-background" id="switcher-bg-img">
                                </div>
                                <div class="form-check switch-select m-2">
                                    <input class="form-check-input bgimage-input bg-img2" type="radio"
                                        name="theme-background" id="switcher-bg-img1">
                                </div>
                                <div class="form-check switch-select m-2">
                                    <input class="form-check-input bgimage-input bg-img3" type="radio" name="theme-background"
                                        id="switcher-bg-img2">
                                </div>
                                <div class="form-check switch-select m-2">
                                    <input class="form-check-input bgimage-input bg-img4" type="radio"
                                        name="theme-background" id="switcher-bg-img3">
                                </div>
                                <div class="form-check switch-select m-2">
                                    <input class="form-check-input bgimage-input bg-img5" type="radio"
                                        name="theme-background" id="switcher-bg-img4">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between canvas-footer flex-wrap"> 
                    <a href="javascript:void(0);" id="reset-all" class="btn btn-danger w-100 m-1">Reset</a> 
                </div>
            </div>
        </div>
    </div>
    <!-- End Switcher -->


    <!-- Loader -->
    <div id="loader" >
        <img src="{{ asset('images/media/loader.svg') }}" alt="">
    </div>
    <!-- Loader -->

    <div class="page">


       

      

       


     

        <!-- Start::app-content -->
        <div class="main-content app-content">
            <div class="container-fluid">



                <!-- row opened -->
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-xl-7">
                        <div class="card">
                            <div class="card-header pb-0">
                                <div class="d-flex justify-content-between">
                                    <h4 class="card-title mb-0">Order status</h4>
                                    <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-light bg-transparent rounded-pill" data-bs-toggle="dropdown"><i
                                        class="fe fe-more-horizontal"></i></a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);">Action</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Another
                                            Action</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Something Else
                                            Here</a>
                                    </div>
                                </div>
                                <p class="fs-12 text-muted mb-0">Order Status and Tracking. Track your order from ship date to arrival. To begin, enter your order number.</p>
                            </div>
                            <div class="card-body">
                                <div class="total-revenue">
                                    <div>
                                        <h4>120,750</h4>
                                        <label><span class="bg-primary"></span>success</label>
                                    </div>
                                    <div>
                                        <h4>56,108</h4>
                                        <label><span class="bg-danger"></span>Pending</label>
                                    </div>
                                    <div>
                                        <h4>32,895</h4>
                                        <label><span class="bg-warning"></span>Failed</label>
                                    </div>
                                    </div>
                                <div id="Sales-bar" class="sales-bar mt-4"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-xl-5">
                        <div class="card card-dashboard-map-one">
                            <h4 class="card-title">Sales Revenue by Customers in USA</h4>
                            <p class="fs-12 text-muted">Sales Performance of all states in the United States.</p>
                            <div id="us-map1" class="pt-1"></div>
                        </div>
                    </div>
                </div>
                <!-- row closed -->

                <!-- row opened -->
                <div class="row">
                    <div class="col-xl-4 col-md-12 col-lg-12">
                        <div class="card overflow-hidden">
                            <div class="card-header pb-1">
                                <h3 class="card-title mb-2">Recent Customers</h3>
                                <p class="fs-12 mb-0 text-muted">A customer is an individual or business that purchases the goods service has evolved to include real-time</p>
                            </div>
                            <div class="card-body p-0 customers mt-1">
                                <div class="list-group list-lg-group list-group-flush">
                                    <div class="list-group-item list-group-item-action">
                                        <div class="d-flex">
                                            <img class="avatar avatar-md rounded-circle my-auto me-3" src="{{ asset('images/faces/3.jpg') }}" alt="Image description">
                                            <div class="flex-grow-1">
                                                <div class="d-flex align-items-center">
                                                    <div class="mt-0">
                                                        <h5 class="mb-1 fs-15">Samantha Melon</h5>
                                                        <p class="mb-0 fs-13 text-muted">User ID: #1234 <span class="text-success ms-2 d-inline-block">Paid</span></p>
                                                    </div>
                                                    <div class="ms-auto w-45 fs-16 mt-2">
                                                        <div id="spark1" class="w-100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-group-item list-group-item-action br-t-1">
                                        <div class="d-flex">
                                            <img class="avatar avatar-md rounded-circle my-auto me-3" src="{{ asset('images/faces/11.jpg') }}" alt="Image description">
                                            <div class="flex-grow-1">
                                                <div class="d-flex align-items-center">
                                                    <div class="mt-1">
                                                        <h5 class="mb-1 fs-15">Jimmy Changa</h5>
                                                        <p class="mb-0 fs-13 text-muted">User ID: #1234 <span class="text-danger ms-2 d-inline-block">Pending</span></p>
                                                    </div>
                                                    <div class="ms-auto w-45 fs-16 mt-2">
                                                        <div id="spark2" class="w-100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-group-item list-group-item-action br-t-1">
                                        <div class="d-flex">
                                            <img class="avatar avatar-md rounded-circle my-auto me-3" src="{{ asset('images/faces/17.jpg') }}" alt="Image description">
                                            <div class="flex-grow-1">
                                                <div class="d-flex align-items-center">
                                                    <div class="mt-1">
                                                        <h5 class="mb-1 fs-15">Gabe Lackmen</h5>
                                                        <p class="mb-0 fs-13 text-muted">User ID: #1234 <span class="text-danger ms-2 d-inline-block">Pending</span></p>
                                                    </div>
                                                    <div class="ms-auto w-45 fs-16 mt-2">
                                                        <div id="spark3" class="w-100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-group-item list-group-item-action br-t-1">
                                        <div class="d-flex">
                                            <img class="avatar avatar-md rounded-circle my-auto me-3" src="{{ asset('images/faces/15.jpg') }}" alt="Image description">
                                            <div class="flex-grow-1">
                                                <div class="d-flex align-items-center">
                                                    <div class="mt-1">
                                                        <h5 class="mb-1 fs-15">Manuel Labor</h5>
                                                        <p class="mb-0 fs-13 text-muted">User ID: #1234 <span class="text-success ms-2 d-inline-block">Paid</span></p>
                                                    </div>
                                                    <div class="ms-auto w-45 fs-16 mt-2">
                                                        <div id="spark4" class="w-100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-group-item list-group-item-action br-t-1 br-be-7 br-bs-7">
                                        <div class="d-flex">
                                            <img class="avatar avatar-md rounded-circle my-auto me-3" src="{{ asset('images/faces/6.jpg') }}" alt="Image description">
                                            <div class="flex-grow-1">
                                                <div class="d-flex align-items-center">
                                                    <div class="mt-1">
                                                        <h5 class="mb-1 fs-15">Sharon Needles</h5>
                                                        <p class="b-0 fs-13 text-muted mb-0">User ID: #1234 <span class="text-success ms-2 d-inline-block">Paid</span></p>
                                                    </div>
                                                    <div class="ms-auto w-45 fs-16 mt-2">
                                                        <div id="spark5" class="w-100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-12 col-lg-6">
                        <div class="card">
                            <div class="card-header pb-1">
                                <h3 class="card-title mb-2">Sales Activity</h3>
                                <p class="fs-12 mb-0 text-muted">Sales activities are the tactics that salespeople use to achieve their goals and objective</p>
                            </div>
                            <div class="product-timeline card-body pt-2 mt-1">
                                <ul class="timeline-1 mb-0">
                                    <li class="mt-0"> <i class="fe fe-pie-chart bg-primary-gradient text-fixed-white product-icon"></i> <span class="fw-medium mb-4 fs-14">Total Products</span> <a href="javascript:void(0);" class="float-end fs-11 text-muted">3 days ago</a>
                                        <p class="mb-0 text-muted fs-12">1.3k New Products</p>
                                    </li>
                                    <li class="mt-0"> <i class="fe fe-shopping-cart bg-danger-gradient text-fixed-white product-icon"></i> <span class="fw-medium mb-4 fs-14">Total Sales</span> <a href="javascript:void(0);" class="float-end fs-11 text-muted">35 mins ago</a>
                                        <p class="mb-0 text-muted fs-12">1k New Sales</p>
                                    </li>
                                    <li class="mt-0"> <i class="fe fe-bar-chart bg-success-gradient text-fixed-white product-icon"></i> <span class="fw-medium mb-4 fs-14">Total Revenue</span> <a href="javascript:void(0);" class="float-end fs-11 text-muted">50 mins ago</a>
                                        <p class="mb-0 text-muted fs-12">23.5K New Revenue</p>
                                    </li>
                                    <li class="mt-0"> <i class="fe fe-box bg-warning-gradient text-fixed-white product-icon"></i> <span class="fw-medium mb-4 fs-14">Total Profit</span> <a href="javascript:void(0);" class="float-end fs-11 text-muted">1 hour ago</a>
                                        <p class="mb-0 text-muted fs-12">3k New profit</p>
                                    </li>
                                    <li class="mt-0"> <i class="fe fe-eye bg-purple-gradient text-fixed-white product-icon"></i> <span class="fw-medium mb-4 fs-14">Customer Visits</span> <a href="javascript:void(0);" class="float-end fs-11 text-muted">1 day ago</a>
                                        <p class="mb-0 text-muted fs-12">15% increased</p>
                                    </li>
                                    <li class="mt-0 mb-0"> <i class="fe fe-edit bg-primary-gradient text-fixed-white product-icon"></i> <span class="fw-medium mb-4 fs-14">Customer Reviews</span> <a href="javascript:void(0);" class="float-end fs-11 text-muted">1 day ago</a>
                                        <p class="mb-0 text-muted fs-12">1.5k reviews</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-12 col-lg-6">
                        <div class="card">
                            <div class="card-header pb-0">
                                <h3 class="card-title mb-2">Recent Orders</h3>
                                <p class="fs-12 mb-0 text-muted">An order is an investor's instructions to a broker or brokerage firm to purchase or sell</p>
                            </div>
                            <div class="card-body sales-info pb-0 pt-0">
                                <div id="chart" class="ht-150"></div>
                                <div class="row sales-infomation pb-0 mb-0 mx-auto w-100">
                                    <div class="col-md-6 col">
                                        <p class="mb-0 d-flex"><span class="legend bg-primary brround"></span>Delivered</p>
                                        <h3 class="mb-1">5238</h3>
                                        <div class="d-flex">
                                            <p class="text-muted ">Last 6 months</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col">
                                        <p class="mb-0 d-flex"><span class="legend bg-info brround"></span>Cancelled</p>
                                            <h3 class="mb-1">3467</h3>
                                        <div class="d-flex">
                                            <p class="text-muted">Last 6 months</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card ">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center pb-2">
                                            <p class="mb-0">Total Sales</p>
                                        </div>
                                        <h4 class="fw-bold mb-2">$7,590</h4>
                                        <div class="progress progress-style progress-sm">
                                            <div class="progress-bar bg-primary-gradient" style="width: 80%" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="78"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-4 mt-md-0">
                                        <div class="d-flex align-items-center pb-2">
                                            <p class="mb-0">Active Users</p>
                                        </div>
                                        <h4 class="fw-bold mb-2">$5,460</h4>
                                        <div class="progress progress-style progress-sm">
                                            <div class="progress-bar bg-danger-gradient" style="width: 45%" role="progressbar"  aria-valuenow="45" aria-valuemin="0" aria-valuemax="45"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- row close -->

                <!-- row opened -->
                <div class="row">
                    <div class="col-md-12 col-lg-4 col-xl-4">
                        <div class="card top-countries-card">
                            <div class="card-header p-0">
                                <h6 class="card-title fs-13 mb-2">Your Top Countries</h6><span class="d-block mg-b-10 text-muted fs-12 mb-2">Sales performance revenue based by country</span>
                            </div>
                            <div class="list-group border">
                                <div class="list-group-item border-top-0" id="br-t-0">
                                    <p>United States</p><span>$1,671.10</span>
                                </div>
                                <div class="list-group-item">
                                    <p>Netherlands</p><span>$1,064.75</span>
                                </div>
                                <div class="list-group-item">
                                    <p>United Kingdom</p><span>$1,055.98</span>
                                </div>
                                <div class="list-group-item">
                                    <p>Canada</p><span>$1,045.49</span>
                                </div>
                                <div class="list-group-item">
                                    <p>India</p><span>$1,930.12</span>
                                </div>
                                <div class="list-group-item border-bottom-0 mb-0">
                                    <p>Australia</p><span>$1,042.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-8 col-xl-8">
                        <div class="card card-table">
                            <div class=" card-header p-0 d-flex justify-content-between">
                                <h4 class="card-title mb-1">Your Most Recent Earnings</h4>
                                <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-light bg-transparent rounded-pill" data-bs-toggle="dropdown"><i
                                    class="fe fe-more-horizontal"></i></a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="javascript:void(0);">Action</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Another
                                        Action</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Something Else
                                        Here</a>
                                </div>
                            </div>
                            <span class="fs-12 text-muted mb-3 ">This is your most recent earnings for today's date.</span>
                            <div class="table-responsive country-table">
                                <table class="table table-striped table-bordered mb-0 text-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="wd-lg-25p">Date</th>
                                            <th class="wd-lg-25p">Sales Count</th>
                                            <th class="wd-lg-25p">Earnings</th>
                                            <th class="wd-lg-25p">Tax Witheld</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>05 Dec 2019</td>
                                            <td class="fw-medium">34</td>
                                            <td class="fw-medium">$658.20</td>
                                            <td class="text-danger fw-medium">-$45.10</td>
                                        </tr>
                                        <tr>
                                            <td>06 Dec 2019</td>
                                            <td class="fw-medium">26</td>
                                            <td class="fw-medium">$453.25</td>
                                            <td class="text-danger fw-medium">-$15.02</td>
                                        </tr>
                                        <tr>
                                            <td>07 Dec 2019</td>
                                            <td class="fw-medium">34</td>
                                            <td class="fw-medium">$653.12</td>
                                            <td class="text-danger fw-medium">-$13.45</td>
                                        </tr>
                                        <tr>
                                            <td>08 Dec 2019</td>
                                            <td class="fw-medium">45</td>
                                            <td class="fw-medium">$546.47</td>
                                            <td class="text-danger fw-medium">-$24.22</td>
                                        </tr>
                                        <tr>
                                            <td>09 Dec 2019</td>
                                            <td class="fw-medium">31</td>
                                            <td class="fw-medium">$425.72</td>
                                            <td class="text-danger fw-medium">-$25.01</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /row -->

            </div>
        </div>
        <!-- End::app-content -->

        <!-- Footer Start -->
        <footer class="footer mt-auto py-3 bg-white text-center">
            <div class="container">
                <span class="text-muted"> Copyright © <span id="year"></span> <a
                        href="javascript:void(0);" class="text-dark fw-semibold">Valex</a>.
                    Designed with <span class="bi bi-heart-fill text-danger"></span> by <a href="javascript:void(0);">
                        <span class="fw-semibold text-primary text-decoration-underline">Spruko</span>
                    </a> All
                    rights
                    reserved
                </span>
            </div>
        </footer>
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
    <script src="{{ asset('js/index.js') }}"></script>
    
    
    <!-- Custom-Switcher JS -->
    <script src="{{ asset('js/custom-switcher.min.js') }}"></script>
    <!-- Custom JS -->
    <!-- <script src="{{ asset('js/custom.js') }}"></script>    -->

</body>

</html>