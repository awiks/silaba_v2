@extends('Template.App')
@section('title',$title)
@section('content')

<div class="card elevation-0 mb-2">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-business-time"></i> Informasi Umum</h3>
    </div>
    <div class="card-body">
        <table class="table table-borderless table-sm">
                <tbody><tr>
                    <th width="20%">Logo Perusahaan</th>
                    <td width="2%">:</td>
                    <td><img src="{{ $company->logo }}" alt="logo" class="img-fluid" width="200px"></td>
                </tr>
                <tr>
                    <th width="20%">Nama Perusahaan</th>
                    <td width="2%">:</td>
                    <td>{{ $company->company_name }}</td>
                </tr>
                <tr>
                    <th width="20%">Alamat</th>
                    <td width="2%">:</td>
                    <td>{{ $company->address }}</td>
                </tr>
                <tr>
                    <th width="20%">Alamat Pengiriman</th>
                    <td width="2%">:</td>
                    <td>{{ $company->shipping_address }}</td>
                </tr>
                <tr>
                    <th width="20%">Telepon</th>
                    <td width="2%">:</td>
                    <td>{{ $company->telephone }}</td>
                </tr>
                <tr>
                    <th width="20%">Fax</th>
                    <td width="2%">:</td>
                    <td>{{ $company->fax }}</td>
                </tr>
                <tr>
                    <th width="20%">NPWP</th>
                    <td width="2%">:</td>
                    <td>{{ $company->npwp }}</td>
                </tr>
                <tr>
                    <th width="20%">Email</th>
                    <td width="2%">:</td>
                    <td>{{ $company->email }}</td>
                </tr>
                <tr>
                    <th width="20%">Website</th>
                    <td width="2%">:</td>
                    <td>{{ $company->website }}</td>
                </tr>
            </tbody>
        </table>

    </div>
</div>

<div class="card elevation-0 mb-2">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-landmark"></i> Informasi Bank</h3>
    </div>
    <div class="card-body">
        <table class="table table-borderless table-sm">
            @foreach (json_decode($company->account_bank) as $item)
            <tr>
                <th width="20%">Nama Bank</th>
                <td width="2%">:</td>
                <td>{{ $item->bank_name }}</td>
            </tr>
            <tr>
                <th width="20%">Kantor Cabang</th>
                <td width="2%">:</td>
                <td>{{ $item->branch_office }}</td>
            </tr>
            <tr>
                <th width="20%">Pemegang Akun Bank</th>
                <td width="2%">:</td>
                <td>{{ $item->account_holder }}</td>
            </tr>
            <tr>
                <th width="20%">Nomor Rekening</th>
                <td width="2%">:</td>
                <td>{{ $item->account_number }}</td>
            </tr>
            @endforeach
        </table>

    </div>
</div>

<div class="card elevation-0">
    <div class="card-body">
        <button type="button" class="btn btn-warning" onclick="location.href='{{ url('setting') }}'">
            <i class="fas fa-solid fa-arrow-left"></i> Kembali
         </button>
         <button type="button" class="btn bg-info" onclick="location.href='{{ url('setting/company/'.$company->id.'/edit') }}'">
            <i class="fas fa-pencil-alt"></i> Edit
         </button>
    </div>
</div>

@endsection


@section('Notify')
@include('Template.Notify')
@endsection