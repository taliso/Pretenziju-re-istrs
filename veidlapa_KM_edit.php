
 
 


<?php

$agents=$_SESSION['AGENTS'];

if ($_SESSION['PRET_STATUS']=="NEW") {
	$reg_nr="";
	$veids="";
	$dokumenta_datums="";
	$sanemsanas_datums="";
	$registr_datums="";
	$konstat_datums="";
	$pret_id="";
	$iesniedzejs="";
	$agents="";
	$produkcija="";
	$pasutijuma_nr="";
	$daudzums_viss="";
	$daudzums_pieg_part="";
	$pieg_part_nr="";
	$daudzums_atsev_paneli="";
	$daudzums_kvmet=" 0.00       ";
	$daudzums_kubmet="";
	$no_partijas="";
	$par_laiks="";
	$par_daudzumu="";
	$par_bojats="";
	$par_kvalitati="";
	$par_izkr_trans="";
	$par_izkr_iepak="";
	$par_izkr_izpak="";
	$par_piemont_jaun="";
	$par_piemont_ekspl="";
	$beigu_dat="";
	$noform_pardev="";
	$noform_e_pasts="";
	$noform_oficial="";
	$iesniegts_nav="";
	$iesniegts_panel_foto="";
	$iesniegts_mark_foto="";
	$obl_dok_crm="";
	$obl_dok_akts="";
	$apraksts="";
	$file_foto="";
	$file_pas="";
	$file_apr="";
	$status="";
	$notikumu_sk="";
	$atbildigais="";
	$budzets="";
	$uzd_izpilda="";
	$akt_uzdevums="";
	$uzd_termins="";
	$sakuma_datums="";
	$nosutits_admin="";
	$nosutits_razosana="";
	$nosutits_logistika="";
	$nosutits_tehniki="";
	$atbildes_datums="";
	$saskanots_ar_klientu="";
	$vienosanas="";
	$beigu_dat="";
	
} else {
	if (strlen($_SESSION['PRET_ID'])>0){
		$pret_id=$_SESSION['PRET_ID'];
		$sql ="SELECT * FROM tp_pretenzijas.pretenzijas where pret_id='$pret_id'";
		$q = $db->query($sql);
		$pret="";
		while($r = $q->fetch(PDO::FETCH_ASSOC)){
			$pret=$r;
		}

		$reg_nr=$pret['reg_nr'];
		$veids=$pret['veids'];
		$dokumenta_datums=$pret['dokumenta_datums'];
		$sanemsanas_datums=$pret['sanemsanas_datums'];
		$registr_datums=$pret['registr_datums'];
		$konstat_datums=$pret['konstat_datums'];
		$pret_id=$pret['pret_id'];
		$iesniedzejs=$pret['iesniedzejs'];
		$agents=$pret['agents'];
		$produkcija=$pret['produkcija'];
		$pasutijuma_nr=$pret['pasutijuma_nr'];
		$daudzums_viss=$pret['daudzums_viss'];
		$daudzums_pieg_part=$pret['daudzums_pieg_part'];
		$pieg_part_nr=$pret['pieg_part_nr'];
		$daudzums_atsev_paneli=$pret['daudzums_atsev_paneli'];
		$daudzums_kvmet=$pret['daudzums_kvmet'];
		$daudzums_kubmet=$pret['daudzums_kubmet'];
		$no_partijas=$pret['no_partijas'];
		$par_laiks=$pret['par_laiks'];
		$par_daudzumu=$pret['par_daudzumu'];
		$par_bojats=$pret['par_bojats'];
		$par_kvalitati=$pret['par_kvalitati'];
		$par_izkr_trans=$pret['par_izkr_trans'];
		$par_izkr_iepak=$pret['par_izkr_iepak'];
		$par_izkr_izpak=$pret['par_izkr_izpak'];
		$par_piemont_jaun=$pret['par_piemont_jaun'];
		$par_piemont_ekspl=$pret['par_piemont_ekspl'];
		$beigu_dat=$pret['beigu_dat'];
		$noform_pardev=$pret['noform_pardev'];
		$noform_e_pasts=$pret['noform_e_pasts'];
		$noform_oficial=$pret['noform_oficial'];
		$iesniegts_nav=$pret['iesniegts_nav'];
		$iesniegts_panel_foto=$pret['iesniegts_panel_foto'];
		$iesniegts_mark_foto=$pret['iesniegts_mark_foto'];
		$obl_dok_crm=$pret['obl_dok_crm'];
		$obl_dok_akts=$pret['obl_dok_akts'];
		$apraksts=$pret['apraksts'];
		$file_foto=$pret['file_foto'];
		$file_pas=$pret['file_pas'];
		$file_apr=$pret['file_apr'];
		$status=$pret['status'];
		$notikumu_sk=$pret['notikumu_sk'];
		$atbildigais=$pret['atbildigais'];
		$budzets=$pret['budzets'];
		$uzd_izpilda=$pret['uzd_izpilda'];
		$akt_uzdevums=$pret['akt_uzdevums'];
		$uzd_termins=$pret['uzd_termins'];
		$sakuma_datums=$pret['sakuma_datums'];
		$nosutits_admin=$pret['nosutits_admin'];
		$nosutits_razosana=$pret['nosutits_razosana'];
		$nosutits_logistika=$pret['nosutits_logistika'];
		$nosutits_tehniki=$pret['nosutits_tehniki'];
		$atbildes_datums=$pret['atbildes_datums'];
		$saskanots_ar_klientu=$pret['saskanots_ar_klientu'];
		$vienosanas=$pret['vienosanas'];
		$beigu_dat=$pret['beigu_dat'];
	}
	
	
}
if (isset($_POST['pret_save'])) {
	include 'veidlapa_KM_save.php';
	$_SESSION['STATUS'] = "LIST";
	$_SESSION['FORMA'] = 'pret_list.php';
	if ($_SESSION['PRET_STATUS']=='NEW') {
		$to='talis@tenax.lv';
		$sub='Ir registreta jauna pretenzija Nr. '.$_SESSION['PRET_ID'];
		$body='Ir registreta jauna pretenzija Nr. '.$_SESSION['PRET_ID'].'. Ludzu nozimet atbildigos.';
			
		$mail->addAddress($to);               // Name is optional
		$mail->Subject = $sub;
		$mail->Body    = $body;
			
		if(!$mail->send()) {
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
			echo 'E-pasts ir nosūtīts. Par jaunu pretenziju.';
		}
		
	} else {
	
			$to='service@tenax.lv';
			$sub='Pretenzija Nr. '.$_SESSION['PRET_ID'].' ir labota.';
			$body='Pretenzija Nr. '.$_SESSION['PRET_ID'].' ir labota.';
			
			$mail->addAddress($to);               // Name is optional
			$mail->Subject = $sub;
			$mail->Body    = $body;
			
			if(!$mail->send()) {
				echo 'Message could not be sent.';
				echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
				echo 'E-pasts ir nosūtīts. Par labošanu.';
			}
	}
	}
if (isset($_POST['pret_cancel'])) {
	
}
?>
 
 <div id="saturs">
<form action="#" method="post">
	<?php
	if($_SESSION['STATUS']=="NEW"){
		$pret_id=$_SESSION['PREFIKS']." - ".($_SESSION['REG_NR']+1);
	} else {
		$pret_id=$_SESSION['PREFIKS']." - ".$_SESSION['REG_NR'];
	}
	
	
	echo "<div id='divFormTitle'>Pretenzija Nr. ".$pret_id."  </div>";
	?>
<!-- ###################   TABULA            ################################################# -->	
	<table>


	  <tr>  <!-- 1 -->
	    <td class="npk">1.</td>
	    <td class="teksts">Šī dokumenta noformēšanas datums</td>
	    <td class="atstarpe"></td>
	    <td class="ievade">
	    	<input ID="dokumenta_datums" type="text" name="dokumenta_datums" value="<?php echo $dokumenta_datums ; ?>">
	    </td>
	  </tr>


	  <tr>  <!--2  -->
	    <td class="npk">2.</td>
	    <td class="teksts">TENAPORS pārdevēja vārds un uzvārds, kas ir pieņēmis pretenziju</td>
		<td class="atstarpe"></td>
	    <td class="ievade">
			<input ID="text_pret" type="text" name="agents" value="<?php echo $agents;  ?>">
	    </td>
	  </tr>
	  
	  
	  <tr>  <!--3  -->
	    <td class="npk">3.</td>
	    <td class="teksts">Pretenzijas iesniedzējs (Uzņēmuma/privātpersonas nosaukums)  </td>
		<td class="atstarpe"></td>
		<td>
			<input ID="text_pret" type="text" name="iesniedzejs" value="<?php echo $iesniedzejs ;	?>">
		</td>
	  </tr>


	  <tr>  <!--4  -->
	    <td class="npk">4.</td>
	    <td class="teksts">Datums, kad saņemta pretenzija</td>
		<td class="atstarpe"></td>
	    <td class="ievade">
	    	<input ID="sanemsanas_datums" type="text" name="sanemsanas_datums" value="<?php echo $sanemsanas_datums; ?>">
		</td>
	  </tr>


	  <tr>  <!-- 5 -->
	    <td class="npk">5.</td>
	    <td class="teksts">Produkta tips un biezums u.c. informācija, par kuru izteikta pretenzija</td>
   		<td class="atstarpe"></td>
      	<td class="ievade">
		    	<input ID="text_pret" type="text" name="produkcija" value="<?php echo $produkcija; ?>" size="100">
    	</td>
	   </tr>


	  <tr>  <!-- 6 -->
	    <td class="npk">6.</td>
	    <td class="teksts">Pasūtījuma numurs, uz kuru attiecas pretenzija <br> (pievienot pasūtījuma kopiju pielikumā)</td>
		<td class="atstarpe"></td>
	    <td class="ievade">
		    	<input ID="text_pret" type="text" name="pasutijuma_nr" value="<?php echo $pasutijuma_nr; ?>">
    	</td>
	  </tr>
	  

	  <tr>  <!-- 7 -->
	    <td class="npk">7.</td>
	    <td class="teksts">Preces daudzums, par kuru izteikta pretenzija</td>
		<td class="atstarpe"></td>
	    <td class="ievade">
	    	<?php
				StatCheckBox('daudzums_viss',$daudzums_viss,'Viss pasūtījums','<br>','') ;
				StatCheckBox('daudzums_pieg_part',$daudzums_pieg_part,'Piegādes partija (s) Nr.','',''); 
				echo "<input ID='text_pret' type='text' name='pieg_part_nr' value='".$pieg_part_nr."'><br>";
				StatCheckBox('daudzums_atsev_paneli',$daudzums_atsev_paneli,'Atsevišķi paneļi, veidņi  ','',''); 
				echo  "<input ID='text_pret' type='text' name='daudzums_kvmet' value='".$daudzums_kvmet."'>  kv.m. piegādes partijā (s) Nr.  <input ID='text_pret' type='text' name='no_partijas' value='".$no_partijas."'>";
			?>
	    	
	    	
	    	 
    	</td>
	  </tr>

	  
	  <tr>  <!--8  -->
	    <td class="npk">8.</td>
   	    <td class="teksts">Pretenzijas apraksts<br> (var pievienot pretenzijas aprakstu pielikumā)</td>
		<td class="atstarpe"></td>
	    <td class="ievade">
		    <textarea rows="4" cols="80" name = "apraksts">
		    	<?php echo $apraksts; ?>
			</textarea>
	  	</td>
	  </tr>

	
	  <tr>  <!-- 9  -->
	    <td class="npk">9.</td>
   	    <td class="teksts">Pretenzijas iemesls</td>
		<td class="atstarpe"></td>
	    <td class="ievade">
	    <?php
	    		StatCheckBox('par_laiks',$par_laiks,' Piegādes laiks','<br>','') ;
				StatCheckBox('par_daudzumu',$par_daudzumu,'Daudzuma neatbilstība','<br>',''); 
				StatCheckBox('par_bojats',$par_bojats,'Piegādāta bojāta prece','<br>','') ;
				StatCheckBox('par_kvalitati',$par_kvalitati,'Neatbilstoša preces kvalitāte','',''); 
				?>
	    	
	  	</td>
	  </tr>

		
	  <tr>  <!-- 10  -->
	    <td class="npk">10.</td>
   	    <td class="teksts">Iesniegtās fotofiksācijas <br> (pievienot pielikumā)</td>
		<td class="atstarpe"></td>
	    <td class="ievade">
		 <?php
				StatCheckBox('iesniegts_nav',$iesniegts_nav,'Sūdzība attiecas uz piegādes laiku (foto nav nepieciešams)','<br>',''); 
				StatCheckBox('iesniegts_panel_foto',$iesniegts_panel_foto,'Ir saņemtas preces fotofiksācija','<br>','') ;
				StatCheckBox('iesniegts_mark_foto',$iesniegts_mark_foto,' Ir saņemtas marķējuma fotofiksācijas','',''); 
				?>
	  	</td>
	  </tr>


	  <tr>  <!-- 11  -->
	    <td class="npk">11.</td>
   	    <td class="teksts">Obligāti iesniedzami dokumenti (ja ir piegādāta <br> bojāta prece vai konstatēta daudzuma neatbilstība</td>
		<td class="atstarpe"></td>
	    <td class="ievade">
			<?php
				StatCheckBox('obl_dok_crm',$obl_dok_crm,'CMR','<br>','') ;
				StatCheckBox('obl_dok_akts',$obl_dok_akts,' Pieņemšanas - nodošanas akts','',''); 
				?>
	    	
	    	
	  	</td>
	  </tr>
	
	</table>
	<input type="submit" name="pret_save" value="Saglabāt">
	<input type="submit" name="pret_cancel" value="Atcelt">
  </form>
<script>
    $( function() {
    	$( "#dokumenta_datums" ).datepicker({dateFormat: 'yy-mm-dd'});
        $( "#sanemsanas_datums" ).datepicker({dateFormat: 'yy-mm-dd'});
    } );
    
</script>

</div>