$(function () {
  localStorage.setItem("moji_count", 0);
  $(".moji").on("click", (e) => {
    let date = new Date();
    let check_hour = date.getHours() == 1 || (10 <= date.getHours() && date.getHours() < 20);
    let check_minute = date.getMinutes() % 10 == 1 || (10 <= date.getMinutes() && date.getMinutes() < 20);
    if(check_hour || check_minute){
      localStorage.setItem("moji_count", Number(localStorage.getItem("moji_count")) + 1);
      if(localStorage.getItem("moji_count") == 10){
        window.alert("クリア！");
        location.href = "2egHi5ZxmcQ.html" ;
      }
    }
  });


});