@extends('Template.App') 
@section('title',$title)
@section('content')
<form action="{{ url('setting/brand') }}" method="post">
    @csrf
<div class="card elevation-0">
    <div class="card-body">

        <div class="form-group">
            <label>Nama Merek</label>
            <input type="text" name="name_brand" value="{{ old('name_brand') }}" class="form-control @error('name_brand') is-invalid @enderror">
            @error('name_brand')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

    </div>
    <div class="card-footer bg-white border-top">
        <button type="button" class="btn btn-warning" onclick="location.href='{{ url('/setting/brand') }}'">
            <i class="fas fa-solid fa-arrow-left"></i> Kembali
        </button>
        <button type="submit" class="btn btn-primary">
            <i class="far fa-save"></i> Simpan
        </button>
    </div>
</div>
</form>
@endsection