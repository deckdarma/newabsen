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
             Form Tambah OPD
            </h1></div>
    </div>
    <div class="page-bar">
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a onclick="loadView('{{ route('admin.dashboard.index') }}')">{{ trans('core.home') }}</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a onclick="loadView('{{ route('admin.companies.index') }}')">Data OPD</a>
                <i class="fa fa-circle"></i>
            </li>

            <li>
                <span class="active">Form Tambah OPD</span>
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
                {{--<i class="fa fa-desktop font-dark"></i>{{trans('core.add')}} {{$pageTitle}}--}}
                {{--</div>--}}
                {{--<div class="tools">--}}
                {{--</div>--}}
                {{--</div>--}}

                <div class="portlet-body form">

                    <!------------------------ BEGIN FORM---------------------->
                    {!!  Form::open(['method' => 'POST','files' => true,'class'=>'form-horizontal ajax_form'])  !!}

                    <div class="form-body">

                        <div class="form-group">
                            <label class="control-label col-md-2">{{trans('core.companyLogo')}}</label>
                            <div class="col-md-6">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">

                                        {!! HTML::image($setting->logo_image_url) !!}

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
                                                        CATATAN!</span> Gambar Harus Mencapai 4px Tinggi

                                </div>

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">{{trans('core.companyName')}}: <span class="required">
                                        * </span>
                            </label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="company_name" placeholder="Ketik Nama OPD Lengkap"
                                       value="{{old('company_name')}}">
                            </div>
                        </div>
                        @if(module_enabled('Subdomain'))

                            <div class="form-group">
                                <label for="company_name" class="col-md-2 control-label">Sub Domain</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="subdomain"
                                               name="sub_domain" id="sub_domain">
                                        <span class="input-group-addon">.{{ get_domain() }}</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="form-group">
                            <label class="col-md-2 control-label">{{trans('core.companyAddress')}}:
                            </label>
                            <div class="col-md-6">
                                <textarea class="form-control" name="address"
                                          placeholder="Ketik Alamat Lengkap OPD">{{old('address')}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">Negara</label>
                            <div class="col-md-6">
                                <select class=" form-control" data-show-subtext="true" name="country">
                                 <option value="Indonesia">Indonesia</option>
                                                                            
                                </select>
                            </div>
                        </div>
						
					   <div class="form-group">
                            <label class="control-label col-md-2">Shift :
							<span class="required">
                                            * </span>
							</label>
                            <div class="col-md-6">
                                <select class=" form-control" data-show-subtext="true" name="datashift">
                                 <option selected disabled>Pilih Shift</option>
                                 <option value="1">YA</option>
                                 <option value="0">Tidak</option>
                                                                            
                                </select>
								<small>Jika OPD tidak menggunakan sistem shift maka pilih TIDAK</small>
                            </div>
                        </div>	
						
      <input type="hidden" class="form-control" name="timezone" value="+08:00=255">
                        <div class="form-group">
                            <label class="col-md-2 control-label">Telpon:
                            </label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="contact"
                                       value="{{old('contact')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Singkatan OPD: <span class="required">  * </span></label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" placeholder="Ketik Singkatan OPD"
                                       value="{{old('name')}}">
									   				<small>Singkatan OPD Wajib di isi</small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">{{trans('core.email')}}: <span class="required">
                                            * </span>
                            </label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="email" value="{{old('email')}}">
									<small>E-mail Wajib  isi di gunakan untuk login</small>
                            </div>
					
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Kata Sandi: <span class="required">
                                            * </span>
                            </label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="password">
									<small>Kata Sandi Wajib  isi di gunakan untuk login</small>
                            </div>
                        </div>


                        <div class="form-group" style="display:none">
                            <label class="control-label col-md-2">Currency</label>
                            <div class="col-md-6">
                                <select class="form-control" data-show-subtext="true" name="currency">
                                       <option value="Rp:IDR">IDR Rp </option>

                                </select>
                            </div>
                        </div>


                        <!------------------------- END FORM ----------------------->

                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-2 col-md-9">
                                <button type="button" onclick="companyCreate();return false;"

                                        class="btn green">{{trans('core.btnSubmit')}}</button>

                            </div>
                        </div>
                    </div>
                    {!!  Form::close()  !!}
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->

            </div>
        </div>
        <!-- END PAGE CONTENT-->


    @stop

    @section('footerjs')

        <!-- BEGIN PAGE LEVEL PLUGINS -->
            {!! HTML::script("assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js")  !!}
            {!! HTML::script('assets/global/plugins/bootstrap-select/bootstrap-select.min.js')  !!}

            {!! HTML::script('assets/global/plugins/select2/js/select2.min.js')  !!}
            {!! HTML::script('assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js')  !!}
            {!! HTML::script('assets/admin/pages/scripts/components-dropdowns.js')  !!}



            <script>
                jQuery(document).ready(function () {
                    $.fn.select2.defaults.set("theme", "bootstrap");
                    $('.select2me').select2({
                        placeholder: "Select",
                        width: '100%',
                        allowClear: false
                    });
                    ComponentsDropdowns.init();
                });

                function companyCreate() {
                    var url = "{{ route('admin.companies.store') }}";
                    $.easyAjax({
                        type: 'POST',
                        url: url,
                        container: '.ajax_form',
                        file: true,
                    });
                }
            </script>
            <!-- END PAGE LEVEL PLUGINS -->
@stop
