<?php
// Конфигурационни настройки за базата данни \\
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "livechat";

// Свързване с базата данни
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

// Проверка за грешки при свързване
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Ако има заявка за изпращане на ново съобщение
if ($_POST["action"] == "send") {
    $sender = $_POST["sender"];
    $message = $_POST["message"];
    
    // Вмъкване на съобщението в базата данни
    $sql = "INSERT INTO messages (sender, message) VALUES ('$sender', '$message')";
    mysqli_query($conn, $sql);
}

// Вземане на всички съобщения от базата данни
$sql = "SELECT * FROM messages ORDER BY timestamp ASC";
$result = mysqli_query($conn, $sql);

// Обработка на всички съобщения и изпращане на JSON отговор
$messages = array();
while ($row = mysqli_fetch_assoc($result)) {
    $messages[] = $row;
}
echo json_encode($messages);
?>
