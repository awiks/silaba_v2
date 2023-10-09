@extends('Template.App') 
@section('title',$title)
@section('content')

<div class="card elevation-0">
    <div class="card-header">
        <button type="button" class="btn btn-warning" onclick="location.href='{{ url('/setting') }}'">
            <i class="fas fa-solid fa-arrow-left"></i> Kembali
         </button>
        <button class="btn btn-primary" onclick="location.href='{{ url('setting/account_category/create') }}'">
            <i class="fas fa-plus-circle"></i> Tambah
        </button>
        <div class="card-tools">
            <button type="button" class="btn btn-default" onclick="location.href='{{ url('/setting/account_category/recycle_bin') }}'">
               <i class="far fa-trash-alt"></i> Keranjang Sampah
            </button>
        </div>
    </div>
    <div class="card-body">

        <div class="alert alert-info">
            Disarankan untuk tidak mengubah atau menghapus daftar Kategori Akun jika sudah terjadi transaksi.
        </div>

        <div class="table-responsive">
            <table class="table table-striped" id="DataTable" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kode</th>
                        <th>Kategori Akun</th>
                        <th>Sub Header</th>
                        <th>Header</th>
                        <th>Saldo Normal</th>
                        <th>Dibuat</th>
                        <th width="10%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($account_category as $value)
                        <tr>
                            <td>{{ $account_category->firstItem() + $loop->index }}</td>
                            <td>{{ $value->category_code }}</td>
                            <td>{{ $value->categories_name }}</td>
                            <td>{{ $value->account_sub_header->header_sub_name }}</td>
                            <td>{{ $value->account_sub_header->account_header->header_name }}</td>
                            <td>{!! $value->account_sub_header->account_header->normal_balance == 1 ? '<span class="text-success">Debit</span>' : '<span class="text-danger">Kredit</span>' !!}</td>
                            <td>{{ date('d-m-Y H:i',strtotime($value->updated_at)) }}</td>
                            <td>
                                <a href="{{ url("/setting/account_category/{$value->id}/edit") }}" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                <a href="#" id="{{ $value->id }}" class="btn btn-danger shadow btn-xs sharp delete"><i class="far fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end">
            {{ $account_category->links() }}
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
                url: '/setting/account_category/'+id+'',
                type: 'delete',
                dataType: 'json',
                data: { id: id,_token: '{{ csrf_token() }}',},
                success:function(data){
                    if( data.status == 1 ){
                        window.location.href = "{{ url('setting/account_category') }}";
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
