@if($row->leaveType == "1338" OR $row->leaveType == NULL)
<input type="checkbox"
       id="checkbox{{  $row->employeeID }}"
       onchange="showHide('{{ $row->employeeID }}');return false;"
       class="make-bs-switch md-check"
       data-size="small" name="checkbox[]"
       data-on-color="danger" data-on-text="Tidak" data-off-text="Pagi"
       data-off-color="success"
       @if($row->status == "alpha" || $row->date == null) checked @endif/>
<input type="hidden" name="employees[]" value="{{ $row->employeeID }}">

<div class="leave-form @if($row->status == "alpha" || $row->status == null) hidden @endif"
     id="leaveForm{{  $row->employeeID }}">
 
</div>
@else
Pegawai berada dalam  {{  $row->nama_shift }}	
@endif