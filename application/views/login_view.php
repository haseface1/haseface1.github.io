<div class="auth">
    <h1>Авторизация</h1>
    <form method="post" autocomplete="off" >
        <input maxlength='200' type="text" required='required' name="login" autocomplete="on" />Логин</br>
        <input maxlength='200' type="password" required='required' name="password"  autocomplete="off" />Пароль</br>
        <input maxlength='200' type="submit" name="login_sub" id="login_sub" value="Войти">
    </form>
    <?php if(isset($_POST['login_sub'])) echo"Неверный логин или пароль!</br>";?>
    <a href='/recovery'>Востановить пароль</a>
</div>
<div class="regist">
    <h1>Регистрация</h1>
    <form method="post" autocomplete="off" name="registration" >
        <input maxlength='200' type="text" name="login_reg" required='required' title='*6-16 символов, *лишь символы латиницы'  pattern="^[a-zA-Z]+$+[0-9]" autocomplete="off" />Логин</br>
        <input maxlength='200' type="password" id="password_reg1" name="password_reg1" required='required' title="Минимум 8 символов, одна цифра, одна буква в верхнем регистре и одна в нижнем" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*" autocomplete="off" />Пароль</br>
        <input maxlength='200' type="password" id="password_reg2" required='required' title="Минимум 8 символов, одна цифра, одна буква в верхнем регистре и одна в нижнем" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*" />Пароль еще раз</br>
        <input maxlength='200' type="email"    id="email_reg"     name="email_reg" required='required' />E-Mail</br>
        <input maxlength='200' type="submit" name="regist_sub" id="regist_sub" value="Регистрация">
    </form>
</div>