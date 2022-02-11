document.gmail.birthday.addEventListener("change", checkage);

function checkage() {
  let birthday = document.gmail.birthday.value;

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
document.gmail.phoneNo.addEventListener("change", checkPhone);

function checkPhone() {
  let phoneNo = document.gmail.phoneNo.value;

  let valid = /[6|8|9]\d{7}|\+65[6|8|9]\d{7}|\+65\s[6|8|9]\d{7}/;

  if (!phoneNo.match(valid)) {
    document.getElementById("phoneNo").innerHTML = "Invalid Phone Number";

    return false;
  } else {
    document.getElementById("phoneNo").innerHTML = "";

    return true;
  }
}

// check all
function regvalidate() {
  if (!checkage() || !checkPhone()) {
    alert("Please make sure all inputs are correct.");

    return false;
  }
}
