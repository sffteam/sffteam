<?php 
		$CategoriesArray = array(
		  'FS' => 'Food Supplement',
				'PC' => 'Personal Care',
    'HL' => 'Health',
				'HC' => 'Home Care',
    'LC' => 'Laundry Care',
				'FP' => 'Food Products',
				'SC' => 'Skin Care',
    'BC' => 'Baby Care',
				'UC' => 'Urban Color',
    'AG' => 'Agriculture',
    'AC' => 'Auto Care',
    'MJ' => 'Jewelery',
				'00' => 'Others',
    '60' => 'Extra',
				);

?>
    <footer class="container py-5">
      <div class="row">
        <div class="col-12 col-md">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="d-block mb-2"><circle cx="12" cy="12" r="10"></circle><line x1="14.31" y1="8" x2="20.05" y2="17.94"></line><line x1="9.69" y1="8" x2="21.17" y2="8"></line><line x1="7.38" y1="12" x2="13.12" y2="2.06"></line><line x1="9.69" y1="16" x2="3.95" y2="6.06"></line><line x1="14.31" y1="16" x2="2.83" y2="16"></line><line x1="16.62" y1="12" x2="10.88" y2="21.94"></line></svg>
          <small class="d-block mb-3 text-muted">&copy; 2017-<?php echo date("Y");?></small>
        </div>
        <div class="col-6 col-md">
          <h5>Categories</h5>
          <ul class="list-unstyled text-small">
										<?php foreach($CategoriesArray as $k => $v){?>
            <li><a class="text-muted" href="/category/i/<?=$k?>"><?=$v?></a></li>
										<?php }?>
          </ul>
        </div>
        <div class="col-6 col-md">
          <h5>Learning</h5>
          <ul class="list-unstyled text-small">
            <li><a class="text-muted" href="/Learning/e/Sapne">Products - Sapne</a></li>
            <li><a class="text-muted" href="/Learning/e/Business">Business Plan</a></li>
            <li><a class="text-muted" href="/Learning/e/Arogya">Arogya Booklet Hindi</a></li>
            <li><a class="text-muted" href="/Learning/e/Parivartan">Parivartan Sapno Ko Jeene ki Azadi</a></li>
												<li><a class="text-muted" href="/Learning/e/Raftaar">Raftaar</a></li>
												<li><a class="text-muted" href="/Learning/e/Shuruaat">Shuruaat for LMS</a></li>
          </ul>
        </div>
        <div class="col-6 col-md">
          <h5>Resources</h5>
          <ul class="list-unstyled text-small">
            <li><a class="text-muted" href="#">Business</a></li>
            <li><a class="text-muted" href="#">Education</a></li>
            <li><a class="text-muted" href="#">Training</a></li>
            <li><a class="text-muted" href="#">Events</a></li>
          </ul>
        </div>
        <div class="col-6 col-md">
          <h5>About</h5>
          <ul class="list-unstyled text-small">
            <li><a class="text-muted" href="#">Team</a></li>
            <li><a class="text-muted" href="#">Locations</a></li>
            <li><a class="text-muted" href="#">Privacy</a></li>
            <li><a class="text-muted" href="#">Terms</a></li>
          </ul>
        </div>
      </div>
    </footer>
