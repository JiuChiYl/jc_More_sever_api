<?
$database = "wep_com";
$table = "image_tb";
header('Access-Control-Allow-Origin: *');
$link = @mysqli_connect("db.wsc.org","admin","admin",$database);
@mysqli_query($link,"set names utf8mb4");
$select = @mysqli_query($link,"SELECT * FROM ".$table." ORDER BY id DESC");

$res['data_num'] = @mysqli_num_rows($select);
$res['database'] = $database;
$res['table_name'] = $table;

if(!$link){
    $res['cont'] = "Anomaly";
    $res['cutnt'] = 400;
}else{
    $res['cont'] = "Normal";
    $res['cutnt'] = 200;
}
if($res['cutnt'] == 200){
    if(!empty($_FILES['upfile'])){
        $file_name = $_FILES['upfile']['name'];
        $file_tmp_name = $_FILES['upfile']['tmp_name'];
        for($i = 0; $i < count($file_name); $i++){
            if($file_name[$i] != ''){
                $up_url = 'img';
                if(!file_exists($$up_url)){
                    @$result = mkdir($up_url);
                }
                $unName = md5(uniqid(microtime(true),true));
                $ext[$i] = strtolower(pathinfo($file_name[$i],PATHINFO_EXTENSION));
                $datae[$i] = $up_url.'/'.$unName.'.'.$ext[$i];
                $gofi = move_uploaded_file($file_tmp_name[$i],$datae[$i]);
                $rst[] = $datae[$i];
                // 
                $stmt = mysqli_prepare($link,"INSERT INTO image_tb (url) VALUE(?)");
                mysqli_stmt_bind_param($stmt,'s',$datae[$i]);
                mysqli_stmt_execute($stmt);
                // 
            }
        }
    }
    if($gofi){
        $res['num'] = 200;
        $res['file'] = $rst;
        $res['tal'] = $i."个文件已成功上传!";
    }else{
        $res['num'] = 400;
        $res['tal'] = "上传失败!";
    }
}else{
    $res['num'] = 400;
    $res['tal'] = "与数据库连接时出现异常";
}
echo json_encode($res);