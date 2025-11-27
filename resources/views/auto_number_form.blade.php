@include('head')

<body>

    @include('switcher')

    <div class="page">

        @include('header')
        @include('nav_sidebar')

        <div class="main-content app-content">
            <div class="container-fluid mt-4">

                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Configure Auto Numbers</h4>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('auto_numbers.store') }}">
                            @csrf

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label">Auto Generate?</label>
                                    <select id="autoGenerate" name="auto_generate" class="form-control">
                                        <option value="enable">Enable</option>
                                        <option value="disable">Disable</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="type" class="form-label">Type</label>
                                    <select name="type" id="type" class="form-control" required>
                                        <option value="">Select Type</option>
                                        <option value="book_code">Book Code</option>
                                        <option value="member_id">Member ID</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="prefix" class="form-label">Prefix</label>
                                    <input type="text" name="prefix" id="prefix" class="form-control" placeholder="e.g. CHM, MBR" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="last_number" class="form-label">Starting Number</label>
                                    <input type="number" name="last_number" id="last_number" class="form-control" value="1" required>
                                </div>

                                <div class="col-md-4">
                                    <label for="digits" class="form-label">Number of Digits</label>
                                    <input type="number" name="digits" id="digits" class="form-control" value="4" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>

                        @if(session('success'))
                            <div class="alert alert-success mt-3">{{ session('success') }}</div>
                        @endif
                    </div>
                </div>

            </div>
        </div>

        @include('footer')

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const autoSelect = document.getElementById('autoGenerate');
            const typeInput = document.getElementById('type');
            const prefixInput = document.getElementById('prefix');
            const lastNumberInput = document.getElementById('last_number');
            const digitsInput = document.getElementById('digits');

            function toggleAutoGenerate() {
                if(autoSelect.value === 'enable') {
                    typeInput.setAttribute('readonly', true);
                    prefixInput.setAttribute('readonly', true);
                    lastNumberInput.setAttribute('readonly', true);
                    digitsInput.setAttribute('readonly', true);

                    fetch('/generate-auto-number')
                        .then(response => response.json())
                        .then(data => {
                            if(typeInput.value === 'book_code') {
                                prefixInput.value = data.book_code.slice(0, data.book_code.length - 3); // Example to separate prefix
                                lastNumberInput.value = parseInt(data.book_code.slice(-3)); 
                            }
                            if(typeInput.value === 'member_id') {
                                prefixInput.value = data.member_id.slice(0, data.member_id.length - 4);
                                lastNumberInput.value = parseInt(data.member_id.slice(-4));
                            }
                        });

                } else {
                    typeInput.removeAttribute('readonly');
                    prefixInput.removeAttribute('readonly');
                    lastNumberInput.removeAttribute('readonly');
                    digitsInput.removeAttribute('readonly');
                }
            }

            autoSelect.addEventListener('change', toggleAutoGenerate);

            // Optional: also trigger when type changes
            typeInput.addEventListener('change', toggleAutoGenerate);

            toggleAutoGenerate();
        });
    </script>

</body>
</html>
