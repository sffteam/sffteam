// Dom7
var server = window.location.protocol+'//'+window.location.hostname +'/';
console.log(server);
//var server = "http://sffteam/";


function login(){
 
 if($("#name").val()==""){return false;}
 if($("#password").val()==""){return false;}
 var name = $("#name").val()
 var password = $("#password").val();

 var submitURL = server+'savings/index/'+name+'/'+password;
 console.log(submitURL);
   	$.getJSON(submitURL,function(Result){
     console.log(Result);
    if(Result['success']=="Yes"){
     window.location = "/dashboard/"
    }
   });
}
function approve(row,point){
 var rowNo = "#MCA"+row.substring(1);
 var mcaNumber = $(rowNo).html();
 var reason = $("#"+row).val();
 var point = $("#"+point).val();
 var submitURL = server+'dashboard/doapprove/'+reason+'/'+mcaNumber+'/'+encodeURI(point);
 console.log(submitURL);
 
 	$.getJSON(submitURL,function(Result){
    window.location = "/dashboard/approve";
  });
}


function onclickOrder(year,mcaNumber,order){
 $('#Order').modal('show');
 $("#mmcaNumber").html(mcaNumber);
 $("#mMonth").html(year);
 $("#mOrder").html(order);
 $("#imcaNumber").html(mcaNumber);
 $("#iyyyymm").html(year);
 $("#iorder").html(order);
 var submitURL = server+'dashboard/getorder/'+year+'/'+mcaNumber;
 console.log(submitURL);
  	$.getJSON(submitURL,function(Result){
    console.log(Result['order']);
    html = "";
    html=html+'<table class="table table-bordered table-striped table-sm">\
     <thead class="thead-dark">\
     <tr>\
      <th scope="col">#</th>\
      <th scope="col">Code</th>\
      <th scope="col">Name</th>\
      <th scope="col">MRP</th>\
      <th scope="col">Discount</th>\
      <th scope="col">Quantity</th>\
      <th scope="col">TotalValue</th>\
    </tr>\
  </thead>\
  <tbody>';
  var k = 1;
  var totalValue = 0;
  var quantity = 0;
    for(key in Result['order']){
     html=html+'<tr>\
      <td scope="row">'+k+'</td>\
      <td>'+Result['order'][key]['code']+'</td>\
      <td>'+Result['order'][key]['name']+'</td>\
      <td>'+Result['order'][key]['mrp']+'</td>\
      <td>'+Result['order'][key]['discount']+' '+Result['order'][key]['discountType']+'</td>\
      <td>'+Result['order'][key]['quantity']+'</td>\
      <td>'+Result['order'][key]['value']+'</td>\
    </tr>';
    k++;
    quantity = quantity + Result['order'][key]['quantity'];
    totalValue = totalValue + Result['order'][key]['value'];
    }
    html=html+'<tr>\
    <td colspan="1">'+(k-1)+'</td>\
    <td colspan="4"></td>\
    <td colspan="1">'+quantity+'</td>\
    <td colspan="1">'+totalValue+'</td>\
    </tr>';
    html=html+'</tbody>\
   </table>';
    $("#OrderList").html(html);
   });
 }

 function PrintOrder(){
  var mcaNumber = $("#imcaNumber").html();
  var yyyymm = $("#iyyyymm").html();
  var file = "OrderFile"+yyyymm+mcaNumber;
  console.log(file);
  console.log($("#"+file).val());
  //window.location = $("#"+file).val();
  window.open(server+"documents/"+$("#"+file).val(), '_blank');
 }
 
 
function onclickModal(year,mcaNumber){
 $('#Invoice').modal('show');
 console.log(year);
 console.log(mcaNumber);
 $("#mmcaNumber").html(mcaNumber);
 $("#mMonth").html(year);
 $("#imcaNumber").val(mcaNumber);
 $("#iyyyymm").val(year);

 
 
 var date0 = "#gDate-"+mcaNumber+year+"-0";
 $("#Date1").val($(date0).val());
 var invoice0 = "#gInvoice-"+mcaNumber+year+"-0";
 $("#Invoice1").val($(invoice0).val());
 var DP0 = "#gDP-"+mcaNumber+year+"-0";
 $("#DP1").val($(DP0).val());
 var BV0 = "#gBV-"+mcaNumber+year+"-0";
 $("#BV1").val($(BV0).val()); 
 
 var date1 = "#gDate-"+mcaNumber+year+"-1";
 $("#Date2").val($(date1).val());
 var invoice1 = "#gInvoice-"+mcaNumber+year+"-1";
 $("#Invoice2").val($(invoice1).val());
 var DP1 = "#gDP-"+mcaNumber+year+"-1";
 $("#DP2").val($(DP1).val());
 var BV1 = "#gBV-"+mcaNumber+year+"-1";
 $("#BV2").val($(BV1).val()); 
  
}  

function saveInvoice(){
 mcaNumber = $("#imcaNumber").val();
 yyyymm = $("#iyyyymm").val();
 dp1 = $("#DP1").val();
 bv1 = $("#BV1").val();
 invoice1 = $("#Invoice1").val();
 date1 = $("#Date1").val();

 dp2 = $("#DP2").val();
 bv2 = $("#BV2").val();
 invoice2 = $("#Invoice2").val();
 date2 = $("#Date2").val();
 
 var submitURL = server+'dashboard/saveinvoice/'+yyyymm+'/'+mcaNumber+'/'+dp1+'/'+bv1+'/'+invoice1+'/'+dp2+'/'+bv2+'/'+invoice2+'/'+date1+'/'+date2;
 console.log(submitURL);
  	$.getJSON(submitURL,function(Result){
    console.log(Result);
    window.location = "/dashboard/invoices/"+mcaNumber;
   });
}

// This is a JavaScript file
function doApprove(row){
 console.log(row);
 var reason = $("#reason").val();
 var mcaNumber = $("input[id^="+row+"]").val();
 console.log(mcaNumber);
 var url = server+'dashboard/doapprove/'+reason+'/'+mcaNumber;
 console.log(url);
	$.getJSON(url,
		function(ReturnValues){
   window.location='/dashboard/approve/';  });

}
function productSave(code,discount,discountType,stock,quantity){
 console.log(code);
 console.log(discount);
 console.log(discountType);
 console.log(stock);
 console.log(quantity);
  var url = server+'dashboard/updateProduct/'+code+'/'+discount+'/'+discountType+'/'+stock+'/'+quantity;
  console.log(url);
	$.getJSON(url,
		function(ReturnValues){
   window.location='/dashboard/products/';  });
 
}