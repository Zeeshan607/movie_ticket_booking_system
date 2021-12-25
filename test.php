<?php
include "./admin/db.php";
//$rows=array();
//$alphabets=range("A","Z");
//for($i= 0;$i<12;$i++){
//$rows[]=$alphabets[$i];
//}
//
//foreach($rows as $row){
//   echo "$row \n";
//}
//$con=$conn;
echo InsertSeatsOfCinema($conn,50,1);

function InsertSeatsOfCinema($con,$seats, $cinemaId){
    $columns=10;
    $rowRange=$seats/$columns;
    $rows=array();
    $alphabets=range("A","Z");
    for($i= 0;$i< $rowRange ;$i++){
        $rows[]=$alphabets[$i];
    }
    $columInserted=0;
//    insert rows in alphabetical order
    for($r=0;$r<$rowRange;$r++){
//        insert columns in numbers
        for($c=$columInserted;$c<(10*($r+1));$c++){

            $sql= "INSERT INTO `seats`(`row`, `number`, `cinema_id`) VALUES ('$rows[$r]',$c+1,$cinemaId)";
            $result=$con->query($sql);
            if($con->error){
                die('query Err: '.$con->error);

            }
        }
        $columInserted=10*($r+1);

    }
    $con->close();
    return $result;

}