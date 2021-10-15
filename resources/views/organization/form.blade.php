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
                                            <label class="col-form-label col-xl-3 col-lg-3">Logo<span class="text-danger">*</span></label>
                                            <div class="col-xl-9 col-lg-9">
                                                <input class="form-control form-control-solid form-control-lg" name="logo" id="logo" type="file" {{ isset($data->id) ? '' : 'required' }}/>
                                                <span style="font-size:10px">jpg, jpeg, png</span>
                                            </div>
                                        </div>
                                        <!--end::Group-->
                                    </div>
                                    <br>
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
<script src="{{ asset('assets/jquery/jquery-3.6.1.min.js') }}"></script>
<script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>
<script>
    $(document).ready(function(){
        var max_fields_ukuran     = 10; //maximum input boxes allowed
        var wrapper_ukuran   	  = $(".input_fields_wrap_person"); //Fields wrapper
        var add_button_ukuran     = $("#add_more_product_person"); //Add button ID        
        var x_ukuran = 1; //initlal text box count

        $(add_button_ukuran).click(function(e){ //on add input button click
            e.preventDefault();
            if(x_ukuran < max_fields_ukuran){ //max input box allowed
                x_ukuran++; //text box increment
                $(wrapper_ukuran).append('<div><input class="form-control form-control-solid form-control-lg" name="name[]" id="name" type="text" placeholder="Name" required/><br><input class="form-control form-control-solid form-control-lg" name="email[]" id="email" type="email" placeholder="Email" required/><br><input class="form-control form-control-solid form-control-lg" name="phone[]" id="phone" type="phone" placeholder="Phone" required/><br><input class="form-control form-control-solid form-control-lg" name="avatar[]" id="avatar" type="file" placeholder="Avatar" required/><br><a href="#" class="remove_field_person">Remove</a></div><br>'); //add input box
            }
        });
        
        $(wrapper_ukuran).on("click",".remove_field_person", function(e){ //user click on remove text
            e.preventDefault(); $(this).parent('div').remove(); x_ukuran--;
        });
    });
</script>
@endsection