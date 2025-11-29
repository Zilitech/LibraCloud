<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\NotificationTemplate;
use App\Models\EmailSetting;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class NotificationController extends Controller
{
    /**
     * Show the notification settings page.
     */
    public function showForm(Request $request)
    {
        // load all templates (adjust ordering/filters if needed)
        $templates = NotificationTemplate::orderBy('id')->get();

        // load email settings (if exists) and any general settings you need
        $emailSettings = EmailSetting::first(); // nullable

        return view('notification_setting', compact('templates', 'emailSettings'));
    }

    /**
     * Update a single template via AJAX (called by notification.update).
     */
    public function updateTemplate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'notification_id' => 'required|integer',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Validation failed', 'messages' => $validator->errors()], 422);
        }

        $template = NotificationTemplate::find($request->notification_id);

        if (!$template) {
            return response()->json(['error' => 'Template not found'], 404);
        }

        $destination = [];
        if ($request->has('mail') && intval($request->mail) === 1) $destination[] = 'Email';
        if ($request->has('sms') && intval($request->sms) === 1) $destination[] = 'SMS';
        if ($request->has('notification') && intval($request->notification) === 1) $destination[] = 'Mobile App';

        $template->message = $request->message;
        $template->destination = $destination; // cast handles array -> json
        $template->save();

        return response()->json(['status' => 'Template saved successfully', 'template' => $template]);
    }

    /**
     * Save multiple templates at once (saveAll).
     */
    public function saveAll(Request $request)
    {
        $templates = $request->templates ?? [];

        foreach ($templates as $data) {
            if (!isset($data['id'])) continue;
            $template = NotificationTemplate::find($data['id']);
            if ($template) {
                $template->message = $data['message'] ?? $template->message;
                $template->destination = $data['destination'] ?? $template->destination;
                $template->save();
            }
        }

        return response()->json(['status' => 'All templates saved successfully']);
    }

    /**
     * Basic send notification endpoint (example: send email).
     * Adapt this to your SMS / push notification provider.
     */
    public function sendNotification(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'notification_id' => 'required|integer',
            'userEmail' => 'nullable|email',
            'notification_message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Validation failed', 'messages' => $validator->errors()], 422);
        }

        $template = NotificationTemplate::find($request->notification_id);
        if (!$template) {
            return response()->json(['error' => 'Template not found'], 404);
        }

        // Example: send an email if userEmail present and mail selected.
        try {
            $destination = $template->destination ?? [];
            $messageBody = $request->notification_message;

            // send email if userEmail sent and 'Email' destination present
            if ($request->filled('userEmail') && (in_array('Email', $destination) || $request->has('mail'))) {
                $to = $request->input('userEmail');

                Mail::raw($messageBody, function ($msg) use ($to) {
                    $msg->to($to)
                        ->subject('Notification from ' . config('app.name'));
                });
            }

            // TODO: integrate SMS / push notification provider here for 'SMS' and 'Mobile App'
            // For now just log them
            if (in_array('SMS', $destination)) {
                Log::info("SMS would be sent for notification {$template->id}: {$messageBody}");
            }
            if (in_array('Mobile App', $destination)) {
                Log::info("Push would be sent for notification {$template->id}: {$messageBody}");
            }

            return response()->json(['status' => 'Notification send queued (or logged)']);
        } catch (\Throwable $e) {
            Log::error('sendNotification error: '.$e->getMessage());
            return response()->json(['error' => 'Failed to send notification', 'message' => $e->getMessage()], 500);
        }
    }
}
