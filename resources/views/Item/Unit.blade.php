@extends('Template.App')
@section('title',$title)
@section('content')
<form action="{{ url('item/unit/'.$item->id.'') }}" method="post">
    @method('PUT')
    @csrf
<div class="card elevation-0">
    <div class="card-header">
        <div class="card-title">Nama Produk : {{ $item->item_name }}</div>
    </div>
    <div class="card-body">

        <div class="alert alert-info p-2">
            <span class="text-white">** Buat Satuan terkecil terlebih dahulu.</span>
        </div>

        <div class="table-responsive">
            <table class="table" id="TableSatuan">
                <thead>
                    <tr>
                        <th>Satuan Beli & Jual</th>
                        <th width="15%">Konversi</th>
                        <th width="20%">Harga Beli</th>
                        <th width="20%">Harga Jual</th>
                        <th width="20%">Jenis Satuan</th>
                        <th width="5%"></th>
                    </tr>
                </thead>
                <tbody>
                    @if (old('unit_id') )

                    @foreach ( old('unit_id') as $key => $result )
                        <tr>
                            <td>
                                <select name="unit_id[]" id="unit_{{ $key }}" class="form-control @error('unit_id.'.$key.'') is-invalid @enderror"  style="width:100%">
                                    <option value="">-- Pilih --</option>
                                    @if (Request::old('unit_id')[$key] != null )
                                    <option value="{{ old('unit_id')[$key] }}" selected>{{ $units->where('id', intval(old('unit_id')[$key]))->first()->unit_name}}</option>
                                    @endif
                                </select>
                            </td>
                            <td><input type="number" value="{{ old('amount')[$key] }}" name="amount[]" class="form-control text-center @error('amount.'.$key.'') is-invalid @enderror"></td>
                            <td><input type="number" value="{{ old('buy_price')[$key] }}" name="buy_price[]" class="form-control text-center @error('buy_price.'.$key.'') is-invalid @enderror"></td>
                            <td><input type="number"  value="{{ old('sell_price')[$key] }}" name="sell_price[]" class="form-control text-center @error('sell_price.'.$key.'') is-invalid @enderror"></td>
                            <td><input type="text" value="{{ old('unit_type')[$key] }}" name="unit_type[]" class="form-control"  readonly></td>
                            <td>
                                @if ($key > 0)
                                <button type="button" class="btn btn-danger remove"><i class="fas fa-times-circle"></i></button>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                    @else

                    @foreach ($unit as $keys => $value)
                        <tr>
                            <td>
                                <select name="unit_id[]" id="unit_{{ $keys }}" class="form-control"  style="width:100%">
                                    <option value="">-- Pilih --</option>
                                    <option value="{{ $value['id'] }}" selected>{{ $units->where('id', intval($value['id']))->first()->unit_name}}</option>
                                </select>
                            </td>
                            <td><input type="number" value="{{ $value['amount'] }}" name="amount[]" class="form-control text-center"></td>
                            <td><input type="number" value="{{ $value['buy_price'] }}" name="buy_price[]" class="form-control text-center"></td>
                            <td><input type="number" value="{{ $value['sell_price'] }}" name="sell_price[]" class="form-control text-center"></td>
                            <td><input type="text" value="{{ $value['unit_type'] }}" name="unit_type[]" class="form-control"  readonly></td>
                            <td>
                                @if ($keys > 0)
                                <button type="button" class="btn btn-danger remove"><i class="fas fa-times-circle"></i></button>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                    @endif
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="6">
                        <button type="button" id="BarisBaru" class="btn btn-default" name="button">
                            <i class="fas fa-solid fa-plus"></i> Tambah Baris
                        </button>
                    </td>
                </tr>
            </tfoot>
            </table>
        </div>

    </div>

    <div class="card-footer bg-white border-top">
        <button type="button" class="btn btn-warning" onclick="location.href='{{ url('/item/'.$item->id.'') }}'">
            <i class="fas fa-solid fa-arrow-left"></i> Kembali
         </button>
         <button type="submit" class="btn btn-primary btn_add">
            <i class="far fa-save"></i> Simpan
         </button>
    </div>

</div>
</form>
@endsection

@section('Notify')
@include('Template.Notify')
@endsection

@section('javascript')
<script type="text/javascript">

var unit = {!! old('unit_id') != null ? count(old('unit_id')) : count($unit) !!};
for (let index = 0; index < unit; index++) {
    const element = index;
    const checkID = document.getElementById('unit_'+index).value
    select_unit(element,checkID);
}

function select_unit(Nomor,checkID)
{
    $.ajax({
      url: '{{ route('api.ajax_unit') }}',
      type: 'get',
      dataType: 'json',
    })
    .done(function(json) {
      json.forEach(element => {
        if (checkID != element.id) {
            if (checkID == element.id ) {
                selected = 'selected';
            } else {
                selected = '';
            }
            $('#unit_'+Nomor).append('<option value="'+element.id+'" '+selected+'>'+element.text+'</option>')
        }
      });
    })
}

function BarisBaru()
{
    var Nomor = $('#TableSatuan tbody tr').length;
    var Baris  = '<tr>';
    Baris += '<td>';
    Baris += '<select name="unit_id[]" id="unit_'+Nomor+'"  class="form-control" style="width:100%"><option value="">-- Pilih --</option></select>';
    Baris += '</td>';
    Baris += '<td>';
    Baris += '<input type="number" name="amount[]" class="form-control text-center">';
    Baris += '</td>';
    Baris += '<td>';
    Baris += '<input type="number" name="buy_price[]" class="form-control text-center">';
    Baris += '</td>';
    Baris += '<td>';
    Baris += '<input type="number" name="sell_price[]" class="form-control text-center">';
    Baris += '</td>';
    Baris += '<td><input type="text" name="unit_type[]" value="Konversi" class="form-control" readonly></td>';
    Baris += '<td>';
    Baris += '<button type="button" class="btn btn-danger remove"><i class="fas fa-times-circle"></i></button>';
    Baris += '</td>';
    Baris += '</tr>';

    $('#TableSatuan tbody').append(Baris);
}

$('body').on('click', '#BarisBaru', function(event) {
    event.preventDefault();
    /* Act on the event */
    add_field= '';
    var Item  = '';
    var Nomor = 0;

    $('#TableSatuan tbody tr').each(function(){

        if( $(this).find('td:nth-child(4) input').val() == '' )
        {
            add_field +=$(this).find('td:nth-child(4) input').focus();
        }

        if( $(this).find('td:nth-child(3) input').val() == '' )
        {
            add_field +=$(this).find('td:nth-child(3) input').focus();
        }

        if( $(this).find('td:nth-child(2) input').val() == '' )
        {
            add_field +=$(this).find('td:nth-child(2) input').focus();
        }

        if( $(this).find('td:nth-child(1) select').val() == '' )
        {
            add_field +=$(this).find('td:nth-child(1) select').focus();
        }

        Nomor++;
    });


    if( add_field == '' ){
        BarisBaru();
        select_unit(Nomor,Item);
    }
});

$(document).on('click','.remove',function(){
    $(this).closest('tr').remove();
});


</script>
@endsection
