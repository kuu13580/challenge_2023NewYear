$(function () {

  if (!localStorage.hasOwnProperty("reload_count")) {
    localStorage.setItem("reload_count", 1);
    $(".first-message").fadeTo(1000,1);
  } else {
    localStorage.setItem("reload_count", Number(localStorage.getItem("reload_count")) + 1);
    (async () => {
      console.time('Waited for');
      await new Promise(resolve => setTimeout(resolve, 2000));
      console.timeLog('Waited for');
      if (localStorage.getItem("reload_count") == 5) {
        window.alert("クリア!");
        location.href = "4sADUQx2xgF.html";
      }
      localStorage.setItem("reload_count", 1);
      $(".first-message").fadeTo(1000,1);
    })();
  }


});