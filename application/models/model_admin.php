<?php

class Model_admin extends Model
{
	public function __construct(Database $db) 
	{	
		 parent::__construct($db); 
	}
    public function get_data($id_det)									// показать основную информацию детали
    {
        $sth = $this->db->prepare("
SELECT details.*
FROM details
Where '$id_det'= id_detail
    ");
        $sth->execute();
        return $sth->fetchAll();
    }
    public function get_car($id_det)							// показать к которым машинам подходит деталь(доп.инф)
    {
        $sth_car = $this->db->prepare("
SELECT car.model
FROM car, detail_car
Where  car_id=id_car
And '$id_det'= detail_id
ORDER BY car.model
    ");
        $sth_car->execute();
        return $sth_car->fetchAll();
    }

    public function get_category()									//считать с БД все категории деталей
    {
        $sth_category = $this->db->prepare("
SELECT *
FROM category
    ");
        $sth_category->execute();
        return $sth_category->fetchAll();
    }
    public function get_model()											// считать с БД все модели машин
    {
        $sth_category = $this->db->prepare("
SELECT car.model
FROM car
    ");
        $sth_category->execute();
        return $sth_category->fetchAll();
    }

																		//ИЗМЕНЕНИЕ информации детали
	public function get_detal_edit($id_detal,$adress,$named,$category,$prise,$count_model_arr,$count){
		//обновление основной информации детали
		$update_detal = $this->db->prepare("
UPDATE details
SET  foto='$adress'
, detail='$named'
, category='$category'
, prise='$prise'
Where id_detail='$id_detal'
    ");
		$update_detal->execute();
		
	//удаляем доп. инф. детали
		$delete_model_detals = $this->db->prepare("
DELETE quick  
FROM  detail_car
Where detail_id='$id_detal'
		");
		$delete_model_detals->execute();
	//добавляем доп. инф. детали
	
						if($count>0)	{
		//"строим" запрос на вставку доп. инф.
            $querty="INSERT 
	detail_car 
VALUES ";
            for($i = 0 ; $i < $count ; $i++) {
                $querty.= "($id_detal,";
				$coun=$count_model_arr[$i]; //узнаем id модели из названия
				$part = $this->db->prepare("
                    SELECT id_car
					FROM car
					Where  model='$coun'
					");
					
				$part->execute(); 
				$part=  $part->fetch();
				$part=$part['id_car'];			
				
				$querty.="$part".")";	//вписываем этот id 
                if ($i == $count - 1)
                    break;
                $querty.= ",";
            };
            $querty.= ";";
		$insert_model_detals = $this->db->prepare("$querty");
		$insert_model_detals->execute();
		}
		
			echo '<script type=text/javascript >';
			echo "alert(\"изменено\")";
			echo '</script>';	
	}																	//ДОБАВЛЕНИЕ детали
	public function get_detal_add($adress,$named,$category,$prise,$count_model_arr,$count){
		//добавление основной информации детали	
		$add_detal = $this->db->prepare("
INSERT details
VALUES  ('','$named','$category','$prise','$adress');
    ");
		$add_detal->execute();
		
		//добавляем доп. инф. детали
	$id_detal= $this->db->prepare("
	SELECT id_detail
	FROM details 
	ORDER BY id_detail
	DESC LIMIT 1
	");
	$id_detal->execute(); 
	$id_detal=  $id_detal->fetch();
	$id_detal=$id_detal['id_detail'];
						if($count>0)	{

		//"строим" запрос на вставку доп. инф.
            $querty="INSERT 
	detail_car 
VALUES ";
            for($i = 0 ; $i < $count ; $i++) {
                $querty.= "($id_detal,";
				$coun=$count_model_arr[$i]; //узнаем id модели из названия
				$part = $this->db->prepare("
                    SELECT id_car
					FROM car
					Where  model='$coun'
					");
					
				$part->execute(); 
				$part=  $part->fetch();
				$part=$part['id_car'];			
				
				$querty.="$part".")";	//вписываем этот id 
                if ($i == $count - 1)
                    break;
                $querty.= ",";
            };
            $querty.= ";";
		$insert_model_detals = $this->db->prepare("$querty");
		$insert_model_detals->execute(); 	
	}
			echo '<script type=text/javascript >';
			echo "alert(\"добавлена деталь с id:$id_detal\")";
			echo '</script>';	
	}
	public function get_detal_delete($id_detal){  //УДАЛЕНИЕ детали
		//удаление основной информации
		$delete_detal = $this->db->prepare("
DELETE quick  
FROM  details
Where id_detail='$id_detal'
    ");
		$delete_detal->execute();
		// удаление доп. инфо
		$delete_detal_model = $this->db->prepare("
DELETE quick  
FROM detail_car
Where detail_id='$id_detal'
    ");
		$delete_detal_model->execute();
			echo '<script type=text/javascript >';
			echo "alert(\"Удалено!\")";
			echo '</script>';
		
	}

	public function get_portfolio($id_portfolio)
	{
		$sth = $this->db->prepare("
SELECT *
FROM portfolio
WHERE '$id_portfolio'=id_portfolio
    ");
		$sth->execute();
		return $sth->fetchAll();
	}
	public function get_portfolio_foto($id_portfolio_foto)
	{
		$sth = $this->db->prepare("
SELECT *
FROM portfolio_foto
WHERE '$id_portfolio_foto'=id_portfolio_foto
    ");
		$sth->execute();
		return $sth->fetchAll();
	}

	public function portfolio_edit($id_portfolio,$info_portfolio,$count_img_arr,$count){
		//обновление основной информации детали
		$update_info = $this->db->prepare("
UPDATE portfolio
SET  description_portfolio='$info_portfolio'
Where id_portfolio='$id_portfolio'
    ");
		$update_info->execute();

		//удаляем фотки
		$delete_foto = $this->db->prepare("
DELETE quick  
FROM  portfolio_foto
Where 	id_portfolio_foto='$id_portfolio'
		");
		$delete_foto->execute();
		//добавляем фотки

		if($count>0)	{
			//"строим" запрос на вставку фоток
			$querty="
INSERT portfolio_foto	 
VALUES ";
			for($i = 1 ; $i <= $count ; $i++) {
				$querty.= "('$id_portfolio','$count_img_arr[$i]')";
				if ($i == $count )
					break;
				$querty.= ",";
			};
			$querty.= ";";
			$insert_foto = $this->db->prepare("$querty");
			$insert_foto->execute();
		}
		echo "<script type=text/javascript >alert('изменено')</script>";
	}

	public function portfolio_add($id_portfolio,$info_portfolio,$count_img_arr,$count){
		//добавление основной информации
		$add_foto = $this->db->prepare("
INSERT portfolio
VALUES  ('','$info_portfolio');
    ");
		$add_foto->execute();

		$id_foto= $this->db->prepare("
	SELECT id_portfolio
	FROM portfolio 
	ORDER BY id_portfolio
	DESC LIMIT 1
	");
		$id_foto->execute();
		$id_foto=  $id_foto->fetch();
		$id_foto=$id_foto['id_portfolio'];

		if($count>0)	{
			//"строим" запрос на вставку фоток
			$querty="
INSERT portfolio_foto	 
VALUES ";
			for($i = 1 ; $i <= $count ; $i++) {
				$querty.= "('$id_foto','$count_img_arr[$i]')";
				if ($i == $count )
					break;
				$querty.= ",";
			};
			$querty.= ";";
			$insert_foto = $this->db->prepare("$querty");
			$insert_foto->execute();
		}


		echo "<script type=text/javascript >alert('добавлено')</script>";
	}

	public function portfolio_delete($id_portfolio)
	{
		$delete_portfolio = $this->db->prepare("
DELETE quick  
FROM  portfolio
Where id_portfolio='$id_portfolio'
    ");
		$delete_portfolio->execute();
		// удаление доп. инфо
		$delete_portfolio_foto = $this->db->prepare("
DELETE quick  
FROM portfolio_foto
Where id_portfolio_foto='$id_portfolio'
    ");
		$delete_portfolio_foto->execute();

		echo "<script type=text/javascript >alert('удалено')</script>";
	}



}