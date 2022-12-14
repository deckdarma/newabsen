@extends('admin.adminlayouts.adminlayout')

@section('head')

    <!-- BEGIN PAGE LEVEL STYLES -->
    {!! HTML::style("assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css") !!}
    {!! HTML::style("assets/global/plugins/select2/css/select2.css")!!}
    {!! HTML::style("assets/global/plugins/select2/css/select2-bootstrap.min.css")!!}
    {!! HTML::style("assets/global/plugins/jquery-multi-select/css/multi-select.css") !!}

    <!-- BEGIN THEME STYLES -->
@stop


@section('mainarea')


    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title"><h1>
                @if($loggedAdmin->type=='superadmin')
      Form Edit Data OPD
                @else
                    @lang("core.generalSettings")
                @endif
            </h1></div>
    </div>
    <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a onclick="loadView('{{ route('admin.dashboard.index') }}')">{{ trans('core.dashboard') }}</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a onclick="loadView('{{ route('admin.companies.index') }}')">Data OPD</a>
                <i class="fa fa-circle"></i>
            </li>

            <li>
                <span class="active">  Form Edit Data OPD</span>
            </li>
        </ul>

    </div>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->

            <div id="load">

                {{--INLCUDE ERROR MESSAGE BOX--}}

                {{--END ERROR MESSAGE BOX--}}


            </div>
            <div class="portlet light bordered">
                {{--<div class="portlet-title">--}}
                {{--<div class="caption font-dark">--}}
                {{--<i class="fa fa-desktop font-dark"></i>{{trans('core.edit')}} {{$pageTitle}}--}}
                {{--</div>--}}
                {{--<div class="tools">--}}
                {{--</div>--}}
                {{--</div>--}}

                <div class="portlet-body form">

                    <!------------------------ BEGIN FORM---------------------->
                    {!!  Form::open(['method' => 'PUT','files' => true, 'class'=>'form-horizontal ajax_form'])  !!}

                    <div class="form-body">

                        <div class="form-group">
                            <label class="control-label col-md-2">{{trans('core.companyLogo')}}</label>
                            <div class="col-md-6">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">

                                        {!! HTML::image($company->logo_image_url)!!}

                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail"
                                         style="max-width: 200px; max-height: 150px;">
                                    </div>
                                    <div>
                                                       <span class="btn default btn-file">
                                                       <span class="fileinput-new">
                                                       {{trans('core.changeImage')}} </span>
                                                       <span class="fileinput-exists">
                                                       {{trans('core.change')}} </span>
                                                       <input type="file" name="logo">
                                                       </span>
                                        <a href="#" class="btn red fileinput-exists" data-dismiss="fileinput">
                                            {{trans('core.remove')}} </a>
                                    </div>
                                </div>
                                <div class="clearfix margin-top-10">
                                                        <span class="label label-danger">
                                                     CATATAN!</span> Gambar Harus Mencapai 40px Tinggi

                                </div>

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">{{trans('core.companyName')}}: <span class="required">
                                        * </span>
                            </label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="company_name" placeholder="Comany Name"
                                       value="{{ $company->company_name }}">
                            </div>
                        </div>
                        @if(module_enabled('Subdomain'))

                            <div class="form-group">
                                <label for="company_name" class="col-md-2 control-label">Sub Domain</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="subdomain" name="sub_domain" id="sub_domain"
                                               value="{{str_replace('.'.get_domain(),'',$company->sub_domain)}}">
                                        <span class = "input-group-addon">.{{ get_domain() }}</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="form-group">
                            <label class="col-md-2 control-label">{{trans('core.companyAddress')}}:
                            </label>
                            <div class="col-md-6">
                                <textarea class="form-control" name="address"
                                          placeholder="Alamat OPD">{{$company->address}}</textarea>
                            </div>
                        </div>
        <input type="hidden" class="form-control" name="billing_address" value="{{ $company->company_name }}">
        <input type="hidden" class="form-control" name="country" value="{{ $company->Country }}">

           
                        <div class="form-group">
                            <label class="col-md-2 control-label">{{trans('core.phone')}}:
                            </label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="contact" value="{{ $company->contact }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Email OPD: <span class="required">
                                            * </span>
                            </label>
                            <div class="col-md-6">

										@if($company->name='')
                                <input type="text" class="form-control" name="email" placeholder="Ketik Email"
                                       value="{{ $company->email }}">
							@else
 <input type="text" class="form-control" name="email" placeholder="Ketik Email"
                                       value="{{ $resultdata->email }}">
							@endif
								
								<small>Tidak di gunakan sebagai email login</small>
                            </div>
                        </div>

		   <div class="form-group">
                            <label class="control-label col-md-2">Shift :
							<span class="required">
                                            * </span>
							</label>
                            <div class="col-md-6">
                                <select class=" form-control" data-show-subtext="true" name="datashift">
                   
                                    <option value="1" @if($company->datashift=='1') selected @endif>YA</option>
                                    <option value="0" @if($company->datashift=='0') selected @endif>Tidak
                                    </option>
                   
                                                                            
                                </select>
								<small>Jika OPD tidak menggunakan sistem shift maka pilih TIDAK</small>
                            </div>
                        </div>	
  @if(admin()->unikid =='1')

	<div class="form-group">
                            <label class="col-md-2 control-label">
							Jumlah Hari Mundur: <span
                                        class="required">  * </span></label>

                            <div class="col-md-6">
                                <input type="number" class="form-control" name="waktumundur" 
                                       value="{{ $company->waktumundur}}">
                            </div>
                        </div>
	  @else
		<input type="hidden" class="form-control" name="waktumundur" 
                                       value="{{ $company->waktumundur}}">
	  @endif
				
						
						

                        <div class="form-group">
                            <label class="col-md-2 control-label">Singkatan OPD: <span
                                        class="required">  * </span></label>

                            <div class="col-md-6">
							@if($company->name='')
                                <input type="text" class="form-control" name="name" placeholder="Singkatan OPD"
                                       value="{{ $company->name }}">
							@else
 <input type="text" class="form-control" name="name" placeholder="Singkatan OPD"
                                       value="{{ $resultdata->name }}">
							@endif	
                            </div>
                        </div>

      <input type="hidden" class="form-control" name="currency" value="Rp:IDR">
      <input type="hidden" class="form-control" name="locale" value="en">
      <input type="hidden" class="form-control" name="timezone" value="+08:00=255">
                
           


                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-2 col-md-9">
                                <button type="button" onclick="updateSetting({{ $company->id }})"
                                        data-loading-text="{{trans('core.btnUpdating')}}..."
                                        class="btn green">{{trans('core.btnUpdate')}} Data OPD</button>

                            </div>
                        </div>
                    </div>
                    {!!  Form::close()  !!}
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->

            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT-->



@stop

@section('footerjs')

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    {!! HTML::script("assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js") !!}
    {!! HTML::script('assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js') !!}
    {!! HTML::script('assets/global/plugins/select2/js/select2.min.js') !!}
    {!! HTML::script('assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js') !!}
    {!! HTML::script('assets/admin/pages/scripts/components-dropdowns.js') !!}



    <script>
        jQuery(document).ready(function () {
            $.fn.select2.defaults.set("theme", "bootstrap");
            $('.select2me').select2({
                placeholder: "Select",
                width: '100%',
                allowClear: false
            });

            function formatState(state) {
                if (!state.id) {
                    return state.text;
                }
                var $state = $(
                    '<span><img src="{{ asset('assets/global/img/flags') }}/' + state.element.value.toLowerCase() + '.png" class="img-flag" /> ' + state.text + '</span>'
                );
                return $state;
            };

            $("#select_lang").select2({
                placeholder: "Select a Language",
                templateResult: formatState,
                templateSelection: formatState
            });

            $("#timezone option:eq('{{ $company->timezone_index }}')").prop('selected', true).change();

            $('#timezone').change(function () {
                var newSelectedIndex = $("#timezone")[0].selectedIndex;
                $('#timezoneIndex').val(newSelectedIndex);
            });

        });

        function updateSetting(id) {
            var url = "{{ route('admin.companies.update',':id') }}";
            url = url.replace(':id', id);
            $.easyAjax({
                type: 'POST',
                url: url,
                container: '.ajax_form',
                file: true,
					        success: function (response) {
                    if (response.status == "success") {
    window.location.replace("../");
				
                    }

                }
            });
        }
    </script>
    <!-- END PAGE LEVEL PLUGINS -->
@stop
