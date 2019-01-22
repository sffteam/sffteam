<?php
use app\extensions\action\Functions;

setlocale(LC_MONETARY,"en_IN");
$function = new Functions();

ini_set('memory_limit', '-1');
//print_r($agreement['mcaNumber']);exit;
$pdf =& $this->Pdf;
//$pdf->SetProtection($permissions=array('modify','extract','assemble'), $user_pass=$printdata['email'], $owner_pass=null, $mode=1, $pubkeys=null);

$this->Pdf->setCustomLayout(array(
    'header'=>function() use($pdf){
        list($r, $g, $b) = array(200,200,200);
        $pdf->SetFillColor($r, $g, $b); 
        $pdf->SetTextColor(0 , 0, 0);
        $pdf->Cell(0,15, "SFF - Services Order ", 0,1,'C', 1);
        $pdf->Ln();
    },
    'footer'=>function() use($pdf){
        $footertext = sprintf('This is a digitally printed delivery order. No need of physical signature.', date('Y-m-d')); 
        $pdf->SetY(-10); 
        $pdf->SetTextColor(0, 0, 0); 
        $pdf->SetFont(PDF_FONT_NAME_MAIN,'', 8); 
        $pdf->Cell(0,8, $footertext,'T',1,'C');
    }

));

$pdf->SetHeaderMargin(0);
$pdf->SetFooterMargin(20);
$pdf->SetAuthor('https://sff.team');
$pdf->SetCreator('schooloffinancialfreedom@gmail.com');
$pdf->SetSubject('HITS - Order');
$pdf->SetKeywords('Hitarth IT Services, School of Financial Freedom, Order, Services, Products, Home delivery');
$pdf->SetTitle('Hitarth IT Services Pvt. Ltd - contact: +91 90810 58884');


$pdf->SetAutoPageBreak(true);
$pdf->AddPage();
$pdf->SetTextColor(0, 0, 0);
$pdf->SetXY(10,20,false);



$html = '
<h2 style="text-align:center">School of Financial Freedom, Hitarth IT Services Pvt. Ltd.</h2>
<h3 style="text-align:center">'.$order['point']['name'].'</h3>
<h5 style="text-align:center">'.$order['point']['address'].', '.$order['point']['street'].', ' .$order['point']['city'].'-'.$order['point']['pin'].' '.$order['point']['state'].'<br>Mobile: +91 '.$order['point']['mobile'].', email: '.$order['point']['email'].'</h5>
<table cellpadding=15 cellspacing=15 border=0 style="font-size:24px">
<tr>
<td  colspan="8" style="font-size:30px;font-weight:bold;padding:5px;text-align:right">Date: '.gmdate("Y-M-d").'</td>
</tr>
<tr>
<td  colspan="8" style="font-size:30px;font-weight:bold;padding:5px;text-align:center"><u>Order No: '.$order['mcaNumber'].$yyyy.'</u></td>
</tr>
<tr>
<td  colspan="8" style="text-align:center"><h2>Delivery Order</h2></td>
</tr>
<tr>
<td colspan="2" style="text-align:left">Delivered to:</td>
<td colspan="6" style="text-align:left"><strong>'.$order['firstName'].' '.$order['lastName'].'</strong></td>
</tr>
<tr>
<td colspan="2" style="text-align:left">MCA Number:</td>
<td colspan="6" style="text-align:left"><strong>'.$order['mcaNumber'].'</strong></td>
</tr>
<tr>
<td colspan="2" style="text-align:left">Mobile:</td>
<td colspan="6" style="text-align:left"><strong>'.$order['mobile'].'</strong></td>
</tr>
<tr>
<td colspan="2" style="text-align:left">Email:</td>
<td colspan="6" style="text-align:left"><strong>'.$order['email'].'</strong></td>
</tr>
<tr>
<td colspan="2" style="text-align:left">Address:</td>
<td colspan="6" style="text-align:left"><strong>'.$order['address'].', '.$order['street'].', '.$order['city'].'-'.$order['pin'].' '.$order['state'].' </strong></td>
</tr>
<tr>
<td colspan="2" style="text-align:left">Month:</td>
<td colspan="6" style="text-align:left"><strong>'.$yyyy.'</strong></td>
</tr>
<tr><td colspan="8">&nbsp;</td></tr>
<tr>
<th width="5%" style="border:.1em solid black;font-weight:bold;text-align:center">#</th>
<th width="10%" style="border:.1em solid black;font-weight:bold;text-align:center">Code</th>
<th width="20%" style="border:.1em solid black;font-weight:bold;text-align:center">Category</th>
<th width="25%" style="border:.1em solid black;font-weight:bold;text-align:center">Name</th>
<th width="10%" style="border:.1em solid black;font-weight:bold;text-align:center">MRP</th>
<th width="10%" style="border:.1em solid black;font-weight:bold;text-align:center">Discount</th>
<th width="10%" style="border:.1em solid black;font-weight:bold;text-align:center">Quantity</th>
<th width="10%" style="border:.1em solid black;font-weight:bold;text-align:center">Value Rs.</th>
</tr>';
$i = 1;
$totalValue = 0;
$quantity = 0;
foreach($order[$yyyy] as $o){
$html = $html . '<tr>
<th style="border:.1em solid black;text-align:center">'.$i.'</th>
<th style="border:.1em solid black;text-align:center">'.$o['code'].'</th>
<th style="border:.1em solid black;text-align:left">'.ucwords($o['category']).'</th>
<th style="border:.1em solid black;text-align:left">'.ucwords($o['name']).'</th>
<th style="border:.1em solid black;text-align:center">'.$function->CurrencyFormat($o['mrp']).'</th>
<th style="border:.1em solid black;text-align:center">'.$o['discount'].' '.$o['discountType'].'</th>
<th style="border:.1em solid black;text-align:center">'.($o['quantity']).'</th>
<th style="border:.1em solid black;text-align:center">'.$function->CurrencyFormat($o['value']).'</th>
</tr>';
 $quantity = $quantity + ($o['quantity']);
 $totalValue = $totalValue + $o['value'];
 $i++;
}
$html = $html . '<tr>
<th style="border:.1em solid black;text-align:center">&nbsp;</th>
<th colspan="5" style="border:.1em solid black;text-align:left">Rs. '.ucwords($function->number_to_words($totalValue)).' ONLY</th>
<th style="border:.1em solid black;text-align:center">'.$quantity.'</th>
<th style="border:.1em solid black;text-align:center">'.$function->CurrencyFormat($totalValue).'</th>
</tr>
<tr><td colspan="8">&nbsp;</td></tr>
<tr><td colspan="8">&nbsp;</td></tr>
<tr><td colspan="8">'.$order['point']['name'].'</td></tr>
<tr><td colspan="8">'.$order['point']['mobile'].'</td></tr>
<tr><td colspan="8">&nbsp;</td></tr>
<tr><td colspan="8"><hr></td></tr>
<tr><td colspan="8">&nbsp;</td></tr>

<tr>
<td colspan="2" style="text-align:left"><strong>Deliver To:</strong></td>
<td colspan="6" style="text-align:left"><strong>'.$order['firstName'].' '.$order['lastName'].'</strong></td>
</tr>
<tr>
<td colspan="2" style="text-align:left">MCA Number:</td>
<td colspan="6" style="text-align:left"><strong>'.$order['mcaNumber'].'</strong></td>
</tr>
<tr>
<td colspan="2" style="text-align:left">Mobile:</td>
<td colspan="6" style="text-align:left"><strong>'.$order['mobile'].'</strong></td>
</tr>
<tr>
<td colspan="2" style="text-align:left">Email:</td>
<td colspan="6" style="text-align:left"><strong>'.$order['email'].'</strong></td>
</tr>
<tr>
<td colspan="2" style="text-align:left">Address:</td>
<td colspan="6" style="text-align:left"><strong>'.$order['address'].',<br>'.$order['street'].',<br>'.$order['city'].'-'.$order['pin'].' '.$order['state'].' </strong></td>
</tr>
<tr>
<td colspan="2" style="text-align:left">Month:</td>
<td colspan="6" style="text-align:left"><strong>'.$yyyy.'</strong></td>
</tr>
<tr><td colspan="8">&nbsp;</td></tr>
<tr><td colspan="8">&nbsp;</td></tr>
<tr><td colspan="8"><hr></td></tr>
<tr><td colspan="8">&nbsp;</td></tr>
<tr><td colspan="2" style="text-align:left">From:</td>
<td colspan="6" style="text-align:left"><strong>'.$order['point']['name'].'</strong></td>
</tr>
<tr>
<td colspan="2" style="text-align:left">Address:</td>
<td colspan="6" style="text-align:left"><strong>'.$order['point']['address'].', '.$order['point']['street'].', ' .$order['point']['city'].'-'.$order['point']['pin'].' '.$order['point']['state'].'<br>Mobile: +91 '.$order['point']['mobile'].', email: '.$order['point']['email'].'</strong></td>
</tr>


';
$html = $html .'</table>';
$pdf->writeHTML($html, true, 0, true, 0);
?>