@include('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
@include('switcher')
<div class="page">
    @include('header')
    @include('nav_sidebar')

    <div class="main-content app-content">
        <div class="container-fluid">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-commenting-o"></i> Notification Setting</h3>
                </div>

                <div class="box-body pt0">
                    <form id="allTemplatesForm">
                    <div class="table-responsive">
                        <table class="table table-hover" id="templatesTable">
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
                                @foreach($templates as $t)
                                <tr data-id="{{ $t->id }}">
                                    <td width="15%">
                                        <input type="hidden" name="ids[]" value="{{ $t->id }}">
                                        {{ $t->event_name }}
                                    </td>

                                    <td width="10%">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="mail_{{ $t->id }}" value="1" @if(in_array('Email', $t->destination ?? [])) checked @endif> Email
                                        </label><br>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="sms_{{ $t->id }}" value="1" @if(in_array('SMS', $t->destination ?? [])) checked @endif> SMS
                                        </label><br>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="notification_{{ $t->id }}" value="1" @if(in_array('Mobile App', $t->destination ?? [])) checked @endif> Mobile App
                                        </label>
                                    </td>

                                    <td width="10%">
                                        {{-- Assuming recipient is array --}}
                                        @if(!empty($t->recipient))
                                            {{ implode(', ', $t->recipient) }}
                                        @endif
                                    </td>

                                    <td width="10%">{{ $t->template_id ?? '' }}</td>

                                    <td>
                                        <span class="sample-text">{!! nl2br(e($t->message)) !!}</span>
                                        <br><br>
                                        <button type="button" class="button_template btn btn-primary btn-sm" data-record-id="{{ $t->id }}">
                                            <i class="fa fa-pencil-square"></i> Edit
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    </form>
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

        </div>
    </div>

    @include('footer')
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(function() {
    // bootstrap modal instance
    var editModalEl = document.getElementById('editNotificationModal');
    var editModal = new bootstrap.Modal(editModalEl);

    // open modal and populate fields when edit clicked
    $('.button_template').on('click', function() {
        var id = $(this).data('record-id');
        var row = $('tr[data-id="'+id+'"]');
        var messageHtml = row.find('.sample-text').html() || row.find('.sample-text').text();
        // convert <br> back to newlines for textarea
        var message = messageHtml.replace(/<br\s*\/?>/gi, "\n").replace(/&nbsp;/g, ' ');

        $('#notification_id').val(id);
        $('#notification_message').val($('<div/>').html(message).text());
        $('#mailCheckbox').prop('checked', row.find('input[name="mail_'+id+'"]').is(':checked'));
        $('#smsCheckbox').prop('checked', row.find('input[name="sms_'+id+'"]').is(':checked'));
        $('#notificationCheckbox').prop('checked', row.find('input[name="notification_'+id+'"]').is(':checked'));

        editModal.show();
    });

    // Save single template (modal form)
    $('#notificationForm').on('submit', function(e) {
        e.preventDefault();
        let recordId = $('#notification_id').val();
        let updatedMessage = $('#notification_message').val();

        let mail = $('#mailCheckbox').is(':checked') ? 1 : 0;
        let sms = $('#smsCheckbox').is(':checked') ? 1 : 0;
        let notification = $('#notificationCheckbox').is(':checked') ? 1 : 0;

        $.ajax({
            url: "{{ route('notification.update') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                notification_id: recordId,
                message: updatedMessage,
                mail: mail,
                sms: sms,
                notification: notification
            },
            success: function(res) {
                // UPDATE PAGE TEXT INSTANTLY
                let row = $('button[data-record-id="'+recordId+'"]').closest('tr');
                // update sample-text display (preserve newlines -> <br>)
                row.find('.sample-text').html(updatedMessage.replace(/\n/g, '<br>'));

                // UPDATE CHECKBOXES ON PAGE
                row.find('input[name="mail_'+recordId+'"]').prop('checked', mail == 1);
                row.find('input[name="sms_'+recordId+'"]').prop('checked', sms == 1);
                row.find('input[name="notification_'+recordId+'"]').prop('checked', notification == 1);

                editModal.hide();
                alert("Template updated successfully");
            },
            error: function(xhr) {
                alert("Error updating template: " + (xhr.responseJSON?.error ?? 'Unknown error'));
            }
        });
    });

    // Save all button (you had #saveAllBtn in modal footer earlier; I prefer a separate button outside modal)
    // But to keep your original behavior, intercept a button with id saveAllBtn if exists:
    $(document).on('click', '#saveAllBtn', function(e) {
        e.preventDefault();

        let rows = [];

        $('tr').each(function() {
            if ($(this).find('input[name="ids[]"]').length) {
                let id = $(this).find('input[name="ids[]"]').val();
                let message = $(this).find('.sample-text').text().trim();

                let destination = [];
                if ($(this).find('input[name="mail_'+id+'"]').is(':checked')) destination.push("Email");
                if ($(this).find('input[name="sms_'+id+'"]').is(':checked')) destination.push("SMS");
                if ($(this).find('input[name="notification_'+id+'"]').is(':checked')) destination.push("Mobile App");

                rows.push({
                    id: id,
                    message: message,
                    destination: destination
                });
            }
        });

        $.ajax({
            url: "{{ route('notification.saveAll') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                templates: rows
            },
            success: function(res) {
                alert("All notification templates saved!");
            },
            error: function(xhr) {
                alert("Error saving templates: " + (xhr.responseJSON?.error ?? 'Unknown error'));
            }
        });
    });

    // Send button in modal
    $('#sendEmailBtn').on('click', function() {
        let recordId = $('#notification_id').val();
        let message = $('#notification_message').val();
        let userEmail = $('#userEmail').val();

        $.ajax({
            url: "{{ route('send.notification') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                notification_id: recordId,
                notification_message: message,
                userEmail: userEmail
            },
            success: function(res) {
                alert(res.status || 'Notification sent or queued');
            },
            error: function(xhr) {
                alert("Error sending notification: " + (xhr.responseJSON?.error ?? 'Unknown error'));
            }
        });
    });

});
</script>

</body>
</html>