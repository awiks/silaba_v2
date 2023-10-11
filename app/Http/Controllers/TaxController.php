<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaxRequest;
use App\Models\Tax;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $array = array(
            'title' => 'Pengaturan / Pajak',
            'tax' => Tax::orderBy('id','asc')->get(),
        );
        
        return view('Setting/Tax/Index',$array);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $array = array(
            'title' => 'Pengaturan / Tambah Pajak',
        );
        
        return view('Setting/Tax/Create',$array);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaxRequest $taxRequest)
    {
        try {
            Tax::create($taxRequest->validated());
            return redirect('setting/tax')->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            return redirect('setting/tax')->with('error', 'Data gagal disimpan');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tax $tax)
    {
        $array = array(
            'title' => 'Pengaturan / Edit Pajak',
            'tax' => $tax,
        );
        
        return view('Setting/Tax/Edit',$array);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaxRequest $taxRequest, Tax $tax)
    {
        try {
            $tax->update($taxRequest->validated());
            return redirect('setting/tax')->with('success', 'Data berhasil diperbarui');
        } catch (\Throwable $th) {
            return redirect('setting/tax')->with('error', 'Data gagal diperbarui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tax $tax)
    {
        try {
            $tax->delete();
            session()->flash('success','Data berhasil dihapus');
            return response()->json(array('status' => 1 ));
        } catch (\Throwable $th) {
            session()->flash('error','Data gagal dihapus');
            return response()->json(array('status' => 2 ));
        }
    }


    /**
     * Display the specified resource.
     */
    public function recycle_bin()
    {
        $array = array(
            'title' => 'Pengaturan / Keranjang Sampah Pajak',
            'tax' => Tax::onlyTrashed()->orderBy('id','asc')->get(),
        );
        
        return view('Setting/Tax/Recycle_bin',$array);
    }

    public function restore(Request $request)
    {
        try {
            if( $request->id == null ){
                return redirect('setting/tax/recycle_bin');
            }
            else{
                if( $request->input('restore') === 'restore' ){
                    Tax::whereIn('id',$request->id)->restore();
                    return redirect('setting/tax')->with('success', 'Data berhasil diperbarui');
                }
                elseif( $request->input('forever') === 'forever' ){
                    Tax::whereIn('id',$request->id)->forcedelete();
                    return redirect('setting/tax')->with('success', 'Data berhasil diperbarui');
                }
            }
        } catch (\Throwable $th) {
            return redirect('setting/tax')->with('error', 'Data gagal diperbarui');
        }
    }
}
