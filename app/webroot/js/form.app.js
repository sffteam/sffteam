var server = "http://sffteam/";
function copyFunction() 
{
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($('#copy').text()).select();
    document.execCommand("copy");
    $temp.remove();
}

function saveAnswer(q){
 var formData = new FormData();
 var user_id = $("#user_id").val();
 formData.append("q", q);
 formData.append("user_id", user_id);

 switch(q) {
  case 1:
    var name = $("#Name").val();
    formData.append("name", name);
    break;

   case 2:
    var email = $("#Email").val();
     formData.append("email", email);
   break;

   case 3:
    var mobile = $("#Mobile").val();
     formData.append("mobile", mobile);
   break;

  case 4:
    var dob = $("#dob").val();
     formData.append("dob", dob);
   break;

  case 5:
   var gender = $("select#Gender").val();
     formData.append("gender", gender);
   break;

   default:
    // code block
 }
 var url = server + "/form/s/";
 console.log(formData);
 $.ajax({
    url : url,
    type: "POST",
    data : formData,
    processData: false,
    contentType: false,
    success:function(data, textStatus, jqXHR){
     console.log(data);
     if(data['success']=="Yes"){
      console.log(data["data"]);
      $(location).attr('href', '/form/q/'+(q+1)+'/'+user_id)
     }
    },
    error: function(jqXHR, textStatus, errorThrown){
      //if fails     
    }
});
 
 
}