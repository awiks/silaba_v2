<?php

namespace App\Http\Controllers;

use App\Http\Requests\BicycleRequest;
use App\Http\Requests\CustomerRequest;
use App\Models\Bicycle;
use App\Models\Customer;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $array = array(
            'title' => 'Pelanggan',
        );
        
        return view('Customer/Index',$array);
    }

    public function ajax(Request $request)
    {
        if ($request->ajax()) {
            $data = Customer::query();
            return DataTables::of($data)
                        ->addColumn('create',function($rows){
                            return date('d/m/Y H:i',strtotime($rows->updated_at));
                        })
                        ->addColumn('nama', function($row){
                            return '<a href="'.url("/customer/{$row->id}").'/edit">'.$row->name.'</a>';
                        })
                        ->addColumn('action', function($row){
                            return '<a href="'.url("/customer/{$row->id}").'" class="btn bg-yellow btn-xs"><i class="fas fa-eye"></i> Detail</a>';
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
            'title' => 'Tambah Pelanggan',
        );
        
        return view('Customer/Create',$array);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerRequest $customerRequest)
    {
        try {
            $customer = Customer::create($customerRequest->validated());
            return redirect('/customer/bicycle/'.$customer->id.'/create')->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            return redirect('/customer')->with('error', 'Data gagal disimpan');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        $array = array(
            'title' => 'Edit Pelanggan',
            'customer' => $customer,
        );
        
        return view('Customer/Edit',$array);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerRequest $customerRequest, Customer $customer)
    {
        try {
            $customer->update($customerRequest->validated());
            return redirect('/customer/'.$customer->id.'')->with('success', 'Data berhasil diperbarui');
        } catch (\Throwable $th) {
            return redirect('/customer/'.$customer->id.'')->with('error', 'Data gagal diperbarui');
        }
    }

    public function show(Customer $customer)
    {
        $array = array(
            'title' => 'Detail Pelanggan',
            'customer' => $customer,
            'bicycle' => Bicycle::where('customer_id',$customer->id)->get(),
        );
        
        return view('Customer/Show',$array);
    }

    public function add(Customer $customer)
    {
        $array = array(
            'title' => 'Tambah Kendaraan',
            'customer' => $customer,
        );
        
        return view('Customer/Add',$array);
    }

    public function save(BicycleRequest $bicycleRequest)
    {
        try {
            Bicycle::create($bicycleRequest->validated());
            return redirect('/customer/'.$bicycleRequest->customer_id.'')->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            return redirect('/customer/'.$bicycleRequest->customer_id.'')->with('error', 'Data gagal disimpan');
        }
    }

    public function ubah(Bicycle $bicycle)
    {
        $array = array(
            'title' => 'Edit Kendaraan',
            'bicycle' => $bicycle->select('*')->with('customer',function($join){
                            $join->select('*');
                        })->where('id',$bicycle->id)->first(),
        );
        
        return view('Customer/Ubah',$array);
    }

    public function perbarui(BicycleRequest $bicycleRequest, Bicycle $bicycle)
    {
        try {
            $bicycle->update($bicycleRequest->validated());
            return redirect('/customer/'.$bicycle->customer_id.'')->with('success', 'Data berhasil diperbarui');
        } catch (\Throwable $th) {
            return redirect('/customer/'.$bicycle->customer_id.'')->with('error', 'Data gagal diperbarui');
        }
    }

     /**
     * Remove the specified resource from storage.
     */
    public function hapus(Bicycle $bicycle)
    {    
        try {
            $bicycle->delete();
            session()->flash('success','Data berhasil dihapus');
        } catch (\Throwable $th) {
            session()->flash('error','Data gagal dihapus');
        }    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {   
        try {
            $customer->delete();
            Bicycle::where('customer_id',$customer->id)->delete();
            session()->flash('success','Data berhasil dihapus');
            return response()->json(array('status' => 1 ));
        } catch (\Throwable $th) {
            session()->flash('error','Data gagal dihapus');
            return response()->json(array('status' => 2 ));
        }
    }
}
