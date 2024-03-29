@extends('Template.App') 
@section('title',$title)
@section('content')
<form action="{{ url('contact/'.$contact->id.'') }}" method="post" enctype="multipart/form-data">
    @method('PUT')
    @csrf
<div class="card elevation-0 mb-2">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-user-tag"></i> Info Kontak</h3>
    </div>
    <div class="card-body pb-2">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><span class="text-danger">*</span> Nama Panggilan</label>
                    <input type="text" name="nickname" value="{{ old('nickname') ? old('nickname') : $contact->nickname }}" class="form-control @error('nickname') is-invalid @enderror">
                    @error('nickname')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">

                @php
                    $contact_type = json_decode($contact->contact_type);
                    foreach ($contact_type as $key => $value) {
                        $selected_type[$key] = $value;
                    }
                @endphp

                <div class="form-group">
                    <label><span class="text-danger">*</span> Tipe Kontak</label>
                    <select name="contact_type[]" class="form-control  @error('contact_type') is-invalid @enderror" width="100%" multiple>
                        @foreach ($allOptionsType as $option)
                            <option value="{{ $option['id'] }}" {{ in_array($option['id'], old('contact_type',[]) ? old('contact_type',[]) : $selected_type) ? 'selected' : '' }}>
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
                    <input type="text" name="contact_name" value="{{ old('contact_name') ? old('contact_name') : $contact->contact_name }}" class="form-control @error('contact_name') is-invalid @enderror">
                    @error('contact_name')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>No Handphone</label>
                    <input type="text" name="handphone" value="{{ old('handphone') ? old('handphone') : $contact->handphone }}" class="form-control @error('handphone') is-invalid @enderror">
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
                                @else
                                <option value="{{ $contact->identity_type }}">{{ $contact->identity_type }}</option>
                                @endif
                            </select>
                        </div>
                        <div class="col-8 col-md-8">
                            <input type="text" name="identity_number"  value="{{ old('identity_number') ? old('identity_number') : $contact->identity_number }}" class="form-control @error('identity_number') is-invalid @enderror" placeholder="Nomor Identitas">
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
                    <input type="text" name="emails" data-role="tagsinput" value="{{ old('emails') ? old('emails') : $contact->emails }}" class="form-control  @error('emails') is-invalid @enderror">
                    @error('emails')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Info Lainnya</label>
            <input type="text" name="other_info" value="{{ old('other_info') ? old('other_info') : $contact->other_info }}" class="form-control @error('other_info') is-invalid @enderror">
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
                    <input type="text" name="company_name" value="{{ old('company_name') ? old('company_name') : $contact->company_name  }}" class="form-control @error('company_name') is-invalid @enderror">
                    @error('company_name')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Telepon</label>
                    <input type="text" name="telephone" value="{{ old('telephone') ? old('telephone') : $contact->telephone }}" class="form-control @error('telephone') is-invalid @enderror">
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
                    <input type="text" name="fax" value="{{ old('fax') ? old('fax') : $contact->fax }}" class="form-control @error('fax') is-invalid @enderror">
                    @error('fax')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>NPWP</label>
                    <input type="text" name="npwp" value="{{ old('npwp') ? old('npwp') : $contact->npwp }}" class="form-control @error('npwp') is-invalid @enderror">
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
                    <textarea name="payment_address" class="form-control @error('payment_address') is-invalid @enderror"  cols="30" >{{ old('payment_address') ? old('payment_address') : $contact->payment_address }}</textarea>
                    @error('payment_address')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Alamat Pengiriman</label>
                    <textarea name="shipping_address" class="form-control @error('shipping_address') is-invalid @enderror"  cols="30" >{{ old('shipping_address') ? old('shipping_address') : $contact->shipping_address }}</textarea>
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
                @foreach (json_decode($contact->account_bank) as $key => $item)
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
                    @php
                        $receivable_account = old('receivable_account') ? old('receivable_account') : $contact->receivable_account;
                        $value = $account_list->where('id', intval($receivable_account))->first();
                    @endphp
                    <select name="receivable_account" class="form-control @error('receivable_account') is-invalid @enderror">
                        @if( $receivable_account != NULL)
                            <option value="{{ $receivable_account }}">{{ $value->lists_code.' - '.$value->lists_name }}</option>
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
                    @php
                        $accounts_payable = old('accounts_payable') ? old('accounts_payable') : $contact->accounts_payable;
                        $value = $account_list->where('id', intval($accounts_payable))->first();
                    @endphp
                    <select name="accounts_payable" class="form-control @error('accounts_payable') is-invalid @enderror">
                        @if($accounts_payable != NULL)
                           @php
                               $value = $account_list->where('id', intval($accounts_payable))->first();
                           @endphp
                            <option value="{{ $accounts_payable }}">{{ $value->lists_code.' - '.$value->lists_name }}</option>
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
                            @php $receivable_checked = old('receivable_checked') ? old('receivable_checked') : $contact->receivable_checked; @endphp
                            <div class="custom-control custom-switch mt-2">
                                <input type="hidden" value="0" name="receivable_checked">
                                <input type="checkbox" name="receivable_checked" value="1" id="customSwitchCre" class="custom-control-input" @if( $receivable_checked == 1 ) checked @endif>
                                <label class="custom-control-label text-primary" for="customSwitchCre">Aktifkan Maksimal Piutang</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="credit_limit" placeholder="Maksimal Piutang" value="{{ old('credit_limit') ? old('credit_limit') : $contact->credit_limit }}" class="form-control @error('credit_limit') is-invalid @enderror" @if( $receivable_checked == 1 ) style="display:block" @else style="display:none" @endif>
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
