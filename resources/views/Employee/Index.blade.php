@extends('Template.App') 
@section('title',$title)
@section('content')

<div class="card elevation-0">
    <div class="card-header">
        <button class="btn btn-primary" onclick="location.href='{{ url('employee/create') }}'">
            <i class="fas fa-plus-circle"></i> Tambah
        </button>
    </div>
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-striped " id="DataTable" width="100%">
                <thead>
                    <tr>
                        <th>Nama Pegawai</th>
                        <th>Kontak</th>
                        <th>Email</th>
                        <th>Tanggal Lahir</th>
                        <th>Usia</th>
                        <th>Dibuat</th>
                        <th>Status</th>
                        <th>Action</th>
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
                columns: [ 0, 1, 2, 3, 4, 5, 6 ]
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
                columns: [ 0, 1, 2, 3, 4, 5, 6 ]
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
                columns: [ 0, 1, 2, 3, 4, 5, 6 ]
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
    order: [[ 0, 'desc' ]],
    ajax:{
        url:'{!! route('employee.ajax') !!}',
        data: {_token:'{!! csrf_token() !!}'},
        type: 'post',
        dataType: 'json',
    },
    deferRender:true,
    columns :[
        { data : 'name'},
        { data : 'phone'},
        { data : 'email'},
        { data : 'birth'},
        { data : 'age'},
        { data : 'create'},
        { data : 'status'},
        { data : 'action'}
    ],
    columnDefs: [{
    defaultContent: "-",
    targets: "_all"
    }]
});


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
                url: '/employee/'+id+'',
                type: 'delete',
                dataType: 'json',
                data: { id: id,_token: '{{ csrf_token() }}',},
                success:function(data){
                    if( data.status == 1 ){
                        window.location.href = "{{ url('employee') }}";
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