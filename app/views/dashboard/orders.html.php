<div class="container-fluid">
  <div class="row">
		<?php echo $this->_render('element', 'nav');?>	
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
      <h3>Orders </h3>
      <div class="table-responsive">
        <table class="table table-striped table-sm table-bordered">
          <thead>
            <tr>
              <th colspan="2">#</th>
              <th colspan="2">Name</th>
              <th colspan="2">Email</th>
              <th colspan="2">Phone</th>
              <th colspan="2">MCA</th>
              <th colspan="2">Password</th>
            </tr>
            </thead>
            
            <?php $i = 1;foreach($users as $u){?>
            <tr>
              <td colspan="2"><?=$i?></td>
              <td colspan="2"><a href="/dashboard/orders/<?=$u['mcaNumber']?>"><?=$u['firstName']?> <?=$u['lastName']?></a></td>
              <td colspan="2"><?=$u['email']?></td>
              <td colspan="2"><?=$u['mobile']?></td>
              <td colspan="2"><?=$u['mcaNumber']?></td>
              <td colspan="2"><?=$u['mcaPassword']?></td>
            </tr>
            <tr>
             <td colspan="12">
               <table class="table table-striped table-sm table-bordered">
               <tr>
                <?php 
                if($u['summary']){
                foreach($u['summary'] as $key=>$value){?>
                 <td <?php if($value['totalValue']>0){echo ' style="background-color:#C1E0BA"';}?>><?=$key?><br>
                 <?php if($value['delivery']!="Delivered"){?>
                 <?php if($value['totalValue']>0){?>
                 <a href="/dashboard/delivered/<?=$u['mcaNumber']?>/<?=$key?>">Del</del>
                 <?php }?>
                 <?php }?>
                 </td>
                <?php }
                }?>
               </tr>
               <tr>
                <?php 
                if($u['summary']){
                foreach($u['summary'] as $key=>$value){?>
                 <td>
                 <input type="hidden" name="OrderFile<?=$key?><?=$u["mcaNumber"]?>" id="OrderFile<?=$key?><?=$u["mcaNumber"]?>" value="<?=$u['mcaNumber'].'-'.$key."-Order".".pdf"?>">
                 <button type="button" onclick="onclickOrder('<?=$key?>','<?=$u["mcaNumber"]?>','<?=$value["totalValue"]?>')" class="btn btn-primary" data-toggle="modal" data-target="#Order"><?=$value['totalValue']?></button>
                 </td>
                <?php }?>
               </tr>  
               <?php }?>
               </table>
             </td>
            </tr>
            <?php $i++; }?>
        </table>
      </div>
    </main>
  </div>
</div>
<div class="modal fade " id="Order" tabindex="-1" role="dialog" aria-labelledby="OrderModal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="InvoiceModal">Order: MCA: <span id="mmcaNumber"></span>, Month: <span id="mMonth"></span>, Order: <span id="mOrder"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form>
        <input type="hidden" name="imcaNumber" id="imcaNumber">
        <input type="hidden" name="iyyyymm" id="iyyyymm">
        <input type="hidden" name="iorder" id="iorder">
        <div class="row" id="OrderList">
        </div>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="PrintOrder()">Print Order</button>
      </div>
    </div>
  </div>
</div>


<!--modal-->
<script>

</script>
