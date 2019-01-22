<?php
?>
<div class="container">
<?=$this->form->create()?>
 <label for="mobile" class="col-sm-2 col-form-label">Mobile</label>
 <input class="form-control col-sm-4" type="number" name="mobile" id="mobile" value="" required validate pattern="[0-9]*" data-error-message="Only numbers please!" max="9999999999" min="1111111111"> 
  <label for="message" class="col-sm-2 col-form-label">Message</label>
 <input class="form-control" type="text" name="message" id="message" value="Please complete KYC, Send documents to Sachin Vala on 9,8,2,5,6,0,3,1,1,8." required > 
<br>
 <input type="submit" value="Save" class="btn btn-primary btn-sm" />
</form>
</div>