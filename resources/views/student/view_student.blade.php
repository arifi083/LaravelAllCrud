<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
     <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
</head>
  <style>
  .alert-message {
    color: red;
  }
</style>
<body>

<div class="container">
    <h2 style="margin-top: 12px;" class="alert alert-success">Ajax CRUD with Laravel App</h2><br>
     <div class="row">
       <div class="col-12 text-right">
         <a href="" class="btn btn-success mb-3" data-toggle="modal" data-target="#studentModal">Add Student</a>
       </div>
    </div>
    <div class="row" style="clear: both;margin-top: 18px;">
        <div class="col-12">
          <table id="studentTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                <tr id="sid{{$student->id}}">
                   <td>{{ $student->firstname  }}</td>
                   <td>{{ $student->lastname }}</td>
                   <td>{{ $student->email }}</td>
                   <td>{{ $student->phone }}</td>
                   <td>
                       <a href="javascript:void(0)" onclick="editStudent({{ $student->id }})" class="btn btn-info">Edit</a>
                  </td>
                </tr>
                @endforeach
            </tbody>
          </table>
       </div>
    </div>

   
<!-- add Modal -->
<div class="modal fade" id="studentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form action="" id="studentForm">
              @csrf
             <div class="form-group">
                <label for="firstname">First Name</label>
                <input type="text" class="form-control" id="firstname">
            </div>

            <div class="form-group">
                <label for="lastname">Last Name</label>
                <input type="text" class="form-control" id="lastname">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email">
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
    
      </div>
      
    </div>
  </div>
</div>
</div>




  
<!-- Edit Modal -->
<div class="modal fade" id="studentEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Student</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="studentEditForm">
              @csrf
              <input type="hidden" id="id" name="id">
             <div class="form-group">
                <label for="firstname">First Name</label>
                <input type="text" class="form-control" id="firstname2">
            </div>

            <div class="form-group">
                <label for="lastname">Last Name</label>
                <input type="text" class="form-control" id="lastname2">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email2">
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone2">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
    
      </div>
      
    </div>
  </div>
</div>
</div>

</body>
</html>


<script  type="text/javascript">
    $("#studentForm").submit(function(e){
        e.preventDefault();

        let firstname = $("#firstname").val();
        let lastname = $("#lastname").val();
        let email = $("#email").val();
        let phone = $("#phone").val();
        let _token = $("input[name=_token]").val();

        $.ajax({
            url: "{{ route('student.add') }}",
            type:"POST",
            data:{
                firstname:firstname,
                lastname:lastname,
                email:email,
                phone:phone,
                _token:_token
            },
            success:function(response)
            {
                if(response){
                    $("#studentTable tbody").prepend('<tr><td>'+response.firstname+'</td><td>'+response.lastname+'</td><td>'+response.email+'</td><td>'+response.phone+'</td></tr>')
                    $("#studentForm")[0].reset();
                    $("#studentModal").modal('hide');
                }
            }

        });
    });
</script>

<script  type="text/javascript">
   
   function editStudent(id){
     $.get('/student/'+id,function(student){
      $("#id").val(student.id);
      $("#firstname2").val(student.firstname);
      $("#lastname2").val(student.lastname);
      $("#email2").val(student.email);
      $("#phone2").val(student.phone);
      $("#studentEditModal").modal('toggle');
     });
   }

   $("#studentEditForm").submit(function(e){
        e.preventDefault();
        let id = $("#id").val();
        let firstname = $("#firstname2").val();
        let lastname = $("#lastname2").val();
        let email = $("#email2").val();
        let phone = $("#phone2").val();
        let _token = $("input[name=_token]").val();

        $.ajax({
            url: "{{ route('student.update') }}",
            type:"POST",
            data:{
                id:id,
                firstname:firstname,
                lastname:lastname,
                email:email,
                phone:phone,
                _token:_token
            },
            success:function(response)
            {
             
                $('#sid' +response.id+ 'td:nth-child(1)').text(response.firstname);
                $('#sid'+response.id+ 'td:nth-child(2)').text(response.lastname);
                $('#sid'+response.id+ 'td:nth-child(3)').text(response.email);
                $('#sid'+response.id+ 'td:nth-child(4)').text(response.phone);
                $("#studentEditModal").modal('toggle');
                ("#studentEditForm")[0].reset();
                
            }

        });
    });

</script>

