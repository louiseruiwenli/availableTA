$(document).ready(function(){
  if(window.localStorage.getItem('username')===null){
    alert("No username");
    window.location.href = 'login.html';
  }

  if(localStorage.getItem('job')==1){
    window.location.href = 'index.html';
    $('#viewschedule').addClass('disabled');
  }
  var username = localStorage.getItem('username');
  var userID = localStorage.getItem('userID');
  var job = localStorage.getItem('job');

  var dayOfWeek = ['M','T','W','R','F'];
  $.each(dayOfWeek,function(key,day){
    $.get('getScheduleInfo.php?userID='+userID+'&dayOfWeek='+day+'&time=Morning').done(function(result){
        var result_json = $.parseJSON(result);
        var td_morning = document.createElement('td');
        $(td_morning).appendTo($('#morning'));
        if(result_json['Morning']==false){
          $(td_morning).addClass('unavailable');
        }else{
          $(td_morning).addClass('available');
        }


    });

    $.get('getScheduleInfo.php?userID='+userID+'&dayOfWeek='+day+'&time=Afternoon').done(function(result){
        var result_json = $.parseJSON(result);
        var td_afternoon = document.createElement('td');
        $(td_afternoon).appendTo($('#afternoon'));
        if(result_json['Afternoon']==false){
          $(td_afternoon).addClass('unavailable');
        }else{
          $(td_afternoon).addClass('available');
        }

    });

    $.get('getScheduleInfo.php?userID='+userID+'&dayOfWeek='+day+'&time=Evening').done(function(result){
        var result_json = $.parseJSON(result);
        var td_evening = document.createElement('td');
        $(td_evening).appendTo($('#evening'));
        if(result_json['Evening']==false){
          $(td_evening).addClass('unavailable');
        }else{
          $(td_evening).addClass('available');
        }
    });

  });
});
