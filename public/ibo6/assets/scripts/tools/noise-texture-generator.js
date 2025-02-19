var safeMode = true;
var maxSafeValue = 500;
var settings = {
  density: 100,
  opacity: 20,
  size: 1,
  width: 100,
  height: 100,
  background: {
    hex: "#000",
    r: 0,
    g: 0,
    b: 0,
  },
  noise: {
    hex: "#fff",
    r: 255,
    g: 255,
    b: 255,
  },
  transparent: false,
  randColor: false,
  canvas: null,
};
var backgroundColorPickr = Pickr.create({
  el: ".background-color-picker",
  theme: "classic",
  container: document.querySelector("div.background-color-picker-container"),
  default: settings.background.hex,

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
var noiseColorPickr = Pickr.create({
  el: ".noise-color-picker",
  theme: "classic",
  container: document.querySelector("div.noise-color-picker-container"),
  default: settings.noise.hex,

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
  instance._root.button.style.background = settings.background.hex;
});
noiseColorPickr.on("init", function (instance) {
  instance._root.button.style.background = settings.noise.hex;
});
backgroundColorPickr.on("change", function (color, source, instance) {
  var colorOutput = "#" + color.toHEXA(color).join("");
  var rgba = color.toRGBA();

  instance._root.button.style.background = colorOutput;

  var background = settings.background;

  background.hex = colorOutput;
  background.r = rgba[0];
  background.g = rgba[1];
  background.b = rgba[2];

  var png = getCanvas();

  updatePreview(png);
  updateCode(png);
});
noiseColorPickr.on("change", function (color, source, instance) {
  var colorOutput = "#" + color.toHEXA(color).join("");
  var rgba = color.toRGBA();

  instance._root.button.style.background = colorOutput;

  var noise = settings.noise;
  var randColor = settings.randColor;

  noise.hex = colorOutput;
  noise.r = rgba[0];
  noise.g = rgba[1];
  noise.b = rgba[2];

  if (randColor) return;

  var png = getCanvas();

  updatePreview(png);
  updateCode(png);
});
function updateRanges() {
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
  var png = getCanvas();

  updatePreview(png);
  updateCode(png);
  updateRangeTextValue();
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
  var value = input.value;

  if (value > maxSafeValue) {
    if (safeMode) {
      if (
        confirm(
          "You might experience lagging if you go above 500, Are you sure?"
        )
      ) {
        safeMode = false;
      } else {
        input.value = maxSafeValue;
        return;
      }
    }
  }

  settings[type] = value;

  var png = getCanvas();

  updatePreview(png);
  updateCode(png);
}
function updatePreview(png) {
  var preview = document.querySelector("div.preview");
  var previewData = document.querySelector("span.preview-d");
  var previewColor = document.querySelector("span.preview-color");

  var width = settings.width;
  var height = settings.height;

  var background = settings.background.hex;

  previewData.innerText = width + " x " + height;
  previewColor.style.backgroundImage = "url(" + png + ")";
  preview.style.background = background;
}
function getCanvas() {
  var canvas = document.querySelector("canvas");

  var width = settings.width;
  var height = settings.height;
  var density = 100 / settings.density;
  var opacity = settings.opacity;
  var size = settings.size;
  var background = settings.background;
  var noise = settings.noise;
  var randColor = settings.randColor;
  var transparent = settings.transparent;

  var r = noise.r;
  var g = noise.g;
  var b = noise.b;

  var rr = background.r;
  var gg = background.g;
  var bb = background.b;

  var ctx = canvas.getContext("2d");
  canvas.width = width;
  canvas.height = height;

  if (transparent) ctx.fillStyle = "rgba(0,0,0,0)";
  else ctx.fillStyle = "rgb(" + rr + "," + gg + "," + bb + ")";

  ctx.fillRect(0, 0, width, height);

  for (var i = 0; i < width; i += density) {
    for (var x = 0; x < height; x += density) {
      var newOpacity = Math.floor(Math.random() * opacity) / 100;

      if (randColor) {
        r = Math.floor(Math.random() * 256);
        g = Math.floor(Math.random() * 256);
        b = Math.floor(Math.random() * 256);
      }

      ctx.fillStyle = "rgba(" + r + "," + g + "," + b + "," + newOpacity + ")";
      ctx.fillRect(i * size, x * size, 1 * size, 1 * size);
    }
  }

  settings.canvas = canvas;

  return canvas.toDataURL("image/png", "");
}
function updateCode(png) {
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
    a.download = "noise-texture-" + width + "x" + height + ".png";
    a.click();

    URL.revokeObjectURL(url);
  });
}
function handleOptionsChange(checkbox) {
  var name = checkbox.dataset.name;
  settings[name] = checkbox.checked;

  var png = getCanvas();

  updateRanges();
  updateCode(png);
  updatePreview(png);
}
function updateOptions() {
  var options = document.querySelectorAll('div.options input[type="checkbox"]');
  for (var i = 0; i < options.length; i++) {
    var option = options[i];
    var name = option.dataset.name;
    option.checked = settings[name];
  }
}
function regenerate() {
  var png = getCanvas();

  updateCode(png);
  updatePreview(png);
}
(function start() {
  updateRanges();
  updateRangeTextValue();
  updateOptions();
  var width = document.getElementById("width");
  var height = document.getElementById("height");

  width.value = settings.width;
  height.value = settings.height;

  var png = getCanvas();

  updateCode(png);
  updatePreview(png);
})();
