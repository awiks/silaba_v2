@extends('Template.App') 
@section('title',$title)
@section('content')
<form action="{{ url('setting/unit') }}" method="post">
    @csrf
<div class="card elevation-0">
    <div class="card-body">

        <div class="form-group">
            <label>Nama Satuan</label>
            <input type="text" name="unit_name" value="{{ old('unit_name') }}" class="form-control @error('unit_name') is-invalid @enderror">
            @error('unit_name')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

    </div>
    <div class="card-footer bg-white border-top">
        <button type="button" class="btn btn-warning" onclick="location.href='{{ url('/setting/unit') }}'">
            <i class="fas fa-solid fa-arrow-left"></i> Kembali
         </button>
         <button type="submit" class="btn btn-primary">
            <i class="far fa-save"></i> Simpan
         </button>
    </div>
</div>
</form>
@endsection