@extends('Template.App') 
@section('title',$title)
@section('content')
<form action="{{ url('employee/'.$employee->id.'') }}" method="post">
    @method('PUT')
    @csrf
<div class="card elevation-0">
    <div class="card-body">
        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="name" value="{{ old('name') ? old('name') : $employee->name }}" class="form-control @error('name') is-invalid @enderror">
            @error('name')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>No Handphone / Whatsapp</label>
                    <input type="text" name="phone" value="{{ old('phone') ? old('phone') : $employee->phone }}" class="form-control @error('phone') is-invalid @enderror">
                    @error('phone')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" value="{{ old('email') ? old('email') : $employee->email }}" class="form-control @error('email') is-invalid @enderror">
                    @error('email')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Alamat</label>
            <textarea name="address" class="form-control @error('address') is-invalid @enderror"  cols="30" >{{ old('address') ? old('address') : $employee->address }}</textarea>
            @error('address')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <input type="date" name="birtday" value="{{ old('birtday') ? old('birtday') : $employee->birtday }}" class="form-control @error('birtday') is-invalid @enderror">
                    @error('birtday')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                @php $status_old = old('status') ? old('status') : $employee->status; @endphp
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control @error('status') is-invalid @enderror">
                        <option value="">-- Pilih --</option>
                        <option value="1" {{ $status_old == 1 ? 'selected' : '' }}>Aktif</option>
                        <option value="2" {{ $status_old == 2 ? 'selected' : '' }}>Non Aktif</option>
                    </select>
                    @error('status')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

    </div>
    <div class="card-footer bg-white border-top">
        <button type="button" class="btn btn-warning" onclick="location.href='{{ url('/employee') }}'">
            <i class="fas fa-solid fa-arrow-left"></i> Kembali
         </button>
         <button type="submit" class="btn btn-success">
            <i class="far fa-save"></i> Perbarui
         </button>
    </div>
</div>
</form>
@endsection