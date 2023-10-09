@extends('Template.App') 
@section('title',$title)
@section('content')
<form action="{{ url('contact') }}" method="post" enctype="multipart/form-data">
    @csrf
<div class="card elevation-0 mb-2">
    <div class="card-header">
        <h5 class="card-title"><i class="fas fa-user-tag"></i> Info Kontak</h5>
    </div>
    <div class="card-body pb-2">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><span class="text-danger">*</span> Nama Panggilan</label>
                    <input type="text" name="nickname" value="{{ old('nickname') }}" class="form-control @error('nickname') is-invalid @enderror">
                    @error('nickname')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><span class="text-danger">*</span> Tipe Kontak</label>
                    <select name="contact_type[]" class="form-control  @error('contact_type') is-invalid @enderror" width="100%" multiple>
                        @foreach ($allOptionsType as $option)
                            <option value="{{ $option['id'] }}" {{ in_array($option['id'], old('contact_type',[])) ? 'selected' : '' }}>
                                {{ $option['text'] }}
                            </option>
                        @endforeach
                    </select> 
                    @error('contact_type')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Profile</label>
            <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input @error('profile') is-invalid @enderror" name="profile">
                  <label class="custom-file-label">
                  Choose file only JPG | PNG | JPEG
                  </label>
                </div>
            </div>
            @error('profile')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

    </div>
</div>

<div class="card elevation-0 mb-2">
    <div class="card-header">
      <h3 class="card-title"><i class="fas fa-business-time"></i> Informasi Umum</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
        </button>
      </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><span class="text-danger">*</span> Nama Kontak</label>
                    <input type="text" name="contact_name" value="{{ old('contact_name') }}" class="form-control @error('contact_name') is-invalid @enderror">
                    @error('contact_name')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>No Handphone</label>
                    <input type="text" name="handphone" value="{{ old('handphone') }}" class="form-control @error('handphone') is-invalid @enderror">
                    @error('handphone')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Identitas</label>
                    <div class="row">
                        <div class="col-4 col-md-4">
                            <select name="identity_type" class="form-control" width="100%">
                                @if(Request::old('identity_type') != NULL)
                                <option value="{{Request::old('identity_type')}}">{{Request::old('identity_type')}}</option>
                                @endif
                            </select>
                        </div>
                        <div class="col-8 col-md-8">
                            <input type="text" name="identity_number"  value="{{ old('identity_number') }}" class="form-control @error('identity_number') is-invalid @enderror" placeholder="Nomor Identitas">
                        </div>
                    </div>
                    @error('identity_number')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Email </label> <i class="text-sm">( Email bisa lebih dari satu )</i>
                    <input type="text" name="emails" data-role="tagsinput" value="{{ old('emails') }}" class="form-control  @error('emails') is-invalid @enderror">
                    @error('emails')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Info Lainnya</label>
            <input type="text" name="other_info" value="{{ old('other_info') }}" class="form-control @error('other_info') is-invalid @enderror">
            @error('other_info')
                <span class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
  </div>

<div class="card elevation-0 mb-2">
    <div class="card-header">
        <h3  class="card-title"><i class="fas fa-building"></i> Informasi Perusahaan</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nama Perusahaan</label>
                    <input type="text" name="company_name" value="{{ old('company_name') }}" class="form-control @error('company_name') is-invalid @enderror">
                    @error('company_name')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Telepon</label>
                    <input type="text" name="telephone" value="{{ old('telephone') }}" class="form-control @error('telephone') is-invalid @enderror">
                    @error('telephone')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Fax</label>
                    <input type="text" name="fax" value="{{ old('fax') }}" class="form-control @error('fax') is-invalid @enderror">
                    @error('fax')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>NPWP</label>
                    <input type="text" name="npwp" value="{{ old('npwp') }}" class="form-control @error('npwp') is-invalid @enderror">
                    @error('npwp')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Alamat Pembayaran</label>
                    <textarea name="payment_address" class="form-control @error('payment_address') is-invalid @enderror"  cols="30" >{{ old('payment_address') }}</textarea>
                    @error('payment_address')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Alamat Pengiriman</label>
                    <textarea name="shipping_address" class="form-control @error('shipping_address') is-invalid @enderror"  cols="30" >{{ old('shipping_address') }}</textarea>
                    @error('shipping_address')
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
        @php
            $count = old('bank_name') != '' ? count(old('bank_name')) : 0;
        @endphp
        <table id="AkunBank" width="100%">
            <tbody>
            @if ( $count > 0 )
               @for ($i = 0; $i < $count; $i++)
                    @if ( old('bank_name.'.$i.'') != '' || old('account_holder.'.$i.'') != '' ||  old('branch_office.'.$i.'') != '' || old('account_number.'.$i.'') != '' )
                        <tr>
                            <td class="p-2">
                                <div class="form-group">
                                    <label>Nama Bank</label>
                                    <input type="text" value="{{ old('bank_name.'.$i.'') }}" name="bank_name[{{ $i }}]" class="form-control bank_name{{ $i }}">
                                </div>
                                <div class="form-group">
                                    <label>Pemegang Akun Bank</label>
                                    <input type="text" value="{{ old('account_holder.'.$i.'') }}" name="account_holder[{{ $i }}]]" class="form-control account_holder{{ $i }}">
                                </div>
                            </td>
                            <td class="p-2">
                                <div class="form-group">
                                    <label>Kantor Cabang</label>
                                    <input type="text" value="{{ old('branch_office.'.$i.'') }}" name="branch_office[{{ $i }}]]" class="form-control branch_office{{ $i }}">
                                </div>
                                <div class="form-group">
                                    <label>Nomor Rekening</label>
                                    <input type="text" value="{{ old('account_number.'.$i.'') }}" name="account_number[{{ $i }}]]" class="form-control account_number{{ $i }}">
                                </div>
                            </td>
                            <td class="p-2 align-top d-flex justify-content-center">
                                @if ( $i > 0 )
                                <button type="button" id="{{ $i }}" class="btn btn-default remove"><i class="fas fa-times-circle"></i></button>
                                @endif
                            </td>
                        </tr>
                    @endif
                    @endfor 
                @else
                <tr>
                    <td class="p-2">
                        <div class="form-group">
                            <label>Nama Bank</label>
                            <input type="text" name="bank_name[0]" class="form-control bank_name0">
                        </div>
                        <div class="form-group">
                            <label>Pemegang Akun Bank</label>
                            <input type="text" name="account_holder[0]]" class="form-control account_holder0">
                        </div>
                    </td>
                    <td class="p-2">
                        <div class="form-group">
                            <label>Kantor Cabang</label>
                            <input type="text" name="branch_office[0]]" class="form-control branch_office0">
                        </div>
                        <div class="form-group">
                            <label>Nomor Rekening</label>
                            <input type="text" name="account_number[0]]" class="form-control account_number0">
                        </div>
                    </td>
                    <td class="p-2 align-top d-flex justify-content-center"></td>
                </tr>    
                @endif
            </tbody>
        </table>

        <button type="button" id="BarisBaru" class="btn btn-default" name="button">
            <i class="fas fa-solid fa-plus"></i> Tambah Akun Bank Lain
        </button>
    </div>
  </div>

  <div class="card elevation-0 mb-2">
    <div class="card-header">
      <h3 class="card-title"><i class="fas fa-wallet"></i> Pemetaan Akun</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
        </button>
      </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Akun Piutang</label>
                    <select name="receivable_account" class="form-control @error('receivable_account') is-invalid @enderror">
                        @if(Request::old('receivable_account') != NULL)
                           @php
                               $value = $account_list->where('id', intval(Request::old('receivable_account')))->first();
                           @endphp
                            <option value="{{Request::old('receivable_account')}}">{{ $value->lists_code.' - '.$value->lists_name }}</option>
                        @endif
                    </select>
                    @error('receivable_account')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Akun Hutang</label>
                    <select name="accounts_payable" class="form-control @error('accounts_payable') is-invalid @enderror">
                        @if(Request::old('accounts_payable') != NULL)
                           @php
                               $value = $account_list->where('id', intval(Request::old('accounts_payable')))->first();
                           @endphp
                            <option value="{{Request::old('accounts_payable')}}">{{ $value->lists_code.' - '.$value->lists_name }}</option>
                        @endif
                    </select>
                    @error('accounts_payable')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Maksimal Piutang</label>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="custom-control custom-switch mt-2">
                                <input type="hidden" value="0" name="receivable_checked">
                                <input type="checkbox" name="receivable_checked" value="1" id="customSwitchCre" class="custom-control-input" @if( old('receivable_checked') == 1 ) checked @endif>
                                <label class="custom-control-label text-primary" for="customSwitchCre">Aktifkan Maksimal Piutang</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="credit_limit" placeholder="Maksimal Piutang" value="{{ old('credit_limit') }}" class="form-control @error('credit_limit') is-invalid @enderror" @if( old('receivable_checked') == 1 ) style="display:block" @else style="display:none" @endif>
                        </div>
                    </div>
                    @error('credit_limit')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Hutang Maksimal</label>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="custom-control custom-switch mt-2">
                                <input type="hidden" value="0" name="payable_checked">
                                <input type="checkbox" name="payable_checked" value="1" id="customSwitchPay" class="custom-control-input" @if( old('payable_checked') == 1 ) checked @endif>
                                <label class="custom-control-label text-primary" for="customSwitchPay">Aktifkan Hutang Maksimal</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="payable_limit" placeholder="Hutang Maksimal" value="{{ old('payable_limit') }}" class="form-control @error('payable_limit') is-invalid @enderror"  @if( old('payable_checked') == 1 ) style="display:block" @else style="display:none" @endif>
                        </div>
                    </div>
                    @error('payable_limit')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>
  </div>

<div class="card elevation-0 ">
    <div class="card-footer rounded-top bg-white">
        <button type="button" class="btn btn-warning" onclick="location.href='{{ url('/contact') }}'">
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
bsCustomFileInput.init();

$('[name="contact_type[]"]').select2({
    tags: false,
    placeholder: 'Dapat dipilih lebih dari satu.',
});


let json_contact = ['KTP','SIM'];
$('[name="identity_type"]').select2({
    placeholder: 'Pilih Tipe Kontak',
    data: json_contact.map(option => ({ id: option, text: option })),
});

$('[name="receivable_account"]').select2({
    allowClear: true,
    placeholder: "Cari akun piutang",
    delay: 250,
    ajax: {
        url: '{{ route('api.ajax_account') }}',
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
    $(".select2-results:not(:has(a))").append('<a href="{{ url('setting/account_list/create') }}" class="select_add"><i class="fas fa-plus"></i> Add</a>');
});

$('[name="accounts_payable"]').select2({
    allowClear: true,
    placeholder: "Cari akun hutang",
    delay: 250,
    ajax: {
        url: '{{ route('api.ajax_account') }}',
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
    $(".select2-results:not(:has(a))").append('<a href="{{ url('setting/account_list/create') }}" class="select_add"><i class="fas fa-plus"></i> Add</a>');
});


function BarisBaru()
{
    var Count = $('#AkunBank tbody tr').length;
    var Baris  = '<tr id="row'+Count+'" name="id'+Count+'">';
        Baris += '<td class="p-2">'+
                    '<div class="form-group">'+
                        '<label>Nama Bank</label>'+
                        '<input type="text" name="bank_name['+Count+']" class="form-control bank_name'+Count+'">'+
                    '</div>'+
                    '<div class="form-group">'+
                        '<label>Pemegang Akun Bank</label>'+
                        '<input type="text" name="account_holder['+Count+']]"  class="form-control account_holder'+Count+'">'+
                    '</div>'+
                  '</td>';
        Baris += '<td class="p-2">'+
                    '<div class="form-group">'+
                        '<label>Kantor Cabang</label>'+
                        '<input type="text" name="branch_office['+Count+']]"  class="form-control branch_office'+Count+'">'+
                    '</div>'+
                    '<div class="form-group">'+
                        '<label>Nomor Rekening</label>'+
                        '<input type="text" name="account_number['+Count+']]" class="form-control account_number'+Count+'">'+
                    '</div>'+
                 '</td>';
        
        var remove_button = '';
        if ( Count > 0 ){
            remove_button = '<button type="button" id="'+Count+'" class="btn btn-default remove"><i class="fas fa-times-circle"></i></button>';
        }

        Baris += '<td class="p-2 align-top d-flex justify-content-center">'+remove_button+'</td>';
        Baris += '</tr>';

        $('#AkunBank tbody').append(Baris);
}


$(document).on('click', '.remove', function(){
    $(this).closest('tr').remove();
});

$('body').on('click', '#BarisBaru', function(event) {
    event.preventDefault();
    /* Act on the event */
    var Record = '';
    var Nomor  = 0;
    $('#AkunBank tbody tr').each(function(){

        if( $(this).find('td:nth-child(2) .account_number'+Nomor+'').val() == '' )
        {
            Record +=$(this).find('td:nth-child(2) .account_number'+Nomor+'').focus();
        }

        if( $(this).find('td:nth-child(2) .branch_office'+Nomor+'').val() == '' )
        {
            Record +=$(this).find('td:nth-child(2) .branch_office'+Nomor+'').focus();
        }

        if( $(this).find('td:nth-child(1) .account_holder'+Nomor+'').val() == '' )
        {
            Record +=$(this).find('td:nth-child(1) .account_holder'+Nomor+'').focus();
        }

        if( $(this).find('td:nth-child(1) .bank_name'+Nomor+'').val() == '' )
        {
            Record +=$(this).find('td:nth-child(1) .bank_name'+Nomor+'').focus();
        }

        Nomor++;
    });

    if ( Record == '' ){
        $('#AkunBank tbody').append(BarisBaru());
    }
});

$('body').on('click', '#customSwitchCre', function() {
  /* Act on the event */
    if($(this).is(':checked')){
        $('[name="credit_limit"]').css('display','block');
    }else{
        $('[name="credit_limit"]').css('display','none');
    }
});

$('body').on('click', '#customSwitchPay', function() {
  /* Act on the event */
    if($(this).is(':checked')){
        $('[name="payable_limit"]').css('display','block');
    }else{
        $('[name="payable_limit"]').css('display','none');
    }
});
</script>
@endsection
