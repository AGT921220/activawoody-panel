var settings = {
  red: 255,
  green: 255,
  blue: 255,
  opacity: 0,
  width: 1,
  height: 1,
};
var presets = {
  transparent: {
    red: 255,
    green: 255,
    blue: 255,
    opacity: 0,
    width: 1,
    height: 1,
  },
  white: {
    red: 255,
    green: 255,
    blue: 255,
    opacity: 100,
    width: 1,
    height: 1,
  },
  black: {
    red: 0,
    green: 0,
    blue: 0,
    opacity: 100,
    width: 1,
    height: 1,
  },
};
var pickr = Pickr.create({
  el: ".color-picker",
  theme: "classic",
  showAlways: true,
  container: document.querySelector("div.color-picker-container"),
  inline: true,
  default: "rgba(255,255,255,0)",

  components: {
    preview: true,
    hue: true,
    opacity: true,

    interaction: {
      hex: true,
      rgba: true,
      input: true,
    },
  },
});
pickr.on("change", function (color, source, instance) {
  var rgba = color.toRGBA();

  var r = Math.round(rgba[0]);
  var g = Math.round(rgba[1]);
  var b = Math.round(rgba[2]);
  var a = Math.round(rgba[3] * 100);

  settings.red = r;
  settings.green = g;
  settings.blue = b;
  settings.opacity = a;

  updatePreview();
  updateRangesValue();
  updateRangeTextValue();
  updateCode();
});
(function checkSettings() {
  var checkbox = document.getElementById("view-color-picker");
  toggleSettings(checkbox);
})();
function toggleSettings(checkbox) {
  var status = checkbox.checked;
  if (status) {
    document.querySelector("div.ranges").style.height = 0;
    document.querySelector("div.color-adjusting-container").style.height =
      "auto";
  } else {
    document.querySelector("div.ranges").style.height = "auto";
    document.querySelector("div.color-adjusting-container").style.height = 0;
  }
}
function updateRangesValue() {
  var ranges = document.querySelectorAll('input[type="range"]');
  for (var i = 0; i < ranges.length; i++) {
    var range = ranges[i];
    var name = range.dataset.name;
    range.value = settings[name];
  }
}
function handleRangeChange(range) {
  var name = range.dataset.name;
  var value = range.value;

  settings[name] = value;

  var r = settings.red;
  var g = settings.green;
  var b = settings.blue;
  var a = settings.opacity / 100;

  var rgba = "rgba(" + [r, g, b, a].join() + ")";

  pickr.setColor(rgba);
}
function updateRangeTextValue() {
  var texts = document.querySelectorAll("p.range-value");
  for (var i = 0; i < texts.length; i++) {
    var text = texts[i];
    text.querySelector("span").innerText = settings[text.dataset.name];
  }
}
function handleWidthHeightChange(input) {
  var type = input.id;
  settings[type] = input.value;
  updatePreview();
  updateCode();
}
function updatePreview() {
  var previewData = document.querySelector("span.preview-d");
  var previewColor = document.querySelector("span.preview-color");

  var width = settings.width;
  var height = settings.height;
  var r = settings.red;
  var g = settings.green;
  var b = settings.blue;
  var a = settings.opacity / 100;

  previewData.innerText = width + " x " + height;
  previewColor.style.background = "rgba(" + [r, g, b, a].join() + ")";
}
function getCanvas() {
  var canvas = document.querySelector("canvas");

  if (!canvas.getContext) G_vmlCanvasManager.initElement(canvas);

  var r = settings.red;
  var g = settings.green;
  var b = settings.blue;
  var a = settings.opacity / 100;
  var width = settings.width;
  var height = settings.height;

  var ctx = canvas.getContext("2d");
  canvas.width = width;
  canvas.height = height;

  ctx.fillStyle = "rgba(" + [r, g, b, a].join() + ")";
  ctx.fillRect(0, 0, width, height);

  settings.canvas = canvas;

  return canvas.toDataURL("image/png", "");
}
function updateCode() {
  var png = getCanvas();
  var base64 = png.substring(22);

  var codes = document.querySelectorAll("pre code");
  for (var i = 0; i < codes.length; i++) {
    var code = codes[i];
    var name = code.parentNode.parentNode.dataset.id;
    switch (name) {
      case "base64":
        code.innerText = base64;
        break;
      case "css":
        code.innerText = 'h1{background-image: url("' + png + '");';
        break;
      case "html":
        code.innerText = '<img src="' + png + '" />';
        break;
    }
  }
  highlight();
  var cssCode = document.querySelector(
    'div.code-view-code-container[data-id="css"]'
  );
  cssCode.innerHTML = cssCode.innerHTML.replace("h1", "").replace("{", "");
}
function download() {
  var width = settings.width;
  var height = settings.height;
  var canvas = settings.canvas;

  var a = document.createElement("a");

  canvas.toBlob(function (blob) {
    url = URL.createObjectURL(blob);

    a.href = url;
    a.download = "Pixel-" + width + "x" + height + ".png";
    a.click();

    URL.revokeObjectURL(url);
  });
}
function usePreset(preset) {
  settings = Object.create(presets[preset.dataset.name]);

  var r = settings.red;
  var g = settings.green;
  var b = settings.blue;
  var a = settings.opacity / 100;

  var rgba = "rgba(" + [r, g, b, a].join() + ")";

  pickr.setColor(rgba);

  updateTextInputsValue();
}
function updateTextInputsValue() {
  var width = document.getElementById("width");
  var height = document.getElementById("height");

  width.value = settings.width;
  height.value = settings.height;
}
(function start() {
  updateRangesValue();
  updateTextInputsValue();
  updateCode();
})();
