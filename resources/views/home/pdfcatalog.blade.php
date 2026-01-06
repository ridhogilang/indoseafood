<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Indonesian Seafood Export Catalogue | IndoSeafood</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <link rel="icon" type="image/png" href="{{ asset('home/img/logo icon.png') }}">

    <style>
        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI",
                Roboto, Helvetica, Arial, sans-serif;
            background-color: #f8f9fa;
            color: #222;
        }

        .page-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            padding: 24px 16px;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .header img {
            height: 48px;
        }

        h1 {
            text-align: center;
            font-size: 22px;
            margin: 12px 0 24px;
            font-weight: 600;
        }

        .pdf-container {
            background: #fff;
            border: 1px solid #e1e1e1;
            border-radius: 6px;
            overflow: hidden;
        }

        iframe {
            width: 100%;
            height: 80vh;
            border: none;
        }

        .download {
            text-align: center;
            margin-top: 20px;
        }

        .download a {
            display: inline-block;
            padding: 10px 22px;
            background-color: #0d6efd;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            font-weight: 500;
        }

        .download a:hover {
            background-color: #0b5ed7;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #777;
            margin-top: 24px;
        }
    </style>
</head>

<body>

    <div class="page-wrapper">
        <div class="header">
            <img src="{{ asset('home/img/logo icon.png') }}" alt="IndoSeafood">
        </div>
        <h1>Indonesian Seafood Export Catalogue</h1>

        <div class="pdf-container">
            <iframe src="{{ asset('home/pdf/Ikan Indonesia - Seafood Offering 2025.pdf') }}" loading="lazy">
            </iframe>
        </div>
        <div class="download" style="margin-top:12px;">
            <a href="{{ asset('home/pdf/Ikan Indonesia - Seafood Offering 2025.pdf') }}" target="_blank" style="margin-right:10px;">
                Open Full PDF
            </a>
            <a href="{{ asset('home/pdf/Ikan Indonesia - Seafood Offering 2025.pdf') }}"  style="margin-right:10px;" download>
                Download Catalogue (PDF)
            </a>
            <a href="{{ route('home') }}">
                Home
            </a>
        </div>
        <div class="footer">
            © IndoSeafood — Indonesian Seafood Exporter
        </div>
    </div>

</body>

</html>
