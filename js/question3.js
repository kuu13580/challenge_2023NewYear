$(function () {

  if (!localStorage.hasOwnProperty("reload_count")) {
    localStorage.setItem("reload_count", 1);
    $(".first-message").fadeTo(1000,1);
  } else {
    localStorage.setItem("reload_count", Number(localStorage.getItem("reload_count")) + 1);
    (async () => {
      console.time('Waited for');
      await new Promise(resolve => setTimeout(resolve, 5000));
      console.timeLog('Waited for');
      if (localStorage.getItem("reload_count") == 10) {
        window.alert("hello");
      }
      localStorage.setItem("reload_count", 1);
      $(".first-message").fadeTo(1000,1);
    })();
  }


});