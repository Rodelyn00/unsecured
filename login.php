<?php
mysqli_report(MYSQLI_REPORT_OFF);
$conn = new mysqli("localhost", "root", "", "unsecured", 3306);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user = $_POST["username"];
    $pass = $_POST["password"];

    // vulnerable: raw input concatenated into the query — e.g. ' OR '1'='1
    $query = "SELECT * FROM vulnerable WHERE username = '$user' AND password = '$pass'";
    $result = $conn->query($query);

    if ($result === false) {
        $message = "Query error: " . $conn->error;
    } elseif ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        session_start();
        $_SESSION["user"] = $row;
        header("Location: welcome.php");
        exit;
    } else {
        $message = "Login failed.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login</title>
<style>
  body{
    margin:0;
    min-height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    background:#E6E6FA;
    color:#FFF9E6;
    font-family:'Courier New', Courier, monospace;
  }
  .card{
    background:rgba(255,255,255,0.18);
    border:1px solid #4B3869;
    border-radius:4px;
    padding:28px;
    width:320px;
  }
  h1{ color:#4B3869; margin:0 0 16px; }
  label{ display:block; color:#4B3869; font-weight:bold; margin-bottom:4px; }
  input{
    width:100%;
    padding:10px;
    margin-bottom:16px;
    font-family:inherit;
    border:1px solid #4B3869;
    border-radius:3px;
    background:#FFF9E6;
    color:#2a1f38;
  }
  button{
    width:100%;
    padding:12px;
    background:#4B3869;
    color:#FFF9E6;
    border:none;
    border-radius:3px;
    font-family:inherit;
    font-size:1rem;
    cursor:pointer;
  }
  .msg{ color:#ffb3b3; margin-top:10px; }
</style>
</head>
<body>
  <div class="card">
    <h1>Welcome</h1>
    <form method="POST">
      <label for="username">Username</label>
      <input type="text" id="username" name="username">
      <label for="password">Password</label>
      <input type="text" id="password" name="password">
      <button type="submit">Log In</button>
    </form>
    <?php if ($message): ?>
      <div class="msg"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>
  </div>
</body>
</html>