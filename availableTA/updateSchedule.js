$('#viewSchedule_afterEdit').click(function(e){
  e.preventDefault();
  var href = $(this).attr('href');
  updateSchedule(href);
  window.location = href;
});

function updateSchedule(href){

  var userID = localStorage.getItem('userID');
  var dayOfWeek = ["M","T","W","R","F"];
  var morningcheck = false;
  var afternooncheck = false;
  $.each($("input[name='morning_box']"),function(index_m, value){
    setInterval(function(){
      if(this.checked){
        $.get('editSchedule.php?action=available&time=Morning&userID='+userID+'&dayOfWeek='+dayOfWeek[index_m]).done(function(){alert("Done!!");});

      }else{
        $.get('editSchedule.php?action=unavailable&time=Morning&userID='+userID+'&dayOfWeek='+dayOfWeek[index_m]).done(function(){alert("Done!!");});
      }
    },index_m*100);


  });

  $.each($("input[name='afternoon_box']"),function(index_a, value){
      if(this.checked){
        $.get('editSchedule.php?action=available&time=Afternoon&userID='+userID+'&dayOfWeek='+dayOfWeek[index_a]).done(function(){alert("Done!!");});
      }else{
        $.get('editSchedule.php?action=unavailable&time=Afternoon&userID='+userID+'&dayOfWeek='+dayOfWeek[index_a]).done(function(){alert("Done!!");});
      }

  });

  $.each($("input[name='evening_box']"),function(index_e, value){
      if(this.checked){
        $.get('editSchedule.php?action=available&time=Evening&userID='+userID+'&dayOfWeek='+dayOfWeek[index_e]).done(function(){alert("Done!!");});
      }else{
        $.get('editSchedule.php?action=unavailable&time=Evening&userID='+userID+'&dayOfWeek='+dayOfWeek[index_e]).done(function(){alert("Done!!");});
      }

  });



}
