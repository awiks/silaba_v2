@extends('Template.App')
@section('title',$title)
@section('content')
<form id="simpan"  method="post">
    <input type="hidden" value="{{ $item->id }}" name="id">
    @csrf
<div class="card elevation-0">
    <div class="card-header">
        <div class="card-title">{{ $item->item_name }}</div>
    </div>
    <div class="card-body">

        <div class="alert alert-light">
            <span class="text-danger">** Buat Satuan terkecil terlebih dahulu.</span>
        </div>

        <div class="table-responsive">
            <table class="table" id="TableSatuan">
                <thead>
                    <tr>
                        <th width="5%"></th>
                        <th>Satuan Beli & Jual</th>
                        <th width="15%">Konversi</th>
                        <th width="20%">Harga Beli Satuan</th>
                        <th width="20%">Harga Jual Satuan</th>
                        <th width="20%">Jenis Satuan</th>
                        <th width="5%"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($unit_conversions as $value)
                    @php
                        $jenisSatuan = $value->unit_type == 1 ? 'Satuan Dasar': 'Konversi';
                    @endphp
                        <tr>
                            <input type="hidden" name="conversion_id[{{ $loop->index + 1 }}]" value="{{ $value->id }}">
                            <td>{{ $loop->index + 1 }}</td>
                            <td>
                                @php
                                $unit_id_old = Request::old('unit_id') ? Request::old('unit_id') : $value->unit_id;
                                @endphp
                                <select name="unit_id[{{ $loop->index + 1 }}]"  class="form-control"  style="width:100%" required>
                                    @if( $unit_id_old != NULL)
                                        <option value="{{$unit_id_old}}">{{ $units->where('id', intval($unit_id_old))->first()->unit_name}}</option>
                                    @endif
                                </select>
                            </td>
                            <td>
                                <input type="number" value="{{ $value->amount }}" name="amount[{{ $loop->index + 1 }}]" class="form-control" style="text-align:center" required>
                            </td>
                            <td>
                                <input type="number" value="{{ $value->buy_price }}" name="buy_price[{{ $loop->index + 1 }}]" class="form-control" style="text-align:center" required>
                            </td>
                            <td>
                                <input type="number" value="{{ $value->sell_price }}" name="sell_price[{{ $loop->index + 1 }}]" class="form-control" style="text-align:center" required>
                            </td>
                            <td>
                                <input type="text" value="{{ $jenisSatuan }}" class="form-control"  disabled>
                            </td>
                            <td></td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="7">
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

var unit_conversation = {!! count($unit_conversions) !!};
for (let index = 0; index < unit_conversation; index++) {
    const element = index+1;
    select_unit(element);
}

function select_unit(Nomor)
{
    $('[name="unit_id['+Nomor+']"]').select2({
        allowClear: true,
        placeholder: "Cari satuan",
        delay: 250,
        ajax: {
            url: '{{ route('api.ajax_unit') }}',
            dataType: 'json',
            data: function (params) {
                return {
                    q: $.trim(params.term)
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        },
        }).on('select2:open', () => {
        $(".select2-results:not(:has(a))").append('<a href="{{ url('setting/unit/create') }}" class="select_add"><i class="fas fa-plus"></i> Add</a>');
    });
}

for(B=1; B<=1; B++){
    BarisBaru();
}

function BarisBaru()
{
    var Nomor = $('#TableSatuan tbody tr').length + 1;
    var Baris  = '<tr id="row'+Nomor+'" name="id'+Nomor+'">';
    var urutan = Nomor == 1 ? '': Nomor;
    var jenisSatuan = Nomor == 1 ? 'Satuan Dasar': 'Konversi';
    Baris += '<td><input type="hidden" name="conversion_id['+Nomor+']" value="0">'+Nomor+'</td>';
    Baris += '<td>';
    Baris += '<select name="unit_id['+Nomor+']"  class="form-control" style="width:100%" required></select>';
    Baris += '</td>';
    Baris += '<td>';
    Baris += '<input type="number" name="amount['+Nomor+']" class="form-control" style="text-align:center" required>';
    Baris += '</td>';
    Baris += '<td>';
    Baris += '<input type="number" name="buy_price['+Nomor+']" class="form-control" style="text-align:center" required>';
    Baris += '</td>';
    Baris += '<td>';
    Baris += '<input type="number" name="sell_price['+Nomor+']" class="form-control" style="text-align:center" required>';
    Baris += '</td>';
    Baris += '<td><input type="text" value="'+jenisSatuan+'" class="form-control"  disabled></td>';
    Baris += '<td>';
    Baris += '<button type="button" name="remove" id="'+Nomor+'" class="btn btn-default btn_del"><i class="fas fa-times-circle"></i></button>';
    Baris += '</td>';
    Baris += '</tr>';

    $('#TableSatuan tbody').append(Baris);

    if ( Nomor == 1 ){
        $('.btn_del').css('display', 'none');
    }

    select_unit(Nomor);

}


$(document).on('click', '.btn_del', function(){
    var button_id = $(this).attr("id");
    $('#row'+button_id+'').remove();
});

$('body').on('click', '#BarisBaru', function(event) {
    event.preventDefault();
    /* Act on the event */

    var Record = '';
    $('#TableSatuan tbody tr').each(function(){

        if( $(this).find('td:nth-child(5) input').val() == '' )
        {
            Record +=$(this).find('td:nth-child(5) input').focus();
        }

        if( $(this).find('td:nth-child(4) input').val() == '' )
        {
            Record +=$(this).find('td:nth-child(4) input').focus();
        }

        if( $(this).find('td:nth-child(3) input').val() == '' )
        {
            Record +=$(this).find('td:nth-child(3) input').focus();
        }

        if( $(this).find('td:nth-child(2) select').val() == '' )
        {
            Record +=$(this).find('td:nth-child(2) select').focus();

        }
    });

    if ( Record == '' ){
        BarisBaru();
    }
});



$('#simpan').validate({
  ignore: [],
  rules:{
    'unit_id[]':{
        required:true,
    },
    'amount[]':{
        required:true,
    },
    'buy_price[]':{
        required:true,
    },
    'sell_price[]':{
        required:true,
    },
  },
  messages:{
    'unit_id[]':{
        required:'',
    },
    'amount[]':{
        required:'',
    },
    'buy_price[]':{
        required:'',
    },
    'sell_price[]':{
        required:'',
    },
  },
  errorElement: 'span',
    errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
  },
});


$('body').on('submit', '#simpan', function(event) {
      event.preventDefault();
      /* Act on the event */
        $('.btn_add').prop('disabled', true);

        $.ajax({
            url: '{{ route('item.unit') }}',
            type: 'post',
            dataType: 'json',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $('.btn_add').html('<i class="spinner-border spinner-border-sm"></i> Menyimpan...');
            },
            complete: function(){
                setTimeout(function () {
                    $('.btn_add').html('<i class="far fa-save"></i> Simpan');
                }, 1000);
            },
            success:function(json)
            {
                setTimeout(function () {
                    if( json.status == 1 ){
                        window.location.replace('/item/{{ $item->id }}');
                    }
                    else{
                        $('.btn_add').prop('disabled', false);
                        $.notify(json.message,{
                            position:"top center",
                            className :"error"
                        });
                    }
                }, 1000);
            },
            error:function()
            {
                $('.btn_add').prop('disabled', false);
                $('.btn_add').html('<i class="far fa-save"></i> Simpan');
            }
    });
});

</script>
@endsection
