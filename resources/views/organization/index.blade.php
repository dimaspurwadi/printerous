@extends('layout.app',[
])
@section('content')
<!-- BEGIN PAGE LEVEL STYLES -->
<style>
    .content-table{
        width: 1000px;
        height: 100%;
        overflow: scroll;
    }
</style>        
<!-- END PAGE LEVEL STYLES -->
<!--begin::Subheader-->
<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
    <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Heading-->
            <div class="d-flex flex-column">
                <!--begin::Title-->
                <h2 class="text-white font-weight-bold my-2 mr-5">Manage Organization</h2>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <div class="d-flex align-items-center font-weight-bold my-2">
                    <!--begin::Item-->
                    <a href="#" class="opacity-75 hover-opacity-100">
                        <i class="flaticon2-shelter text-white icon-1x"></i>
                    </a>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
                    <a href="{{ route('organization.index') }}" class="text-white text-hover-white opacity-75 hover-opacity-100">List Organization</a>
                    <!--end::Item-->
                </div>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Heading-->
        </div>
        <!--end::Info-->
    </div>
</div>
<!--end::Subheader-->
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Card-->
        <div class="card card-custom">
            <!--begin::Header-->
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Manage Organization</h3>
                </div>
                <div class="card-toolbar">
                    @if ($dataSession['data']['level'] == 1)
                        <a href="{{ route('organization.form') }}" class="btn btn-primary font-weight-bolder">
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
                    @endif
                    <!--end::Button-->
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body">
                <!--begin: Datatable-->
                <form name="form" id="form" method="post">
                    <div class="mb-7">
                        <div class="row align-items-center">
                            <div class="col-lg-9 col-xl-8">
                                <div class="row align-items-center">
                                    <div class="col-md-4 my-2 my-md-0">
                                        <div class="input-icon">
                                            <select class="form-control form-control-lg form-control-solid" name="based_on" id="based_on">
                                                <option value="name">Nama Organisasi</option>
                                                <option value="pic">Nama PIC</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 my-2 my-md-0">
                                        <div class="input-icon">
                                            <input type="text" name="search" id="search" class="form-control" placeholder="Search..." id="kt_datatable_search_query">
                                            <span>
                                                <i class="flaticon2-search-1 text-muted"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-xl-4">
                                        <button type="button" class="btn btn-light-primary px-6 font-weight-bold" name="cari" id="cari">Cari</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="content" class="content-table"></div>
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
<!--end::Entry-->
<div class="modal fade" id="modal-delete">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" style="text-align: left">Delete</h4>
        </div>
        <div class="modal-body">
            <div class="form_delete"></div>
        </div>
        </div>
        <!-- /.modal-content -->
    </div>
</div>
<!--begin::Page Scripts(used by this page)-->
<script src="{{ asset('assets/js/pages/custom/user/list-datatable.js') }}"></script>
<script src="{{ asset('assets/jquery/jquery-3.6.1.min.js') }}"></script>
<!--end::Page Scripts-->
<script type="text/javascript">
    var input = document.getElementById("search");
    input.addEventListener("keyup", function(event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById("cari").click();
        }
    });

    $(document).ready(function(){
        loadData();
        $(document).on('click', '#next_page', function(e) {
            e.preventDefault();
            var total_page = parseInt($('#total_page').val()),
            page_num = parseInt($('.page_num').val()) + 1;
            if (page_num <= total_page) {
                $('.page_num').val(page_num);
                loadData();
            }
        });
        
        $(document).on('click', '#prev_page', function(e) {
            e.preventDefault();
            var page_num = parseInt($('.page_num').val()) - 1;
            if (page_num > 0) {
                $('.page_num').val(page_num);
                loadData();
            }
        });
  
        $(document).on('click', '#cari', function(e) {
            loadData();
        });

        $(document).on('change', '#page_num', function(e) {
            loadData();
        });

        $(document).on('change', '#unit_id', function(e) {
            loadData();
        });
  
        $('body').on('click', '.delete', function(){
            var id = this.id;
            var name = this.name;
            var url = "{{route('organization.view.delete')}}";
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
        var data = jQuery('#form').serialize();
        var url = "{{route('organization.load')}}"
        jQuery('#content').load(url,data);
        return false;
    }
</script>
@endsection