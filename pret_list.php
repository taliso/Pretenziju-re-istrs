<?php

$pref=$_SESSION['PREFIKS'];
echo $pref;
$sql = 'SELECT * FROM pretenzijas where veids="'.$pref.'"';

msg('pret_list L:7   '.$sql);

$q = $db->query($sql);
$r = $q->fetch(PDO::FETCH_ASSOC);



$col_name=array('Reģ.Nr.','Datums','Pasūt.Nr','Sūdzmanis','Produkcija','Aģents');
echo '<table>';
$col_count=5;
$rin="";
for($kk=0;$kk<=$col_count;$kk++){
 	$rin=$rin.'<td class="tcol'.$kk.'">'.$col_name[$kk].'</td>';
 }
echo $rin;
var_dump($r);
//while($r = $q->fetch(PDO::FETCH_ASSOC)){
	$pret_list=array($r['veids']."-".$r['reg_nr'],$r['dokumenta_datums'],$r['pasutijuma_nr'],$r['iesniedzejs'],$r['produkcija'],$r['agents']);
	var_dump('aaa'.$pret_list);
$rin="";
$rin=list_row($col_count,$pret_list);
echo $rin;

//}

echo '</table>';
?>

