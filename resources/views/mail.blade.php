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
                        <h5 class="page-title fs-21 mb-1">Mail</h5>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Pages</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Mail</li>
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
                            <button type="button" class="btn btn-warning  btn-icon me-2"><i class="mdi mdi-refresh"></i></button>
                        </div>
<div class="mb-xl-0">
    <div class="dropdown">
        <a href="{{ url('/') }}" class="btn btn-primary">
            Dashboard
        </a>
    </div>
</div>

                    </div>
                </div>
                <!-- Page Header Close -->

                <!-- Start::row-1 -->
					<div class="row main-content-mail">
						<div class="col-lg-4 col-xl-3 col-md-12">
							<div class="card mb-4 mg-md-b-0">
								<div class="card-body">
									<div class="main-content-left main-content-left-mail">
										<a class="btn btn-primary btn-compose" href="mail-compose.html">Compose</a>
										<div class="main-mail-menu">
											<nav class="nav main-nav-column mb-4">
												<a class="nav-link active" href=""><i class="bx bxs-inbox"></i> Inbox <span>20</span></a> <a class="nav-link" href=""><i class="bx bx-star"></i> Starred <span>3</span></a> <a class="nav-link" href=""><i class="bx bx-bookmarks"></i> Important <span>10</span></a> <a class="nav-link" href=""><i class="bx bx-send"></i> Sent Mail <span>8</span></a> <a class="nav-link" href=""><i class="bx bx-edit"></i> Drafts <span>15</span></a> <a class="nav-link" href=""><i class="bx bx-message-error"></i> Spam <span>128</span></a> <a class="nav-link" href=""><i class="bx bx-trash"></i> Trash <span>6</span></a>
											</nav><label class="main-content-label main-content-label-sm">Label</label>
											<nav class="nav main-nav-column mb-4">
												<a class="nav-link" href="javascript:void(0);"><i class="bx bx-folder-open"></i> Social <span>10</span></a> <a class="nav-link" href="javascript:void(0);"><i class="bx bx-folder"></i> Promotions <span>22</span></a> <a class="nav-link" href="javascript:void(0);"><i class="bx bx-folder-plus"></i> Updates <span>17</span></a>
											</nav><label class="main-content-label main-content-label-sm">Tags</label>
											<nav class="nav main-nav-column">
												<a class="nav-link" href="javascript:void(0);"><i class="bx bxl-twitter"></i> Twitter <span>2</span></a> <a class="nav-link" href="javascript:void(0);"><i class="bx bxl-github"></i> Github <span>32</span></a> <a class="nav-link" href="javascript:void(0);"><i class="bx bxl-google-plus"></i> Google <span>7</span></a>
											</nav>
										</div><!-- main-mail-menu -->
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-8 col-xl-9 col-md-12">
							<div class="card">
								<div class="main-content-body main-content-body-mail card-body">
									<div class="main-mail-header">
										<div>
											<h4 class="main-content-title mb-2">Inbox</h4>
											<p>You have 2 unread messages</p>
										</div>
										<div>
											<span>1-50 of 1200</span>
											<div class="btn-group" role="group">
												<button class="btn btn-outline-secondary disabled" type="button"><i class="icon ion-ios-arrow-back"></i></button> <button class="btn btn-outline-secondary" type="button"><i class="icon ion-ios-arrow-forward"></i></button>
											</div>
										</div>
									</div><!-- main-mail-list-header -->
									<div class="main-mail-options">
										<div class="btn-group ms-auto">
											<button class="btn btn-light"><i class="bx bx-refresh"></i></button> <button class="btn btn-light disabled"><i class="bx bx-archive"></i></button> <button class="btn btn-light disabled"><i class="bx bx-info-circle"></i></button> <button class="btn btn-light disabled"><i class="bx bx-trash"></i></button> <button class="btn btn-light disabled"><i class="bx bx-folder-open"></i></button> <button class="btn btn-light disabled"><i class="bx bx-purchase-tag-alt"></i></button>
										</div><!-- btn-group -->
									</div><!-- main-mail-options -->
									<div class="main-mail-list">
										<div class="main-mail-item unread">
											<div class="main-mail-checkbox">
												<label class="ckbox"><input type="checkbox"> <span></span></label>
											</div>
											<div class="main-mail-star">
												<i class="typcn typcn-star"></i>
											</div>
											<div class="main-img-user"><img alt="" class="online" src="../assets/images/faces/5.jpg"></div>
											<div class="main-mail-body">
												<div class="main-mail-from">
													Adrian Monino
												</div>
												<div class="main-mail-subject">
													<strong>Someone who believes in you</strong> <span>enean commodo li gula eget dolor cum socia eget dolor enean commodo li gula eget dolor cum socia eget dolor</span>
												</div>
											</div>
											<div class="main-mail-attachment">
												<i class="typcn typcn-attachment"></i>
											</div>
											<div class="main-mail-date">
												11:30am
											</div>
										</div>
										<div class="main-mail-item unread">
											<div class="main-mail-checkbox">
												<label class="ckbox"><input type="checkbox"> <span></span></label>
											</div>
											<div class="main-mail-star active">
												<i class="typcn typcn-star"></i>
											</div>
											<div class="main-img-user"><img alt="" class="online" src="../assets/images/faces/2.jpg"></div>
											<div class="main-mail-body">
												<div class="main-mail-from">
													Albert Ansing
												</div>
												<div class="main-mail-subject">
													<strong>Here's What You Missed This Week</strong> <span>enean commodo li gula eget dolor cum socia eget dolor enean commodo li gula eget dolor cum socia eget dolor...</span>
												</div>
											</div>
											<div class="main-mail-date">
												06:50am
											</div>
										</div>
										<div class="main-mail-item">
											<div class="main-mail-checkbox">
												<label class="ckbox"><input type="checkbox"> <span></span></label>
											</div>
											<div class="main-mail-star">
												<i class="typcn typcn-star"></i>
											</div>
											<div class="main-img-user"><img alt="" class="online" src="../assets/images/faces/9.jpg"></div>
											<div class="main-mail-body">
												<div class="main-mail-from">
													Carla Guden
												</div>
												<div class="main-mail-subject">
													<strong>4 Ways to Optimize Your Search</strong> <span>viva mus elemen tum semper nisi enean vulputat enean commodo li gula eget dolor cum socia eget dolor</span>
												</div>
											</div>
											<div class="main-mail-attachment">
												<i class="typcn typcn-attachment"></i>
											</div>
											<div class="main-mail-date">
												Yesterday
											</div>
										</div>
										<div class="main-mail-item unread">
											<div class="main-mail-checkbox">
												<label class="ckbox"><input type="checkbox"> <span></span></label>
											</div>
											<div class="main-mail-star">
												<i class="typcn typcn-star"></i>
											</div>
											<div class="main-img-user"><img alt="" class="online" src="../assets/images/faces/10.jpg"></div>
											<div class="main-mail-body">
												<div class="main-mail-from">
													Reven Galeon
												</div>
												<div class="main-mail-subject">
													<strong>We're Giving a Macbook for Free</strong> <span>viva mus elemen tum semper nisi enean vulputat enean commodo li gula eget dolor cum socia eget dolor</span>
												</div>
											</div>
											<div class="main-mail-date">
												Yesterday
											</div>
										</div>
										<div class="main-mail-item">
											<div class="main-mail-checkbox">
												<label class="ckbox"><input type="checkbox"> <span></span></label>
											</div>
											<div class="main-mail-star">
												<i class="typcn typcn-star"></i>
											</div>
											<div class="main-img-user"><img alt="" class="online" src="../assets/images/faces/12.jpg"></div>
											<div class="main-mail-body">
												<div class="main-mail-from">
													Elisse Tan
												</div>
												<div class="main-mail-subject">
													<strong>Keep Your Personal Data Safe</strong> <span>viva mus elemen tum semper nisi enean vulputat enean commodo li gula eget dolor cum socia eget dolor</span>
												</div>
											</div>
											<div class="main-mail-date">
												Oct 13
											</div>
										</div>
										<div class="main-mail-item">
											<div class="main-mail-checkbox">
												<label class="ckbox"><input type="checkbox"> <span></span></label>
											</div>
											<div class="main-mail-star">
												<i class="typcn typcn-star"></i>
											</div>
											<div class="main-img-user"><img alt="" class="online" src="../assets/images/faces/14.jpg"></div>
											<div class="main-mail-body">
												<div class="main-mail-from">
													Marianne Audrey
												</div>
												<div class="main-mail-subject">
													<strong>We've Made Some Changes</strong> <span>viva mus elemen tum semper nisi enean vulputat enean commodo li gula eget dolor cum socia eget dolor</span>
												</div>
											</div>
											<div class="main-mail-date">
												Oct 13
											</div>
										</div>
										<div class="main-mail-item">
											<div class="main-mail-checkbox">
												<label class="ckbox"><input type="checkbox"> <span></span></label>
											</div>
											<div class="main-mail-star">
												<i class="typcn typcn-star"></i>
											</div>
											<div class="main-avatar bg-secondary">
												J
											</div>
											<div class="main-mail-body">
												<div class="main-mail-from">
													Jane Phoebe
												</div>
												<div class="main-mail-subject">
													<strong>Grab Our Holiday Deals</strong> <span>viva mus elemen tum semper nisi enean vulputat enean commodo li gula eget dolor cum socia eget dolor</span>
												</div>
											</div>
											<div class="main-mail-date">
												Oct 12
											</div>
										</div>
										<div class="main-mail-item">
											<div class="main-mail-checkbox">
												<label class="ckbox"><input type="checkbox"> <span></span></label>
											</div>
											<div class="main-mail-star">
												<i class="typcn typcn-star"></i>
											</div>
											<div class="main-img-user"><img alt="" class="online" src="../assets/images/faces/15.jpg"></div>
											<div class="main-mail-body">
												<div class="main-mail-from">
													Raffy Godinez
												</div>
												<div class="main-mail-subject">
													<strong>Just a Few Steps Away</strong> <span>viva mus elemen tum semper nisi enean vulputat enean commodo li gula eget dolor cum socia eget dolor</span>
												</div>
											</div>
											<div class="main-mail-date">
												Oct 05
											</div>
										</div>
										<div class="main-mail-item">
											<div class="main-mail-checkbox">
												<label class="ckbox"><input type="checkbox"> <span></span></label>
											</div>
											<div class="main-mail-star active">
												<i class="typcn typcn-star"></i>
											</div>
											<div class="main-img-user"><img alt="" class="online" src="../assets/images/faces/7.jpg"></div>
											<div class="main-mail-body">
												<div class="main-mail-from">
													Allan Cadungog
												</div>
												<div class="main-mail-subject">
													<strong>Credit Card Promos</strong> <span>viva mus elemen tum semper nisi enean vulputat enean commodo li gula eget dolor cum socia eget dolor</span>
												</div>
											</div>
											<div class="main-mail-date">
												Oct 04
											</div>
										</div>
										<div class="main-mail-item">
											<div class="main-mail-checkbox">
												<label class="ckbox"><input type="checkbox"> <span></span></label>
											</div>
											<div class="main-mail-star">
												<i class="typcn typcn-star"></i>
											</div>
											<div class="main-img-user"><img alt="" class="online" src="../assets/images/faces/10.jpg"></div>
											<div class="main-mail-body">
												<div class="main-mail-from">
													Alfie Salinas
												</div>
												<div class="main-mail-subject">
													<strong>4 Ways to Optimize Your Search</strong> <span>viva mus elemen tum semper nisi enean vulputat enean commodo li gula eget dolor cum socia eget dolor</span>
												</div>
											</div>
											<div class="main-mail-date">
												Oct 02
											</div>
										</div>
										<div class="main-mail-item border-bottom-0">
											<div class="main-mail-checkbox">
												<label class="ckbox"><input type="checkbox"> <span></span></label>
											</div>
											<div class="main-mail-star">
												<i class="typcn typcn-star"></i>
											</div>
											<div class="main-img-user"><img alt="" class="online" src="../assets/images/faces/1.jpg"></div>
											<div class="main-mail-body">
												<div class="main-mail-from">
													Jove Guden
												</div>
												<div class="main-mail-subject">
													<strong>Keep Your Personal Data Safe</strong> <span>viva mus elemen tum semper nisi enean vulputat enean commodo li gula eget dolor cum socia eget dolor</span>
												</div>
											</div>
											<div class="main-mail-date">
												Oct 02
											</div>
										</div>
									</div>
									<div class="mg-lg-b-30"></div>
								</div>
							</div>
						</div>
					</div>
                <!--End::row-1 -->

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