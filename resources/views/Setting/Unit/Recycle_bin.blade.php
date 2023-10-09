@extends('Template.App') 
@section('title',$title)
@section('content')

<div class="card elevation-0">
    <div class="card-header">
        <button type="button" class="btn btn-warning" onclick="location.href='{{ url('/setting/unit') }}'">
            <i class="fas fa-solid fa-arrow-left"></i> Kembali
         </button>
    </div>
    <div class="card-body">

        <form action="{{ url('setting/unit/recycle_bin') }}" method="post">
            @csrf
        <div class="table-responsive">
            <table class="table table-striped" id="DataTable" width="100%">
                <thead>
                    <tr>
                        <th>
                            @if ( count($unit) > 0 )
                            <input type="checkbox" onclick="checkAll(this)">
                            @endif
                            #
                        </th>
                        <th>Nama Satuan</th>
                        <th>Dihapus</th>
                    </tr>
                </thead>
                <tbody>
                    @if ( count($unit) > 0 )
                        @foreach ($unit as $value)
                            <tr>
                                <td>
                                    <input type="checkbox" value="{{ $value->id }}" name="id[]">
                                </td>
                                <td>{{ $value->unit_name }}</td>
                                <td>{{ date('d-m-Y H:i',strtotime($value->deleted_at)) }}</td>
                            </tr>
                        @endforeach
                    @else 
                        <tr>
                            <td colspan="3">Data kosong</td>
                        </tr>
                    @endif
                </tbody>
                @if ( count($unit) > 0 )
                <tfoot>
                    <tr>
                        <td colspan="3">
                            <button type="submit" name="restore" value="restore" class="btn btn-default">
                                <i class="fas fa-trash-restore"></i> Pulihkan
                            </button>

                            <button type="submit" name="forever" value="forever" class="btn btn-default float-right">
                                <i class="far fa-trash-alt"></i> Hapus Selamanya
                            </button>
                        </td>
                    </tr>
                </tfoot>
                @endif
            </table>
        </div>
        </form>

    </div>
</div>

@endsection

@if ( count($unit) > 0 )
@section('javascript')
<script type="text/javascript">
        function checkAll(bx) {
            var cbs = document.getElementsByTagName('input');
            for(var i=0; i < cbs.length; i++) {
                if(cbs[i].type == 'checkbox') {
                cbs[i].checked = bx.checked;
                }
            }
        }
</script>
@endsection
@endif