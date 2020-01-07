<form method="post" action="/malls/sendsmsdaily" >
<div class="block text-align-left">
			<div class="row padding" style="border-bottom:1px solid black">
				<div class="col"></div>
				<div class="col"></div>
				<div class="col">Select All</div>
				<div class="col"></div>
				<div class="col"></div>
				<div class="col"><input type="submit" value="Send"></div>
				<div class="col"><input type="checkbox" id="selectall"></div>
			</div>
			<div class="row padding" style="border-bottom:1px solid black">
				<div class="col">0</div>
				<div class="col">92143138</div>
				<div class="col">Ruchi Doctor</div>
				<div class="col"></div>
				<div class="col"></div>
				<div class="col"></div>
				<div class="col"><input type="checkbox" value="92143138" class="case" name="mcaNumber[]" ></div>
			</div>
		<?php 
		$i = 1;
		$p1yyyymm = date("Y-m");
		foreach($allusers as $u){?>
			<div class="row padding" style="border-bottom:1px solid black">
				<div class="col"><?=$i?></div>
				<div class="col"><?=$u['mcaNumber']?></div>
				<div class="col"><?=$u['mcaName']?></div>
				<div class="col"><?=$u[$p1yyyymm]['PV']?></div>
				<div class="col"><?=$u['Mobile']?></div>
				<div class="col"><?=$u[$p1yyyymm]['ShoppingDate']?></div>
				<div class="col"><input type="checkbox" value="<?=$u['mcaNumber']?>" class="case" name="mcaNumber[]" <?php if($u['Mobile']==""){echo "disabled";}?>></div>
			</div>
		<?php $i++;
		}?>
</div>
</form>