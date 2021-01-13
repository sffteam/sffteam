 
 <div class="row ">
 <div class="col-100">
  <img src="/img/TUY-inAction.jpg" width="100vw">
 </div>
 <div class="col-100">
        <div class="list inline-labels no-hairlines-md">
        <ul>
          <li class="item-content item-input">
            <div class="item-media">
              <i class="icon demo-list-icon"></i>
            </div>
            <div class="item-inner">
              <div class="item-title item-label">Amount</div>
              <div class="item-input-wrap">
                <input type="text" placeholder="4000"  id="Amount" name="Amount"/>
                <span class="input-clear-button"></span>
              </div>
            </div>
          </li>

      </div>
</div>
    <!-- Searchbar with auto init -->
    
  <form class="searchbar">
    <div class="searchbar-inner">
      <div class="searchbar-input-wrap">
        <input type="search" placeholder="MCA Name or Number" onkeyup="getUserSearch(this.value)">
        <i class="searchbar-icon"></i>
        <span class="input-clear-button"></span>
      </div>
      <span class="searchbar-disable-button">Cancel</span>
    </div>
  </form>
   
  <div class="searchbar-backdrop"></div>
    <div class="block searchbar-hide-on-search">
      <p>Search for MCA Number or Name</p>
    </div>
      <div class="list searchbar-found">
      <ul id="searchUsers">
      </ul>
    </div>
     <div class="block searchbar-not-found">
      <div class="block-inner">Nothing found</div>
    </div>
 
 
 
