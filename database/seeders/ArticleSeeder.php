<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Support\Carbon;
use App\Models\ArticleCategory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kategori untuk artikel-artikel studi kasus / export story
        $category = ArticleCategory::firstOrCreate(
            ['slug' => 'case-studies'],
            [
                'name'        => 'Case Studies',
                'description' => 'Export case studies and shipment stories from Indonesia Seafood.',
                'is_active'   => true,
            ]
        );

        $body = <<<'HTML'
<p style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">During the period of&nbsp;<strong>December 2024 to January 2025</strong>,&nbsp;<strong>Indonesia Seafood</strong> completed a premium frozen seafood export shipment from&nbsp;<strong>Surabaya, Indonesia</strong>, to our Australian customer,&nbsp;<strong>Mr. Craig</strong>. The order included a mix of high-demand fillet and whole-fish products prepared through our&nbsp;<strong>fresh-to-frozen processing system</strong> and delivered under a strict cold-chain export flow.</span>
</p>
<p style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">This shipment reflects our ongoing role as a&nbsp;<strong>frozen seafood exporter from Indonesia</strong>, supplying Australia with consistent quality, export compliance, and reliable volume for wholesale distribution.</span>
</p>
<hr>
<h2>
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:17pt;"><strong>Processing in Surabaya: Fresh-to-Frozen Export Standard</strong></span>
</h2>
<p style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">All products for this shipment were processed in our&nbsp;<strong>Surabaya seafood processing facility</strong>, where raw fish is handled through a controlled export-grade system:</span>
</p>
<ul>
    <li class="ck-list-marker-font-size ck-list-marker-color ck-list-marker-font-family" style="--ck-content-list-marker-color:#000000;--ck-content-list-marker-font-family:Calibri,sans-serif;--ck-content-list-marker-font-size:11pt;" data-list-item-id="e696879fcb62f43c4e753b20efc128ede">
        <p style="text-align:justify;">
            <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;"><strong>Fresh intake and rapid chilling</strong> to preserve texture and color</span>
        </p>
    </li>
    <li class="ck-list-marker-font-size ck-list-marker-color ck-list-marker-font-family" style="--ck-content-list-marker-color:#000000;--ck-content-list-marker-font-family:Calibri,sans-serif;--ck-content-list-marker-font-size:11pt;" data-list-item-id="e989b1093c05bc68f8a00aa2d40c2a910">
        <p style="text-align:justify;">
            <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;"><strong>Hygienic filleting rooms</strong> with trained cutters and trimming standards</span>
        </p>
    </li>
    <li class="ck-list-marker-font-size ck-list-marker-color ck-list-marker-font-family" style="--ck-content-list-marker-color:#000000;--ck-content-list-marker-font-family:Calibri,sans-serif;--ck-content-list-marker-font-size:11pt;" data-list-item-id="e94ee29e782369db6033b3d76e808c267">
        <p style="text-align:justify;">
            <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;"><strong>IQF / blast freezing</strong> for fast core-temperature lock</span>
        </p>
    </li>
    <li class="ck-list-marker-font-size ck-list-marker-color ck-list-marker-font-family" style="--ck-content-list-marker-color:#000000;--ck-content-list-marker-font-family:Calibri,sans-serif;--ck-content-list-marker-font-size:11pt;" data-list-item-id="edc0af7d25a1daf860115551a1a919d5e">
        <p style="text-align:justify;">
            <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;"><strong>Quality control checkpoints</strong> across filleting, glazing, packing, and labeling</span>
        </p>
    </li>
    <li class="ck-list-marker-font-size ck-list-marker-color ck-list-marker-font-family" style="--ck-content-list-marker-color:#000000;--ck-content-list-marker-font-family:Calibri,sans-serif;--ck-content-list-marker-font-size:11pt;" data-list-item-id="ebb7ffa8b53dd59dd22b972dd7a4aa4e7">
        <p style="text-align:justify;">
            <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;"><strong>Cold chain logistics</strong> maintained at export temperature until container loading</span>
        </p>
    </li>
</ul>
<p style="text-align:center;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">As an&nbsp;<strong>Indonesian seafood processing company</strong> aligned with&nbsp;<strong>HACCP and Halal standards</strong>, Indonesia Seafood ensures every carton meets international buyer requirements.</span>
</p>
<p>
    &nbsp;
</p>
<hr>
<p>
    &nbsp;
</p>
<h2>
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:17pt;"><strong>Products Exported to Australia</strong></span>
</h2>
<h3>
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:13pt;"><strong>1) Barramundi Fillet (Skinless / Boneless)</strong></span>
</h3>
<p style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;"><strong>Barramundi fillet</strong> remains one of the strongest Indonesian exports to Australia due to its clean flavor, firm texture, and versatility. For this shipment, we prepared barramundi fillets with:</span>
</p>
<ul>
    <li class="ck-list-marker-font-size ck-list-marker-color ck-list-marker-font-family" style="--ck-content-list-marker-color:#000000;--ck-content-list-marker-font-family:Calibri,sans-serif;--ck-content-list-marker-font-size:11pt;" data-list-item-id="e6ad167a6118246e5336488fc079e6446">
        <p style="text-align:justify;">
            <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">clean trimming standard</span>
        </p>
    </li>
    <li class="ck-list-marker-font-size ck-list-marker-color ck-list-marker-font-family" style="--ck-content-list-marker-color:#000000;--ck-content-list-marker-font-family:Calibri,sans-serif;--ck-content-list-marker-font-size:11pt;" data-list-item-id="e0faac3b5e88ffd7baeed2b79f82ab392">
        <p style="text-align:justify;">
            <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">export-grade glazing options</span>
        </p>
    </li>
    <li class="ck-list-marker-font-size ck-list-marker-color ck-list-marker-font-family" style="--ck-content-list-marker-color:#000000;--ck-content-list-marker-font-family:Calibri,sans-serif;--ck-content-list-marker-font-size:11pt;" data-list-item-id="e92fae0ab6d0eeb95b627b42392ef5e5e">
        <p style="text-align:justify;">
            <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">vacuum-sealed and bulk cartons</span>
        </p>
    </li>
    <li class="ck-list-marker-font-size ck-list-marker-color ck-list-marker-font-family" style="--ck-content-list-marker-color:#000000;--ck-content-list-marker-font-family:Calibri,sans-serif;--ck-content-list-marker-font-size:11pt;" data-list-item-id="e0deebfe0b009574197ef94aef31142ce">
        <p style="text-align:justify;">
            <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">IQF frozen quality retention</span>
        </p>
    </li>
</ul>
<p style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">Ideal for Australian wholesalers, retailers, and HORECA suppliers.</span>
</p>
<h3 style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:13pt;"><strong>2) Lencam Fillet (Red Spot Emperor Fillet)</strong></span>
</h3>
<p style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">A premium reef-fish fillet widely requested by Australian buyers. Our team processed&nbsp;<strong>lencam fillets</strong> with consistent portion control, minimal belly-meat loss, and tight QC to meet high-end market preferences.</span>
</p>
<h3 style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:13pt;"><strong>3) White Snapper (WGGS)</strong></span>
</h3>
<p style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">Processed as&nbsp;<strong>WGGS (Washed, Gutted, Gilled, Scaled)</strong>—ready for wholesale distribution and restaurant supply. White snapper WGGS is valued for whole-fish presentation and stable frozen shelf performance.</span>
</p>
<h3 style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:13pt;"><strong>4) Goldband Snapper (WGGS)</strong></span>
</h3>
<p style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">A high-value reef fish for Australia’s seafood segment.&nbsp;<strong>Goldband snapper WGGS</strong> is known for sweet flesh and strong consumer demand, especially through ethnic and premium retail channels.</span>
</p>
<h3 style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:13pt;"><strong>5) Indian Mackerel (WGGS)</strong></span>
</h3>
<p style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">A high-volume product with strong turnover in Australia.&nbsp;<strong>Indian mackerel WGGS</strong> supports ethnic retail, wholesale, and value-range frozen seafood categories.</span>
</p>
<h2 style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:17pt;"><strong>Why Australia Chooses Indonesia Seafood</strong></span>
</h2>
<p style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">Australia is one of our key export markets, and buyers like&nbsp;<strong>Mr. Craig</strong> continue working with Indonesia Seafood because of:</span>
</p>
<h3 style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:13pt;"><strong>Consistent Export-Grade Quality</strong></span>
</h3>
<p style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">We run strict QC for appearance, temperature, glaze, and packing integrity. Our system is built for repeat bulk supply and stable product standards.</span>
</p>
<h3 style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:13pt;"><strong>Certified Processing &amp; Compliance</strong></span>
</h3>
<p style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">Our facility operates under:</span>
</p>
<ul>
    <li class="ck-list-marker-font-size ck-list-marker-color ck-list-marker-font-family" style="--ck-content-list-marker-color:#000000;--ck-content-list-marker-font-family:Calibri,sans-serif;--ck-content-list-marker-font-size:11pt;" data-list-item-id="e01899f1ec04f91917ab8a39fd5a0baf1">
        <p style="text-align:justify;">
            <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;"><strong>HACCP seafood Indonesia</strong> processing control</span>
        </p>
    </li>
    <li class="ck-list-marker-bold ck-list-marker-font-size ck-list-marker-color ck-list-marker-font-family" style="--ck-content-list-marker-color:#000000;--ck-content-list-marker-font-family:Calibri,sans-serif;--ck-content-list-marker-font-size:11pt;" data-list-item-id="e5bb52e4303b4324e2d0e6dfa0619a6cb">
        <p style="text-align:justify;">
            <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;"><strong>Halal certified seafood processing</strong></span>
        </p>
    </li>
    <li class="ck-list-marker-font-size ck-list-marker-color ck-list-marker-font-family" style="--ck-content-list-marker-color:#000000;--ck-content-list-marker-font-family:Calibri,sans-serif;--ck-content-list-marker-font-size:11pt;" data-list-item-id="eab2719bfba7e2d67c18234dbfe8ceb03">
        <p style="text-align:justify;">
            <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">optional&nbsp;<strong>SGS inspection</strong> for buyer assurance</span>
        </p>
    </li>
</ul>
<h3 style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:13pt;"><strong>Reliable Bulk Supply</strong></span>
</h3>
<p style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">As a&nbsp;<strong>bulk frozen seafood supplier</strong>, Indonesia Seafood can fulfill multispecies containers and scheduled export cycles.</span>
</p>
<h3 style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:13pt;"><strong>Competitive Value</strong></span>
</h3>
<p style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">We balance premium trimming and freezing with cost efficiency for importers seeking long-term supply stability.</span>
</p>
<hr>
<h2 style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:17pt;"><strong>Export Timeline &amp; Logistics (Dec 2024 – Jan 2025)</strong></span>
</h2>
<p style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">The shipment followed a controlled export route:</span>
</p>
<ol>
    <li class="ck-list-marker-font-size ck-list-marker-color ck-list-marker-font-family" style="--ck-content-list-marker-color:#000000;--ck-content-list-marker-font-family:Calibri,sans-serif;--ck-content-list-marker-font-size:11pt;" data-list-item-id="e8b1a207b2178a24ba48361abc0944f3a">
        <p style="text-align:justify;">
            <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;"><strong>Fresh catch sourcing</strong> from East Java and surrounding Indonesian fisheries</span>
        </p>
    </li>
    <li class="ck-list-marker-font-size ck-list-marker-color ck-list-marker-font-family" style="--ck-content-list-marker-color:#000000;--ck-content-list-marker-font-family:Calibri,sans-serif;--ck-content-list-marker-font-size:11pt;" data-list-item-id="ec5c232ffa27ff2145c652ff361286d8b">
        <p style="text-align:justify;">
            <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;"><strong>Processing in Surabaya</strong> (filleting / WGGS prep / grading)</span>
        </p>
    </li>
    <li class="ck-list-marker-bold ck-list-marker-font-size ck-list-marker-color ck-list-marker-font-family" style="--ck-content-list-marker-color:#000000;--ck-content-list-marker-font-family:Calibri,sans-serif;--ck-content-list-marker-font-size:11pt;" data-list-item-id="e90cc54ddd2c2044fa0359923f97f58da">
        <p style="text-align:justify;">
            <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;"><strong>Blast freezing &amp; IQF stabilization</strong></span>
        </p>
    </li>
    <li class="ck-list-marker-font-size ck-list-marker-color ck-list-marker-font-family" style="--ck-content-list-marker-color:#000000;--ck-content-list-marker-font-family:Calibri,sans-serif;--ck-content-list-marker-font-size:11pt;" data-list-item-id="e44d99dd2b2ce3457307e3be3d399a855">
        <p style="text-align:justify;">
            <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;"><strong>Carton packing and labeling</strong> for export compliance</span>
        </p>
    </li>
    <li class="ck-list-marker-font-size ck-list-marker-color ck-list-marker-font-family" style="--ck-content-list-marker-color:#000000;--ck-content-list-marker-font-family:Calibri,sans-serif;--ck-content-list-marker-font-size:11pt;" data-list-item-id="e814defe589203bd257387ecc1a169394">
        <p style="text-align:justify;">
            <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;"><strong>40ft reefer loading</strong> at controlled temperature (-18°C)</span>
        </p>
    </li>
    <li class="ck-list-marker-bold ck-list-marker-font-size ck-list-marker-color ck-list-marker-font-family" style="--ck-content-list-marker-color:#000000;--ck-content-list-marker-font-family:Calibri,sans-serif;--ck-content-list-marker-font-size:11pt;" data-list-item-id="e606be4d647adf957038f13a0c665a087">
        <p style="text-align:justify;">
            <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;"><strong>Sea freight to Australia</strong></span>
        </p>
    </li>
    <li class="ck-list-marker-font-size ck-list-marker-color ck-list-marker-font-family" style="--ck-content-list-marker-color:#000000;--ck-content-list-marker-font-family:Calibri,sans-serif;--ck-content-list-marker-font-size:11pt;" data-list-item-id="e8502f68bccbc95f8636419a5fd7a3c8c">
        <p style="text-align:justify;">
            <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;"><strong>Delivery to Mr. Craig’s receiving facility</strong> for market distribution</span>
        </p>
    </li>
</ol>
<p style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">Throughout December 2024 and January 2025, temperature integrity was maintained end-to-end via our cold chain logistics system.</span>
</p>
HTML;

        $body2 = <<<'HTML'
<p style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">
        During&nbsp;<strong>July to August 2025</strong>,&nbsp;<strong>Indonesia Seafood</strong> successfully completed a major processing cycle of&nbsp;<strong>whole Leatherjacket fish (50–500 grams)</strong> for export to&nbsp;<strong>China</strong>, specifically for our customer&nbsp;<strong>Ms. Liu</strong>. All products were sourced and processed at our&nbsp;<strong>Brondong, Lamongan</strong> facility—one of East Java’s most active landing ports for Leatherjacket species.
    </span>
</p>
<p style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">
        This export activity strengthens Indonesia Seafood’s position as a&nbsp;<strong>leading Indonesian frozen seafood supplier</strong>, known for reliable volume, fresh-to-frozen handling, and strict QC for China’s demanding import requirements.
    </span>
</p>
<p style="text-align:justify;">&nbsp;</p>
<hr>
<h2 style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:17pt;">
        <strong>Brondong, Lamongan: One of Indonesia’s Top Leatherjacket Centers</strong>
    </span>
</h2>
<p style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">
        Brondong, located in Lamongan, East Java, is one of Indonesia’s busiest fishing ports for Leatherjacket (also known as Filefish or&nbsp;<i>ikan Kapas-kapas</i>). Every day, hundreds of boats unload freshly caught Leatherjacket in various sizes, making the area ideal for consistent large-volume sourcing.
    </span>
</p>
<p style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">Our Brondong facility supports:</span>
</p>
<ul>
    <li class="ck-list-marker-font-size ck-list-marker-color ck-list-marker-font-family" style="--ck-content-list-marker-color:#000000;--ck-content-list-marker-font-family:Calibri,sans-serif;--ck-content-list-marker-font-size:11pt;" data-list-item-id="e846ed2f04517342245326e1ca324939a">
        <p style="text-align:justify;">
            <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">daily raw material collection</span>
        </p>
    </li>
    <li class="ck-list-marker-font-size ck-list-marker-color ck-list-marker-font-family" style="--ck-content-list-marker-color:#000000;--ck-content-list-marker-font-family:Calibri,sans-serif;--ck-content-list-marker-font-size:11pt;" data-list-item-id="eae79659ad237aab726af4baac800c01c">
        <p style="text-align:justify;">
            <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">rapid chilling and cold storage</span>
        </p>
    </li>
    <li class="ck-list-marker-font-size ck-list-marker-color ck-list-marker-font-family" style="--ck-content-list-marker-color:#000000;--ck-content-list-marker-font-family:Calibri,sans-serif;--ck-content-list-marker-font-size:11pt;" data-list-item-id="e1d3f2bf9868b1ff0210b3b9c2290d06b">
        <p style="text-align:justify;">
            <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">whole fish cleaning and sorting</span>
        </p>
    </li>
    <li class="ck-list-marker-font-size ck-list-marker-color ck-list-marker-font-family" style="--ck-content-list-marker-color:#000000;--ck-content-list-marker-font-family:Calibri,sans-serif;--ck-content-list-marker-font-size:11pt;" data-list-item-id="eead5919c7c0a69029b29b12e0a0f7707">
        <p style="text-align:justify;">
            <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">export-standard grading for China</span>
        </p>
    </li>
    <li class="ck-list-marker-font-size ck-list-marker-color ck-list-marker-font-family" style="--ck-content-list-marker-color:#000000;--ck-content-list-marker-font-family:Calibri,sans-serif;--ck-content-list-marker-font-size:11pt;" data-list-item-id="e18442ae9667a0b53a3488eac58fbdd6f">
        <p style="text-align:justify;">
            <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">frozen packing &amp; container loading&nbsp;</span>
        </p>
    </li>
</ul>
<p style="text-align:justify;">&nbsp;</p>
<p style="text-align:center;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">
        <picture>
            <source srcset="https://ckbox.cloud/d6ac0f646ba306de9d20/assets/rp7oktyG1Nft/images/80.webp 80w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/rp7oktyG1Nft/images/160.webp 160w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/rp7oktyG1Nft/images/240.webp 240w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/rp7oktyG1Nft/images/320.webp 320w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/rp7oktyG1Nft/images/400.webp 400w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/rp7oktyG1Nft/images/480.webp 480w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/rp7oktyG1Nft/images/560.webp 560w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/rp7oktyG1Nft/images/569.webp 569w" type="image/webp" sizes="(max-width: 569px) 100vw, 569px">
            <img src="https://ckbox.cloud/d6ac0f646ba306de9d20/assets/rp7oktyG1Nft/images/569.png" data-ckbox-resource-id="rp7oktyG1Nft" width="184" height="249">
        </picture>
        <picture>
            <source srcset="https://ckbox.cloud/d6ac0f646ba306de9d20/assets/4KRfdmlzzTPn/images/80.webp 80w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/4KRfdmlzzTPn/images/160.webp 160w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/4KRfdmlzzTPn/images/240.webp 240w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/4KRfdmlzzTPn/images/320.webp 320w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/4KRfdmlzzTPn/images/400.webp 400w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/4KRfdmlzzTPn/images/480.webp 480w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/4KRfdmlzzTPn/images/560.webp 560w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/4KRfdmlzzTPn/images/583.webp 583w" type="image/webp" sizes="(max-width: 583px) 100vw, 583px">
            <img src="https://ckbox.cloud/d6ac0f646ba306de9d20/assets/4KRfdmlzzTPn/images/583.png" data-ckbox-resource-id="4KRfdmlzzTPn" width="187" height="249">
        </picture>
        <picture>
            <source srcset="https://ckbox.cloud/d6ac0f646ba306de9d20/assets/WUJyzNWzsY-k/images/80.webp 80w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/WUJyzNWzsY-k/images/160.webp 160w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/WUJyzNWzsY-k/images/240.webp 240w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/WUJyzNWzsY-k/images/320.webp 320w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/WUJyzNWzsY-k/images/400.webp 400w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/WUJyzNWzsY-k/images/480.webp 480w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/WUJyzNWzsY-k/images/560.webp 560w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/WUJyzNWzsY-k/images/582.webp 582w" type="image/webp" sizes="(max-width: 582px) 100vw, 582px">
            <img src="https://ckbox.cloud/d6ac0f646ba306de9d20/assets/WUJyzNWzsY-k/images/582.png" data-ckbox-resource-id="WUJyzNWzsY-k" width="187" height="249">
        </picture>
    </span>
</p>
<h2 style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:17pt;">
        <strong>Leatherjacket Whole Fish Processing (50–500g)</strong>
    </span>
</h2>
<p style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">
        For Ms. Liu’s orders, Indonesia Seafood processed&nbsp;<strong>whole Leatherjacket fish</strong> within the size range of&nbsp;<strong>50g up to 500g</strong>, sorted into uniform grades preferred by China’s frozen seafood importers.
    </span>
</p>
<h3 style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:13pt;">
        <strong>Processing Workflow:</strong>
    </span>
</h3>
<h3 style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:13pt;">
        <strong>1. Fresh Catch Intake</strong>
    </span>
</h3>
<p style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">
        Raw materials arrive directly from fishermen and are immediately washed and chilled.
    </span>
</p>
<h3 style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:13pt;">
        <strong>2. Cleaning &amp; Sorting</strong>
    </span>
</h3>
<p style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">
        Fish are cleaned manually and sorted into weight grades to match China’s market preferences.
    </span>
</p>
<h3 style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:13pt;">
        <strong>3. Freezing Process</strong>
    </span>
</h3>
<p style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">
        Using&nbsp;<strong>IQF and blast freezing</strong>, fish are rapidly frozen to lock in color, texture, and freshness.
    </span>
</p>
<h3 style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:13pt;">
        <strong>4. Packing &amp; Labeling</strong>
    </span>
</h3>
<p style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">
        Whole fish are packed into export cartons with clear specifications (grade, weight range, production date).
    </span>
</p>
<h3 style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:13pt;">
        <strong>5. Cold Chain &amp; Container Loading</strong>
    </span>
</h3>
<p style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">
        Temperature is kept at&nbsp;<strong>-18°C</strong> from freezer to reefer container, ensuring safe arrival in China.
    </span>
</p>
<p style="text-align:justify;">&nbsp;</p>
<p style="text-align:center;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">
        <picture>
            <source srcset="https://ckbox.cloud/d6ac0f646ba306de9d20/assets/qHNkjTzz_hvJ/images/80.webp 80w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/qHNkjTzz_hvJ/images/160.webp 160w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/qHNkjTzz_hvJ/images/240.webp 240w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/qHNkjTzz_hvJ/images/320.webp 320w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/qHNkjTzz_hvJ/images/400.webp 400w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/qHNkjTzz_hvJ/images/433.webp 433w" sizes="(max-width: 433px) 100vw, 433px" type="image/webp">
            <img src="https://ckbox.cloud/d6ac0f646ba306de9d20/assets/qHNkjTzz_hvJ/images/433.png" width="200" height="305" data-ckbox-resource-id="qHNkjTzz_hvJ">
        </picture>
        <picture>
            <source srcset="https://ckbox.cloud/d6ac0f646ba306de9d20/assets/jSzL3dCikl0I/images/80.webp 80w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/jSzL3dCikl0I/images/160.webp 160w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/jSzL3dCikl0I/images/240.webp 240w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/jSzL3dCikl0I/images/320.webp 320w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/jSzL3dCikl0I/images/400.webp 400w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/jSzL3dCikl0I/images/480.webp 480w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/jSzL3dCikl0I/images/525.webp 525w" type="image/webp" sizes="(max-width: 525px) 100vw, 525px">
            <img src="https://ckbox.cloud/d6ac0f646ba306de9d20/assets/jSzL3dCikl0I/images/525.png" data-ckbox-resource-id="jSzL3dCikl0I" width="211" height="304">
        </picture>
        <picture>
            <source srcset="https://ckbox.cloud/d6ac0f646ba306de9d20/assets/yinNanhprSpa/images/80.webp 80w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/yinNanhprSpa/images/160.webp 160w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/yinNanhprSpa/images/240.webp 240w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/yinNanhprSpa/images/320.webp 320w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/yinNanhprSpa/images/400.webp 400w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/yinNanhprSpa/images/436.webp 436w" type="image/webp" sizes="(max-width: 436px) 100vw, 436px">
            <img class="image_resized" style="width:14.98%;" src="https://ckbox.cloud/d6ac0f646ba306de9d20/assets/yinNanhprSpa/images/436.png" data-ckbox-resource-id="yinNanhprSpa" width="185" height="319.16179388808047">
        </picture>
    </span>
</p>
<p style="text-align:justify;">&nbsp;</p>
<hr>
<h2 style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:17pt;">
        <strong>Product Specification for China Market (for Ms. Liu)</strong>
    </span>
</h2>
<figure class="table">
    <table class="ck-table-resized" style="border-style:none;">
        <colgroup>
            <col style="width:50%;">
            <col style="width:50%;">
        </colgroup>
        <tbody>
            <tr>
                <td style="padding:5pt;vertical-align:top;">
                    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;"><strong>Item</strong></span>
                </td>
                <td style="padding:5pt;vertical-align:top;">
                    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;"><strong>Whole Leatherjacket Fish (50–500g)</strong></span>
                </td>
            </tr>
            <tr>
                <td style="padding:5pt;vertical-align:top;">
                    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">Origin</span>
                </td>
                <td style="padding:5pt;vertical-align:top;">
                    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">Brondong, Lamongan – East Java, Indonesia</span>
                </td>
            </tr>
            <tr>
                <td style="padding:5pt;vertical-align:top;">
                    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">Processing</span>
                </td>
                <td style="padding:5pt;vertical-align:top;">
                    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">Whole, cleaned, sorted, frozen</span>
                </td>
            </tr>
            <tr>
                <td style="padding:5pt;vertical-align:top;">
                    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">Grade Range</span>
                </td>
                <td style="padding:5pt;vertical-align:top;">
                    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">50–100g, 100–200g, 200–300g, 300–500g</span>
                </td>
            </tr>
            <tr>
                <td style="padding:5pt;vertical-align:top;">
                    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">Glazing</span>
                </td>
                <td style="padding:5pt;vertical-align:top;">
                    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">5–10% (Protective)</span>
                </td>
            </tr>
            <tr>
                <td style="padding:5pt;vertical-align:top;">
                    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">Packing</span>
                </td>
                <td style="padding:5pt;vertical-align:top;">
                    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">Bulk export cartons (net weight 10–20kg)</span>
                </td>
            </tr>
            <tr>
                <td style="padding:5pt;vertical-align:top;">
                    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">Temperature</span>
                </td>
                <td style="padding:5pt;vertical-align:top;">
                    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">-18°C or below</span>
                </td>
            </tr>
            <tr>
                <td style="padding:5pt;vertical-align:top;">
                    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">Certification</span>
                </td>
                <td style="padding:5pt;vertical-align:top;">
                    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">HACCP, Halal, Export-licensed</span>
                </td>
            </tr>
        </tbody>
    </table>
</figure>
<h2 style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:17pt;">
        <strong>Why Chinese Buyers Prefer Indonesia Seafood</strong>
    </span>
</h2>
<h3 style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:13pt;">
        <strong>1. Consistent Supply from Brondong</strong>
    </span>
</h3>
<p style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">
        Brondong is a stable hub for Leatherjacket, enabling Indonesia Seafood to secure high daily volumes—ideal for China’s large-scale demand.
    </span>
</p>
<h3 style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:13pt;">
        <strong>2. Export-Grade Processing</strong>
    </span>
</h3>
<p style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">Our Lamongan facility is managed under:</span>
</p>
<ul>
    <li class="ck-list-marker-bold ck-list-marker-font-size ck-list-marker-color ck-list-marker-font-family" style="--ck-content-list-marker-color:#000000;--ck-content-list-marker-font-family:Calibri,sans-serif;--ck-content-list-marker-font-size:11pt;" data-list-item-id="e1ee1a2a3631f83364e8032d77706bd74">
        <p style="text-align:justify;">
            <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;"><strong>HACCP seafood Indonesia</strong></span>
        </p>
    </li>
    <li class="ck-list-marker-bold ck-list-marker-font-size ck-list-marker-color ck-list-marker-font-family" style="--ck-content-list-marker-color:#000000;--ck-content-list-marker-font-family:Calibri,sans-serif;--ck-content-list-marker-font-size:11pt;" data-list-item-id="e96a6b9707f177a7e6a8b19b620b13c13">
        <p style="text-align:justify;">
            <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;"><strong>Halal-certified production</strong></span>
        </p>
    </li>
    <li class="ck-list-marker-font-size ck-list-marker-color ck-list-marker-font-family" style="--ck-content-list-marker-color:#000000;--ck-content-list-marker-font-family:Calibri,sans-serif;--ck-content-list-marker-font-size:11pt;" data-list-item-id="ea05c56bd7819d2a3ba1afea95ee2ae75">
        <p style="text-align:justify;">
            <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">strict QC on size grading and freshness</span>
        </p>
    </li>
</ul>
<h3 style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:13pt;">
        <strong>3. Strong Partnership with China</strong>
    </span>
</h3>
<p style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">
        We supply Chinese importers regularly, including long-term customers like&nbsp;<strong>Ms. Liu</strong>, who require:
    </span>
</p>
<ul>
    <li class="ck-list-marker-font-size ck-list-marker-color ck-list-marker-font-family" style="--ck-content-list-marker-color:#000000;--ck-content-list-marker-font-family:Calibri,sans-serif;--ck-content-list-marker-font-size:11pt;" data-list-item-id="e77c34eb24186ff950febb1388438c29f">
        <p style="text-align:justify;">
            <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">stable volume</span>
        </p>
    </li>
    <li class="ck-list-marker-font-size ck-list-marker-color ck-list-marker-font-family" style="--ck-content-list-marker-color:#000000;--ck-content-list-marker-font-family:Calibri,sans-serif;--ck-content-list-marker-font-size:11pt;" data-list-item-id="e390a4eb98652510eaafd4d3b93f87223">
        <p style="text-align:justify;">
            <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">consistent sizing</span>
        </p>
    </li>
    <li class="ck-list-marker-font-size ck-list-marker-color ck-list-marker-font-family" style="--ck-content-list-marker-color:#000000;--ck-content-list-marker-font-family:Calibri,sans-serif;--ck-content-list-marker-font-size:11pt;" data-list-item-id="ec76c961c219a25afe5ead02bde85f04e">
        <p style="text-align:justify;">
            <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">fast processing time</span>
        </p>
    </li>
    <li class="ck-list-marker-font-size ck-list-marker-color ck-list-marker-font-family" style="--ck-content-list-marker-color:#000000;--ck-content-list-marker-font-family:Calibri,sans-serif;--ck-content-list-marker-font-size:11pt;" data-list-item-id="e12bef424bdb0b01650d6a777411f432c">
        <p style="text-align:justify;">
            <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">clean and uniform whole fish</span>
        </p>
    </li>
</ul>
<h3 style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:13pt;">
        <strong>4. Competitive Wholesale Pricing</strong>
    </span>
</h3>
<p style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">
        Indonesia Seafood is known for cost-effective, export-quality frozen fish products suitable for China’s wholesale, retail, and seafood processing industry.
    </span>
</p>
<h2 style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:17pt;">
        <strong>Export Timeline (July–August 2025)</strong>
    </span>
</h2>
<p style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">The July–August production cycle followed these steps:</span>
</p>
<ol>
    <li class="ck-list-marker-font-size ck-list-marker-color ck-list-marker-font-family" style="--ck-content-list-marker-color:#000000;--ck-content-list-marker-font-family:Calibri,sans-serif;--ck-content-list-marker-font-size:11pt;" data-list-item-id="e836a19097ad9d4efe0a4904411c69300">
        <p style="text-align:justify;">
            <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;"><strong>Daily raw material collection</strong> from Brondong port</span>
        </p>
    </li>
    <li class="ck-list-marker-font-size ck-list-marker-color ck-list-marker-font-family" style="--ck-content-list-marker-color:#000000;--ck-content-list-marker-font-family:Calibri,sans-serif;--ck-content-list-marker-font-size:11pt;" data-list-item-id="ea33ff77e13bb560a75745f18243734a3">
        <p style="text-align:justify;">
            <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;"><strong>Immediate cleaning and sorting</strong> into 50–500g sizes</span>
        </p>
    </li>
    <li class="ck-list-marker-font-size ck-list-marker-color ck-list-marker-font-family" style="--ck-content-list-marker-color:#000000;--ck-content-list-marker-font-family:Calibri,sans-serif;--ck-content-list-marker-font-size:11pt;" data-list-item-id="e1bc8f49deac0a3b1ab737db5c5fb2646">
        <p style="text-align:justify;">
            <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;"><strong>Rapid freezing</strong> (blast freezer / IQF)</span>
        </p>
    </li>
    <li class="ck-list-marker-font-size ck-list-marker-color ck-list-marker-font-family" style="--ck-content-list-marker-color:#000000;--ck-content-list-marker-font-family:Calibri,sans-serif;--ck-content-list-marker-font-size:11pt;" data-list-item-id="ef008a37e5bdf642da1b4a302970ef83f">
        <p style="text-align:justify;">
            <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;"><strong>Packing into export cartons</strong> labeled in English &amp; Chinese</span>
        </p>
    </li>
    <li class="ck-list-marker-font-size ck-list-marker-color ck-list-marker-font-family" style="--ck-content-list-marker-color:#000000;--ck-content-list-marker-font-family:Calibri,sans-serif;--ck-content-list-marker-font-size:11pt;" data-list-item-id="e0aa55f4fd4172b74aea826d8af212e84">
        <p style="text-align:justify;">
            <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;"><strong>QC inspection</strong> before container loading</span>
        </p>
    </li>
    <li class="ck-list-marker-font-size ck-list-marker-color ck-list-marker-font-family" style="--ck-content-list-marker-color:#000000;--ck-content-list-marker-font-family:Calibri,sans-serif;--ck-content-list-marker-font-size:11pt;" data-list-item-id="eaf63e7bfb194b0aa5ece780538e55d5a">
        <p style="text-align:justify;">
            <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;"><strong>Reefer container shipment</strong> from East Java to China</span>
        </p>
    </li>
</ol>
<p style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">
        This cycle ensured stable product temperature and high-quality arrival for Ms. Liu’s market distribution.
    </span>
</p>
HTML;

        $body3 = <<<'HTML'
<p style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">
        In&nbsp;<strong>November 2025</strong>,&nbsp;<strong>Indonesia Seafood</strong> carried out a full procurement and processing cycle of&nbsp;<strong>Silver Moonfish (Ikan Semar)</strong> in&nbsp;<strong>Ambon, Maluku</strong>. The fish were collected directly from&nbsp;<strong>local fish auctions</strong> and&nbsp;<strong>small-scale fishermen</strong>, processed fresh on-site, and frozen for shipment to our Jakarta storage facility located in&nbsp;<strong>Muara Baru</strong>.
    </span>
</p>
<p style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">
        This cycle ensures steady stock availability for our Jakarta operations, strengthening our supply chain for domestic and export markets.
    </span>
</p>
<p style="text-align:justify;">
    &nbsp;
</p>
<hr>
<h2 style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:17pt;">
        <strong>Ambon, Maluku: One of Indonesia’s Key Silver Moonfish Sources</strong>
    </span>
</h2>
<p style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">
        Ambon is widely recognized as a prime source of&nbsp;<strong>Silver Moonfish</strong>, thanks to its rich coastal fishing grounds and active daily fish markets.
    </span>
    <br>
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">
        During the November 2025 procurement cycle, our team sourced raw materials from:
    </span>
</p>
<ul>
    <li class="ck-list-marker-bold ck-list-marker-font-size ck-list-marker-color ck-list-marker-font-family" style="--ck-content-list-marker-color:#000000;--ck-content-list-marker-font-family:Calibri,sans-serif;--ck-content-list-marker-font-size:11pt;" data-list-item-id="e47055732b71c9ddbe64cbc118a55dc64">
        <p style="text-align:justify;">
            <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;"><strong>Ambon Fish Auction (TPI)</strong></span>
        </p>
    </li>
    <li class="ck-list-marker-bold ck-list-marker-font-size ck-list-marker-color ck-list-marker-font-family" style="--ck-content-list-marker-color:#000000;--ck-content-list-marker-font-family:Calibri,sans-serif;--ck-content-list-marker-font-size:11pt;" data-list-item-id="e7170afcdcec3510d19b0795d1ff0b64f">
        <p style="text-align:justify;">
            <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;"><strong>Local fishermen’s daily catch</strong></span>
        </p>
    </li>
    <li class="ck-list-marker-bold ck-list-marker-font-size ck-list-marker-color ck-list-marker-font-family" style="--ck-content-list-marker-color:#000000;--ck-content-list-marker-font-family:Calibri,sans-serif;--ck-content-list-marker-font-size:11pt;" data-list-item-id="e03b53e0748b0dc3b465978538116fa35">
        <p style="text-align:justify;">
            <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;"><strong>Coastal community landing sites</strong></span>
            <br>
            <br>
            &nbsp;
        </p>
    </li>
</ul>
<p style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">
        This ensures high freshness and stable volume for processing.
    </span>
</p>
<p style="margin-left:30pt;text-align:center;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">
        <strong>
            <picture>
                <source srcset="https://ckbox.cloud/d6ac0f646ba306de9d20/assets/tmiQ9hj-rC4f/images/80.webp 80w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/tmiQ9hj-rC4f/images/160.webp 160w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/tmiQ9hj-rC4f/images/240.webp 240w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/tmiQ9hj-rC4f/images/320.webp 320w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/tmiQ9hj-rC4f/images/400.webp 400w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/tmiQ9hj-rC4f/images/438.webp 438w" sizes="(max-width: 438px) 100vw, 438px" type="image/webp">
                    <img src="https://ckbox.cloud/d6ac0f646ba306de9d20/assets/tmiQ9hj-rC4f/images/438.png" width="195" height="272" data-ckbox-resource-id="tmiQ9hj-rC4f">
                </source>
            </picture>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <picture>
                <source srcset="https://ckbox.cloud/d6ac0f646ba306de9d20/assets/hhK8cW-W6uDN/images/80.webp 80w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/hhK8cW-W6uDN/images/160.webp 160w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/hhK8cW-W6uDN/images/240.webp 240w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/hhK8cW-W6uDN/images/320.webp 320w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/hhK8cW-W6uDN/images/400.webp 400w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/hhK8cW-W6uDN/images/480.webp 480w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/hhK8cW-W6uDN/images/528.webp 528w" type="image/webp" sizes="(max-width: 528px) 100vw, 528px">
                    <img src="https://ckbox.cloud/d6ac0f646ba306de9d20/assets/hhK8cW-W6uDN/images/528.png" data-ckbox-resource-id="hhK8cW-W6uDN" width="182" height="272">
                </source>
            </picture>
        </strong>
    </span>
</p>
<h2 style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:17pt;">
        <strong>Fresh Collection and Processing of Silver Moonfish (Ikan Semar)</strong>
    </span>
</h2>
<p style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">
        After raw materials were collected, Indonesia Seafood carried out a controlled fresh-to-frozen workflow to maintain premium quality.
    </span>
</p>
<h3 style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:13pt;">
        <strong>1. Raw Material Sorting</strong>
    </span>
</h3>
<p style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">
        Fish were sorted based on size, freshness, and quality grade to match our Jakarta stock specifications.
    </span>
</p>
<h3 style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:13pt;">
        <strong>2. Washing &amp; Cleaning</strong>
    </span>
</h3>
<p style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">
        Silver Moonfish were cleaned thoroughly to remove impurities before freezing.
    </span>
</p>
<h3 style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:13pt;">
        <strong>3. Freezing Process</strong>
    </span>
</h3>
<p style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">
        Using&nbsp;<strong>IQF and blast freezing equipment</strong>, we froze the fish rapidly to lock in:
    </span>
</p>
<ul>
    <li class="ck-list-marker-font-size ck-list-marker-color ck-list-marker-font-family" style="--ck-content-list-marker-color:#000000;--ck-content-list-marker-font-family:Calibri,sans-serif;--ck-content-list-marker-font-size:11pt;" data-list-item-id="ed005b79891dbbeadce7c8d2be9d084be">
        <p style="text-align:justify;">
            <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">texture</span>
        </p>
    </li>
    <li class="ck-list-marker-font-size ck-list-marker-color ck-list-marker-font-family" style="--ck-content-list-marker-color:#000000;--ck-content-list-marker-font-family:Calibri,sans-serif;--ck-content-list-marker-font-size:11pt;" data-list-item-id="e5251374e471a603a6001dcaf1fd879ce">
        <p style="text-align:justify;">
            <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">natural moisture</span>
        </p>
    </li>
    <li class="ck-list-marker-font-size ck-list-marker-color ck-list-marker-font-family" style="--ck-content-list-marker-color:#000000;--ck-content-list-marker-font-family:Calibri,sans-serif;--ck-content-list-marker-font-size:11pt;" data-list-item-id="eff49828ae832937f07d56e672e05e4a1">
        <p style="text-align:justify;">
            <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">freshness</span>
        </p>
    </li>
    <li class="ck-list-marker-font-size ck-list-marker-color ck-list-marker-font-family" style="--ck-content-list-marker-color:#000000;--ck-content-list-marker-font-family:Calibri,sans-serif;--ck-content-list-marker-font-size:11pt;" data-list-item-id="e5238e2a1389ffd14ac0acccb361e1b35">
        <p style="text-align:justify;">
            <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">color</span>
        </p>
    </li>
</ul>
<p style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">
        This enables longer shelf life and stable quality during transport.
    </span>
</p>
<h3 style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:13pt;">
        <strong>4. Packing for Long-Distance Shipping</strong>
    </span>
</h3>
<p style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">
        Fish were packed into export-standard cartons with clear labeling:
    </span>
</p>
<ul>
    <li class="ck-list-marker-font-size ck-list-marker-color ck-list-marker-font-family" style="--ck-content-list-marker-color:#000000;--ck-content-list-marker-font-family:Calibri,sans-serif;--ck-content-list-marker-font-size:11pt;" data-list-item-id="e04c78ea0a26a8fb4beb875df232a96b9">
        <p style="text-align:justify;">
            <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">species name</span>
        </p>
    </li>
    <li class="ck-list-marker-font-size ck-list-marker-color ck-list-marker-font-family" style="--ck-content-list-marker-color:#000000;--ck-content-list-marker-font-family:Calibri,sans-serif;--ck-content-list-marker-font-size:11pt;" data-list-item-id="e428f345aa3a9a857fdc4fce18de03b21">
        <p style="text-align:justify;">
            <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">production date</span>
        </p>
    </li>
    <li class="ck-list-marker-font-size ck-list-marker-color ck-list-marker-font-family" style="--ck-content-list-marker-color:#000000;--ck-content-list-marker-font-family:Calibri,sans-serif;--ck-content-list-marker-font-size:11pt;" data-list-item-id="e97dcadc55958211b5065853cae4eb30e">
        <p style="text-align:justify;">
            <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">weight</span>
        </p>
    </li>
    <li class="ck-list-marker-font-size ck-list-marker-color ck-list-marker-font-family" style="--ck-content-list-marker-color:#000000;--ck-content-list-marker-font-family:Calibri,sans-serif;--ck-content-list-marker-font-size:11pt;" data-list-item-id="e79fd391ac24fa0e93438b9d74d4cd730">
        <p style="text-align:justify;">
            <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">grade</span>
            <p style="text-align:center;">
                <br>
                <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">
                    <picture>
                        <source srcset="https://ckbox.cloud/d6ac0f646ba306de9d20/assets/oMmKq_BvhXPQ/images/80.webp 80w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/oMmKq_BvhXPQ/images/160.webp 160w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/oMmKq_BvhXPQ/images/240.webp 240w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/oMmKq_BvhXPQ/images/320.webp 320w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/oMmKq_BvhXPQ/images/400.webp 400w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/oMmKq_BvhXPQ/images/480.webp 480w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/oMmKq_BvhXPQ/images/560.webp 560w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/oMmKq_BvhXPQ/images/563.webp 563w" sizes="(max-width: 563px) 100vw, 563px" type="image/webp">
                            <img src="https://ckbox.cloud/d6ac0f646ba306de9d20/assets/oMmKq_BvhXPQ/images/563.png" width="193" height="259" data-ckbox-resource-id="oMmKq_BvhXPQ">
                        </source>
                    </picture>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <picture>
                        <source srcset="https://ckbox.cloud/d6ac0f646ba306de9d20/assets/Ar3f-RwLy_H6/images/80.webp 80w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/Ar3f-RwLy_H6/images/160.webp 160w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/Ar3f-RwLy_H6/images/240.webp 240w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/Ar3f-RwLy_H6/images/320.webp 320w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/Ar3f-RwLy_H6/images/400.webp 400w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/Ar3f-RwLy_H6/images/480.webp 480w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/Ar3f-RwLy_H6/images/560.webp 560w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/Ar3f-RwLy_H6/images/582.webp 582w" sizes="(max-width: 582px) 100vw, 582px" type="image/webp">
                            <img src="https://ckbox.cloud/d6ac0f646ba306de9d20/assets/Ar3f-RwLy_H6/images/582.png" width="214" height="260" data-ckbox-resource-id="Ar3f-RwLy_H6">
                        </source>
                    </picture>
                </span>
            </p>
        </p>
    </li>
</ul>
<h2 style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:17pt;">
        <strong>Shipping to Muara Baru, Jakarta (Cold Chain Transport)</strong>
    </span>
</h2>
<p style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">
        After processing, the frozen Silver Moonfish were loaded into a&nbsp;<strong>-18°C reefer vessel or cold truck</strong> for shipment to Jakarta.
    </span>
</p>
<h3 style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:13pt;">
        <strong>Destination:</strong>
    </span>
</h3>
<p style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">
        <strong>Indonesia Seafood Jakarta Warehouse – Muara Baru</strong>
    </span>
</p>
<p style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">
        This location functions as our central distribution point for:
    </span>
</p>
<ul>
    <li class="ck-list-marker-font-size ck-list-marker-color ck-list-marker-font-family" style="--ck-content-list-marker-color:#000000;--ck-content-list-marker-font-family:Calibri,sans-serif;--ck-content-list-marker-font-size:11pt;" data-list-item-id="e1dd05608cfa42a9a9dcf20c98b25eac0">
        <p style="text-align:justify;">
            <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">local wholesale supply</span>
        </p>
    </li>
    <li class="ck-list-marker-font-size ck-list-marker-color ck-list-marker-font-family" style="--ck-content-list-marker-color:#000000;--ck-content-list-marker-font-family:Calibri,sans-serif;--ck-content-list-marker-font-size:11pt;" data-list-item-id="ebac62c012d4c9133ca75e38a464f4a73">
        <p style="text-align:justify;">
            <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">food service buyers</span>
        </p>
    </li>
    <li class="ck-list-marker-font-size ck-list-marker-color ck-list-marker-font-family" style="--ck-content-list-marker-color:#000000;--ck-content-list-marker-font-family:Calibri,sans-serif;--ck-content-list-marker-font-size:11pt;" data-list-item-id="e1d67d6bd5ae4790711d3efe603840e39">
        <p style="text-align:justify;">
            <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">export preparation</span>
        </p>
    </li>
    <li class="ck-list-marker-font-size ck-list-marker-color ck-list-marker-font-family" style="--ck-content-list-marker-color:#000000;--ck-content-list-marker-font-family:Calibri,sans-serif;--ck-content-list-marker-font-size:11pt;" data-list-item-id="ef26018b62d67592b191dcaf040438ced">
        <p style="text-align:justify;">
            <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">multi-species cold storage</span>
        </p>
    </li>
</ul>
<p style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">
        Maintaining a reliable Silver Moonfish stock in Jakarta ensures faster fulfillment for B2B customers throughout Indonesia and abroad.
    </span>
</p>
<p style="margin-left:30pt;text-align:center;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">
        <strong>
            <picture>
                <source srcset="https://ckbox.cloud/d6ac0f646ba306de9d20/assets/CAmr4UdAFu7W/images/80.webp 80w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/CAmr4UdAFu7W/images/160.webp 160w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/CAmr4UdAFu7W/images/240.webp 240w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/CAmr4UdAFu7W/images/320.webp 320w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/CAmr4UdAFu7W/images/400.webp 400w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/CAmr4UdAFu7W/images/480.webp 480w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/CAmr4UdAFu7W/images/505.webp 505w" sizes="(max-width: 505px) 100vw, 505px" type="image/webp">
                    <img src="https://ckbox.cloud/d6ac0f646ba306de9d20/assets/CAmr4UdAFu7W/images/505.png" width="250" height="378" data-ckbox-resource-id="CAmr4UdAFu7W">
                </source>
            </picture>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <picture>
                <source srcset="https://ckbox.cloud/d6ac0f646ba306de9d20/assets/GQ4MvM4fVwlI/images/80.webp 80w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/GQ4MvM4fVwlI/images/160.webp 160w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/GQ4MvM4fVwlI/images/240.webp 240w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/GQ4MvM4fVwlI/images/320.webp 320w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/GQ4MvM4fVwlI/images/400.webp 400w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/GQ4MvM4fVwlI/images/480.webp 480w,https://ckbox.cloud/d6ac0f646ba306de9d20/assets/GQ4MvM4fVwlI/images/482.webp 482w" type="image/webp" sizes="(max-width: 482px) 100vw, 482px">
                    <img src="https://ckbox.cloud/d6ac0f646ba306de9d20/assets/GQ4MvM4fVwlI/images/482.png" data-ckbox-resource-id="GQ4MvM4fVwlI" width="277" height="375">
                </source>
            </picture>
        </strong>
    </span>
</p>
<p style="text-align:justify;">
    &nbsp;
</p>
<hr>
<h1 style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:23pt;">
        <strong>Product Specification: Silver Moonfish (Ikan Semar)</strong>
    </span>
</h1>
<figure class="table">
    <table class="ck-table-resized" style="border-style:none;">
        <colgroup>
            <col style="width:50%;">
            <col style="width:50%;">
        </colgroup>
        <tbody>
            <tr>
                <td style="padding:5pt;vertical-align:top;">
                    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;"><strong>Item</strong></span>
                </td>
                <td style="padding:5pt;vertical-align:top;">
                    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;"><strong>Silver Moonfish / Ikan Semar</strong></span>
                </td>
            </tr>
            <tr>
                <td style="padding:5pt;vertical-align:top;">
                    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">Origin</span>
                </td>
                <td style="padding:5pt;vertical-align:top;">
                    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">Ambon, Maluku – Indonesia</span>
                </td>
            </tr>
            <tr>
                <td style="padding:5pt;vertical-align:top;">
                    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">Source</span>
                </td>
                <td style="padding:5pt;vertical-align:top;">
                    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">Fish auctions, local fishermen</span>
                </td>
            </tr>
            <tr>
                <td style="padding:5pt;vertical-align:top;">
                    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">Form</span>
                </td>
                <td style="padding:5pt;vertical-align:top;">
                    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">Whole, cleaned, frozen</span>
                </td>
            </tr>
            <tr>
                <td style="padding:5pt;vertical-align:top;">
                    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">Freezing</span>
                </td>
                <td style="padding:5pt;vertical-align:top;">
                    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">IQF / Blast frozen</span>
                </td>
            </tr>
            <tr>
                <td style="padding:5pt;vertical-align:top;">
                    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">Packing</span>
                </td>
                <td style="padding:5pt;vertical-align:top;">
                    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">10–20 kg cartons</span>
                </td>
            </tr>
            <tr>
                <td style="padding:5pt;vertical-align:top;">
                    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">Storage</span>
                </td>
                <td style="padding:5pt;vertical-align:top;">
                    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">-18°C (Muara Baru, Jakarta)</span>
                </td>
            </tr>
        </tbody>
    </table>
</figure>
<p style="text-align:justify;">
    &nbsp;
</p>
<hr>
<h2 style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:17pt;">
        <strong>Why Indonesia Seafood Processes Silver Moonfish in Ambon</strong>
    </span>
</h2>
<h3 style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:13pt;">
        <strong>1. Extremely Fresh Raw Material</strong>
    </span>
</h3>
<p style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">
        Ambon’s coastal areas provide consistent daily supply directly from local fishermen.
    </span>
</p>
<h3 style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:13pt;">
        <strong>2. Efficient Fresh-to-Frozen Workflow</strong>
    </span>
</h3>
<p style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">
        Minimal time between catch, processing, and freezing results in premium quality.
    </span>
</p>
<h3 style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:13pt;">
        <strong>3. Strategic Jakarta Distribution</strong>
    </span>
</h3>
<p style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">
        By storing stock in&nbsp;<strong>Muara Baru</strong>, we ensure:
    </span>
</p>
<ul>
    <li class="ck-list-marker-font-size ck-list-marker-color ck-list-marker-font-family" style="--ck-content-list-marker-color:#000000;--ck-content-list-marker-font-family:Calibri,sans-serif;--ck-content-list-marker-font-size:11pt;" data-list-item-id="eb8d3dbe129e8d9f690e42b060b6109cc">
        <p style="text-align:justify;">
            <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">Fast delivery to buyers</span>
        </p>
    </li>
    <li class="ck-list-marker-font-size ck-list-marker-color ck-list-marker-font-family" style="--ck-content-list-marker-color:#000000;--ck-content-list-marker-font-family:Calibri,sans-serif;--ck-content-list-marker-font-size:11pt;" data-list-item-id="e7fc61a6a467a5a9e3dce92f1f6872bf1">
        <p style="text-align:justify;">
            <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">Lower logistics costs</span>
        </p>
    </li>
    <li class="ck-list-marker-font-size ck-list-marker-color ck-list-marker-font-family" style="--ck-content-list-marker-color:#000000;--ck-content-list-marker-font-family:Calibri,sans-serif;--ck-content-list-marker-font-size:11pt;" data-list-item-id="e9798de02ff3fd711f745ec5f43d4135b">
        <p style="text-align:justify;">
            <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">Stable availability for export and domestic markets</span>
        </p>
    </li>
</ul>
<h3 style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:13pt;">
        <strong>4. Trusted Quality Standards</strong>
    </span>
</h3>
<p style="text-align:justify;">
    <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">
        Our processing follows:
    </span>
</p>
<ul>
    <li class="ck-list-marker-bold ck-list-marker-font-size ck-list-marker-color ck-list-marker-font-family" style="--ck-content-list-marker-color:#000000;--ck-content-list-marker-font-family:Calibri,sans-serif;--ck-content-list-marker-font-size:11pt;" data-list-item-id="e20a001e691cba59a15643619068c656f">
        <p style="text-align:justify;">
            <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;"><strong>HACCP seafood Indonesia</strong></span>
        </p>
    </li>
    <li class="ck-list-marker-bold ck-list-marker-font-size ck-list-marker-color ck-list-marker-font-family" style="--ck-content-list-marker-color:#000000;--ck-content-list-marker-font-family:Calibri,sans-serif;--ck-content-list-marker-font-size:11pt;" data-list-item-id="e4d303624951f3c7811dff0bbb5a6abb9">
        <p style="text-align:justify;">
            <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;"><strong>Halal-certified workflow</strong></span>
        </p>
    </li>
    <li class="ck-list-marker-font-size ck-list-marker-color ck-list-marker-font-family" style="--ck-content-list-marker-color:#000000;--ck-content-list-marker-font-family:Calibri,sans-serif;--ck-content-list-marker-font-size:11pt;" data-list-item-id="e82f3622c4be7b72ce6c14b5c632ee02d">
        <p style="text-align:justify;">
            <span style="background-color:transparent;color:#000000;font-family:Calibri,sans-serif;font-size:11pt;">strict QC on handling and freezing</span>
        </p>
    </li>
</ul>
HTML;


        Article::updateOrCreate(
            [
                'slug' => 'exporting-barramundi-fillets-to-australia-indonesia-seafoods-surabaya-processing',
            ],
            [
                'article_category_id' => $category->id,
                'title'               => 'Exporting Barramundi Fillets to Australia: Indonesia Seafood’s Surabaya Processing',
                'body'                => $body,
                'is_published'        => true,
                'thumbnail'               => 'article/artikel1.png',
                'published_at'        => Carbon::create(2025, 1, 15),
                'meta_title'          => 'Exporting Barramundi Fillets to Australia – Indonesia Seafood Surabaya Case Study',
                'meta_description'    => 'Case study of Indonesia Seafood’s export of barramundi fillets and multispecies frozen seafood from Surabaya to Australia (Dec 2024–Jan 2025).',
            ]
        );

        Article::updateOrCreate(
            [
                'slug' => 'processing-leatherjacket-fish-for-china-indonesia-seafoods-brondong-operations',
            ],
            [
                'article_category_id' => $category->id,
                'title'               => "Processing Leatherjacket Fish for China: Indonesia Seafood’s Brondong Operations",
                'body'                => $body2,
                'is_published'        => true,
                'thumbnail'               => 'article/artikel2.png',
                // tengah-tengah periode July–August 2025
                'published_at'        => Carbon::create(2025, 8, 1),
                'meta_title'          => 'Processing Leatherjacket Fish for China – Indonesia Seafood Brondong Operations',
                'meta_description'    => 'Case study of Indonesia Seafood’s Leatherjacket fish processing in Brondong, Lamongan for China market (July–August 2025).',
            ]
        );

        Article::updateOrCreate(
            [
                'slug' => 'processing-silver-moonfish-in-ambon-maluku-for-jakarta-distribution',
            ],
            [
                'article_category_id' => $category->id,
                'title'               => "Processing Silver Moonfish in Ambon, Maluku for Jakarta Distribution",
                'body'                => $body3,
                'is_published'        => true,
                'thumbnail'               => 'article/artikel3.png',
                'published_at'        => Carbon::create(2025, 11, 15),
                'meta_title'          => 'Processing Silver Moonfish in Ambon for Jakarta Distribution – Indonesia Seafood',
                'meta_description'    => 'Operational story of Indonesia Seafood’s Silver Moonfish (Ikan Semar) processing in Ambon and cold-chain shipment to Muara Baru, Jakarta (Nov 2025).',
            ]
        );
    }
}
