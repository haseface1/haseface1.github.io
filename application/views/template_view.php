<?php
@session_start();
if(isset($_POST['exit'])){
    session_destroy();
    session_start();
}
if(!isset($_SESSION['loggedIn'])){ $_SESSION['loggedIn']='false'; $_SESSION['role']='default';}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Сontent-Type" content="text/html"; charset="utf-8" />
		<title>Служба технического обслуживания</title>
		<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />
		<link href="http://fonts.googleapis.com/css?family=Kreon" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="/css/content.css" />
		<link rel="stylesheet" type="text/css" href="/css/header.css" />
		<link rel="stylesheet" type="text/css" href="/css/adaptive.css" />
		<link rel="stylesheet" type="text/css" href="/css/portfolio.css" />
		<link rel="stylesheet" type="text/css" href="/css/comments.css" />
        <script src="/js/script1.js"></script>
        <script type="text/javascript" src="/js/jquery.js"></script>
    </head>
	<body>
		<div id="wrapper">
			<header>
				<div class="connect">
					<?php
						if($_SESSION['loggedIn']!='true'){
                            echo "<a href='/login'>войти</a>";
                            echo "</br><a href='/login'>регистрация</a>";
                        }
						else {
							echo "Добро пожаловать, ";
							echo $_SESSION['login'];
							echo "</br><form method='post' name='exit'>
										<input maxlength='200' type='submit' id='exit' value='выйти' name='exit' />
								  </form>";
                        }
					?>
				</div>
                <img src="/images/header.png" /><p>(063) 69-62-293 Денис<br/>г.Житомир, ул. Тутковского 2</p>
				<div id="menu">
					<ul>
						<li class="first active"><a href="/"><div>Главная</div></a></li><hr/>
                        <li><a href="/shop"><div>Каталог</div></a></li><hr/>
                        <li><a href="/service"><div>Услуги</div></a></li><hr/>
						<li><a href="/portfolio"><div>Примеры работ</div></a></li><hr/>
						<li><a href="/comments"><div>Отзывы</div></a></li><hr/>
						<li><a href="/about_us"><div>О Нас</div></a></li><hr/>
						<?php if($_SESSION['loggedIn']=='true' && $_SESSION['role']=='admin'){
								echo "<li><a href='/admin'><div>Админ</div></a></li><hr/>";
							  }
						?>
						<li class="last"><a href="/contacts"><div>Контакты</div></a></li>

					</ul>
					<br class="clearfix" />
				</div>
			</header>

			<div id="page">


				<div id="sidebar">
					<div>
						<h3>Основное меню</h3>
						<ul class="list">
                            <li class="first"><a href="/"><div>Главная</div></a></li>
                            <li><a href="/shop"><div>Каталог</div></a></li>
                            <li><a href="/service"><div>Услуги</div></a></li>
							<li><a href="/portfolio"><div>Примеры работ</div></a></li>
							<li><a href="/comments"><div>Отзывы</div></a></li>
							<li><a href="/about_us"><div>О Нас</div></a></li>
                            <li class="last"><a href="/contacts"><div>Контакты</div></a></li>
						</ul>

					</div>

				</div>

				<div id="content">
					<div class="box">
						<?php include 'application/views/'.$content_view; ?>
					</div>
					<br class="clearfix" />
				</div>
				<br class="clearfix" />
			</div>
            
            <div class="navigation stock">
                    <img src="/images/stock1.png" alt=""/>
                    <img src="/images/stock2.png" alt=""/>
                    <img src="/images/stock3.png" alt=""/>
            </div>
            
			<div id="page-bottom">
				<div id="page-bottom-sidebar">
					<h3>Наши контакты</h3>
					<ul class="list">
						<li class="first">icq: 199199538</li>
						<li>skypeid: deniswipe</li>
						<li class="last">email: denisswipe@gmail.com</li>
					</ul>
				</div>
				<div id="page-bottom-content">

				</div>
				<br class="clearfix" />
			</div>
		</div>
		<footer>
			<a href="/">Cанция тех-обслуживания</a> &copy; 2016</a>
		</footer>
	</body>
</html>