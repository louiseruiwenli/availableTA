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
    //var labList = document.getElementById('lablist');
    $.each(result_json, function(index, val){
      var d = document.createElement("div");
      $(d).addClass('labinfo')
          .addClass('text-left')
          .appendTo($('#lablist'));
      var h4 = document.createElement("h4");
      $(h4).html(val['CourseNumber']).appendTo($(d));
      var labid = document.createElement("p");
      $(labid).html(val['LabID']).appendTo($(d));
      var coursename = document.createElement("p");
      $(coursename).html(val['CourseName']).appendTo($(d));
      var starttime = document.createElement("p");
      $(starttime).html('Start Time: '+val['StartTime']).appendTo($(d));
      var endtime = document.createElement("p");
      $(endtime).html('End Time: '+val['EndTime']).appendTo($(d));
      var request = document.createElement("button");
      $(request).addClass('btn')
                .addClass('btn-warning')
                .html('Request')
                .appendTo($(d))
                .click(function(){
                  alert('test');
                });


    });
  });



});
