var $$ = Dom7; 
var storage = "ytdgpv";
var version = "1.0.000";
var server = "https://sffteam/malls/";
var mcaNumber = $$("#mcaNumber").val();
console.log(mcaNumber);

if (!localStorage[storage + "."+mcaNumber+".cart"]) {
 localStorage.setItem(storage + "."+mcaNumber+'.cart', "X:0");
} else {
 var cart = localStorage[storage + "."+mcaNumber+".cart"];
}

var app  = new Framework7({
  root: '#app', // App root element
  id: 'ytdgpv.sff.team', // App bundle ID
  name: 'Year to Date Group PV SFF Mall', // App name
  theme: 'auto', // Automatic theme detection
  // App root methods
  methods: {
    helloWorld: function () {
      app.dialog.alert('Hello World!');
    },
  },
  // App routes
  
		init: true,
  template7Pages: true,
  allowDuplicateUrls: true,
  allowPageChange: true,
  closeByBackdropClick: false,
  stackPages: true,
  smartSelect: {
   pageTitle: 'Select Option',
   openIn: 'popup',
  },
  input: {
   scrollIntoViewOnFocus: true,
   scrollIntoViewCentered: true,
  },
  swiper: {
   initialSlide: 0,
   spaceBetween: 10,
   speed: 300,
   loop: false,
   preloadImages: true,
   zoom: {
    enabled: true,
    maxRatio: 3,
    minRatio: 1,
   },
   lazy: {
    enabled: true,
   },
  },
  photoBrowser: {
   type: 'popup',
  },
  touch: {
   materialRipple: false,
   tapHold: true,
   disableContextMenu: false,
   activeState: true,
   fastClicks: true,
  },
  pushState: false,
  toast: {
   closeTimeout: 3000,
   closeButton: true,
  },
  
  calendar: {
   url: 'calendar/',
   dateFormat: 'dd/mm/yyyy',
  },
  lazy: {
   threshold: 50,
   sequential: false,
  },
	});


app.request.setup({
 crossDomain: true
});


function pad(n, width, z) {
  z = z || '0';
  n = n + '';
  return n.length >= width ? n : new Array(width - n.length + 1).join(z) + n;
}

function initiate(){
 addToCartBar();
 addToCartProduct();
 addToCartProducts();
}
function dataError(message){
var opentoastdataError = app.toast.create({
  text: message,
  cssClass: 'toast_red',
  position: 'center',
  closeTimeout: 2000,
  closeButton: false,
 });
	opentoastdataError.open();
}
function dataSubmit(message){
var opentoastdataError = app.toast.create({
  text: message,
  cssClass: 'toast_green',
  position: 'center',
  closeTimeout: 2000,
  closeButton: false,
 });
	opentoastdataError.open();
}
var toastBottomData = app.toast.create({
  text: 'Data updated!!',
  closeTimeout: 2000,
 });
var toastBottom = app.toast.create({
  text: 'Shopping cart updated!!',
  closeTimeout: 2000,
 });
var toastTopNoInternet = app.toast.create({ 
  text: 'No Internet connection!',
  position: 'top',
  cssClass: 'toast_red',
  closeTimeout: 2000,
  closeButton: false,
 });
app.request.setup({
 crossDomain: true
});

function addToCartProduct(){
  if (!localStorage[storage + "."+mcaNumber+".cart"]) {
   localStorage.setItem(storage + "."+mcaNumber+'.cart', "X:0");
  } else {
   var cart = localStorage[storage + "."+mcaNumber+".cart"];
   cart = cart.replaceAll('X:0,','');
   localStorage.setItem(storage + "."+mcaNumber+'.cart', cart);
  }
 var obj = malformedJSON2Array(cart);
 for (key in obj) {
  element = obj[key];
  for (keyi in element) {
    zelement = element[keyi];
    $$('[name=minusCode' + keyi + ']').val(zelement);
  }
 }
}
function addtoCart(code) {
 var codeAdd = 0;
 var newArray = [];
 var minusCode = "minusCode" + code;
 var minusCart = "minusCart" + code;
 if ($$('[name=' + minusCode + ']').val() >= 30) {
  return false;
 }
 if ($$('[name=' + minusCart + ']').val() >= 30) {
  return false;
 }
 if (!localStorage[storage + "."+mcaNumber+".cart"]) {
  localStorage.setItem(storage + "."+mcaNumber+'.cart', "X:0");
 } else {
  var cart = localStorage[storage + "."+mcaNumber+".cart"];
 }
 var obj = malformedJSON2Array(cart);
 for (key in obj) {
  element = obj[key];
  for (keyi in element) {
   zelement = element[keyi];
   if (keyi == code) {
    codeAdd = 1;
    zelement = zelement + 1;
    $$('[name=' + minusCart + ']').val(zelement);
    $$('[name=' + minusCode + ']').val(zelement);
   }
   if (zelement == 1) {
    $$('[name=' + minusCart + ']').val(zelement);
    $$('[name=' + minusCode + ']').val(zelement);
   }
   if (zelement == 0) {
    $$('[name=' + minusCart + ']').val(1);
    $$('[name=' + minusCode + ']').val(1);
   }
   newArray.push(keyi + ":" + zelement)
  }
 }
 if (codeAdd == 0) {
  newArray.push(code + ":" + 1);
 }
 var count = newArray.length;
 localStorage.setItem(storage + "."+mcaNumber+'.cart', newArray.toString());
 toastBottom.open();
 addToCartBar();
 addToCartProducts();
}
function minustoCart(code) {
 var codeAdd = 0;
 var newArray = [];
 var minusCode = "minusCode" + code;
 var minusCart = "minusCart" + code;
 if ($$('[name=' + minusCode + ']').val() == 0) {
  return false;
 }
 if ($$('[name=' + minusCart + ']').val() == 0) {
  return false;
 }
 if (!localStorage[storage + "."+mcaNumber+".cart"]) {
  localStorage.setItem(storage + "."+mcaNumber+'.cart', "X:0");
 } else {
  var cart = localStorage[storage + "."+mcaNumber+".cart"];
 }
 var obj = malformedJSON2Array(cart);
 for (key in obj) {
  element = obj[key];
  for (keyi in element) {
   zelement = element[keyi];
   if (keyi == code) {
    codeAdd = 1;
    zelement = zelement - 1;
    $$('[name=' + minusCart + ']').val(zelement);
    $$('[name=' + minusCode + ']').val(zelement);
   }
   newArray.push(keyi + ":" + zelement)
   if (zelement == 0) {
    newArray.pop(keyi + ":0")
   }
  }
 }
 if (codeAdd == 0) {
  newArray.push(code + ":" + 1);
 }
 var count = newArray.length;
 localStorage.setItem(storage + "."+mcaNumber+'.cart', newArray.toString());
 toastBottom.open();
 addToCartBar();
 addToCartProducts();
}
function addToCartBar() {
 var mcaNumber = $$("#mcaNumber").val();
 var cart = localStorage[storage + "."+mcaNumber+".cart"];
 var items = 0;
 var rsValue = 0;
 var obj = malformedJSON2Array(cart);
 if(cart!="X:0"){
  for (key in obj) {
   element = obj[key];
   for (code in element) {
    codeValue = element[code];
    items = items + 1;
   }
  }
 }
 if(items==0){ 
  $$("#CartFill").hide();
 }
 $$("#CartFill").html(items);
}

function sendCart(){
 var form_data = new FormData();
 var cart = localStorage[storage + "."+mcaNumber+".cart"];
 console.log(cart);
 console.log(mcaNumber);
 form_data.append('mcaNumber', mcaNumber);

// for(var p of form_data){
//  console.log(p);
// }

 var items = 0;
 var rsValue = 0;
 var obj = malformedJSON2Array(cart);
 for (key in obj) {
  element = obj[key];
  for (code in element) {
   codeValue = element[code];
   form_data.append(code, codeValue);
   items = items + 1;
  }
 }


 var submitURL = server + 'cartproducts';
 console.log(submitURL);
 app.request.post(submitURL, form_data, function (data) {
  app.preloader.hide(); 
  gotData = JSON.parse(data);
  console.log(gotData);
  $$('.cart-screen').on('cartscreen:open', function (e) {
      console.log('Login screen open')
    });
 });
}

function addToCartProducts() {
 var cart = localStorage[storage + "."+mcaNumber+".cart"];
 var submitURL = server + 'cartproducts';
 var form_data = new FormData();
 var items = 0;
 var rsValue = 0;
 var obj = malformedJSON2Array(cart);
 for (key in obj) {
  element = obj[key];
  for (code in element) {
   codeValue = element[code];
   form_data.append(code, codeValue);
   items = items + 1;
  }
 }
 app.preloader.show();
 app.request.post(submitURL, form_data, function (data) {
  app.preloader.hide(); 
  gotData = JSON.parse(data);
  htmlnew = "";
  Quantity = 0;
  Value = 0;
  $$("#tMRP").html(gotData['value']);
  $$("#tDP").html(gotData['valueDP']);
  $$("#tRatio").html(Math.round(gotData['valueBV']/gotData['valueDP']*100,0)+"%");
  $$("#tBV").html(gotData['valueBV']);
  $$("#tPV").html(gotData['valuePV'].toFixed(1));
  $$("#tWt").html(gotData['valueWeight']);
  $$("#tSave").html(gotData['value'] - gotData['valueDP']);
  htmlnew = '   <table>\
              <tr>\
               <th>Code</th>\
               <th>Name</th>\
               <th>Quantity</th>\
               <th>T-DP</th>\
               <th>T-BV</th>\
               <th>T-PV</th>\
              </tr>';
  for(key in gotData['CartProducts']){
   htmlnew = htmlnew + '              <tr>\
               <td>'+gotData['CartProducts'][key]['Code']+'</td>\
               <td class="text-align-left">'+gotData['CartProducts'][key]['Name']+'</td>\
               <td>'+(gotData['CartProducts'][key]['Quantity']).toFixed(1)+'</td>\
               <td>'+(gotData['CartProducts'][key]['DP']*gotData['CartProducts'][key]['Quantity']).toFixed(1)+'</td>\
               <td>'+(gotData['CartProducts'][key]['BV']*gotData['CartProducts'][key]['Quantity']).toFixed(1)+'</td>\
               <td>'+(gotData['CartProducts'][key]['PV']*gotData['CartProducts'][key]['Quantity']).toFixed(1)+'</td>\
              </tr>';
  items = items + gotData['CartProducts'][key]['Quantity'];
  }
  htmlnew = htmlnew + '<tr>\
               <th>Total</th>\
               <th> </th>\
               <th>'+items+'</th>\
               <th>'+gotData['valueDP']+'</th>\
               <th>'+gotData['valueBV']+'</th>\
               <th>'+gotData['valuePV']+'</th>\
  </tr>';
  htmlnew = htmlnew + '</table>';
  $$("#CartList").html(htmlnew);
 });
}
function ShareWhatsApp(){
 var Mobile = $$("#Mobile").val();
 var htmlCart = "Cart\n";
 var cart = localStorage[storage + "."+mcaNumber+".cart"];
 
 htmlCart = htmlCart + cart.replaceAll(",","\n");
 
 htmlnew = "";
 htmlnew = htmlnew + 'https://web.whatsapp.com/send?phone=+91'+Mobile+'&amp;text='+htmlCart;
 $$("#ShareApp").attr('href',htmlnew);
 console.log(htmlnew);
}

function CartSubmit(){
 var formData = app.form.convertToData('#CartNameMobile');
 
//	console.log(formData);
 if(formData.C_name==""){
   dataError("Name is required");
   return false;
 }
 if(formData.C_mobile==""){
   dataError("Mobile is required");
   return false;
 }
 if(formData.C_address==""){
   dataError("Address is required");
   return false;
 }
 if(formData.C_pincode==""){
   dataError("Pincode is required");
   return false;
 }
 submitURL = server + "cartsubmit";
  dataSubmit("Cart send to Chaudhary Tea");
  app.request.post(submitURL, formData, function (data) {
   gotData = JSON.parse(data);  
//   console.log(gotData);
   htmlnew = "Name: " + gotData['data']['Name']+"\n";
   htmlnew = htmlnew + "Mobile: " + gotData['data']['Mobile']+"\n";
   htmlnew = htmlnew + "Address: " + gotData['data']['Address']+"\n";
   htmlnew = htmlnew + "Pincode: " + gotData['data']['Pincode']+"\n";
   htmlnew = htmlnew + "DateTime: " + gotData['data']['DateTime']+"\n";
   htmlnew = htmlnew + 'Products\n';
   for(key in gotData['data']['Products']){
    htmlnew = htmlnew + 'Name: '+gotData['data']['Products'][key]['Name']+"\n";
    htmlnew = htmlnew + 'Quantity: '+gotData['data']['Products'][key]['Quantity']+"\n";
    htmlnew = htmlnew + 'Rate: '+gotData['data']['Products'][key]['Rate']+"\n";
    htmlnew = htmlnew + 'Weight: '+gotData['data']['Products'][key]['Weight']+"\n";
    htmlnew = htmlnew + 'Value: '+gotData['data']['Products'][key]['Value']+"\n";
    htmlnew = htmlnew + 'SKU: '+gotData['data']['Products'][key]['SKU']+"\n\n";
   }
   clearCart();
   
   window.plugins.socialsharing.shareViaWhatsAppToPhone("+919408333555", htmlnew, null, null, function () {});
   
  });
 return false;

}

function clearCart() {
 localStorage.setItem(storage + "."+mcaNumber+'.cart', "X:0");
 $$("#CartFill").html("");
 $$("#CartFill").hide();
}



//===================================================================================
function formatYYYYMM(date) {
 var d = new Date(date),
 month = '' + (d.getMonth() + 1),
 day = '' + d.getDate(),
 year = d.getFullYear();
 if (month.length < 2)
  month = '0' + month;
 if (day.length < 2)
  day = '0' + day;
 return [year, month].join('-');
}
function formatYYYYMMDD(date) {
 var d = new Date(date),
 month = '' + (d.getMonth() + 1),
 day = '' + d.getDate(),
 year = d.getFullYear();
 if (month.length < 2)
  month = '0' + month;
 if (day.length < 2)
  day = '0' + day;
 return [year, month, day].join('-');
}
function formatYYYYMMDDH(date) {
 var d = new Date(date),
 month = '' + (d.getMonth() + 1),
 day = '' + d.getDate(),
 year = d.getFullYear();
 hour = d.getHours();
 if (month.length < 2)
  month = '0' + month;
 if (day.length < 2)
  day = '0' + day;
 return [year, month, day, hour].join('-');
}
function getValue(code) {
 var cart = localStorage[storage + "."+mcaNumber+".cart"];
 var obj = malformedJSON2Array(cart);
 for (keyx in obj) {
  element = obj[keyx];
  for (keyi in element) {
   zelement = element[keyi];
   if (keyi == code) {
    return zelement;
   }
  }
 }
 return 0;
}
function malformedJSON2Array(tar) {
 var arr = [];
 tar = tar.replace(/^\{|\}$/g, '').split(',');
 for (var i = 0, cur, pair; cur = tar[i]; i++) {
  arr[i] = {};
  pair = cur.split(':');
  arr[i][pair[0]] = /^\d*$/.test(pair[1]) ? +pair[1] : pair[1];
 }
 return arr;
}
