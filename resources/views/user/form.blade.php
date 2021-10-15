@extends('layout.app',[
])
@section('content')
<script src="{{ asset('assets/jquery/jquery-3.6.1.min.js') }}"></script>
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
                        <a href="{{ route('user.index') }}" class="btn btn-success font-weight-bolder" data-wizard-type="action-submit" style="text-align:left">Kembali</a>
                        <!--begin::Wizard Form-->
                        <form class="form" id="kt_form" method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row justify-content-center">
                                <div class="col-xl-9">
                                    <!--begin::Wizard Step 1-->
                                    <div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
                                        <h5 class="text-dark font-weight-bold mb-10">Form User</h5>
                                    
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Nama<span class="text-danger">*</span></label>
                                            <div class="col-lg-9 col-xl-9">
                                                <input class="form-control form-control-solid form-control-lg" name="name" id="name" type="text" value="{{ isset($data->name) ? $data->name : old('name') }}" required/>
                                            </div>
                                        </div>
                                        <!--end::Group-->
                                        <!--begin::Group-->
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Email<span class="text-danger">*</span></label>
                                            <div class="col-lg-9 col-xl-9">
                                                <input class="form-control form-control-solid form-control-lg" name="email" id="email" type="email" value="{{ isset($data->email) ? $data->email : old('email') }}" required />
                                            </div>
                                        </div>
                                        <!--end::Group-->
                                        <!--begin::Group-->
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">New Password</label>
                                            <div class="col-lg-9 col-xl-9">
                                                <input class="form-control form-control-solid form-control-lg" name="new_password" id="new_password" type="password" value="" />
                                            </div>
                                        </div>
                                        <!--end::Group-->
                                        <!--begin::Group-->
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Confirm Password</label>
                                            <div class="col-lg-9 col-xl-9">
                                                <input class="form-control form-control-solid form-control-lg" name="new_password_confirmation" id="new_password_confirmation" type="password" value="" />
                                            </div>
                                        </div>
                                        <!--end::Group-->
                                    </div>
                                    <!--end::Wizard Step 1-->
                                    <!--begin::Wizard Step 2-->
                                    <div class="my-5 step" data-wizard-type="step-content">
                                        <h5 class="text-dark font-weight-bold mb-10 mt-5">Organization</h5>
                                        <!--begin::Group-->
                                        <div class="form-group row">
                                            <label class="col-form-label col-xl-3 col-lg-3">Organization<span class="text-danger">*</span></label>
                                            <div class="col-xl-9 col-lg-9">
                                                <select class="form-control form-control-lg form-control-solid" name="organization_id" id="organization_id" required>
                                                    <option value="">Select ...</option>
                                                    @if (!$dataOrganization->isEmpty())
                                                        @foreach ($dataOrganization as $item)
                                                            <option value="{{ $item->id }}" {{ isset($data->organization_id) && $data->organization_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <!--end::Group-->
                                    </div>
                                    <!--end::Wizard Step 2-->
                                    <!--begin::Wizard Actions-->
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
    <!--end::Container-->
</div>
<!--end::Entry-->
@endsection