<?php
 
function datums()
{
  $datums = array();
	//$sd=string; Error ????
  for($d=1;$d<=31;$d++) {
	$sd=(string)$d; //???
	$lensd=strlen($sd);
	if ($lensd<2){
		$sd="0".$sd;
	}
    $datums["diena"][] = $sd;
  }

  for($m=1;$m<=12;$m++) {
    $datums["menes"][] = $m;
  }


  for($g=2016;$g<=2018;$g++){
    $datums["gads"][] = $g;
  }

return $datums;

}

function file_upload($fails,$target_dir,$regnr){
    echo "<pre>";
//    var_dump($fails);
    echo "</pre>";

    $keys = array();
    foreach (array_keys($fails) as $k) {
        if ($fails[$k]["name"] != "") {
            $keys[] = $k;
            $kluda = 0;
            //Failu apstrāde


                        
            switch ($k) {
                case "filePas":
                    $grupa = "pas";
                    break;
                case "fileApr":
                    $grupa = "apr";                    
                    break;
                case "fileFoto":
                    $grupa = "foto";
                    break;
                default:
                    echo "Kļūda";
            }

            $faila_nos=faila_nos($regnr,$grupa,basename($fails[$k]["name"]));
            $target_file =$target_dir.$faila_nos;
            if ($fails[$k]["size"] > MAX_FILE_SIZE) {
                echo "Atvainojiet, faila izmērs ir par lielu.";
                $kluda = 1;
            } else {
                if (move_uploaded_file($fails[$k]["tmp_name"], $target_file)) {
                    echo "The file ". basename( $fails[$k]["name"]). " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }

            }



        }
    }
}

// ======================  DIENA_SELECT  ======================================================
function diena_select($fixdat)
{	
// Ja nav norādīts fixdat, pielīdzinam to šodienai
$fd=0;
		
		$fd=date("d",$fixdat);
		msg('F: diena_select R:102 '. $fd);
		$mselect_dienas="";
		for($d=1;$d<=31;$d++){
			$sd=(string)$d;
			if (strlen($sd)==1){
				$sd="0".$sd;
			}
			if ($fd==$sd) {
				$mselect_dienas=$mselect_dienas."<option value='".$sd."' selected>".$sd." </option>"."<br>";
			} else {
				$mselect_dienas=$mselect_dienas."<option value='".$sd."'>".$sd."</option>"."<br>";
			}
		}
	return $mselect_dienas;
}
// ======================  MENES_SELECT  ======================================================
function menes_select($fixdat)
{
	// Ja nav norādīts fixdat, pielīdzinam to šodienai
	//	$fixdat="";
	$fm=0;
	$fm=date("m",$fixdat);
	$mmenes_select="";
	for($m=1;$m<=12;$m++){
		$sm=(string)$m;
		if (strlen($sm)==1){
			$sm="0".$sm;
		}
		if ($fm==$sm) {
			$mmenes_select=$mmenes_select."<option value='".$sm."' selected>".$sm." </option>"."<br>";
		} else {
			$mmenes_select=$mmenes_select."<option value='".$sm."'>".$sm."</option>"."<br>";
		}
	}
	return $mmenes_select;
}

// ======================  GADS_SELECT  ======================================================
function gads_select($fixdat)
{
	// Ja nav norādīts fixdat, pielīdzinam to šodienai
	//	$fixdat="";
	$fy=0;
	$fy=date("Y",$fixdat);
	$mgads_select="";
	for($y=$fy-1;$y<=$fy+1;$y++){
		$sy=(string)$y;
		if ($fy==$sy) {
			$mgads_select=$mgads_select."<option value='".$sy."' selected>".$sy." </option>"."<br>";
		} else {
			$mgads_select=$mgads_select."<option value='".$sy."'>".$sy."</option>"."<br>";
		}
	}
	return $mgads_select;
}

// ======================  DATUMS_SELECT  ======================================================
function datums_select($fixdat,$lauka_prefiks){
	
	msg("datums selsct=".$fixdat."-".$lauka_prefiks);
	if (empty($fixdat)) {
		$fixdat=time();
	}
	else {
		$fixdat=date_create($fixdat);
		$fixdat=date_timestamp_get($fixdat);
	}
	
	$diena=diena_select($fixdat);
	$menes=menes_select($fixdat);
	$gads=gads_select($fixdat);
	$mdatums_select= "<select name='".$lauka_prefiks."_diena'>".$diena."</select><select name='".$lauka_prefiks."_menes'>".$menes."</select><select name='".$lauka_prefiks."_gads'>".$gads."</select>";
	return $mdatums_select;
}
//===============================================================================================
function msg($mteksts){	
	$log = fopen (LOGFILE,'a+');
	fwrite($log,$mteksts."\n");
	fwrite($log,
	"====================================================".date('d',time())."=".date('m',time())."======\n");
	fclose($log);
}
// ======================  LIST_ROW  ======================================================
function list_row($col_count, $var_array){
	//$row_array- Masīva struktūra: 1-mainīgais,2-nosaukums, 3-klase,
	//$var_array- parādāmo vērtību masīva, kolonnu skaitam jāsakrīt,
	
	$tab_row="";
	$tab_row= '<tr>';
	$k=0;
	for($k=0;$k<=$col_count;$k++){
		if ($k==0){
			$tab_row=$tab_row.'<td class="tcol0"><a href="?pret_id='.$var_array[$k].'">'.$var_array[$k].'</td>';
		} else {
			$tab_row=$tab_row.'<td class="tcol'.$k.'">'.$var_array[$k].'</td>';

		}
	}
	$tab_row=$tab_row.'</tr>';
	return $tab_row;
}


function NextID($mveids){
	
	$dbf = new PDO("mysql:host=".HOST.";dbname=".DB,USER,PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
	$sql = "SELECT * FROM menju where prefiks='".$mveids."'";
	$q = $dbf->query($sql);
	$r = $q->fetch(PDO::FETCH_ASSOC);
	
	$reg_nr=$r['reg_nr'];
	$reg_nr=$reg_nr++;
	
	$sql ="UPDATE tp_pretenzijas.menju SET reg_nr=".$reg_nr." WHERE prefiks=".$mveids;
	$q = $dbf->query($sql);
	
	return $reg_nr;
	
}

function check($mvert){
	$vert="";
	if ($mvert ==1){
		$vert="checked ";
	}
	return $vert;
}

function StatText($mname,$mvalue,$msize){

	$mteksts="";
	if ($_SESSION['STATUS']=='NEW'){
		$mteksts='<input type="text" name="'.$mname.'" value="" size="'.$msize.'">';
	}
	if ($_SESSION['STATUS']=='VIEW'){
		$mteksts=$mvalue;
	}
	if ($_SESSION['STATUS']=='EDIT'){
		$mteksts='<input type="text" name="'.$mname.'" value="'.$mvalue.'" size="'.$msize.'">';
	}
	echo $mteksts;
}

function StatCheckBox($mname,$mvariable,$koments,$nobeig,$status){

	
	if ($mvariable==1){
		$mcheckstat=" checked";
	}
	else{
		$mcheckstat="";
	}
	$mteksts="";
	$mteksts='<input type="checkbox" name="'.$mname.'"'.$mcheckstat.$status.'> '.$koments.$nobeig;
	echo $mteksts;
}

function MailTo($to,$sub,$body){
	$mail->addAddress($to);               // Name is optional
	$mail->Subject = $sub;
	$mail->Body    = $body;
	
	if(!$mail->send()) {
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
		echo 'E-pasts ir nosūtīts ';
	}
}

// ========================  SQL pieprasījums uz masīvu ========================================
function sqltoarray($fields,$ftabula,$fwhere,$db) {
	$sql ="SELECT ".$fields." FROM ".$ftabula;
	if (strlen($fwhere)>0){
		$sql=$sql." where ".$fwhere ;
	}
	
	$q = $db->query($sql);
	
	while($r = $q->fetch(PDO::FETCH_ASSOC)){
		$myarray[]=$r;
	}
	
	var_dump($myarray);
	
	return $myarray;

}

function sqlupdate($field,$variable,$ftabula,$fwhere,$db) {
	$sql ="UPDATE ".$ftabula." SET ".$field."='".$variable."' WHERE ".$fwhere ;
	$q = $db->query($sql);
	msg("sqlupdate=".$sql);
	return 'true';

}


function sqlinsert($ftabula,$db) {
	$sql ="UPDATE ".$ftabula." SET ".$field."='".$variable."' WHERE ".$fwhere ;
	echo $sql;
	$q = $db->query($sql);

	return 'true';

}



























