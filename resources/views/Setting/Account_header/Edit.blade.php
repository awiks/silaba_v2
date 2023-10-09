@extends('Template.App') 
@section('title',$title)
@section('content')
<form action="{{ url('setting/account_header/'.$account_header->id.'') }}" method="post">
    @method('PUT')
    @csrf
<div class="card elevation-0">
    <div class="card-body">

        <div class="form-group">
            <label>Kode Header</label>
            <input type="text" name="header_code" value="{{ old('header_code') ? old('header_code') : $account_header->header_code }}" class="form-control @error('header_code') is-invalid @enderror">
            @error('header_code')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Nama Header</label>
            <input type="text" name="header_name" value="{{ old('header_name') ? old('header_name') : $account_header->header_name }}" class="form-control @error('header_name') is-invalid @enderror">
            @error('header_name')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        @php $serving_header_old = old('serving_header') ? old('serving_header') : $account_header->serving_header; @endphp
        <div class="form-group">
            <label>Jenis Penyajian</label>
            <select name="serving_header" class="form-control @error('serving_header') is-invalid @enderror">
                <option value="">-- Pilih --</option>
                <option value="1" {{ $serving_header_old == 1 ? 'selected' : '' }}>Neraca</option>
                <option value="2" {{ $serving_header_old == 2 ? 'selected' : '' }}>Laba Rugi</option>
            </select>
            @error('serving_header')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        @php $normal_balance_old = old('normal_balance') ? old('normal_balance') : $account_header->normal_balance; @endphp
        <div class="form-group">
            <label>Normal Akun</label>
            <select name="normal_balance" class="form-control @error('normal_balance') is-invalid @enderror">
                <option value="">-- Pilih --</option>
                <option value="1" {{ $normal_balance_old == 1 ? 'selected' : '' }}>Debit</option>
                <option value="2" {{ $normal_balance_old == 2 ? 'selected' : '' }}>Kredit</option>
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
        <button type="submit" class="btn btn-success">
            <i class="far fa-save"></i> Perbarui
         </button>
    </div>
</div>
</form>
@endsection