<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountHeaderRequest;
use App\Models\Account_header;
use Illuminate\Http\Request;

class AccountHeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $array = array(
            'title' => 'Pengaturan / Header',
            'account_header' => Account_header::orderBy('id','asc')->paginate(),
        );
        
        return view('Setting/Account_header/Index',$array);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $array = array(
            'title' => 'Pengaturan / Tambah Header',
        );
        
        return view('Setting/Account_header/Create',$array);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AccountHeaderRequest $accountHeaderRequest)
    {
        try {
            Account_header::create($accountHeaderRequest->validated());
            return redirect('setting/account_header')->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            return redirect('setting/account_header')->with('error', 'Data gagal disimpan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function recycle_bin()
    {
        $array = array(
            'title' => 'Pengaturan / Keranjang Sampah Header',
            'account_header' => Account_header::onlyTrashed()->orderBy('id','asc')->paginate(),
        );
        
        return view('Setting/Account_header/Recycle_bin',$array);
    }

    public function restore(Request $request)
    {

        try {
            if( $request->id == null ){
                return redirect('setting/Account_header/recycle_bin');
            }
            else{
                if( $request->input('restore') === 'restore' ){
                    Account_header::whereIn('id',$request->id)->restore();
                    return redirect('setting/account_header')->with('success', 'Data berhasil diperbarui');
                }
                elseif( $request->input('forever') === 'forever' ){
                    Account_header::whereIn('id',$request->id)->forcedelete();
                    return redirect('setting/account_header')->with('success', 'Data berhasil diperbarui');
                }
            }
        } catch (\Throwable $th) {
            return redirect('setting/account_header')->with('error', 'Data gagal diperbarui');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Account_header $account_header)
    {
        $array = array(
            'title' => 'Pengaturan / Edit Header',
            'account_header' => $account_header,
        );
        
        return view('Setting/Account_header/Edit',$array);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AccountHeaderRequest $accountHeaderRequest, Account_header $account_header)
    {
        try {
            $account_header->update($accountHeaderRequest->validated());
            return redirect('setting/account_header')->with('success', 'Data berhasil diperbarui');
        } catch (\Throwable $th) {
            return redirect('setting/account_header')->with('error', 'Data gagal diperbarui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Account_header $account_header)
    {
        try {
            $account_header->delete();
            session()->flash('success','Data berhasil dihapus');
            return response()->json(array('status' => 1 ));
        } catch (\Throwable $th) {
            session()->flash('error','Data gagal dihapus');
            return response()->json(array('status' => 2 ));
        }
    }
}
