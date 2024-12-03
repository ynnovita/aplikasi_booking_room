<?php
define('FPDF_PATH', 'C:\xampp\htdocs\aplikasi_booking_room\libs\fpdf');
require(FPDF_PATH . '/fpdf.php');


$pdf = new FPDF('p', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Data Transaksi', 0, 1, 'C');
$pdf->Cell(100, 10, 'Periode : ', 0, 1, 'C');
$pdf->Output('laporan-penjualan.pdf','I');

// Header tabel
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(30, 10, 'ID', 1);
$pdf->Cell(60, 10, 'Date Created', 1);
$pdf->Cell(30, 10, 'User', 1);
$pdf->Cell(70, 10, 'Room', 1);
$pdf->Cell(30, 10, 'Schedule', 1);
$pdf->Cell(30, 10, 'Total', 1);
$pdf->Ln();



// Menampilkan data transaksi
$pdf->SetFont('Arial', '', 12);

    $pdf->Cell(30, 10, $row['id'], 1);
    $pdf->Cell(60, 10, date("Y-m-d H:i",strtotime($row['date_created'])), 1);
    $pdf->Cell(30, 10, $row['name'], 1);
    $pdf->Cell(70, 10, $row['room'], 1);
    $pdf->Cell(30, 10, date("Y-m-d H:i",strtotime($row['date_in'])).' - '.date("Y-m-d H:i",strtotime($row['date_out'])), 1);
    $pdf->Cell(30, 10, number_format($row['total_amount'], 2), 1);
    $pdf->Ln();


// Menutup koneksi database
mysqli_close($conn);

// Output PDF ke browser
$pdf->Output();

?>