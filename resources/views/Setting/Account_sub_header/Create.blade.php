@extends('Template.App') 
@section('title',$title)
@section('content')
<form action="{{ url('setting/account_sub_header') }}" method="post">
    @csrf
<div class="card elevation-0">
    <div class="card-body">

        <div class="form-group">
            <label>Header</label>
            <select name="header_id" class="form-control @error('header_id') is-invalid @enderror">
                <option value="">-- Pilih --</option>
                @foreach ($account_header as $value)
                <option value="{{ $value->id }}" @if ( $value->id == old('header_id')   ) selected @endif>{{ $value->header_code.' - '.$value->header_name }}</option>
                @endforeach
            </select>
            @error('header_id')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Kode Sub Header</label>
            <input type="text" name="sub_header_code" value="{{ old('sub_header_code') }}" class="form-control @error('sub_header_code') is-invalid @enderror">
            @error('sub_header_code')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Nama Sub Header</label>
            <input type="text" name="header_sub_name" value="{{ old('header_sub_name') }}" class="form-control @error('header_sub_name') is-invalid @enderror">
            @error('header_sub_name')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

    </div>
    <div class="card-footer bg-white border-top">
        <button type="button" class="btn btn-warning" onclick="location.href='{{ url('/setting/account_sub_header') }}'">
            <i class="fas fa-solid fa-arrow-left"></i> Kembali
        </button>
        <button type="submit" class="btn btn-primary">
            <i class="far fa-save"></i> Simpan
        </button>
    </div>
</div>
</form>
@endsection

@section('javascript')
<script type="text/javascript">

$('[name="header_id"]').select2({
    allowClear: false,
    }).on('select2:open', () => {
    $(".select2-results:not(:has(a))").append('<a href="{{ url('setting/account_header/create') }}" class="select_add"><i class="fas fa-plus"></i> Add Data</a>');
});



$('body').on('change', '[name="header_id"]', function(event) {
  event.preventDefault();
  /* Act on the event */
  var id = $('[name="header_id"]').val();

  $.ajax({
        url: '{{ route('account_sub_header.lists_code') }}',
        type: 'post',
        dataType: 'json',
        data: {id:id,_token:'{{ csrf_token() }}'},
        success:function(json){
            $('[name="sub_header_code"]').val(json.last_code);
        },
        error:function(ts){
            $.notify(ts.message,{
                position:"top center",
                className :"error"
            });
        }
    });

});
</script>
@endsection