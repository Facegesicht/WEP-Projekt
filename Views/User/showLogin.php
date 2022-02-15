<?php
include dirname(__DIR__).'/header.phtml';
?>

<form method="post">
    Benutzername: <input type="text" name="username" /> <br>
    Passwort: <input type="text" name="pw" /> <br>
    <input type="hidden" name="controller" value="user" />
    <input type="hidden" name="do" value="checkLogin" />
    <input type="submit" name="submit" value="Anmelden" />

</form>

<?php include dirname(__DIR__).'/footer.phtml'; ?>
