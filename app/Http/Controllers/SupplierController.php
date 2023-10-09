<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierRequest;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $array = array(
            'title' => 'Supplier',
        );
        
        return view('Supplier/Index',$array);
    }

    public function ajax(Request $request)
    {
        if ($request->ajax()) {
            $data = Supplier::query();
            return DataTables::of($data)
                        ->addColumn('create',function($rows){
                            return date('d/m/Y H:i',strtotime($rows->updated_at));
                        })
                        ->addColumn('action', function($row){
                            return '<a href="'.url("/supplier/{$row->id}/edit").'" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                    <a href="#" id="'.$row->id.'" class="btn btn-danger shadow btn-xs sharp delete"><i class="far fa-trash-alt"></i></a>';
                        })
                        ->rawColumns(['action'])//FOR READ HTML
                        ->toJson();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $array = array(
            'title' => 'Tambah Supplier',
        );
        
        return view('Supplier/Create',$array);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SupplierRequest $supplierRequest)
    {
        try {
            Supplier::create($supplierRequest->validated());
            return redirect('/supplier')->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            return redirect('/supplier')->with('error', 'Data gagal disimpan');
        }
    }

    /**
     * Display the specified resource.
     */
    // public function show(Supplier $supplier)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        $array = array(
            'title' => 'Edit Supplier',
            'supplier' => $supplier,
        );
        
        return view('Supplier/Edit',$array);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SupplierRequest $supplierRequest, Supplier $supplier)
    {
        try {
            $supplier->update($supplierRequest->validated());
            return redirect('/supplier')->with('success', 'Data berhasil diperbarui');
        } catch (\Throwable $th) {
            return redirect('/supplier')->with('error', 'Data gagal diperbarui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        try {
            $supplier->delete();
            session()->flash('success','Data berhasil dihapus');
            return response()->json(array('status' => 1 ));
        } catch (\Throwable $th) {
            session()->flash('error','Data gagal dihapus');
            return response()->json(array('status' => 2 ));
        }
    }
}
