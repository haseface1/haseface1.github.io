<?php 
if($_SESSION['loggedIn']!='true' || $_SESSION['role']!='admin'){
			echo "<script type=text/javascript >window.location.href='/404'</script>";}
	?>


<div id="lineTabs">
            <a href="#"><div id="tab_admin_1" onclick="tab_admin(this)">Детали</div></a><th/>
			<a href="#"><div id="tab_admin_2" onclick="tab_admin(this)">Портфолио</div></a><th/>
</div>
<div id="cont">
            <div id="content_admin_1" <?php if(!(isset($_POST['p_id_det']) || isset($_POST['edit_detal']) || isset($_POST['add_detal']) || isset($_POST['delete_detal']))) echo "style='display: none;'"; ?>>
                <br/>
                <form method="POST">
                    <input maxlength='200' type="number" name="id_det" required="required" value="<?php
					if(isset($_POST['p_id_det'])) {echo $_POST['id_det'];};
					if(isset($_POST['edit_detal']) || isset($_POST['add_detal']) || isset($_POST['delete_detal'])) {echo $_POST['id_detal'];};					
					?>" pattern="[0-9]{1,10}" />id детали
                    <input maxlength='200' type="submit"  name="p_id_det" value="поиск"/>
                </form>
                <?php
				
                 if(isset($_POST['p_id_det']) || isset($_POST['edit_detal']) || isset($_POST['add_detal']) || isset($_POST['delete_detal'])){
                    foreach($data['data'] as $item) {
                    ?>
					<form method="POST">
                    <div class="detal">

                        <img src="images/<?php echo $item['foto']; ?>"/><br/>
						<input maxlength='200' type="text" name="id_detal"   value="<?php echo $item['id_detail']; ?>" />id<br/>
                        <input maxlength='200' type="text" name="adress"  value="<?php echo $item['foto']; ?>" required="required" />Адрес<br/>
                        <input maxlength='200' type="text" name="named"  value="<?php echo $item['detail']; ?>" required="required" />Название<br/>

                        <select name="category"  required="required">
                            <option selected="selected"><?php echo $item['category']; ?></option>
							
							<?php foreach($data['category'] as $category) {	?>						
							<option><?php echo $category['category']; ?></option>
							<?php }?>	

                        </select>Категория<br/>
                        <input maxlength='200' type="text" name="prise"  value="<?php echo $item['prise']; ?>" />Цена/Грн.<br/>

                        <div class="bigbut">Подходит машинам:</br>
							<input maxlength='200' type="button" id="raz" class=" add icon_edit" onclick="add_func()"  value="+"/>
							<input maxlength='200' type="button" class=" delete icon_edit" onclick="delete_func()" value="-"/>
							<select id="select_example">
								<option selected="selected"><?php echo ''; ?></option>							
								<?php foreach($data['model'] as $model_all) {	?>						
									<option><?php echo $model_all['model']; ?></option>
								<?php } ?>
							</select>	

						<?php $count=0;  //количество моделей машин, к которым подходит деталь
							foreach($data['car'] as $model) { ?>  				
							<select  id="model_<?php echo $count;?>" name="model_<?php echo $count; $count=$count+1; ?>" required="required">
								<option selected="selected"><?php echo $model['model']; ?></option>							
								<?php foreach($data['model'] as $model_all) {	?>						
									<option><?php echo $model_all['model']; ?></option>
								<?php } ?>
							</select>					
						
                        <?php  };?>						
						</div>							
						<input maxlength='200' type="hidden" id="count_model" name="count_model" value="<?php echo $count;?>" />
						
						<input maxlength='200' type="submit" name="edit_detal" class=" edit bigbut"  value="изменить"/>
						<input maxlength='200' type="submit" name="add_detal" class=" add bigbut"  value="добавить"/>
						<input maxlength='200' type="submit" id="del_detal_sub" name="delete_detal" class=" delete bigbut"  value="удалить"/>
                    </div>
					</form>
                    <?php
						}; 
						};	
							if( count($data['data']) == 0 && isset($_POST['p_id_det'])){
								echo "</br><div class='tovar-none'>Нет в наличии.</div>";
								}
						?>
							
            </div>

	<div id="content_admin_2" <?php if(!(isset($_POST['Search_id_portfolio']) || isset($_POST['edit_portfolio']) || isset($_POST['add_portfolio']) || isset($_POST['delete_portfolio'])) ) echo "style='display: none;'"; ?>>
		<br/>
		<form method="POST">
			<input maxlength='200' type="number" name="id_portfolio" required="required" value="<?php
			if(isset($_POST['Search_id_portfolio']) || isset($_POST['edit_portfolio']) || isset($_POST['add_portfolio']) || isset($_POST['delete_portfolio'])) {echo $_POST['id_portfolio'];};
			?>" pattern="[0-9]{1,10}" />id portfolio
			<input maxlength='200' type="submit"  name="Search_id_portfolio" value="поиск"/>

		<?php
		if(isset($_POST['Search_id_portfolio']) || isset($_POST['edit_portfolio']) || isset($_POST['add_portfolio']) || isset($_POST['delete_portfolio'])){
		//foreach($data['data'] as $item) {
		?>
			<div class="portfolio_admin">
				<?php
				foreach($data['portfolio'] as $info_portfolio ) {

					echo "<div class='portfolio_box'>";
					echo "<input maxlength='200' type='text' name='info_portfolio' value='".$info_portfolio['description_portfolio']."' /><div>";
					$count=1;
					foreach ($data['portfolio_foto'] as $foto_portfolio) {
						if ($info_portfolio['id_portfolio'] == $foto_portfolio['id_portfolio_foto']){
							echo "<div class='port_foto_box'><img class='port_foto' src='images/portfolio/" . $foto_portfolio['portfolio_foto'] . "' />";
							echo "<input maxlength='200' type='file'  title='изменить фото' onchange='select_foto(this);' class='input_file' />";
							echo "<input maxlength='200' type='hidden' class='hid' name='portf_$count' value='".$foto_portfolio['portfolio_foto']."' />";
							echo "<input maxlength='200' type='button' class ='vanil_but' value='X' onclick='del_parent(this);' /></div>";
						}
						$count++;
					};
					?>
								<input maxlength='200' type="button" class="add icon_edit" value="+" onclick="add_foto_portfolio(this);" />
								<input maxlength='200' type="hidden" id="count_foto_portfolio" name="count_foto_portfolio" value="<?php echo $count-1;?>" />
	<?php }; ?>
			</div>
			<input maxlength='200' type="submit" name="edit_portfolio" class=" edit bigbut"  value="изменить"/>
			<input maxlength='200' type="submit" name="add_portfolio" class=" add bigbut"  value="добавить"/>
			<input maxlength='200' type="submit" id="del_portfolio_sub" name="delete_portfolio" class=" delete bigbut"  value="удалить"/>

		</form>
	<?php } ?>
	</div>

</div>
