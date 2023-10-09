@extends('Template.App')
@section('title',$title)
@section('content')

<div class="card elevation-0">
    <div class="card-header">
        <button class="btn btn-primary" onclick="location.href='{{ url('item/create') }}'">
            <i class="fas fa-plus-circle"></i> Tambah
        </button>
    </div>
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-striped" id="DataTable" width="100%">
                <thead>
                    <tr>
                        <th>Kode/SKU</th>
                        <th>Barcode</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Merek</th>
                        {{-- <th width="30%">Deskripsi</th> --}}
                        <th>Harga Pokok</th>
                        <th>Satuan Terkecil</th>
                        <th>Dibuat</th>
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
            className: 'btn btn-outline-secondary',
            init: function(api, node, config) {
                $(node).removeClass('btn-secondary')
            },
            exportOptions: {
                columns: [ 0,1,2,3,4,5,6,7 ]
            },
        },
        {
            extend:'pdf',
            title: 'Report',
            footer: true,
            text: '<i class="far fa-file-pdf text-danger"></i> Pdf',
            titleAttr: 'PDF',
            className: 'btn btn-outline-secondary',
            init: function(api, node, config) {
                $(node).removeClass('btn-secondary')
            },
            exportOptions: {
                columns: [ 0,1,2,3,4,5,6,7 ]
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
            className: 'btn btn-outline-secondary',
            init: function(api, node, config) {
                $(node).removeClass('btn-secondary')
            },
            exportOptions: {
                    columns: [ 0,1,2,3,4,5,6,7 ]
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
        { data : 'code_sku'},
        { data : 'barcode'},
        { data : 'name'},
        { data : 'category'},
        { data : 'brand'},
        //  { data : 'description'},
        { data : 'buy_price'},
        { data : 'unit_conversion'},
        { data : 'create'},
    ],
    'order': [[0, 'desc']],
    columnDefs: [{
        defaultContent: "-",
        targets: "_all"
    }]
});

</script>
@endsection
