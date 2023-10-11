@extends('Template.App') 
@section('title',$title)
@section('content')

<div class="card elevation-0">
    <div class="card-header">
        <button type="button" class="btn btn-warning" onclick="location.href='{{ url('/item') }}'">
            <i class="fas fa-solid fa-arrow-left"></i> Kembali
         </button>
        <div class="card-tools">
            <div class="btn-group">
                <button type="button" class="btn" data-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{ url("/item/{$item->id}/edit") }}"><i class="fas fa-pencil-alt"></i> Edit</a>
                    <a class="dropdown-item" href="{{ url("/item/{$item->id}/unit_conversion") }}"><i class="fas fa-balance-scale"></i> Konversi Satuan</a>
                    <a class="dropdown-item delete" id="{{ $item->id }}" href="#"><i class="far fa-trash-alt"></i> Hapus</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        
        <div class="row">
            <div class="col-9 col-md-9">
                <table class="table table-borderless table-sm">
                    <tr>
                        <th width="20%">Kode / SKU</th>
                        <td width="2%">:</td>
                        <td>{{ $item->code_sku }}</td>
                    </tr>
                    {{-- <tr>
                        <th width="20%">Barcode</th>
                        <td width="2%">:</td>
                        <td>{!! DNS1D::getBarcodeHTML($item->code_sku, 'C128') !!}</td>
                    </tr> --}}
                    <tr>
                        <th width="20%">Nama Produk</th>
                        <td width="2%">:</td>
                        <td>{{ $item->item_name }}</td>
                    </tr>
                    <tr>
                        <th width="20%">Merek</th>
                        <td width="2%">:</td>
                        <td>{{ $item->brand->name_brand }}</td>
                    </tr>
                    <tr>
                        <th width="20%">Kategori</th>
                        <td width="2%">:</td>
                        <td>{{ $item->category->category_name }}</td>
                    </tr>
                    <tr>
                        <th width="20%">Deskripsi</th>
                        <td width="2%">:</td>
                        <td>{!! $item->description !!}</td>
                    </tr>
                </table>
            </div>
            <div class="col-3 col-md-3">
               @if ( $item->images != null )
               <img src="{{ $item->images }}" class="img-fluid rounded" alt="images">
               @endif 
            </div>
        </div>
        
        <div class="alert alert-info mt-3">
            <ol class="mb-0 pl-3">
                <li>
                    Konversi Satuan dasar adalah konversi terhadap satuan dasar, Contohnya : <br>
                    <ul class="mb-0 pl-4">
                        <li>1 Dus berisi 12 PCS</li>
                        <li>1 Pak berisi 120 PCS</li>
                    </ul>
                </li>
                <li>Disarankan untuk tidak mengubah satuan jika sudah terdapat transaksi yang berhubungan dengan item ini.</li>
            </ol>
        </div>
        <div class="table-responsive mt-3">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Satuan Beli & Jual</th>
                        <th>Konversi</th>
                        <th>Harga Pokok</th>
                        <th>Harga Jual</th>
                        <th>Jenis Satuan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($unit as $value)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $value->unit->unit_name }}</td>
                                <td>{{ $value->amount }}</td>
                                <td>{{ number_format($value->buy_price,0,',','.') }}</td>
                                <td>{{ number_format($value->sell_price,0,',','.') }}</td>
                                <td>{{ $value->unit_type == 1 ? 'Satuan Dasar' : 'Konversi' }}</td>
                            </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <a href="{{ url("/item/{$item->id}/unit_conversion") }}">
          <i class="fas fa-plus"></i>  Tambah Konversi Satuan
        </a>

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
                url: '/item/'+id+'',
                type: 'delete',
                dataType: 'json',
                data: { id: id,_token: '{{ csrf_token() }}',},
                success:function(data){
                    if( data.status == 1 ){
                        window.location.href = "{{ url('item') }}";
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