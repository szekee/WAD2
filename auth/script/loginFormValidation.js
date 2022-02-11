// check email format
document.login.email.addEventListener("change", emailvalid);

function emailvalid() {
  let valid = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

  let email = document.login.email.value;

  if (!email.match(valid)) {
    document.getElementById("email").innerHTML = "Invalid email address";

    return false;
  } else {
    document.getElementById("email").innerHTML = "";

    return true;
  }
}

function logvalidate() {
  if (!emailvalid()) {
    alert("Please enter a valid email address");

    return false;
  }
}
