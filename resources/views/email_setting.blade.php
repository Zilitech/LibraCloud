@include('head')

<body>

@include('switcher')

<!-- Loader -->
<div id="loader">
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
                            <option value="PHP Mail" {{ ($settings->email_engine ?? '') == 'PHP Mail' ? 'selected' : '' }}>PHP Mail</option>
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

@include('foot')

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
