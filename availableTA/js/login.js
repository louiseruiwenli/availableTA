$(document).ready(function(){
    $("#username").keypress(function(event){
        if(event.keyCode == 13){
            $("#login").click();
        }
    });

    $("#password").keypress(function(event){
        if(event.keyCode == 13){
            $("#login").click();
        }
    });
});

function loginapply(){
  var username = $("#username").val();
  var password = $("#password").val();

  $.get('../php/login.php?username='+username+'&password='+password).done(function(result){
      if(result=='Login'){
        localStorage.setItem('username',$("#username").val());
        window.location.href = '../index.php';
      }else if (result=='WrongPass'){
        alert('Invalid combination of username and password');
      }else if (result=='NoUser') {
        alert('Username does not exist');
      }else if (result == 'Error'){
        alert('Oops! Something went wrong. Please try again later.');
      }else if (result == 'EmptyUser') {
        alert('Please enter username');
      }else if (result == 'EmptyPass') {
        alert('Please enter password');
      }
  })
}
