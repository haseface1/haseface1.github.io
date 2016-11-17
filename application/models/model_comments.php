<?php

class Model_comments extends Model
{
    public function __construct(Database $db)
    {
        parent::__construct($db);
    }
    public function get_commets($navig)
    {
        $navig-=1;
        $navig=$navig*6;
        $sth = $this->db->prepare("
SELECT *,
date_format(datetime,'%d/%m/%Y %H:%i') as date
FROM comments
LIMIT $navig , 6
    ");
        $sth->execute();
        return $sth->fetchAll();
    }

    public function get_count()
    {
        $sth = $this->db->prepare("
SELECT COUNT(*)
FROM comments
    ");
        $sth->execute();
        return $sth->fetchAll();
    }

    public function del_comment($id_comment)
    {
        $sth = $this->db->prepare("
DELETE quick  
FROM comments
Where id_comment='$id_comment';
    ");
        $sth->execute();
    }
    public function add_comment($user,$comment,$raiting)
    {

        $sth = $this->db->prepare("
INSERT comments	 
VALUES ('','$user','$comment',NOW(),'$raiting')
    ");
        $sth->execute();
    }


}
