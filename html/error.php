<!--<div class="error_message">
    <img src="../img/not_found.png" class="img-responsive">
</div>
<h1>Error al procesar la consulta</h1>
<p>Se le direccionará al home</p>-->
<?php
die( print_r( sqlsrv_errors(), true));
?>