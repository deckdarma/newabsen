<div id="updateCell{{ $row->employeeID }}">
@if($row->date == null)
  -
@else



@if($row->status == "present")
@include('admin.asnharianshift.datashiftinc_masuk')

				
@else
-
@endif
















@endif

</div>

