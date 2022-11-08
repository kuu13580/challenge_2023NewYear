$(function(){
  $(".answer").css("right", - window.innerWidth / 2 + "px");
  $(".answer").on("click", (e) => {
    window.alert("タップされた");
  });
  
});