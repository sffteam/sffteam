<div class="container-fluid">
  <div class="row">
		<?php echo $this->_render('element', 'nav');?>	
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
      <h3>Invoices </h3>
      <div class="table-responsive">
        <table class="table table-striped table-sm table-bordered">
            <tr>
              <th colspan="2">#</th>
              <th colspan="2">Name</th>
              <th colspan="2">Email</th>
              <th colspan="2">Phone</th>
              <th colspan="2">MCA</th>
              <th colspan="2">Password</th>
            </tr>
            <?php $i = 1;foreach($users as $u){?>
            <tr>
              <td colspan="2"><?=$i?></td>
              <td colspan="2"><a href="/dashboard/invoices/<?=$u['mcaNumber']?>"><?=$u['firstName']?> <?=$u['lastName']?></a></td>
              <td colspan="2"><?=$u['email']?></td>
              <td colspan="2"><?=$u['mobile']?></td>
              <td colspan="2"><?=$u['mcaNumber']?></td>
              <td colspan="2"><?=$u['mcaPassword']?></td>
            </tr>
            <tr>
             <td colspan="12">
               <table class="table table-striped table-sm table-bordered">
                <tr>
                <?php foreach($u['summary'] as $key=>$value){?>
                
                <td <?php if($value['invoices']){echo ' style="background-color:#C1E0BA"';}?>><?=$key?></td>
                <?php }?>
                </tr>
                <tr>
                <?php foreach($u['summary'] as $key=>$value){?>
                 <td>
                 <button type="button" onclick="onclickModal('<?=$key?>','<?=$u["mcaNumber"]?>')" class="btn btn-primary" data-toggle="modal" data-target="#Invoice"><?=$value['shopping']/12?></button>
                 <?php $k = 0; 
                 if($value['invoices']){
                  foreach($value['invoices'] as $i) {?>
                  <input type="hidden" name="gDate-<?=$u["mcaNumber"]?><?=$key?>-<?=$k?>" id="gDate-<?=$u["mcaNumber"]?><?=$key?>-<?=$k?>" value="<?=$i['Date']?>">
                  <input type="hidden" name="gInvoice-<?=$u["mcaNumber"]?><?=$key?>-<?=$k?>" id="gInvoice-<?=$u["mcaNumber"]?><?=$key?>-<?=$k?>" value="<?=$i['Invoice']?>">
                  <input type="hidden" name="gDP-<?=$u["mcaNumber"]?><?=$key?>-<?=$k?>" id="gDP-<?=$u["mcaNumber"]?><?=$key?>-<?=$k?>" value="<?=$i['DP']?>">
                  <input type="hidden" name="gBV-<?=$u["mcaNumber"]?><?=$key?>-<?=$k?>" id="gBV-<?=$u["mcaNumber"]?><?=$key?>-<?=$k?>" value="<?=$i['BV']?>">
                 <?php $k++; }?>
                 
                 </td>
                <?php } ?>
                
                <?php }?>
                </tr>
               </table>
             </td>
            </tr>
            <?php }?>
        </table>
      </div>
    </main>
  </div>
</div>

<div class="modal fade " id="Invoice" tabindex="-1" role="dialog" aria-labelledby="InvoiceModal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="InvoiceModal">Invoice: MCA: <span id="mmcaNumber"></span>, Month: <span id="mMonth"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form>
        <input type="hidden" name="imcaNumber" id="imcaNumber">
        <input type="hidden" name="iyyyymm" id="iyyyymm">
        <div class="row">
         <div class="col form-group">
         DT:<input type="text"  class="form-control" id="Date1" placeholder="2019-12-31">
         </div>
         <div class="col form-group">
         #<input type="text"  class="form-control" id="Invoice1" placeholder="RSY00121">
         </div>
         <div class="col">
          DP: <input type="text"  class="form-control" id="DP1" value="" placeholder="1121">
         </div>
         <div class="col">
          BV: <input type="text"  class="form-control" id="BV1" value="" placeholder="650">
         </div>
        </div>
        <div class="row">
         <div class="col form-group">
         DT:<input type="text"  class="form-control" id="Date2" placeholder="2019-12-31">
         </div>
         <div class="col form-group">
         #<input type="text"  class="form-control" id="Invoice2" placeholder="RSY00122">
         </div>
         <div class="col">
          DP: <input type="text"  class="form-control" id="DP2" value="" placeholder="1121">
         </div>
         <div class="col">
          BV: <input type="text"  class="form-control" id="BV2" value="" placeholder="650">
         </div>
        </div>        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="saveInvoice()">Save changes</button>
      </div>
    </div>
  </div>
</div>


