<div class="container" style="text-align:center">
 <h1 class="">Team</h1>

 <div class="row">
    <div class="col-sm">
    <ul class="list-group">
      <li class="list-group-item"><h4>Title</h4></li>
      <?php foreach($directors as $d){?>
      <li class="list-group-item"><a href="/team/qualified/<?=$d['Legs']?>"><?=$d['Title']?></a></li>
      <?php }?>
    </ul>
    </div>
    <div class="col-sm">
    <ul class="list-group">
      <li class="list-group-item"><h4>Required Legs</h4></li>
      <?php foreach($directors as $d){?>
      <li class="list-group-item"><a href="/team/qualified/<?=$d['Legs']?>"><?=$d['Legs']?></a></li>
      <?php }?>
    </ul>
       
    </div>
  </div>
</div>