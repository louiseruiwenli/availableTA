function initialization(){
  localStorage.clear();
}

function loginapply(){
  localStorage.clear();
  var username = $("#username").val();
  var password = $("#password").val();

  $.get('login.php?username='+username+'&password='+password).done(function(result){

      var result_json = $.parseJSON(result);

      if(result_json=="Login"){
        localStorage.setItem('username',$("#username").val());
        //alert(localStorage.getItem('username'));
        window.location.href = 'index.html';
      }else if (result=="WrongPass"){
        alert('Invalid combination of username and password');
      }else if (result=="NoUser") {
        alert('Username does not exist');
      }else if (result == "Error"){
        alert('Oops! Something went wrong. Please try again later.');
      }else if (result == "EmptyUser") {
        alert('Please enter username');
      }else if (result == "EmptyPass") {
        alert('Please enter password');
      }
  })
}

$('#logout').click(function(e){
  e.preventDefault();
  localStorage.clear();
  localStorage.removeItem('job');
  localStorage.removeItem('username');
  localStorage.removeItem('userID');
  var href = $(this).attr('href');
  window.location = href;
});

function logoutapply(){
  $.get('logout.php').done(function(){
    localStorage.clear();
    location.href = 'login.html';
  });
}
