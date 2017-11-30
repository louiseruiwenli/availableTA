$(document).ready(function(){

  if(window.localStorage.getItem('username')===null){
    alert("No username");
    window.location.href = 'login.html';
  }

  if(localStorage.getItem('job')==1){
    $('#viewschedule').addClass('disabled');
  }

  var username = localStorage.getItem('username');
  var userID = localStorage.getItem('userID');
  var job = localStorage.getItem('job');

  $.get('viewUserInfo.php?username='+username).done(function(result){
    var result_json = $.parseJSON(result);
    var name = document.createElement("p");
    $(name).html('Name: ' + result_json[0]['Name']).appendTo($('#personalinfo'));
    var id = document.createElement("p");
    $(id).html('ID: ' + userID).appendTo($('#personalinfo'));
    var email = document.createElement("p");
    $(email).html('Email: ' + username).appendTo($('#personalinfo'));
    var TAProf = document.createElement("p");
    if(job==0){
      $(TAProf).html('Job: TA').appendTo($('#personalinfo'));
    }else{
      $(TAProf).html('Job: Professor').appendTo($('#personalinfo'));
    }

    var phone = document.createElement("p");
    if(result_json[0]['phone']==""){
      $(phone).html('Phone: Please enter your cell phone number!').appendTo($('#personalinfo'));
    }else{
      $(phone).html('Phone: ' + result_json[0]['phone']).appendTo($('#personalinfo'));
    }

  });

  $.get('getUserLabInfo.php?job='+job+'&userID='+userID).done(function(result_lab){

    var result_json = $.parseJSON(result_lab);

    $.each(result_json, function(index, val){
      var p = document.createElement('p');
      $(p).html(val['LabID']+'&nbsp;'+val['CourseNumber']+'&nbsp;'+val['CourseName']).appendTo($('#labinfo'));
    });

  });
});
