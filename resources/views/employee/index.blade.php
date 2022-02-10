@extends('layouts.app')

@section('content')

   <!-- Add Employee model --> 
   <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog">
       <div class="modal-content">
           <div class="modal-header">
           <h5 class="modal-title" id="exampleModalLabel">Add Employee</h5>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
           </div>
           <div class="modal-body">
               <ul id="save_msgList"></ul>
               <form>
                   <div class="form-group mb-3">
                       <label for="">Employee Name</label>
                       <input type="text" class="name form-control" >
                   </div>
                   <div class="form-group mb-3">
                       <label for="">Employee Email</label>
                       <input type="text" class="email form-control" >
                   </div>
                   <div class="form-group mb-3">
                       <label for="">Employee Phone</label>
                       <input type="text" class="phone form-control" >
                   </div>
                   <div class="form-group mb-3">
                       <label for="">Employee Position</label>
                       <input type="text" class="position form-control" >
                   </div>
               </form>
           </div>
           <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
           <button type="button" class="btn btn-primary add_employee">Save</button>
           </div>
       </div>
       </div>
   </div>
<!-- end Employee model -->

   <!-- Edit Employee model -->
   <div class="modal fade" id="editEmployee" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog">
       <div class="modal-content">
           <div class="modal-header">
           <h5 class="modal-title" id="exampleModalLabel">Edit Employee</h5>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
           </div>
           <div class="modal-body">
               <ul id="updateform_errList"></ul>
               <form>
                   <input type="hidden" id="edit_emp_id">
        

                   <div class="form-group mb-3">
                       <label for="">Employee Name</label>
                       <input type="text" class="name form-control" id="edit_name">
                   </div>
                   <div class="form-group mb-3">
                       <label for="">Employee Email</label>
                       <input type="text" class="email form-control" id="edit_email">
                   </div>
                   <div class="form-group mb-3">
                       <label for="">Employee Phone</label>
                       <input type="text" class="phone form-control" id="edit_phone">
                   </div>
                   <div class="form-group mb-3">
                       <label for="">Employee Position</label>
                       <input type="text" class="position form-control" id="edit_position">
                   </div>
               </form>
           </div>
           <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
           <button type="button" class="btn btn-primary update_employee">Update</button>
           </div>
       </div>
       </div>
   </div>
<!-- end edit Employee model -->

<!-- Delete Employee model -->
   <div class="modal fade" id="deleteEmployeetModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog">
       <div class="modal-content">
           <div class="modal-header">
           <h5 class="modal-title" id="exampleModalLabel">Delete Student</h5>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
           </div>
           <div class="modal-body">
               <ul id="updateform_errList"></ul>
               
                   <input type="hidden" id="delete_emp_id">
                   <h4>Are you Sure? want to Delete this Data</h4>
           </div>
           <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
           <button type="button" class="btn btn-primary delete_employee_btn">Yes Delete</button>
           </div>
       </div>
       </div>
   </div>
<!-- end delete Employee model -->


   <div class="container py-5">
       <div class="row">
           <div class="col-md-12">
               <div id="success_message"></div>
               <div class="card">
                   <div class="card-header">
                       <h4>
                           Employee Data
                           <a href="#" class="btn btn-primary float-end btn-sm"  data-bs-toggle="modal" data-bs-target="#exampleModal">Add Employee</a>
                       </h4>
                   </div>
                   <div class="card-body">
                       <table class="table table-bordered table-striped">
                           <thead>
                             <tr>
                               <th >SL</th>
                               <th >Name</th>
                               <th >Email</th>
                               <th >Phone</th>
                               <th >Position</th>
                               <th>Edit</th>
                               <th>Delete</th>
                             </tr>
                           </thead>
                           <tbody>
                             
                           
                           </tbody>
                         </table>
                   </div>
               </div>
           </div>
       </div>
   </div>
@endsection

@section('scripts')
   <script>
        $(document).ready(function (){

            getEmployee();
           //start add student function
           $(document).on('click', '.add_employee', function(e){
               e.preventDefault();

               var data = {
                   'name': $('.name').val(),
                   'email': $('.email').val(),
                   'phone': $('.phone').val(), 
                   'position': $('.position').val(),
               }
               console.log(data);
               $.ajaxSetup({
                   headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   }
               });
               $.ajax({
                   type: "POST",
                   url: "/addemployee",
                   data: data,
                   dataType: "json",
                   success: function(response){
                       //console.log(response.errors.name);
                       if(response.status == 400)
                       {
                           $('#save_msgList').html("");
                           $('#save_msgList').addClass('alert alert-danger');
                           $.each(response.errors, function (key, err_value) {
                               $('#save_msgList').append('<li>' + err_value + '</li>');
                           });
                       }
                       else
                       {
                           $('#success_message').html("");
                           $('#success_message').addClass('alert alert-success');
                           $('#success_message').text(response.message);
                           $('#exampleModal').modal('hide');
                           $('#exampleModal').find('input').val(""); // after insert data find the model than empty the input field
                           getEmployee();
                       }
                   }
               });

           });

          
          //get employee data

          function getEmployee()
             {
                 $.ajax({
                    type: "GET",
                    url: "/get-employees",
                    dataType: "json",
                    success: function(response){
                        //console.log(response);
                        $('tbody').html(""); // first empty the table than loop the data
                        $.each(response.students, function(key, item){
                            $('tbody').append(
                            '<tr>\
                                <td>'+(key+1)+'</td>\
                                <td>'+item.name+'</td>\
                                <td>'+item.email+'</td>\
                                <td>'+item.phone+'</td>\
                                <td>'+item.position+'</td>\
                                <td><button type="button" value="'+item.id+'" class="edit_employee btn btn-primary">Edit</button></td>\
                                <td><button type="button" value="'+item.id+'" class="delete_employee btn btn-danger">Delete</button></td>\
                              </tr>'
                            );
                        });
                    }
                 });
             }


              //start function for edit data
              $(document).on('click', '.edit_employee', function(e){
                e.preventDefault();
                var employee_id = $(this).val();
                //console.log(employee_id);
                $('#editEmployee').modal('show');
                $.ajax({
                    type: "GET",
                    url: "/edit-employee/"+employee_id,
                    dataType: "json",
                    success: function(response){
                        //console.log(response);
                        if(response.status == 404)
                        {
                            $('#success_message').html("");
                            $('#success_message').addClass('alert alert-danger');
                            $('#success_message').text(response.message);
                            $('#editEmployee').modal('hide');
                        }
                        else
                        {
                            $('#edit_name').val(response.employee.name);
                            $('#edit_email').val(response.employee.email);
                            $('#edit_phone').val(response.employee.phone);
                            $('#edit_position').val(response.employee.position);
                            $('#edit_emp_id').val(response.employee.id);
                        }
                    }
                });
                $('.btn-close').find('input').val(''); // after button close empty data from the modal input
             });
            //end function for edit data



             //start update function
             $(document).on('click', '.update_employee', function(e){
                e.preventDefault();
                $(this).text('updating');
                var  employee_id = $('#edit_emp_id').val();

                var data = {
                    'name' : $('#edit_name').val(),
                    'email' : $('#edit_email').val(),
                    'phone' : $('#edit_phone').val(),
                    'position' : $('#edit_position').val(),
                }
                //console.log(data);
                //for crf token matching 
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "PUT",
                    url: "/update-employee/"+employee_id,
                    data: data,
                    dataType: "json",
                    success: function(response){
                        // console.log(response);
                        if(response.status == 400)
                        {
                            $('#updateform_errList').html("");
                            $('#updateform_errList').addClass('alert alert-danger');
                            $.each(response.errors, function (key, err_value) {
                                $('#updateform_errList').append('<li>' + err_value + '</li>');
                            });
                            $('.update_employee').text('updating..');
                        }
                        else if(response.status == 404)
                        {
                            $('#updateform_errList').html("");
                            $('#success_message').addClass('alert alert-danger');
                            $('#success_message').text(response.message);
                            $('.update_employee').text('updating..');
                            
                        }
                        else
                        {
                            $('#updateform_errList').html("");
                            $('#success_message').addClass('alert alert-success');
                            $('#success_message').text(response.message);
                            $('#editEmployee').modal('hide');
                            $('.update_employee').text('updating..');
                            getEmployee();
                        }
                    }
                });
            });
             //end update function

             
            //start function for delete data
            $(document).on('click', '.delete_employee', function(e){
                e.preventDefault();
                var emp_id = $(this).val();
                //console.log(emp_id);
                $('#delete_emp_id').val(emp_id);
                $('#deleteEmployeetModel').modal('show');
             });



             $(document).on('click', '.delete_employee_btn', function(e){
                e.preventDefault();
                var emp_id = $('#delete_emp_id').val();
                console.log(emp_id);

                $(this).text('Deleting');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type:"DELETE",
                    url:"/delete/employee/"+emp_id,
                    success: function(response){
                        console.log(response);
                        $('#success_message').addClass('alert alert-danger');
                        $('#success_message').text(response.message);
                        $('#deleteEmployeetModel').modal('hide');
                        $('.delete_employee_btn').text('Yes Delete');
                        getEmployee();
                    }
                });

             });

            //end function for delete data



       });
   </script>
@endsection