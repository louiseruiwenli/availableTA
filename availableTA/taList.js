$(document).ready(function(){
  if(window.localStorage.getItem('username')===null){
    alert("No username");
    window.location.href = 'login.html';
  }

  if(localStorage.getItem('job')==1){
    $('#viewschedule').addClass('disabled');
  }

  var labID = localStorage.getItem('requestLab');
  localStorage.removeItem('requestLab');

  $.get('getTAlist.php?labID='+labID).done(function(result){
      var result_json = $.parseJSON(result);
      if(result_json=='No Result'){
        var warning = document.createElement('h4');
        $(h4).html('Warning: No TA available during this time period. Please find another solution or contact Professor Atkinson at datkinson@scu.edu')
             .appendTo($('#talist'));
      }else{
        $.each(result_json, function(index, value){
            var div = document.createElement('div');
            $(div).addClass('col-md-6')
                  .addClass('TAinfo')
                  .appendTo($('#talist'));
            var name = document.createElement('h4');
            $(name).html(value['Name']).appendTo($(div));
            var email = document.createElement('p');
            $(email).html('Email: ' + value['email']).appendTo($(div));
            var phone = document.createElement('p');
            $(phone).html('Phone: ' + value['phone']).appendTo($(div));
        });
      }


  });

});
