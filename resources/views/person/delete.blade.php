<p>{{$name}}</p>
<div class="form-horizontal style-form" id="form-inbox">
    <button type="button" class="btn btn-default remove-modal" data-dismiss="modal">No</button>
    <button id="delete" class="btn btn-primary" name="delete">Delete</button>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$("#delete").click(function(){
      		var id = "<?php echo $id ?>";
			var url = "{{route('person.delete')}}";
            var data={
               id: id, _token : '{{csrf_token()}}'
            };
            $.post(url, data,function(data) {
               $(".preload").hide();
               if (data=='1'){                   
               	  alert("Data berhasil dihapus");
                    $(".remove-modal").click();
                    loadData();
               } else{
                    alert("Telah terjadi kesalahan");
                    $(".remove-modal").click();
                    loadData();
               }
            });
		});
	});
</script>