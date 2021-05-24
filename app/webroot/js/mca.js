
// Dom7
var app = new Framework7();

var server = window.location.protocol+'//'+window.location.hostname +'/';
console.log(server);
//var server = "http://sffteam/";

var toastBottomNoInternet = app.toast.create({
  text: 'No Internet connection!',
  position: 'top',
  cssClass: 'toast_red',
  closeTimeout: 2000,
  closeButton: false,
 });


