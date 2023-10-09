@extends('Template.App') 
@section('title',$title)
@section('content')
<form action="{{ url('setting/account_category/'.$account_category->id.'') }}" method="post">
    @method('PUT')
    @csrf
<div class="card elevation-0">
    <div class="card-body">
        @php $sub_header_id_old = old('sub_header_id') ? old('sub_header_id') : $account_category->sub_header_id; @endphp
        <div class="form-group">
            <label>Header & Sub Header</label>
            <select name="sub_header_id" class="form-control @error('sub_header_id') is-invalid @enderror">
                <option value="">-- Pilih --</option>
                @foreach ($account_sub_header as $value)
                <option value="{{ $value->id }}" @if ( $value->id == $sub_header_id_old  ) selected @endif>{{ $value->sub_header_code.' - '.$value->account_header->header_name.' - '.$value->header_sub_name }}</option>
                @endforeach
            </select>
            @error('sub_header_id')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Kode  Kategori Akun</label>
            <input type="text" name="category_code" value="{{ old('category_code') ? old('category_code') : $account_category->category_code }}" class="form-control @error('category_code') is-invalid @enderror">
            @error('category_code')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Kategori Akun</label>
            <input type="text" name="categories_name" value="{{ old('categories_name') ? old('categories_name') : $account_category->categories_name }}" class="form-control @error('categories_name') is-invalid @enderror">
            @error('categories_name')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

    </div>
    <div class="card-footer bg-white border-top">
        <button type="button" class="btn btn-warning" onclick="location.href='{{ url('/setting/account_category') }}'">
            <i class="fas fa-solid fa-arrow-left"></i> Kembali
        </button>
        <button type="submit" class="btn btn-success">
            <i class="far fa-save"></i> Perbarui
        </button>
    </div>
</div>
</form>
@endsection

@section('javascript')
<script type="text/javascript">

$('[name="sub_header_id"]').select2({
    allowClear: false,
    }).on('select2:open', () => {
    $(".select2-results:not(:has(a))").append('<a href="{{ url('setting/account_sub_header/create') }}" class="select_add"><i class="fas fa-plus"></i> Add Data</a>');
});


$('body').on('change', '[name="sub_header_id"]', function(event) {
  event.preventDefault();
  /* Act on the event */
  var id = $('[name="sub_header_id"]').val();

  $.ajax({
        url: '{{ route('account_category.lists_code') }}',
        type: 'post',
        dataType: 'json',
        data: {id:id,_token:'{{ csrf_token() }}'},
        success:function(json){
            $('[name="category_code"]').val(json.last_code);
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