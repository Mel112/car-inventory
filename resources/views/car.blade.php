<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Inventory
        </h2>
    </x-slot>

<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
      
<div class="container mt-5 mb-5">
    <div class="card">
        <div class="card-body">
            <a class="btn btn-success mb-3" href="javascript:void(0)" id="createNewCar">Create New Car</a>
            <table class="table table-bordered data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Color</th>
                        <th>Type</th>
                        <th>Quantity</th>
                        <th>Date Added</th>
                        <th>Date Updated</th>
                        <th width="200px">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody> 
            </table>
        </div>
    </div>
</div>
     
<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="carForm" name="carForm" class="form-horizontal">
                   <input type="hidden" name="car_id" id="car_id">
                    <div class="form-group">
                        <label for="brand" class="col-sm-2 control-label">Brand</label>
                        <div class="col-sm-12">
                            <input list="carbrand" id="brand" name="brand" class="form-control" placeholder="Enter/Choose Brand" value="" maxlength="50" required=""/>
                            <datalist id="carbrand">
                              <option value="Toyota"></option>
                              <option value="Mitsubishi"></option>
                              <option value="Hyundai"></option>
                              <option value="Honda"></option>
                              <option value="Kia"></option>
                              <option value="Suzuki"></option>
                              <option value="Nissan"></option>
                              <option value="Geely"></option>
                              <option value="MG"></option>
                              <option value="Mercedes Benz"></option>
                              <option value="Audi"></option>
                              <option value="Chevrolet"></option>
                              <option value="Ford"></option>
                              <option value="Foton"></option>
                            </datalist>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="model" class="col-sm-2 control-label">Model</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="model" name="model" placeholder="Enter Model" value="" maxlength="50" required="">
                        </div>
                    </div>
        
                    <div class="form-group">
                        <label for="color" class="col-sm-2 control-label">Color</label>
                        <div class="col-sm-12">
                            <input type="color" list="carcolor" id="color" name="color" class="form-control" placeholder="Enter/Choose Color" value="" maxlength="50" required=""/>
                            <datalist id="carcolor">
                              <option value="#800000"></option>
                              <option value="#8B0000"></option>
                              <option value="#A52A2A"></option>
                              <option value="#DC143C"></option>
                            </datalist>                        
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="type" class="col-sm-2 control-label">Type</label>
                        <div class="col-sm-12">
                            <input list="cartype" id="type" name="type" class="form-control" placeholder="Enter/Choose Type" value="" maxlength="50" required=""/>
                            <datalist id="cartype">
                              <option value="Mini"></option>
                              <option value="Sedan"></option>
                              <option value="CUV"></option>
                              <option value="SUV"></option>
                              <option value="MPV"></option>
                              <option value="EV"></option>
                              <option value="Van"></option>
                              <option value="Truck"></option>
                            </datalist>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="quantity" class="col-sm-2 control-label">Quantity</label>
                        <div class="col-sm-12">
                            <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Enter Quantity" value="" maxlength="50" required="">
                        </div>
                    </div>

                    <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save
                     </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
      
</body>
      
<script type="text/javascript">
  $(function () {
      
    /* Pass Header Token */ 
    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
      
    /* Display DataTable */
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('cars.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'brand', name: 'brand'},
            {data: 'model', name: 'model'},
            {data: 'color', name: 'color'},
            {data: 'type', name: 'type'},
            {data: 'quantity', name: 'quantity'},
            {data: 'created_at', name: 'created_at'},
            {data: 'updated_at', name: 'updatd_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
      
    /* When the Create Button is clicked */
    $('#createNewCar').click(function () {
        $('#saveBtn').val("create-car");
        $('#car_id').val('');
        $('#carForm').trigger("reset");
        $('#modelHeading').html("Create New Car");
        $('#ajaxModel').modal('show');
    });
      
    /* When the Edit Button is clicked */
    $('body').on('click', '.editCar', function () {
      var car_id = $(this).data('id');
      $.get("{{ route('cars.index') }}" +'/' + car_id +'/edit', function (data) {
          $('#modelHeading').html("Edit Car");
          $('#saveBtn').val("edit-user");
          $('#ajaxModel').modal('show');
          $('#car_id').val(data.id);
          $('#brand').val(data.brand);
          $('#model').val(data.model);
          $('#color').val(data.color);
          $('#type').val(data.type);
          $('#quantity').val(data.quantity);
      })
    });
      
    /* When Saving an Information */
    $('#saveBtn').click(function (e) {
        e.preventDefault();
      
        $.ajax({
          data: $('#carForm').serialize(),
          url: "{{ route('cars.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {
       
              $('#carForm').trigger("reset");
              $('#ajaxModel').modal('hide');
              table.draw();

              Swal.fire({
                icon: 'success',
                title: 'Information saved successfully',
                showConfirmButton: false,
                timer: 1500
              })           
          },
          error: function (data) {
              console.log('Error:', data);
              $('#saveBtn').html('Save Changes');
          }
      });
    });
      
    /* When the Delete Button is clicked */
    $('body').on('click', '.deleteCar', function () {
     
        var car_id = $(this).data("id");

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('cars.store') }}"+'/'+car_id,
                        success: function (data) {
                            table.draw();
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                    
                    Swal.fire(
                    'Deleted!',
                    'Information has been deleted.',
                    'success'
                    )
                }
            })
    });
       
  });
</script>
</html>

</x-app-layout>