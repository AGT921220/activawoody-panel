<?php
/**
*
* @ This file is created by http://DeZender.Net
* @ deZender (PHP7 Decoder for ionCube Encoder)
*
* @ Version			:	4.1.0.1
* @ Author			:	DeZender
* @ Release on		:	29.08.2020
* @ Official site	:	http://DeZender.Net
*
*/

echo "\r\n" . '      </div>' . "\r\n" . '    </div>' . "\r\n" . '    <!-- /#page-content-wrapper -->' . "\r\n\r\n" . '  </div>' . "\r\n" . '  <!-- /#wrapper -->' . "\r\n\r\n\r\n" . '  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>' . "\r\n" . '  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>' . "\r\n" . '  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>' . "\r\n" . '<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>' . "\r\n" . '<script src="js/alerts.js"></script>' . "\r\n" . '<script src="js/three.min.js"></script>' . "\r\n" . '<script src="js/vanta.net.min.js"></script>' . "\r\n" . '<script src="js/custom.js"></script>' . "\r\n" . '</body>' . "\r\n\r\n" . '</html>' . "\r\n\r\n" . '<script type="text/javascript">' . "\r\n\r\n\r\n" . '//table' . "\r\n" . '$(document).ready( function () {' . "\r\n" . '    $(\'#Dtable\').DataTable ' . "\r\n" . '                ({' . "\r\n" . '                    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],' . "\r\n\t\t\t\t\t" . '"filter": true,' . "\r\n" . '                    "Paginate": true,' . "\r\n\t\t\t\t\t" . '"ordering": false,' . "\r\n" . '                });' . "\r\n" . '} );' . "\r\n\r\n\r\n" . '$("#menu-toggle").click(function(e) {' . "\r\n" . '  e.preventDefault();' . "\r\n" . '  $("#wrapper").toggleClass("toggled");' . "\r\n" . '});' . "\r\n\r\n" . '//updtae alert' . "\r\n" . '$("#success-alert").fadeTo(2000, 500).slideUp(500, function(){' . "\r\n" . '    $("#success-alert").alert(\'close\');' . "\r\n" . '});' . "\r\n\r\n" . '$("#success-alert1").fadeTo(2000, 500).slideUp(500, function(){' . "\r\n" . '    $("#success-alert1").alert(\'close\');' . "\r\n" . '});' . "\r\n\r\n\r\n" . '//delete modal' . "\r\n" . '    $(\'#confirm-delete\').on(\'show.bs.modal\', function(e) {' . "\r\n" . '        $(this).find(\'.btn-ok\').attr(\'href\', $(e.relatedTarget).data(\'href\'));' . "\r\n" . '    });' . "\r\n\r\n" . '</script>' . "\r\n\r\n";
$successU = 'createAlert(\'\',\'Success!\',\'Contents were successfully updated\',\'success\',true,true,\'pageMessages\');';
$successC = 'createAlert(\'\',\'Success!\',\'Contents were successfully created\',\'success\',true,true,\'pageMessages\');';
$danger = 'createAlert(\'\',\'Deleted!\',\'Contents were successfully deleted\',\'danger\',true,true,\'pageMessages\');';
$info = 'createAlert(\'\',\'General Alert\',\'Welcome.\',\'info\',true,true,\'pageMessages\');';
$warning = 'createAlert(\'\',\'Warning!\',\'Must fill out all input blocks!.\',\'warning\',true,true,\'pageMessages\');';

if (isset($_GET['status'])) {
	if ($_GET['status'] == '1') {
		echo '<script>' . $successC . '</script>';
	}
	else if ($_GET['status'] == '2') {
		echo '<script>' . $successU . '</script>';
	}
	else if ($_GET['status'] == '3') {
		echo '<script>' . $danger . '</script>';
	}
	else if ($_GET['status'] == '4') {
		echo '<script>' . $info . '</script>';
	}
	else if ($_GET['status'] == '5') {
		echo '<script>' . $warning . '</script>';
	}
}

?>