<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css
">
<link href="https://datatables.yajrabox.com/css/app.css" rel="stylesheet">
<link href="https://datatables.yajrabox.com/css/demo.css" rel="stylesheet">
<link href="https://datatables.yajrabox.com/css/datatables.bootstrap.css" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Lato:400,700,300|Open+Sans:400,600,700,800' rel='stylesheet'
type='text/css'>
<link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css' rel='stylesheet'
type='text/css'>
<link rel="stylesheet" href="https://datatables.yajrabox.com/highlight/styles/zenburn.css">
<script src="https://datatables.yajrabox.com/highlight/highlight.pack.js"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<div class="container">
	<button type="button" id="addBtn" class="btn btn-primary">Add New</button>
	<table id="users-table" class="table table-hover">
		<thead>
			<tr>
				<th>Id</th>
				<th>Name</th>
				<th>Dept</th>
				<th>Create</th>
				<th>Update</th>
				<th>Action</th>
			</tr>
		</thead>
	</table>



<div class="modal fade" tabindex="-1" id="addmodal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add New Modal</h4>
      </div>
      <div class="modal-body">
        <form id="formSubmit">
        	<div class="form-group">
		    <label for="Name">Name</label>
        	<input type="hidden" id="csrf_token" value='{{csrf_field()}}'>
		    <input type="text" class="form-control" id="name" placeholder="Name">
		  </div>
		  <div class="form-group">
		    <label for="Department">Department</label>
		    <input type="text" class="form-control" id="dept" placeholder="Department">
		  </div>
          <div class="form-group pull-right">
        	<button type="close" class="btn btn-warning" data-dismiss="modal">Close</button>
        	<button type="submit" class="btn btn-success">Add Student</button>
           </div>
        </form>
      </div>
      <div class="modal-footer">
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- Edit Modal -->
<div class="modal fade" tabindex="-1" id="editmodal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Update Modal</h4>
      </div>
      <div class="modal-body">
        <form id="formUpdate">
        	<div class="form-group">
		    <label for="Name">Name</label>
        	<input type="hidden" id="csrf_token" value='{{csrf_field()}}'>
        	<input type="hidden" id="editid">
		    <input type="text" class="form-control" id="editname" placeholder="Name">
		  </div>
		  <div class="form-group">
		    <label for="Department">Department</label>
		    <input type="text" class="form-control" id="editdept" placeholder="Department">
		  </div>
          <div class="form-group pull-right">
        	<button type="close" class="btn btn-warning" data-dismiss="modal">Close</button>
        	<button type="submit" class="btn btn-success">Update</button>
           </div>
        </form>
      </div>
      <div class="modal-footer">
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Edit Modal -->


<!-- Delete Modal -->
<div class="modal fade" tabindex="-1" id="deletemodal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Delete Modal</h4>
      </div>
      <div class="modal-body">
      	<h4>Are you Sure to Delete <span id="deleteName" class="text-primary" id="deleteName"></span>?</h4>
          <div class="form-group pull-right">
        	<button type="close" class="btn btn-warning" data-dismiss="modal">Close</button>
        	<button type="button" id="deleteBtn" class="btn btn-success">Delete</button>
           </div>
        </form>
      </div>
      <div class="modal-footer">
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Edit Modal -->

<!-- Delete Modal -->

</div>





<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script> -->
<!-- <script src="https://datatables.yajrabox.com/js/jquery.min.js"></script> -->
<script src="https://datatables.yajrabox.com/js/bootstrap.min.js"></script>
<script src="https://datatables.yajrabox.com/js/jquery.dataTables.min.js"></script>
<script src="https://datatables.yajrabox.com/js/datatables.bootstrap.js"></script>
<!-- <script src="https://datatables.yajrabox.com/js/handlebars.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/mark.js/8.0.0/jquery.mark.min.js"></script>


<script type="text/javascript">
	//DataTables Start
	$(document).ready(function() {
		oTable=$('#users-table').DataTable({
			processing: true,
			serverSide: true,
			ajax: 'http://localhost/apiTest/dt/getdata',
			columns:[
			{data: 'id'},
			{data: 'name'},
			{data: 'dept'},
			{data: 'created_at'},
			{data:  'updated_at'},
 			{data: 'action', orderable: false, searchable: false}
			]
		});
//DataTables End
//Add Start
		$('#addBtn').click( function(){
			$('#addmodal').modal('show');
		});
		$('#formSubmit').on('submit',function(e){
				e.preventDefault();
				var token=$('#csrf_token').val();
				var name=$('#name').val();
				var dept=$('#dept').val();
				$.ajax({
					type:"POST",
					url:"dt/postData",
					data:{
						name:name,
						dept:dept,
						_token:token,
					},
					success:function(response)
					{
						if(response=="success")
						{
							toastr.success("Student Added Successfully");
							$('#name').val("");
							$('#dept').val("");
							oTable.draw(true);
							
						}
						else
						{
							toastr.error("Something is wrong");
						}
						
					},
					error:function(error)
					{
						console.log(error);
					}
				});
			});
//Add End
// Edit Start
		$(document).on('click', '.edit', function(){
			var id=$(this).attr("id");
			$.ajax({
				url:"dt/editData/"+id,
				type:"get",
				success:function(data){
					$("#editmodal").modal('show');
					$("#editid").val(data.id);
					$("#editname").val(data.name);
					$("#editdept").val(data.dept);
					
	
				},
				error:function(error){
					console.log(error);
				}
			});
			
		});
// Edit End
// Update Start
		$("#formUpdate").on('submit', function(e){
			e.preventDefault();
			var id =$("#editid").val();
			var name =$("#editname").val();
			var dept =$("#editdept").val();
			var token=$('#csrf_token').val();
			$.ajax({
				url:"dt/updateData/"+id,
				type:"POST",
				data:{
					name:name,
					dept:dept,
					_token:token,
				},
				success:function(response){
					toastr.info("Student Updated Successfully");
					$("#editmodal").modal("hide");
					oTable.draw(true);
				},
				error:function(error){
					console.log(error);
				}
			});
		});
// Update End
// Delete Start
		$(document).on('click', '.delete', function() {
			var id=$(this).attr("id");
			$("#deletemodal").modal('show');
			 $("#deletemodal #deleteBtn").attr("itemId", id);
			var s = $(this).parent().parent().children().eq(1).html();
			$("#deleteName").text(s);
		});
		$(document).on('click', "#deleteBtn", function(){
			var id = $(this).attr("itemId");
			$(this).removeAttr('itemId');
			$.ajax({
				url:"dt/deleteData/"+id,
				type:"get",
				success:function(data){
					toastr.warning("Student Deleted Successfully");
					$("#deletemodal").modal("hide");
					oTable.draw(true);		
				},
				error:function(error){
					console.log(error);
				}
			});
		});
			
// Delete End
	});
  
</script>