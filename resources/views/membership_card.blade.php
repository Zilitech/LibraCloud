@include('head')

<body>

@include('switcher')

<!-- Loader -->
<div id="loader">
    <img src="{{ asset('images/media/loader.svg') }}" alt="">
</div>
<!-- Loader -->

<div class="page">
    @include('header')
    @include('nav_sidebar')

    <!-- Start::app-content -->
    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                <div class="my-auto">
                    <h5 class="page-title fs-21 mb-1">Issue Membership Card</h5>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ url('membership_cards') }}">Members</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Issue New Card</li>
                        </ol>
                    </nav>
                </div>
                 <button id="generate-idcard-btn" class="btn btn-primary mb-3">
                Generate ID Card
            </button>
            </div>
            <!-- End Page Header -->

            <!-- Generate Card Button -->
           

            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="card-header">
                            <div class="card-title">Generate Membership Card</div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                            <table id="file-export" class="table table-bordered text-nowrap w-100">
    <thead>
        <tr>
            <th><input type="checkbox" id="select-all"></th>
            <th>SI</th>
            <th>Member ID</th>
            <th>Full Name</th>
            <th>Category</th>
            <th>Department / Class</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Books Issued</th>
            <th>Status</th>
        </tr>
    </thead>

    <tbody>
        @forelse($members as $index => $member)
            <tr>
                <td>
                    <input type="checkbox" class="row-checkbox" value="{{ $member->id }}">
                </td>

                <td>{{ $index + 1 }}</td>

                <td>
                    <span class="fw-semibold">{{ $member->memberid }}</span>
                </td>

                <td>{{ $member->fullname }}</td>

                <td>
                    <span class="badge bg-primary-transparent text-primary">
                        {{ $member->membertype }}
                    </span>
                </td>

                <td>{{ $member->departmentclass }}</td>

                <td>{{ $member->email }}</td>

                <td>{{ $member->phone }}</td>

                <td>{{ $member->cardIssued }}</td>

                <td>
                    <span class="badge bg-success">
                        {{ $member->status }}
                    </span>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="11" class="text-center">No members found</td>
            </tr>
        @endforelse
    </tbody>
</table>


                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ==========================
                 HIDDEN ID CARD TEMPLATE
            ============================= -->
            <div id="idcard-template" style="display:none;">

<style>
    body { background:#f5f5f5; font-family:Arial,sans-serif; }
    .id-card {
        width: 350px; height: 550px; background:#ffffff;
        border-radius: 15px; padding: 15px;
        box-shadow: 0 0 12px rgba(0,0,0,0.2);
        margin: 30px auto; position: relative; text-align: center;
    }
    .top-section { display:flex; justify-content:space-between; align-items:center; }
    .top-section img { width:60px; height:60px; }
    .college-name { font-size:18px; font-weight:bold; margin-top:5px; text-transform:uppercase; }
    .profile-pic {
        width:120px; height:140px; border-radius:10px;
        margin:15px auto; border:2px solid #ddd; object-fit:cover;
    }
    .details { text-align:left; font-size:14px; margin:10px 0 0 10px; }
    .details p { margin:4px 0; }
    .barcode img { width:220px; height:60px; }
    .register-id { margin-top:10px; font-weight:bold; font-size:15px; }
    .signature { position:absolute; right:15px; bottom:20px; text-align:center; font-size:13px; }
    .signature img { width:90px; }
</style>

<div class="id-card">

    <div class="top-section">
        <img src="https://via.placeholder.com/60" alt="Left Logo">
        <img src="https://via.placeholder.com/60" alt="Right Logo">
    </div>

    <div class="college-name">ABC College of Engineering</div>

    <img src="https://via.placeholder.com/120x140" class="profile-pic" alt="Student Photo">

    <div class="details">
        <p><strong>Name:</strong> <span class="name"></span></p>
        <p><strong>Date of Birth:</strong> <span class="dob"></span></p>
        <p><strong>Branch:</strong> <span class="branch"></span></p>
        <p><strong>Blood Group:</strong> <span class="blood"></span></p>
        <p><strong>Validity:</strong> <span class="validity"></span></p>
    </div>

    <div class="barcode">
        <img class="barcode-img" src="" alt="Barcode">
    </div>

    <div class="register-id">Reg ID: <span class="reg-id"></span></div>

    <div class="signature">
        <img src="https://via.placeholder.com/90x40" alt="Signature">
        <div>Principal</div>
    </div>

</div>

            </div>
            <!-- END TEMPLATE -->

        </div>
    </div>
    <!-- End::app-content -->

    @include('footer')
</div>

<!-- Scroll To Top -->
<div class="scrollToTop">
    <span class="arrow"><i class="las la-angle-double-up"></i></span>
</div>

<div id="responsive-overlay"></div>

{{-- Scripts --}}
<script src="{{ asset('libs/@popperjs/core/umd/popper.min.js') }}"></script>
<script src="{{ asset('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/defaultmenu.min.js') }}"></script>
<script src="{{ asset('libs/node-waves/waves.min.js') }}"></script>
<script src="{{ asset('js/sticky.js') }}"></script>
<script src="{{ asset('libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('js/simplebar.js') }}"></script>
<script src="{{ asset('libs/@simonwep/pickr/pickr.es5.min.js') }}"></script>
<script src="{{ asset('js/custom-switcher.min.js') }}"></script>
<script src="{{ asset('libs/prismjs/prism.js') }}"></script>
<script src="{{ asset('js/prism-custom.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>

<!-- Datatable & Buttons -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

<script>
$(document).ready(function () {

    // Datatable
    var table = $('#file-export').DataTable({
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
        columnDefs: [
            { orderable: false, targets: 0 }
        ]
    });

    // Select All Checkbox
    $("#select-all").on("click", function () {
        $(".row-checkbox").prop("checked", this.checked);
    });

    // If any row unchecked → uncheck "select all"
    $(document).on("click", ".row-checkbox", function () {
        $("#select-all").prop(
            "checked",
            $(".row-checkbox:checked").length === $(".row-checkbox").length
        );
    });

    // Generate ID Card
    $("#generate-idcard-btn").on("click", function () {
        let selectedIds = [];

        $(".row-checkbox:checked").each(function () {
            selectedIds.push($(this).val());
        });

        if (selectedIds.length === 0) {
            alert("Please select at least one member to generate ID card.");
            return;
        }

        $.ajax({
            url: "/generate-id-card",
            type: "POST",
            data: {
                member_ids: selectedIds,
                _token: "{{ csrf_token() }}"
            },
            success: function (response) {
                alert("ID Cards generated successfully!");

                if (response.download_link) {
                    window.location.href = response.download_link;
                }
            }
        });

    });

});
</script>
<script>
  
$("#generate-idcard-btn").on("click", function () {
    let selectedIds = [];
    $(".row-checkbox:checked").each(function () {
        selectedIds.push($(this).val());
    });

    if (selectedIds.length === 0) {
        alert("Please select at least one member to generate ID card.");
        return;
    }

    // Open PDF in new tab
    const form = $('<form>', {
        action: "{{ route('generate.idcard') }}",
        method: 'POST',
        target: '_blank'
    }).append($('<input>', {
        type: 'hidden', name: '_token', value: "{{ csrf_token() }}"
    }));

    selectedIds.forEach(id => {
        form.append($('<input>', { type: 'hidden', name: 'member_ids[]', value: id }));
    });

    $('body').append(form);
    form.submit();
    form.remove();
});

</script>



</body>
</html>
