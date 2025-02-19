  </div>
  <!-- Footer -->
  <footer class="">
    <div class="container">
      <div class="copyright text-center my-auto">
        <span><a href="#">Ultra IBO</a> <a href="#"> // &#169;  Designed by Eggzie00</a></span>
      </div>
    </div>
  </footer>
  <!-- End of Footer -->
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src= "js/switch.js"></script>
<script src="js/bootstrap-datetimepicker.js"></script>
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
</body>

</html>

<script type="text/javascript">
$("#form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii:ss', autoclose:true});

$(document).ready(function () {
    $('#Dtable').DataTable
                ({
                    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                    "filter": true,
                    "Paginate": true,
                    "ordering": true,
                    "searching": true,
                    "paging":   true,
                    "info":     true
                });
});

$("#menu-toggle").click(function(e) {
  e.preventDefault();
  $("#wrapper").toggleClass("toggled");
});

$("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").alert('close');
});

$('#confirm-delete').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});
</script>
<style>
sorting {
    background-repeat: no-repeat;
    background-position: center right;
}
</style>
