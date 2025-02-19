<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

echo "    <!-- Required Js -->\r\n    <script src=\"assets/js/vendor-all.min.js\"></script>\r\n    <script src=\"assets/plugins/bootstrap/js/bootstrap.min.js\"></script>\r\n    <script src=\"assets/js/pcoded.min.js\"></script>\r\n\r\n    <!-- prism Js -->\r\n    <script src=\"assets/plugins/prism/js/prism.min.js\"></script>\r\n    <script src=\"assets/js/analytics.js\"></script>\r\n\r\n<script src=\"assets/js/jquery.datetimepicker.js\"></script>\r\n  <script> \r\n\$(function() {\r\n  \$inp = \$(\"#btn_signup\");\r\n  \$cb = \$(\"#checkbox\");\r\n  if (\$cb.is(':checked')) {\r\n      \$inp.prop('disabled', false);\r\n    } else {\r\n      \$inp.prop('disabled', true);\r\n    }\r\n\r\n  \$cb.on('change', function() {\r\n    if (\$cb.is(':checked')) {\r\n      \$inp.prop('disabled', false);\r\n    } else {\r\n      \$inp.prop('disabled', true);\r\n    }\r\n  });\r\n\r\n});\r\n\r\n\$(document).ready(function () {\r\n    \$(\"#flash-msg\").delay(3000).fadeOut(\"slow\");\r\n});\r\n  </script>\r\n<script>\r\nvar today = new Date();\r\nvar date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();\r\nvar time = today.getHours() + \":\" + today.getMinutes() + \":\" + today.getSeconds();\r\nvar dateTime = date+' '+time;\r\n\r\n\$('#datetimepicker').datetimepicker({\r\n //value:dateTime, \r\n step:30,\r\n format:'Y-m-d H:i:s',\r\n });\r\n</script>\r\n<center>\r\n                        <h4 class=\"card-title mb-3\"><a class=\"nav-link\" href=\"https://t.me/apkrebrandec\">\r\n          <i class=\"fas fa-fw fa-\" aria-hidden=\"true\"></i>\r\n CREATION ECUADOR </a></h4>\r\n\t\t  </center>\r\n</body>\r\n\r\n</html>";

?>