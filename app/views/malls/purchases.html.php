<?php 
 $yyyymm = date('Y-m');
 $p1yyyymm = date("Y-m", strtotime("-1 month", strtotime(date("F") . "1")) );
 $p2yyyymm = date("Y-m", strtotime("-2 month", strtotime(date("F") . "1")) );
 $p3yyyymm = date("Y-m", strtotime("-3 month", strtotime(date("F") . "1")) );
 $p4yyyymm = date("Y-m", strtotime("-4 month", strtotime(date("F") . "1")) );
 $p5yyyymm = date("Y-m", strtotime("-5 month", strtotime(date("F") . "1")) );
 $p6yyyymm = date("Y-m", strtotime("-6 month", strtotime(date("F") . "1")) );
 $p7yyyymm = date("Y-m", strtotime("-7 month", strtotime(date("F") . "1")) );
 $p8yyyymm = date("Y-m", strtotime("-8 month", strtotime(date("F") . "1")) );
 $p9yyyymm = date("Y-m", strtotime("-9 month", strtotime(date("F") . "1")) );
 $p10yyyymm = date("Y-m", strtotime("-10 month", strtotime(date("F") . "1")) );
 $p11yyyymm = date("Y-m", strtotime("-11 month", strtotime(date("F") . "1")) );
?>

<div class="row responsive-block">
 <div class="col szforth" style="border-right:1px dotted gray;border-bottom:1px solid gray;">Number</div>
 <div class="col szforth" style="border-right:1px dotted gray;border-bottom:1px solid gray;">Name</div>
 <div class="col szforth" style="border-right:1px dotted gray;border-bottom:1px solid gray;">Mobile</div>
 <div class="col szforth" style="border-right:1px dotted gray;border-bottom:1px solid gray;">DateJoin</div>
</div> 
<div class="row">
 <div class="col szforth" style="border-right:1px dotted gray;border-bottom:1px solid gray;"><?=$p11yyyymm?></div>
 <div class="col szforth" style="border-right:1px dotted gray;border-bottom:1px solid gray;"><?=$p10yyyymm?></div>
 <div class="col szforth" style="border-right:1px dotted gray;border-bottom:1px solid gray;"><?=$p9yyyymm?></div>
 <div class="col szforth" style="border-right:1px dotted gray;border-bottom:1px solid gray;"><?=$p8yyyymm?></div>
 <div class="col szforth" style="border-right:1px dotted gray;border-bottom:1px solid gray;"><?=$p7yyyymm?></div>
 <div class="col szforth" style="border-right:1px dotted gray;border-bottom:1px solid gray;"><?=$p6yyyymm?></div>
 <div class="col szforth" style="border-right:1px dotted gray;border-bottom:1px solid gray;"><?=$p5yyyymm?></div>
 <div class="col szforth" style="border-right:1px dotted gray;border-bottom:1px solid gray;"><?=$p4yyyymm?></div>
 <div class="col szforth" style="border-right:1px dotted gray;border-bottom:1px solid gray;"><?=$p3yyyymm?></div>
 <div class="col szforth" style="border-right:1px dotted gray;border-bottom:1px solid gray;"><?=$p2yyyymm?></div>
 <div class="col szforth" style="border-right:1px dotted gray;border-bottom:1px solid gray;"><?=$p1yyyymm?></div>
 <div class="col szforth" style="border-right:1px dotted gray;border-bottom:1px solid gray;"><?=$yyyymm?></div>
</div>

<?php
foreach($allusers as $u){
 ?>
<div class="row">
 <div class="col" style="border-right:1px dotted gray;border-bottom:1px solid gray;"><a href="/malls/purchases/<?=$u['mcaNumber']?>" class="external"><?=$u['mcaNumber']?></a></div>
 <div class="col" style="border-right:1px dotted gray;border-bottom:1px solid gray;"><?=$u['mcaName']?></div>
 <div class="col" style="border-right:1px dotted gray;border-bottom:1px solid gray;"><?=$u['mobile']?></div>
 <div class="col" style="border-right:1px dotted gray;border-bottom:1px solid gray;"><?=$u['DateJoin']?></div>
</div>
<div class="row">
 <div class="col" style="border-right:1px dotted gray;border-bottom:1px solid gray;"><?=$u[$p11yyyymm.'.PV']?></div>
 <div class="col" style="border-right:1px dotted gray;border-bottom:1px solid gray;"><?=$u[$p10yyyymm.'.PV']?></div>
 <div class="col" style="border-right:1px dotted gray;border-bottom:1px solid gray;"><?=$u[$p9yyyymm.'.PV']?></div>
 <div class="col" style="border-right:1px dotted gray;border-bottom:1px solid gray;"><?=$u[$p8yyyymm.'.PV']?></div>
 <div class="col" style="border-right:1px dotted gray;border-bottom:1px solid gray;"><?=$u[$p7yyyymm.'.PV']?></div>
 <div class="col" style="border-right:1px dotted gray;border-bottom:1px solid gray;"><?=$u[$p6yyyymm.'.PV']?></div>
 <div class="col" style="border-right:1px dotted gray;border-bottom:1px solid gray;"><?=$u[$p5yyyymm.'.PV']?></div>
 <div class="col" style="border-right:1px dotted gray;border-bottom:1px solid gray;"><?=$u[$p4yyyymm.'.PV']?></div>
 <div class="col" style="border-right:1px dotted gray;border-bottom:1px solid gray;"><?=$u[$p3yyyymm.'.PV']?></div>
 <div class="col" style="border-right:1px dotted gray;border-bottom:1px solid gray;"><?=$u[$p2yyyymm.'.PV']?></div>
 <div class="col" style="border-right:1px dotted gray;border-bottom:1px solid gray;"><?=$u[$p1yyyymm.'.PV']?></div>
 <div class="col" style="border-right:1px dotted gray;border-bottom:1px solid gray;"><?=$u[$yyyymm.'.PV']?></div>
</div>


<?php }?>