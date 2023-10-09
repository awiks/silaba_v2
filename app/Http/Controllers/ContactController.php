<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Account_list;
use App\Models\Bank_account;
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
                $name = now()->timestamp.".{$contactRequest->profile->getClientOriginalName()}";
                $path = $contactRequest->file('profile')->storeAs('profile', $name, 'public');
                $validate['profile'] = "/storage/{$path}";
            }

            $validate['contact_type'] = implode(',',$contactRequest->contact_type);
            $validate['emails'] = $contactRequest->emails;
            $validate['receivable_account'] = $contactRequest->receivable_account ? $contactRequest->receivable_account : 0;
            $validate['accounts_payable'] = $contactRequest->accounts_payable ? $contactRequest->accounts_payable : 0;
            $validate['credit_limit'] = $contactRequest->credit_limit ? $contactRequest->credit_limit : 0;
            $validate['payable_limit'] = $contactRequest->payable_limit ? $contactRequest->payable_limit : 0;

            $contactID = Contact::create($validate);
            foreach ( $contactRequest->bank_name as $key => $value) {
                if( $contactRequest->bank_name[$key] != null && $contactRequest->branch_office[$key] != null && $contactRequest->account_holder[$key] != null && $contactRequest->account_number[$key] != null )
                {
                    $array_bank = array(
                        'contact_id' =>$contactID->id,
                        'bank_name' => $contactRequest->bank_name[$key],
                        'branch_office' => $contactRequest->branch_office[$key],
                        'account_holder' => $contactRequest->account_holder[$key],
                        'account_number' => $contactRequest->account_number[$key],
                    );
                    
                    Bank_account::insert($array_bank);
                }
            }

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        //
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
        //
    }
}
