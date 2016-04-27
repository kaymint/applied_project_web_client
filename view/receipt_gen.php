<?php
/**
 * Created by PhpStorm.
 * User: StreetHustling
 * Date: 3/15/16
 * Time: 5:24 PM
 */

require_once 'fpdf.php';

session_start();

if(!isset($_SESSION['PIN'])){
    header("Location: login.php");
}

$pdf = new FPDF();
$pdf->AddPage();
$pdf->Ln();

$offence_date = "Offence Date: ".$_SESSION['receipt_details']['offence_date'];
$location = "Location: ".$_SESSION['receipt_details']['location'];
$date_paid = "Date Paid: ".$_SESSION['receipt_details']['date_paid'];
$paid_by = "Paid By: ".$_SESSION['receipt_details']['drivername'];
$PIN = "Driver's PIN: ".$_SESSION['receipt_details']['PIN'];
$receiptNo = "Receipt #: ".$_SESSION['receipt_details']['receipt_no'];
$offenceNo = "Offence #: ".$_SESSION['receipt_details']['offence_no'];
$vehicleNo = "Vehicle #: ".$_SESSION['receipt_details']['license_no'];
$amountPaid = "Amount Paid: GHS".$_SESSION['receipt_details']['amount'].".00";


$pdf->Ln();
$pdf->Ln();

$pdf->Ln();
$pdf->Image('img/320.png', 120, 10, 50);

$pdf->Cell(80, 20, '');
$pdf->Ln();
$pdf->Ln();

$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Arial', 'b', 14);
$pdf->Cell(80, 20, 'Payment Confirmation:');
$pdf->Ln();

$pdf->SetFont('Arial', 'b', 12);
$pdf->Cell(80, 5, 'Receipt Details:');
$pdf->SetFont('Arial', 'i', 11);
$pdf->Ln();
$pdf->Cell(80, 5, $offence_date);
$pdf->Ln();
$pdf->Cell(80, 5, $location);
$pdf->Ln();
$pdf->Cell(80, 5, $date_paid);
$pdf->Ln();
$pdf->Cell(80, 5, $paid_by);
$pdf->Ln();
$pdf->Cell(80, 5, $PIN);
$pdf->Ln();
$pdf->Cell(80, 5, $receiptNo);
$pdf->Ln();
$pdf->Cell(80, 5, $offenceNo);
$pdf->Ln();
$pdf->Cell(80, 5, $vehicleNo);
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Arial', 'b', 14);
$pdf->Cell(80, 5, $amountPaid);


$pdf->Output();