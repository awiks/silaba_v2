@extends('Template.App') 
@section('title',$title)
@section('content')
<form action="{{ url('customer/bicycle/'.$bicycle->id.'') }}" method="post">
    @csrf
    @method('PUT')
<div class="card elevation-0 mb-2">
    <div class="card-body">
        <table class="table table-borderless table-sm">
            <tr>
                <th width="10%">Nama</th>
                <td width="2%">:</td>
                <td>{{ $bicycle->customer->name }}</td>
            </tr>
            <tr>
                <th width="10%">Alamat</th>
                <td width="2%">:</td>
                <td>{{ $bicycle->customer->address }}</td>
            </tr>
            <tr>
                <th width="10%">Kontak</th>
                <td width="2%">:</td>
                <td>{{ $bicycle->customer->contact }}</td>
            </tr>
            <tr>
                <th width="10%">Email</th>
                <td width="2%">:</td>
                <td>{{ $bicycle->customer->email }}</td>
            </tr>
        </table>

    </div>
</div>

<div class="card elevation-0">
    <div class="card-body">
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nomor Kendaraan</label>
                    <input type="text" name="police_number" value="{{ old('police_number') ? old('police_number') : $bicycle->police_number  }}" class="form-control @error('police_number') is-invalid @enderror">
                    @error('police_number')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Merek</label>
                    <input type="text" name="brand" value="{{ old('brand') ? old('brand') : $bicycle->brand }}" class="form-control @error('brand') is-invalid @enderror">
                    @error('brand')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Tipe</label>
            <input type="text" name="type" value="{{ old('type') ? old('type') : $bicycle->type }}" class="form-control @error('type') is-invalid @enderror">
            @error('type')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror"  cols="30" >{{ old('description') ? old('description') : $bicycle->description }}</textarea>
            @error('description')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

    </div>
    <div class="card-footer bg-white border-top">
        <button type="button" class="btn btn-warning" onclick="location.href='{{ url('/customer/'.$bicycle->customer->id.'') }}'">
            <i class="fas fa-solid fa-arrow-left"></i> Kembali
         </button>
         <button type="submit" class="btn btn-success">
            <i class="far fa-save"></i> Perbarui
         </button>
    </div>
</div>
</form>
@endsection

@section('Notify')
@include('Template.Notify')
@endsection