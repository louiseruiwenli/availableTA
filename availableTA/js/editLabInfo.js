$(document).ready(function(){
  //alert(localStorage.getItem('username'));
  if(window.localStorage.getItem('username')===null){
    alert("No username");
    window.location.href = '../login.html';
  }
  var username = localStorage.getItem('username');
  var userID = localStorage.getItem('userID');
  var job = localStorage.getItem('job');

  $.get('../php/getAllLabInfo.php').done(function(result){
    //alert(result);
    var result_json = $.parseJSON(result);
    var form = document.createElement("form");
    $(form).addClass('form-group')
           .attr('id','labcheckboxes')
           .appendTo($('#lablist'));
    $.each(result_json, function(key, val){
      var p = document.createElement("p");
      $(p).html(val['LabID']+'&nbsp;'+val['CourseNumber'])
          .addClass('col-md-6')
          .appendTo($(form));
      var checkbox = document.createElement("input");
      $(checkbox).attr('type','checkbox')
                 .attr('name','lablist')
                 .attr('value',val['LabID'])
                 .prependTo($(p));

      if(val['TA_ID']==userID || val['Prof_ID']==userID){
        $(checkbox).attr('checked',true);
      }
    });

  });

  $.get('../php/getUserLabInfo.php?job='+job+'&userID='+userID).done(function(result_lab){
    //alert(result_lab);
    var result_json = $.parseJSON(result_lab);
    $.each(result_json, function(index, val){
      var p = document.createElement('p');
      $(p).html(val['LabID']+'&nbsp;'+val['CourseNumber']).appendTo($('#userlablist'));
      var deleteLab = document.createElement('button');
      $(deleteLab).addClass('btn')
                  .addClass('btn-warning')
                  .html('delete')
                  .attr('type','reset')
                  .prependTo($(p))
                  .click(function(){
                    $.get('../php/editLabInfo.php?action=delete&job='+job+'&labID='+val['LabID']).done(function(result){
                      alert('Delete Success');
                      window.location.href = '../editLabInfo.html';

                    });
                    //$('#userlablist').remove($(p));

                  });
    });

  });
});

function updateinfo(){
  var job = localStorage.getItem('job');
  var userID = localStorage.getItem('userID');

  $.each($("input[name='lablist']:checked"),function(){

    $.get('../php/editLabInfo.php?action=update&job='+job+'&userID='+userID+'&labID='+$(this).val()).done(function(result){

      window.location.href = '../viewProfile.html';


    });
  });

}
