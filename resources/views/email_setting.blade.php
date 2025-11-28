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
    <div class="container mt-5">
                <h2 class="mb-4">Email Settings</h2>

                <!-- Success Message -->
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Email Settings Form -->
                <form id="emailSettingsForm" action="{{ route('email.settings.update') }}" method="POST">
                    @csrf

                    <!-- Email Engine -->
                    <div class="mb-3">
                        <label for="emailEngine" class="form-label">Email Engine</label>
                        <select class="form-select" id="emailEngine" name="email_engine" required>
                            <option value="SMTP" {{ ($settings->email_engine ?? '') == 'SMTP' ? 'selected' : '' }}>SMTP</option>
                        </select>
                    </div>

                    <!-- SMTP Username -->
                    <div class="mb-3">
                        <label for="smtpUsername" class="form-label">SMTP Username</label>
                        <input type="email" class="form-control" id="smtpUsername" name="smtp_username" 
                               value="{{ $settings->smtp_username ?? '' }}" placeholder="Enter SMTP Username" required>
                    </div>

                    <!-- SMTP Password -->
                    <div class="mb-3">
                        <label for="smtpPassword" class="form-label">SMTP Password</label>
                        <input type="password" class="form-control" id="smtpPassword" name="smtp_password" 
                               value="{{ $settings->smtp_password ?? '' }}" placeholder="Enter SMTP Password" required>
                    </div>

                    <!-- SMTP Server -->
                    <div class="mb-3">
                        <label for="smtpServer" class="form-label">SMTP Server</label>
                        <input type="text" class="form-control" id="smtpServer" name="smtp_server" 
                               value="{{ $settings->smtp_server ?? '' }}" placeholder="Enter SMTP Server" required>
                    </div>

                    <!-- SMTP Port -->
                    <div class="mb-3">
                        <label for="smtpPort" class="form-label">SMTP Port</label>
                        <input type="number" class="form-control" id="smtpPort" name="smtp_port" 
                               value="{{ $settings->smtp_port ?? '' }}" placeholder="Enter SMTP Port" required>
                    </div>

                    <!-- SMTP Security -->
                    <div class="mb-3">
                        <label for="smtpSecurity" class="form-label">SMTP Security</label>
                        <select class="form-select" id="smtpSecurity" name="smtp_security" required>
                            <option value="OFF" {{ ($settings->smtp_security ?? '') == 'OFF' ? 'selected' : '' }}>OFF</option>
                            <option value="SSL" {{ ($settings->smtp_security ?? '') == 'SSL' ? 'selected' : '' }}>SSL</option>
                            <option value="TLS" {{ ($settings->smtp_security ?? '') == 'TLS' ? 'selected' : '' }}>TLS</option>
                        </select>
                    </div>

                    <!-- SMTP Auth -->
                    <div class="mb-3">
                        <label for="smtpAuth" class="form-label">SMTP Auth</label>
                        <select class="form-select" id="smtpAuth" name="smtp_auth" required>
                            <option value="ON" {{ ($settings->smtp_auth ?? '') == 'ON' ? 'selected' : '' }}>ON</option>
                            <option value="OFF" {{ ($settings->smtp_auth ?? '') == 'OFF' ? 'selected' : '' }}>OFF</option>
                        </select>
                    </div>

                    <!-- Mail From Address -->
<div class="mb-3">
    <label for="mailFromAddress" class="form-label">Mail From Address</label>
    <input type="email" class="form-control" id="mailFromAddress" name="mail_from_address" 
           value="{{ $settings->mail_from_address ?? '' }}" placeholder="Enter Mail From Address" required>
</div>

<!-- Mail From Name -->
<div class="mb-3">
    <label for="mailFromName" class="form-label">Mail From Name</label>
    <input type="text" class="form-control" id="mailFromName" name="mail_from_name" 
           value="{{ $settings->mail_from_name ?? '' }}" placeholder="Enter Mail From Name" required>
</div>


                    <button type="submit" class="btn btn-primary">Save Settings</button>
                </form>

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
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 




