<div class="block ">
	<div class="row">
		<div class="col">PDF:</div>
		<div class="col"><?=$pdf['Name']?></div>
	</div>
	<div class="row">
		<div class="col">Language:</div>
		<div class="col"><?=$pdf['Language']?></div>
	</div>
	<div class="row">
		<div class="col">Type:</div>
		<div class="col"><?=$pdf['Type']?></div>
	</div>
	<div class="row">
		<div class="col">
			<a href="https://sff.team/img/documents/<?=$pdf['PDF']?>">Download</a>
		</div>
	</div>
		<div class="row">
		<div class="col">
			 <object style="width:100%" height="800px" data="https://sff.team/img/documents/<?=$pdf['PDF']?>" type="application/pdf">
        <embed src="https://sff.team/img/documents/<?=$pdf['PDF']?>" type="application/pdf" />
    </object>
		</div>
	</div>
</div>