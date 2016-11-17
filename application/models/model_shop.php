<?php

class Model_shop extends Model
{
	public function __construct(Database $db) 
	{	
		 parent::__construct($db); 
	}
public function get_data($car_model,$category)//вывод всей информации детали
	{
		$sth = $this->db->prepare("
SELECT *
FROM details,car,detail_car
WHERE '$category'= details.category
    AND details.id_detail = detail_car.detail_id
    AND car.id_car = detail_car.car_id
    AND '$car_model' = car.model
    GROUP BY details.id_detail
    ");
		$sth->execute();

		return $sth->fetchAll();

	}
	
public function get_category()//вывод в селект все категории деталей
    {
        $sth_category = $this->db->prepare("
SELECT *
FROM category
    ");
        $sth_category->execute();
        return $sth_category->fetchAll();
    }
	
public function get_model()//вывод в селект все модели машин
    {
        $sth_category = $this->db->prepare("
SELECT car.model
FROM car
    ");
        $sth_category->execute();
        return $sth_category->fetchAll();
    }
	
}
