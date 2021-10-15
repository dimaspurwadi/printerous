@extends('layout.app',[
    // isi array
])
@section('content')

<!--begin::Subheader-->
<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
	<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
		<!--begin::Info-->
		<div class="d-flex align-items-center flex-wrap mr-1">
			<!--begin::Heading-->
			<div class="d-flex flex-column">
				<!--begin::Title-->
				<h2 class="text-white font-weight-bold my-2 mr-5">					
					<a href="#" class="opacity-75 hover-opacity-100">
						<i class="flaticon2-shelter text-white icon-1x"></i>
					</a><span style="margin-top:10px">Welcome to Dashboard</span>
				</h2>
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
		<div class="row">
			Welcome, Admin
		</div>
		<!--end::Row-->
	</div>
	<!--end::Container-->
</div>

@endsection