
  <!-- Fixed navbar goes ALWAYS FIRST -->
  <div class="navbar sz1 text-align-center " style="background-color:#ff0000;padding-top:5px;">
<div class="navbar-bg"></div>
      <div class="navbar-inner sliding">
        <div class="left">
          <a class="link panel-open Bebas"  data-panel="left">
            <i class="icons f7-icons">menu</i>Menu
          </a>
        </div>
        <div class="title">WeCapacitate</div>
        <div class="right">
        </div>
      </div>
      
      
      
  </div>
  <!-- Fixed toolbar goes ALWAYS AFTER navbar -->
  <div class="toolbar toolbar-bottom">
    <div class="toolbar-inner">
          <a href="/mca/" class="external link">Home</a>
          <a href="/mca/reports/" class="external link">Reports</a>
          <a href="/mca/pdfs/" class="external link">PDFs</a>
          <a href="/mca/products/categories/" class="external link">Products</a>
          <a href="/mca/videos/" class="external link">Videos</a>
        </div>
  </div>

<?php 
  switch ($url){
   case 'videos':
   ?>
      <div class="panel panel-left panel-reveal panel-resizable panel-init">
           <div class="navbar ">
            <div class="navbar-inner bg-color-gray">
             <div class="Bebas ">Videos</div>
             <div class="Bebas panel-close text-align-right">x</div>
            </div>
          </div>
          <div class=" ">
            	<div class="list links-list ">
														<ul class="Rale ">
															<li class=""><a href="/mca/videos/" class="external link">Network Marketing</a></li>
               <li class=""><a href="/mca/discovery/" class="external link">Discovery Previews</a></li>
               <li class=""><a href="/mca/business/" class="external link">Business Plan</a></li>
               <li class=""><a href="/mca/productvideo/" class="external link">Product to Prosperity</a></li>
               <li class=""><a href="/mca/objection/" class="external link">Objection Handling</a></li>
															<li class=""><a href="/mca/knowledge/" class="external link">Knowledge</a></li>
														</ul>
													</div>
          </div>
    </div>
    <?php
   case 'reports':
   ?>
      <div class="panel panel-left panel-reveal panel-resizable panel-init">
           <div class="navbar ">
            <div class="navbar-inner bg-color-gray">
             <div class="Bebas ">Reports</div>
             <div class="Bebas panel-close text-align-right">x</div>
            </div>
          </div>
          <div class=" ">
            	<div class="list links-list ">
														<ul class="Rale ">
															<li class=""><a href="/mca/searchmca/" class="external link">This Month</a></li>
														</ul>
													</div>
          </div>
    </div>
   <?php
   case 'products':
   ?>
      <div class="panel panel-left panel-reveal panel-resizable panel-init">
           <div class="navbar ">
            <div class="navbar-inner bg-color-gray">
             <div class="Bebas ">Products</div>
             <div class="Bebas panel-close text-align-right">x</div>
            </div>
          </div>
          <div class=" page-content">
            	<div class="list links-list ">
														<ul class="Rale ">
															<li class=""><a href="/mca/products/categories/" class="external link">Categories</a></li>
               <?php
               foreach($Categories as $key=>$val){
                ?>
                <li class="sz12 "><a href="/mca/products/<?=$key?>/" class="external link"><?=$val?></a></li>
                <?php
               }
               ?>
														</ul>
													</div>
          </div>
    </div>   
   <?php
   case 'pdfs':
   ?>
   
      <div class="panel panel-left panel-reveal panel-resizable panel-init">
           <div class="navbar ">
            <div class="navbar-inner bg-color-gray">
             <div class="Bebas ">PDFs</div>
             <div class="Bebas panel-close text-align-right">x</div>
            </div>
          </div>
          <div class=" ">
            	<div class="list links-list ">
														<ul class="Rale ">
															<li class=""><a href="/mca/pdfs/discoverypreview/" class="external link">Discovery Preview</a></li>
               <li class=""><a href="/mca/pdfs/shuruat/" class="external link">Shuruat</a></li>
               <li class=""><a href="/mca/pdfs/raftar/" class="external link">Raftar</a></li>
               <li class=""><a href="/mca/pdfs/parivartan/" class="external link">Parivartan</a></li>
														</ul>
													</div>
          </div>
    </div>
   <?php
   case 'index':
   ?>

      <div class="panel panel-left panel-reveal panel-resizable panel-init">
           <div class="navbar ">
            <div class="navbar-inner bg-color-gray">
             <div class="Bebas ">Home</div>
             <div class="Bebas panel-close text-align-right">x</div>
            </div>
          </div>
          <div class=" ">
            	<div class="list links-list ">
														<ul class="Rale ">
															<li class=""><a href="/mca/searchmca/" class="external link">This Month</a></li>
														</ul>
													</div>
          </div>
    </div>   
   <?php
   default:
  }
  ?>
