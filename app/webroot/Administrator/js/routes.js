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
          html = html + '             <div class="item-title">'+i+'. '+data['users'][key]['firstName']+' '+data['users'][key]['lastName']+' - '+data['users'][key]['mcaNumber']+'   +91'+data['users'][key]['mobile']+'</div>';
          html = html + '           </div></a>';
          html = html + '         <div class="accordion-item-content">';
          html = html + '           <div class="block">';
          html = html + '     <div class="row">';
          html = html + '       <div class="col-50 tablet-25">Name</div>';
          html = html + '       <div class="col-50 tablet-25">'+data['users'][key]['firstName']+' '+data['users'][key]['lastName']+'</div>';
          html = html + '       <div class="col-50 tablet-25">Mobile</div>';
          html = html + '       <div class="col-50 tablet-25">+91'+data['users'][key]['mobile']+'</div>';
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
          html = html + '             <div class="item-title">'+i+'. '+data['users'][key]['firstName']+' '+data['users'][key]['lastName']+' - '+data['users'][key]['mcaNumber']+'   +91'+data['users'][key]['mobile']+'</div>';
          html = html + '           </div></a>';
          html = html + '         <div class="accordion-item-content">';
          html = html + '           <div class="block">';
          html = html + '     <div class="row">';
          html = html + '       <div class="col-50 tablet-25">Name</div>';
          html = html + '       <div class="col-50 tablet-25">'+data['users'][key]['firstName']+' '+data['users'][key]['lastName']+'</div>';
          html = html + '       <div class="col-50 tablet-25">Mobile</div>';
          html = html + '       <div class="col-50 tablet-25">+91'+data['users'][key]['mobile']+'</div>';
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
         $$("#UserName").html(data['user']['firstName']+' '+data['user']['lastName'])
         
         html = "";
         for(key in data['user']){
          html = html + '     <div class="row">';
          html = html + '       <div class="col-50 tablet-25">Name</div>';
          html = html + '       <div class="col-50 tablet-25">'+data['user'][key]['firstName']+' '+data['user'][key]['lastName']+'</div>';
          html = html + '       <div class="col-50 tablet-25">Mobile</div>';
          html = html + '       <div class="col-50 tablet-25">+91'+data['user'][key]['mobile']+'</div>';
          html = html + '       <div class="col-50 tablet-25">MCA Number</div>';
          html = html + '       <div class="col-50 tablet-25">'+data['user'][key]['mcaNumber']+' / '+data['user'][key]['mcaPassword']+'</div>';
          html = html + '       <div class="col-50 tablet-25">PIN</div>';
          html = html + '       <div class="col-50 tablet-25">'+data['user'][key]['signpin']+'</div>';
          html = html + '       <div class="col-50 tablet-25">Date of Birth</div>';
          html = html + '       <div class="col-50 tablet-25">'+data['user'][key]['dateofbirth']+'</div>';
          html = html + '       <div class="col-50 tablet-25">Gender</div>';
          html = html + '       <div class="col-50 tablet-25">'+data['user'][key]['gender']+'</div>';
          html = html + '       <div class="col-50 tablet-25">Address</div>';
          html = html + '       <div class="col-50 tablet-25">'+data['user'][key]['address']+', '+data['user'][key]['street']+', '+data['user'][key]['city']+','+data['user'][key]['pin']+' '+data['user'][key]['state']+'</div>';
          html = html + '       <div class="col-50 tablet-25">Select DP</div>';
          html = html + '       <div class="col-50 tablet-25">'+data['user'][key]['point'].name+'</div>';
          html = html + '       <div class="col-50 tablet-25">Select Reason</div>';
          html = html + '       <div class="col-50 tablet-25">'+data['user'][key]['reason'] + '</div>';
          html = html + '     </div>';

         $$("#UsersDetail").html(html);        
         }
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
