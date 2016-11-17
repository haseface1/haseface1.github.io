<h1>Каталог деталей</h1>

<form class="shop" method="POST">
    <p>Автомобиль:</p>
    <select class="car" name="car_model" required="required"        >
        <option selected="selected"><?php if(isset($_POST['submit2'])){echo $_POST['car_model'];}?></option>
		<?php foreach($data['model'] as $model) {	?>						
			<option><?php echo $model['model']; ?></option>
		<?php }?>	
    </select>
    <p>Категория детали:</p>
    <select class="detail" name="category" required="required"        >
        <option selected="selected"><?php if(isset($_POST['submit2'])){echo $_POST['category'];}?></option>

		<?php foreach($data['category'] as $category) {	?>						
			<option><?php echo $category['category']; ?></option>
		<?php }?>	

    </select>
    <p><input type="submit" name="submit2" id="submit2" value="Искать" />


</form>

<div class="bd">
    <div class="tovar_conteiner">
        <?php
        $kol=0;
        foreach($data['detal'] as $detal) {
            $kol=$kol+1;
            ?>
            <div class="tovar <?php if($kol>6) echo"tovar_hid";?>" id="tovar_det[<?php echo $kol ?>]">
                <img src="images/<?php echo $detal['foto']; ?>"/>
                    <p>
                        <?php echo $detal['detail']; ?>
                    </p>
                <p class="prise">
                    <?php echo $detal['prise']; ?> Грн.
                </p>
                <p class="prise">
                    <?php if($_SESSION['loggedIn']=='true' && $_SESSION['role']=='admin')echo "id:".$detal['id_detail']; ?>
                </p>
            </div>
        <?php };
        if(isset($_POST['submit2']))
        {
            if(count($data['detal'])==0 )
                echo "<div class='tovar-none'>Нет в наличии.</div>";
        };

        ?>
    </div>
    <?php
    if(count($data['detal'])>0){
        $kol_a = ceil($kol / 6);
        echo "<div class='navigation'>";
        for($i=1;$i<=$kol_a;$i=$i+1){
            echo "<a href='#' ";if($i==1) echo "class='a_check'";echo " onclick='nav_tovar(this); return false;' value='$i'> $i </a>";
        }
        echo "</div>";
    }

    ?>
</div>
