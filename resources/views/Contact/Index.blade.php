@extends('Template.App')
@section('title',$title)
@section('content')

<div class="card elevation-0">
    <div class="card-header">
        <button class="btn btn-primary" onclick="location.href='{{ url('contact/create') }}'">
            <i class="fas fa-plus-circle"></i> Kontak Baru
            <span class="count badge badge-warning">1</span>
        </button>
    </div>
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-striped" id="DataTable" width="100%">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Tipe Kontak</th>
                        <th>Nama Kontak</th>
                        <th>Email</th>
                        <th>Handphone</th>
                        <th>Telepon</th>
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


function table_show(filter)
{
    var table = $('#DataTable').DataTable({
                    dom: 'lBfrtip',
                    buttons:[
                        {
                            text: 'Semua',
                            attr: {
                                id: 'all'             
                            },
                            init: function(api, node, config) {
                                $(node).removeClass('btn-secondary')
                            },
                            className: 'btn btn-outline-primary filter',
                        },
                        {
                            text: 'Pelanggan',
                            attr: {
                                id: '1'             
                            },
                            init: function(api, node, config) {
                                $(node).removeClass('btn-secondary')
                            },
                            className: 'btn btn-outline-primary filter',
                        },
                        {
                            text: 'Supplier',
                            attr: {
                                id: '2'             
                            },
                            init: function(api, node, config) {
                                $(node).removeClass('btn-secondary')
                            },
                            className: 'btn btn-outline-primary filter',
                        },
                        {
                            text: 'Pegawai',
                            attr: {
                                id: '3'             
                            },
                            init: function(api, node, config) {
                                $(node).removeClass('btn-secondary')
                            },
                            className: 'btn btn-outline-primary filter',
                        },
                        {
                            text: 'Lainnya',
                            attr: {
                                id: '4'             
                            },
                            init: function(api, node, config) {
                                $(node).removeClass('btn-secondary')
                            },
                            className: 'btn btn-outline-primary filter',
                        }
                    ],
                    stateSave: true,
                    processing: true,
                    serverSide: true,
                    responsive:false,
                    paging: true,
                    language: {
                        processing: '<i class="fa fa-spinner fa-spin default mr-2"></i> Memuat... ',
                        'search' : 'Pencarian',
                    },
                    ajax:{
                        url:'{!! route('api.ajax_contact') !!}?filter='+filter+'',
                        data: {_token:'{!! csrf_token() !!}'},
                        type: 'get',
                        dataType: 'json',
                    },
                    columns :[
                        { data : 'name'},
                        { data : 'type'},
                        { data : 'contact'},
                        { data : 'email'},
                        { data : 'phone'},
                        { data : 'call'},
                    ],
                    order: [[0, 'desc']],
                    columnDefs: [{
                        defaultContent: "-",
                        targets: "_all"
                    }],
                    rowCallback: function() {
                        $('.count').html(table.data().count());
                    }
                });

    
}



table_show(filter='all');
$('#all').addClass('active');

$(document).on('click', '.filter', function(event) {
	 event.preventDefault();
	 /* Act on the event */

	 var status = $(this).attr('id');
	 var table = $('#DataTable').DataTable();
	 table.destroy();
	 table_show(status);
     $('.filter').removeClass('active');
     if ( status == status ){
		 $('#'+status).addClass('active');
	 }
 });

</script>
@endsection
