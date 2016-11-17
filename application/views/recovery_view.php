<div class="recovery">
    <h1>Востановление пароля</h1>
    <form method="post" autocomplete="off" >
        <input maxlength='200' type="text" required='required' name="login_recovery" autocomplete="on" />Логин</br>
        <input maxlength='200' type="email" required='required' name="email_recovery"  autocomplete="on" />E-mail</br>
        <input maxlength='200' type="submit" name="recovery_sub" id="recovery_sub" value="Востановить">
    </form>
    <?php if(isset($_POST['recovery_sub'])) echo"Введены неверно логин или почта!";?>
</div>