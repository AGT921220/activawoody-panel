var gradientPreview;
var gradientType = "linear";
var radialPosition = "center center";
var activeColorSlider = null;
var angle = 90;
var colorValueUpdateTimeOut;
var rangePreview = document.querySelector("div.range-preview");
var codeUpdateTimeOut;
var colors = [
  {
    color: "#12C2E9",
    pos: 0,
    id: "7395396784111474",
  },
  {
    color: "#c471ed",
    pos: 50,
    id: "5039833890618186",
  },
  {
    color: "#f64f59",
    pos: 100,
    id: "1254223716910512",
  },
];
window.addEventListener("resize", function () {
  locateColorSlidersThumbs();
});
$(document).ready(function (e) {
  gradientPreview = document.querySelector("p.gradient-preview-text");

  if (localStorage.storedTextGradient) {
    var storedTextGradient = JSON.parse(localStorage.storedTextGradient);

    colors = storedTextGradient.colors;
    angle = storedTextGradient.angle;
    gradientType = storedTextGradient.type;
    radialPosition = storedTextGradient.radialPosition;
  }

  checkGradientradio();
  checkRadialPosition();

  applyGradient();

  createColorSlidersThumbs();
  createColorsControls();
  applyGradientToButtons();
  pickr.setColor(colors[0].color);
  updateAngleValue();
});
function changeGradientType(type) {
  gradientType = type;

  if (gradientType == "radial") {
    document.querySelector("div.gradient-angle").style.display = "none";
    document.querySelector("div.radial-position").style.display = "block";
  } else {
    document.querySelector("div.gradient-angle").style.display = "block";
    document.querySelector("div.radial-position").style.display = "none";
  }

  applyGradient();
}
function changeRadialPosition(select) {
  radialPosition = select.value;
  applyGradient();
}
function checkRadialPosition() {
  var select = document.querySelector("div.radial-position select");
  select.value = radialPosition;
}
$(".angle-slider").roundSlider({
  radius: 50,
  width: 8,
  handleSize: "+12",
  handleShape: "dot",
  sliderType: "min-range",
  value: 90,
  showTooltip: false,
  max: 360,
  change: "changeAngleValue",
  drag: "changeAngleValue",
  startAngle: 90,
});
function updateAngleValue() {
  $(".angle-slider").roundSlider("setValue", angle);
  document.querySelector("#angle-value").value = angle;
}
function changeAngleValue(event) {
  document.querySelector("#angle-value").value = event.value;

  angle = event.value;

  applyGradient();
}
var pickr = Pickr.create({
  el: ".color-picker",
  theme: "classic",
  showAlways: true,
  container: document.querySelector("div.color-picker-container"),
  inline: true,
  default: colors[0].color,

  components: {
    preview: true,
    opacity: true,
    hue: true,

    interaction: {
      hex: true,
      rgba: true,
      input: true,
    },
  },
});
pickr.on("change", function (color, instance) {
  if (!activeColorSlider) return;
  var activeColorSliderId = activeColorSlider.dataset.id;

  color = convertColorCode(color);

  var colorCodeInput = document.querySelector(
    'input.color-code-input[data-id="' + activeColorSliderId + '"]'
  );

  var colorPreviewSquare = document.querySelector(
    'span.color-preview-square[data-id="' + activeColorSliderId + '"] span'
  );

  if (colorCodeInput) colorCodeInput.value = color;

  if (colorPreviewSquare) colorPreviewSquare.style.backgroundColor = color;

  activeColorSlider.dataset.color = color;

  colors.filter(function (c) {
    if (c.id === activeColorSliderId) c.color = color;
  });

  setColorSlidersThumbsColors();

  applyGradient();
});
function convertColorCode(color) {
  switch (pickr.getColorRepresentation()) {
    case "RGBA":
      return color.toRGBA().toString(0);
      break;
    default:
      return color.toHEXA().toString();
  }
}
function createColorSlidersThumbs() {
  var slidersContainer = document.querySelector("div.slider-colors-container");

  slidersContainer.innerHTML = "";

  colors.map(function (c) {
    return (slidersContainer.innerHTML +=
      '<div class="color-slider"><div class="color-slider-adder" onclick="addColor(event);"></div><span class="color-slider-thumb" onclick="selectColorSlider(this);" data-id="' +
      c.id +
      '" data-color="' +
      c.color +
      '"><span class="slider-color-thumb-container"></span><span class="slider-color-thumb-color"></span></span></div>');
  });

  $("span.color-slider-thumb").draggable({
    containment: "parent",
    drag: function (event, ui) {
      handleSliderColorPosChange(event.target, ui.position.left);
    },
  });

  activeColorSlider = document.querySelector("span.color-slider-thumb");

  locateColorSlidersThumbs();
  setColorSlidersThumbsColors();
}
function handleSliderColorPosChange(target, leftPos) {
  var targetId = target.dataset.id;
  var pos = Math.round((leftPos / ($("div.color-slider").width() - 16)) * 100);

  var color = colors.find(function (c) {
    return c.id == targetId;
  });

  color.pos = pos;

  activeColorSlider.parentNode.style.zIndex = 0;
  target.parentNode.style.zIndex = 1;

  selectColorSlider(target);

  createColorsControls();
}
function selectColorSlider(elem) {
  var id = elem.dataset.id;
  var target = document.querySelector(
    'span.color-slider-thumb[data-id="' + id + '"]'
  );
  activeColorSlider = target;
  pickr.setColor(target.dataset.color);

  document.querySelector(
    'div.colors-control-element[data-selected="1"]'
  ).dataset.selected = 0;
  document.querySelector(
    'div.colors-control-element[data-id="' + id + '"]'
  ).dataset.selected = 1;
}
function locateColorSlidersThumbs() {
  var colorSliderWidth = $("div.color-slider").width();
  var thumbs = document.querySelectorAll("span.color-slider-thumb");

  for (var x = 0; x < thumbs.length; x++) {
    var thumb = thumbs[x];
    var colorId = thumb.dataset.id;
    var color = colors.filter(function (c) {
      return c.id == colorId;
    });
    if (color.length === 0) continue;
    var pos = color[0].pos;

    thumb.style.left = (pos * (colorSliderWidth - 16)) / 100 + "px";
  }
}
function setColorSlidersThumbsColors() {
  var thumbColors = document.querySelectorAll("span.slider-color-thumb-color");

  for (var x = 0; x < thumbColors.length; x++) {
    var thumbColor = thumbColors[x];
    var parent = thumbColor.parentNode;
    var color = parent.dataset.color;

    thumbColor.style.backgroundColor = color;
  }
}
function createColorsControls() {
  var colorsControlContainer = document.querySelector("div.colors-control");
  colorsControlContainer.innerHTML = "";

  colors.map(function (c) {
    var isActive = 0;
    if (c.id == activeColorSlider.dataset.id) isActive = 1;
    colorsControlContainer.innerHTML +=
      '<div class="colors-control-element" data-id="' +
      c.id +
      '" data-selected="' +
      isActive +
      '"><div class="color-control-preview"><span class="color-preview-square" onclick="selectColorSlider(this);" data-id="' +
      c.id +
      '"><span style="background-color:' +
      c.color +
      ';"></span></span></div><div class="color-control-options"><div class="color-code"><input type="text" value="' +
      c.color +
      '" spellcheck="false" class="color-code-input" onfocus="selectColorSlider(this);" onkeyup="changeColorValue(event);" data-id="' +
      c.id +
      '"/></div><div class="color-pos"><input class="color-pos-input" type="text" onfocus="selectColorSlider(this);" maxlength="3" onfocusout="applyPosValue(this);" onkeyup="changePosValue(event);" value="' +
      c.pos +
      '" data-id="' +
      c.id +
      '"/></div><div class="delete-btn-container"><button class="delete-btn" data-id="' +
      c.id +
      '" onclick="deleteColor(this);"></button></div></div></div>';
  });
}
function changeColorValue(e) {
  var value = e.target.value;
  clearTimeout(colorValueUpdateTimeOut);
  colorValueUpdateTimeOut = setTimeout(function () {
    pickr.setColor(value);
  }, 500);
}
function applyPosValue(input) {
  var id = input.dataset.id;
  var value;
  colors.filter(function (c) {
    if (c.id == id) value = c.pos;
  });
  input.value = value;
}
function changePosValue(e) {
  var target = e.target;
  var id = target.dataset.id;
  var value = target.value;

  value = validatePosValue(value);

  if (value != 0) target.value = value;

  colors.filter(function (c) {
    if (c.id == id) c.pos = value;
  });

  locateColorSlidersThumbs();
  applyGradient();
}
function validatePosValue(value) {
  if (value.length == 0) value = 0;
  value = JSON.stringify(value).replace(/\D+/g, "");

  if (value > 100) value = 100;
  else if (value < 0) value = 0;

  return parseInt(value) + 0;
}
function applyGradientToButtons() {
  var buttons = document.querySelectorAll("button.preset-btn");

  for (var x = 0; x < buttons.length; x++) {
    var button = buttons[x];
    var buttonGradientType = button.dataset.type;
    var buttonGradientColors = button.dataset.colors;
    var buttonGradientAngle = button.dataset.angle;
    var buttonGradientRadialPos = button.dataset.radialpos;

    parsedColors = JSON.parse(buttonGradientColors);

    var mappedColors = "";
    parsedColors.map(function (c) {
      mappedColors += c.color + " " + c.pos + "%, ";
    });

    mappedColors = mappedColors.substr(0, mappedColors.length - 2);

    if (buttonGradientType === "radial") {
      button.style.background =
        "radial-gradient(circle at " +
        buttonGradientRadialPos +
        ", " +
        mappedColors +
        ")";
    } else {
      button.style.background =
        "linear-gradient(" + buttonGradientAngle + "deg, " + mappedColors + ")";
    }
  }
}
function checkGradientradio() {
  document.querySelector("input#radio-" + gradientType).checked = true;

  if (gradientType == "radial") {
    document.querySelector("div.gradient-angle").style.display = "none";
    document.querySelector("div.radial-position").style.display = "block";
  } else {
    document.querySelector("div.gradient-angle").style.display = "block";
    document.querySelector("div.radial-position").style.display = "none";
  }
}
function usePreset(button) {
  var dataset = button.dataset;
  gradientType = dataset.type;

  radialPosition = "center center";

  checkGradientradio();
  checkRadialPosition();

  angle = dataset.angle;
  colors = JSON.parse(dataset.colors);

  colors.map(function (c) {
    c.id = Math.random().toString().replace("0.", "");
  });

  createColorSlidersThumbs();
  createColorsControls();

  updateAngleValue();
  pickr.setColor(colors[0].color);

  applyGradient();
}
function applyGradient() {
  colors = colors.sort(function (a, b) {
    return a.pos - b.pos;
  });

  var mappedColors = "";
  colors.map(function (c) {
    mappedColors += c.color + " " + c.pos + "%, ";
  });

  mappedColors = mappedColors.substr(0, mappedColors.length - 2);

  var code = generateCode(mappedColors);

  gradientPreview.style.cssText = code.css;
  rangePreview.style.background =
    "linear-gradient(90deg, " + mappedColors + ")";

  if (codeUpdateTimeOut) window.clearTimeout(codeUpdateTimeOut);
  codeUpdateTimeOut = window.setTimeout(function () {
    updateCode(code);
    saveGradient();
  }, 50);
}
function saveGradient() {
  var storedTextGradient = {
    colors: colors,
    angle: angle,
    type: gradientType,
    radialPosition: radialPosition,
  };
  localStorage.storedTextGradient = JSON.stringify(storedTextGradient);
}
function generateCode(mappedColors) {
  if (gradientType === "linear") {
    var cssCode =
      "background: linear-gradient(" +
      angle +
      "deg, " +
      mappedColors +
      ");\n-webkit-background-clip: text;\n-webkit-text-fill-color: transparent;";
  } else {
    var cssCode =
      "background: radial-gradient(circle at " +
      radialPosition +
      ", " +
      mappedColors +
      ");\n-webkit-background-clip: text;\n-webkit-text-fill-color: transparent;";
  }

  return { css: cssCode };
}
function updateCode(code) {
  var cssCodeContainer = document.querySelector(
    "div.code-view-code-container[data-id='css'] pre code"
  );

  var cssCode = "h1{" + code.css;

  cssCodeContainer.innerHTML = cssCode;

  highlight();
  cssCodeContainer.innerHTML = cssCodeContainer.innerHTML
    .replace("h1", "")
    .replace("{", "");
}
function addColor(e) {
  var xCursorPosition = getCursorPositionRelativeToElement(e);

  var pos = Math.ceil((xCursorPosition / e.target.offsetWidth) * 100);

  var id = Math.random().toString().replace("0.", "");

  colorsPos = colors.map(function (c) {
    return c.pos;
  });

  var closestColorPos = colorsPos.reduce(function (prev, curr) {
    return Math.abs(curr - pos) < Math.abs(prev - pos) ? curr : prev;
  });

  var color = colors[colorsPos.indexOf(closestColorPos)].color;

  var newColor = {
    color: color,
    pos: pos,
    id: id,
  };

  colors.push(newColor);

  applyGradient();
  createColorSlidersThumbs();

  activeColorSlider = document.querySelector(
    "span.color-slider-thumb[data-id='" + id + "']"
  );

  createColorsControls();

  pickr.setColor(color);
}
function getCursorPositionRelativeToElement(e) {
  var rect = e.target.getBoundingClientRect();
  var x = e.clientX - rect.left;
  return x;
}
function deleteColor(button) {
  if (colors.length <= 2) return;

  var id = button.dataset.id;
  var parent = button.parentNode.parentNode.parentNode;

  parent.classList.add("deleted-element");
  setTimeout(function () {
    parent.style.display = "none";
    createColorsControls();
  }, 250);

  colors = colors.filter(function (c) {
    return c.id !== id;
  });

  applyGradient();

  createColorSlidersThumbs();
}
