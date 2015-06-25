<?php
echo "Intentando conectar....\n";
$conn = oci_connect('sa', 'sa123', '192.168.1.50');

$stid = oci_parse($conn, 'select * from documentoidentificacion');

oci_execute($stid);
;

?>
