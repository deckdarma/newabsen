<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onClick="refreshPage()"></button>
    <h4 class="modal-title">Lihat Keterangan</h4>
    </div>
    <div class="modal-body">
        <div class="portlet-body form">
            <div class="row">
                <label class="control-label col-md-3"><strong>Nama</strong></label>
                <div class="col-md-9">
                    {{$leave_application->employee->full_name}}
                </div>
            </div>
            <br>
            <div class="row">
                <label class="control-label col-md-3"><strong>Keterangan</strong></label>
                <div class="col-md-9">
       
				@foreach($leavetypes as $idku)
					@if ($idku->singkat != $leave_application->leaveType )  @else
					{{ $idku->leaveType }} ({{ $idku->singkat }})
				@endif
		
				
                @endforeach
                </div>
            </div>
            <br>
            <div class="row">
                <label class="control-label col-md-3"><strong>Tanggal</strong></label>
                <div class="col-md-9">
                    @if(!isset($leave_application->end_date))
                        {!! date('d-M-Y',strtotime($leave_application->start_date)) !!}
                    @else
                        {!! date('d-M-Y',strtotime($leave_application->start_date)) !!} s/d {!! date('d-M-Y',strtotime($leave_application->end_date)) !!}
                    @endif
                </div>
            </div>

            <br>
            <div class="row">
                <label class="control-label col-md-3"><strong>Jumlah Hari</strong></label>
                <div class="col-md-9">
                    {{$leave_application->days}}
                </div>
            </div>
            <div class="row">
                <label class="control-label col-md-3"><strong>Alasan</strong></label>
                <div class="col-md-9">
                    {{$leave_application->reason}}
                </div>
            </div>
            <br>
            <div class="row">
                <label class="control-label col-md-3"><strong>@lang("core.appliedOn")</strong></label>
                <div class="col-md-9">
                    {!! date('d-M-Y',strtotime($leave_application->applied_on)) !!}
                </div>
            </div>
            <br>
            <div class="row">
                <label class="control-label col-md-3"><strong>@lang("core.status")</strong></label>
                <div class="col-md-9 text-uppercase">
                    @if($leave_application->application_status=='rejected')
                        <span class="label label-danger">{{ trans("core.".$leave_application->application_status) }}</span>
                    @elseif($leave_application->application_status == 'approved')
                        <span class="label label-success">{{ trans("core.".$leave_application->application_status) }}</span>
                    @elseif($leave_application->application_status == 'pending')
                        <span class="label label-info">{{ trans("core.".$leave_application->application_status) }}</span>
                    @endif
                </div>
            </div>
            <br>


        </div>
    </div>
	        @if($leave_application->application_status=='pending')
    <div class="modal-footer">

            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-3 col-md-9">
                        <input type="submit" name="application_status" data-loading-text="@lang("core.updating")..." class="btn green" value="Terima" data-toggle="modal" href="#static_approve" onclick="show_approve({{ $leave_application->id }});return false;">
          
                        <button type="button" data-dismiss="modal" onClick="refreshPage()" class="btn dark btn-outline">{{ trans("core.btnCancel") }}</button>
                    </div>
                </div>
            </div>
     

    </div>
		@else
			
		    <div class="modal-footer">

            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-3 col-md-9">
                   <button type="button" data-dismiss="modal" onClick="refreshPage()" class="btn dark btn-outline">{{ trans("core.btnCancel") }}</button>
                    </div>
                </div>
            </div>
     

    </div>
	   @endif
</div>

