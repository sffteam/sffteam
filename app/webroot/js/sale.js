var $$ = Dom7; 

function pad(n, width, z) {
  z = z || '0';
  n = n + '';
  return n.length >= width ? n : new Array(width - n.length + 1).join(z) + n;
}

function Offers(){
 htmlnew = "";
 for(i = 1; i<25;i++){
  var url = CheckUrl('/img/offers/offer'+pad(i,2,"0")+'.jpg');
  if(url==true){
   htmlnew = htmlnew + '<div class="block">';
    htmlnew = htmlnew + '<img src="/img/offers/offer'+pad(i,2,"0")+'.jpg" width="100%" class="lazy" class="lazy">';
   htmlnew = htmlnew + '</div>';
  }else{
    //url not exists
  }
 }
 console.log(htmlnew);
 $$("#OffersoftheMonth").html(htmlnew);
}

function CheckUrl(url)
{
     if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
    var http=new XMLHttpRequest();
     }
    else
    {// code for IE6, IE5
   var http=new ActiveXObject("Microsoft.XMLHTTP");
     }
    http.open('HEAD', url, false);
    http.send();
    return http.status!=404;
} 