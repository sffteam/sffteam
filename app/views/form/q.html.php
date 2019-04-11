<div style="padding:10px;margin:0px">
<?php if($next==1){?>
<h1>Let's promote your business</h1>
<div style="margin-bottom:10px">
</div>
<img src="/img/social.png" width="50%"><br>
<div style="margin-bottom:10px">
<h3>We're here to help, learn, promote, train on social media skills.</h3>
</div>
<a href="/form/q/<?=$next?>/<?=$user_id?>" class="btn btn-primary" role="button">Let's start</a>

<?php }else{?>
<h1>Some information about you</h1>
<div class="row container">
<input type="hidden"  id="user_id" name="user_id" value="<?=$user_id?>">

</div>
    <div class="col-12">
    <div class="cardImage<?=$q?>"></div>

<?php switch ($q){ ?>
<?php  case "1": ?>
    <div class="col-12">
      <label for="Question"><h5>What is your name?</h5></label>
      <div class="input-group">
        <input type="text" class="form-control" id="Name" name="Name" placeholder="Name" required>
        <div class="input-group-append">
          <span class="input-group-text"><a href="#" onclick="saveAnswer(<?=$q?>)"><i class="fa fa-play" style="font-size:20px;color:#2196F3"></i></a></span>
        </div>
      </div>
    </div>
<?php break;?>
<?php case "2":?>
    <div class="col-12">
      <label for="Question"><h5><?=$user['name']?>, your email?</h5></label>
      <div class="input-group">
        <input type="text" class="form-control" id="Email" name="Email" placeholder="email@company.com" required>
        <div class="input-group-append">
          <span class="input-group-text"><a href="#" onclick="saveAnswer(<?=$q?>)"><i class="fa fa-play" style="font-size:20px;color:#2196F3"></i></a></span>
        </div>
      </div>
    </div>
<?php break;?>
<?php case "3":?>
    <div class="col-12">
      <label for="Question"><h5><?=$user['name']?>, your mobile number?</h5></label>
      <div class="input-group">
        <input type="text" class="form-control" id="Mobile" name="Mobile" placeholder="9998887654" required>
        <div class="input-group-append">
          <span class="input-group-text"><a href="#" onclick="saveAnswer(<?=$q?>)"><i class="fa fa-play" style="font-size:20px;color:#2196F3"></i></a></span>
        </div>
      </div>
    </div>
<?php break;?>
<?php case "4":?>
    <div class="col-12">
      <label for="Question"><h5><?=$user['name']?>, your date of birth?</h5></label>
      <div class="input-group">
        <input type="text" class="form-control" id="dob" name="dob" placeholder="30/12/1999" required data-provide="datepicker" class="datepicker" data-date-format="dd/mm/yyyy">
        <div class="input-group-append">
          <span class="input-group-text"><a href="#" onclick="saveAnswer(<?=$q?>)"><i class="fa fa-play" style="font-size:20px;color:#2196F3"></i></a></span>
        </div>
      </div>
    </div>
<?php break;?>
<?php case "5":?>
    <div class="col-12">
      <label for="Question"><h5><?=$user['name']?>, your gender?</h5></label>
      <div class="input-group">
       <select name="Gender" id="Gender" class="form-control">
       <option value="male">Male</option>
       <option value="female">Female</option>
       </select>
        <div class="input-group-append">
          <span class="input-group-text"><a href="#" onclick="saveAnswer(<?=$q?>)"><i class="fa fa-play" style="font-size:20px;color:#2196F3"></i></a></span>
        </div>
      </div>
    </div>
<?php break;?>
<?php } //switch?>
</div>
<?php }?>
<p><br><small>
To check your social media promotion skills copy and paste this URL on to all your social media accounts.<br>Best promoter wins a prize!<br></small>
<code id="copy">https://sff.team/form/r/<?=$user_id?></code> <i class="fa fa-copy" onclick="copyFunction()" style="cursor:pointer;font-size:20px;color:#2196F3"></i></p>
</div>
<script>
</script>

