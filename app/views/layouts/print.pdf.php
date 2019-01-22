<?php
header("Content-type: application/pdf");
echo $this->Pdf->Output(OUTPUT_DIR.$user['mcaNumber'].$user['txid']."-Agreement".".pdf","F");
?>