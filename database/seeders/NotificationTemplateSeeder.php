<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NotificationTemplate;

class NotificationTemplateSeeder extends Seeder
{
    public function run()
    {
        $templates = [
            [
                'event_name' => 'Issued Book',
                'recipient' => ['Student', 'Member'],
                'destination' => ['Email', 'SMS', 'Mobile App'],
                'template_id' => 'TEMP-004',
                'message' =>
"Dear {{member_name}}, the book \"{{book_title}}\" (No: {{book_no}}) has been issued on {{issue_date}}.
Due Date: {{due_date}}."
            ],
            [
                'event_name' => 'Returned Book',
                'recipient' => ['Student', 'Member'],
                'destination' => ['Email', 'SMS', 'Mobile App'],
                'template_id' => 'TEMP-005',
                'message' =>
"Dear {{member_name}}, the book \"{{book_title}}\" has been returned on {{return_date}}."
            ],
            [
                'event_name' => 'Member Register',
                'recipient' => ['Member'],
                'destination' => ['Email', 'SMS'],
                'template_id' => 'TEMP-006',
                'message' =>
"Welcome {{member_name}}! Your membership has been created successfully.
Member ID: {{member_id}}"
            ],
            [
                'event_name' => 'New Arrival',
                'recipient' => ['Student', 'Member'],
                'destination' => ['Email', 'SMS', 'Mobile App'],
                'template_id' => 'TEMP-007',
                'message' =>
"New Arrival! \"{{book_title}}\" by {{author}} is now available in {{library_name}}."
            ],
        ];

        foreach ($templates as $t) {
            NotificationTemplate::create($t);
        }
    }
}
