<?php
// download_advice_pdf.php

require('fpdf/fpdf.php'); // Ensure FPDF is installed or included in your project

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, 'Essential Travel Documents & Expert Advice', 0, 1, 'C');

$pdf->SetFont('Arial', '', 11);

function addSection($title, $items, $pdf) {
    $pdf->Ln(5);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, $title, 0, 1);
    $pdf->SetFont('Arial', '', 11);
    foreach ($items as $item) {
        $pdf->MultiCell(0, 8, • . ' ' . $item);
    }
}

addSection("1. Passport", [
    "Ensure it’s valid for at least 6 months beyond your travel date.",
    "Have at least 2 blank pages for visa stamps.",
    "Store a photocopy or digital backup for safety."
], $pdf);

addSection("2. Visa (eVisa)", [
    "Apply on official websites like evisa.go.ke.",
    "Print your visa confirmation and carry it with you.",
    "Check processing time and required documents (photo, bookings, etc.)."
], $pdf);

addSection("3. Yellow Fever Vaccination", [
    "Required for most African destinations – get vaccinated 10 days before travel.",
    "Carry the original certificate at all times.",
    "Consider malaria prophylaxis for safaris or rural areas."
], $pdf);

addSection("4. Return or Onward Ticket", [
    "Immigration may ask for proof of return or onward travel.",
    "Use refundable/flexible bookings if plans are uncertain.",
    "Always have a copy of your itinerary."
], $pdf);

addSection("5. Travel Insurance", [
    "Highly recommended for medical emergencies and cancellations.",
    "Cover activities like safaris, hiking, etc.",
    "Print your policy and save emergency numbers."
], $pdf);

addSection("6. Hotel / Travel Itinerary", [
    "Carry booking confirmations for accommodations.",
    "Prepare a simple itinerary (with dates and destinations).",
    "Keep digital copies accessible via email or phone."
], $pdf);

addSection("7. Emergency Contact Info", [
    "List your embassy, family, and hotel contacts.",
    "Save contacts both on paper and on your phone.",
    "Enable emergency sharing features on your device."
], $pdf);

$pdf->Output('D', 'Escape_Travel_Agency_Travel_Document_Advice.pdf');
exit();
