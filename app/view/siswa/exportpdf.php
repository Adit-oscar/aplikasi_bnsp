<?php
// https://github.com/tecnickcom/tcpdf
// https://tcpdf.org/examples/example_006/

// Include the main TCPDF library (search for installation path).
include '../aplikasi_bnsp/app/confiq/koneksi.php';
require_once '../aplikasi_bnsp/app/confiq/TCPDF/tcpdf.php';

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Aditiya');
$pdf->SetTitle('Laporan Mahasiswa');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// Set some content to print
// output the HTML content
$html = <<<EOD
    <center> <h1> Laporan Siswa </h1> </center>
    <table border="1">
      <tr align="center" style="font-weight: bold;">
          <th>Nisn</th>
          <th>Nama</th>
          <th>Alamat Lengkap</th>
          <th>Tanggal Lahir</th>
      </tr>
    </table>
EOD;

$html2 = <<<EOD
  <table border="1" cellpadding="4">
      <tr>
EOD;
$html3 = <<<EOD
      </tr>
    </table>
EOD;

$pdf->SetX(10);
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, 'C', true);

$no = 1;
$sql = 'SELECT * FROM siswa';
$result = $koneksi->query($sql);
while ($data = $result->fetch_assoc()) {
    $pdf->SetX(10);
    $pdf->writeHTMLCell(0, 0, '', '', $html2 . '' .
        '<td>' . $data['nisn'] . '</td>
            <td>' . $data['nama'] . '</td>
            <td>' . $data['alamat_lengkap'] . '</td> 
            <td>' . $data['tanggal_lahir'] . '</td>' .
        $html3, 0, 1, 0, true, '', true);
}
// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
ob_end_clean();
$pdf->Output('example_001.pdf', 'I');
