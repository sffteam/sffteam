<?php
header("Content-type: application/pdf");
echo $this->Pdf->Output(OUTPUT_DIR.$agreement['mcaNumber'].'-'.gmdate("Y-M-d",hexdec(substr($agreement['_id'], 0, 8)))."-Agreement".".pdf","F");
?>