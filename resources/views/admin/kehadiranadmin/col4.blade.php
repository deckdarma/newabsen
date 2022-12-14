
@if($row->date == null)
<div class="row">

    <div class="col-lg-6 col-md-12">
        <label class="control-label">Masuk</label>

        <div class="input-icon input-icon-sm">
            <i class="fa fa-clock-o"></i>
            <input type="text" class="form-control clockin input-sm" id="clock_in{{ $row->employeeID }}"
                   name="clock_in[]" value="{{ $clock_in }}"/>
        </div>
    </div>
    <div class="col-lg-6 col-md-12"><label class="control-label">Pulang</label>
        <div class="input-icon input-icon-sm"><i class="fa fa-clock-o"></i>
            <input type="text" class="form-control  clockout input-sm" id="clock_out{{$row->employeeID }}"
                   name="clock_out[]" value="{{ $clock_out }}"/>
        </div>
    </div>
		       <div class="col-lg-12 col-md-12">
		      <center>  <button type="button" style="width:100%;margin-top:8px" class="btn green btn-sm" id="update_row{{ $row->employeeID }}" onclick="attendanceRow({{ $row->employeeID }})">Tambah Kehadiran</button>   </center>  
				      </div>
</div>


@else
	

@if($row->status == "present")

<div class="row">

    <div class="col-lg-6 col-md-12">
        <label class="control-label">Masuk</label>

        <div class="input-icon input-icon-sm">
            <i class="fa fa-clock-o"></i>
            <input type="text" class="form-control clockin input-sm" id="clock_in{{ $row->employeeID }}"
                   name="clock_in[]" value="{{ $clock_in }}"/>
        </div>
    </div>
    <div class="col-lg-6 col-md-12"><label class="control-label">Pulang</label>
        <div class="input-icon input-icon-sm"><i class="fa fa-clock-o"></i>
            <input type="text" class="form-control  clockout input-sm" id="clock_out{{$row->employeeID }}"
                   name="clock_out[]" value="{{ $clock_out }}"/>
        </div>
    </div>
		       <div class="col-lg-12 col-md-12">
		      <center>  <button type="button" style="width:100%;margin-top:8px" class="btn blue btn-sm" id="update_row{{ $row->employeeID }}" onclick="attendanceRow({{ $row->employeeID }})">Kirim Perubahan</button>   </center>  
				      </div>
</div>

@else
@if($row->idleaveType ==  $row->idketerangan)
<span class="label label-success">{{  $row->keterangan }}</span>
 @else
	 <span class="label label-success" style="background-color: #d33636;">Keterangan tidak di temukan</span>
@endif	 
 
@endif



@endif
