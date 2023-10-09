@extends('Template.App') 
@section('title',$title)
@section('content')
<form action="{{ url('setting/tax/'.$tax->id.'') }}" method="post">
    @method('PUT')
    @csrf
<div class="card elevation-0">
    <div class="card-body">

        <div class="form-group">
            <label>Nama Pajak</label>
            <input type="text" name="tax_name" value="{{ old('tax_name') ? old('tax_name') : $tax->tax_name }}" class="form-control @error('tax_name') is-invalid @enderror">
            @error('tax_name')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Persentase</label>
            <input type="text" name="percentage" value="{{ old('percentage') ? old('percentage') : $tax->percentage }}" class="form-control @error('percentage') is-invalid @enderror">
            @error('percentage')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

    </div>
    <div class="card-footer bg-white border-top">
        <button type="button" class="btn btn-warning" onclick="location.href='{{ url('/setting/tax') }}'">
            <i class="fas fa-solid fa-arrow-left"></i> Kembali
         </button>
         <button type="submit" class="btn btn-success">
            <i class="far fa-save"></i> Perbarui
         </button>
    </div>
</div>
</form>
@endsection