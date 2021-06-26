var $$ = Dom7; 
var storage = "ytdgpv";
var version = "1.0.000";
var server = "https://sff.team/malls/";

function pad(n, width, z) {
  z = z || '0';
  n = n + '';
  return n.length >= width ? n : new Array(width - n.length + 1).join(z) + n;
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
 if (!localStorage[storage + ".cart"]) {
  localStorage.setItem(storage + '.cart', "X:0");
 } else {
  var cart = localStorage[storage + ".cart"];
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
 localStorage.setItem(storage + '.cart', newArray.toString());
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
 if (!localStorage[storage + ".cart"]) {
  localStorage.setItem(storage + '.cart', "X:0");
 } else {
  var cart = localStorage[storage + ".cart"];
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
 localStorage.setItem(storage + '.cart', newArray.toString());
 toastBottom.open();
 addToCartBar();
 addToCartProducts();
}
function addToCartBar() {
 var cart = localStorage[storage + ".cart"];
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
function addToCartProducts() {
 var cart = localStorage[storage + ".cart"];
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
  console.log(gotData);
  htmlnew = "";
  Quantity = 0;
  Value = 0;
  for(key in gotData['CartProducts']){
   htmlnew = htmlnew + '<li>\
            <div class="item-content">\
              <div class="item-media"><img src="img/'+gotData['CartProducts'][key]['SKU']+'.png" width="44" /></div>\
              <div class="item-inner">\
                <div class="item-title-row">\
                  <div class="item-title sz1b Raleway">'+gotData['CartProducts'][key]['Name']+'</div>\
                  <div class="">Rs.'+gotData['CartProducts'][key]['MRP']+'</div>\
                </div>\
                <div class="item-subtitle">'+gotData['CartProducts'][key]['Weight']+'</div>\
                <div class="item-title-row row">\
                <div class="col-50 text-align-center">\
                 <div class="stepper stepper-fill stepper-small stepper-round stepper-init">\
                  <div class="stepper-button-minus" onclick="minustoCart(\'' + gotData['CartProducts'][key]['SKU'] + '\');"></div>\
                  <div class="stepper-input-wrap">\
                    <input type="text" value="' + getValue(gotData['CartProducts'][key]['SKU']) + '" min="0" max="100" step="1" readonly name="minusCode' + gotData['CartProducts'][key]['SKU'] + '" id="minusCode' + gotData['CartProducts'][key]['SKU'] + '"/>\
                  </div>\
                  <div class="stepper-button-plus"  onclick="addtoCart(\'' + gotData['CartProducts'][key]['SKU'] + '\');"></div>\
                 </div>\
                 </div>\
                 <div class="col-50 text-align-center Raleway sz1b">Rs.'+(getValue(gotData['CartProducts'][key]['SKU'])*gotData['CartProducts'][key]['MRP'])+'\
                 </div>\
                </div>\
              </div>\
            </div>\
          </li>';
          Quantity = Quantity + getValue(gotData['CartProducts'][key]['SKU']);
          Value = Value + (getValue(gotData['CartProducts'][key]['SKU'])*gotData['CartProducts'][key]['MRP']);
  }
  htmlnew = htmlnew + ' <li>\
            <div class="item-content">\
              <div class="item-inner">\
                <div class="item-title-row">\
                  <div class="item-title">Total</div>\
                  <div class="">Rs.'+Value+'</div>\
                </div>\
                <div class="item-subtitle">Items: '+Quantity+'</div>\
              </div>\
            </div>\
          </li>';
  $$("#CartPreview").html(htmlnew);
  
 });
}
function CartSubmit(){
 var formData = app.form.convertToData('#CartNameMobile');
 
	console.log(formData);
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
   console.log(gotData);
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
 localStorage.setItem(storage + '.cart', "X:0");
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
 var cart = localStorage[storage + ".cart"];
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
