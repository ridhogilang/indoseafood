<?php

namespace Database\Seeders;

use App\Models\EmailCampaign;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmailCampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EmailCampaign::create([
            'title'   => 'Seafood Supply Proposal',
            'subject' => 'Seafood Export Offering',
            'body_html' => '
                <p>Dear Mr./Ms. {{ $company }},<br>I hope you are doing well.<br><br>My name is Ridho from Ikan Indonesia.<br>Attached to this email is our Seafood Offering Catalogue (March 2025 Update), which includes our available fish species, processing options, certifications, and end-to-end export workflow.<br><br>We offer more than 20+ wild-caught Indonesian fish species, HACCP-certified processing, and international-standard cold-chain handling.<br>Please review the attached catalogue, and feel free to let me know which products you are interested in so we can prepare pricing, volume availability, and shipping options for you.<br><br>The attached PDF <a href="https://drive.google.com/file/d/1wKj3innVY0O0S5vIt2haB-LBcM6bvVQv/view?usp=drive_link" target="_blank" rel="noopener"> Ikan Indonesia Seafood Offering </a> contains our complete product catalogue, including photos, specifications, and detailed information about our seafood processing workflow.<br><br>I look forward to hearing from you.<br>Best regards,<br>Ridho<br>Ikan Indonesia<br>WhatsApp: +628771876270<br><span style="font-family: system-ui, -apple-system, BlinkMacSystemFont, \'Segoe UI\', sans-serif;">Email: business@indoseafoods.com</span></p>
            ',
        ]);
    }
}
