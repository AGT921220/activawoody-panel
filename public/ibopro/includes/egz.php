<script>
$(document).ready(function () {
    $('#flash-msg').delay(3000).fadeOut('slow');
});

$('#confirm-delete').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});
</script>

<script>
$(document).ready(function () {
    $('#flash-msg').delay(3000).fadeOut('slow');
});
</script>

<script>
$('#confirm-delete').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});
</script>
