<?php

namespace App\Http\Controllers;

use App\Http\Requests\UnitRequest;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $array = array(
            'title' => 'Pengaturan / Satuan',
            'unit' => Unit::orderBy('id','asc')->paginate(),
        );
        
        return view('Setting/Unit/Index',$array);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $array = array(
            'title' => 'Pengaturan / Tambah Satuan',
        );
        
        return view('Setting/Unit/Create',$array);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UnitRequest $unitRequest)
    {
        try {
            Unit::create($unitRequest->validated());
            return redirect('setting/unit')->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            return redirect('setting/unit')->with('error', 'Data gagal disimpan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function recycle_bin()
    {
        $array = array(
            'title' => 'Pengaturan / Keranjang Sampah Satuan',
            'unit' => Unit::onlyTrashed()->orderBy('id','asc')->get(),
        );
        
        return view('Setting/Unit/Recycle_bin',$array);
    }

    public function restore(Request $request)
    {
        try {
            if( $request->id == null ){
                return redirect('setting/unit/recycle_bin');
            }
            else{
                if( $request->input('restore') === 'restore' ){
                    Unit::whereIn('id',$request->id)->restore();
                    return redirect('setting/unit')->with('success', 'Data berhasil diperbarui');
                }
                elseif( $request->input('forever') === 'forever' ){
                    Unit::whereIn('id',$request->id)->forcedelete();
                    return redirect('setting/unit')->with('success', 'Data berhasil diperbarui');
                }
            }
        } catch (\Throwable $th) {
            return redirect('setting/unit')->with('error', 'Data gagal diperbarui');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unit $unit)
    {
        $array = array(
            'title' => 'Pengaturan / Edit Unit',
            'unit' => $unit,
        );
        
        return view('Setting/Unit/Edit',$array);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UnitRequest $unitRequest, Unit $unit)
    {
        try {
            $unit->update($unitRequest->validated());
            return redirect('setting/unit')->with('success', 'Data berhasil diperbarui');
        } catch (\Throwable $th) {
            return redirect('setting/unit')->with('error', 'Data gagal diperbarui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit)
    {
        try {
            $unit->delete();
            session()->flash('success','Data berhasil dihapus');
            return response()->json(array('status' => 1 ));
        } catch (\Throwable $th) {
            session()->flash('error','Data gagal dihapus');
            return response()->json(array('status' => 2 ));
        }
    }
}
