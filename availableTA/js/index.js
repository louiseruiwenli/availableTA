$(document).ready(function(){
  alert(window.localStorage.getItem('username'));
  if(window.localStorage.getItem('username')===null){
    alert("No username");
    window.location.href = '../login.html';
  }
  var username = localStorage.getItem('username');
  $.get('../php/getJob.php?username='+username).done(function(result){
    //alert("get query done");
    if(result=='No Result'){
      alert('No Result!');
    }
    var result_json = $.parseJSON(result);
    var userID = result_json[0]['ID'];
    var job = result_json[0]['TAProf'];
    localStorage.setItem('userID', userID);
    localStorage.setItem('job',job);
    //alert(localStorage.getItem('job'));
    //alert(localStorage.getItem('userID'));
  });

  $.get('../php/getUserLabInfo.php?job='+localStorage.getItem('job')+'&userID='+localStorage.getItem('userID')).done(function(result_lab){
    alert(result_lab);
    var result_json = $.parseJSON(result_lab);
    var labList = document.getElementById('lablist');
    $.each(result_json, function(index, val){
      labList.append(val['LabID']);
      labList.append(val['CourseName']);
      labList.append(val['CourseNumber']);
    });
  });



});
