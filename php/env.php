<?php
$url = ".env";
// $url = "jsondata.json";
$json = file_get_contents($url);
$json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
$arr = json_decode($json,true);

if ($arr === NULL) {
  print"null";
        return;
}else{
        $json_count = count($arr["env"]["database"]);
        $bc_name = array();
        $bc_user = array();
        $bc_pass = array();
        for($i=$json_count-1;$i>=0;$i--){
            $bc_host[] = $arr["env"]["database"][$i]["host"];
            $bc_name[] = $arr["env"]["database"][$i]["name"];
            $bc_user[] = $arr["env"]["database"][$i]["user"];
            $bc_pass[] = $arr["env"]["database"][$i]["pass"];
        }

        print"練習";
        $a = 0;
        while ($a != 3) {
print"
dbhost: $bc_host[$a] <br>
dbname: $bc_name[$a] <br>
dbuser: $bc_user[$a] <br>
dbpass: $bc_pass[$a] <br>
";
            $a++;
        }

}
 ?>
