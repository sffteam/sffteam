routes = [
  {
    path: '/',
    url: './index.html',
  },
  {
    path: '/about/',
    url: './pages/about.html',
  },
  {
    path: '/form/',
    url: './pages/form.html',
  },
  // Page Loaders & Router
  {
    path: '/approve/',
    templateUrl: './pages/approve.html',
    on: {
     pageMounted: function(event,page){
      var submitURL = server+'admin/approve';
        app.request.post(submitURL, '', function (gotData) {
       	var data = JSON.parse( gotData );
        if(data['users'].length!=0){
         var html =        '<div class="block-title">New Registration</div>';
         html = html + ' <div class="list accordion-list">';
         html = html + '  <ul>';
         i = 1;
         for(key in data['users']){
          html = html + '       <li class="accordion-item"><a href="#" class="item-content item-link">';
          html = html + '           <div class="item-inner">';
          html = html + '             <div class="item-title">'+i+'. <b>'+data['users'][key]['firstName']+' '+data['users'][key]['lastName']+'</b> - '+data['users'][key]['mcaNumber']+'   +91'+data['users'][key]['mobile']+'</div>';
          html = html + '           </div></a>';
          html = html + '         <div class="accordion-item-content">';
          html = html + '           <div class="block">';
          html = html + '     <div class="row">';
          html = html + '       <div class="col-50 tablet-25">Name</div>';
          html = html + '       <div class="col-50 tablet-25"><b>'+data['users'][key]['firstName']+' '+data['users'][key]['lastName']+'</b></div>';
          html = html + '       <div class="col-50 tablet-25">Mobile</div>';
          html = html + '       <div class="col-50 tablet-25">+91'+data['users'][key]['mobile']+'</div>';
          html = html + '       <div class="col-50 tablet-25">Email</div>';
          html = html + '       <div class="col-50 tablet-25">+91'+data['users'][key]['email']+'</div>';
          html = html + '       <div class="col-50 tablet-25">MCA Number</div>';
          html = html + '       <div class="col-50 tablet-25">'+data['users'][key]['mcaNumber']+' / '+data['users'][key]['mcaPassword']+'</div>';
          html = html + '       <div class="col-50 tablet-25">PIN</div>';
          html = html + '       <div class="col-50 tablet-25">'+data['users'][key]['signpin']+'</div>';
          html = html + '       <div class="col-50 tablet-25">Date of Birth</div>';
          html = html + '       <div class="col-50 tablet-25">'+data['users'][key]['dateofbirth']+'</div>';
          html = html + '       <div class="col-50 tablet-25">Gender</div>';
          html = html + '       <div class="col-50 tablet-25">'+data['users'][key]['gender']+'</div>';
          html = html + '       <div class="col-50 tablet-25">Address</div>';
          html = html + '       <div class="col-50 tablet-25">'+data['users'][key]['address']+', '+data['users'][key]['street']+', '+data['users'][key]['city']+','+data['users'][key]['pin']+' '+data['users'][key]['state']+'</div>';
          html = html + '       <div class="col-50 tablet-25">Select DP</div>';
          html = html + '       <div class="col-50 tablet-25">';
          html = html + '       <div class="list no-hairlines-md">';
          html = html + '         <ul>';
          html = html + '           <li>';
          html = html + '             <div class="item-content item-input">';
          html = html + '               <div class="item-inner">';
          html = html + '                 <div class="item-input-wrap">';
          html = html + '                   <input type="text" placeholder="DP" readonly="readonly" id="DPAddress'+data['users'][key]['mcaNumber']+'" class="DPAddress"/>';
          html = html + '                 </div>';
          html = html + '               </div>';
          html = html + '             </div>';
          html = html + '           </li>';
          html = html + '         </ul>';
          html = html + '       </div>';
          html = html + '       </div>';
          html = html + '     </div>';
          html = html + '       <div class="col-50 tablet-25">Select Reason</div>';
          html = html + '       <div class="col-50 tablet-25">';
          html = html + '       <div class="list no-hairlines-md">';
          html = html + '         <ul>';
          html = html + '           <li>';
          html = html + '             <div class="item-content item-input">';
          html = html + '               <div class="item-inner">';
          html = html + '                 <div class="item-input-wrap">';
          html = html + '                   <input type="text" placeholder="Reason" readonly="readonly" id="Reasons'+data['users'][key]['mcaNumber']+'" class="Reasons"/>';
          html = html + '                 </div>';
          html = html + '               </div>';
          html = html + '             </div>';
          html = html + '           </li>';
          html = html + '         </ul>';
          html = html + '       </div>';
          html = html + '       </div>';
          html = html + '     </div>';
          html = html + '     <input type="hidden" name="mcaNumber'+data['users'][key]['mcaNumber']+'" id="mcaNumber'+data['users'][key]['mcaNumber']+'" value="'+ data['users'][key]['mcaNumber']+'"+>';
          html = html + '     <div class="block">';
          html = html + '     <a href="#" class="button button-fill button-round" onclick="approveDP(mcaNumber'+data['users'][key]['mcaNumber']+')">Submit</a>';
          html = html + '           </div>';
          html = html + '           </div>';
          html = html + '         </div>';
          html = html + '       </li>';
          i++;
         }
         html = html + '  </ul>';
         html = html + ' </div>';

         
         $$("#DivApprove").html(html);        
        
          var dps = [];
          for(key in data['points']){
            dps.push(data['points'][key]['name']);
          }
          var pickerDP = app.picker.create({
           inputEl: '.DPAddress',
           cols: [
             {
              textAlign: 'center',
              values: dps
             }
            ]
          });
        
          var reasons = [];
          for(key in data['reasons']){
            reasons.push(data['reasons'][key]['reason']);
          }
          var pickerDP = app.picker.create({
           inputEl: '.Reasons',
           cols: [
             {
              textAlign: 'center',
              values: reasons
             }
            ]
          });
        }else{
         html = '<div class="block">No Data found</div>';
         $$("#DivApprove").html(html);        
        }
        
        
        },
        function () 	{
         toastNoInternet.open();
        });	  
     }
    }
  },
  {
   path: '/approved/',
    templateUrl: './pages/approved.html',
    on: {
      pageMounted: function(event,page){
       var submitURL = server+'admin/approved';
        app.request.post(submitURL, '', function (gotData) {
       	var data = JSON.parse( gotData );
        if(data['users'].length!=0){
         var html =        '<div class="block-title">Approved </div>';
         html = html + ' <div class="list accordion-list">';
         html = html + '  <ul>';
         i = 1;
         for(key in data['users']){
          html = html + '       <li class="accordion-item"><a href="#" class="item-content item-link">';
          html = html + '           <div class="item-inner">';
          html = html + '             <div class="item-title">'+i+'. <b>'+data['users'][key]['firstName']+' '+data['users'][key]['lastName']+'</b> - '+data['users'][key]['mcaNumber']+'   +91'+data['users'][key]['mobile']+'</div>';
          html = html + '           </div></a>';
          html = html + '         <div class="accordion-item-content">';
          html = html + '           <div class="block">';
          html = html + '     <div class="row">';
          html = html + '       <div class="col-50 tablet-25">Name</div>';
          html = html + '       <div class="col-50 tablet-25"><b>'+data['users'][key]['firstName']+' '+data['users'][key]['lastName']+'</b></div>';
          html = html + '       <div class="col-50 tablet-25">Mobile</div>';
          html = html + '       <div class="col-50 tablet-25">+91'+data['users'][key]['mobile']+'</div>';
          html = html + '       <div class="col-50 tablet-25">Email</div>';
          html = html + '       <div class="col-50 tablet-25">'+data['users'][key]['email']+'</div>';
          html = html + '       <div class="col-50 tablet-25">MCA Number</div>';
          html = html + '       <div class="col-50 tablet-25">'+data['users'][key]['mcaNumber']+' / '+data['users'][key]['mcaPassword']+'</div>';
          html = html + '       <div class="col-50 tablet-25">PIN</div>';
          html = html + '       <div class="col-50 tablet-25">'+data['users'][key]['signpin']+'</div>';
          html = html + '       <div class="col-50 tablet-25">Date of Birth</div>';
          html = html + '       <div class="col-50 tablet-25">'+data['users'][key]['dateofbirth']+'</div>';
          html = html + '       <div class="col-50 tablet-25">Gender</div>';
          html = html + '       <div class="col-50 tablet-25">'+data['users'][key]['gender']+'</div>';
          html = html + '       <div class="col-50 tablet-25">Address</div>';
          html = html + '       <div class="col-50 tablet-25">'+data['users'][key]['address']+', '+data['users'][key]['street']+', '+data['users'][key]['city']+','+data['users'][key]['pin']+' '+data['users'][key]['state']+'</div>';
          html = html + '       <div class="col-50 tablet-25">Select DP</div>';
          html = html + '       <div class="col-50 tablet-25">'+data['users'][key]['point']['name'];
          html = html + '       </div>';
          html = html + '       <div class="col-50 tablet-25">Select Reason</div>';
          html = html + '       <div class="col-50 tablet-25">'+data['users'][key]['reason'];
          html = html + '       </div>';
          html = html + '           </div>';
          html = html + '         </div>';
          html = html + '       </li>';
          i++;
         }
         html = html + '  </ul>';
         html = html + ' </div>';

         
         $$("#DivApproved").html(html);        
        
        }else{
         html = '<div class="block">No Data found</div>';
         $$("#DivApproved").html(html);        
        }
   
        },
        function () 	{
         toastNoInternet.open();
        });	  
      }
     }
  },
  {
    path: '/search/',
    templateUrl: './pages/search.html',
    on: {
     pageMounted: function(event,page){
      var submitURL = server+'admin/search';
        app.request.post(submitURL, '', function (gotData) {
       	var data = JSON.parse( gotData );
        if(data['users'].length!=0){
         console.log(data['users']);
         html = "";
         for(key in data['users']){
          html = html + '<li class="item-content">';
          html = html + '<div class="item-inner">';
          html = html + '<div class="item-title"><a href="/user/'+data['users'][key]['mcaNumber']+'/">'+data['users'][key]['mcaNumber']+' ' +data['users'][key]['mcaName']+' '+data['users'][key]['mobile']+'</a></div>';
          html = html + '</div>';
          html = html + '</li>';
          $$("#DivSearch").html(html);        
         }
        }else{
         html = '<div class="block">No Data found</div>';
         $$("#DivSearch").html(html);        
        }
   
        },
        function () 	{
         toastNoInternet.open();
        });	  
        
        var searchbar = app.searchbar.create({
           el: '.searchbar',
           searchContainer: '.list',
           searchIn: '.item-title',
           on: {
             search(sb, query, previousQuery) {

             }
           }
         });

      }
     }
  },
  {
    path: '/user/:mcaNumber/',
    templateUrl: './pages/user.html',
    on: {
     pageMounted: function(event,page){
      var submitURL = server+'admin/user/'+page.route.params.mcaNumber;
        app.request.post(submitURL, '', function (gotData) {
       	var data = JSON.parse( gotData );
        if(data['user'].length!=0){
         console.log(data['user']);
         
         
             var months = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
             var date = new Date();
             var month = date.getFullYear()+"-"+months[date.getMonth()] ;
             
             
             
             
                       
var loopMonths = [];
         for (i=0;i<12;i++){
            if (date.getMonth() == 11) {
               var current = new Date(date.getFullYear() + i, date.getMonth() , 1);
               var endmonth = formatYYYYMMDD(current);
             } else {
               var current = new Date(date.getFullYear(), date.getMonth() + i , 1);
               var endmonth = formatYYYYMMDD(current);
             }
         var CDate = new Date(endmonth);
         loopMonths.push(formatYYYYMM(CDate));
         }
         console.log(loopMonths);
         
         
         $$("#UserName").html(data['user']['firstName']+' '+data['user']['lastName'])
         
         html = "";
         
         
          html = html + '     <div class="row">';
          html = html + '       <div class="col-50 tablet-25">Name</div>';
          html = html + '       <div class="col-50 tablet-25"><b>'+data['user']['firstName']+' '+data['user']['lastName']+'</b></div>';
          html = html + '       <div class="col-50 tablet-25">Mobile</div>';
          html = html + '       <div class="col-50 tablet-25">+91'+data['user']['mobile']+'</div>';
          html = html + '       <div class="col-50 tablet-25">email</div>';
          html = html + '       <div class="col-50 tablet-25">'+data['user']['email']+'</div>';
          html = html + '       <div class="col-50 tablet-25">MCA Number</div>';
          html = html + '       <div class="col-50 tablet-25">'+data['user']['mcaNumber']+' / '+data['user']['mcaPassword']+'</div>';
          html = html + '       <div class="col-50 tablet-25">PIN</div>';
          html = html + '       <div class="col-50 tablet-25">'+data['user']['signpin']+'</div>';
          html = html + '       <div class="col-50 tablet-25">Date of Birth</div>';
          html = html + '       <div class="col-50 tablet-25">'+data['user']['dateofbirth']+'</div>';
          html = html + '       <div class="col-50 tablet-25">Gender</div>';
          html = html + '       <div class="col-50 tablet-25">'+data['user']['gender']+'</div>';
          html = html + '       <div class="col-50 tablet-25">Address</div>';
          html = html + '       <div class="col-50 tablet-25">'+data['user']['address']+', '+data['user']['street']+', '+data['user']['city']+','+data['user']['pin']+' '+data['user']['state']+'</div>';
          html = html + '       <div class="col-50 tablet-25">Select DP</div>';
          html = html + '       <div class="col-50 tablet-25">'+data['user']['point']['name']+'</div>';
          html = html + '       <div class="col-50 tablet-25">Select Reason</div>';
          html = html + '       <div class="col-50 tablet-25">'+data['user']['reason'] + '</div>';
          html = html + '       <div class="col-100"><hr></div>';
          if(data['user']['payment']){
           html = html + '       <div class="col-100" style="background-color:#ddd;padding:10px;maring:0px"><b>Payment</b></div>';  
           for(key in data['user']['payment']){
            html = html + '       <div class="col-50 tablet-25">MCA Number</div>';
            html = html + '       <div class="col-50 tablet-25">'+data['user']['payment'][key]['mcaNumber'] + '</div>';
            html = html + '       <div class="col-50 tablet-25">Payment</div>';
            html = html + '       <div class="col-50 tablet-25">'+data['user']['payment'][key]['shopping'] + '</div>';
            html = html + '       <div class="col-50 tablet-25">Date</div>';
            html = html + '       <div class="col-50 tablet-25">'+data['user']['payment'][key]['datetime'] + '</div>';
            html = html + '       <div class="col-50 tablet-25">Approved</div>';
            html = html + '       <div class="col-50 tablet-25">'+data['user']['payment'][key]['approved'] + '</div>';
            html = html + '       <div class="col-100"><hr></div>';  
           }
          }
          if(data['user']['payuMoney']){
            html = html + '       <div class="col-100" style="background-color:#ddd;padding:10px;maring:0px"><b>PayUMoney</b></div>';  
           for(key in data['user']['payuMoney']){
            html = html + '       <div class="col-50 tablet-25">MCA Number</div>';
            html = html + '       <div class="col-50 tablet-25">'+data['user']['mcaNumber'] + '</div>';
            html = html + '       <div class="col-50 tablet-25">Payment</div>';
            html = html + '       <div class="col-50 tablet-25">'+data['user']['payuMoney'][key]['amount'] + '</div>';
            html = html + '       <div class="col-50 tablet-25">Date</div>';
            html = html + '       <div class="col-50 tablet-25">'+data['user']['payuMoney'][key]['date'] + '</div>';
            html = html + '       <div class="col-50 tablet-25">TXID</div>';
            html = html + '       <div class="col-50 tablet-25">'+data['user']['payuMoney'][key]['txnid'] + '</div>';
            html = html + '       <div class="col-50 tablet-25">Status</div>';
            html = html + '       <div class="col-50 tablet-25">'+data['user']['payuMoney'][key]['status'] + '</div>';
            html = html + '       <div class="col-50 tablet-25">MIH PayID</div>';
            html = html + '       <div class="col-50 tablet-25">'+data['user']['payuMoney'][key]['mihpayid'] + '</div>';
            html = html + '       <div class="col-100"><hr></div>';  
           }
          }
          if(data['user']['summary']){
            
            for(key in data['user']['summary']){
             html = html + '       <div class="col-100" style="background-color:#ddd;padding:10px;maring:0px"><b>Monthly Shopping / Invoice: '+key+'</b></div>';  
             html = html + '       <div class="col-50 tablet-25">MCA Number</div>';
             html = html + '       <div class="col-50 tablet-25">'+data['user']['mcaNumber'] + '</div>';
             html = html + '       <div class="col-50 tablet-25">Month</div>';
             html = html + '       <div class="col-50 tablet-25"><b>'+key+ '</b></div>';
             html = html + '       <div class="col-50 tablet-25">DP Invoice</div>';
             html = html + '       <div class="col-50 tablet-25"><b>'+data['user']['summary'][key]['shopping']/12+ '</b></div>';
             html = html + '       <div class="col-50 tablet-25">Monthly Order</div>';
             html = html + '       <div class="col-50 tablet-25"><b>'+data['user']['summary'][key]['monthly']+ '</b></div>';
             html = html + '       <div class="col-50 tablet-25">Shopping</div>';
             html = html + '       <div class="col-50 tablet-25"><b>'+data['user']['summary'][key]['totalValue']+ '</b></div>';
             html = html + '       <div class="col-50 tablet-25">Pending</div>';
             html = html + '       <div class="col-50 tablet-25"><b>'+data['user']['summary'][key]['pending']+ '</b></div>';
             if(data['user']['summary'][key]['dp']){
              html = html + '       <div class="col-100" style="border:1px dotted gray">';
              html = html + '     <div class="row" style="padding:10px">';
              html = html + '       <div class="col-50 tablet-25">Projected</div>';
              html = html + '       <div class="col-50 tablet-25"><b>'+data['user']['summary'][key]['shopping']/12+ '</b></div>';
              html = html + '       <div class="col-50 tablet-25">DP</div>';
              html = html + '       <div class="col-50 tablet-25"><b>'+data['user']['summary'][key]['dp']+ '</b></div>';
              html = html + '       <div class="col-50 tablet-25">PBV</div>';
              html = html + '       <div class="col-50 tablet-25"><b>'+data['user']['summary'][key]['pbv']+ '</b></div>';
              html = html + '       <div class="col-50 tablet-25">GBV</div>';
              html = html + '       <div class="col-50 tablet-25"><b>'+data['user']['summary'][key]['gbv']+ '</b></div>';
              html = html + '     </div>';
              html = html + '       </div>';  
             }
             if(data['user']['summary'][key]['invoices']){
              html = html + '       <div class="col-100" style="border:1px dotted gray">';
              html = html + '     <div class="row" style="padding:10px">';
              for(ki in data['user']['summary'][key]['invoices']){
              html = html + '       <div class="col-50 tablet-25">DP</div>';
              html = html + '       <div class="col-50 tablet-25"><b>'+data['user']['summary'][key]['invoices'][ki]['DP']+ '</b></div>';
              html = html + '       <div class="col-50 tablet-25">BV</div>';
              html = html + '       <div class="col-50 tablet-25"><b>'+data['user']['summary'][key]['invoices'][ki]['BV']+ '</b></div>';
              html = html + '       <div class="col-50 tablet-25">Date</div>';
              html = html + '       <div class="col-50 tablet-25"><b>'+data['user']['summary'][key]['invoices'][ki]['Date']+ '</b></div>';
              html = html + '       <div class="col-50 tablet-25">Invoice</div>';
              html = html + '       <div class="col-50 tablet-25"><b>'+data['user']['summary'][key]['invoices'][ki]['Invoice']+ '</b></div>';
              }
              html = html + '     </div>';
              html = html + '       </div>';  
             }

             html = html + '       <div class="col-100"><hr size="1"></div>';  
             
            }
            
             for(mmm in loopMonths){

              if(data['user'][loopMonths[mmm]]){
               html = html + '       <div class="col-100" style="background-color:#ddd;padding:10px;maring:0px"><b>Product Delivery: '+loopMonths[mmm]+'</b></div>';  
               for (key in data['user'][loopMonths[mmm]]){
//                html = html + '       <div class="row">';
                 html = html + '       <div class="col-50 tablet-25">#</div>';
                 html = html + '       <div class="col-50 tablet-25">'+key+ '</div>';
                 html = html + '       <div class="col-50 tablet-25">Category</div>';
                 html = html + '       <div class="col-50 tablet-25">'+data['user'][loopMonths[mmm]][key]['category']+ '</div>';
                 html = html + '       <div class="col-50 tablet-25">Code</div>';
                 html = html + '       <div class="col-50 tablet-25">'+data['user'][loopMonths[mmm]][key]['code']+ '</div>';
                 html = html + '       <div class="col-50 tablet-25">Name</div>';
                 html = html + '       <div class="col-50 tablet-25">'+data['user'][loopMonths[mmm]][key]['name']+ '</div>';
                 html = html + '       <div class="col-50 tablet-25">MRP</div>';
                 html = html + '       <div class="col-50 tablet-25">'+data['user'][loopMonths[mmm]][key]['mrp']+ '</div>';
                 html = html + '       <div class="col-50 tablet-25">Quantity</div>';
                 html = html + '       <div class="col-50 tablet-25">'+data['user'][loopMonths[mmm]][key]['quantity']+ '</div>';
                 html = html + '       <div class="col-50 tablet-25">Value</div>';
                 html = html + '       <div class="col-50 tablet-25">'+data['user'][loopMonths[mmm]][key]['value']+ '</div>';
                 html = html + '       <div class="col-50 tablet-25">Discount</div>';
                 html = html + '       <div class="col-50 tablet-25">'+data['user'][loopMonths[mmm]][key]['discount']+ ' - '+data['user'][loopMonths[mmm]][key]['discountType']+ '</div>';
//                 html = html + '       </div>';
                 html = html + '       <div class="col-100"><hr size="1"></div>';  
  
                // html = html + '       <div class="col-100" style="border:1px dotted gray">';

               }
               
              }
             }

          }
          
          html = html + '     </div>';

         $$("#UsersDetail").html(html);        
         
        }else{
         html = '<div class="block">No Data found</div>';
         $$("#UsersDetail").html(html);        
        }
   
        },
        function () 	{
         toastNoInternet.open();
        });	  
        
      }
     }
  },
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  // Freamework7 routes - not used
  {
    path: '/page-loader-template7/:user/:userId/:posts/:postId/',
    templateUrl: './pages/page-loader-template7.html',
  },
  {
    path: '/page-loader-component/:user/:userId/:posts/:postId/',
    componentUrl: './pages/page-loader-component.html',
  },
  {
    path: '/request-and-load/user/:userId/',
    async: function (routeTo, routeFrom, resolve, reject) {
      // Router instance
      var router = this;

      // App instance
      var app = router.app;

      // Show Preloader
      app.preloader.show();

      // User ID from request
      var userId = routeTo.params.userId;

      // Simulate Ajax Request
      setTimeout(function () {
        // We got user data from request
        var user = {
          firstName: 'Vladimir',
          lastName: 'Kharlampidi',
          about: 'Hello, i am creator of Framework7! Hope you like it!',
          links: [
            {
              title: 'Framework7 Website',
              url: 'http://framework7.io',
            },
            {
              title: 'Framework7 Forum',
              url: 'http://forum.framework7.io',
            },
          ]
        };
        // Hide Preloader
        app.preloader.hide();

        // Resolve route to load page
        resolve(
          {
            componentUrl: './pages/request-and-load.html',
          },
          {
            context: {
              user: user,
            }
          }
        );
      }, 1000);
    },
  },
  // Default route (404 page). MUST BE THE LAST
  {
    path: '(.*)',
    url: './pages/404.html',
  },
];
