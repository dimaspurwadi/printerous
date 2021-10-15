<div class="form_person">
    <form method="POST" id="form_progress_edit" enctype="multipart/form-data" action="{{ route('person.store') }}">
        @csrf
        <div class="row justify-content-center">
            <div class="col-xl-9">
                <!--begin::Wizard Step 1-->
                <div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">    
                    <!--begin::Group-->
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Name<span class="text-danger">*</span></label>
                        <div class="col-lg-9 col-xl-9">
                            <input class="form-control form-control-solid form-control-lg" name="name" id="name" type="text" value="{{ $data->name }}" required/>
                        </div>
                    </div>
                    <!--end::Group-->
                    <!--begin::Group-->
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Email<span class="text-danger">*</span></label>
                        <div class="input-group col-lg-9 col-xl-9">
                            <input class="form-control form-control-solid form-control-lg" name="email" id="email" type="email" value="{{ $data->email }}" required/>
                        </div>
                    </div>
                    <!--end::Group-->
                    <!--begin::Group-->
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Phone<span class="text-danger">*</span></label>
                        <div class="input-group col-lg-9 col-xl-9">
                            <input class="form-control form-control-solid form-control-lg" name="phone" id="phone" type="text" value="{{ $data->phone }}" required/>
                        </div>
                    </div>
                    <!--end::Group-->
                    <!--begin::Group-->
                    <div class="form-group row">
                        <label class="col-form-label col-xl-3 col-lg-3">Avatar</label>
                        <div class="col-xl-9 col-lg-9">
                            <div class="input-group date">
                                <input type="file" class="form-control" id="avatar" name="avatar"/>
                            </div>
                            <span style="font-size:10px">max 2 mb, file : jpg, jpeg, png</span>
                        </div>
                    </div>
                    <!--end::Group-->
                </div>
                <!--begin::Wizard Actions-->
                <input type="hidden" name="organization_id" id="organization_id" value="{{ $data->organization_id }}" >
                <input type="hidden" name="id" id="id" value="{{ $data->id }}" >
                <input type="hidden" name="action" id="action_edit" value="edit" >
                <div class="d-flex justify-content-between border-top pt-10 mt-15">
                    <div>
                        <button type="submit" class="btn btn-success font-weight-bolder px-9 py-4 simpan-progress" data-wizard-type="action-submit">Simpan</button>
                    </div>
                </div>
                <!--end::Wizard Actions-->
                
            </div>
        </div>
    </form>
</div>
<script src="{{ asset('assets/jquery/jquery-3.6.1.min.js') }}"></script>
<script src="{{ asset('assets/js/select2/select2.min.js') }}"></script>