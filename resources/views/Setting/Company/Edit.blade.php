@extends('Template.App') 
@section('title',$title)
@section('content')
<form action="{{ url('setting/company/'.$company->id.'') }}" method="post" enctype="multipart/form-data">
    @method('PUT')
    @csrf
<div class="card elevation-0 mb-2">
    <div class="card-body">

        <div class="form-group">
            <label>Logo</label>
            <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input @error('logo') is-invalid @enderror" name="logo">
                  <label class="custom-file-label">
                  Choose file only PNG
                  </label>
                </div>
            </div>
            @error('logo')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        @php $show_logo = old('show_logo') ? old('show_logo') : $company->show_logo; @endphp

        <div class="custom-control custom-switch mb-3">
            <input type="hidden" value="0" name="show_logo">
            <input type="checkbox" name="show_logo" value="1" id="customSwitchView" class="custom-control-input" @if( $show_logo == 1 ) checked @endif>
            <label class="custom-control-label text-primary" for="customSwitchView">Tampilkan logo dilaporan</label>
        </div>

        <div class="form-group">
            <label>Nama Perusahaan</label>
            <input type="text" name="company_name" value="{{ old('company_name') ? old('company_name') : $company->company_name }}" class="form-control @error('company_name') is-invalid @enderror">
            @error('company_name')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Alamat Perusahaan</label>
            <textarea name="address" class="form-control @error('address') is-invalid @enderror"  cols="30" >{{ old('address') ? old('address') : $company->address }}</textarea>
            @error('address')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Alamat Pengiriman</label>
            <textarea name="shipping_address" class="form-control @error('shipping_address') is-invalid @enderror"  cols="30" >{{ old('shipping_address') ? old('shipping_address') : $company->shipping_address }}</textarea>
            @error('shipping_address')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>NPWP</label>
            <input type="text" name="npwp" value="{{ old('npwp') ? old('npwp') : $company->npwp }}" class="form-control @error('npwp') is-invalid @enderror">
            @error('npwp')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Telepon</label>
                    <input type="text" name="telephone" value="{{ old('telephone') ? old('telephone') : $company->telephone }}" class="form-control @error('telephone') is-invalid @enderror">
                    @error('telephone')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Fax</label>
                    <input type="text" name="fax" value="{{ old('fax') ? old('fax') : $company->fax }}" class="form-control @error('fax') is-invalid @enderror">
                    @error('fax')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" value="{{ old('email') ? old('email') : $company->email }}" class="form-control @error('email') is-invalid @enderror">
                    @error('email')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Website</label>
                    <input type="text" name="website" value="{{ old('website') ? old('website') : $company->website }}" class="form-control @error('website') is-invalid @enderror">
                    @error('website')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

    </div>
</div>

<div class="card elevation-0 mb-2">
    <div class="card-header">
      <h3 class="card-title"><i class="fas fa-landmark"></i> Informasi Bank</h3>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
        </button>
      </div>
    </div>
    <div class="card-body">
        <table id="AkunBank" width="100%">
            <tbody>
            @if ( old('bank_name') )
                @foreach ( old('bank_name') as $key => $result )
                        <tr>
                            <td class="p-2">
                                <div class="form-group">
                                    <label>Nama Bank</label>
                                    <input type="text" value="{{ old('bank_name')[$key] }}" name="bank_name[]" class="form-control @error('bank_name.'.$key.'') is-invalid @enderror">
                                </div>
                                <div class="form-group">
                                    <label>Pemegang Akun Bank</label>
                                    <input type="text" value="{{ old('account_holder')[$key] }}" name="account_holder[]" class="form-control @error('account_holder.'.$key.'') is-invalid @enderror">
                                </div>
                            </td>
                            <td class="p-2">
                                <div class="form-group">
                                    <label>Kantor Cabang</label>
                                    <input type="text" value="{{ old('branch_office')[$key] }}" name="branch_office[]" class="form-control @error('branch_office.'.$key.'') is-invalid @enderror">
                                </div>
                                <div class="form-group">
                                    <label>Nomor Rekening</label>
                                    <input type="text" value="{{ old('account_number')[$key] }}" name="account_number[]" class="form-control @error('account_number.'.$key.'') is-invalid @enderror">
                                </div>
                            </td>
                            <td class="p-2 text-center" width="10%">
                                @if ($key > 0)
                                <button type="button" class="btn btn-default remove"><i class="fas fa-times-circle"></i></button>
                                @endif
                            </td>
                        </tr>
                @endforeach 
            @else
                @foreach (json_decode($company->account_bank) as $key => $item)
                <tr>
                    <td class="p-2">
                        <div class="form-group">
                            <label>Nama Bank</label>
                            <input type="text" name="bank_name[]" value="{{ $item->bank_name }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Pemegang Akun Bank</label>
                            <input type="text" name="account_holder[]" value="{{ $item->account_holder }}" class="form-control">
                        </div>
                    </td>
                    <td class="p-2">
                        <div class="form-group">
                            <label>Kantor Cabang</label>
                            <input type="text" name="branch_office[]" value="{{ $item->branch_office }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Nomor Rekening</label>
                            <input type="text" name="account_number[]" value="{{ $item->account_number }}" class="form-control">
                        </div>
                    </td>
                    <td class="p-2" width="10%">
                        @if ($key > 0)
                            <button type="button" class="btn btn-default remove"><i class="fas fa-times-circle"></i></button>
                        @endif
                    </td>
                </tr> 
                @endforeach
            @endif
            </tbody>
        </table>

        <button type="button" id="BarisBaru" class="btn btn-default" name="button">
            <i class="fas fa-solid fa-plus"></i> Tambah Akun Bank Lain
        </button>
    </div>
  </div>

  <div class="card">
    <div class="card-body bg-white border-top">
        <button type="button" class="btn btn-warning" onclick="location.href='{{ url('/setting/company') }}'">
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

bsCustomFileInput.init();

function BarisBaru()
{
    var Count = $('#AkunBank tbody tr').length;
    var Baris  = '<tr>';
        Baris += '<td class="p-2">'+
                    '<div class="form-group">'+
                        '<label>Nama Bank</label>'+
                        '<input type="text" name="bank_name[]" class="form-control bank_name'+Count+'">'+
                    '</div>'+
                    '<div class="form-group">'+
                        '<label>Pemegang Akun Bank</label>'+
                        '<input type="text" name="account_holder[]"  class="form-control account_holder'+Count+'">'+
                    '</div>'+
                  '</td>';
        Baris += '<td class="p-2">'+
                    '<div class="form-group">'+
                        '<label>Kantor Cabang</label>'+
                        '<input type="text" name="branch_office[]"  class="form-control branch_office'+Count+'">'+
                    '</div>'+
                    '<div class="form-group">'+
                        '<label>Nomor Rekening</label>'+
                        '<input type="text" name="account_number[]" class="form-control account_number'+Count+'">'+
                    '</div>'+
                 '</td>';
        
        var remove_button = '';
        if ( Count > 0 ){
            remove_button = '<button type="button" class="btn btn-default remove"><i class="fas fa-times-circle"></i></button>';
        }

        Baris += '<td class="p-2 text-center" width="10%">'+remove_button+'</td>';
        Baris += '</tr>';

        $('#AkunBank tbody').append(Baris);
}


$(document).on('click', '.remove', function(){
    $(this).closest('tr').remove();
});

$('body').on('click', '#BarisBaru', function(event) {
    event.preventDefault();
    /* Act on the event */
    var add_field = '';
        $('[name="account_number[]"]').each(function(){
            if( $(this).val() == '' )
            {
                add_field += $(this).focus();
            }
        });

        $('[name="account_holder[]"]').each(function(){
            if( $(this).val() == '' )
            {
                add_field += $(this).focus();
            }
        });

        $('[name="branch_office[]"]').each(function(){
            if( $(this).val() == '' )
            {
                add_field += $(this).focus();
            }
        });

        $('[name="bank_name[]"]').each(function(){
            if( $(this).val() == '' )
            {
                add_field += $(this).focus();
            }
        });

        if( add_field == '' ){
            $('#AkunBank tbody').append(BarisBaru());
        }
});

</script>
@endsection