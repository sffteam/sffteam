// Dom7
var storage = "MCA";
var $$ = Dom7;
var version = "1.1.082";
var testMode = "No";
var server = window.location.protocol+'//'+window.location.hostname +'/';



// Framework7 App main instance
var app  = new Framework7({
  root: '#app', // App root element
  id: 'team.sff.administrator', // App bundle ID
  name: 'sff-administrator', // App name
  theme: 'auto', // Automatic theme detection
  template7Pages: true,
  allowDuplicateUrls: true,
  allowPageChange  :true,
  touch: {
        materialRipple: false
    },
  pushState: false,
  fastClicksExclude: '*',
  toast: {
    closeTimeout: 3000,
    closeButton: true,
  },
  // App routes
  routes: routes,
});

// Init/Create main view
var mainView = app.views.create('.view-main', {
  url: '/'
});


var toastBottom = app.toast.create({
  text: 'Shopping cart updated!!',
  closeTimeout: 2000,
});
var toastNoInternet = app.toast.create({
  text: 'No Internet connection!',
  position: 'top',
  cssClass : 'toast_red',
  closeTimeout: 2000,
  closeButton: false,
});

function approveDP(mca){
 mcaNumber = mca.value;
 reason = $$("#Reasons"+mca.value).val();
 dpaddress = $$("#DPAddress"+mca.value).val();
 var form_data = new FormData();
 form_data.append('mcaNumber', mcaNumber);
 form_data.append('reason', encodeURI(reason));
 form_data.append('dpaddress', encodeURI(dpaddress));
 var submitURL = server+'admin/doapprove';
 console.log(submitURL);
 app.request.post(submitURL, form_data, function (gotData) {
   var data = JSON.parse( gotData );
   if(data['success']=='Yes'){
    app.dialog.alert("Approved. Saved!", "Approve");
   }else{
    app.dialog.alert("Not Approved. Saved!", "Approve");
   }
 },
 function () 	{
  toastNoInternet.open();
 });	  
}