$(document).ready(function(){
  if(window.localStorage.getItem('username')===null){
    alert("No username");
    window.location.href = '../login.html';
  }

  if(localStorage.getItem('job')==1){
    $('#viewschedule').addClass('disabled');
  }

  var labID = localStorage.getItem('requestLab');
  localStorage.removeItem('requestLab');

  $.get('../php/getTAlist.php?labID='+labID).done(function(result){
      alert(result);
      var result_json = $.parseJSON(result);
      $.each(result_json, function(index, value){
          var div = document.createElement('div');
          $(div).appendTo($('#talist'));
          var name = document.createElement('h4');
          $(name).html(value['Name']).appendTo($(div));
          var email = document.createElement('p');
          $(email).html('Email: ' + value['email']).appendTo($(div));
          var phone = document.createElement('p');
          $(phone).html('Phone: ' + value['phone']).appendTo($(div));
      });

  });

});
