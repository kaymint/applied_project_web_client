<?php
/**
 * Created by PhpStorm.
 * User: StreetHustling
 * Date: 2/5/16
 * Time: 8:44 PM
 */
require_once 'config.php';

class wine_prepared_statements extends mysqli{


    var $mysqli;
//    var $stmt;
    /**
     * This is a constructor for the clinic class
     *
     */
    function wine_prepared_statements()
    {
        $this->mysqli = new mysqli(DB_HOST, DB_USER, DB_PWORD, DB_NAME);
    }


    function get_count(){


        $str_query = "SELECT COUNT(*)
                      AS total
                      FROM wine W LEFT JOIN winery WW
                      ON WW.winery_id = W.winery_id
                      LEFT JOIN wine_type WT
                      ON W.wine_type = WT.wine_type_id
                      LEFT JOIN inventory I
                      ON W.wine_id = I.wine_id
                      ORDER BY W.wine_id";

//        $str_query = "SELECT COUNT(*) As total FROM wine";

        $stmt = $this->mysqli->prepare($str_query);


        if($stmt === false) {
            echo 'false';
            return false;
        }

        $stmt->execute();
        return $stmt->get_result();
    }


    function add_wine($wine_name, $wine_type, $year, $winery_id, $description, $image){
        $str_query = "INSERT INTO wine (wine_name, wine_type, year, winery_id, description, image)
                      VALUES (?,?,?,?,?,?)";

        $stmt = $this->mysqli->prepare($str_query);


        if($stmt === false) {
            echo 'false';
            return false;
        }
        /* Bind parameters. TYpes: s = string, i = integer, d = double,  b = blob */
        $stmt->bind_param('siiibs',$wine_name, $wine_type, $year, $winery_id, $description, $image);

        /* Execute statement */
        $stmt->execute();

        return $stmt;
    }

    function update_wine($wine_name, $wine_type, $year, $winery_id, $description, $image, $wine_id){
        $str_query = "UPDATE wine SET
                      wine_name = ?,
                      wine_type = ?,
                      year = ?,
                      winery_id = ?,
                      description = ?,
                      image = ?
                      WHERE wine_id = ?";


        $stmt = $this->mysqli->prepare($str_query);


        if($stmt === false) {
            echo 'false';
            return false;
        }
        /* Bind parameters. TYpes: s = string, i = integer, d = double,  b = blob */
        $stmt->bind_param('siiibsi',$wine_name, $wine_type, $year, $winery_id, $description, $image,$wine_id);

        /* Execute statement */
        $stmt->execute();

        return $stmt;
    }




    function view_wines($limit){
        $str_query = "SELECT DISTINCT
                      W.wine_id,
                      W.wine_name,
                      W.year,
                      W.description,
                      WT.wine_type,
                      WW.winery_name,
                      I.cost
                      FROM wine W LEFT JOIN winery WW
                      ON WW.winery_id = W.winery_id
                      LEFT JOIN wine_type WT
                      ON W.wine_type = WT.wine_type_id
                      LEFT JOIN inventory I
                      ON W.wine_id = I.wine_id
                      ORDER BY W.wine_id";

        $str_query .= " ".$limit;

        $stmt = $this->mysqli->prepare($str_query);


        if($stmt === false) {
            echo 'false';
            return false;
        }

        $stmt->execute();
        return $stmt->get_result();
    }


    function search_wines($st){
        $str_query = "SELECT
                      W.wine_id,
                      W.wine_name,
                      W.year,
                      WT.wine_type,
                      WW.winery_name,
                      I.cost
                      FROM wine W INNER JOIN winery WW
                      ON WW.winery_id = W.winery_id
                      INNER JOIN wine_type WT
                      ON W.wine_type = WT.wine_type_id
                      INNER JOIN inventory I
                      ON W.wine_id = I.wine_id
                      AND W.wine_name LIKE '%$st%'
                      ORDER BY W.wine_name";

        return $this->query($str_query);
    }

    function search_by_type($st){
        $str_query = "SELECT DISTINCT
                      W.wine_id,
                      W.wine_name,
                      W.year,
                      WT.wine_type,
                      WW.winery_name,
                      I.cost
                      FROM wine W INNER JOIN winery WW
                      ON WW.winery_id = W.winery_id
                      INNER JOIN wine_type WT
                      ON W.wine_type = WT.wine_type_id
                      INNER JOIN inventory I
                      ON W.wine_id = I.wine_id
                      AND WT.wine_type LIKE '%$st%'
                      ORDER BY W.wine_name";

        return $this->query($str_query);
    }


    function search_by_winnery($st){
        $str_query = "SELECT DISTINCT
                      W.wine_id,
                      W.wine_name,
                      W.year,
                      WT.wine_type,
                      WW.winery_name,
                      I.cost
                      FROM wine W INNER JOIN winery WW
                      ON WW.winery_id = W.winery_id
                      INNER JOIN wine_type WT
                      ON W.wine_type = WT.wine_type_id
                      INNER JOIN inventory I
                      ON W.wine_id = I.wine_id
                      AND WW.winery_name LIKE '%$st%'
                      ORDER BY W.wine_name";

        return $this->query($str_query);
    }


    function search_by_price($st){
        $str_query = "SELECT DISTINCT
                      W.wine_id,
                      W.wine_name,
                      W.year,
                      WT.wine_type,
                      WW.winery_name,
                      I.cost
                      FROM wine W INNER JOIN winery WW
                      ON WW.winery_id = W.winery_id
                      INNER JOIN wine_type WT
                      ON W.wine_type = WT.wine_type_id
                      INNER JOIN inventory I
                      ON W.wine_id = I.wine_id
                      AND I.cost LIKE '$st%'
                      ORDER BY W.wine_name";

        return $this->query($str_query);
    }



    function get_wine_types(){
        $str_query = "SELECT *
                      FROM wine_type
                      ORDER BY wine_type";

        $stmt = $this->mysqli->prepare($str_query);


        if($stmt === false) {
            echo 'false';
            return false;
        }

        $stmt->execute();
        return $stmt->get_result();
    }

    function get_wine_by_type($wine_type){
        $str_query = "SELECT DISTINCT
                      W.wine_id,
                      W.wine_name,
                      W.year,
                      WT.wine_type,
                      WW.winery_name,
                      I.cost
                      FROM wine W INNER JOIN winery WW
                      ON WW.winery_id = W.winery_id
                      INNER JOIN wine_type WT
                      ON W.wine_type = WT.wine_type_id
                      INNER JOIN inventory I
                      ON W.wine_id = I.wine_id
                      AND WT.wine_type LIKE '%$wine_type%'
                      ORDER BY WT.wine_type";

        return $this->query($str_query);
    }

    function sort_by_name(){
        $str_query = "SELECT DISTINCT
                      W.wine_id,
                      W.wine_name,
                      W.year,
                      WT.wine_type,
                      WW.winery_name,
                      I.cost
                      FROM wine W INNER JOIN winery WW
                      ON WW.winery_id = W.winery_id
                      INNER JOIN wine_type WT
                      ON W.wine_type = WT.wine_type_id
                      INNER JOIN inventory I
                      ON W.wine_id = I.wine_id
                      ORDER BY W.wine_name";

        return $this->query($str_query);
    }


    function sort_by_price(){
        $str_query = "SELECT DISTINCT
                      W.wine_id,
                      W.wine_name,
                      W.year,
                      WT.wine_type,
                      WW.winery_name,
                      I.cost
                      FROM wine W INNER JOIN winery WW
                      ON WW.winery_id = W.winery_id
                      INNER JOIN wine_type WT
                      ON W.wine_type = WT.wine_type_id
                      INNER JOIN inventory I
                      ON W.wine_id = I.wine_id
                      ORDER BY I.cost ASC";

        return $this->query($str_query);
    }

    function view_wine($id){
        $str_query = "SELECT DISTINCT
                      W.wine_id,
                      W.wine_name,
                      W.year,
                      WT.wine_type,
                      WW.winery_name,
                      I.cost,
                      R.region_name
                      FROM wine W INNER JOIN winery WW
                      ON WW.winery_id = W.winery_id
                      INNER JOIN wine_type WT
                      ON W.wine_type = WT.wine_type_id
                      INNER JOIN inventory I
                      ON W.wine_id = I.wine_id
                      INNER JOIN region R
                      ON R.region_id = WW.region_id
                      AND W.wine_id = $id";

        return $this->query($str_query);
    }


    function get_wine_variety($id){
        $str_query = "SELECT
                      W.wine_id,
                      W.wine_name,
                      GV.variety
                      FROM wine W INNER JOIN wine_variety WV
                      ON WV.wine_id = W.wine_id
                      INNER JOIN grape_variety GV
                      ON GV.variety_id = WV.variety_id
                      WHERE W.wine_id = $id";

        return $this->query($str_query);
    }




    function get_wineries(){
        $str_query = "SELECT *
                      FROM winery";

        return $this->query($str_query);
    }


    function get_grape_variety(){
        $str_query = "SELECT *
                      FROM grape_variety";

        return $this->query($str_query);
    }
}

//$pageno = 2;
//$rows_per_page = 25;
//$obj = new wine_prepared_statements();
//$limit = 'LIMIT ' .($pageno - 1) * $rows_per_page .',' .$rows_per_page;
//
//$result = $obj->view_wines($limit);
//
//$row = $result->fetch_all(MYSQLI_ASSOC);

//foreach ($row as $v1) {
//    foreach ($v1 as $v2) {
//        echo "$v2" ."<br>";
//    }
//}
//
//echo json_encode($row);


//$obj = new wine_prepared_statements();
//$res = $obj->add_wine('Santiago', 2, 1888, 7, 'test prepared', 'test.png', 1061);
//echo $res->affected_rows;










