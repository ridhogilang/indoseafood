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
                <p>Dear Mr./Ms. {{ $company }},</p>
                <p>I hope you are doing well.</p>
                <p><br></p>

                <p>My name is Ridho from Ikan Indonesia.</p>
                <p>Attached to this email is our Seafood Offering Catalogue (March 2025 Update), which includes our available fish species, processing options, certifications, and end-to-end export workflow.</p>

                <p><br></p>
                <p>We offer more than 20+ wild-caught Indonesian fish species, HACCP-certified processing, and international-standard cold-chain handling.</p>
                <p><br></p>

                <p>Please review the attached catalogue, and feel free to let me know which products you are interested in so we can prepare pricing, volume availability, and shipping options for you.</p>

                <p>The attached PDF 
                    <a href="https://drive.google.com/file/d/1wKj3innVY0O0S5vIt2haB-LBcM6bvVQv/view?usp=drive_link" target="_blank">
                        Ikan Indonesia Seafood Offering
                    </a> 
                    contains our complete product catalogue, including photos, specifications, and detailed information about our seafood processing workflow.
                </p>

                <p><br></p>

                <p>I look forward to hearing from you.</p>
                <p>Best regards,</p>
                <p>Ridho</p>
                <p>Ikan Indonesia</p>
                <p>WhatsApp: +628771876270</p>
                <p>Email: ikanindonesia@gmail.com</p>
            ',
        ]);
    }
}
