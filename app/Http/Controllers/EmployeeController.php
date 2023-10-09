<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use DateTime;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $array = array(
            'title' => 'Pegawai',
        );
        
        return view('Employee/Index',$array);
    }

    public function ajax(Request $request)
    {
        if ($request->ajax()) {
            $data = Employee::query();
            return DataTables::of($data)
                                ->editColumn('create',function($rows){
                                    return date('d/m/Y H:i',strtotime($rows->updated_at));
                                })
                                ->editColumn('birth',function($rows){
                                    return date('d/m/Y',strtotime($rows->birtday));
                                })
                                ->editColumn('age',function($rows){

                                    $birthday = $rows->birtday;
                                    $biday    = new DateTime($birthday);
                                    $today    = new DateTime();
                                    $diff     = $today->diff($biday);
                                    $umur = $diff->y;

                                    return $umur;
                                })
                                ->addColumn('status', function($row){
                                    return $row->status == 1 ? '<span class="badge badge-success">Aktif</span>' : '<span class="badge badge-danger">Non Aktif</span>';
                                })
                                ->addColumn('action', function($row){
                                    return '<div class="dropdown">
                                                <button type="button" class="btn btn-primary light sharp" data-toggle="dropdown" aria-expanded="false">
                                                    <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
                                                </button>
                                                <div class="dropdown-menu" style="">
                                                    <a class="dropdown-item" href="'.url("/employee/{$row->id}/edit").'">Edit</a>
                                                    <a class="dropdown-item delete" id="'.$row->id.'" href="#">Hapus</a>
                                                </div>
                                            </div>';
                                })
                                ->rawColumns(['status','action']) //FOR READ HTML
                                ->toJson();
                                
            }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $array = array(
            'title' => 'Tambah Pegawai',
        );
        
        return view('Employee/Create',$array);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $employeeRequest)
    {
        if( Employee::create($employeeRequest->validated()) ){
            return redirect('/employee')->with('success', 'Data berhasil disimpan');
        }
        else{
            return redirect('/employee')->with('error', 'Data gagal disimpan');
        }
    }

    /**
     * Display the specified resource.
     */
    // public function show(Employee $employee)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $array = array(
            'title' => 'Edit Pegawai',
            'employee' => $employee,
        );
        
        return view('Employee/Edit',$array);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $employeeRequest, Employee $employee)
    {
        if( $employee->update($employeeRequest->validated()) ){
            return redirect('/employee')->with('success', 'Data berhasil diperbarui');
        }
        else{
            return redirect('/employee')->with('error', 'Data gagal diperbarui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        if( $employee->delete() ){
            session()->flash('success','Data berhasil dihapus');
            return response()->json(array('status' => 1 ));
        }
        else{
            session()->flash('error','Data gagal dihapus');
            return response()->json(array('status' => 2 ));
        }
    }
}
