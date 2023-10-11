@extends('Template.App') 
@section('title',$title)
@section('content')
<div class="card elevation-0 mb-2">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-user-tag"></i> Info Kontak</h3>
        <div class="card-tools">
            <div class="btn-group">
                <button type="button" class="btn" data-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right" style="">
                    <a class="dropdown-item" href="{{ url('contact/'.$contact->id.'/edit') }}"><i class="fas fa-pencil-alt"></i> Edit</a>
                    <a class="dropdown-item delete" id="{{ $contact->id }}" href="#"><i class="far fa-trash-alt"></i> Hapus</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">

        <div class="row">
            <div class="col-10 col-md-10">
                <table class="table table-borderless table-sm">
                    <tr>
                        <th width="25%">Tipe Kontak</th>
                        <td width="2%">:</td>
                        <td>
                            @php
                                $explode_type =  explode(",",$contact->contact_type);
                                $array_type=[];
                                foreach ($explode_type as  $val) {
                                    $array_type[] = '<span class="badge badge-rounded badge-outline-info">'.$val.'</span>';
                                }
        
                            @endphp
                            {!! implode(' ', array_filter($array_type)) !!}
                        </td>
                    </tr>
                    <tr>
                        <th>Nama Panggilan</th>
                        <td width="2%">:</td>
                        <td>{{ $contact->nickname }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-2 col-md-2">
                <img src="{{ $contact->profile ? url($contact->profile) : url('dist/img/user.png') }}" class="img-fluid border" alt="profil">
            </div>
        </div>

    </div>
</div>

<div class="card elevation-0 mb-2">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-business-time"></i> Informasi Umum</h3>
    </div>
    <div class="card-body">
        <table class="table table-borderless table-sm">
            <tr>
                <th width="20%">Nama Kontak</th>
                <td width="2%">:</td>
                <td>{{ $contact->contact_name }}</td>
            </tr>
            <tr>
                <th width="20%">No Handphone</th>
                <td width="2%">:</td>
                <td>{{ $contact->handphone }}</td>
            </tr>
            <tr>
                <th width="20%">Identitas {{ $contact->identity_type }}</th>
                <td width="2%">:</td>
                <td>{{ $contact->identity_number }}</td>
            </tr>
            <tr>
                <th width="20%">Email</th>
                <td width="2%">:</td>
                <td>{{ $contact->emails }}</td>
            </tr>
            <tr>
                <th width="20%">Info Lainnya</th>
                <td width="2%">:</td>
                <td>{{ $contact->other_info }}</td>
            </tr>
        </table>

    </div>
</div>

<div class="card elevation-0 mb-2">
    <div class="card-header">
        <h3  class="card-title"><i class="fas fa-building"></i> Informasi Perusahaan</h3>
    </div>
    <div class="card-body">
        <table class="table table-borderless table-sm">
            <tr>
                <th width="20%">Nama Perusahaan</th>
                <td width="2%">:</td>
                <td>{{ $contact->company_name }}</td>
            </tr>
            <tr>
                <th width="20%">Telepon</th>
                <td width="2%">:</td>
                <td>{{ $contact->telephone }}</td>
            </tr>
            <tr>
                <th width="20%">Fax</th>
                <td width="2%">:</td>
                <td>{{ $contact->fax }}</td>
            </tr>
            <tr>
                <th width="20%">NPWP</th>
                <td width="2%">:</td>
                <td>{{ $contact->npwp }}</td>
            </tr>
            <tr>
                <th width="20%">Alamat Pembayaran</th>
                <td width="2%">:</td>
                <td>{{ $contact->payment_address }}</td>
            </tr>
            <tr>
                <th width="20%">Alamat Pengiriman</th>
                <td width="2%">:</td>
                <td>{{ $contact->shipping_address }}</td>
            </tr>
        </table>

    </div>
</div>

<div class="card elevation-0 mb-2">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-landmark"></i> Informasi Bank</h3>
    </div>
    <div class="card-body">
        <table class="table table-borderless table-sm">
            @foreach (json_decode($contact->account_bank) as $item)
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

<div class="card elevation-0 mb-2">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-wallet"></i> Pemetaan Akun</h3>
    </div>
    <div class="card-body">


    </div>
</div>

<div class="card elevation-0">
    <div class="card-body">
        <button type="button" class="btn btn-warning" onclick="location.href='{{ url('/contact') }}'">
            <i class="fas fa-solid fa-arrow-left"></i> Kembali
         </button>
         <button type="button" class="btn bg-info" onclick="location.href='{{ url('contact/'.$contact->id.'/edit') }}'">
            <i class="fas fa-pencil-alt"></i> Edit
         </button>
         <button type="button" class="btn bg-navy delete" id="{{ $contact->id }}">
            <i class="far fa-trash-alt"></i> Hapus
         </button>
    </div>
</div>

@endsection

@section('Notify')
@include('Template.Notify')
@endsection

@section('javascript')
<script type="text/javascript">

$('body').on('click', '.delete', function(event) {
    event.preventDefault();
    /* Act on the event */

    var id = $(this).attr('id');

    swal({
        title: "Yakin anda akan menghapus {{ $contact->contact_name }} ?",
        text: "Klik tombol hapus jika anda merasa yakin!!",
        icon: "success",
        showCancelButton: true,
        closeOnConfirm: false,
        closeOnCancel: true,
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal',
        cancelButtonClass: 'btn-danger mr-2',
        confirmButtonClass: 'btn-primary',
    },function(isConfirm){
        if (isConfirm) {
            $.ajax({
                url: '/contact/'+id+'',
                type: 'delete',
                dataType: 'json',
                data: { id: id,_token:'{!! csrf_token() !!}',},
                success:function(data){
                    if( data.status == 1 ){
                        window.location.href = "{{ url('contact') }}";
                    }
                    else{
                      location.reload();
                    }
                }
            });
        } 
    });

});

</script>
@endsection