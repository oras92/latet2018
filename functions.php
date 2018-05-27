<?php
    define('DBINFO', 'mysql:host=zebra.mtacloud.co.il;dbname=shiranya_Latet2018');
    define('DBUSER','shiranya');
    define('DBPASS','latet');
    function fetchAll($query){
        $con = new PDO(DBINFO, DBUSER, DBPASS);
        $stmt = $con->query($query);
        return $stmt->fetchAll();
    }
    function performQuery($query){
        $con = new PDO(DBINFO, DBUSER, DBPASS);
        $stmt = $con->prepare($query);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
?>