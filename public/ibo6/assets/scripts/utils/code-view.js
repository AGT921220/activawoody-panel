var codeViewers = document.querySelectorAll("div.code-view");

for (var i = 0; i < codeViewers.length; i++) {
  var codeView = codeViewers[i];
  var checkedRadio = codeView.querySelector('input[type="radio"]:checked');

  var id = checkedRadio.dataset.id;

  codeView.querySelector(
    'div.code-view-code-container[data-id="' + id + '"]'
  ).dataset.active = 1;

  codeView.querySelector(
    'div.code-view-code-container[data-id="' + id + '"]'
  ).style.display = "block";
}
highlight();
function highlight() {
  var blocks = document.querySelectorAll("pre code");
  for (var x = 0; x < blocks.length; x++) {
    var block = blocks[x];
    hljs.highlightBlock(block);
  }
}
function copyCode(btn) {
  var codeView = btn.parentNode.parentNode.parentNode;

  var code = codeView.querySelector(
    'div.code-view-content div[data-active="1"]'
  ).innerText;

  var textarea = document.createElement("textarea");

  textarea.style.position = "fixed";
  textarea.style.bottom = 0;
  textarea.style.opacity = 0;

  document.body.appendChild(textarea);

  textarea.value = code.trim();
  textarea.select();
  textarea.setSelectionRange(0, 9999999);

  document.execCommand("copy");

  document.body.removeChild(textarea);

  var codeViewAlert = codeView.querySelector("div.code-view-alert");
  codeViewAlert.dataset.visible = 1;

  var codeViewAlertTimeOut = setTimeout(function () {
    codeViewAlert.dataset.visible = 0;
  }, 1900);
}
function changeCodeView(radio) {
  var toToggle = radio.dataset.id;
  var codeView = radio.parentNode.parentNode.parentNode.parentNode;

  codeView.querySelector(
    'div.code-view-code-container[data-active="1"]'
  ).style.display = "none";

  codeView.querySelector(
    'div.code-view-code-container[data-active="1"]'
  ).dataset.active = 0;

  codeView.querySelector(
    'div.code-view-code-container[data-id="' + toToggle + '"]'
  ).dataset.active = 1;

  codeView.querySelector(
    'div.code-view-code-container[data-id="' + toToggle + '"]'
  ).style.display = "block";
}
