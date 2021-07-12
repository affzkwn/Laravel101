@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
<div class="container">
<br/>
    <h1 class="page-title">Supplier Register</h1>
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
        <form method="POST" action="{{ url('supplier/add') }}" class="needs-validation" novalidate>
            @csrf
           <div class="form-group">
               <label>Supplier Name: </label>
               <input type="text" name="name_supplier"  class="form-control col-sn-6 @error('name_supplier') is-invalid @enderror"placeholder= "Supplier Name" value="{{ old('name_supplier') }}" required/>
                @error('name_supplier')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
           </div>
           <div class="form-group">
            <label>Contact : </label>
            <input type="text" name="contact_supplier"  class="form-control col-sn-6 @error('contact_supplier') is-invalid @enderror"placeholder= "Contact" value="{{ old('contact_supplier') }}" required/>
             @error('contact_supplier')
             <div class="invalid-feedback">
                 {{ $message }}
             </div>
             @enderror
             
        </div>
        <button type="submit" class="btn btn-primary">Save
        </button>
        </form>
    </div>
</div>

