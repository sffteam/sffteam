<p>&nbsp;</p>
<?php 	if($dates){?>
	Select Date:
	<?=$this->form->create('',array('url'=>'/malls/seminar', 'enctype'=>"multipart/form-data", 'class'=>"list")); ?>
		<select name="date" class="form-control">
			<?php foreach($dates as $d){?>
				<option value="<?=$d['Date']?>"><?=$d['Date']?> - <?=$d['City']?></option>
			<?php }?>
		</select>
		<input type="submit" value="Select Date" class="form-control">
		</form>
<?php	}else{ ?>

<div class="block" style="text-align:center">
	<h1>Date: <?=$seminar['Date']?></h1>
	<h1>Time: <?=$seminar['Time']?></h1>
	<h1>City: <?=$seminar['City']?></h1>
	
	<?=$this->form->create('',array('url'=>'/malls/seminar', 'enctype'=>"multipart/form-data", 'class'=>"list")); ?>
	<input type="hidden" name="date" id="date" value="<?=$seminar['Date']?>">
	<input type="hidden" name="Time" id="Time" value="<?=$seminar['Time']?>">
	<input type="hidden" name="City" id="City" value="<?=$seminar['City']?>">
	<input type="hidden" name="Address" id="Address" value="<?=$seminar['Address']?>"><hr>
	Name:
	<input type="text" name="Name" id="Name" placeholder="Your Name" class="form-control"><br>
 Email:
	<input type="text" name="Email" id="Email" placeholder="Your Name" class="form-control"><br>
	Mobile:
	<input type="text" name="Mobile" id="Mobile" placeholder="Your Name" class="form-control"><br>
	<input type="submit" value="I'm Attending" class="form-control">
	</form>
	</div>
	<?php	} 
	if($registered=="Yes"){	?>
	<h1>Date: <?=$seminar['Date']?></h1>
	<h1>Time: <?=$seminar['Time']?></h1>
	<h1>Time: <?=$seminar['Address']?></h1>
	<h1>City: <?=$seminar['City']?></h1>
	<?php }?>
	