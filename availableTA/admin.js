$(document).ready(function(){
  //check user login status
  if(localStorage.getItem('admin')===null){
    alert("You do not have permission for this page.");
    window.location.href = 'loginAdmin.html';
  }


});
