function initialization(){
  localStorage.clear();
}


function loginapply(){
  localStorage.clear();
  var username = $("#username").val();
  var password = $("#password").val();

  alert("Attempting to login...");
  $.get('/login.php?username='+username+'&password='+password).done(function(result){
      alert(result);
      var result_json = $.parseJSON(result);

      if(result_json=="Login"){
        localStorage.setItem('username',$("#username").val());
        //alert(localStorage.getItem('username'));
        window.location.href = 'index.html';
      }else if (result_json=="WrongPass"){
        alert('Invalid combination of username and password');
      }else if (result_json=="NoUser") {
        alert('Username does not exist');
      }else if (result_json == "Error"){
        alert('Oops! Something went wrong. Please try again later.');
      }else if (result_json == "EmptyUser") {
        alert('Please enter username');
      }else if (result_json == "EmptyPass") {
        alert('Please enter password');
      }
  });
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
