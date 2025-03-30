<?php
include 'phpqrcode/qrlib.php';
include 'dbcon.php'; // Your DB connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tid'])) {
    $tid = intval($_POST['tid']);

    // Get user details and token from the database
    $sql = "SELECT * FROM t_users WHERE tid = '$tid' LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $l_token = $row['l_token'];

        // Generate URL with l_token
        $data = "http://localhost/RMS-SaaS/dist/tablelogin.php?token=" . urlencode($l_token);

        // Generate unique QR code file
        $qrFilename = "qrcode_" . $tid . ".png";
        QRcode::png($data, $qrFilename, QR_ECLEVEL_L, 5);

        // Return success message and QR file name
        echo json_encode(['success' => true, 'qr' => $qrFilename]);
    } else {
        echo json_encode(['success' => false, 'message' => 'User not found!']);
    }
}
?>