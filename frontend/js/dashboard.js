const id = localStorage.getItem("id");


function logout(){
    localStorage.setItem("id", null);
    window.location = "index.html";
}
document.addEventListener("DOMContentLoaded", function () {

      

  var searchURL =
    "http://localhost/RCalcAppV2/api/r/getUserData/index.php?id=" + id;


  var xhr = new XMLHttpRequest();
  xhr.open("GET", searchURL, true);
  xhr.onload = function (e) {
    if (xhr.readyState === 4) {
      if (xhr.status === 200) {
        var response = JSON.parse(xhr.responseText);

        for (var i = 0; i < response.length; i++) {
          var user = response[i];
          document.getElementById("dashboardHeader").innerHTML = "Welkom terug " + user.voornaam + " " + user.achternaam + "!";
        }
      } else {
        console.error(xhr.statusText);
      }
    }
  };
  xhr.onerror = function (e) {
    console.error(xhr.statusText);
    window.location = "index.html";
  };
  xhr.send(null);
  
});
