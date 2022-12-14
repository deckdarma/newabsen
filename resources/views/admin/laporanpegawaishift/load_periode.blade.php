	<?php		
$jam_buka_periode = $data->jam_masuk; 
$jam_pulang_periode = $data->jam_pulang; 
$jam_akhir_masuk_periode = $data->jam_akhir_masuk; 
$jam_akhir_pulang_periode = $data->jam_akhir_pulang; 
$ontime_masuk_periode = $data->ONTIME_masuk; 
$ontime_pulang_periode = $data->ONTIME_pulang; 
$skor1_mulai_periode = $data->SKOR1_masuk;
$skor1_akhir_periode = $data->SKOR1_pulang;
$skor2_mulai_periode = $data->SKOR2_masuk; 
$skor2_akhir_periode = $data->SKOR2_pulang;
$skor3_mulai_periode = $data->SKOR3_masuk;
$skor3_akhir_periode = $data->SKOR3_pulang;
$skor4_mulai_periode = $data->SKOR4_masuk;
$skor4_akhir_periode = $data->SKOR4_pulang;
$data_periode = $data->masuk;
$jammulai_periode = date("H:i:s", strtotime($data_periode));



			if (( strtotime($jammulai_periode) >= strtotime("$jam_buka_periode") ) and (strtotime($jammulai_periode) <= strtotime("$ontime_pulang_periode"))  )
			$status2="ONTIME";
			else if (( strtotime($jammulai_periode) >= strtotime("$jam_buka_periode") ) and (strtotime($jammulai_periode) <= strtotime("$ontime_pulang_periode"))  )
			$status2="ONTIME";
			else if (( strtotime($jammulai_periode) >= strtotime("$skor1_mulai_periode") ) and (strtotime($jammulai_periode) <= strtotime("$skor1_akhir_periode"))  )
			$status2="SKOR1";
			else if (( strtotime($jammulai_periode) >= strtotime("$skor2_mulai_periode") ) and (strtotime($jammulai_periode) <= strtotime("$skor2_akhir_periode"))  )
			$status2="SKOR2";
			else if (( strtotime($jammulai_periode) >= strtotime("$skor3_mulai_periode") ) and (strtotime($jammulai_periode) <= strtotime("$skor3_akhir_periode"))  )
			$status2="SKOR3";
		
			else if (( strtotime($jammulai_periode) >= strtotime("$skor4_mulai_periode") ) and (strtotime($jammulai_periode) <= strtotime("$skor4_akhir_periode")))
			$status2="SKOR4";

			else if (( strtotime($jammulai_periode) >= strtotime("$jam_akhir_masuk_periode") ) and (strtotime($jammulai_periode) <= strtotime("24:00:00"))  )
			$status2= "1";

			else if (( strtotime("00:00:00") <= strtotime("$jam_buka_periode") )  )
			$status2= "1";



?>