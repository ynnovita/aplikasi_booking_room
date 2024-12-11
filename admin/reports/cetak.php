<?php 
define('initialize_PATH', 'C:\xampp\htdocs\aplikasi_booking_room');
require(initialize_PATH . '/initialize.php');

define('DBConnection_PATH', 'C:\xampp\htdocs\aplikasi_booking_room\classes');
require(DBConnection_PATH . '/DBConnection.php');

$db = new DBConnection;
$conn = $db->conn;

define('FPDF_PATH', 'C:\xampp\htdocs\aplikasi_booking_room\libs\fpdf');
require(FPDF_PATH . '/fpdf.php');

?>

<?php
$i = 1;
$qry = $conn->query ("SELECT b.*,r.room,concat(u.firstname,' ',u.lastname) as name FROM `bookings` b inner join `room_list` r on r.id = b.room_id inner join users u on u.id = b.user_id ORDER BY(b.date_created) desc ");
while($row= $qry->fetch_array()):

$pdf = new FPDF('l','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Times', 'B', 16);
$pdf->Cell(0, 10, 'Cafe & Karaoke Dayoen99', 0, 1, 'C');
$pdf->SetFont('Times', 'B', 14);
$pdf->Cell(0, 10, 'Laporan Transaksi', 0, 1, 'C');
$pdf->SetFont('Times', 'B', 14);
$pdf->Cell(80, 10, 'Periode : ', 0, 1, 'C');
$pdf->Ln(5);



$pdf->SetFont('Times', '', 12);

// Header tabel
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(10, 10, 'ID', 1,);
$pdf->Cell(40, 10, 'Date Created', 1,);
$pdf->Cell(40, 10, 'User', 1,);
$pdf->Cell(20, 10, 'Room', 1,);
$pdf->Cell(80, 10, 'Schedule', 1,);
$pdf->Cell(20, 10, 'Status', 1,);
$pdf->Cell(30, 10, 'Total', 1,);
$pdf->Ln();


// Menampilkan data transaksi
$pdf->SetFont('Times', '', 12);
if ($qry->num_rows > 0) {
    $i = 1;
    while ($row = $qry->fetch_array()) {
    $pdf->Cell(10, 10, $row['id'], 1);
    $pdf->Cell(40, 10, date("Y-m-d H:i",strtotime($row['date_created'])), 1);
    $pdf->Cell(40, 10, $row['name'], 1);
    $pdf->Cell(20, 10, $row['room'], 1);
    $pdf->Cell(80, 10, date("Y-m-d H:i",strtotime($row['date_in'])).' - '.date("Y-m-d H:i",strtotime($row['date_out'])), 1);
    $pdf->Cell(20, 10, $row['status'], 1);
    $pdf->Cell(30, 10, 'Rp.' .number_format($row['total_amount'], 0,',','.'), 1);
    $pdf->Ln();
    $i++;
    }
} else {
    $pdf->Cell(0, 10, 'Tidak ada data dalam rentang tanggal ini.', 1, 1);
}

// Output PDF ke browser
$pdf->Output();

// Tutup koneksi
$conn->close();

endwhile; ?>