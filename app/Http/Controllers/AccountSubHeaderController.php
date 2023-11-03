<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountSubHeaderRequest;
use App\Models\Account_header;
use App\Models\Account_sub_header;
use Illuminate\Http\Request;

class AccountSubHeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $array = array(
            'title' => 'Pengaturan / Sub Header',
            'account_sub_header' => Account_sub_header::select('*')
            ->with('account_header',function($join){
                $join->select('id','header_code','normal_balance','header_name');
           })->orderBy('id','asc')->paginate(),
        );
        
        return view('Setting/Account_sub_header/Index',$array);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $array = array(
            'title' => 'Pengaturan / Tambah Sub Header',
            'account_header' => Account_header::get(),
        );
        
        return view('Setting/Account_sub_header/Create',$array);
    }

    public function lists_code(Request $request)
    {
        try {
            
            $id = $request->id;
            $check_header = Account_header::where('id',$id)->first();
            $data = Account_sub_header::selectRaw('count(sub_header_code) as sub_header_code')
                    ->where('header_id',$id)->first();

            $noUrut    = (int)$data->sub_header_code;
            $noUrut++;

            return json_encode(array(
                'last_code' => $check_header->header_code.'.'.$noUrut,
            ));

        } catch (\Throwable $th) {
            return json_encode(array(
                'message' => 'Error harap coba lagi.',
            ));
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(AccountSubHeaderRequest $accountSubHeaderRequest)
    {
        try {
            Account_sub_header::create($accountSubHeaderRequest->validated());
            return redirect('setting/account_sub_header')->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            return redirect('setting/account_sub_header')->with('error', 'Data gagal disimpan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function recycle_bin()
    {
        $array = array(
            'title' => 'Pengaturan / Keranjang Sampah Sub Header',
            'account_sub_header' => Account_sub_header::onlyTrashed()->orderBy('id','asc')->paginate(),
        );
        
        return view('Setting/Account_sub_header/Recycle_bin',$array);
    }

    public function restore(Request $request)
    {

        try {
            if( $request->id == null ){
                return redirect('setting/account_sub_header/recycle_bin');
            }
            else{
                if( $request->input('restore') === 'restore' ){
                    Account_sub_header::whereIn('id',$request->id)->restore();
                    return redirect('setting/account_sub_header')->with('success', 'Data berhasil dipulihkan');
                }
                elseif( $request->input('forever') === 'forever' ){
                    Account_sub_header::whereIn('id',$request->id)->forcedelete();
                    return redirect('setting/account_sub_header')->with('success', 'Data berhasil dihapus secara permanen');
                }
            }
        } catch (\Throwable $th) {
            return redirect('setting/account_sub_header')->with('error', 'Data gagal diperbarui');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Account_sub_header $account_sub_header)
    {
        $array = array(
            'title' => 'Pengaturan / Edit Sub Header',
            'account_header' => Account_header::get(),
            'account_sub_header' => $account_sub_header,
        );
        
        return view('Setting/Account_sub_header/Edit',$array);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AccountSubHeaderRequest $accountSubHeaderRequest, Account_sub_header $account_sub_header)
    {
        try {
            $account_sub_header->update($accountSubHeaderRequest->validated());
            return redirect('setting/account_sub_header')->with('success', 'Data berhasil diperbarui');
        } catch (\Throwable $th) {
            return redirect('setting/account_sub_header')->with('error', 'Data gagal diperbarui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Account_sub_header $account_sub_header)
    {
        try {
            $account_sub_header->delete();
            session()->flash('success','Data berhasil dihapus');
            return response()->json(array('status' => 1 ));
        } catch (\Throwable $th) {
            session()->flash('error','Data gagal dihapus');
            return response()->json(array('status' => 2 ));
        }
    }
}
