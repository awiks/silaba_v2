<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $array = array(
            'title' => 'Pengaturan / Kategori',
            'category' => Category::orderBy('id','asc')->paginate(),
        );
        
        return view('Setting/Category/Index',$array);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $array = array(
            'title' => 'Pengaturan / Tambah Kategori',
        );
        
        return view('Setting/Category/Create',$array);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $categoryRequest)
    {
        try {
            Category::create($categoryRequest->validated());
            return redirect('setting/category')->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            return redirect('setting/category')->with('error', 'Data gagal disimpan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function recycle_bin()
    {
        $array = array(
            'title' => 'Pengaturan / Keranjang Sampah Kategori',
            'category' => Category::onlyTrashed()->orderBy('id','asc')->get(),
        );
        
        return view('Setting/Category/Recycle_bin',$array);
    }

    public function restore(Request $request)
    {
        try {
            if( $request->id == null ){
                return redirect('setting/category/recycle_bin');
            }
            else{
                if( $request->input('restore') === 'restore' ){
                    Category::whereIn('id',$request->id)->restore();
                    return redirect('setting/category')->with('success', 'Data berhasil diperbarui');
                }
                elseif( $request->input('forever') === 'forever' ){
                    Category::whereIn('id',$request->id)->forcedelete();
                    return redirect('setting/category')->with('success', 'Data berhasil diperbarui');
                }
            }
        } catch (\Throwable $th) {
            return redirect('setting/category')->with('error', 'Data gagal diperbarui');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $array = array(
            'title' => 'Pengaturan / Edit Kategori',
            'category' => $category,
        );
        
        return view('Setting/Category/Edit',$array);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $categoryRequest, Category $category)
    {
        try {
            $category->update($categoryRequest->validated());
            return redirect('setting/category')->with('success', 'Data berhasil diperbarui');
        } catch (\Throwable $th) {
            return redirect('setting/category')->with('error', 'Data gagal diperbarui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();
            session()->flash('success','Data berhasil dihapus');
            return response()->json(array('status' => 1 ));
        } catch (\Throwable $th) {
            session()->flash('error','Data gagal dihapus');
            return response()->json(array('status' => 2 ));
        }
    }
}
