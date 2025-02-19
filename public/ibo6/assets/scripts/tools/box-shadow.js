var shadows = {
  previewBackground: "#fff",
  previewObject: "#6A63B7",
  activeLayer: 0,
  layers: [
    {
      horizontal: 10,
      vertical: 10,
      spread: 0,
      blur: 0,
      opacity: 100,
      color: {
        r: 0,
        g: 0,
        b: 0,
      },
      inset: false,
      shadowColor: {
        hex: "#000",
        r: 0,
        g: 0,
        b: 0,
      },
    },
  ],
};
function createShadowLayers() {
  var shadowLayersContainer = document.querySelector(
    "div.shadow-layers-container"
  );
  shadowLayersContainer.innerHTML = "";
  for (var i = 0; i < shadows.layers.length; i++) {
    var layer = shadows.layers[i];

    var disabledFirstLayer = "";
    var disabledLastLayer = "";

    if (i == 0) disabledFirstLayer = "disabled";
    if (i == shadows.layers.length - 1) disabledLastLayer = "disabled";

    var horizontal = layer.horizontal;
    var vertical = layer.vertical;
    var spread = layer.spread;
    var blur = layer.blur;
    var opacity = layer.opacity;
    var color = layer.color;
    var inset = layer.inset;

    var r = color.r;
    var g = color.g;
    var b = color.b;

    var checked = shadows.activeLayer == i ? "checked" : "";
    var insetState = inset === true ? "inset " : "";
    var code =
      insetState +
      " " +
      horizontal +
      "px" +
      vertical +
      "px" +
      blur +
      "px" +
      spread +
      "px rgba(" +
      r +
      " " +
      g +
      " " +
      b +
      " / " +
      opacity +
      "%)";

    shadowLayersContainer.innerHTML +=
      '<div class="shadow-layer-wrapper"><div class="shadow-layer"><div class="shadow-layer-radio"><div class="radio-container"><input type="radio" name="layer-radio" data-layer="' +
      i +
      '" onchange="changeActiveLayer(this)" ' +
      checked +
      '/><div></div></div></div><div class="shadow-layer-code"><p>' +
      code +
      '</p></div><div class="shadow-layer-preview" style="background: ' +
      shadows.previewBackground +
      '"><div class="shadow-layer-box-shadow" style="background: ' +
      shadows.previewObject +
      '"></div></div></div><div class="shadow-layer-options"><div class="column"><button onclick="switchLayers(this, 1);" data-layer="' +
      i +
      '" ' +
      disabledFirstLayer +
      ' class="layer-mu-btn"></button><button onclick="switchLayers(this, -1);" data-layer="' +
      i +
      '" ' +
      disabledLastLayer +
      ' class="layer-md-btn"></button></div><button class="layer-del-btn" data-layer="' +
      i +
      '" onclick="deleteLayer(this);">Delete</button></div></div>';
  }
}
function switchLayers(button, dir) {
  dir = parseInt(dir);
  var index = parseInt(button.dataset.layer);
  var layers = shadows.layers;

  var temp = layers[index - dir];
  layers[index - dir] = layers[index];
  layers[index] = temp;

  shadows.layers = layers;
  if (shadows.activeLayer == index) {
    shadows.activeLayer = index - dir;
  } else if (shadows.activeLayer == index - dir) {
    shadows.activeLayer = index;
  }

  createShadowLayers();
  applyShadow();
  applyColors();
}
function deleteLayer(button) {
  var layers = shadows.layers;

  if (layers.length <= 1) return;

  var index = button.dataset.layer;
  layers.splice(index, 1);

  shadows.layers = layers;

  if (shadows.activeLayer == index) shadows.activeLayer = 0;
  else if (shadows.activeLayer > index)
    shadows.activeLayer = shadows.activeLayer - 1;

  createShadowLayers();
  applyShadow();
  applyRangeValues();
  applyColors();
  insetCheckboxCheck();
}
function changeActiveLayer(radio) {
  shadows.activeLayer = radio.dataset.layer;
  createShadowLayers();
  applyRangeValues();
  applyColors();
  insetCheckboxCheck();
}
function applyRangeValues() {
  var horizontalRange = document.querySelector('input[data-name="horizontal"]');
  var verticalRange = document.querySelector('input[data-name="vertical"]');
  var spreadRange = document.querySelector('input[data-name="spread"]');
  var blurRange = document.querySelector('input[data-name="blur"]');
  var opacityRange = document.querySelector('input[data-name="opacity"]');

  var horizontalLabel =
    horizontalRange.parentNode.querySelector("p.range-value span");
  var verticalLabel =
    verticalRange.parentNode.querySelector("p.range-value span");
  var spreadLabel = spreadRange.parentNode.querySelector("p.range-value span");
  var blurLabel = blurRange.parentNode.querySelector("p.range-value span");
  var opacityLabel =
    opacityRange.parentNode.querySelector("p.range-value span");

  var horizontal = shadows.layers[shadows.activeLayer].horizontal;
  var vertical = shadows.layers[shadows.activeLayer].vertical;
  var spread = shadows.layers[shadows.activeLayer].spread;
  var blur = shadows.layers[shadows.activeLayer].blur;
  var opacity = shadows.layers[shadows.activeLayer].opacity;

  horizontalLabel.innerText = horizontal;
  verticalLabel.innerText = vertical;
  spreadLabel.innerText = spread;
  blurLabel.innerText = blur;
  opacityLabel.innerText = opacity;

  horizontalRange.value = horizontal;
  verticalRange.value = vertical;
  blurRange.value = blur;
  spreadRange.value = spread;
  opacityRange.value = opacity;
}
function applyColors() {
  var layers = shadows.layers;
  var activeLayer = shadows.activeLayer;
  var shadowColor = layers[activeLayer].shadowColor;

  shadowPickr.setColor(shadowColor.hex);
}
function applyShadow() {
  var previewBackground = shadows.previewBackground;
  var previewObject = shadows.previewObject;
  var shadowColor = shadows.shadowColor;
  var activeLayer = shadows.activeLayer;
  var layers = shadows.layers;

  var target = document.querySelector("div.box-shadow");

  var compoundShadowCode = "";

  for (var i = 0; i < layers.length; i++) {
    var horizontal = layers[i].horizontal;
    var vertical = layers[i].vertical;
    var spread = layers[i].spread;
    var blur = layers[i].blur;
    var opacity = layers[i].opacity;
    var color = layers[i].color;
    var inset = layers[i].inset;

    var r = color.r;
    var g = color.g;
    var b = color.b;

    var activeLayerTarget = document.querySelectorAll(
      "div.shadow-layer-box-shadow"
    )[i];

    var insetState = inset == true ? "inset " : "";

    activeLayerTarget.style.boxShadow =
      insetState +
      horizontal / 7 +
      "px " +
      vertical / 7 +
      "px " +
      blur / 7 +
      "px " +
      spread / 7 +
      "px rgba(" +
      r +
      "," +
      g +
      "," +
      b +
      "," +
      opacity / 100 +
      ")";

    var shadowCode =
      insetState +
      horizontal +
      "px " +
      vertical +
      "px " +
      blur +
      "px " +
      spread +
      "px rgba(" +
      r +
      ", " +
      g +
      ", " +
      b +
      ", " +
      opacity / 100 +
      ")";

    var activeLayerCode = document.querySelectorAll("div.shadow-layer-code p")[
      i
    ];

    activeLayerCode.innerText = shadowCode;

    compoundShadowCode += shadowCode + ",";
  }

  compoundShadowCode = compoundShadowCode.substring(
    0,
    compoundShadowCode.length - 1
  );

  target.style.boxShadow = compoundShadowCode;

  var codeContainer = document.querySelector("pre code");

  codeContainer.innerText =
    "h1{box-shadow: " +
    compoundShadowCode +
    ";\n-webkit-box-shadow: " +
    compoundShadowCode +
    ";\n-moz-box-shadow: " +
    compoundShadowCode;
  highlight();
  codeContainer.innerHTML = codeContainer.innerHTML
    .replaceAll("h1", "")
    .replaceAll("{", "");
}
function insetCheckboxCheck() {
  var checkbox = document.querySelector("input#inset");
  var activeLayer = shadows.activeLayer;
  var inset = shadows.layers[activeLayer].inset;

  checkbox.checked = inset;
}
function handleRangeChange(range) {
  var value = range.value;
  var rangeContainer = range.parentNode;
  var rangeValueText = rangeContainer.querySelector("p.range-value span");

  var rangeName = range.dataset.name;

  if (
    rangeName == "horizontal" ||
    rangeName == "vertical" ||
    rangeName == "spread"
  ) {
    value = range.value;
  }

  shadows.layers[shadows.activeLayer][rangeName] = value;

  rangeValueText.innerText = value;
  applyShadow();
}
var previewBackgroundPickr = Pickr.create({
  el: ".preview-background-color-picker",
  theme: "classic",
  container: document.querySelector(
    "div.preview-background-color-picker-container"
  ),
  default: shadows.previewBackground,

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
var previewObjectPickr = Pickr.create({
  el: ".preview-object-color-picker",
  theme: "classic",
  container: document.querySelector(
    "div.preview-object-color-picker-container"
  ),
  default: shadows.previewObject,

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
var shadowPickr = Pickr.create({
  el: ".shadow-color-picker",
  theme: "classic",
  container: document.querySelector("div.shadow-color-picker-container"),
  default: "#000000",

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
  instance._root.button.style.background = shadows.previewBackground;
});
previewObjectPickr.on("init", function (instance) {
  instance._root.button.style.background = shadows.previewObject;
});
shadowPickr.on("init", function (instance) {
  instance._root.button.style.background =
    shadows.layers[shadows.activeLayer].shadowColor.hex;
});
previewBackgroundPickr.on("change", function (color, source, instance) {
  var colorOutput = "#" + color.toHEXA(color).join("");

  document.querySelector("div.box-shadow-container").style.background =
    colorOutput;

  var shadowLayersPreview = document.querySelectorAll(
    "div.shadow-layer-preview"
  );

  for (var i = 0; i < shadowLayersPreview.length; i++) {
    shadowLayersPreview[i].style.background = colorOutput;
  }

  shadows.previewBackground = colorOutput;
  instance._root.button.style.background = colorOutput;
});
previewObjectPickr.on("change", function (color, source, instance) {
  var colorOutput = "#" + color.toHEXA(color).join("");

  document.querySelector("div.box-shadow").style.background = colorOutput;

  var shadowLayersBoxShadow = document.querySelectorAll(
    "div.shadow-layer-box-shadow"
  );

  for (var i = 0; i < shadowLayersBoxShadow.length; i++) {
    shadowLayersBoxShadow[i].style.background = colorOutput;
  }

  shadows.previewObject = colorOutput;
  instance._root.button.style.background = colorOutput;
});
shadowPickr.on("change", function (color, source, instance) {
  var rgba = color.toRGBA();

  var colorOutput = "#" + color.toHEXA(color).join("");

  shadows.layers[shadows.activeLayer].color.r = Math.round(rgba[0]);
  shadows.layers[shadows.activeLayer].color.g = Math.round(rgba[1]);
  shadows.layers[shadows.activeLayer].color.b = Math.round(rgba[2]);

  shadows.layers[shadows.activeLayer].shadowColor.hex = colorOutput;
  instance._root.button.style.background = colorOutput;
  applyShadow();
});
function applyInset(checkbox) {
  shadows.layers[shadows.activeLayer].inset = checkbox.checked;
  applyShadow();
}
function addNewLayer() {
  shadows.layers.push({
    horizontal: 10,
    vertical: 10,
    spread: 0,
    blur: 0,
    opacity: 100,
    color: {
      r: 0,
      g: 0,
      b: 0,
    },
    inset: false,
    shadowColor: {
      hex: "#000",
      r: 0,
      g: 0,
      b: 0,
    },
  });
  shadows.activeLayer = shadows.layers.length - 1;
  createShadowLayers();
  applyShadow();
  applyRangeValues();
  applyColors();
  insetCheckboxCheck();
}
(function startFunc() {
  createShadowLayers();
  applyShadow();
  insetCheckboxCheck();
  if (!window.document.documentMode) applyRangeValues();
  else
    setTimeout(function () {
      applyRangeValues();
    }, 1000);
})();
