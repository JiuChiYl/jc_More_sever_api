<?
$database = "wep_com";
$table = "image_tb";
header('Access-Control-Allow-Origin: *');
// mysqli_query($link,"set names utf8");
$link = @mysqli_connect("db.wsc.org","admin","admin",$database);
$json_map = $_POST['jsonmap'];
$json_map = json_decode($json_map,true);
for($i = 0; $i < count($json_map); $i++){
    $type[$i] = $json_map[$i]['type'];
    $content[$i] = $json_map[$i]['content'];
    $aid[$i] = $json_map[$i]['id'];
    $updata = mysqli_query($link,"update image_tb set  type = '".$type[$i]."' where id = '".$aid[$i]."'");
    $updata2 = mysqli_query($link,"update image_tb set  content = '".$content[$i]."' where id = '".$aid[$i]."'");
// echo $content[$i];
}
if($updata){
    $trm['num'] = 200;
    $trm['tal'] = "保存成功！";
}else{
    $trm['num'] = 400;
    $trm['tal'] = "保存失败";
}
echo json_encode($trm);