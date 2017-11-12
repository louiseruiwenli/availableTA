$(document).ready(function(){
  alert(localStorage.getItem('username'));
  if(window.localStorage.getItem('username')===null){
    alert("No username");
    window.location.href = '../login.html';
  }
  var username = localStorage.getItem('username');
  var userID = localStorage.getItem('userID');
  var job = localStorage.getItem('job');

  var dayOfWeek = ['M','T','W','R','F'];
  $.each(dayOfWeek,function(key,day){
    $.get('../phph/getScheduleInfo.php?userID='+userID+'&dayOfWeek='day).done(function(result){

    });

  });



});
