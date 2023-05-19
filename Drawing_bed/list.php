<?
header('Access-Control-Allow-Origin: *');
$link = mysqli_connect("db.wsc.org","admin","admin","wep_com");


if($_GET['scdat']){
    $lai = $_GET['scdat'];
    $selecta = mysqli_query($link,"SELECT * FROM image_tb WHERE type LIKE'%$lai%' OR content LIKE '%$lai%'");
    while($ret = mysqli_fetch_array($selecta,MYSQLI_ASSOC)){
        $data[] = $ret;
    }
}else{
    $select = mysqli_query($link,"SELECT * FROM image_tb ORDER BY date DESC");
    
    while($row = mysqli_fetch_array($select,MYSQLI_ASSOC)){
        $data[] = $row;
    }
    
}
echo json_encode($data);