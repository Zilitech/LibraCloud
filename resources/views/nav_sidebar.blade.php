
        <!-- Start::app-sidebar -->
        <aside class="app-sidebar sticky" id="sidebar">

            <!-- Start::main-sidebar-header -->
@if(!empty($settings->logo))
    <div class="main-sidebar-header">
        <a href="{{ url('/') }}" class="header-logo">
            <img src="{{ asset($settings->logo) }}" alt="logo">
        </a>
    </div>
@endif




            <!-- End::main-sidebar-header -->

            <!-- Start::main-sidebar -->
            <div class="main-sidebar" id="sidebar-scroll">

                <!-- Start::nav -->
                <nav class="main-menu-container nav nav-pills flex-column sub-open">
                    <div class="slide-left" id="slide-left">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"> <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path> </svg>
                    </div>
                    <ul class="main-menu">
                        <!-- Start::slide__category -->
                        <li class="slide__category"><span class="category-name">Main</span></li>
                        <!-- End::slide__category -->

                        <!-- Start::slide -->
                        <li class="slide">
                            <a href="{{ url('/') }}" class="side-menu__item" data-bs-toggle="tooltip" data-bs-placement="right" title="Dashboard">
                                <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24" ><path d="M0 0h24v24H0V0z" fill="none"/><path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3"/><path d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z"/></svg>
                                <span class="side-menu__label">Dashboard</span>
                                <span class="badge bg-success ms-auto menu-badge">1</span>
                            </a>
                        </li>
                        <!-- End::slide -->

                        <!-- Start::slide__category -->
                        <li class="slide__category"><span class="category-name">Book Management</span></li>
                        <!-- End::slide__category -->

                        <!-- Start::slide -->
                        <li class="slide">
    <a href="{{ url('all_books') }}" class="side-menu__item">
        <img src="https://cdn-icons-png.flaticon.com/128/10446/10446347.png" 
             alt="All Books Icon" 
             class="side-menu__icon" 
             style="width: 24px; height: 24px;">
        <span class="side-menu__label">All Books</span>
    </a>
</li>

                        <!-- End::slide -->

                        <!-- Start::slide -->
                       <li class="slide">
    <a href="{{ url('add_book') }}" class="side-menu__item">
        <img src="https://cdn-icons-png.flaticon.com/128/865/865169.png" 
             alt="Add New Book Icon" 
             class="side-menu__icon" 
             style="width: 24px; height: 24px;">
        <span class="side-menu__label">Add New Book</span>
    </a>
</li>

                                                <li class="slide">
    <a href="{{ url('category') }}" class="side-menu__item">
        <img src="https://cdn-icons-png.flaticon.com/128/18564/18564365.png" 
             alt="Categories Icon" 
             class="side-menu__icon" 
             style="width: 24px; height: 24px;">
        <span class="side-menu__label">Categories</span>
    </a>
</li>

                                               <li class="slide">
    <a href="{{ url('authors') }}" class="side-menu__item">
        <img src="https://cdn-icons-png.flaticon.com/128/1948/1948210.png" 
             alt="Authors Icon" 
             class="side-menu__icon" 
             style="width: 24px; height: 24px;">
        <span class="side-menu__label">Authors</span>
    </a>
</li>

                                               <li class="slide">
    <a href="{{ url('inventory_management') }}" class="side-menu__item">
        <img src="https://cdn-icons-png.flaticon.com/128/12141/12141658.png" 
             alt="Inventory Management Icon" 
             class="side-menu__icon" 
             style="width: 24px; height: 24px;">
        <span class="side-menu__label">Inventory Management</span>
    </a>
</li>

                        <!-- End::slide -->

                        <!-- Start::slide__category -->
                        <li class="slide__category"><span class="category-name">Barcode Management</span></li>
                        <!-- End::slide__category -->

                                                                        <li class="slide">
    <a href="{{ url('scan_barcode') }}" class="side-menu__item">
        <img src="https://cdn-icons-png.flaticon.com/128/11414/11414226.png" 
             alt="Scan Book Barcode Icon" 
             class="side-menu__icon" 
             style="width: 24px; height: 24px;">
        <span class="side-menu__label">Scan Book Barcode</span>
    </a>
</li>

                                                                       <li class="slide">
    <a href="{{ route('barcode.book') }}" class="side-menu__item">
        <img src="https://cdn-icons-png.flaticon.com/128/8975/8975861.png" 
             alt="Generate Barcode Icon" 
             class="side-menu__icon" 
             style="width: 24px; height: 24px;">
        <span class="side-menu__label">Generate Barcode</span>
    </a>
</li>

                                                                        <li class="slide">
    <a href="{{url('lookup_by_barcode')}}" class="side-menu__item">
        <img src="https://cdn-icons-png.flaticon.com/128/12624/12624953.png" 
             alt="Book Lookup Icon" 
             class="side-menu__icon" 
             style="width: 24px; height: 24px;">
        <span class="side-menu__label">Book Lookup by Barcode</span>
    </a>
</li>



                        <!-- End::slide -->

                        <!-- Start::slide__category -->
                        <li class="slide__category"><span class="category-name">Member Management</span></li>
                        <!-- End::slide__category -->

                                                                                             <li class="slide">
    <a href="{{url('all_member')}}" class="side-menu__item">
        <img src="https://cdn-icons-png.flaticon.com/128/2285/2285567.png" 
             alt="All Members Icon" 
             class="side-menu__icon" 
             style="width: 24px; height: 24px;">
        <span class="side-menu__label">All Members</span>
    </a>
</li>

                                                                                                <li class="slide">
    <a href="{{url('add_member')}}" class="side-menu__item">
        <img src="https://cdn-icons-png.flaticon.com/128/8867/8867438.png" 
             alt="Add Member Icon" 
             class="side-menu__icon" 
             style="width: 24px; height: 24px;">
        <span class="side-menu__label">Add Member</span>
    </a>
</li>

                                                                                                <li class="slide">
    <a href="{{url('member_category')}}" class="side-menu__item">
        <img src="https://cdn-icons-png.flaticon.com/128/2622/2622199.png" 
             alt="Member Categories Icon" 
             class="side-menu__icon" 
             style="width: 24px; height: 24px;">
        <span class="side-menu__label">Member Categories</span>
    </a>
</li>

                                       <li class="slide">
    <a href="{{url('membership_card')}}" class="side-menu__item">
        <img src="https://cdn-icons-png.flaticon.com/128/10749/10749018.png" 
             alt="Membership Cards Icon" 
             class="side-menu__icon" 
             style="width: 24px; height: 24px;">
        <span class="side-menu__label">Membership Cards</span>
    </a>
</li>



                        <!-- End::slide -->

                        <!-- Start::slide__category -->
                        <li class="slide__category"><span class="category-name">Issue & Return Management</span></li>
                        <!-- End::slide__category -->

                                  <li class="slide">
    <a href="{{url('issue_book')}}" class="side-menu__item">
        <img src="https://cdn-icons-png.flaticon.com/128/16167/16167239.png" 
             alt="Issue Book Icon" 
             class="side-menu__icon" 
             style="width: 24px; height: 24px;">
        <span class="side-menu__label">Issue Book</span>
    </a>
</li>

                                 <li class="slide">
    <a href="{{url('returned_books')}}" class="side-menu__item">
        <img src="https://cdn-icons-png.flaticon.com/128/5597/5597043.png" 
             alt="Return Book Icon" 
             class="side-menu__icon" 
             style="width: 24px; height: 24px;">
        <span class="side-menu__label">Return Book</span>
    </a>
</li>

                            <li class="slide">
    <a href="{{url('overdue')}}" class="side-menu__item">
        <img src="https://cdn-icons-png.flaticon.com/128/4334/4334479.png" 
             alt="Overdue Books Icon" 
             class="side-menu__icon" 
             style="width: 24px; height: 24px;">
        <span class="side-menu__label">Overdue Books</span>
    </a>
</li>

                                     <li class="slide">
    <a href="{{route('fines.index')}}" class="side-menu__item">
        <img src="https://cdn-icons-png.flaticon.com/128/3870/3870011.png" 
             alt="Fine Management Icon" 
             class="side-menu__icon" 
             style="width: 24px; height: 24px;">
        <span class="side-menu__label">Fine Management</span>
    </a>
</li>


                        <!-- End::slide -->

                        <!-- Start::slide__category -->
                        <li class="slide__category"><span class="category-name">Reports</span></li>
                        <!-- End::slide__category -->

                                   <li class="slide">
    <a href="{{url('library/report')}}" class="side-menu__item">
        <img src="https://cdn-icons-png.flaticon.com/128/2912/2912773.png" 
             alt="Library Reports Icon" 
             class="side-menu__icon" 
             style="width: 24px; height: 24px;">
        <span class="side-menu__label">Library Reports</span>
    </a>
</li>


                        <li class="slide__category"><span class="category-name">Notifications</span></li>
                        <!-- End::slide__category -->

                             <li class="slide">
    <a href="{{url('due_date_alert')}}" class="side-menu__item">
        <img src="https://cdn-icons-png.flaticon.com/128/13072/13072232.png" 
             alt="Due Date Alerts Icon" 
             class="side-menu__icon" 
             style="width: 24px; height: 24px;">
        <span class="side-menu__label">Due Date Alerts</span>
    </a>
</li>

                              <li class="slide">
    <a href="{{url('new_arrival_alert')}}" class="side-menu__item">
        <img src="https://cdn-icons-png.flaticon.com/128/5680/5680211.png" 
             alt="New Arrival Alerts Icon" 
             class="side-menu__icon" 
             style="width: 24px; height: 24px;">
        <span class="side-menu__label">New Arrival Alerts</span>
    </a>
</li>


<li class="slide">
    <a href="{{route('email.settings.edit')}}" class="side-menu__item">
        <img src="https://cdn-icons-png.flaticon.com/128/5680/5680211.png" 
             alt="New Arrival Alerts Icon" 
             class="side-menu__icon" 
             style="width: 24px; height: 24px;">
        <span class="side-menu__label">Email Setting</span>
    </a>
</li>

                             <li class="slide">
    <a href="{{route('notification.form')}}" class="side-menu__item">
        <img src="https://cdn-icons-png.flaticon.com/128/13072/13072232.png" 
             alt="Due Date Alerts Icon" 
             class="side-menu__icon" 
             style="width: 24px; height: 24px;">
        <span class="side-menu__label">Notification Setting</span>
    </a>
</li>


                                             <li class="slide__category"><span class="category-name">E-Book</span></li>
                        <!-- End::slide__category -->

                                      <li class="slide">
    <a href="{{url('e-book')}}" class="side-menu__item">
        <img src="https://cdn-icons-png.flaticon.com/128/10208/10208226.png" 
             alt="Upload E-Books Icon" 
             class="side-menu__icon" 
             style="width: 24px; height: 24px;">
        <span class="side-menu__label">Upload E-Books</span>
    </a>
</li>

                                      <li class="slide">
    <a href="{{url('e-book_reader')}}" class="side-menu__item">
        <img src="https://cdn-icons-png.flaticon.com/128/8132/8132147.png" 
             alt="E-Book Reader Icon" 
             class="side-menu__icon" 
             style="width: 24px; height: 24px;">
        <span class="side-menu__label">E-Book Reader</span>
    </a>
</li>


                        <li class="slide__category"><span class="category-name">Settings</span></li>
                        <!-- End::slide__category -->

                                                    <li class="slide">
    <a href="{{url('general-settings')}}" class="side-menu__item">
        <img src="https://cdn-icons-png.flaticon.com/128/1086/1086581.png" 
             alt="General Settings Icon" 
             class="side-menu__icon" 
             style="width: 24px; height: 24px;">
        <span class="side-menu__label">General Settings</span>
    </a>
</li>


<li class="slide">
    <a href="{{ route('auto_numbers.create') }}" class="side-menu__item">
        <img src="https://cdn-icons-png.flaticon.com/128/1157/1157044.png" 
             alt="ID Auto Generation Icon" 
             class="side-menu__icon" 
             style="width: 24px; height: 24px;">
        <span class="side-menu__label">ID Auto Generation</span>
    </a>
</li>




            <li class="slide">
    <a href="{{url('fine_setting')}}" class="side-menu__item">
        <img src="https://cdn-icons-png.flaticon.com/128/9897/9897376.png" 
             alt="Fine Settings Icon" 
             class="side-menu__icon" 
             style="width: 24px; height: 24px;">
        <span class="side-menu__label">Fine Settings</span>
    </a>
</li>



                       <li class="slide">
    <a href="{{url('issue_return_rules')}}" class="side-menu__item">
        <img src="https://cdn-icons-png.flaticon.com/128/7050/7050554.png" 
             alt="Issue/Return Rules Icon" 
             class="side-menu__icon" 
             style="width: 24px; height: 24px;">
        <span class="side-menu__label">Issue/Return Rules</span>
    </a>
</li>




                        <li class="slide__category"><span class="category-name">User Management</span></li>
                        <!-- End::slide__category -->

                           <li class="slide">
    <a href="{{ route('staff.index') }}" class="side-menu__item">
        <img src="https://cdn-icons-png.flaticon.com/128/12724/12724606.png" 
             alt="Admin & Librarians Icon" 
             class="side-menu__icon" 
             style="width: 24px; height: 24px;">
        <span class="side-menu__label">Admin & Librarians</span>
    </a>
</li>



                        <li class="slide">
    <a href="{{url('roles_permission')}}" class="side-menu__item">
        <img src="https://cdn-icons-png.flaticon.com/128/18508/18508415.png" 
             alt="Roles & Permissions Icon" 
             class="side-menu__icon" 
             style="width: 24px; height: 24px;">
        <span class="side-menu__label">Roles & Permissions</span>
    </a>
</li>



                                                <li class="slide__category"><span class="category-name">Logs & Maintenance</span></li>
                        <!-- End::slide__category -->

                           <li class="slide">
    <a href="{{url('activity_log')}}" class="side-menu__item">
        <img src="https://cdn-icons-png.flaticon.com/128/10286/10286717.png" 
             alt="Activity Logs Icon" 
             class="side-menu__icon" 
             style="width: 24px; height: 24px;">
        <span class="side-menu__label">Activity Logs</span>
    </a>
</li>



                        <li class="slide">
    <a href="{{ route('system.backup.index') }}" class="side-menu__item">
        <img src="https://cdn-icons-png.flaticon.com/128/17628/17628473.png" 
             alt="System Backup Icon" 
             class="side-menu__icon" 
             style="width: 24px; height: 24px;">
        <span class="side-menu__label">System Backup</span>
    </a>
</li>




                                                <li class="slide__category"><span class="category-name">Help / About</span></li>
                        <!-- End::slide__category -->

                           <li class="slide">
    <a href="{{url('user_manual')}}" class="side-menu__item">
        <img src="https://cdn-icons-png.flaticon.com/128/6348/6348054.png" 
             alt="User Manual Icon" 
             class="side-menu__icon" 
             style="width: 24px; height: 24px;">
        <span class="side-menu__label">User Manual</span>
    </a>
</li>



                       <li class="slide">
    <a href="{{url('developer_info')}}" class="side-menu__item">
        <img src="https://cdn-icons-png.flaticon.com/128/14157/14157993.png" 
             alt="Developer Info Icon" 
             class="side-menu__icon" 
             style="width: 24px; height: 24px;">
        <span class="side-menu__label">Developer Info</span>
    </a>
</li>


                                               <li class="slide">
    <a href="{{url('version_info')}}" class="side-menu__item">
        <img src="https://cdn-icons-png.flaticon.com/128/12291/12291652.png" 
             alt="Version Info Icon" 
             class="side-menu__icon" 
             style="width: 24px; height: 24px;">
        <span class="side-menu__label">Version Info</span>
    </a>
</li>


   

                    </ul>
                    <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"> <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path> </svg></div>
                </nav>
                <!-- End::nav -->

            </div>
            <!-- End::main-sidebar -->

        </aside>
        <!-- End::app-sidebar -->

