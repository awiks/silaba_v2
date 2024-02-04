<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $array = array(
            'title' => 'Pengaturan / Perusahaan',
            'company' => Company::where('id','1')->first(),
        );
        
        return view('Setting/Company/Index',$array);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        $array = array(
            'title' => 'Pengaturan / Edit Perusahaan',
            'company' => $company,
        );
        
        return view('Setting/Company/Edit',$array);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyRequest $companyRequest, Company $company)
    {
        try {
            $validate = $companyRequest->validated();
            if ($companyRequest->hasFile('logo')) {

                $company->logo != null ? unlink(storage_path($company->logo)) : '';

                $fileInfo = $companyRequest->logo->getClientOriginalName();
                $extension = pathinfo($fileInfo, PATHINFO_EXTENSION);
                $file_name= uniqid().'_'.date('Ymd').'_'.time().'.'.$extension;
                $companyRequest->logo->move(storage_path('app/public/logo/'),$file_name);
                $validate['logo'] = '/storage/logo/'.$file_name.'';
            }

            $validate['show_logo'] = $companyRequest->show_logo;
            $validate['company_name'] = strip_tags($companyRequest->company_name);
            $validate['address'] = strip_tags($companyRequest->address);
            $validate['shipping_address'] = strip_tags($companyRequest->shipping_address);
            $validate['telephone'] = strip_tags($companyRequest->telephone);
            $validate['fax'] = strip_tags($companyRequest->fax);
            $validate['npwp'] = strip_tags($companyRequest->npwp);
            $validate['website'] = strip_tags($companyRequest->website);
            $validate['email'] = strip_tags($companyRequest->email);

            $array_bank = array();
            foreach ( $companyRequest->bank_name as $key => $value) {
                $array_bank[] = array(
                    'bank_name' => strip_tags($companyRequest->bank_name[$key]),
                    'branch_office' => strip_tags($companyRequest->branch_office[$key]),
                    'account_holder' => strip_tags($companyRequest->account_holder[$key]),
                    'account_number' => strip_tags($companyRequest->account_number[$key]),
                );
            }

            $validate['account_bank'] = json_encode($array_bank);

            $company->update($validate);
            return redirect('setting/company')->with('success', 'Data berhasil diperbarui');

        } catch (\Throwable $th) {
            return redirect('setting/company')->with('error', 'Data gagal diperbarui');
        }
    }

}
