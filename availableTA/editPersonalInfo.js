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
    var form = document.createElement("form");
    $(form).appendTo($('#personalinfo'));

    var phone = document.createElement("p");
    $(phone).html('Phone: ').appendTo($(form));

    var input = document.createElement("input");
    $(input).attr('id', 'newphone')
            .attr('name', 'phone')
            .attr('value',result_json[0]['phone'])
            .appendTo($(form));

  });
});

function updateinfo(){
  var newphone = document.getElementById('newphone').value;
  var username = localStorage.getItem('username');

  $.get('editPersonalInfo.php?username='+username+'&phone='+newphone).done(function(result){
      window.location.href = 'viewProfile.html';
  });
}
