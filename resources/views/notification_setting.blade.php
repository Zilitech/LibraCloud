@include('head')
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z1FhHrjZlHvh1uH6+I65t0r+2kFfUoV6lHhX0W/6FZTPO+B6g2k3D67H5bL5fZtrYfqLzv6OflvJk0K2P1s4Vg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


<body>

@include('switcher')

<!-- Loader -->
<div id="loader">
    <img src="{{ asset('images/media/loader.svg') }}" alt="">
</div>
<!-- Loader -->

<div class="page">

    <!-- Header -->
    @include('header')
    @include('nav_sidebar')

    <!-- Main Content -->
    <div class="main-content app-content">
        <div class="container-fluid">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-commenting-o"></i> Notification Setting</h3>
                </div>

                <div class="box-body pt0">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Event</th>
                                    <th>Destination</th>
                                    <th>Recipient</th>
                                    <th>Template ID</th>
                                    <th>Sample Message</th>
                                </tr>
                            </thead>

                            <tbody>

                                <!-- 4. ISSUED BOOK -->
                                <tr>
                                    <td width="15%">
                                        <input type="hidden" name="ids[]" value="4">
                                        Issued Book
                                    </td>
                                    <td width="10%">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="mail_4" value="1"> Email
                                        </label><br>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="sms_4" value="1"> SMS
                                        </label><br>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="notification_4" value="1"> Mobile App
                                        </label>
                                    </td>
                                    <td width="10%">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="student_recipient_4" value="1"> Student
                                        </label><br>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="member_recipient_4" value="1"> Member
                                        </label>
                                    </td>
                                    <td width="10%"></td>
                                    <td>
                                        Dear @{{member_name}}, the book "@{{book_title}}" (No: @{{book_no}}) has been issued on @{{issue_date}}.
                                        Due Date: @{{due_date}}.
                                        <br><br>
                            
                                        <button type="button" class="button_template btn btn-primary btn-sm" data-record-id="4">
    <i class="fa fa-pencil-square"></i>
</button>
                                    </td>
                                </tr>

                                <!-- 5. RETURNED BOOK -->
                                <tr>
                                    <td width="15%">
                                        <input type="hidden" name="ids[]" value="5">
                                        Returned Book
                                    </td>
                                    <td width="10%">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="mail_5" value="1"> Email
                                        </label><br>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="sms_5" value="1"> SMS
                                        </label><br>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="notification_5" value="1"> Mobile App
                                        </label>
                                    </td>
                                    <td width="10%">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="student_recipient_5" value="1"> Student
                                        </label><br>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="member_recipient_5" value="1"> Member
                                        </label>
                                    </td>
                                    <td width="10%"></td>
                                    <td>
                                        Dear @{{member_name}}, the book "@{{book_title}}" has been returned on @{{return_date}}.
                                        <br><br>
                                     <button type="button" class="button_template btn btn-primary btn-sm" data-record-id="5">
    <i class="fa fa-pencil-square"></i>
</button>
                                    </td>
                                </tr>

                                <!-- 6. MEMBER REGISTER -->
                                <tr>
                                    <td width="15%">
                                        <input type="hidden" name="ids[]" value="6">
                                        Member Register
                                    </td>
                                    <td width="10%">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="mail_6" value="1"> Email
                                        </label><br>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="sms_6" value="1"> SMS
                                        </label>
                                    </td>
                                    <td width="10%">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="member_recipient_6" value="1"> Member
                                        </label>
                                    </td>
                                    <td width="10%"></td>
                                    <td>
                                        Welcome @{{member_name}}! Your membership has been created successfully.
                                        Member ID: @{{member_id}}
                                        <br><br>
                                         <button type="button" class="button_template btn btn-primary btn-sm" data-record-id="6">
    <i class="fa fa-pencil-square"></i>
</button>
                                    </td>
                                </tr>

                                <!-- 7. NEW ARRIVAL -->
                                <tr>
                                    <td width="15%">
                                        <input type="hidden" name="ids[]" value="7">
                                        New Arrival
                                    </td>
                                    <td width="10%">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="mail_7" value="1"> Email
                                        </label><br>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="sms_7" value="1"> SMS
                                        </label><br>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="notification_7" value="1"> Mobile App
                                        </label>
                                    </td>
                                    <td width="10%">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="student_recipient_7" value="1"> Student
                                        </label><br>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="member_recipient_7" value="1"> Member
                                        </label>
                                    </td>
                                    <td width="10%"></td>
                                    <td>
                                        New Arrival! "@{{book_title}}" by @{{author}} is now available in @{{library_name}}.
                                        <br><br>
                                         <button type="button" class="button_template btn btn-primary btn-sm" data-record-id="7">
    <i class="fa fa-pencil-square"></i>
</button>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Edit Notification Modal -->
            <div class="modal fade" id="editNotificationModal" tabindex="-1" aria-labelledby="editNotificationLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="notificationForm">
        <div class="modal-header">
          <h5 class="modal-title" id="editNotificationLabel">Edit Notification</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="notification_id" name="notification_id">

          <div class="mb-3">
            <label for="userEmail" class="form-label">User Email</label>
            <input type="email" class="form-control" id="userEmail" name="userEmail" placeholder="Enter user email">
          </div>

          <div class="mb-3">
            <label for="notification_message" class="form-label">Template Message</label>
            <textarea class="form-control" id="notification_message" name="notification_message" rows="5"></textarea>
          </div>

          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="mail" id="mailCheckbox">
            <label class="form-check-label" for="mailCheckbox">Email</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="sms" id="smsCheckbox">
            <label class="form-check-label" for="smsCheckbox">SMS</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="notification" id="notificationCheckbox">
            <label class="form-check-label" for="notificationCheckbox">Mobile App</label>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" id="sendEmailBtn" class="btn btn-success">Send Email</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
      </form>
    </div>
  </div>
</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {
    var editModal = new bootstrap.Modal(document.getElementById('editNotificationModal'));

    // Open modal
    $('.button_template').on('click', function() {
        let recordId = $(this).data('record-id');
        let row = $(this).closest('tr');

        let message = row.find('td').eq(4).contents().filter(function() {
            return this.nodeType === 3;
        }).text().trim();

        $('#notification_id').val(recordId);
        $('#notification_message').val(message);
        $('#mailCheckbox').prop('checked', row.find('input[name^="mail_"]').is(':checked'));
        $('#smsCheckbox').prop('checked', row.find('input[name^="sms_"]').is(':checked'));
        $('#notificationCheckbox').prop('checked', row.find('input[name^="notification_"]').is(':checked'));

        // Pre-fill email (if you want dynamic user emails, modify accordingly)
        $('#userEmail').val('');

        editModal.show();
    });

    // Save changes locally
    $('#notificationForm').on('submit', function(e) {
        e.preventDefault();
        let recordId = $('#notification_id').val();
        let updatedMessage = $('#notification_message').val();
        let mail = $('#mailCheckbox').is(':checked') ? 'Yes' : 'No';
        let sms = $('#smsCheckbox').is(':checked') ? 'Yes' : 'No';
        let notification = $('#notificationCheckbox').is(':checked') ? 'Yes' : 'No';

        let row = $('button[data-record-id="'+recordId+'"]').closest('tr');
        row.find('td').eq(4).contents().filter(function() {
            return this.nodeType === 3;
        }).first().replaceWith(updatedMessage + ' ');

        row.find('input[name^="mail_"]').prop('checked', mail === 'Yes');
        row.find('input[name^="sms_"]').prop('checked', sms === 'Yes');
        row.find('input[name^="notification_"]').prop('checked', notification === 'Yes');

        editModal.hide();
    });

    // Send Email button
    $('#sendEmailBtn').on('click', function() {
        let email = $('#userEmail').val();
        let message = $('#notification_message').val();

        if (!email) {
            alert('Please enter user email');
            return;
        }

        $.ajax({
            url: "{{ route('send.notification') }}",
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                email: email,
                message: message
            },
            success: function(res) {
                alert(res.status);
            },
            error: function(err) {
                alert('Error sending email!');
            }
        });
    });
});
</script>


        </div>
    </div>
    <!-- End::app-content -->

    @include('footer')

</div>

<script src="{{ asset('js/defaultmenu.min.js') }}"></script>
<script src="{{ asset('libs/node-waves/waves.min.js') }}"></script>
<script src="{{ asset('js/sticky.js') }}"></script>
<script src="{{ asset('libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('js/simplebar.js') }}"></script>
<script src="{{ asset('libs/@simonwep/pickr/pickr.es5.min.js') }}"></script>
<script src="{{ asset('libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
<script src="{{ asset('libs/jsvectormap/maps/world-merc.js') }}"></script>
<script src="{{ asset('js/us-merc-en.js') }}"></script>
<script src="{{ asset('js/index.js') }}"></script>
<script src="{{ asset('js/custom-switcher.min.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>

</body>
</html>
