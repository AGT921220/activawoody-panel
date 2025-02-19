function toggleSideMenu(state) {
  var aside = document.querySelector("aside");

  if (state) {
    aside.dataset.state = "open";
    toggleDocumentOverflow(0);
  } else {
    aside.dataset.state = "close";
    toggleDocumentOverflow(1);
  }
}
function toggleDocumentOverflow(state) {
  if (state) document.documentElement.style.overflow = "auto";
  else document.documentElement.style.overflow = "hidden";
}
function subscribe(e) {
  e.preventDefault();
  var form = e.target;
  changeFormStatus(form, true);
  recaptcha(form, "newsletter", "api/newsletter.html");
}
function contactUs(e) {
  e.preventDefault();
  var form = e.target;
  changeFormStatus(form, true);
  recaptcha(form, "contact_us", "api/contact-us.html");
}
function toolsFeedback(e) {
  e.preventDefault();
  var form = e.target;
  changeFormStatus(form, true);
  recaptcha(form, "feedback", "api/feedback.html");
}
function recaptcha(form, action, endpoint) {
  grecaptcha.ready(function () {
    grecaptcha
      .execute("6Lfm0bUcAAAAADQvyy7t2ph9ZvtsnmofuDJDrqLK", {
        action: action,
      })
      .then(function (token) {
        var data = new FormData(form);
        data.append("token", token);
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
          if (this.readyState == 4 && this.status == 200) {
            handleRes(JSON.parse(xhttp.responseText), form);
          }
        };
        xhttp.open("POST.html", endpoint, true);
        xhttp.send(data);
      });
  });
}
function changeFormStatus(form, status) {
  if (status) {
    form.querySelector("button").disabled = true;
    form.classList.add("submitting");
  } else {
    form.querySelector("button").disabled = false;
    form.classList.remove("submitting");
  }
}
function handleRes(data, form) {
  var error = data.error;
  var responsePar = form.querySelector("p.response");
  changeFormStatus(form, false);
  if (error) {
    responsePar.innerText = "Something went wrong!";
    responsePar.dataset.error = 1;
  } else {
    responsePar.innerText = "Received 🤩";
    responsePar.dataset.error = 0;
  }
}
