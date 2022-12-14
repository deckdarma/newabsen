@extends('admin.adminlayouts.adminlayout')

@section('head')
    <!-- BEGIN PAGE LEVEL STYLES -->
    {!! HTML::style("assets/global/plugins/select2/css/select2.css")!!}
    {!! HTML::style("assets/global/plugins/select2/css/select2-bootstrap.min.css")!!}
    {!! HTML::style("assets/global/plugins/jquery-multi-select/css/multi-select.css")!!}
    <!-- BEGIN THEME STYLES -->
@stop


@section('mainarea')


    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title"><h1>
    Form Input Kinerja dan Kehadiran Shift
            </h1></div>
    </div>
    <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a onclick="loadView('{{route('admin.dashboard.index')}}')">{{trans('core.dashboard')}}</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a onclick="loadView('{{ route('admin.shitkinerjas.index') }}')">  Form Input Kinerja dan Kehadiran</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">  Form Input Kinerja dan Kehadiran  Shift</span>
            </li>
        </ul>

    </div>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->
    {!! Form::open(array('class'=>'form-horizontal','method'=>'POST','id'=>'salary-form'))!!}
    <div class="row">
        {{--Employee info--}}
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->

            {{--INLCUDE ERROR MESSAGE BOX--}}
            <div id="error"></div>
            {{--END ERROR MESSAGE BOX--}}

            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-red-sunglo">
               Pilih Pegawai
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                     
                      <div class="col-sm-3 col-xs-12">
                            <div >
                                <div >
								           <label class="control-label">Pilih ASN/PHL Shift</label>
                                    <select class="form-control select2me" name="employee_id" id="employeeID">
                                        @foreach($employees as $employee)
                                            <option value="{{$employee->id}}">{{$employee->full_name}} 
										@if($employee->statusmupeg == "ASN")
											(ASN)
										@else
												(PHL)
											@endif
											</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
            <div class="col-sm-3 col-xs-6">
                            <div >
                                <div >        <?php  $bulan = date("n")-1;  ?>
									           <label class="control-label">Pilih Bulan</label>
                                    <select class="form-control  select2me" name="month" id="month">

                                        <option value="1"
                                                @if (1 == $bulan) selected="selected"@endif>Januari</option>
                                        <option value="2"
                                                @if (2 == $bulan) selected="selected"@endif>Februari</option>
                                        <option value="3"
                                                @if (3 == $bulan) selected="selected"@endif>Maret</option>
                                        <option value="4"
                                                @if (4 == $bulan) selected="selected"@endif>April</option>
                                        <option value="5"
                                                @if (5 == $bulan) selected="selected"@endif>Mei</option>
                                        <option value="6"
                                                @if (6== $bulan) selected="selected"@endif >Juni</option>
                                        <option value="7"
                                                @if (7 == $bulan) selected="selected"@endif>Juli</option>
                                        <option value="8"
                                                @if (8 == $bulan) selected="selected"@endif>Agustus</option>
                                        <option value="9"
                                                @if (9 == $bulan) selected="selected"@endif>September</option>
                                        <option value="10"
                                                @if (10 == $bulan) selected="selected"@endif>Oktober</option>
                                        <option value="11"
                                                @if (11 == $bulan) selected="selected"@endif>November</option>
                                        <option value="12"
                                                @if (12 == $bulan) selected="selected"@endif>Desember</option>
                                    </select>

                                </div>
                            </div>
                        </div>
                  <div class="col-sm-3 col-xs-12">
                            <div >
							 
                                <div >     <label class="control-label">Pilih Tahun</label>
                                    {!!  Form::selectYear('year', 2017, date('Y')+1,date('Y'),['class' => 'form-control select2me','id'=>'year'])  !!}
                                </div>

                            </div>
                        </div>
                           <div class="col-sm-3 col-xs-12">
						           <label class="control-label">&nbsp;</label>
                            <button style="width:100%" type="button" class="btn green"
                                    onclick="check(); return false;">Klik Pencarian</button>
                        </div>
						
				
                    </div>
                        <!--/span-->
                    </div>
                </div>
            </div>
        </div>

        <div id="load"></div>

    </div>

    {!!  Form::close()  !!}
    <!-- END FORM-->




    {{--Confirm Box Model--}}
    <div id="confirmBox" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">@lang("core.confirmation")</h4>
                </div>
                <div class="modal-body" id="info">
                    <p>
                        {{--Confirm Message Here from Javascript--}}
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal"
                            class="btn dark btn-outline">@lang("core.btnCancel")</button>
                    <button type="button" data-dismiss="modal" class="btn green" id="show"><i
                                class="fa fa-edit"></i> Edit Form</button>
                </div>
            </div>
        </div>
    </div>

    {{--Confirm Box MODAL--}}
    <!-- END PAGE CONTENT-->

@stop

@section('footerjs')

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    {!! HTML::script("assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js")!!}
    {!! HTML::script("assets/global/plugins/select2/js/select2.min.js")!!}
    {!! HTML::script("assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js")!!}
    <!-- END PAGE LEVEL PLUGINS -->

    <script>
function add(){

		

}

        $.fn.select2.defaults.set("theme", "bootstrap");
        $('.select2me').select2({
            placeholder: "Select",
            width: '100%',
            allowClear: false
        });

        function check() {
            $('#load').html();
            var employeeID = $('#employeeID').val();
            var month = $('#month').val();
            var year = $('#year').val();
            $.ajax({
                type: 'POST',
                url: "{{route('admin.shitkinerjas.check')}}",
                dataType: "JSON",
                data: {'employee_id': employeeID, 'month': month, 'year': year},
                success: function (response) {
                    if (response.success == 'fail') {

                        $('#load').html(response.content);
                        $("#net_salary").val($("#expense_claim").val());
                    } else {
                        $('#confirmBox').appendTo("body").modal('show');
                        $("#confirmBox").find('#info').html('@lang("messages.salarySlipExistsMessage")');
                        $("#show").click(function () {
                            $('#load').html(response.content);
                            $('#load').append('<input type="hidden" name="type" value="edit">');
                            InitializeAdd();
                            $("#basic").trigger("change");
                        })
                    }

                    InitializeAdd();
                    $("#basic").trigger("change");

                },
                error: function (xhr, textStatus, thrownError) {

                }
            });
        }


        function submitData() {

            $.easyAjax({
                url: "{{route('admin.shitkinerjas.store')}}",
                type: "POST",
                data: $("#salary-form").serialize(),
                container: "#salary-form",
            });
        }

        $(document).on("change keydown paste input", function () {

            var allowance = 0.0;
            var hours = 0;
            var hourly_rate = 0.0;
            var deduc = 0.0;
            var basic = 0.0;
            var expense_claim = 0.0;
            var overtime = 0.0;
            basic = $("#basic").val();
            expense_claim = $("#expense_claim").val();

            hourly_rate = $("#hourly_rate").val();
            hours = $("#overtime_hours").val();

            $("#overtime_pay").val(hourly_rate * hours);

            overtime = $("#overtime_pay").val();

            $(".allowance").each(function () {
                if ($(this).val() !== "") {
                    allowance += parseFloat($(this).val());
                }
            });

            $(".deduction").each(function () {
                if ($(this).val() !== "") {
                    deduc += parseFloat($(this).val());
                }

            });

     var a=parseFloat($("#a2").val());
        var b=parseFloat($("#b2").val());
        $("#hasil2").val(+(a+b).toFixed(2));
		
			
			var ab=parseFloat($("#a2").val());
			var bb=parseFloat($("#datakehadiranlihat").val());
			$("#totalkehadirandata").val(+(ab+bb).toFixed(2));

            $("#total_allowance").val(allowance.toFixed(2));
            $("#total_deduction").val(deduc.toFixed(2));
			
			
		var c=parseFloat($("#c2").val());
        var d=parseFloat($("#d2").val());
		  $("#hasil3").val(+(c+d).toFixed(2));
		  
		  
		     var e=parseFloat($("#hasil2").val());
        var f=parseFloat($("#hasil3").val());
		  $("#hasil4").val(+(e-f).toFixed(2));

		  
		  	     var h2=parseFloat($("#h2").val());
				 var n = 100;
        var g=parseFloat($("#hasil4").val());
        var z=parseFloat($("#hasiltpp").val());
		  $("#hasil5").val(+(h2/n*g+z).toFixed(2));
		  
		  
		   	     var o=parseFloat($("#hasil5").val());
				 var s = 100;
        var p2=parseFloat($("#p2").val());
		  $("#hasil6").val(+(o/s*p2).toFixed(2));
		  
		var nt=parseFloat($("#h2").val());
        var tp=parseFloat($("#hasiltpp").val());
		 $("#hasil9").val(+(nt).toFixed(2));
		
		var h9=parseFloat($("#hasil9").val());
        var t1=1;
        var t2=100;

		  $("#hasil8").val(+(t1/t2*h9).toFixed(2));

		  
		var t=parseFloat($("#hasil5").val());
        var l=parseFloat($("#hasil6").val());
        var w=parseFloat($("#hasil8").val());
		  $("#hasil7").val(+(t-l-w).toFixed(0));
		  
		  
		  
		var t=parseFloat($("#hasil5").val());
        var l=parseFloat($("#hasil6").val());
     
		  $("#hasil12").val(+(t-l).toFixed(0));
		 

            net_salary = (allowance - deduc) + parseFloat(basic) + parseFloat(overtime) + parseFloat(expense_claim);
            $("#net_salary").val((net_salary.toFixed(2)));


        });

        function InitializeAdd() {
            onlyNum('only-num');
            var $insertBeforeA = $('#insertBeforeA');
            var i = $(".allowance").length;
            $('#plusButtonA').click(function () {
                i = i + 1;
                $('<div class="form-group" id="allowance' + i + '">' +
                    '<div class="control-label col-md-2"></div>' +
                    '<div class="col-md-4 margin-bottom-10">' +
                    '<input type="text" class="form-control" name="allowanceTitle[]" placeholder="@lang("core.allowance") ' + i + '">' +
                    '</div>' +
                    '<div class="col-md-3  margin-bottom-10">' +
                    '<input type="text" class="allowance form-control" name="allowance[]" placeholder="@lang("core.value")">' +
                    '</div>' +
                    '<label class="control-label col-md-1">{{$loggedAdmin->company->currency}}</label> ' +
                    ' <div class="col-md-2"> <button type="button" onclick="$(\'#allowance' + i + '\').remove();" class="btn red btn-sm delete">' +
                    '<i class="fa fa-close"></i>' +
                    '</button></div>' +
                    '</div>').insertBefore($insertBeforeA);
                onlyNum('allowance');

            });
            var $insertBeforeD = $('#insertBeforeD');
            var j = $(".deduction").length;
            $('#plusButtonD').click(function () {
                j = j + 1;
                $('<div class="form-group" id="deduction' + j + '">' +
                    '<div class="control-label col-md-2"></div>' +
                    '<div class="col-md-4 margin-bottom-10">' +
                    '<input type="text" class="form-control" name="deductionTitle[]" placeholder="@lang("core.deduction") ' + j + '">' +
                    '</div>' +
                    '<div class="col-md-3  margin-bottom-10">' +
                    '<input type="text" class="deduction form-control" name="deduction[]" placeholder="@lang("core.value")">' +
                    '</div>' +
                    '<label class="control-label col-md-1">{{$loggedAdmin->company->currency}}</label> ' +
                    '<div class="col-md-2"> <button type="button" onclick="$(\'#deduction' + j + '\').remove();" class="btn red btn-sm delete">' +
                    '<i class="fa fa-close"></i>' +
                    '</button></div>' +
                    '</div>').insertBefore($insertBeforeD);
                onlyNum('deduction');

            });
            onlyNum('allowance');
            onlyNum('deduction');
        }
    </script>
	
	
			  <script>
function refreshPage(){
    window.location.reload();
} 

(function()
{
  if( window.localStorage )
  {
    if( !localStorage.getItem('firstLoad') )
    {
      localStorage['firstLoad'] = true;
      window.location.reload();
    }  
    else
      localStorage.removeItem('firstLoad');
  }
})();



</script>	 
@stop