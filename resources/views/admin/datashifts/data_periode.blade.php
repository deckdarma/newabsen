@if ($tampilkanhari == "friday")



@if ($carilibur !="1")  
  @if ($status !="absent")

@if ($totalStatusCount != "0")
	@if($status4 !=  "1")	

<td style="background: #5d5086;text-align: center;color: #fff;">{{ $nama_event }} Jumat</td>

<td><span class="label  label-{{  $status4 }}">{{  $status4}} ({{ $masuk }})</span>  </td>




@if ($pulang != "00:00:00")
@if (( strtotime($pulang) >=  strtotime($jam_pulang_periode_jumat)) and (strtotime($pulang) <= strtotime($jam_akhir_pulang_periode_jumat)))	
<td><center><span class="label label-success">Pulang ({{ $pulang }})</span></center></td>

@else
<td style="color:#fff;text-align: center;background-color: #eb939a;"><span class="label label-danger">Pulang Cepat</span> {{ $pulang }} </td>
@endif

@else
<td style="color:#fff;text-align: center;background-color: #eb939a;"><span class="label label-danger">Pulang Cepat</span></td>

@endif	

@if ($pulang != "00:00:00")
@if (( strtotime($pulang) >=  strtotime($jam_pulang_periode_jumat)) and (strtotime($pulang) <= strtotime($jam_akhir_pulang_periode_jumat)))	
<td><center><span class="label label-success">{{ $jamkerjapeg }}</span></center></td>

@else
<td style="text-align: center;background: #eeefe8;"><span class="label label-danger">0 jam, 0 menit </td>
@endif

@else
<td style="text-align: center;background: #eeefe8;"><span class="label label-danger">0 jam, 0 menit</span></td>

@endif

@if($apelpagi ==  "1")
<td style="color:#fff;text-align: center;background-color: #e07315;">{{ @apelpagi }}</td>
@else
<td style="color:#fff;text-align: center;background-color: #26c281;"><i class="fa  fa-check"></i></td>
@endif

@if($apelsore ==  "1")
<td style="color:#fff;text-align: center;background-color: #e07315;">Tidak Apel Sore</td>
@else
<td style="color:#fff;text-align: center;background-color: #26c281;"><i class="fa  fa-check"></i></td>
@endif

@else
<td colspan="6" style="background-color: #f00;color: #fff;text-align:center;">TANPA KETERANGAN YANG SAH</td>
@endif


@else
<td colspan="6" style="background-color: #f00;color: #fff;text-align:center;">TANPA KETERANGAN YANG SAH</td>
@endif
@else
<td colspan="6" style="text-align:center;background: #1280cf;color:#fff;">{{ $namaketerangan }} ({{ $leaveType }})</td>
@endif	


	

@else
<td colspan="6" style="text-align:center;background: #4e1010;color:#fff;">Hari Libur</td>
@endif	




@else





@if ($carilibur !="1")  
  @if ($status !="absent")

@if ($totalStatusCount != "0")
	@if($status4 !=  "1")	

<td style="background: #5b69bc;text-align: center;color: #fff;">{{ $nama_event }}</td>


<td><span class="label  label-{{  $status4 }}"> {{ $status4}} ({{ $masuk }})</span>  </td>


@if ($pulang != "00:00:00")
@if (( strtotime($pulang) >=  strtotime($jam_pulang_periode)) and (strtotime($pulang) <= strtotime($jam_akhir_pulang_periode)))	
<td><center><span class="label label-success">Pulang ({{ $pulang }})</span></center></td>

@else
<td style="color:#fff;text-align: center;background-color: #eb939a;"><span class="label label-danger">Pulang Cepat</span> {{ $pulang }} </td>
@endif

@else
<td style="color:#fff;text-align: center;background-color: #eb939a;"><span class="label label-danger">Pulang Cepat</span></td>

@endif	


@if ($pulang != "00:00:00")
@if (( strtotime($pulang) >=  strtotime($jam_pulang_periode)) and (strtotime($pulang) <= strtotime($jam_akhir_pulang_periode)))	
<td><center><span class="label label-success">{{ $jamkerjapeg }}</span></center></td>

@else
<td style="text-align: center;background: #eeefe8;"><span class="label label-danger">0 jam, 0 menit </td>
@endif

@else
<td style="text-align: center;background: #eeefe8;"><span class="label label-danger">0 jam, 0 menit</span></td>

@endif


@if($apelpagi ==  "1")
<td style="color:#fff;text-align: center;background-color: #e07315;">Tidak Apel Pagi</td>
@else
<td style="color:#fff;text-align: center;background-color: #26c281;"><i class="fa  fa-check"></i></td>
@endif

@if($apelsore ==  "1")
<td style="color:#fff;text-align: center;background-color: #e07315;">Tidak Apel Sore</td>
@else
<td style="color:#fff;text-align: center;background-color: #26c281;"><i class="fa  fa-check"></i></td>
@endif

@else
<td colspan="6" style="background-color: #f00;color: #fff;text-align:center;">TANPA KETERANGAN YANG SAH</td>
@endif


@else
<td colspan="6" style="background-color: #f00;color: #fff;text-align:center;">TANPA KETERANGAN YANG SAH</td>
@endif
@else
<td colspan="6" style="text-align:center;background: #1280cf;color:#fff;">{{ $namaketerangan }} ({{ $leaveType }})</td>
@endif	


	

@else
<td colspan="6" style="text-align:center;background: #4e1010;color:#fff;">HARI LIBUR / TIDAK ADA JAM KERJA</td>
@endif		

@endif


