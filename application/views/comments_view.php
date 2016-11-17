<h1>Отзывы</h1>
<div class="comments" >
<?php
$count=0;
foreach($data['comments_count'] as $comments_count ) {
    $count= $comments_count['COUNT(*)'];
}
foreach($data['comments'] as $comment ) {
    if($_SESSION['loggedIn']=='true' && ($_SESSION['login'] == $comment['user'] || $_SESSION['role'] == 'admin')) {
        echo "<form method='post'>";
        echo "<input type='hidden' readonly name='id_comment' value='$comment[id_comment]' />";
        echo "<input type='submit' name='del_comment' class ='vanil_but' value='X' title='удалить комментарий' />";

        
    };
    echo "<div class='comment_box'>";
    echo "<p>" . $comment['user'] . "</p>";
    echo "<div class='top_right'>Оценка: ". $comment['raiting']."/10</div>";
    echo $comment['date'];
    echo "</br><div class='comment'>".$comment['comment']."</div></br></div></form>";
};


$count = ceil($count / 6);
echo "<form method='post'><div class='navigation'>";
for($i=1;$i<=$count;$i++){
    echo "<input type='submit' name='navig_comment' class='navig_comm' value=' $i ' />";
}
echo "</div></form>";

if($_SESSION['loggedIn']=='true'){
    echo "<form method='post'>";
    echo "</br><div class='comment_write'>Добавить отзыв: </br><input maxlength='200' minlength='5' required='required' class='comment' name='comment'/>";
    echo "<div>Ваша оценка о работе и предоставленых услугах (от 1 до 10) : <input name='raiting' required='required' class='top_right' min='1' max='10'  type='number' /><div>";
    echo "<input name='add_comment' type='submit' value='добавить' />";
    echo "</div><input type='hidden' readonly name='user' value='$_SESSION[login]'/></form>";
}else
    echo 'Отзывы могут добавлять лишь зарегестрированные пользователи!';


?>
</div>
