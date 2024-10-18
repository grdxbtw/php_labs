<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $logFile = 'log.txt';

    $logData = isset($_POST['textToUpload']) ? trim($_POST['textToUpload']) : null;

    file_put_contents($logFile, $logData, FILE_APPEND);

    $contents = file_get_contents($logFile);

    echo "<h2>Вміст файлу log.txt</h2>";
    echo "<pre>$contents</pre>";
} else {
    echo "Дані не були відправлені!";
}
?>