<div class="block page-content">
<table class="table Roboto szhalf" cellspacing="0" cellpadding="4">
<tr>
	<th>Name</th>
	<th>Title</th>
	<th>PV</th>
	<th>BV</th>
	<th>PGPV</th>
	<th>PGBV</th>
	<th>EPV</th>
	<th>RollUp</th>
	<th>GPV</th>
	<th>CGPV</th>
	<th>Comm</th>
</tr>
<?php foreach($allusers as $a){
	if(strpos($a['PaidTitle'], "Non") == false){
	?>
	<tr>
		<td class="left right bottom text-align-left"><?=$a['mcaName']?></td>
		<td class="left right bottom text-align-left"><?=$a['PaidTitle']?></td>
		<td class="left right bottom text-align-right"><?=$a['PV']?></td>
		<td class="left right bottom text-align-right"><?=$a['BV']?></td>
		<td class="left right bottom text-align-right"><?=$a['PGPV']?></td>
		<td class="left right bottom text-align-right"><?=$a['PGBV']?></td>
		<td class="left right bottom text-align-right"><?=$a['ExtraPV']?></td>
		<td class="left right bottom text-align-right"><?=$a['RollUpPV']?></td>
		<td class="left right bottom text-align-right"><?=$a['GPV']?></td>
		<td class="left right bottom text-align-right"><?=$a['GrossPV']?></td>
		<td class="left right bottom text-align-right"><?=$a['Gross']?></td>
	</tr>
<?php 
		$TitleTable = array();
		switch ($a['PaidTitle']) {
			case "Global Black Diamond Director (Qualified)":
				$GBDDCount = $GBDDCount + 1;
				$GBDDPV = $GBDDPV + $a['PV'];
				$GBDDBV = $GBDDBV + $a['BV'];
				$GBDDPGPV = $GBDDPGPV + $a['PGPV'];
				$GBDDPGBV = $GBDDPGBV + $a['PGBV'];
				$GBDDEPV = $GBDDEPV + $a['ExtraPV'];
				$GBDDRoll = $GBDDRoll + $a['RollUpPV'];
				$GBDDGPV = $GBDDGPV + $a['GPV'];
				$GBDDCGPV = $GBDDCGPV + $a['GrossPV'];
				$GBDDComm = $GBDDComm + $a['Gross'];
			break;
			case "Royal Black Diamond Director (Qualified)":
				$RBDDCount = $RBDDCount + 1;
				$RBDDPV = $RBDDPV + $a['PV'];
				$RBDDBV = $RBDDBV + $a['BV'];
				$RBDDPGPV = $RBDDPGPV + $a['PGPV'];
				$RBDDPGBV = $RBDDPGBV + $a['PGBV'];
				$RBDDEPV = $RBDDEPV + $a['ExtraPV'];
				$RBDDRoll = $RBDDRoll + $a['RollUpPV'];
				$RBDDGPV = $RBDDGPV + $a['GPV'];
				$RBDDCGPV = $RBDDCGPV + $a['GrossPV'];
				$RBDDComm = $RBDDComm + $a['Gross'];
			break;
			case "Crown Diamond Director (Qualified)":
				$CDDCount = $CDDCount + 1;
				$CDDPV = $CDDPV + $a['PV'];
				$CDDBV = $CDDBV + $a['BV'];
				$CDDPGPV = $CDDPGPV + $a['PGPV'];
				$CDDPGBV = $CDDPGBV + $a['PGBV'];
				$CDDEPV = $CDDEPV + $a['ExtraPV'];
				$CDDRoll = $CDDRoll + $a['RollUpPV'];
				$CDDGPV = $CDDGPV + $a['GPV'];
				$CDDCGPV = $CDDCGPV + $a['GrossPV'];
				$CDDComm = $CDDComm + $a['Gross'];
			break;
			case "Presidential Director (Qualified)":
				$PRDCount = $PRDCount + 1;
				$PRDPV = $PRDPV + $a['PV'];
				$PRDBV = $PRDBV + $a['BV'];
				$PRDPGPV = $PRDPGPV + $a['PGPV'];
				$PRDPGBV = $PRDPGBV + $a['PGBV'];
				$PRDEPV = $PRDEPV + $a['ExtraPV'];
				$PRDRoll = $PRDRoll + $a['RollUpPV'];
				$PRDGPV = $PRDGPV + $a['GPV'];
				$PRDCGPV = $PRDCGPV + $a['GrossPV'];
				$PRDComm = $PRDComm + $a['Gross'];
			break;
			case "Platinum Director (Qualified)":
				$PLDCount = $PLDCount + 1;
				$PLDPV = $PLDPV + $a['PV'];
				$PLDBV = $PLDBV + $a['BV'];
				$PLDPGPV = $PLDPGPV + $a['PGPV'];
				$PLDPGBV = $PLDPGBV + $a['PGBV'];
				$PLDEPV = $PLDEPV + $a['ExtraPV'];
				$PLDRoll = $PLDRoll + $a['RollUpPV'];
				$PLDGPV = $PLDGPV + $a['GPV'];
				$PLDCGPV = $PLDCGPV + $a['GrossPV'];
				$PLDComm = $PLDComm + $a['Gross'];
			break;
			case "Senior Executive Director (Qualified)":
				$SEDCount = $SEDCount + 1;
				$SEDPV = $SEDPV + $a['PV'];
				$SEDBV = $SEDBV + $a['BV'];
				$SEDPGPV = $SEDPGPV + $a['PGPV'];
				$SEDPGBV = $SEDPGBV + $a['PGBV'];
				$SEDEPV = $SEDEPV + $a['ExtraPV'];
				$SEDRoll = $SEDRoll + $a['RollUpPV'];
				$SEDGPV = $SEDGPV + $a['GPV'];
				$SEDCGPV = $SEDCGPV + $a['GrossPV'];
				$SEDComm = $SEDComm + $a['Gross'];
			break;
			case "Executive Director (Qualified)":
				$EDCount = $EDCount + 1;
				$EDPV = $EDPV + $a['PV'];
				$EDBV = $EDBV + $a['BV'];
				$EDPGPV = $EDPGPV + $a['PGPV'];
				$EDPGBV = $EDPGBV + $a['PGBV'];
				$EDEPV = $EDEPV + $a['ExtraPV'];
				$EDRoll = $EDRoll + $a['RollUpPV'];
				$EDGPV = $EDGPV + $a['GPV'];
				$EDCGPV = $EDCGPV + $a['GrossPV'];
				$EDComm = $EDComm + $a['Gross'];
			break;
			case "Senior Director (Qualified)":
				$SDCount = $SDCount + 1;
				$SDPV = $SDPV + $a['PV'];
				$SDBV = $SDBV + $a['BV'];
				$SDPGPV = $SDPGPV + $a['PGPV'];
				$SDPGBV = $SDPGBV + $a['PGBV'];
				$SDEPV = $SDEPV + $a['ExtraPV'];
				$SDRoll = $SDRoll + $a['RollUpPV'];
				$SDGPV = $SDGPV + $a['GPV'];
				$SDCGPV = $SDCGPV + $a['GrossPV'];
				$SDComm = $SDComm + $a['Gross'];
			break;
			case "Director (Qualified)":
				$DirCount = $DirCount + 1;
				$DirPV = $DirPV + $a['PV'];
				$DirBV = $DirBV + $a['BV'];
				$DirPGPV = $DirPGPV + $a['PGPV'];
				$DirPGBV = $DirPGBV + $a['PGBV'];
				$DirEPV = $DirEPV + $a['ExtraPV'];
				$DirRoll = $DirRoll + $a['RollUpPV'];
				$DirGPV = $DirGPV + $a['GPV'];
				$DirCGPV = $DirCGPV + $a['GrossPV'];
				$DirComm = $DirComm + $a['Gross'];
			break;
			default:
			break;
		}
	}
}?>
<tr>
	<th colspan="2" class="left right bottom text-align-right">Title</th>
	<th>PV</th>
	<th>BV</th>
	<th>PGPV</th>
	<th>PGBV</th>
	<th>EPV</th>
	<th>RollUp</th>
	<th>GPV</th>
	<th>CGPV</th>
	<th>Comm</th>
</tr>
	<tr>
		<td colspan="2" class="left right bottom text-align-right">Director (Qualified) (<?=$DirCount?>)</td>
		<td class="left right bottom text-align-right"><?=$DirPV?></td>
		<td class="left right bottom text-align-right"><?=$DirBV?></td>
		<td class="left right bottom text-align-right"><?=$DirPGPV?></td>
		<td class="left right bottom text-align-right"><?=$DirPGBV?></td>
		<td class="left right bottom text-align-right"><?=$DirEPV?></td>
		<td class="left right bottom text-align-right"><?=$DirRoll?></td>
		<td class="left right bottom text-align-right"><?=$DirGPV?></td>
		<td class="left right bottom text-align-right"><?=$DirCGPV?></td>
		<td class="left right bottom text-align-right"><?=$DirComm?></td>
	</tr>
	<tr>
		<td colspan="2" class="left right bottom text-align-right">Senior Director (Qualified) (<?=$SDCount?>)</td>
		<td class="left right bottom text-align-right"><?=$SDPV?></td>
		<td class="left right bottom text-align-right"><?=$SDBV?></td>
		<td class="left right bottom text-align-right"><?=$SDPGPV?></td>
		<td class="left right bottom text-align-right"><?=$SDPGBV?></td>
		<td class="left right bottom text-align-right"><?=$SDEPV?></td>
		<td class="left right bottom text-align-right"><?=$SDRoll?></td>
		<td class="left right bottom text-align-right"><?=$SDGPV?></td>
		<td class="left right bottom text-align-right"><?=$SDCGPV?></td>
		<td class="left right bottom text-align-right"><?=$SDComm?></td>
	</tr>
		<tr>
		<td colspan="2" class="left right bottom text-align-right">Executive Director (Qualified) (<?=$EDCount?>)</td>
		<td class="left right bottom text-align-right"><?=$EDPV?></td>
		<td class="left right bottom text-align-right"><?=$EDBV?></td>
		<td class="left right bottom text-align-right"><?=$EDPGPV?></td>
		<td class="left right bottom text-align-right"><?=$EDPGBV?></td>
		<td class="left right bottom text-align-right"><?=$EDEPV?></td>
		<td class="left right bottom text-align-right"><?=$EDRoll?></td>
		<td class="left right bottom text-align-right"><?=$EDGPV?></td>
		<td class="left right bottom text-align-right"><?=$EDCGPV?></td>
		<td class="left right bottom text-align-right"><?=$EDComm?></td>
	</tr>
		<tr>
		<td colspan="2" class="left right bottom text-align-right">Senior Executive Director (Qualified) (<?=$SEDCount?>)</td>
		<td class="left right bottom text-align-right"><?=$SEDPV?></td>
		<td class="left right bottom text-align-right"><?=$SEDBV?></td>
		<td class="left right bottom text-align-right"><?=$SEDPGPV?></td>
		<td class="left right bottom text-align-right"><?=$SEDPGBV?></td>
		<td class="left right bottom text-align-right"><?=$SEDEPV?></td>
		<td class="left right bottom text-align-right"><?=$SEDRoll?></td>
		<td class="left right bottom text-align-right"><?=$SEDGPV?></td>
		<td class="left right bottom text-align-right"><?=$SEDCGPV?></td>
		<td class="left right bottom text-align-right"><?=$SEDComm?></td>
	</tr>
		<tr>
		<td colspan="2" class="left right bottom text-align-right">Platinum Director (Qualified) (<?=$PLDCount?>)</td>
		<td class="left right bottom text-align-right"><?=$PLDPV?></td>
		<td class="left right bottom text-align-right"><?=$PLDBV?></td>
		<td class="left right bottom text-align-right"><?=$PLDPGPV?></td>
		<td class="left right bottom text-align-right"><?=$PLDPGBV?></td>
		<td class="left right bottom text-align-right"><?=$PLDEPV?></td>
		<td class="left right bottom text-align-right"><?=$PLDRoll?></td>
		<td class="left right bottom text-align-right"><?=$PLDGPV?></td>
		<td class="left right bottom text-align-right"><?=$PLDCGPV?></td>
		<td class="left right bottom text-align-right"><?=$PLDComm?></td>
	</tr>
		<tr>
		<td colspan="2" class="left right bottom text-align-right">Presidential Director (Qualified) (<?=$PRDCount?>)</td>
		<td class="left right bottom text-align-right"><?=$PRDPV?></td>
		<td class="left right bottom text-align-right"><?=$PRDBV?></td>
		<td class="left right bottom text-align-right"><?=$PRDPGPV?></td>
		<td class="left right bottom text-align-right"><?=$PRDPGBV?></td>
		<td class="left right bottom text-align-right"><?=$PRDEPV?></td>
		<td class="left right bottom text-align-right"><?=$PRDRoll?></td>
		<td class="left right bottom text-align-right"><?=$PRDGPV?></td>
		<td class="left right bottom text-align-right"><?=$PRDCGPV?></td>
		<td class="left right bottom text-align-right"><?=$PRDComm?></td>
	</tr>
		<tr>
		<td colspan="2" class="left right bottom text-align-right">Crown Diamond Director (Qualified) (<?=$CDDCount?>)</td>
		<td class="left right bottom text-align-right"><?=$CDDPV?></td>
		<td class="left right bottom text-align-right"><?=$CDDBV?></td>
		<td class="left right bottom text-align-right"><?=$CDDPGPV?></td>
		<td class="left right bottom text-align-right"><?=$CDDPGBV?></td>
		<td class="left right bottom text-align-right"><?=$CDDEPV?></td>
		<td class="left right bottom text-align-right"><?=$CDDRoll?></td>
		<td class="left right bottom text-align-right"><?=$CDDGPV?></td>
		<td class="left right bottom text-align-right"><?=$CDDCGPV?></td>
		<td class="left right bottom text-align-right"><?=$CDDComm?></td>
	</tr>
		<tr>
		<td colspan="2" class="left right bottom text-align-right">Royal Black Diamond Director (Qualified) (<?=$RBDDCount?>)</td>
		<td class="left right bottom text-align-right"><?=$RBDDPV?></td>
		<td class="left right bottom text-align-right"><?=$RBDDBV?></td>
		<td class="left right bottom text-align-right"><?=$RBDDPGPV?></td>
		<td class="left right bottom text-align-right"><?=$RBDDPGBV?></td>
		<td class="left right bottom text-align-right"><?=$RBDDEPV?></td>
		<td class="left right bottom text-align-right"><?=$RBDDRoll?></td>
		<td class="left right bottom text-align-right"><?=$RBDDGPV?></td>
		<td class="left right bottom text-align-right"><?=$RBDDCGPV?></td>
		<td class="left right bottom text-align-right"><?=$RBDDComm?></td>
	</tr>
		<tr>
		<td colspan="2" class="left right bottom text-align-right">Global Black Diamond Director (Qualified) (<?=$GBDDCount?>)</td>
		<td class="left right bottom text-align-right"><?=$GBDDPV?></td>
		<td class="left right bottom text-align-right"><?=$GBDDBV?></td>
		<td class="left right bottom text-align-right"><?=$GBDDPGPV?></td>
		<td class="left right bottom text-align-right"><?=$GBDDPGBV?></td>
		<td class="left right bottom text-align-right"><?=$GBDDEPV?></td>
		<td class="left right bottom text-align-right"><?=$GBDDRoll?></td>
		<td class="left right bottom text-align-right"><?=$GBDDGPV?></td>
		<td class="left right bottom text-align-right"><?=$GBDDCGPV?></td>
		<td class="left right bottom text-align-right"><?=$GBDDComm?></td>
	</tr>
	<?php 
 
?>
</table>
<hr>
<?php 
foreach($FindLevel as $f){
	print_r($f);
	
}

?>
</div>