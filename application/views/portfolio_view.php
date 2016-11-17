<h1>Примеры работ</h1>
<?php

foreach($data['portfolio'] as $info_portfolio ) {

    echo "<div class='portfolio_box'>";
    echo "<p>" . $info_portfolio['description_portfolio'] . "</p><div>";
    foreach ($data['portfolio_foto'] as $foto_portfolio) {
        if ($info_portfolio['id_portfolio'] == $foto_portfolio['id_portfolio_foto'])
            echo "<img class='port_foto' src='images/portfolio/" . $foto_portfolio['portfolio_foto'] . "' onclick='modal_foto(this);' />";
    };
    echo "</div></div>";
};
?>