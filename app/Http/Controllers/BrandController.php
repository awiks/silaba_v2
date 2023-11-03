<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $array = array(
            'title' => 'Pengaturan / Merek',
            'brand' => Brand::orderBy('id','asc')->paginate(),
        );
        
        return view('Setting/Brand/Index',$array);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $array = array(
            'title' => 'Pengaturan / Tambah Merek',
        );
        
        return view('Setting/Brand/Create',$array);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandRequest $brandRequest)
    {
        try {
            Brand::create($brandRequest->validated());
            return redirect('setting/brand')->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            return redirect('setting/brand')->with('error', 'Data gagal disimpan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function recycle_bin()
    {
        $array = array(
            'title' => 'Pengaturan / Keranjang Sampah Merek',
            'brand' => Brand::onlyTrashed()->orderBy('id','asc')->get(),
        );
        
        return view('Setting/Brand/Recycle_bin',$array);
    }

    public function restore(Request $request)
    {
        try {
            if( $request->id == null ){
                return redirect('setting/brand/recycle_bin');
            }
            else{
                if( $request->input('restore') === 'restore' ){
                    Brand::whereIn('id',$request->id)->restore();
                    return redirect('setting/brand')->with('success', 'Data berhasil dipulihkan');
                }
                elseif( $request->input('forever') === 'forever' ){
                    Brand::whereIn('id',$request->id)->forcedelete();
                    return redirect('setting/brand')->with('success', 'Data berhasil dihapus secara permanen');
                }
            }
        } catch (\Throwable $th) {
            return redirect('setting/brand')->with('error', 'Data gagal diperbarui');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        $array = array(
            'title' => 'Pengaturan / Edit Merek',
            'brand' => $brand,
        );
        
        return view('Setting/Brand/Edit',$array);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandRequest $brandRequest, Brand $brand)
    {
        try {
            $brand->update($brandRequest->validated());
            return redirect('setting/brand')->with('success', 'Data berhasil diperbarui');
        } catch (\Throwable $th) {
            return redirect('setting/brand')->with('error', 'Data gagal diperbarui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        try {
            $brand->delete();
            session()->flash('success','Data berhasil dihapus');
            return response()->json(array('status' => 1 ));
        } catch (\Throwable $th) {
            session()->flash('error','Data gagal dihapus');
            return response()->json(array('status' => 2 ));
        }
    }
}
