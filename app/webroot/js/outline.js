var $$ = Dom7;
var server = "https://sff.team/";
var storage = "TUY";
 
var app = new Framework7({
		root: '#app',
  smartSelect: {
   pageTitle: 'Select Option',
   openIn: 'popup',
  },
  input: {
   scrollIntoViewOnFocus: true,
   scrollIntoViewCentered: true,
  },
		textEditor:{
			buttons: ['bold', 'italic'],
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
   disableContextMenu: true,
   activeState: false,
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

var mainView = app.views.create('.view-main');

function courseTitle(title,_id){
	$$("#courseTitle").html(title);
	$$("#course_name").val(title);
	$$("#course_edit_id").val(_id);
}

function weekTitle(title,_id){
	$$("#weekTitle").html(title);
	$$("#week_name").val(title);
	$$("#week_edit_id").val(_id);
	var week_description = $$("#week_description_"+_id).val();
	var textEditor = app.textEditor.get(".text-edit-week");
	textEditor.setValue(week_description);
}
function week_description(classval){
	var textEditor = app.textEditor.get(classval);
	console.log(textEditor.getValue());
	$$("#week_edit_description").val(textEditor.getValue());
}
function weekDescription(classval){
	var textEditor = app.textEditor.get(classval);
	console.log(textEditor.getValue());
	$$("#week_description").val(textEditor.getValue());
}

function bonusTitle(title,_id){
	$$("#bonusTitle").html(title);
	$$("#bonus_name").val(title);
	$$("#bonus_edit_id").val(_id);
	var bonus_description = $$("#bonus_description_"+_id).val();
	var textEditor = app.textEditor.get(".text-edit-bonus");
	textEditor.setValue(bonus_description);
}

function bonusDescription(classval){
	var textEditor = app.textEditor.get(classval);
	console.log(textEditor.getValue());
	$$("#bonus_description").val(textEditor.getValue());
}
function bonus_description(classval){
	var textEditor = app.textEditor.get(classval);
	console.log(textEditor.getValue());
	$$("#bonus_edit_description").val(textEditor.getValue());
}


function sectionTitle(title,_id){
	$$("#sectionTitle").html(title);
	$$("#section_name").val(title);
	$$("#section_edit_id").val(_id);
	var section_description = $$("#section_description_"+_id).val();
	var textEditor = app.textEditor.get(".text-edit-section");
	textEditor.setValue(section_description);
}
function sectionDescription(classval){
	var textEditor = app.textEditor.get(classval);
	console.log(textEditor.getValue());
	$$("#section_description").val(textEditor.getValue());
}
function section_description(classval){
	var textEditor = app.textEditor.get(classval);
	console.log(textEditor.getValue());
	$$("#section_edit_description").val(textEditor.getValue());
}

function subjectTitle(title,_id){
	$$("#subjectTitle").html(title);
	$$("#subject_name").val(title);
	$$("#subject_edit_id").val(_id);
	var subject_description = $$("#subject_description_"+_id).val();
	var textEditor = app.textEditor.get(".text-edit-subject");
	textEditor.setValue(subject_description);
}
function subjectDescription(classval){
	var textEditor = app.textEditor.get(classval);
	console.log(textEditor.getValue());
	$$("#subject_description").val(textEditor.getValue());
}
function subject_description(classval){
	var textEditor = app.textEditor.get(classval);
	console.log(textEditor.getValue());
	$$("#subject_edit_description").val(textEditor.getValue());
}

function outlineDescription(classval){
	var textEditor = app.textEditor.get(classval);
	console.log(textEditor.getValue());
	$$("#outline_description").val(textEditor.getValue());
}

function outlineTitle(){
var outline_description = $$("#outline_description").val();
console.log(outline_description);
var textEditor = app.textEditor.get(".text-add-outline");
textEditor.setValue(outline_description);
}






function topicTitle(title,_id){
	$$("#topicTitle").html(title);
	$$("#topic_name").val(title);
	$$("#topic_edit_id").val(_id);
	var topic_description = $$("#topic_description_"+_id).val();
	var textEditor = app.textEditor.get(".text-edit-topic");
	textEditor.setValue(topic_description);
}
function topicDescription(classval){
	var textEditor = app.textEditor.get(classval);
	console.log(textEditor.getValue());
	$$("#topic_description").val(textEditor.getValue());
}
function topic_description(classval){
	var textEditor = app.textEditor.get(classval);
	console.log(textEditor.getValue());
	$$("#topic_edit_description").val(textEditor.getValue());
}


function showDivQuestion(){
	console.log("a");
	app.popup.close();
	var smartSelect = app.smartSelect.get('.smart-select');
	var questionType = smartSelect.getValue()
	console.log(questionType);
}

function  selectAttachment(value){
	
	$$("#AudioAttach").hide();
	$$("#VideoAttach").hide();
	$$("#ImageAttach").hide();
	$$("#PDFAttach").hide();
	switch(value) {
  case "Audio":
    // code block
				$$("#AudioAttach").show();
				localStorage.setItem(storage + '.attach', "Audio");
    break;
  case "Video":
    // code block
				$$("#VideoAttach").show();
				localStorage.setItem(storage + '.attach', "Video");
    break;
  case "Image":
    // code block
				$$("#ImageAttach").show();
				localStorage.setItem(storage + '.attach', "Image");
    break;
  case "PDF":
    // code block
				$$("#PDFAttach").show();
				localStorage.setItem(storage + '.attach', "PDF");
    break;
    default:
    // code block
	} 
	
}

function showAudio(value){
	$$("#showAudio").attr("src",value);
}
function showImage(value){
	$$("#showImage").attr("src",value);
}
function showVideo(value){
	$$("#showVideo").attr("src","//www.youtube.com/embed/"+value);
}
function showPDF(value){
	$$("#showPDF").attr("src",value);
}
// //www.youtube.com/embed/GlIzuTQGgzs
///////////////////////////////////////////////////////////////////
function changeTrueFalse(){
	var trueFalse = $$('input[name=trueFalse]:checked').val();
	console.log(trueFalse);
}

function getWeeks(_id){
	console.log("ID:")
	console.log(_id);
	
	var submitURL = server + 'attachments/getWeeks';
	app.preloader.show();
 var formData = new FormData();
	formData.append('_id', _id);
 app.request.post(submitURL, formData, function (data) {
  var gotData = JSON.parse(data);
		console.log(gotData)
		htmlnew = '<option value="">-- Select --</option>';
  if (gotData['success'] == 'Yes') {
			for(key in gotData['weeks']){
				htmlnew = htmlnew + '<option value="'+gotData['weeks'][key]['_id']+'">'+gotData['weeks'][key]['week_name']+'</option>';
			}
   $$("#weekName").html(htmlnew);
   app.preloader.hide();
  } else {
   app.preloader.hide();
  }
 }, function () {
  toastTopNoInternet.open();
  app.preloader.hide();
 });
}


function getSections(_id){
	console.log("ID:")
	console.log(_id);
	
	var submitURL = server + 'attachments/getSections';
	app.preloader.show();
 var formData = new FormData();
	formData.append('_id', _id);
 app.request.post(submitURL, formData, function (data) {
  var gotData = JSON.parse(data);
		console.log(gotData)
		htmlnew = '<option value="">-- Select --</option>';
  if (gotData['success'] == 'Yes') {
			for(key in gotData['sections']){
				htmlnew = htmlnew + '<option value="'+gotData['sections'][key]['_id']+'">'+gotData['sections'][key]['section_name']+'</option>';
			}
   $$("#sectionName").html(htmlnew);
   app.preloader.hide();
  } else {
   app.preloader.hide();
  }
 }, function () {
  toastTopNoInternet.open();
  app.preloader.hide();
 });
}

function getSubjects(_id){
	console.log("ID:")
	console.log(_id);
	
	var submitURL = server + 'attachments/getSubjects';
	app.preloader.show();
 var formData = new FormData();
	formData.append('_id', _id);
 app.request.post(submitURL, formData, function (data) {
  var gotData = JSON.parse(data);
		console.log(gotData)
		htmlnew = '<option value="">-- Select --</option>';
  if (gotData['success'] == 'Yes') {
			for(key in gotData['subjects']){
				htmlnew = htmlnew + '<option value="'+gotData['subjects'][key]['_id']+'">'+gotData['subjects'][key]['subject_name']+'</option>';
			}
   $$("#subjectName").html(htmlnew);
   app.preloader.hide();
  } else {
   app.preloader.hide();
  }
 }, function () {
  toastTopNoInternet.open();
  app.preloader.hide();
 });
}

function saveAttachment(){
	var attach = localStorage[storage + ".attach"];
	console.log(attach);
	
		switch(attach) {
  case "Audio":
    // code block
				var attachment = $$("#audioName").val();
				
    break;
  case "Video":
    // code block
				var attachment = $$("#videoName").val();
    break;
  case "Image":
    // code block
				var attachment = $$("#imageName").val();
    break;
  case "PDF":
    // code block
				var attachment = $$("#pdfName").val();
    break;
    default:
				var attachment = "";

	} 
	if(attachment==""){
		app.dialog.alert("Attachment not given", "Attachment");
		return false;
	}
	console.log (attachment);
	
	var course_id = $$('#courseName').val();
	var week_id = $$('#weekName').val();
	var section_id = $$('#sectionName').val();
	var subject_id = $$('#subjectName').val();
	
	app.preloader.show();
 var formData = new FormData();
	formData.append('attach', attach);
	formData.append('attachment', attachment);
	formData.append('course_id', course_id);
	formData.append('week_id', week_id);
	formData.append('section_id', section_id);
	formData.append('subject_id', subject_id);
	formData.append('post', 'add');
	var submitURL = server + 'attachments/index/json';
 app.request.post(submitURL, formData, function (data) {
	  app.preloader.hide();
			app.dialog.alert("Saved", "Attachment");
			$$("#audioName").val("");
			$$("#videoName").val("");
			$$("#imageName").val("");
			$$("#pdfName").val("");
 }, function () {
  toastTopNoInternet.open();
  app.preloader.hide();
 });
	
	return false;
}