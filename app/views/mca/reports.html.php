<div class="navbar">
  <div class="navbar-bg bg-color-black"></div>
  <div class="navbar-inner ">
    <a href="/mca/" class="external link text-color-white">Home</a>
    <a href="/mca/reports/" class="external link text-color-white">Reports</a>
    <a href="/mca/pdfs/" class="external link text-color-white">PDFs</a>
    <a href="/mca/products/categories/" class="external link text-color-white">Products</a>
    <a href="/mca/videos/" class="external link text-color-white">Videos</a>
  </div>
</div>
<?php
$yyyymm = date("Y-m", strtotime("0 month", strtotime(date("F") . "1")) );
if($mcaNumber==null){
 ?>Get MCA
<?php
}else{
 
 ?>
 
      <div class="card card-expandable ">
        <div class="card-content ">
          <div class="bg-color-white" style="height: 300px;background-color:#ff0000">
            <div class="card-header text-color-black display-block"><?=$mcaDetails['mcaName']?><br />
              <small style="opacity: 0.8"><?=$mcaDetails['mcaNumber']?>    </small><br>
              <small class="sz16 Bebas" style="opacity: 0.7"><?=$mcaDetails[$yyyymm]['ValidTitle']?> - <?=$mcaDetails['DateJoin']?></small><br>
              <small style="opacity: 0.7">PV: <?=$mcaDetails[$yyyymm]['PV']?> - GPV: <?=$mcaDetails[$yyyymm]['GPV']?></small><br>
              <small style="opacity: 0.7">PGPV: <?=$mcaDetails[$yyyymm]['PGPV']?> - Rollup: <?=$mcaDetails[$yyyymm]['RollUpPV']?></small><br>
              <small style="opacity: 0.7">BV: <?=$mcaDetails[$yyyymm]['BV']?> - GBV: <?=$mcaDetails[$yyyymm]['GBV']?></small><br>
              <small style="opacity: 0.7">Joining: <?=$joinee?> - Team: <?=$team?></small><br>
            </div>
            <a href="#" class="link card-close card-opened-fade-in color-red"
              style="position: absolute; right: 15px; top: 15px"><strong>X</strong>
              <i class="icon f7-icons">xmark</i>
            </a>
          </div>
          <div class="card-content-padding">
              <i class="icons f7-icons">phone</i> <a href="tel:<?=$findmobile['Mobile']?>" class="link external"><?=$findmobile['Mobile']?></a>
              <?php
              foreach($users as $u){
               print_r($u['mcaName']);
               
              }
               ;
              ?>
          </div>
        </div>
      </div>
    
 
 
 <?php
}
?>