<div class="container" style="text-align:center">
<?php
$number = rand(1,106);
?><br>
 <a href="/quotes" >
  <img src="img/Poster/Posters_Page_<?=str_pad($number,3,0,STR_PAD_LEFT)?>.jpg" width="90%"  style="border:1px solid black">
 </a>
 <h1 class="">Quote - <?=str_pad($number,3,0,STR_PAD_LEFT)?></h1>
</div>