	<?php		
$jam_buka_periode_jumat = $data->jam_masuk_jumat; 
$jam_pulang_periode_jumat = $data->jam_pulang_jumat; 
$jam_akhir_masuk_periode_jumat = $data->jam_akhir_masuk_jumat; 
$jam_akhir_pulang_periode_jumat = $data->jam_akhir_pulang_jumat; 
$ontime_masuk_periode_jumat = $data->ONTIME_masuk_jumat; 
$ontime_pulang_periode_jumat = $data->ONTIME_pulang_jumat; 
$skor1_mulai_periode_jumat = $data->SKOR1_masuk_jumat;
$skor1_akhir_periode_jumat = $data->SKOR1_pulang_jumat;
$skor2_mulai_periode_jumat = $data->SKOR2_masuk_jumat; 
$skor2_akhir_periode_jumat = $data->SKOR2_pulang_jumat;
$skor3_mulai_periode_jumat = $data->SKOR3_masuk_jumat;
$skor3_akhir_periode_jumat = $data->SKOR3_pulang_jumat;
$skor4_mulai_periode_jumat = $data->SKOR4_masuk_jumat;
$skor4_akhir_periode_jumat = $data->SKOR4_pulang_jumat;
$data_periode_jumat = $data->masuk;
$jammulai_periode_jumat = date("H:i:s", strtotime($data_periode_jumat));



			if (( strtotime($jammulai_periode_jumat) >= strtotime("$jam_buka_periode_jumat") ) and (strtotime($jammulai_periode_jumat) <= strtotime("$ontime_pulang_periode_jumat"))  )
			$status1="ONTIME";
			else if (( strtotime($jammulai_periode_jumat) >= strtotime("$jam_buka_periode_jumat") ) and (strtotime($jammulai_periode_jumat) <= strtotime("$ontime_pulang_periode_jumat"))  )
			$status1="ONTIME";
			else if (( strtotime($jammulai_periode_jumat) >= strtotime("$skor1_mulai_periode_jumat") ) and (strtotime($jammulai_periode_jumat) <= strtotime("$skor1_akhir_periode_jumat"))  )
			$status1="SKOR1";
			else if (( strtotime($jammulai_periode_jumat) >= strtotime("$skor2_mulai_periode_jumat") ) and (strtotime($jammulai_periode_jumat) <= strtotime("$skor2_akhir_periode_jumat"))  )
			$status1="SKOR2";
			else if (( strtotime($jammulai_periode_jumat) >= strtotime("$skor3_mulai_periode_jumat") ) and (strtotime($jammulai_periode_jumat) <= strtotime("$skor3_akhir_periode_jumat"))  )
			$status1="SKOR3";
		
			else if (( strtotime($jammulai_periode_jumat) >= strtotime("$skor4_mulai_periode_jumat") ) and (strtotime($jammulai_periode_jumat) <= strtotime("$skor4_akhir_periode_jumat")))
			$status1="SKOR4";

			else if (( strtotime($jammulai_periode_jumat) >= strtotime("$jam_akhir_masuk_periode_jumat") ) and (strtotime($jammulai_periode_jumat) <= strtotime("24:00:00"))  )
			$status1= "1";

			else if (( strtotime("00:00:00") <= strtotime("$jam_buka_periode_jumat") )  )
			$status1= "1";



?>