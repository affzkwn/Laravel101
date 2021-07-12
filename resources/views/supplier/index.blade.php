@extends('layouts.app')
@section('content')
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    </head>
        <body>
            <div class="container">
                <br/>
                <h1 align ="center"> Supplier Records</h1>
                <br/>
                <div align = "right">
                    <button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm">Create Record</button> <!--ubah-->
                    <br/>
                    <br/>
                    <a href="{{  route('product.index') }}" type="button" name="product_page" id="product_page" class="btn btn-success btn-sm">Product</a> <!--ubah-->
                    <br/>
                    <br/>
                </div>
                <div class="table-responsive">
                    <table id="supplier" class="table table-striper table-bordered">
                        <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                        <thead>
                            <tr>
                                <th width=10%>Id</th>
                                <th width=35%>Name</th>
                                <th width=35%>Contact</th>
                                <th width=30%>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </body>
</html>
<div id="formModal" class="modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="modal-title">Supplier Register</h2>
            </div>
            <div class="modal-body">
                <span id="form_result"></span>
                <form method="POST" id="sample_form" class="form-horizontal">
                    @csrf
                    <div class="form-group">
                        <label class="control-label col-md-4">Supplier Name: </label>
                        <div class="col-md-8">
                            <input type="text" name="name_supplier"id="name_supplier"class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Contact Number: </label>
                        <div class="col-md-8">
                            <input type="text" name="contact_supplier"id="contact_supplier"class="form-control">
                        </div>
                    </div>
                    <br/>
                    <div class="form-group" align="center">
                        <input type="hidden" name="action" id="action" value="Add"/>
                        <input type="hidden" name="hidden_id" id="hidden_id"/>
                        <input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Add"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="confirmModal" class="modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="modal-title">Confirmation</h2>
            </div>
            <div class="modal-body">
                <span id="form_result"></span>
                <h4 align="center" style="margin:0;">Are you sure you want to remove this data?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/datatables.net-bs4@1.10.19/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function(){
        $('#supplier').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url:"{{ route('supplier.index') }}",

            },
            columns: [
                {
                    data:'id',
                    name:'id'
                },
                {
                    data: 'name_supplier',
                name: 'name_supplier'
                },
                {
                    data: 'contact_supplier',
                name: 'contact_supplier'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                }
            ]
        });
    $('#create_record').click(function(){
        $('.modal-title').text('Add New Record');
        $('#action_button').val('Add');
        $('#action').val('Add');
        $('#form_result').html('');
        $('#formModal').modal('show'); //ubah
   });
   $('#sample_form').on('submit',function(event){ //ubah
        event.preventDefault();
        var action_url='';
        if($('#action').val() == 'Add')
        {
            action_url = "{{ route('supplier.store') }}";
        }
        if($('#action').val() == 'Edit')
        {
            action_url = "{{ route('supplier.update') }}";
        }

        $.ajax({ //ubah
            url: action_url,
            method:"POST",
            data:$(this).serialize(),
            dataType:"json",
            success:function(data){
                var html='';
                if(data.errors){
                    html += '<div class="alert alert-danger">';
                        for(var count=0; count<data.errors.length; count++){
                            html+='<p>' + data.errors[count]+'</p>';
                        }
                        html+= '</div>';
                    }
                    if(data.success)
                    {
                        html='<div class="alert alert-success">'+data.success +'</div>';
                        $('#sample_form')[0].reset();
                        $('#supplier').DataTable().ajax.reload();
                    }
                    $('#form_result').html(html);
            }
        });
    });
    $(document).on('click','.edit', function(){ //ubah
        var id = $(this).attr('id');
        $('#form_result').html('');
        $.ajax({
            url: "supplier/edit/"+id,
            dataType:"json",
            success:function(data){
                $('#name_supplier').val(data.result.name_product);
                $('#contact_supplier').val(data.result.name_supplier);
                $('#hidden_id').val(id);
                $('.modal-title').text('Edit Record');
                $('#action_button').val('Edit');
                $('action').val('Edit');
                $('#form-group').modal('show');
            }
        })
    });
    var user_id;
    $(document).on('click','.delete', function(){
        user_id = $(this).attr('id');
        $('#confirmModal').modal('show');
    });
    $('#ok_button').click(function(){
        $.ajax({
            url: "supplier/destroy/"+user_id,
            beforeSend:function(){
                $('#ok_button').text('Deleting...');
            },
            success:function(data){
                setTimeout(function(){
                    $('#confirmModal'),modal(hide);
                    $('#user_table').DataTable().ajax.reload();
                    alert('Data Deleted');
                }, 2000);
            }
        })
    });
});
</script>
@endsection

