<?php
$event_sk=0;
$pret_events=array();

$kl_events = sqltoarray(' * ','kl_notikumi','',$db);

$sql = "SELECT * FROM notikumi where pret_id='".$_SESSION['PRET_ID']."'";
$q = $db->query($sql);
while($r = $q->fetch(PDO::FETCH_ASSOC)){
	$pret_events[]=$r;
}
$event_sk=count($pret_events);
$izd_sum=0;
$event_count=0;
foreach ($pret_events as $one_event){
	$izd_sum=$izd_sum + $one_event['izdevumi'];
	$event_count=$event_count+1;
}
$_SESSION['NOTIKUMU_SK']=$event_sk;
$_SESSION['IZDEVUMI']=$izd_sum;
?>


 <div id="divEventForm">
	<div id="divEventFormTitle">
		<table style="width:100%;">
			<tr>
				<td>
					<span id= "span_18_gaish">Pretenzijas</span>
					<span id= "span_18_yealow"> <?php echo $_SESSION['PRET_ID']; ?></span>
					<span id= "span_18_gaish"> risinājums</span>
					</td>
				<td>
					<span id= "span_18_gaish">Sākums:</span>
					<span id= "span_18_yealow"> <?php echo $_SESSION['SAKUMA_DATUMS']; ?> </span>
					</td>
				<td>
					<span id= "span_18_gaish">Beigas:</span>
					<span id= "span_18_yealow"><?php echo $_SESSION['BEIGU_DAT']; ?> </span>
					</td>
			</tr>
		</table>
		
	</div>   <!-- <divEventFormTitle>  -->
	<table style="width:100%;">
		<tr>
			
			<td style="width:12%;">
				<span id="evspan2">Pievienot jaunu notikumu >:</span></td>
			
			<td style="width:100%; float:left;">
	
					<a id='mnaEvent' href="?addev=mnTask">Uzdevumu</a>
					<a id='mnaEvent' href="?addev=mnInfo">Ziņojumu</a>
					<a id='mnaEvent' href="?addev=mnRezult">Lēmumu</a>
					<a id='mnaEvent' href="?addev=mnKorekt">Korektīvās darbības</a>
			
			</td>

			<td style="width:10%;">
				<span id="span_14_br"><?php  echo  $ev_nos;  ?></span>
				<?php  if(strlen($ev_nos)>0) {  ?>
					<input type="submit" style="float:right;" name="new_event_create" value="Pievienot">
				<?php } ?>	
			</td>
		</tr>	
	</table>	

	<?php 
	if ($_SESSION['STATUS']=='NEWEVENT'&&strlen($_SESSION['EVENT_FORMA'])>0) {
		include $_SESSION['EVENT_FORMA'];
	}?>
	
	
	
	
</div>   <!-- <divEventForm>  -->
<?php
$sql = "SELECT * FROM notikumi where pret_id='".$_SESSION['PRET_ID']."'";
$q = $db->query($sql);
while($r = $q->fetch(PDO::FETCH_ASSOC)){
	$pret_events[]=$r;
}

foreach ($pret_events as $one_event){?>
	<div id="divEventForm">
		<?php 
		 //include 'event_view1.php';
        include 'ev_task_view.php';?>
	</div>
<?php 

} ?>

