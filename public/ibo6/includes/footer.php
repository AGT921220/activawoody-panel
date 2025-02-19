<?php





echo "    <script src=\"https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js\"></script>\n    <script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js\"></script>\n</div>\n\n\n\n      <!-- Footer -->\n      <footer class=\"sticky-footer\">\n          <center></center>\n        <div class=\"container\">\n          <div class=\"copyright text-center\">\n            <span><a href=\"https://T.me/NEWVISION310\" target=\"_blank\">&#169; PRIMETIME IBO <sup>Panel Manager</sup></a></span>\n          </div>\n        </div>\n      </footer>\n      <!-- End of Footer -->\n\n    </div>\n    <!-- End of Content Wrapper -->\n\n  </div>\n  <!-- End of Page Wrapper -->\n\n  <!-- Scroll to Top Button-->\n  <a class=\"scroll-to-top rounded\" href=\"#page-top\">\n    <i class=\"fas fa-angle-up\"></i>\n  </a>\n\n\n<!-- Bootstrap core JavaScript-->\n  <script src=\"vendor/jquery/jquery.min.js\"></script>\n  <script src=\"vendor/bootstrap/js/bootstrap.bundle.min.js\"></script>\n\n  <!-- Core plugin JavaScript-->\n  <script src=\"vendor/jquery-easing/jquery.easing.min.js\"></script>\n\n\n  <!-- Custom scripts for all pages-->\n  <script src=\"js/sb-admin-2.min.js\"></script>\n  <script src=\"js/jquery.datetimepicker.js\"></script>\n  \n<script>\n\nvar today = new Date();\nvar date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();\nvar time = today.getHours() + \":\" + today.getMinutes() + \":\" + today.getSeconds();\nvar dateTime = date+' '+time;\n\n\$('#datetimepicker').datetimepicker({\n\t//value:dateTime, \n\tstep:30,\n\tformat:'Y-m-d H:i:s',\n\t});\n\t\n\n\$(document).ready(function () {\n    \$(\"#flash-msg\").delay(3000).fadeOut(\"slow\");\n});\n\n</script>\n";



?>