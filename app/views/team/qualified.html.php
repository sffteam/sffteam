<div class="container" style="text-align:center">
 <h1 class="">Team</h1>
 <?php 
 print_r(count($builders));
 foreach($builders as $b){?>
 <?php print_r($b['mcaName'])?> - 
 <?php print_r($b[$previousmonth]['Legs'])?>-
 <?php print_r($b[$previousmonth]['Percent'])?>
 <?php print_r($b['mcaNumber'])?><br>
 <?php }?>
 
     <div class="d-md-flex flex-md-equal w-100 my-md-3 pl-md-3">
      <div class="bg-dark mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center text-white overflow-hidden">
        <div class="my-3 py-3">
          <h2 class="display-5">Ruchi Nilam Doctor</h2>
          <p class="lead">Global Black Diamond Director</p>
        </div>
        <div class="bg-light shadow-sm mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;">
        <img src="/img/indianeagles.team.logo.png" width="80%">
        </div>
      </div>
      <div class="bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
        <div class="my-3 p-3">
          <h2 class="display-5">Geeta MadanSingh Chauhan</h2>
          <p class="lead">Platinum Director</p>
        </div>
        <div class="bg-dark shadow-sm mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;">
        <img src="/img/indianeagles.team.logo.png" width="80%"></div>
      </div>
    </div>

</div>