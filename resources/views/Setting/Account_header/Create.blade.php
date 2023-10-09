@extends('Template.App') 
@section('title',$title)
@section('content')
<form action="{{ url('setting/account_header') }}" method="post">
    @csrf
<div class="card elevation-0">
    <div class="card-body">

        <div class="form-group">
            <label>Kode Header</label>
            <input type="text" name="header_code" value="{{ old('header_code') }}" class="form-control @error('header_code') is-invalid @enderror">
            @error('header_code')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Nama Header</label>
            <input type="text" name="header_name" value="{{ old('header_name') }}" class="form-control @error('header_name') is-invalid @enderror">
            @error('header_name')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Jenis Penyajian</label>
            <select name="serving_header" class="form-control @error('serving_header') is-invalid @enderror">
                <option value="">-- Pilih --</option>
                <option value="1" {{ old('serving_header') == 1 ? 'selected' : '' }}>Neraca</option>
                <option value="2" {{ old('serving_header') == 2 ? 'selected' : '' }}>Laba Rugi</option>
            </select>
            @error('serving_header')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Normal Akun</label>
            <select name="normal_balance" class="form-control @error('normal_balance') is-invalid @enderror">
                <option value="">-- Pilih --</option>
                <option value="1" {{ old('normal_balance') == 1 ? 'selected' : '' }}>Debit</option>
                <option value="2" {{ old('normal_balance') == 2 ? 'selected' : '' }}>Kredit</option>
            </select>
            @error('normal_balance')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

    </div>
    <div class="card-footer bg-white border-top">
        <button type="button" class="btn btn-warning" onclick="location.href='{{ url('/setting/account_header') }}'">
            <i class="fas fa-solid fa-arrow-left"></i> Kembali
        </button>
        <button type="submit" class="btn btn-primary">
            <i class="far fa-save"></i> Simpan
        </button>
    </div>
</div>
</form>
@endsection