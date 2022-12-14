<div id="updateCell{{ $row->employeeID }}">



  @if ($row->nama_shift== NULL)
Belum ada jadwal
  @else
	  <span class="label label-success data{{ $row->leaveType }}">{{ $row->nama_shift }} </span>
@endif
</div>

