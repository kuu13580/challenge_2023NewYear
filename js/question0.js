$(function () {
  const secred_answer = 243214;
  const digits = 1000000;
  let queue = 0;
  $(".container").on("click", ".tab", (e) => {
    let number = Number($(e.currentTarget).data("number"));
    $(".tab").removeClass("selected");
    $("#tab" + String(number)).addClass("selected");
    $(".content > div").addClass("not-selected");
    $("#question" + String(number)).addClass("not-selected");
    $(".content > div").removeClass("is-selected");
    $("#question" + number).addClass("is-selected");
    queue = (queue * 10 + number) % digits;
    if(queue == secred_answer) window.location.href = "1eJ9du4fFfR.html";
  });
});