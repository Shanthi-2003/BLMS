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
Step 4: Add a Button to Download PDF
In your HTML file (e.g., index.php), add:

html
Copy
Edit
<a href="generate_pdf.php" target="_blank" class="btn btn-primary">Download PDF</a>
Alternative: Save PDF to Server Instead of Downloading
If you want to save the PDF file on the server instead of forcing a download:

php
Copy
Edit
file_put_contents("user_list.pdf", $dompdf->output());
echo "PDF saved successfully!";
Conclusion
Now, when you click the "Download PDF" button, a PDF will be generated using data from MySQL. You can customize the styling, add images, or even include charts.

Do you need further customization? 😊