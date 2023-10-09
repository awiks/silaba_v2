@extends('Template.App') 
@section('title',$title)
@section('content')

<div class="card elevation-0">
    <div class="card-header">
        <button type="button" class="btn btn-warning" onclick="location.href='{{ url('/setting') }}'">
            <i class="fas fa-solid fa-arrow-left"></i> Kembali
         </button>
        <button class="btn btn-primary" onclick="location.href='{{ url('setting/account_header/create') }}'">
            <i class="fas fa-plus-circle"></i> Tambah
        </button>
        <div class="card-tools">
            <button type="button" class="btn btn-default" onclick="location.href='{{ url('/setting/account_header/recycle_bin') }}'">
               <i class="far fa-trash-alt"></i> Keranjang Sampah
            </button>
        </div>
    </div>
    <div class="card-body">

        <div class="alert alert-info">
            Disarankan untuk tidak mengubah atau menghapus daftar Jenis Akun jika sudah terjadi transaksi.
        </div>

        <div class="table-responsive">
            <table class="table table-striped" id="DataTable" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kode</th>
                        <th>Nama Header</th>
                        <th>Posisi Laporan</th>
                        <th>Saldo Normal</th>
                        <th>Penambahan</th>
                        <th>Pengurangan</th>
                        <th>Dibuat</th>
                        <th width="10%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($account_header as $value)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $value->header_code }}</td>
                            <td>{{ $value->header_name }}</td>
                            <td>{!! $value->serving_header == 1 ? 'Neraca' : 'Laba Rugi' !!}</td>
                            <td>{!! $value->normal_balance == 1 ? '<span class="text-success">Debit</span>' : '<span class="text-danger">Kredit</span>' !!}</td>
                            <td>{!! $value->addition == 1 ? '<span class="text-success">Debit</span>' : '<span class="text-danger">Kredit</span>' !!}</td>
                            <td>{!! $value->subtraction == 1 ? '<span class="text-success">Debit</span>' : '<span class="text-danger">Kredit</span>' !!}</td>
                            <td>{{ date('d-m-Y H:i',strtotime($value->updated_at)) }}</td>
                            <td>
                                <a href="{{ url("/setting/account_header/{$value->id}/edit") }}" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                <a href="#" id="{{ $value->id }}" class="btn btn-danger shadow btn-xs sharp delete"><i class="far fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end">
            {{ $account_header->links() }}
        </div>

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
        title: "Yakin anda akan menghapus  data ini  ?",
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
                url: '/setting/account_header/'+id+'',
                type: 'delete',
                dataType: 'json',
                data: { id: id,_token: '{{ csrf_token() }}',},
                success:function(data){
                    if( data.status == 1 ){
                        window.location.href = "{{ url('setting/account_header') }}";
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
