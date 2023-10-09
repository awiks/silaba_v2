@extends('Template.App') 
@section('title',$title)
@section('content')

<div class="card elevation-0">
    <div class="card-header">
        <button type="button" class="btn btn-warning" onclick="location.href='{{ url('/setting/account_list') }}'">
            <i class="fas fa-solid fa-arrow-left"></i> Kembali
         </button>
    </div>
    <div class="card-body">

        <form action="{{ url('setting/account_list/recycle_bin') }}" method="post">
            @csrf
        <div class="table-responsive">
            <table class="table table-striped" id="DataTable" width="100%">
                <thead>
                    <tr>
                        <th>
                            @if ( count($account_list) > 0 )
                            <input type="checkbox" onclick="checkAll(this)">
                            @endif
                            #
                        </th>
                        <th>Kode</th>
                        <th>Daftar Akun</th>
                        <th>Kategori Akun</th>
                        <th>Sub Header</th>
                        <th>Header</th>
                        <th>Dihapus</th>
                    </tr>
                </thead>
                <tbody>
                    @if ( count($account_list) > 0 )
                        @foreach ($account_list as $value)
                            <tr>
                                <td>
                                    <input type="checkbox" value="{{ $value->id }}" name="id[]">
                                </td>
                                <td>{{ $value->lists_code }}</td>
                                <td>{{ $value->lists_name }}</td>
                                <td>{{ $value->account_category->categories_name }}</td>
                                <td>{{ $value->account_category->account_sub_header->header_sub_name }}</td>
                                <td>{{ $value->account_category->account_sub_header->account_header->header_name }}</td>
                                <td>{{ date('d-m-Y H:i',strtotime($value->deleted_at)) }}</td>
                            </tr>
                        @endforeach
                    @else 
                        <tr>
                            <td colspan="7">Data kosong</td>
                        </tr>
                    @endif
                </tbody>
                @if ( count($account_list) > 0 )
                <tfoot>
                    <tr>
                        <td colspan="7">
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

@if ( count($account_list) > 0 )
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