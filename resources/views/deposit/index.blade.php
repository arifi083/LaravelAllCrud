<!DOCTYPE html>
<html>
<head>
  <title>Laravel 8 DataTable Ajax Books CRUD Example</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  
</head>
<body>
<div class="container mt-4">
  
  <div class="col-md-12 mt-1 mb-2"><button type="button" data-toggle="modal" data-target="#deposit-modal" class="btn btn-success">Add Book</button></div>
  <div class="card">
    
   @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="card-header text-center font-weight-bold">
      <h2>Laravel 8 crud with modal</h2>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
           <thead>
              <tr>
                 <th>Id</th>
                 <th>Name</th>
                 <th>Amount</th>
                 <th>Note</th>
                 <th>Action</th>
              </tr>
           </thead>
           <tbody>
               @php($i=1)
             @foreach($deposits as $deposit)
               <tr>
                   <td>{{$i++}}</td>
                   <td>{{ $deposit->name }}</td>
                   <td>{{ $deposit->amount }}</td>
                   <td>{{ $deposit->note }}</td>
                   <td>
                      <a href="" class="btn btn-info edit-btn" data-id="{{$deposit->id}}" data-name="{{$deposit->name}}"  
                      data-amount="{{$deposit->amount}}"  data-note="{{$deposit->note}}"
                      data-toggle="modal" data-target="#editModal" title="Edit Data">Edit</a>

		               <a href="{{ route('deposit.delete',$deposit->id) }}" class="btn btn-danger edit-btn" title="Delete Data" >Delete</a>
                   </td>

              </tr>
             @endforeach
           </tbody>
        </table>

        
 <!-- boostrap add and edit book model -->
 <div class="modal fade" id="deposit-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form action="{{ route('deposit.store') }}" method="POST">
            @csrf
          <div class="form-group">
              <label for="exampleInputPassword1">Name</label>
              <input type="text" name="name" class="form-control" id="exampleInputPassword1" placeholder="Name">
          </div>
           
          <div class="form-group">
              <label for="exampleInputPassword1">Amount</label>
              <input type="text" name="amount" class="form-control" id="exampleInputPassword1" placeholder="Amount">
          </div>

          <div>
            <label for="productDescription">Description:</label>
                <textarea required cols="5" rows="5" class="form-control" name="note" id="productDescription"
                    placeholder="Enter Description"></textarea>
          </div>
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
           <button type="submit" class="btn btn-primary">Add</button>
        </form>
      </div>
      
    </div>
  </div>
</div>



     
 <!-- boostrap add and edit book model -->
 <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Deposit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form action="{{ route('deposit.update',1) }}" method="POST">
            @csrf

            <input type="hidden" id="edit_id" name="edit_id">
          <div class="form-group">
              <label for="exampleInputPassword1">Name</label>
              <input type="text" name="name1" class="form-control" id="exampleInputPassword1" placeholder="Name">
          </div>
           
          <div class="form-group">
              <label for="exampleInputPassword1">Amount</label>
              <input type="text" name="amount1" class="form-control" id="exampleInputPassword1" placeholder="Amount">
          </div>

          <div>
            <label for="productDescription">Description:</label>
                <textarea required cols="5" rows="5" class="form-control" name="note1" id="productDescription"
                    placeholder="Enter Description"></textarea>
          </div>
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
           <button type="submit" class="btn btn-primary">update</button>
        </form>
      </div>
      
    </div>
  </div>
</div>

    </div>
  </div>
</div>
  
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>  
</body>
</html>




<script type="text/javascript">


    $('.edit-btn').on('click', function() {
         console.log('arif');
       //$("#editModal input[name='account_id']").val( $(this).data('id') );
        $("#editModal input[name='name1']").val( $(this).data('name') );
        $("#editModal input[name='amount1']").val( $(this).data('amount') );
        $("#editModal textarea[name='note1']").val( $(this).data('note') );
        $("#editModal input[name='edit_id']").val( $(this).data('id') );
        $('.selectpicker').selectpicker('refresh');
    });


</script>

<!-- end bootstrap model -->