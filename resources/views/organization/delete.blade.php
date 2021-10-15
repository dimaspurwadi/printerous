<p>{{$name}}</p>
<div class="form-horizontal style-form" id="form-inbox">
    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
    <button id="delete" class="btn btn-primary" name="delete">Delete</button>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$("#delete").click(function(){
      		var id = "<?php echo $id ?>";
			var url = "{{route('organization.delete')}}";
			var url_redirect = "{{route('organization.index')}}";
            var data={
               id: id, _token : '{{csrf_token()}}'
            };
            $.post(url, data,function(data) {
                $(".preload").hide();                  
                alert("Data berhasil dihapus");
                window.location = url_redirect;
            });
		});
	});
</script>