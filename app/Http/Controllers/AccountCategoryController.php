<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountCategoryRequest;
use App\Models\Account_category;
use App\Models\Account_sub_header;
use Illuminate\Http\Request;

class AccountCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $array = array(
            'title' => 'Pengaturan / Kategori Akun',
            'account_category' => Account_category::select('*')
                                        ->with('account_sub_header',function($join){
                                        $join->select('id','header_id','header_sub_name')
                                        ->with('account_header',function($join){
                                            $join->select('id','normal_balance','header_name');
                                        });
                                    })->orderBy('id','asc')->paginate(),
        );
        
        return view('Setting/Account_category/Index',$array);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $array = array(
            'title' => 'Pengaturan / Tambah Kategori Akun',
            'account_sub_header' => Account_sub_header::select('*')->with('account_header',function($join){
                $join->select('id','normal_balance','header_name');
            })->get(),
        );
        
        return view('Setting/Account_category/Create',$array);
    }

    public function lists_code(Request $request)
    {
        try {
            
            $id = $request->id;
            $check_header = Account_sub_header::where('id',$id)->first();
            $data = Account_category::selectRaw('count(category_code) as category_code')
                    ->where('sub_header_id',$id)->first();

            $noUrut    = (int)$data->category_code;
            $noUrut++;

            return json_encode(array(
                'last_code' => $check_header->sub_header_code.'.'.$noUrut,
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
    public function store(AccountCategoryRequest $accountCategoryRequest)
    {
        try {
            Account_category::create($accountCategoryRequest->validated());
            return redirect('setting/account_category')->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            return redirect('setting/account_category')->with('error', 'Data gagal disimpan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function recycle_bin()
    {
        $array = array(
            'title' => 'Pengaturan / Keranjang Sampah Kategori Akun',
            'account_category' => Account_category::select('*')
                            ->with('account_sub_header',function($join){
                            $join->select('id','header_id','header_sub_name')
                            ->with('account_header',function($join){
                                $join->select('id','normal_balance','header_name');
                            });
                        })->onlyTrashed()->orderBy('id','asc')->paginate(),
        );
        
        return view('Setting/Account_category/Recycle_bin',$array);
    }

    public function restore(Request $request)
    {

        try {
            if( $request->id == null ){
                return redirect('setting/account_category/recycle_bin');
            }
            else{
                if( $request->input('restore') === 'restore' ){
                    Account_category::whereIn('id',$request->id)->restore();
                    return redirect('setting/account_category')->with('success', 'Data berhasil dipulihkan');
                }
                elseif( $request->input('forever') === 'forever' ){
                    Account_category::whereIn('id',$request->id)->forcedelete();
                    return redirect('setting/account_category')->with('success', 'Data berhasil dihapus secara permanen');
                }
            }
        } catch (\Throwable $th) {
            return redirect('setting/account_category')->with('error', 'Data gagal diperbarui');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Account_category $account_category)
    {
        $array = array(
            'title' => 'Pengaturan / Edit Kategori Akun',
            'account_sub_header' => Account_sub_header::select('*')->with('account_header',function($join){
                $join->select('id','normal_balance','header_name');
            })->get(),
            'account_category' => $account_category,
        );
        
        return view('Setting/Account_category/Edit',$array);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AccountCategoryRequest $accountCategoryRequest, Account_category $account_category)
    {
        try {
            $account_category->update($accountCategoryRequest->validated());
            return redirect('setting/account_category')->with('success', 'Data berhasil diperbarui');
        } catch (\Throwable $th) {
            return redirect('setting/account_category')->with('error', 'Data gagal diperbarui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Account_category $account_category)
    {
        try {
            $account_category->delete();
            session()->flash('success','Data berhasil dihapus');
            return response()->json(array('status' => 1 ));
        } catch (\Throwable $th) {
            session()->flash('error','Data gagal dihapus');
            return response()->json(array('status' => 2 ));
        }
    }
}
