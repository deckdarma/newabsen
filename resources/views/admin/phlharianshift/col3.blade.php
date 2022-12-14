<div id="updateCell{{ $row->employeeID }}">
@if($row->date == null)
-
@else


@if($row->status == "present")


@include('admin.phlharianshift.datashiftinc')




@else
-
@endif
@endif



</div>
