$(function(){
  $(".answer").on("click", (e) => {
    window.alert("Clear");
    location.href = "clearchallenge.php";
  });
  
  if (!localStorage.hasOwnProperty("reload_count_2")) {
    localStorage.setItem("reload_count_2", 1);
  } else {
    localStorage.setItem("reload_count_2", Number(localStorage.getItem("reload_count_2")) + 1);
    (async () => {
      console.time('Waited for');
      await new Promise(resolve => setTimeout(resolve, 5000));
      console.timeLog('Waited for');
      if (localStorage.getItem("reload_count_2") == 7) {
        $(".answer").css("right", - window.innerWidth / 2 + "px");
      }
      localStorage.setItem("reload_count_2", 1);
    })();
  }

});