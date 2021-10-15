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
                    <div class="col-xl-12 col-xxl-10">
                        <a href="{{ route('getProduct.index') }}" class="btn btn-success font-weight-bolder" data-wizard-type="action-submit" style="text-align:left">Kembali</a>
                        <div class="row justify-content-center">
                            <div class="col-xl-9">
                                <!--begin::Wizard Step 1-->
                                <div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
                                    <h5 class="text-dark font-weight-bold mb-10">Produk Detail</h5>
                                    <!--begin::Group-->
                                    <div class="form-group row">
                                        <label class="col-form-label col-xl-3 col-lg-3">Kategori<span class="text-danger">*</span></label>
                                        <div class="col-xl-9 col-lg-9">
                                        <input class="form-control form-control-solid form-control-lg" name="category" id="category" type="text" value="{{ $data['product']['category']['name'] }}" readonly />
                                        </div>
                                    </div>
                                    <!--end::Group-->
                                    <!--begin::Group-->
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">Kode</label>
                                        <div class="col-lg-9 col-xl-9">
                                            <input class="form-control form-control-solid form-control-lg" name="code" id="code" type="text" value="{{ $data['product']['code'] }}" readonly />
                                        </div>
                                    </div>
                                    <!--end::Group-->
                                    <!--begin::Group-->
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">Nama<span class="text-danger">*</span></label>
                                        <div class="col-lg-9 col-xl-9">
                                            <input class="form-control form-control-solid form-control-lg" name="name" id="name" type="text" value="{{ $data['product']['name'] }}" readonly />
                                        </div>
                                    </div> 
                                    <!--end::Group-->
                                    <!--begin::Group-->
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">Base Price<span class="text-danger">*</span></label>
                                        <div class="col-lg-9 col-xl-9">
                                            <input class="form-control form-control-solid form-control-lg" name="name" id="name" type="text" value="Rp. {{ number_format($data['product']['base_price'],2,',','.') }}" readonly />
                                        </div>
                                    </div> 
                                    <!--end::Group-->
                                    <!--begin::Group-->
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">Deskripsi</label>
                                        <div class="col-lg-9 col-xl-9">
                                            <input class="form-control form-control-solid form-control-lg" name="desc" id="desc" type="text" value="{{ $data['product']['desc'] }}" readonly />
                                        </div>
                                    </div>
                                    <!--end::Group-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Body-->
        </div>
        <!--end::Card-->
    </div>
</div>
<br>
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Card-->
        <div class="card card-custom card-shadowless rounded-top-0">
            <!--begin::Body-->
            <div class="card-body p-0">
                <div class="row justify-content-center py-8 px-8 py-lg-15 px-lg-10">
                    <div class="col-xl-12 col-xxl-10">
                        <div class="row justify-content-center">
                            <div class="col-xl-9">
                                <!--begin::Wizard Step 1-->
                                <div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
                                    <h5 class="text-dark font-weight-bold mb-10">Produk Gambar</h5>
                                    <!--begin::Group-->
                                    <div class="table-scrollable">
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th align="center">
                                                        No
                                                    </th>
                                                    <th style="min-width: 200px; text-align:center">
                                                        Gambar
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $no=1;  
                                                ?>
                                                @foreach($data['product']['product_gambar'] as $list)
                                                    <tr>
                                                        <td>{{ $no }}</td>
                                                        <td>{{ $list['name'] }}</td>
                                                    </tr>
                                                    <?php
                                                        $no++;
                                                    ?>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Body-->
        </div>
        <!--end::Card-->
    </div>
</div>
<br>
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Card-->
        <div class="card card-custom card-shadowless rounded-top-0">
            <!--begin::Body-->
            <div class="card-body p-0">
                <div class="row justify-content-center py-8 px-8 py-lg-15 px-lg-10">
                    <div class="col-xl-12 col-xxl-10">
                        <div class="row justify-content-center">
                            <div class="col-xl-9">
                                <!--begin::Wizard Step 1-->
                                <div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
                                    <h5 class="text-dark font-weight-bold mb-10">Produk Warna</h5>
                                    <!--begin::Group-->
                                    <div class="table-scrollable">
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th align="center">
                                                        No
                                                    </th>
                                                    <th style="min-width: 200px; text-align:center">
                                                        Warna
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $no=1;  
                                                ?>
                                                @foreach($data['product']['product_warna'] as $list)
                                                    <tr>
                                                        <td>{{ $no }}</td>
                                                        <td>{{ $list['name'] }}</td>
                                                    </tr>
                                                    <?php
                                                        $no++;
                                                    ?>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Body-->
        </div>
        <!--end::Card-->
    </div>
</div>
<br>
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Card-->
        <div class="card card-custom card-shadowless rounded-top-0">
            <!--begin::Body-->
            <div class="card-body p-0">
                <div class="row justify-content-center py-8 px-8 py-lg-15 px-lg-10">
                    <div class="col-xl-12 col-xxl-10">
                        <div class="row justify-content-center">
                            <div class="col-xl-9">
                                <!--begin::Wizard Step 1-->
                                <div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
                                    <h5 class="text-dark font-weight-bold mb-10">Produk Ukuran</h5>
                                    <!--begin::Group-->
                                    <div class="table-scrollable">
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th align="center">
                                                        No
                                                    </th>
                                                    <th style="min-width: 200px; text-align:center">
                                                        Ukuran
                                                    </th>
                                                    <th style="min-width: 200px; text-align:center">
                                                        Harga
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $no=1;  
                                                ?>
                                                @foreach($data['product']['product_ukuran'] as $list)
                                                    <tr>
                                                        <td>{{ $no }}</td>
                                                        <td>{{ $list['name'] }}</td>
                                                        <td>Rp. {{ number_format($list['price'],2,',','.') }}</td>
                                                    </tr>
                                                    <?php
                                                        $no++;
                                                    ?>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Body-->
        </div>
        <!--end::Card-->
    </div>
</div>
@endsection