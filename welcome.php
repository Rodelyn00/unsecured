<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit;
}
$user = $_SESSION["user"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Welcome</title>
<style>
  body{
    margin:0;
    min-height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    background:#E6E6FA;
    color: #8d0a8b;
    font-family:'Courier New', Courier, monospace;
  }
  .card{
    background:rgba(255,255,255,0.18);
    border:1px solid #4e0a4d;
    border-radius:4px;
    padding:28px;
    width:340px;
  }
  h1{ color: rgb(70, 10, 79) ; margin:0 0 16px; }
  dt{ color: #4e0a4d ; font-weight:bold; margin-top:10px; }
  dd{ margin-left:0; }
  a{ color:#4a0baf; }
</style>
</head>
<body>
  <div class="card">
    <h1>Welcome</h1>
    <dl>
      <dt>Name</dt><dd>Rodelyn Lebanan</dd>
      <dt>Age</dt><dd>21 years old</dd>
      <dt>School</dt><dd>Western Institute of Technology, "PSITS"</dd>
    </dl>
    <p>Logged in as: <?= htmlspecialchars($user["username"]) ?></p>
    <a href="logout.php">Log Out</a>
  </div>
</body>
</html>