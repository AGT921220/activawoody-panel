var button = {
  previewBackground: "#fff",
  text: {
    color: "#fff",
    buttonText: "Button Generator",
    className: "my-button",
    fontFamily: "Trebuchet MS",
    fontStyle: { bold: true, italic: false },
    fontSize: 18,
  },
  icon: {
    enabled: true,
    rotation: 0,
    position: "left",
    name: "devsdash",
    size: 29,
  },
  size: {
    horizontal: 15,
    vertical: 14,
  },
  border: {
    color: "#000",
    size: 0,
    radius: 10,
  },
  background: {
    color: "#196BCA",
    gradient: true,
    gradientColor: "#6433E0",
  },
  boxShadow: {
    enabled: false,
    inset: false,
    color: "#2D2D2D",
    horizontal: 0,
    vertical: 0,
    blur: 10,
    spread: 0,
  },
  textShadow: {
    enabled: false,
    color: "#000",
    horizontal: 2,
    vertical: 2,
    blur: 0,
  },
  actions: {
    click: {
      enabled: true,
      effect: "shrink",
    },
    hover: {
      enabled: true,
      effect: "lighten",
    },
    url: "",
  },
};
var icons = {
  devsdash:
    "data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB3aWR0aD0iMTUwIiBoZWlnaHQ9IjE1MCIgdmlld0JveD0iMCAwIDE1MCAxNTAiPg0KICA8ZGVmcz4NCiAgICA8Y2xpcFBhdGggaWQ9ImNsaXAtcGF0aCI+DQogICAgICA8cmVjdCB4PSItNCIgeT0iLTI1IiB3aWR0aD0iMTUwIiBoZWlnaHQ9IjE1MCIgZmlsbD0ibm9uZSIvPg0KICAgIDwvY2xpcFBhdGg+DQogICAgPGNsaXBQYXRoIGlkPSJjbGlwLXBhdGgtMiI+DQogICAgICA8cmVjdCBpZD0iUmVjdGFuZ2xlXzEiIGRhdGEtbmFtZT0iUmVjdGFuZ2xlIDEiIHdpZHRoPSIxNDIiIGhlaWdodD0iMTAwIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgxMC4zMzMgOS4xMjgpIiBmaWxsPSJub25lIi8+DQogICAgPC9jbGlwUGF0aD4NCiAgICA8bGluZWFyR3JhZGllbnQgaWQ9ImxpbmVhci1ncmFkaWVudCIgeDE9IjAuOTg2IiB5MT0iMC41MDciIHgyPSItMC4wMjgiIHkyPSIwLjUyMiIgZ3JhZGllbnRVbml0cz0ib2JqZWN0Qm91bmRpbmdCb3giPg0KICAgICAgPHN0b3Agb2Zmc2V0PSIwIiBzdG9wLWNvbG9yPSIjZmZmIi8+DQogICAgICA8c3RvcCBvZmZzZXQ9IjAuNTMxIiBzdG9wLWNvbG9yPSIjZDlkOWQ5Ii8+DQogICAgICA8c3RvcCBvZmZzZXQ9IjEiIHN0b3AtY29sb3I9ImdyYXkiLz4NCiAgICA8L2xpbmVhckdyYWRpZW50Pg0KICAgIDxsaW5lYXJHcmFkaWVudCBpZD0ibGluZWFyLWdyYWRpZW50LTIiIHgxPSIwLjk4NiIgeTE9IjAuNDkzIiB4Mj0iLTAuMDI4IiB5Mj0iMC40NzgiIHhsaW5rOmhyZWY9IiNsaW5lYXItZ3JhZGllbnQiLz4NCiAgPC9kZWZzPg0KICA8ZyBpZD0iU2Nyb2xsX0dyb3VwXzEiIGRhdGEtbmFtZT0iU2Nyb2xsIEdyb3VwIDEiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDQgMjUpIiBjbGlwLXBhdGg9InVybCgjY2xpcC1wYXRoKSIgc3R5bGU9Imlzb2xhdGlvbjogaXNvbGF0ZSI+DQogICAgPGcgaWQ9ImxvZ28tdyIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoLTEwLjMzMyAtOS4xMjgpIiBjbGlwLXBhdGg9InVybCgjY2xpcC1wYXRoLTIpIj4NCiAgICAgIDxnIGlkPSJHcm91cF80MCIgZGF0YS1uYW1lPSJHcm91cCA0MCIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoNC45NDEgNC40ODkpIj4NCiAgICAgICAgPGcgaWQ9Ikdyb3VwXzM4IiBkYXRhLW5hbWU9Ikdyb3VwIDM4IiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgwIDAuMDAxKSI+DQogICAgICAgICAgPHJlY3QgaWQ9IlJlY3RhbmdsZV82MyIgZGF0YS1uYW1lPSJSZWN0YW5nbGUgNjMiIHdpZHRoPSI3NS44ODciIGhlaWdodD0iMjUuMjk2IiByeD0iMTIuNjQ4IiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgxOC4wMzMgMzcuMjI1KSByb3RhdGUoNDUpIiBmaWxsPSJ1cmwoI2xpbmVhci1ncmFkaWVudCkiLz4NCiAgICAgICAgICA8cmVjdCBpZD0iUmVjdGFuZ2xlXzY0IiBkYXRhLW5hbWU9IlJlY3RhbmdsZSA2NCIgd2lkdGg9Ijc1Ljg4NyIgaGVpZ2h0PSIyNS4yOTYiIHJ4PSIxMi42NDgiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDAgNTMuNjYpIHJvdGF0ZSgtNDUpIiBmaWxsPSIjZmZmIi8+DQogICAgICAgICAgPGNpcmNsZSBpZD0iRWxsaXBzZV8xIiBkYXRhLW5hbWU9IkVsbGlwc2UgMSIgY3g9IjcuODQyIiBjeT0iNy44NDIiIHI9IjcuODQyIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgxMS4xMyA0NS4wODEpIiBmaWxsPSIjZDlkYmZmIi8+DQogICAgICAgIDwvZz4NCiAgICAgICAgPGcgaWQ9Ikdyb3VwXzM5IiBkYXRhLW5hbWU9Ikdyb3VwIDM5IiB0cmFuc2Zvcm09InRyYW5zbGF0ZSg4MC4wNzkgMCkiPg0KICAgICAgICAgIDxyZWN0IGlkPSJSZWN0YW5nbGVfNjMtMiIgZGF0YS1uYW1lPSJSZWN0YW5nbGUgNjMiIHdpZHRoPSI3NS44ODciIGhlaWdodD0iMjUuMjk2IiByeD0iMTIuNjQ4IiB0cmFuc2Zvcm09InRyYW5zbGF0ZSg3MS41NDcgNTUuMTEyKSByb3RhdGUoMTM1KSIgZmlsbD0idXJsKCNsaW5lYXItZ3JhZGllbnQtMikiLz4NCiAgICAgICAgICA8cmVjdCBpZD0iUmVjdGFuZ2xlXzY0LTIiIGRhdGEtbmFtZT0iUmVjdGFuZ2xlIDY0IiB3aWR0aD0iNzUuODg3IiBoZWlnaHQ9IjI1LjI5NiIgcng9IjEyLjY0OCIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoNTMuODA3IDcxLjU0Nykgcm90YXRlKC0xMzUpIiBmaWxsPSIjZmZmIi8+DQogICAgICAgICAgPGNpcmNsZSBpZD0iRWxsaXBzZV8xLTIiIGRhdGEtbmFtZT0iRWxsaXBzZSAxIiBjeD0iNy44NDIiIGN5PSI3Ljg0MiIgcj0iNy44NDIiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDQ0Ljg4IDQ1LjA4MikiIGZpbGw9IiNkOWRiZmYiLz4NCiAgICAgICAgPC9nPg0KICAgICAgPC9nPg0KICAgIDwvZz4NCiAgPC9nPg0KPC9zdmc+DQo=",
  imported_icon:
    "data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB3aWR0aD0iMTUwIiBoZWlnaHQ9IjE1MCIgdmlld0JveD0iMCAwIDE1MCAxNTAiPg0KICA8ZGVmcz4NCiAgICA8Y2xpcFBhdGggaWQ9ImNsaXAtcGF0aCI+DQogICAgICA8cmVjdCB4PSItNCIgeT0iLTI1IiB3aWR0aD0iMTUwIiBoZWlnaHQ9IjE1MCIgZmlsbD0ibm9uZSIvPg0KICAgIDwvY2xpcFBhdGg+DQogICAgPGNsaXBQYXRoIGlkPSJjbGlwLXBhdGgtMiI+DQogICAgICA8cmVjdCBpZD0iUmVjdGFuZ2xlXzEiIGRhdGEtbmFtZT0iUmVjdGFuZ2xlIDEiIHdpZHRoPSIxNDIiIGhlaWdodD0iMTAwIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgxMC4zMzMgOS4xMjgpIiBmaWxsPSJub25lIi8+DQogICAgPC9jbGlwUGF0aD4NCiAgICA8bGluZWFyR3JhZGllbnQgaWQ9ImxpbmVhci1ncmFkaWVudCIgeDE9IjAuOTg2IiB5MT0iMC41MDciIHgyPSItMC4wMjgiIHkyPSIwLjUyMiIgZ3JhZGllbnRVbml0cz0ib2JqZWN0Qm91bmRpbmdCb3giPg0KICAgICAgPHN0b3Agb2Zmc2V0PSIwIiBzdG9wLWNvbG9yPSIjZmZmIi8+DQogICAgICA8c3RvcCBvZmZzZXQ9IjAuNTMxIiBzdG9wLWNvbG9yPSIjZDlkOWQ5Ii8+DQogICAgICA8c3RvcCBvZmZzZXQ9IjEiIHN0b3AtY29sb3I9ImdyYXkiLz4NCiAgICA8L2xpbmVhckdyYWRpZW50Pg0KICAgIDxsaW5lYXJHcmFkaWVudCBpZD0ibGluZWFyLWdyYWRpZW50LTIiIHgxPSIwLjk4NiIgeTE9IjAuNDkzIiB4Mj0iLTAuMDI4IiB5Mj0iMC40NzgiIHhsaW5rOmhyZWY9IiNsaW5lYXItZ3JhZGllbnQiLz4NCiAgPC9kZWZzPg0KICA8ZyBpZD0iU2Nyb2xsX0dyb3VwXzEiIGRhdGEtbmFtZT0iU2Nyb2xsIEdyb3VwIDEiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDQgMjUpIiBjbGlwLXBhdGg9InVybCgjY2xpcC1wYXRoKSIgc3R5bGU9Imlzb2xhdGlvbjogaXNvbGF0ZSI+DQogICAgPGcgaWQ9ImxvZ28tdyIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoLTEwLjMzMyAtOS4xMjgpIiBjbGlwLXBhdGg9InVybCgjY2xpcC1wYXRoLTIpIj4NCiAgICAgIDxnIGlkPSJHcm91cF80MCIgZGF0YS1uYW1lPSJHcm91cCA0MCIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoNC45NDEgNC40ODkpIj4NCiAgICAgICAgPGcgaWQ9Ikdyb3VwXzM4IiBkYXRhLW5hbWU9Ikdyb3VwIDM4IiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgwIDAuMDAxKSI+DQogICAgICAgICAgPHJlY3QgaWQ9IlJlY3RhbmdsZV82MyIgZGF0YS1uYW1lPSJSZWN0YW5nbGUgNjMiIHdpZHRoPSI3NS44ODciIGhlaWdodD0iMjUuMjk2IiByeD0iMTIuNjQ4IiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgxOC4wMzMgMzcuMjI1KSByb3RhdGUoNDUpIiBmaWxsPSJ1cmwoI2xpbmVhci1ncmFkaWVudCkiLz4NCiAgICAgICAgICA8cmVjdCBpZD0iUmVjdGFuZ2xlXzY0IiBkYXRhLW5hbWU9IlJlY3RhbmdsZSA2NCIgd2lkdGg9Ijc1Ljg4NyIgaGVpZ2h0PSIyNS4yOTYiIHJ4PSIxMi42NDgiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDAgNTMuNjYpIHJvdGF0ZSgtNDUpIiBmaWxsPSIjZmZmIi8+DQogICAgICAgICAgPGNpcmNsZSBpZD0iRWxsaXBzZV8xIiBkYXRhLW5hbWU9IkVsbGlwc2UgMSIgY3g9IjcuODQyIiBjeT0iNy44NDIiIHI9IjcuODQyIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgxMS4xMyA0NS4wODEpIiBmaWxsPSIjZDlkYmZmIi8+DQogICAgICAgIDwvZz4NCiAgICAgICAgPGcgaWQ9Ikdyb3VwXzM5IiBkYXRhLW5hbWU9Ikdyb3VwIDM5IiB0cmFuc2Zvcm09InRyYW5zbGF0ZSg4MC4wNzkgMCkiPg0KICAgICAgICAgIDxyZWN0IGlkPSJSZWN0YW5nbGVfNjMtMiIgZGF0YS1uYW1lPSJSZWN0YW5nbGUgNjMiIHdpZHRoPSI3NS44ODciIGhlaWdodD0iMjUuMjk2IiByeD0iMTIuNjQ4IiB0cmFuc2Zvcm09InRyYW5zbGF0ZSg3MS41NDcgNTUuMTEyKSByb3RhdGUoMTM1KSIgZmlsbD0idXJsKCNsaW5lYXItZ3JhZGllbnQtMikiLz4NCiAgICAgICAgICA8cmVjdCBpZD0iUmVjdGFuZ2xlXzY0LTIiIGRhdGEtbmFtZT0iUmVjdGFuZ2xlIDY0IiB3aWR0aD0iNzUuODg3IiBoZWlnaHQ9IjI1LjI5NiIgcng9IjEyLjY0OCIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoNTMuODA3IDcxLjU0Nykgcm90YXRlKC0xMzUpIiBmaWxsPSIjZmZmIi8+DQogICAgICAgICAgPGNpcmNsZSBpZD0iRWxsaXBzZV8xLTIiIGRhdGEtbmFtZT0iRWxsaXBzZSAxIiBjeD0iNy44NDIiIGN5PSI3Ljg0MiIgcj0iNy44NDIiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDQ0Ljg4IDQ1LjA4MikiIGZpbGw9IiNkOWRiZmYiLz4NCiAgICAgICAgPC9nPg0KICAgICAgPC9nPg0KICAgIDwvZz4NCiAgPC9nPg0KPC9zdmc+DQo=",
};
var previewBackgroundPickr = Pickr.create({
  el: ".preview-background-color-picker",
  theme: "classic",
  container: document.querySelector(
    "div.preview-background-color-picker-container"
  ),
  default: button.previewBackground,

  components: {
    preview: true,
    hue: true,

    interaction: {
      hex: true,
      rgba: true,
      input: true,
    },
  },
});
previewBackgroundPickr.on("init", function (instance) {
  instance._root.button.style.background = button.previewBackground;
});
var textColorPickr = Pickr.create({
  el: ".text-color-picker",
  theme: "classic",
  container: document.querySelector("div.text-color-picker-container"),
  default: button.text.color,

  components: {
    preview: true,
    hue: true,

    interaction: {
      hex: true,
      rgba: true,
      input: true,
    },
  },
});
textColorPickr.on("init", function (instance) {
  instance._root.button.style.background = button.text.color;
});
var borderColorPickr = Pickr.create({
  el: ".border-color-picker",
  theme: "classic",
  container: document.querySelector("div.border-color-picker-container"),
  default: button.border.color,

  components: {
    preview: true,
    hue: true,

    interaction: {
      hex: true,
      rgba: true,
      input: true,
    },
  },
});
borderColorPickr.on("init", function (instance) {
  instance._root.button.style.background = button.border.color;
});
var backgroundColorPickr = Pickr.create({
  el: ".background-color-picker",
  theme: "classic",
  container: document.querySelector("div.background-color-picker-container"),
  default: button.background.color,

  components: {
    preview: true,
    hue: true,

    interaction: {
      hex: true,
      rgba: true,
      input: true,
    },
  },
});
backgroundColorPickr.on("init", function (instance) {
  instance._root.button.style.background = button.background.color;
});
var backgroundGradientColorPickr = Pickr.create({
  el: ".background-gradient-color-picker",
  theme: "classic",
  container: document.querySelector(
    "div.background-gradient-color-picker-container"
  ),
  default: button.background.gradientColor,

  components: {
    preview: true,
    hue: true,

    interaction: {
      hex: true,
      rgba: true,
      input: true,
    },
  },
});
backgroundGradientColorPickr.on("init", function (instance) {
  instance._root.button.style.background = button.background.gradientColor;
});
var boxShadowColorPickr = Pickr.create({
  el: ".box-shadow-color-picker",
  theme: "classic",
  container: document.querySelector("div.box-shadow-color-picker-container"),
  default: button.boxShadow.color,

  components: {
    preview: true,
    hue: true,

    interaction: {
      hex: true,
      rgba: true,
      input: true,
    },
  },
});
boxShadowColorPickr.on("init", function (instance) {
  instance._root.button.style.background = button.boxShadow.color;
});
var textShadowColorPickr = Pickr.create({
  el: ".text-shadow-color-picker",
  theme: "classic",
  container: document.querySelector("div.text-shadow-color-picker-container"),
  default: button.textShadow.color,

  components: {
    preview: true,
    hue: true,

    interaction: {
      hex: true,
      rgba: true,
      input: true,
    },
  },
});
textShadowColorPickr.on("init", function (instance) {
  instance._root.button.style.background = button.textShadow.color;
});
previewBackgroundPickr.on("change", function (color, source, instance) {
  var colorOutput = "#" + color.toHEXA(color).join("");
  button.previewBackground = colorOutput;
  instance._root.button.style.background = colorOutput;
  updatePreview();
});
textColorPickr.on("change", function (color, source, instance) {
  var colorOutput = "#" + color.toHEXA(color).join("");
  button.text.color = colorOutput;
  instance._root.button.style.background = colorOutput;
  updatePreview();
});
borderColorPickr.on("change", function (color, source, instance) {
  var colorOutput = "#" + color.toHEXA(color).join("");
  button.border.color = colorOutput;
  instance._root.button.style.background = colorOutput;
  updatePreview();
});
backgroundColorPickr.on("change", function (color, source, instance) {
  var colorOutput = "#" + color.toHEXA(color).join("");
  button.background.color = colorOutput;
  instance._root.button.style.background = colorOutput;
  updatePreview();
});
backgroundGradientColorPickr.on("change", function (color, source, instance) {
  var colorOutput = "#" + color.toHEXA(color).join("");
  button.background.gradientColor = colorOutput;
  instance._root.button.style.background = colorOutput;
  updatePreview();
});
boxShadowColorPickr.on("change", function (color, source, instance) {
  var colorOutput = color.toRGBA(color);
  colorOutput[3] = colorOutput[3] / 2;
  button.boxShadow.color = "rgba(" + colorOutput.join(",") + ")";
  instance._root.button.style.background = colorOutput;
  updatePreview();
});
textShadowColorPickr.on("change", function (color, source, instance) {
  var colorOutput = "#" + color.toHEXA(color).join("");
  button.textShadow.color = colorOutput;
  instance._root.button.style.background = colorOutput;
  updatePreview();
});
function handleInputChange(input) {
  var category = input.dataset.category;
  var name = input.dataset.name;
  var value = input.value;
  var sub = input.dataset.sub;

  if (input.type == "checkbox") {
    if (sub) {
      button[category][sub][name] = input.checked;
    } else {
      button[category][name] = input.checked;
    }
    updatePreview();
    return;
  }

  if (value === "imported_icon") importIcon(input);

  if (sub) {
    button[category][sub][name] = value;
  } else {
    button[category][name] = value;
  }

  updatePreview();

  if (input.type == "range") {
    input.parentNode.querySelector("p.range-value span").innerText = value;
  }
}
function updatePreview() {
  var container = document.querySelector("div.preview-box");

  container.style.backgroundColor = button.previewBackground;

  container.innerHTML = generatePreviewHTML();

  container.querySelector("button").style.cssText =
    CSSCode().buttonCSS.join(";");

  if (button.icon.enabled)
    container.querySelector("button span").style.cssText =
      CSSCode().iconCSS.join(";");

  updateCode();
}
function generatePreviewHTML() {
  var text = button.text;
  var buttonText = text.buttonText;

  var classes = [];

  var actions = button.actions;
  var click = actions.click;
  var hover = actions.hover;

  if (click.enabled) classes.push(click.effect + "-effect");
  if (hover.enabled) classes.push(hover.effect + "-effect");

  var onClickEvent = "";
  if (actions.url != "") onClickEvent = 'window.open("' + actions.url + '");';

  var icon = button.icon;
  if (icon.enabled) {
    var iconPos = icon.position;
    switch (iconPos) {
      case "left":
        return (
          "<button onclick='" +
          onClickEvent +
          "' class='" +
          classes.join(" ") +
          "'><span></span>" +
          buttonText +
          "</button>"
        );
      case "right":
        return (
          "<button onclick='" +
          onClickEvent +
          "' class='" +
          classes.join(" ") +
          "'>" +
          buttonText +
          "<span></span></button>"
        );
      case "top":
        return (
          "<button onclick='" +
          onClickEvent +
          "' class='" +
          classes.join(" ") +
          "'><span></span>" +
          buttonText +
          "</button>"
        );
      case "bottom":
        return (
          "<button onclick='" +
          onClickEvent +
          "' class='" +
          classes.join(" ") +
          "'>" +
          buttonText +
          "<span></span></button>"
        );
    }
  }
  return (
    "<button onclick='" +
    onClickEvent +
    "' class='" +
    classes.join(" ") +
    "'>" +
    buttonText +
    "</button>"
  );
}
function CSSCode() {
  var buttonCSS = [];
  var iconCSS = [];

  var background = button.background;

  if (background.gradient) {
    buttonCSS.push(
      "background: linear-gradient(to right," +
        button.background.color +
        " ," +
        button.background.gradientColor +
        ")"
    );
  }
  buttonCSS.push("background-color: " + button.background.color);

  var text = button.text;
  var fontFamily = text.fontFamily;
  var fontSize = text.fontSize;
  var fontStyle = text.fontStyle;

  var bold = fontStyle.bold;
  var italic = fontStyle.italic;

  if (bold) bold = 800;
  else bold = 400;

  if (italic) italic = "italic";
  else italic = "normal";

  buttonCSS.push("color: " + text.color);
  buttonCSS.push("font-family: " + fontFamily);
  buttonCSS.push("font-size: " + fontSize + "px");
  buttonCSS.push("font-weight: " + bold);
  buttonCSS.push("font-style: " + italic);
  buttonCSS.push("text-decoration: none");

  var size = button.size;
  var vertical = size.vertical;
  var horizontal = size.horizontal;

  buttonCSS.push("padding: " + vertical + "px " + horizontal + "px");

  var border = button.border;
  var size = border.size;
  var radius = border.radius;

  buttonCSS.push("border: " + size + "px solid " + border.color);
  buttonCSS.push("border-radius: " + radius + "px");

  var icon = button.icon;

  if (icon.enabled) {
    buttonCSS.push("display: inline-flex");
    buttonCSS.push("justify-content: center");
    buttonCSS.push("align-items: center");

    var iconPos = icon.position;
    if (iconPos == "top" || iconPos == "bottom") {
      buttonCSS.push("flex-flow: column");
    }

    switch (iconPos) {
      case "left":
        iconCSS.push("margin-right: " + horizontal + "px");
        break;
      case "right":
        iconCSS.push("margin-left:" + horizontal + "px");
        break;
      case "top":
        iconCSS.push("margin-bottom:" + vertical + "px");
        break;
      case "bottom":
        iconCSS.push("margin-top:" + vertical + "px");
        break;
    }

    iconCSS.push("display: block");
    iconCSS.push("width: " + icon.size + "px");
    iconCSS.push("height: " + icon.size + "px");
    iconCSS.push("background-image: url(" + icons[icon.name] + ")");
    iconCSS.push("background-repeat: no-repeat");
    iconCSS.push("background-size: contain");
    iconCSS.push("transform: rotate(" + icon.rotation + "deg)");
  } else {
    buttonCSS.push("display: inline-block");
  }

  var boxShadow = button.boxShadow;

  if (boxShadow.enabled) {
    if (boxShadow.inset) {
      buttonCSS.push(
        "box-shadow: inset " +
          boxShadow.horizontal +
          "px " +
          boxShadow.vertical +
          "px " +
          boxShadow.blur +
          "px " +
          boxShadow.spread +
          "px " +
          boxShadow.color
      );
    } else {
      buttonCSS.push(
        "box-shadow: " +
          boxShadow.horizontal +
          "px " +
          boxShadow.vertical +
          "px " +
          boxShadow.blur +
          "px " +
          boxShadow.spread +
          "px " +
          boxShadow.color
      );
    }
  }

  var textShadow = button.textShadow;

  if (textShadow.enabled) {
    buttonCSS.push(
      "text-shadow: " +
        textShadow.horizontal +
        "px " +
        textShadow.vertical +
        "px " +
        textShadow.blur +
        "px " +
        textShadow.color
    );
  }

  var code = {
    buttonCSS: buttonCSS,
    iconCSS: iconCSS,
  };

  return code;
}
function importIcon(e) {
  var file = document.querySelector('input[type="file"]');

  file.click();
}
function changeToImportedIcon(base64) {
  icons.imported_icon = base64;
  button.icon.name = "imported_icon";
  updatePreview();
}
function file2Base64(file) {
  var reader = new FileReader();
  reader.onload = function (result) {
    changeToImportedIcon(reader.result);
  };
  reader.readAsDataURL(file.files[0]);
}
function updateInputsValues() {
  var container = document.querySelector("div.tool-main-left");
  var textInputs = container.querySelectorAll('input[type="text"]');
  var rangeInputs = container.querySelectorAll('input[type="range"]');
  var checkboxs = container.querySelectorAll('input[type="checkbox"]');
  var radios = container.querySelectorAll('input[type="radio"]');
  var selects = container.querySelectorAll("select");
  setInputsValue(textInputs, 0);
  setInputsValue(rangeInputs, 0);
  setInputsValue(checkboxs, 1);
  setInputsValue(radios, 2);
  setInputsValue(selects, 0);
}
function setInputsValue(inputs, type) {
  if (type == 1) {
    for (var i = 0; i < inputs.length; i++) {
      var input = inputs[i];

      var category = input.dataset.category;
      var sub = input.dataset.sub;
      var name = input.dataset.name;

      if (!category) continue;

      if (!sub) input.checked = button[category][name];
      else input.checked = button[category][sub][name];
    }
  } else if (type == 0) {
    for (var i = 0; i < inputs.length; i++) {
      var input = inputs[i];

      var category = input.dataset.category;
      var sub = input.dataset.sub;
      var name = input.dataset.name;

      if (!category) continue;

      var storedValue = "";

      if (!sub) storedValue = button[category][name];
      else storedValue = button[category][sub][name];

      input.value = storedValue;

      if (input.type == "range") {
        input.parentNode.querySelector("p.range-value span").innerText =
          storedValue;
      }
    }
  } else {
    for (var i = 0; i < inputs.length; i++) {
      var input = inputs[i];

      var category = input.dataset.category;
      var sub = input.dataset.sub;
      var name = input.dataset.name;

      if (!category) continue;

      if (!sub) {
        if (input.value == button[category][name]) input.checked = true;
      } else {
        if (input.value == button[category][sub][name]) input.checked = true;
      }
    }
  }
}
function generateHTML() {
  var text = button.text;
  var buttonText = text.buttonText;

  var actions = button.actions;

  var url = actions.url;

  if (url == "") url = "#";

  var icon = button.icon;
  if (icon.enabled) {
    var iconPos = icon.position;
    switch (iconPos) {
      case "left":
        return (
          '<a class="' +
          text.className +
          '" href="' +
          url +
          '"><span></span>' +
          buttonText +
          "</a>"
        );
      case "right":
        return (
          '<a class="' +
          text.className +
          '" href="' +
          url +
          '">' +
          buttonText +
          "<span></span></a>"
        );
      case "top":
        return (
          '<a class="' +
          text.className +
          '" href="' +
          url +
          '"><span></span>' +
          buttonText +
          "</a>"
        );
      case "bottom":
        return (
          '<a class="' +
          text.className +
          '" href="' +
          url +
          '">' +
          buttonText +
          "<span></span></a>"
        );
    }
  }
  return (
    '<a class="' +
    text.className +
    '" href="' +
    url +
    '">' +
    buttonText +
    "</a>"
  );
}
function generateCSS() {
  var className = button.text.className;
  var main =
    "a." + className + "{\n " + CSSCode().buttonCSS.join(";\n ") + ";\n}";
  var span =
    "a." + className + " span{\n " + CSSCode().iconCSS.join(";\n ") + ";\n}";

  var hover = "";
  var click = "";

  if (button.actions.hover.enabled) {
    var hoverEffectCode = [];

    switch (button.actions.hover.effect) {
      case "lighten":
        if (button.background.gradient) {
          hoverEffectCode.push(
            "background: linear-gradient(to right," +
              pSBC(0.1, button.background.color) +
              " ," +
              pSBC(0.1, button.background.gradientColor) +
              ")"
          );
        }
        hoverEffectCode.push(
          "background-color: " + pSBC(0.1, button.background.color)
        );
        break;
      case "darken":
        if (button.background.gradient) {
          hoverEffectCode.push(
            "background: linear-gradient(to right," +
              pSBC(-0.1, button.background.color) +
              " ," +
              pSBC(-0.1, button.background.gradientColor) +
              ")"
          );
        }
        hoverEffectCode.push(
          "background-color: " + pSBC(-0.1, button.background.color)
        );
        break;
      case "box-shadow":
        hoverEffectCode.push("box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2)");
        break;
    }

    hover =
      "\na." + className + ":hover{\n " + hoverEffectCode.join(";\n ") + ";\n}";
  }

  if (button.actions.click.enabled) {
    var clickEffectCode = [];

    switch (button.actions.click.effect) {
      case "shrink":
        clickEffectCode.push("transform: scale(0.95)");
        break;
    }

    click =
      "\na." +
      className +
      ":active{\n " +
      clickEffectCode.join(";\n ") +
      ";\n}";
  }

  var finalCode = main + "\n" + span + hover + click;

  if (!button.icon.enabled) finalCode = main + hover + click;

  return finalCode;
}
function updateCode() {
  var htmlFinalCode = generateHTML();
  var cssFinalCode = generateCSS();
  var htmlCodeContainer = document.querySelector(
    'div.code-view-code-container[data-id="html"] code'
  );
  var cssCodeContainer = document.querySelector(
    'div.code-view-code-container[data-id="css"] code'
  );

  htmlCodeContainer.innerText = htmlFinalCode;
  cssCodeContainer.innerText = cssFinalCode;
  highlight();
}
function scrollToCode() {
  var code = document.querySelector("div.code-view");
  code.scrollIntoView();
}
(function start() {
  updateInputsValues();
  updatePreview();
})();
