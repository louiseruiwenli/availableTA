$(document).ready(function(){
  if(window.localStorage.getItem('username')===null){
    alert("No username");
    window.location.href = 'login.html';
  }
  if(localStorage.getItem('job')==1){
    window.location.href = 'index.html';
  }
  var username = localStorage.getItem('username');
  var userID = localStorage.getItem('userID');
  var job = localStorage.getItem('job');

  var dayOfWeek = ["M","T","W","R","F"];
  $.each(dayOfWeek,function(key,day){
    $.get('getScheduleInfo.php?userID='+userID+'&dayOfWeek='+day+'&time=Morning').done(function(result){
        var result_json = $.parseJSON(result);
        var td_morning = document.createElement('td');
        $(td_morning).appendTo($('#morning'));
        var check_morning = document.createElement('input');
        $(check_morning).attr('type','checkbox')
                        .attr('name','morning_box')
                        .attr('value',day)
                        .appendTo($(td_morning));
        if(result_json['Morning']==false){
          $(td_morning).addClass('unavailable');
          $(check_morning).attr('checked',false);
        }else{
          $(td_morning).addClass('available');
          $(check_morning).attr('checked',true);
        }


    });

    $.get('getScheduleInfo.php?userID='+userID+'&dayOfWeek='+day+'&time=Afternoon').done(function(result){
        var result_json = $.parseJSON(result);
        var td_afternoon = document.createElement('td');
        $(td_afternoon).appendTo($('#afternoon'));
        var check_afternoon = document.createElement('input');
        $(check_afternoon).attr('type','checkbox')
                        .attr('name','afternoon_box')
                        .attr('value',day)
                        .appendTo($(td_afternoon));
        if(result_json['Afternoon']==false){
          $(td_afternoon).addClass('unavailable');
          $(check_afternoon).attr('checked',false);
        }else{
          $(td_afternoon).addClass('available');
          $(check_afternoon).attr('checked',true);
        }

    });

    $.get('getScheduleInfo.php?userID='+userID+'&dayOfWeek='+day+'&time=Evening').done(function(result){
        var result_json = $.parseJSON(result);
        var td_evening = document.createElement('td');
        $(td_evening).appendTo($('#evening'));
        var check_evening = document.createElement('input');
        $(check_evening).attr('type','checkbox')
                        .attr('name','evening_box')
                        .attr('value',day)
                        .appendTo($(td_evening));
        if(result_json['Evening']==false){
          $(td_evening).addClass('unavailable');
          $(check_evening).attr('checked',false);
        }else{
          $(td_evening).addClass('available');
          $(check_evening).attr('checked',true);
        }

    });

  });

});

function updateSchedule(){

  var userID = localStorage.getItem('userID');
  var dayOfWeek = ["M","T","W","R","F"];

  $.each($("input[name='morning_box']"),function(index, value){
      if(this.checked){
        $.get('editSchedule.php?action=available&time=Morning&userID='+userID+'&dayOfWeek='+dayOfWeek[index]);

      }else{
        $.get('editSchedule.php?action=unavailable&time=Morning&userID='+userID+'&dayOfWeek='+dayOfWeek[index]);
      }
  });

  $.each($("input[name='afternoon_box']"),function(index, value){
      if(this.checked){
        $.get('editSchedule.php?action=available&time=Afternoon&userID='+userID+'&dayOfWeek='+dayOfWeek[index]);
      }else{
        $.get('editSchedule.php?action=unavailable&time=Afternoon&userID='+userID+'&dayOfWeek='+dayOfWeek[index]);
      }
  });

  $.each($("input[name='evening_box']"),function(index, value){
      if(this.checked){
          $.get('editSchedule.php?action=available&time=Evening&userID='+userID+'&dayOfWeek='+dayOfWeek[index]);
      }else{
        $.get('editSchedule.php?action=unavailable&time=Evening&userID='+userID+'&dayOfWeek='+dayOfWeek[index]);
      }
  });

  window.location.href = 'viewSchedule.html';




}
