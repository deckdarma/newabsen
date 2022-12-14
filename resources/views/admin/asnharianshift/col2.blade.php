<div id="updateCell{{ $row->employeeID }}">
 
@if($row->date == null)
 <span class="label label-success data{{ $row->iddateshif }}" >{{ $row->nama_shift }}</span>
    <span class="label label-danger">Belum Absen</span>
@else
	

@if($row->status == "present")

@include('admin.phlharianshift.datashiftinc_status')


@else
@if($row->idleaveType ==  $row->idketerangan)
<span class="label label-success">{{  $row->keterangan }} ({{  $row->singkatan }})</span>
 @else
	 <span class="label label-success" style="background-color: #d33636;">Keterangan tidak di temukan</span>
@endif	 
 
@endif



@endif


</div>
