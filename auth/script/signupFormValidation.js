// check email format
document.registration.email.addEventListener("change", emailvalid);

function emailvalid() {
  let valid = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

  let email = document.registration.email.value;

  if (!email.match(valid)) {
    document.getElementById("email").innerHTML = "Invalid email address";

    return false;
  } else {
    document.getElementById("email").innerHTML = "";

    return true;
  }
}

// check password format
document.registration.password.addEventListener("change", passwordvalid);

function passwordvalid() {
  let valid =
    /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/;

  let password = document.registration.password.value;

  if (!password.match(valid)) {
    document.getElementById("valid").innerHTML =
      "The password must contain at least one lowercase letter, one uppercase letter, one numeric digit, and one special character";

    return false;
  } else {
    document.getElementById("valid").innerHTML = "";

    return true;
  }
}

// check password and confirm password
document.registration.confirm_password.addEventListener(
  "change",
  checkpassword
);

function checkpassword() {
  let password = document.registration.password.value;
  let cpassword = document.registration.confirm_password.value;

  if (password !== cpassword) {
    document.getElementById("check").innerHTML =
      "The password confirmation does not match";

    return false;
  } else {
    document.getElementById("check").innerHTML = "";

    return true;
  }
}

document.registration.birthday.addEventListener("change", checkage);

function checkage() {
  let birthday = document.registration.birthday.value;

  // it will accept two types of format yyyy-mm-dd and yyyy/mm/dd
  // var optimizedBirthday = birthday.replace(/-/g, "/");

  //set date based on birthday at 01:00:00 hours GMT+0100 (CET)
  var myBirthday = new Date(birthday);

  // set current day on 01:00:00 hours GMT+0100 (CET)
  var currentDate = new Date().toJSON().slice(0, 10) + " 01:00:00";

  // calculate age comparing current date and borthday
  var age = ~~((Date.now(currentDate) - myBirthday) / 31557600000);

  if (age < 18) {
    document.getElementById("age").innerHTML = "Must be 18 or above";

    return false;
  } else if (age > 200) {
    document.getElementById("age").innerHTML = "Invalid Age";

    return false;
  } else {
    document.getElementById("age").innerHTML = "";

    return true;
  }
}

// check Singapore phone number
document.registration.phoneNo.addEventListener("change", checkPhone)

function checkPhone() {



  let phoneNo = document.registration.phoneNo.value

  let valid = /^[89]\d{7}$/

  if (!phoneNo.match(valid)) {

    document.getElementById("phoneNo").innerHTML = "Invalid Phone Number"

    return (false);


  } else {

    document.getElementById("phoneNo").innerHTML = ""

    return (true);

  }

}

// check all
function regvalidate() {
  if (
    !emailvalid() ||
    !passwordvalid() ||
    !checkpassword() ||
    !checkage() ||
    !checkPhone()
  ) {
    alert("Please make sure all inputs are correct.");

    return false;
  }
}
