@extends('Template.App') 
@section('title',$title)
@section('content')

<div class="card elevation-0">
    <div class="card-header">
        <button type="button" class="btn btn-warning" onclick="location.href='{{ url('/setting/account_header') }}'">
            <i class="fas fa-solid fa-arrow-left"></i> Kembali
         </button>
    </div>
    <div class="card-body">

        <form action="{{ url('setting/account_header/recycle_bin') }}" method="post">
            @csrf
        <div class="table-responsive">
            <table class="table table-striped" id="DataTable" width="100%">
                <thead>
                    <tr>
                        <th>
                            @if ( count($account_header) > 0 )
                            <input type="checkbox" onclick="checkAll(this)">
                            @endif
                            #
                        </th>
                        <th>Kode</th>
                        <th>Nama Header</th>
                        <th>Jenis Penyajian</th>
                        <th>Normal Akun</th>
                        <th>Dihapus</th>
                    </tr>
                </thead>
                <tbody>
                    @if ( count($account_header) > 0 )
                        @foreach ($account_header as $value)
                            <tr>
                                <td>
                                    <input type="checkbox" value="{{ $value->id }}" name="id[]">
                                </td>
                                <td>{{ $value->header_code }}</td>
                                <td>{{ $value->header_name }}</td>
                                <td>{!! $value->serving_header == 1 ? 'Aktiva' : 'Passiva' !!}</td>
                                <td>{!! $value->normal_balance == 1 ? '<span class="text-success">Debit</span>' : '<span class="text-danger">Kredit</span>' !!}</td>
                                <td>{{ date('d-m-Y H:i',strtotime($value->deleted_at)) }}</td>
                            </tr>
                        @endforeach
                    @else 
                        <tr>
                            <td colspan="6">Data kosong</td>
                        </tr>
                    @endif
                </tbody>
                @if ( count($account_header) > 0 )
                <tfoot>
                    <tr>
                        <td colspan="6">
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

@if ( count($account_header) > 0 )
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