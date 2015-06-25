<?php
echo "Intentando conectar....\n";
$conn = oci_connect('sa', 'sa123', '192.168.1.50');

$stid = oci_parse($conn, 'select * from documentoidentificacion');

oci_execute($stid);
;
echo "<table>\n";
while (($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
    echo "<tr>\n";
    foreach ($row as $item) {
        echo "  <td>".($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;")."</td>\n";
    }
    echo "</tr>\n";
}
echo "</table>\n";

?>
