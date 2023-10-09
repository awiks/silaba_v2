@extends('Template.App') 
@section('title',$title)
@section('content')
<form action="{{ url('setting/account_list') }}" method="post">
    @csrf
<div class="card elevation-0">
    <div class="card-body">

        <div class="form-group">
            <label>Kategori Akun</label>
            <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                <option value="">-- Pilih --</option>
                @foreach ($account_category as $value)
                <option value="{{ $value->id }}" @if ( $value->id == old('category_id')   ) selected @endif>{{ $value->category_code.' - '.$value->account_sub_header->account_header->header_name.' - '.$value->account_sub_header->header_sub_name.' - '.$value->categories_name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Kode Akun</label>
            <input type="text" name="lists_code" value="{{ old('lists_code') }}" class="form-control @error('lists_code') is-invalid @enderror">
            @error('lists_code')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Nama Akun</label>
            <input type="text" name="lists_name" value="{{ old('lists_name') }}" class="form-control @error('lists_name') is-invalid @enderror">
            @error('lists_name')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

    </div>
    <div class="card-footer bg-white border-top">
        <button type="button" class="btn btn-warning" onclick="location.href='{{ url('/setting/account_list') }}'">
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

$('[name="category_id"]').select2({
    allowClear: false,
    }).on('select2:open', () => {
    $(".select2-results:not(:has(a))").append('<a href="{{ url('setting/account_category/create') }}" class="select_add"><i class="fas fa-plus"></i> Add Data</a>');
});

$('body').on('change', '[name="category_id"]', function(event) {
  event.preventDefault();
  /* Act on the event */
  var id = $('[name="category_id"]').val();

  $.ajax({
        url: '{{ route('account_list.lists_code') }}',
        type: 'post',
        dataType: 'json',
        data: {id:id,_token:'{{ csrf_token() }}'},
        success:function(json){
            $('[name="lists_code"]').val(json.last_code);
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