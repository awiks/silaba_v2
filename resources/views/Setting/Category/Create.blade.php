@extends('Template.App') 
@section('title',$title)
@section('content')
<form action="{{ url('setting/category') }}" method="post">
    @csrf
<div class="card elevation-0">
    <div class="card-body">

        <div class="form-group">
            <label>Nama Kategori</label>
            <input type="text" name="category_name" value="{{ old('category_name') }}" class="form-control @error('category_name') is-invalid @enderror">
            @error('category_name')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

    </div>
    <div class="card-footer bg-white border-top">
        <button type="button" class="btn btn-warning" onclick="location.href='{{ url('/setting/category') }}'">
            <i class="fas fa-solid fa-arrow-left"></i> Kembali
         </button>
         <button type="submit" class="btn btn-primary">
            <i class="far fa-save"></i> Simpan
         </button>
    </div>
</div>
</form>
@endsection