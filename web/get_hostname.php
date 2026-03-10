<?php
/**
 * get_hostname.php
 * Haalt de hostname van de server op
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

// Haal hostname op
$hostname = gethostname();

if ($hostname === false) {
    echo json_encode(['error' => 'Could not retrieve hostname']);
    exit;
}

// Return JSON
echo json_encode(['hostname' => $hostname]);
?>
