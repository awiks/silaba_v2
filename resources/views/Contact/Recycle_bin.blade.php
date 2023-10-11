@extends('Template.App') 
@section('title',$title)
@section('content')

<div class="card elevation-0">
    <div class="card-header">
        <button type="button" class="btn btn-warning" onclick="location.href='{{ url('/contact') }}'">
            <i class="fas fa-solid fa-arrow-left"></i> Kembali
         </button>
    </div>
    <div class="card-body">

        <form action="{{ url('contact/recycle_bin') }}" method="post">
            @csrf
        <div class="table-responsive">
            <table class="table table-striped" id="DataTable" width="100%">
                <thead>
                    <tr>
                        <th>
                            @if ( count($contact) > 0 )
                            <input type="checkbox" onclick="checkAll(this)">
                            @endif
                            #
                        </th>
                        <th>Nama</th>
                        <th>Tipe Kontak</th>
                        <th>Nama Kontak</th>
                        <th>Email</th>
                        <th>Handphone</th>
                        <th>Telepon</th>
                        <th>Dihapus</th>
                    </tr>
                </thead>
                <tbody>
                    @if ( count($contact) > 0 )
                        @foreach ($contact as $value)
                            <tr>
                                <td>
                                    <input type="checkbox" value="{{ $value->id }}" name="id[]">
                                </td>
                                <td>{{ $value->nickname }}</td>
                                <td>{{ $value->contact_type }}</td>
                                <td>{{ $value->contact_name }}</td>
                                <td>{{ $value->emails }}</td>
                                <td>{{ $value->handphone }}</td>
                                <td>{{ $value->telephone }}</td>
                                
                                <td>{{ date('d-m-Y H:i',strtotime($value->deleted_at)) }}</td>
                            </tr>
                        @endforeach
                    @else 
                        <tr>
                            <td colspan="6">Data kosong</td>
                        </tr>
                    @endif
                </tbody>
                @if ( count($contact) > 0 )
                <tfoot>
                    <tr>
                        <td colspan="8">
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

@if ( count($contact) > 0 )
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