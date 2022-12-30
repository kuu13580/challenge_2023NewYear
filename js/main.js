$(function () {
  const mail = $("#mail-address");
  const mail_annotation = $("#mail-annotation");
  const password = $("#password");
  const password_annotation = $("#password-annotation");
  const mail_regex = /^[a-zA-Z0-9_.+-]+@([a-zA-Z0-9][a-zA-Z0-9-]*[a-zA-Z0-9]*\.)+[a-zA-Z]{2,}$/
  const password_regex = /^[a-zA-Z0-9]{4,20}$/
  const submit_btn = $("#submit-btn");
  const agreement = $("#agreement");
  const agreement_annotation = $("#agreement-annotation");
  const form = $("#register-form");

  function mailValidation() {
    if (mail_regex.test(mail.val())) { // 有効なメールアドレス
      mail_annotation.css("visibility", "hidden");
      return true;
    }
    // 無効なメールアドレス
    mail_annotation.css("visibility", "visible");
    return false;
  }
  function passValidation() {
    if (password_regex.test(password.val())) { // 有効なパスワード
      password_annotation.css("visibility", "hidden");
      return true;
    }
    // 無効なパスワード
    password_annotation.css("visibility", "visible");
    return false;
  }
  function agreementCheck() {
    if (agreement.prop("checked") == true) { // 同意済み
      agreement_annotation.css("visibility", "hidden");
      return true;
    } 
    agreement_annotation.css("visibility", "visible");
    return false;
  }

  mail.blur(mailValidation);
  password.blur(passValidation);
  submit_btn.click(() => {
    let check = mailValidation()
    check = passValidation() && check;
    check = agreementCheck() && check;
    if(check) form.submit();
  });
});