@extends('Template.App') 
@section('title',$title)
@section('content')

<div class="card elevation-0 mb-2">
    <div class="card-body">
        <table class="table table-borderless table-sm">
            <tr>
                <th width="10%">Nama</th>
                <td width="2%">:</td>
                <td>{{ $customer->name }}</td>
            </tr>
            <tr>
                <th width="10%">Alamat</th>
                <td width="2%">:</td>
                <td>{{ $customer->address }}</td>
            </tr>
            <tr>
                <th width="10%">Kontak</th>
                <td width="2%">:</td>
                <td>{{ $customer->contact }}</td>
            </tr>
            <tr>
                <th width="10%">Email</th>
                <td width="2%">:</td>
                <td>{{ $customer->email }}</td>
            </tr>
        </table>

    </div>
</div>

<div class="card elevation-0">
    <div class="card-header">
        <button type="button" class="btn btn-warning" onclick="location.href='{{ url('/customer') }}'">
            <i class="fas fa-solid fa-arrow-left"></i> Kembali
         </button>
        
         <button type="button" class="btn bg-info" onclick="location.href='{{ url('/customer/'.$customer->id.'/edit') }}'">
            <i class="fas fa-pencil-alt"></i> Edit
         </button>

         <button type="button" class="btn bg-navy delete" id="{{ $customer->id  }}">
            <i class="far fa-trash-alt"></i> Hapus
         </button>
        
        <div class="card-tools">
            <button class="btn btn-primary" onclick="location.href='{{ url('customer/bicycle/'.$customer->id.'/create') }}'">
                <i class="fas fa-plus-circle"></i> Tambah Kendaraan
                <span class="right badge badge-danger">{{ count($bicycle) }}</span>
            </button>
        </div>
    </div>
    <div class="card-body">
      
        <div class="table-responsive">
            <table class="table table-striped" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>No Kendaraan</th>
                        <th>Merek</th>
                        <th>Type</th>
                        <th>Keterangan</th>
                        <th>Dibuat</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ( count($bicycle) != 0 )
                        @foreach ($bicycle as $value)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $value->police_number }}</td>
                                <td>{{ $value->brand }}</td>
                                <td>{{ $value->type }}</td>
                                <td>{{ $value->description }}</td>
                                <td>{{ date('d/m/Y H:i',strtotime($value->updated_at)) }}</td>
                                <td>
                                    <a href="{{ url('customer/bicycle/'.$value->id.'/edit') }}" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                    <a href="#" id="{{ $value->id }}" class="btn btn-danger shadow btn-xs sharp delete_bicycle"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @else 
                    <tr>
                        <td colspan="7" class="text-center">Data masih kosong</td>
                    </tr>
                    @endif
                    
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection

@section('Notify')
@include('Template.Notify')
@endsection


@section("javascript")
<script type="text/javascript">
    
        $('body').on('click', '.delete', function(event) {
            event.preventDefault();
            /* Act on the event */

            var id = $(this).attr('id');

            swal({
                title: "Yakin anda akan menghapus  {{ $customer->name }}  ?",
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
                        url: '/customer/'+id+'',
                        type: 'delete',
                        dataType: 'json',
                        data: { id: id,_token: '{{ csrf_token() }}',},
                        success:function(data){
                            if( data.status == 1 ){
                                window.location.href = "{{ url('customer') }}";
                            }
                            else{
                              location.reload();
                            }
                        }
                    });
                } 
            });

        });


        $('body').on('click', '.delete_bicycle', function(event) {
            event.preventDefault();
            /* Act on the event */

            var id = $(this).attr('id');

            swal({
                title: "Yakin anda akan menghapus data ini  ?",
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
                        url: '/customer/bicycle/'+id+'',
                        type: 'delete',
                        dataType: 'html',
                        data: { id: id,_token: '{{ csrf_token() }}',},
                        success:function(){
                            location.reload();
                        }
                    });
                } 
            });

        });
</script>
@endsection