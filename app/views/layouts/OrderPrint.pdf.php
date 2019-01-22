<?php
header("Content-type: application/pdf");
echo $this->Pdf->Output(OUTPUT_DIR.$order['mcaNumber'].'-'.$yyyy."-Order".".pdf","F");
?>