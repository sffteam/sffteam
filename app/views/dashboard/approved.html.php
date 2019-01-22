<div class="container-fluid">
  <div class="row">
		<?php echo $this->_render('element', 'nav');?>	
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
      <h3>Approved - <?=$approvedYes?> consultants</h3>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>MCA</th>
              <th>Reason</th>
            </tr>
            <tr>
              <th></th>
              <th>DOB/Gender</th>
              <th colspan="2">Address</th>
              <th>Password</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
          <?php 
          $i = 1;
          if($approvedYes!=0){
           foreach($users as $u){?>
            <tr>
              <td><?=$i?></td>
              <td><?=$u['firstName']?> <?=$u['lastName']?></td>
              <td><?=$u['email']?></td>
              <td><?=$u['mobile']?></td>
              <td id="MCA<?=$i?>"><?=$u['mcaNumber']?></td>
              <td>
               <small>
                 <?=$u['reason']?>
               </small>
              </td>
              
            </tr>
            <tr>
              <td></td>
              <td><?=$u['dateofbirth']?>/<?=$u['gender']?></td>
              <td colspan="2"><?=$u['address']?>, <?=$u['street']?>, <?=$u['city']?>, <?=$u['pin']?>, <?=$u['state']?></td>
              <td><?=$u['mcaPassword']?></td>
              <td></td>
            </tr>          
            <?php 
              $i++;
           }
          }?>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>