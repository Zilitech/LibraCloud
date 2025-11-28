<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\NotificationTemplate;

use App\Models\EmailSetting;

class NotificationController extends Controller
{
    // Show the notification settings page
    public function updateTemplate(Request $request)
{
    $request->validate([
        'notification_id' => 'required|integer',
        'message' => 'required|string',
    ]);

    $template = NotificationTemplate::find($request->notification_id);
    if(!$template) return response()->json(['error'=>'Template not found'],404);

    // Collect destinations
    $destination = [];
    if($request->mail) $destination[] = 'Email';
    if($request->sms) $destination[] = 'SMS';
    if($request->notification) $destination[] = 'Mobile App';

    // Collect recipients
    $recipient = $request->recipient ?? []; // Send as array

    $template->message = $request->message;
    $template->destination = $destination;
    $template->recipient = $recipient;
    $template->save();

    return response()->json(['status'=>'Template saved successfully']);
}

}
