<div id="updateCell{{ $row->employeeID }}">
<div style="display:none">
 <input type="checkbox"
       id="checkbox{{  $row->employeeID }}"
       onchange="showHide('{{ $row->employeeID }}');return false;"
       class="make-bs-switch md-check"
       data-size="small" name="checkbox[]"
       data-on-color="success" data-on-text="P" data-off-text="A"
       data-off-color="danger"
       @if($row->status == "present" || $row->date == null) checked @endif/>
<input type="hidden" name="employees[]" value="{{ $row->employeeID }}">
</div>

@if($row->date == null)
    <span class="label label-danger">Belum Absen</span>
@else
	

@if($row->status == "present")

<span class="label label-success">Sudah Absen</span>

@else
@if($row->idleaveType ==  $row->idketerangan)
<span class="label label-success">Keterangan: {{  $row->leaveType }}</span>
 @else
	 <span class="label label-success" style="background-color: #d33636;">Keterangan tidak di temukan</span>
@endif	 
 
@endif



@endif


</div>
