@extends('Template.App') 
@section('title',$title)
@section('content')
<form action="{{ url('customer') }}" method="post">
    @csrf
<div class="card elevation-0">
    <div class="card-body">
        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">
            @error('name')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>No Handphone / Whatsapp</label>
            <input type="text" name="contact" value="{{ old('contact') }}" class="form-control @error('contact') is-invalid @enderror">
            @error('contact')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Alamat</label>
            <textarea name="address" class="form-control @error('address') is-invalid @enderror"  cols="30" >{{ old('address') }}</textarea>
            @error('address')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror">
            @error('email')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

    </div>
    <div class="card-footer bg-white border-top">
        <button type="button" class="btn btn-warning" onclick="location.href='{{ url('/customer') }}'">
            <i class="fas fa-solid fa-arrow-left"></i> Kembali
         </button>
         <button type="submit" class="btn btn-primary">
            <i class="far fa-save"></i> Simpan
         </button>
    </div>
</div>
</form>
@endsection

