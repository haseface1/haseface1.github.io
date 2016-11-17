<?php

class Model_portfolio extends Model
{
    public function __construct(Database $db)
    {
        parent::__construct($db);
    }
    public function get_portfolio()
    {
        $sth = $this->db->prepare("
SELECT *
FROM portfolio
    ");
        $sth->execute();
        return $sth->fetchAll();
    }
    public function get_portfolio_foto()
    {
        $sth = $this->db->prepare("
SELECT *
FROM portfolio_foto
    ");
        $sth->execute();
        return $sth->fetchAll();
    }


}
