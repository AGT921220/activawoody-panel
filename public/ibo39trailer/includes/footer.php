
      </div>
    </div>
    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->

<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
<script src="js/particles.js"></script>
<script src="js/alerts.js"></script>
</body>

</html>

<script type="text/javascript">


//table
$(document).ready( function () {
    $('#Dtable').DataTable 
                ({
                    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
					"filter": true,
                    "Paginate": true,
					"ordering": false,
                });
} );


$("#menu-toggle").click(function(e) {
  e.preventDefault();
  $("#wrapper").toggleClass("toggled");
});

//updtae alert
$("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").alert('close');
});


//delete modal
    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });

</script>

<?php
//createAlert(title, summary, details, severity, dismissible, autoDismiss, appendToId)
$success = "createAlert('','Success!','Contents were successfully updated','success',true,true,'pageMessages');";
$danger = "createAlert('','Deleted!','Contents were successfully deleted','danger',true,true,'pageMessages');";
$info = "createAlert('','General Alert','Welcome.','info',true,true,'pageMessages');";
$warning = "createAlert('','Warning!','Must fill out all inputs blocks!.','warning',true,true,'pageMessages');";
if(isset($_GET['status'])){
	if ($_GET['status'] == '1'){
		echo "<script>$success</script>";
	}elseif ($_GET['status'] == '2'){
		echo "<script>$danger</script>";
	}elseif ($_GET['status'] == '3'){
		echo "<script>$info</script>";
	}elseif ($_GET['status'] == '4'){
		echo "<script>$warning</script>";
	}
}
?>
