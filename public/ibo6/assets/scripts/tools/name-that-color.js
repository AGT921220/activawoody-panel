var colors = [];
function colorDiff(rgb1, rgb2) {
  return Math.sqrt(
    Math.pow(rgb1.r - rgb2.r, 2) +
      Math.pow(rgb1.g - rgb2.g, 2) +
      Math.pow(rgb1.b - rgb2.b, 2)
  );
}
function getClosestColor(RGBTo) {
  var closest = colors.reduce(function (prev, curr) {
    return Math.abs(colorDiff(curr.rgb, RGBTo)) <
      Math.abs(colorDiff(prev.rgb, RGBTo))
      ? curr
      : prev;
  });
  document.querySelector("p.color-name").innerText = closest.colorName;
}
function createPickr() {
  var pickr = Pickr.create({
    el: ".color-picker",
    theme: "classic",
    showAlways: true,
    container: document.querySelector("div.color-picker-container"),
    inline: true,
    default: "#354FE7",

    components: {
      preview: true,
      hue: true,

      interaction: {
        hex: true,
        rgba: true,
        hsla: true,
        hsva: true,
        cmyk: true,
        input: true,
      },
    },
  });
  pickr.on("change", function (color, source, instance) {
    document.querySelector("div.color-square").style.background =
      "#" + color.toHEXA(color).join("");
    let RGBArr = color.toRGBA(color);
    RGBArr[0] = Math.round(RGBArr[0]);
    RGBArr[1] = Math.round(RGBArr[1]);
    RGBArr[2] = Math.round(RGBArr[2]);
    RGBArr.pop();

    let RGB = {
      r: RGBArr[0],
      g: RGBArr[1],
      b: RGBArr[2],
    };

    var hexaLabel = document.getElementById("hexa-code-container");
    var rgbaLabel = document.getElementById("rgba-code-container");
    var hslaLabel = document.getElementById("hsla-code-container");
    var cmykLabel = document.getElementById("cmyk-code-container");
    var hsvaLabel = document.getElementById("hsva-code-container");

    hexaLabel.innerText = color.toHEXA().toString(0);
    rgbaLabel.innerText = color.toRGBA().toString(0);
    hslaLabel.innerText = color.toHSLA().toString(0);
    cmykLabel.innerText = color.toCMYK().toString(0);
    hsvaLabel.innerText = color.toHSVA().toString(0);

    getClosestColor(RGB);
  });
}
function handleColorsRes(data) {
  colors = JSON.parse(data);
  createPickr();
}
(function getColors() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      handleColorsRes(xhttp.responseText);
    }
  };
  xhttp.open("GET.html", "assets/common/colors.json", true);
  xhttp.send();
})();
