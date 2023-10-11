<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Account_list;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $array = array(
            'title' => 'Kontak',
        );
        
        return view('Contact/Index',$array);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $array = array(
            'title' => 'Tambah Kontak Baru',
            'allOptionsType' => [
                ['id' => 'Pelanggan','text'=>'Pelanggan'],
                ['id' => 'Supplier','text'=>'Supplier'],
                ['id' => 'Pegawai','text'=>'Pegawai'],
                ['id' => 'Lainnya','text'=>'Lainnya'],
            ],
            'account_list' => Account_list::get(),
        );
        
        return view('Contact/Create',$array);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContactRequest $contactRequest)
    {
        try {
            $validate = $contactRequest->validated();
            if ($contactRequest->hasFile('profile')) {
                $fileInfo = $contactRequest->profile->getClientOriginalName();
                $extension = pathinfo($fileInfo, PATHINFO_EXTENSION);
                $file_name= uniqid().'_'.date('Ymd').'_'.time().'.'.$extension;
                $contactRequest->profile->move(storage_path('app/public/profile/'),$file_name);
                $validate['profile'] = '/storage/profile/'.$file_name.'';
            }

            $contact_type = implode(',',$contactRequest->contact_type);

            $validate['nickname'] = strip_tags($contactRequest->nickname);
            $validate['contact_name'] = strip_tags($contactRequest->contact_name);
            $validate['handphone'] = strip_tags($contactRequest->handphone);
            $validate['identity_number'] = strip_tags($contactRequest->identity_number);
            $validate['other_info'] = strip_tags($contactRequest->other_info);
            $validate['company_name'] = strip_tags($contactRequest->company_name);
            $validate['telephone'] = strip_tags($contactRequest->telephone);
            $validate['fax'] = strip_tags($contactRequest->fax);
            $validate['npwp'] = strip_tags($contactRequest->npwp);
            $validate['payment_address'] = strip_tags($contactRequest->payment_address);
            $validate['shipping_address'] = strip_tags($contactRequest->shipping_address);

            $validate['contact_type'] = $contact_type;
            $validate['emails'] = $contactRequest->emails;
            $validate['receivable_account'] = $contactRequest->receivable_account ? $contactRequest->receivable_account : 0;
            $validate['accounts_payable'] = $contactRequest->accounts_payable ? $contactRequest->accounts_payable : 0;
            $validate['credit_limit'] = $contactRequest->credit_limit ? $contactRequest->credit_limit : 0;
            $validate['payable_limit'] = $contactRequest->payable_limit ? $contactRequest->payable_limit : 0;

            $array_bank = array();
            foreach ( $contactRequest->bank_name as $key => $value) {
                $array_bank[] = array(
                    'bank_name' => strip_tags($contactRequest->bank_name[$key]),
                    'branch_office' => strip_tags($contactRequest->branch_office[$key]),
                    'account_holder' => strip_tags($contactRequest->account_holder[$key]),
                    'account_number' => strip_tags($contactRequest->account_number[$key]),
                );
            }

            $validate['account_bank'] = json_encode($array_bank);

            Contact::create($validate);

           return redirect('/contact')->with('success', 'Data berhasil disimpan');

          } catch (\Throwable $th) {
              return redirect('/contact')->with('error', 'Data gagal disimpan');
          }
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        $array = array(
            'title' => 'Detail Kontak',
            'contact' => $contact,
        );

        return view('Contact/Show',$array);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        $array = array(
            'title' => 'Edit Kontak',
            'allOptionsType' => [
                ['id' => 'Pelanggan','text'=>'Pelanggan'],
                ['id' => 'Supplier','text'=>'Supplier'],
                ['id' => 'Pegawai','text'=>'Pegawai'],
                ['id' => 'Lainnya','text'=>'Lainnya'],
            ],
            'account_list' => Account_list::get(),
            'contact' => $contact,
        );

        return view('Contact/Edit',$array);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        try {
            $contact->delete();
            session()->flash('success','Data berhasil dihapus');
            return response()->json(array('status' => 1 ));
            
        } catch (\Throwable $th) {
            session()->flash('error','Data gagal dihapus');
            return response()->json(array('status' => 2 ));
        }
    }

    public function recycle_bin()
    {
        $array = array(
            'title' => 'Pengaturan / Keranjang Sampah Kontak',
            'contact' => Contact::onlyTrashed()->orderBy('id','asc')->get(),
        );
        
        return view('Contact/Recycle_bin',$array);
    }

    public function restore(Request $request)
    {
        try {
            if( $request->id == null ){
                return redirect('contact/recycle_bin');
            }
            else{
                if( $request->input('restore') === 'restore' ){
                    Contact::whereIn('id',$request->id)->restore();
                    return redirect('contact')->with('success', 'Data berhasil diperbarui');
                }
                elseif( $request->input('forever') === 'forever' ){

                    $contact = Contact::whereIn('id',$request->id)->onlyTrashed()->get();

                    foreach ($contact as $item ) {
                        $filename = $item->profile;
                        if( $filename != null ){
                            $path = public_path($filename);
                            if (file_exists($path)) {
                                unlink($path);
                            }
                        }
                    }

                    Contact::whereIn('id',$request->id)->forcedelete();

                     return redirect('contact')->with('success', 'Data berhasil diperbarui');
                 }
             }
         } catch (\Throwable $th) {
             return redirect('contact')->with('error', 'Data gagal diperbarui');
         }
    }
}
