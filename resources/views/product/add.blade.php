@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
<div class="container">
<br/>
    <h1 class="page-title">Restock</h1>
    <br/>
    <div class="row justify-content-center">
        @if(session('status'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{  session('status') }}
        </div>
        @elseif (session('failed'))
        <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{ session('failed') }}
        </div>
        @endif
        <form method="POST" action="{{ route('product.store') }}" class="needs-validation" novalidate>
            @csrf

            <div class="form-group">
                <label class="control-label col-md-4">Supplier Name: </label>
                 <select class="form-control" id="id_supplier" name="id_supplier">
                  <option value="">Select Suplier Name</option>
                   @foreach ($id_supplier as $item)
                      <option value="{{ $item['id'] }}" {{ $item['id'] == (old('id')) ? 'selected' : '' }}>{{ $item['name_supplier'] }}</option>
                   @endforeach
                </select>
            </div>
           <div class="form-group">
               <label>Product : </label>
               <input type="text" name="name_product"  class="form-control col-sn-6 @error('name_product') is-invalid @enderror"placeholder= "Product Name" value="{{ old('name_product') }}" required/>
                @error('name_product')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
           </div>

        </div>
        <button type="submit" class="btn btn-primary">Save
        </button>
        </form>
    </div>
</div>

