<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use App\Models\Account_list;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Item;
use App\Models\Tax;
use App\Models\Unit;
use App\Models\Unit_conversion;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $array = array(
            'title' => 'Produk',
        );
        
        return view('Item/Index',$array);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $last_id = Item::latest()->withTrashed()->first();

        $array = array(
            'title' => 'Tambah Produk',
            'categories' => Category::get(),
            'brands' => Brand::get(),
            'units' => Unit::get(),
            'account_list' => Account_list::get(),
            'taxes' => Tax::get(),
            'kode' => 'SKU-'.sprintf("%05d", $last_id->id + 1 )
        );
        
        return view('Item/Create',$array);

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemRequest $itemRequest)
    {  
        try {

            $validate = $itemRequest->validated();
            if ($itemRequest->hasFile('images')) {
                $name = now()->timestamp.".{$itemRequest->images->getClientOriginalName()}";
                $path = $itemRequest->file('images')->storeAs('images', $name, 'public');
                $validate['images'] = "/storage/{$path}";
            }

            $validate['account_buy'] = $itemRequest->account_buy ? $itemRequest->account_buy : 0;
            $validate['tax_buy_id'] = $itemRequest->tax_buy_id ? $itemRequest->tax_buy_id : 0;
            $validate['account_sell'] = $itemRequest->account_sell ? $itemRequest->account_sell : 0;
            $validate['tax_sell_id'] = $itemRequest->tax_sell_id ? $itemRequest->tax_sell_id : 0;
            $validate['minimum_stock'] = $itemRequest->minimum_stock ? $itemRequest->minimum_stock : 0;
            $validate['account_inventory'] = $itemRequest->account_inventory ? $itemRequest->account_inventory : 0;
            
            $itemID = Item::create($validate);
            Unit_conversion::create([
                'item_id' => $itemID->id,
                'unit_id' =>$itemRequest->unit_id,
                'amount' => '1',
                'unit_type' =>'1',
                'buy_price' => $itemRequest->buy_price ? $itemRequest->buy_price : 0,
                'sell_price' => $itemRequest->sell_price ? $itemRequest->sell_price : 0,
            ]);
            return redirect('/item')->with('success', 'Data berhasil disimpan');
         } catch (\Throwable $th) {
            return redirect('/item')->with('error', 'Data gagal disimpan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        $array = array(
            'title' => 'Detail Produk',
            'item' => $item->select('*')
                        ->with('category',function($join){
                            $join->select([
                                'id',
                                'category_name'
                            ]);
                    })->with('brand',function($join){
                        $join->select([
                            'id',
                            'name_brand'
                        ]);
                    })->where('id',$item->id)->first(),
            'unit' => Unit_conversion::select('*')
                            ->with('unit',function($join){
                                $join->select([
                                    'id',
                                    'unit_name'
                                ]);
                            })->where('item_id',$item->id)->orderBy('id','asc')->get(),
        );
        
        return view('Item/Show',$array);
    }

    public function unit_conversion(Item $item)
    {
        $array = array(
            'title' => 'Konversi Satuan',
            'item' => $item,
            'unit_conversions' => Unit_conversion::where('item_id',$item->id)->get(),
            'units' => Unit::get(),
        );
        
        return view('Item/Unit',$array);
    }

    public function unit(Request $request)
    {
       try {

        $item_id = $request->id;
        foreach ($request->unit_id as $key => $value) {
            $id = $request->input('conversion_id')[$key];
            $check = Unit_conversion::where('id',$id)->first();
            if( $check ){
                $array_update = array(
                    'unit_id' => $request->input('unit_id')[$key],
                    'amount' => $request->input('amount')[$key],
                    'buy_price' => $request->input('buy_price')[$key],
                    'updated_at' => date('Y-m-d H:i:s')
                );
                Unit_conversion::where('id',$id)->update($array_update);
            }else{
                $index = $key;
                $array_create = array(
                    'item_id' => $item_id,
                    'unit_id' => $request->input('unit_id')[$key],
                    'amount' => $request->input('amount')[$key],
                    'unit_type' => $index == 1 ? 1 : 2,
                    'buy_price' => $request->input('buy_price')[$key],
                    'sell_price' => $request->input('sell_price')[$key],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                );
                Unit_conversion::insert($array_create);
            }
        }
        
       session()->flash('success','Data berhasil disimpan');
       return response()->json(array('status' => 1 ));
        
       } catch (\Throwable $th) {
           return response()->json(array('status' => 2 ,'message' => 'Data gagal disimpan'));
       }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        $array = array(
            'title' => 'Edit Produk',
            'categories' => Category::get(),
            'brands' => Brand::get(),
            'units' => Unit::get(),
            'account_list' => Account_list::get(),
            'taxes' => Tax::get(),
            'item' => $item,
            'unitCheck' => Unit_conversion::select('*')->with('unit',function($join){
                $join->select(['id','unit_name']);
            })->where('unit_type','1')->where('item_id',$item->id)->first(),
        );
        
        return view('Item/Edit',$array);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItemRequest $itemRequest, Item $item)
    {
       
       try {
            $validate = $itemRequest->validated();
            if ($itemRequest->hasFile('images')) {
                $item->images != null ? unlink(public_path($item->images)) : '';
                $name = now()->timestamp.".{$itemRequest->images->getClientOriginalName()}";
                $path = $itemRequest->file('images')->storeAs('images', $name, 'public');
                $validate['images'] = "/storage/{$path}";
            }

            $validate['account_buy'] = $itemRequest->account_buy ? $itemRequest->account_buy : 0;
            $validate['tax_buy_id'] = $itemRequest->tax_buy_id ? $itemRequest->tax_buy_id : 0;
            $validate['account_sell'] = $itemRequest->account_sell ? $itemRequest->account_sell : 0;
            $validate['tax_sell_id'] = $itemRequest->tax_sell_id ? $itemRequest->tax_sell_id : 0;
            $validate['minimum_stock'] = $itemRequest->minimum_stock ? $itemRequest->minimum_stock : 0;
            $validate['account_inventory'] = $itemRequest->account_inventory ? $itemRequest->account_inventory : 0;
            
            $item->update($validate);
            Unit_conversion::where([
                'item_id' => $item->id,
                'unit_type' =>'1',
            ])->update([
                'unit_id' => $itemRequest->unit_id,
                'buy_price' => $itemRequest->buy_price,
                'sell_price' => $itemRequest->sell_price,
            ]);
            return redirect('/item')->with('success', 'Data berhasil diperbarui');
         } catch (\Throwable $th) {
             return redirect('/item')->with('error', 'Data gagal diperbarui');
         }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        try {
            $item->images != null ? unlink(public_path($item->images)) : '';
            $item->delete();
            Unit_conversion::where('item_id',$item->id)->delete();
            session()->flash('success','Data berhasil dihapus');
            return response()->json(array('status' => 1 ));
        } catch (\Throwable $th) {
            session()->flash('error','Data gagal dihapus');
            return response()->json(array('status' => 2 ));
        }
    }
}
