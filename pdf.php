<?php
require 'vendor/autoload.php'; // Include dompdf library

use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('defaultFont', 'Arial');
$dompdf = new Dompdf($options);

include 'db_connection.php'; // Include database connection

$sql = "SELECT * FROM users"; // Example query
$result = $conn->query($sql);

$html = '<h2>User List</h2>';
$html .= '<table border="1" width="100%">
            <tr><th>ID</th><th>Name</th><th>Email</th></tr>';

while ($row = $result->fetch_assoc()) {
    $html .= "<tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['email']}</td>
              </tr>";
}
$html .= '</table>';

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("user_list.pdf", array("Attachment" => 1)); // Download PDF

?>
 