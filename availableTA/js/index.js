$(document).ready(function(){
  //check user login status
  if(window.localStorage.getItem('username')===null){
    alert("No username");
    window.location.href = '../login.html';
  }

  //retrieve user information
  var username = localStorage.getItem('username');
  $.get('../php/getJob.php?username='+username).done(function(result){
    //return userID and job
    var result_json = $.parseJSON(result);
    if(result_json=='No Result'){
      alert('Retrieving user information failed. Please refresh the page.');
    }

    var userID = result_json[0]['ID'];
    var job = result_json[0]['TAProf'];

    //Store user info to the browser
    localStorage.setItem('userID', userID);
    localStorage.setItem('job',job);


    $.get('../php/getUserLabInfo.php?job='+localStorage.getItem('job')+'&userID='+localStorage.getItem('userID')).done(function(result_lab){
      //return lab info
      var result_json = $.parseJSON(result_lab);

      if(result_json.length==0){
        $('#lablist').html('You do not have lab covered this quarter');
        alert("No result!!!");
      }

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
        var year = document.createElement("p");
        $(year).html(val['DayOfWeek']+'&nbsp;'+val['QuarterYear']).appendTo($(d));
        var starttime = document.createElement("p");
        $(starttime).html('Start Time: '+val['StartTime']).appendTo($(d));
        var endtime = document.createElement("p");
        $(endtime).html('End Time: '+val['EndTime']).appendTo($(d));
        var request = document.createElement("button");

        $(request).addClass('btn')
                  .addClass('btn-warning')
                  .attr('value',val["LabID"])
                  .html('Request')
                  .appendTo($(d))
                  .click(function(){
                    localStorage.setItem('requestLab',val["LabID"]);
                    window.location.href = 'taList.html';
                  });


      });
    });

    if(localStorage.getItem('job')==1){
      $('#viewschedule').addClass('disabled');
    }
  });

});
