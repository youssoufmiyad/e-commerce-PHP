<?php
require_once("../../../utils/connect.php");
session_start();
require_once("../../../utils/tcpdf/tcpdf.php");
$orderId = $_POST["order-id"];

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle("Commande n°$orderId");
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "Commande n°$orderId");

// set header and footer fonts
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

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

// set font
$pdf->SetFont('dejavusans', '', 10);

// add a page
$pdf->AddPage();

$order_items = $db->query("SELECT * FROM order_items WHERE OrderId=$orderId;");
$invoice = $db->query("SELECT * FROM invoices WHERE OrderId=$orderId;")->fetch_assoc();

$html = "<div>
<table>

<thead>
    <tr>
        <th scope=\"col\"></th>
        <th scope=\"col\">Article</th>
        <th scope=\"col\">Quantité</th>
        <th scope=\"col\">Prix</th>
        <th scope=\"col\">Somme</th>
    </tr>
</thead>
<tbody>";
foreach ($order_items as $item) {

    $product = $db->query("SELECT Name, Price FROM products WHERE ProductId=" . $item["ProductId"])->fetch_assoc();
    $product_img = $db->query("SELECT Image FROM products_photo WHERE ProductId=" . $item["ProductId"])->fetch_assoc();
    $base64img = @base64_encode($product_img["Image"]);
    $src = "data:image/jpeg;base64," . $base64img;
    $html .= '<tr>'
        . '<td><img src="' . $src . '" alt="product photo" width="64px" height="64px" border="0"></td>'
        . "<td>" . $product["Name"] . "</td>"
        . "<td>" . $item["Quantity"] . "</td>"
        . "<td>" . $product["Price"] . "€</td>"
        . "<td>" . $item["Price"] . "€</td>"
        . "</tr>";
}
$Total = $db->query("SELECt TotalPrice FROM orders WHERE OrderId=$orderId")->fetch_assoc();

$html .= "</tbody>
<tfoot>
    <tr>
        <th scope=\"row\" colspan=\"4\">Total</th>
        <td>" . $Total["TotalPrice"] . "</td>
        </tr>
    </tfoot>
    </table>
<br>
<h5>Achat Réalisé le
    " . $invoice["InvoiceDate"] . "
</h5></div>";
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->lastPage();

ob_end_clean();
$pdf->Output("Commande n°$orderId");

