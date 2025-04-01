<?php
require_once('vendor/autoload.php');

use Dompdf\Dompdf;
use Dompdf\Options;

if (!isset($_GET['names'])) {
    die('Nu au fost primite date!');
}

$names = $_GET['names'];

// Configurare Dompdf
$options = new Options();
$options->set('defaultFont', 'DejaVu Sans');
$dompdf = new Dompdf($options);

// Creare conținut HTML pentru PDF
$html = '<html><head>
<style>
    body { 
        font-family: "DejaVu Sans", sans-serif;
        margin: 40px;
        color: #333;
    }
    h1 { 
        text-align: center;
        font-size: 24px;
        margin-bottom: 30px;
        color: #2c3e50;
        border-bottom: 2px solid #3498db;
        padding-bottom: 10px;
    }
    .pair { 
        margin: 15px 0;
        padding: 10px;
        background-color: #f8f9fa;
        border-radius: 5px;
        border-left: 4px solid #3498db;
    }
    .footer { 
        position: fixed;
        bottom: 20px;
        width: 100%;
        text-align: center;
        font-size: 11px;
        font-style: italic;
        color: #666;
    }
    .date { 
        margin-top: 40px;
        color: #666;
        font-style: italic;
        border-top: 1px solid #eee;
        padding-top: 10px;
    }
</style>
</head><body>';

// Titlu
$html .= '<h1>Perechi pentru Excursie Școlară</h1>';

// Generare perechi
for ($i = 0; $i < count($names) - 1; $i += 2) {
    $pair1 = $names[$i];
    $pair2 = isset($names[$i + 1]) ? $names[$i + 1] : 'Singur';
    $html .= sprintf('<div class="pair">Perechea De Scaun %d: %s cu %s</div>', ($i/2) + 1, htmlspecialchars($pair1), htmlspecialchars($pair2));
}

// Data generării
$clientTime = isset($_GET['clientTime']) ? $_GET['clientTime'] : date('d.m.Y H:i');
$html .= sprintf('<div class="date">Data generării: %s</div>', htmlspecialchars($clientTime));

// Copyright
$html .= sprintf('<div class="footer">© %s Stan Eric Andrei. Toate drepturile rezervate.</div>', date('Y'));

$html .= '</body></html>';

// Generare PDF
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Trimitere PDF către browser
$dompdf->stream('perechi_excursie.pdf', array('Attachment' => 0));