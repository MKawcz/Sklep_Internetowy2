<?php

    session_start();

    if ((isset($_SESSION['logged'])) && ($_SESSION['logged']==true))
    {
        header('Location: Admin_Index.php');
        exit();
    }

?>
<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <title>Sklep Muzyczny - Logowanie</title>
</head>
<body>
<form method="post" action="login-process.php">
    Email: <input type="text" name="email"> <br> <br>
    Hasło: <input type="password" name="password"> <br> <br>
    <input type="submit" name="login" value="Zaloguj"> <br><br>
</form>
<?php
    if(isset($_SESSION['blad']))
        echo $_SESSION['blad'];
?>
</body>
</html>