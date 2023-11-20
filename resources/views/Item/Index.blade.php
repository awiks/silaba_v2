@extends('Template.App')
@section('title',$title)
@section('content')

<div class="card elevation-0">
    <div class="card-header">

        <button type="button" class="btn btn-primary" onclick="location.href='{{ url('item/create') }}'">
            <i class="fas fa-plus-circle"></i> Tambah
        </button>

        <div class="d-inline-flex">
            <button type="button" class="btn btn-info" data-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-file-import"></i> Impor
            </button>
            <div class="dropdown-menu" role="menu">
                <a class="dropdown-item add_impor" data-toggle="modal" href="#modal_add">Impor Produk Baru</a>
                <a class="dropdown-item add_impor_update" data-toggle="modal" href="#modal_add">Impor Update Produk</a>
            </div>
        </div>

        <div class="card-tools">

        </div>
    </div>
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-striped" id="DataTable" width="100%">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Nama Produk</th>
                        <th>Kode/SKU</th>
                        <th>Barcode</th>
                        <th>Kategori</th>
                        <th>Merek</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Qty</th>
                        <th>Satuan Terkecil</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>

    </div>
</div>

@endsection


@section('Notify')
@include('Template.Notify')
@endsection

@section('Modal')
@include('Template.Modal')
@endsection

@section('javascript')
<script type="text/javascript">

$(document).ready(function () {

    $('.dataTables_filter input[type="search"]').css(
        {'min-width':'300px','display':'inline-block'}
    );
    $('.dataTables_filter input[type="search"]').removeClass('form-control-sm');
    $('.dataTables_filter input[type="search"]').addClass('form-control-md');
    $('[name="myTable_length"]').removeClass('custom-select-sm');
    $('[name="myTable_length"]').addClass('custom-select-md');

});

var table = $('#DataTable').DataTable({
    dom: 'lBfrtip',
    buttons:[
        {
            extend:'excel',
            title: 'Report',
            footer: true,
            extension: '.xlsx',
            text: '<i class="far fa-file-excel text-success"></i> Excel',
            titleAttr: 'Excel',
            className: 'btn btn-outline-primary',
            init: function(api, node, config) {
                $(node).removeClass('btn-secondary')
            },
            exportOptions: {
                columns: [ 1,2,3,4,5,6,7,8,9 ]
            },
        },
        {
            extend:'pdf',
            title: 'Report',
            footer: true,
            text: '<i class="far fa-file-pdf text-danger"></i> Pdf',
            titleAttr: 'PDF',
            className: 'btn btn-outline-primary',
            init: function(api, node, config) {
                $(node).removeClass('btn-secondary')
            },
            exportOptions: {
                columns: [ 1,2,3,4,5,6,7,8,9 ]
            },
        },
        {
            extend: 'print',
            title: 'Report',
            customize: function ( win ) {
                $(win.document.body).find('h1').css('text-align', 'center');
                $(win.document.body).find('h1').css('margin-bottom', '10px;');
            },
            footer: true,
            text: '<i class="fas fa-print text-info"></i> Print</div>',
            titleAttr: 'Print',
            className: 'btn btn-outline-primary',
            init: function(api, node, config) {
                $(node).removeClass('btn-secondary')
            },
            exportOptions: {
                    columns: [ 1,2,3,4,5,6,7,8,9 ]
            },
        },
    ],
    stateSave: true,
    processing: true,
    serverSide: true,
    responsive:false,
    language: {
        processing: '<i class="fa fa-spinner fa-spin default mr-2"></i> Memuat... ',
        'search' : 'Pencarian',
    },
    ajax:{
        url:'{!! route('api.ajax_product') !!}',
        data: {_token:'{!! csrf_token() !!}'},
        type: 'get',
        dataType: 'json',
    },
    deferRender:true,
    columns :[
        { data : 'image'},
        { data : 'name'},
        { data : 'code_sku'},
        { data : 'barcode'},
        { data : 'category'},
        { data : 'brand'},
        { data : 'buy_price'},
        { data : 'sell_price'},
        { data : 'qty'},
        { data : 'unit'},
    ],
    'order': [[0, 'desc']],
    columnDefs: [{
        defaultContent: "-",
        targets: "_all"
    }]
});

$(document).on('click', '[data-toggle="lightbox"]', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox();
});
</script>
@endsection
