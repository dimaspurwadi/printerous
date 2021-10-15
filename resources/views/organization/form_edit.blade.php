@extends('layout.app',[

])
@section('content')
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Card-->
        <div class="card card-custom card-shadowless rounded-top-0">
            <!--begin::Body-->
            <div class="card-body p-0">
                <div class="row justify-content-center py-8 px-8 py-lg-15 px-lg-10">
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            <button class="close" data-dismiss="alert"><i class="fa fa-close"></i></button>
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    @if($errors->any())
                        {!! implode('', $errors->all('<h2 style="color:red">:message</h2>')) !!}
                    @endif
                    <div class="col-xl-12 col-xxl-10">
                        <a href="{{ route('organization.index') }}" class="btn btn-success font-weight-bolder" data-wizard-type="action-submit" style="text-align:left">Back</a>
                        <!--begin::Wizard Form-->
                        <form class="form" id="kt_form" method="POST" action="{{ route('organization.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row justify-content-center">
                                <div class="col-xl-9">
                                    <!--begin::Wizard Step 1-->
                                    <div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
                                        <h5 class="text-dark font-weight-bold mb-10">Form Organization</h5>
                                        <!--begin::Group-->
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Name<span class="text-danger">*</span></label>
                                            <div class="col-lg-9 col-xl-9">
                                                <input class="form-control form-control-solid form-control-lg" name="name" id="name" type="text" value="{{ isset($data->name) ? $data->name : old('name') }}" required/>
                                            </div>
                                        </div>
                                        <!--end::Group-->
                                        <!--begin::Group-->
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Phone<span class="text-danger">*</span></label>
                                            <div class="col-lg-9 col-xl-9">
                                                <input class="form-control form-control-solid form-control-lg" name="phone" id="phone" type="text" value="{{ isset($data->phone) ? $data->phone : old('phone') }}" required />
                                            </div>
                                        </div> 
                                        <!--end::Group-->
                                        <!--begin::Group-->
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Email<span class="text-danger">*</span></label>
                                            <div class="col-lg-9 col-xl-9">
                                                <input class="form-control form-control-solid form-control-lg" name="email" id="email" type="email" value="{{ isset($data->email) ? $data->email : old('email') }}" required/>
                                            </div>
                                        </div>
                                        <!--end::Group-->
                                        <!--begin::Group-->
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Website<span class="text-danger">*</span></label>
                                            <div class="col-lg-9 col-xl-9">
                                                <input class="form-control form-control-solid form-control-lg" name="website" id="website" type="text" value="{{ isset($data->website) ? $data->website : old('website') }}" required/>
                                            </div>
                                        </div>
                                        <!--end::Group-->
                                        <!--begin::Group-->
                                        <div class="form-group row">
                                            <label class="col-form-label col-xl-3 col-lg-3">Logo<span class="text-danger"></span></label>
                                            <div class="col-xl-9 col-lg-9">
                                                <input class="form-control form-control-solid form-control-lg" name="logo" id="logo" type="file" {{ isset($data->id) ? '' : 'required' }}/>
                                                <span style="font-size:10px">jpg, jpeg, png</span>
                                            </div>
                                        </div>
                                        <!--end::Group-->
                                        <!--end::Group-->
                                        @if (isset($data->logo))
                                            <!--begin::Group-->
                                            <div class="form-group row">
                                                <label class="col-form-label col-xl-3 col-lg-3">Image Avatar</label>
                                                <div class="col-xl-9 col-lg-9">
                                                    <img src="{{ asset('uploads/file/'.$data->logo.'') }}" style="width:10em"/>
                                                </div>
                                            </div>
                                            <!--end::Group-->
                                        @endif
                                    </div>
                                    <input type="hidden" name="id" id="id" value="{{ isset($data->id) ?$data->id : null }}" >
                                    <div class="d-flex justify-content-between border-top pt-10 mt-15">
                                        <div>
                                            <button type="submit" class="btn btn-success font-weight-bolder px-9 py-4" data-wizard-type="action-submit">Simpan</button>
                                        </div>
                                    </div>
                                    <!--end::Wizard Actions-->
                                </div>
                            </div>
                        </form>
                        <!--end::Wizard Form-->
                    </div>
                </div>
            </div>
            <!--end::Body-->
        </div>
        <!--end::Card-->
    </div>
</div>

<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Card-->
        <div class="card card-custom">
            <!--begin::Header-->
            <h5 align="center">Person Organization</h5>
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-toolbar">
                    <a href="#" data-toggle="modal" data-target="#modal-form-add" class="btn btn-primary font-weight-bolder">
                    <span class="svg-icon svg-icon-md">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24" />
                                <circle fill="#000000" cx="9" cy="15" r="6" />
                                <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>Tambah</a>
                    <!--end::Button-->
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body">
                <!--begin: Datatable-->
                <form name="form" id="load_person" method="post">
                    <input type="hidden" name="organization_id" id="organization_id" value=" {{ $data->id }}" >
                    <div class="row">
                        <div class="col-md-12">
                            <div id="content-person" class="content-table"></div>
                        </div>
                    </div>
                </form>
                <!--end: Datatable-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Container-->
</div>

<!--Modal Add-->
<div class="modal fade" id="modal-form-add">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="text-align: left">Form Person</h4>
            </div>
            <div class="modal-body">
                <div class="form_person">
                    <form method="POST" id="form_person" enctype="multipart/form-data" action="{{ route('person.store') }}">
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-xl-9">
                                <!--begin::Wizard Step 1-->
                                <div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">     
                                    <!--begin::Group-->
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">Name<span class="text-danger">*</span></label>
                                        <div class="col-lg-9 col-xl-9">
                                            <input class="form-control form-control-solid form-control-lg" name="name" id="name" type="text" value="{{ old('name') }}" required/>
                                        </div>
                                    </div>
                                    <!--end::Group-->
                                    <!--begin::Group-->
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">Email<span class="text-danger">*</span></label>
                                        <div class="input-group col-lg-9 col-xl-9">
                                            <input class="form-control form-control-solid form-control-lg" name="email" id="email" type="email" value="{{ old('email') }}" required/>
                                        </div>
                                    </div>
                                    <!--end::Group-->
                                    <!--begin::Group-->
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">Phone<span class="text-danger">*</span></label>
                                        <div class="input-group col-lg-9 col-xl-9">
                                            <input class="form-control form-control-solid form-control-lg" name="phone" id="phone" type="text" value="{{ old('phone') }}" required/>
                                        </div>
                                    </div>
                                    <!--end::Group-->
                                    <!--begin::Group-->
                                    <div class="form-group row">
                                        <label class="col-form-label col-xl-3 col-lg-3">Avatar<span class="text-danger">*</span></label>
                                        <div class="col-xl-9 col-lg-9">
                                            <div class="input-group date">
                                                <input type="file" class="form-control" id="avatar" name="avatar" required/>
                                            </div>
                                            <span style="font-size:10px">max 2 mb, file : jpg, jpeg, png</span>
                                        </div>
                                    </div>
                                </div>
                                <!--begin::Wizard Actions-->
                                <input type="hidden" name="organization_id" id="organization_id" value="{{ $data->id }}" >
                                <input type="hidden" name="id" id="id" value="0" >
                                <input type="hidden" name="action" id="action" value="add" >
                                <div class="d-flex justify-content-between border-top pt-10 mt-15">
                                    <div>
                                        <button type="submit" class="btn btn-success font-weight-bolder px-9 py-4 simpan-person" data-wizard-type="action-submit">Simpan</button>
                                    </div>
                                </div>
                                <!--end::Wizard Actions-->
                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
</div>
<!--End Modal Add-->

<!--Modal Edit-->
<div class="modal fade" id="modal-edit">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" style="text-align: left">Form Edit</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i aria-hidden="true" class="ki ki-close"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="form_edit"></div>
        </div>
        </div>
        <!-- /.modal-content -->
    </div>
</div>
<!--End Modal Edit-->

<!--Modal Delete-->
<div class="modal fade" id="modal-delete">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" style="text-align: left">Form Delete</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i aria-hidden="true" class="ki ki-close"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="form_delete"></div>
        </div>
        </div>
        <!-- /.modal-content -->
    </div>
</div>
<!--End Modal Delete-->

<script src="{{ asset('assets/jquery/jquery-3.6.1.min.js') }}"></script>
<script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>
<script>
    $(document).ready(function(){
        loadData();

        $('body').on('click', '.edit', function(){
            var id = this.id;
            var name = this.name;
            var url = "{{route('person.form')}}";
            var data={
                id: id,
                name: name, 
                _token : '{{csrf_token()}}'
            };
            $.post(url, data,function(data) {
                $(".preload").fadeOut();
                $(".form_edit").html(data).show();
            });
        });

        $('body').on('click', '.delete', function(){
            var id = this.id;
            var name = this.name;
            var url = "{{route('person.view.delete')}}";
            var data={
                id: id,
                name: name, 
                _token : '{{csrf_token()}}'
            };
            $.post(url, data,function(data) {
                $(".preload").fadeOut();
                $(".form_delete").html(data).show();
            });
        });

    });
    function loadData() {
        var data = jQuery('#load_person').serialize();
        var url = "{{route('person.load')}}"
        jQuery('#content-person').load(url,data);
        return false;
    }
</script>
@endsection