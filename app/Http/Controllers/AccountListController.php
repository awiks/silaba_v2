<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountListRequest;
use App\Models\Account_category;
use App\Models\Account_list;
use Illuminate\Http\Request;

class AccountListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $array = array(
            'title' => 'Pengaturan / Daftar Akun',
            'account_list' => Account_list::select('*')->with('account_category',function($join){
                                $join->select('id','sub_header_id','categories_name')
                                ->with('account_sub_header',function($join){
                                    $join->select('id','header_id','header_sub_name')->with('account_header',function($join){
                                        $join->select('id','header_code','normal_balance','header_name');
                                });
                            });
                            })->orderBy('id','asc')->paginate(),
        );
        
        return view('Setting/Account_list/Index',$array);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $array = array(
            'title' => 'Pengaturan / Tambah Daftar Akun',
            'account_category' => Account_category::select('*')
                                    ->with('account_sub_header',function($join){
                                        $join->select('id','header_id','header_sub_name')
                                        ->with('account_header',function($join){
                                            $join->select('id','normal_balance','header_name');
                                        });
                                    })->get(),
        );
        
        return view('Setting/Account_list/Create',$array);
    }

    public function lists_code(Request $request)
    {
        try {
            
            $id = $request->id;
            $check_header = Account_category::where('id',$id)->first();
            $data = Account_list::selectRaw('count(lists_code) as lists_code')
                    ->where('category_id',$id)->first();

            $noUrut    = (int)$data->lists_code;
            $noUrut++;

            return json_encode(array(
                'last_code' => $check_header->category_code.'.'.$noUrut,
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
    public function store(AccountListRequest $accountListRequest)
    {
        try {
            Account_list::create($accountListRequest->validated());
            return redirect('setting/account_list')->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            return redirect('setting/account_list')->with('error', 'Data gagal disimpan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function recycle_bin()
    {
        $array = array(
            'title' => 'Pengaturan / Keranjang Sampah Daftar Akun',
            'account_list' => Account_list::select('*')->with('account_category',function($join){
                                        $join->select('id','sub_header_id','categories_name')
                                        ->with('account_sub_header',function($join){
                                            $join->select('id','header_id','header_sub_name')->with('account_header',function($join){
                                                $join->select('id','header_code','normal_balance','header_name');
                                        });
                                    });
                                    })->onlyTrashed()->orderBy('id','asc')->paginate(),
        );
        
        return view('Setting/Account_list/Recycle_bin',$array);
    }

    public function restore(Request $request)
    {

        try {
            if( $request->id == null ){
                return redirect('setting/account_list/recycle_bin');
            }
            else{
                if( $request->input('restore') === 'restore' ){
                    Account_list::whereIn('id',$request->id)->restore();
                    return redirect('setting/account_list')->with('success', 'Data berhasil dipulihkan');
                }
                elseif( $request->input('forever') === 'forever' ){
                    Account_list::whereIn('id',$request->id)->forcedelete();
                    return redirect('setting/account_list')->with('success', 'Data berhasil dihapus secara permanen');
                }
            }
        } catch (\Throwable $th) {
            return redirect('setting/account_list')->with('error', 'Data gagal diperbarui');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Account_list $account_list)
    {
        $array = array(
            'title' => 'Pengaturan / Edit Daftar Akun',
            'account_category' => Account_category::select('*')
                                    ->with('account_sub_header',function($join){
                                        $join->select('id','header_id','header_sub_name')
                                        ->with('account_header',function($join){
                                            $join->select('id','normal_balance','header_name');
                                        });
                                    })->get(),
            'account_list' => $account_list,
        );
        
        return view('Setting/Account_list/Edit',$array);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AccountListRequest $accountListRequest, Account_list $account_list)
    {
        try {
            $account_list->update($accountListRequest->validated());
            return redirect('setting/account_list')->with('success', 'Data berhasil diperbarui');
        } catch (\Throwable $th) {
            return redirect('setting/account_list')->with('error', 'Data gagal diperbarui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Account_list $account_list)
    {
        try {
            $account_list->delete();
            session()->flash('success','Data berhasil dihapus');
            return response()->json(array('status' => 1 ));
        } catch (\Throwable $th) {
            session()->flash('error','Data gagal dihapus');
            return response()->json(array('status' => 2 ));
        }
    }
}
