<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use App\Http\Requests\UnitConversionRequest;
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

            $validate['buy_checked'] = $itemRequest->buy_checked;
            $validate['sell_cheked'] = $itemRequest->sell_cheked;
            $validate['inventory_checked'] = $itemRequest->inventory_checked;
            $validate['account_buy'] = $itemRequest->account_buy ? $itemRequest->account_buy : 0;
            $validate['tax_buy_id'] = $itemRequest->tax_buy_id ? $itemRequest->tax_buy_id : 0;
            $validate['account_sell'] = $itemRequest->account_sell ? $itemRequest->account_sell : 0;
            $validate['tax_sell_id'] = $itemRequest->tax_sell_id ? $itemRequest->tax_sell_id : 0;
            $validate['minimum_stock'] = $itemRequest->minimum_stock ? $itemRequest->minimum_stock : 0;
            $validate['account_inventory'] = $itemRequest->account_inventory ? $itemRequest->account_inventory : 0;
            

            $array_unit[] = array(
                'unit_id' => $itemRequest->unit_id,
                'amount' => 1,
                'buy_price' => $itemRequest->buy_price,
                'sell_price' => $itemRequest->sell_price,
                'unit_type' =>1
            );

            $validate['unit'] = json_encode($array_unit);

            Item::create($validate);
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
        $unit_decode = json_decode($item->unit);
        $unit_array = array();
        foreach ($unit_decode as $value) {
            $unit = Unit::where('id',$value->unit_id)->first();
            $unit_array[] = array(
                'id' => $value->unit_id,
                'unit_name' => $unit->unit_name,
                'amount' => $value->amount,
                'buy_price' => $value->buy_price,
                'sell_price' => $value->sell_price,
                'unit_type' => $value->unit_type == 1 ? 'Satuan Dasar' : 'Konversi',
            );
        }

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
            'unit' => $unit_array,
        );
        
        return view('Item/Show',$array);
    }

    public function unit_conversion(Item $item)
    {

        $unit_decode = json_decode($item->unit);
        $unit_array = array();
        foreach ($unit_decode as $value) {
            $unit = Unit::where('id',$value->unit_id)->first();
            $unit_array[] = array(
                'id' => $value->unit_id,
                'unit_name' => $unit->unit_name,
                'amount' => $value->amount,
                'buy_price' => $value->buy_price,
                'sell_price' => $value->sell_price,
                'unit_type' => $value->unit_type == 1 ? 'Satuan Dasar' : 'Konversi',
            );
        }

        
        $array = array(
            'title' => 'Konversi Satuan',
            'item' => $item,
            'unit' => $unit_array,
            'units' => Unit::get(),
        );
        
        return view('Item/Unit',$array);
    }

    public function unit(UnitConversionRequest $unitConversionRequest, Item $item)
    {
       try {

        $array_unit = array();
        foreach ($unitConversionRequest->unit_id as $key => $value) {
            $array_unit[] = array(
                'unit_id' => $unitConversionRequest->unit_id[$key],
                'amount' => $unitConversionRequest->amount[$key],
                'buy_price' => $unitConversionRequest->buy_price[$key],
                'sell_price' => $unitConversionRequest->sell_price[$key],
                'unit_type' => $key + 1 == 1 ? '1' : '2'
            );
        }

        $unit = json_encode($array_unit);
        $item->update(array('unit'=>$unit));
        return redirect('/item')->with('success', 'Data berhasil diperbarui');
       } catch (\Throwable $th) {
           return response()->json(array('status' => 2 ,'message' => 'Data gagal disimpan'));
       }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        $unit_decode = json_decode($item->unit);
        $array_unit =  array_search('1',array_column($unit_decode,'unit_type'));
        $unit_ = $unit_decode[$array_unit];

        $array = array(
            'title' => 'Edit Produk',
            'categories' => Category::get(),
            'brands' => Brand::get(),
            'units' => Unit::get(),
            'account_list' => Account_list::get(),
            'taxes' => Tax::get(),
            'item' => $item,
            'unit' => $unit_,
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

            $validate['buy_checked'] = $itemRequest->buy_checked;
            $validate['sell_cheked'] = $itemRequest->sell_cheked;
            $validate['inventory_checked'] = $itemRequest->inventory_checked;
            
            $validate['account_buy'] = $itemRequest->account_buy ? $itemRequest->account_buy : 0;
            $validate['tax_buy_id'] = $itemRequest->tax_buy_id ? $itemRequest->tax_buy_id : 0;
            $validate['account_sell'] = $itemRequest->account_sell ? $itemRequest->account_sell : 0;
            $validate['tax_sell_id'] = $itemRequest->tax_sell_id ? $itemRequest->tax_sell_id : 0;
            $validate['minimum_stock'] = $itemRequest->minimum_stock ? $itemRequest->minimum_stock : 0;
            $validate['account_inventory'] = $itemRequest->account_inventory ? $itemRequest->account_inventory : 0;
            
            $unit_decode = json_decode($item->unit);
            $unit_array = array();
            foreach ($unit_decode as $value) {
                if( $value->unit_id !=1 ){
                    $unit_array[] = $value;
                }
            }

            $array_unit[] = array(
                'unit_id' => $itemRequest->unit_id,
                'amount' => 1,
                'buy_price' => $itemRequest->buy_price,
                'sell_price' => $itemRequest->sell_price,
                'unit_type' =>1
            );

            $validate['unit'] = json_encode(array_merge($array_unit,$unit_array));
            $item->update($validate);

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
            session()->flash('success','Data berhasil dihapus');
            return response()->json(array('status' => 1 ));
        } catch (\Throwable $th) {
            session()->flash('error','Data gagal dihapus');
            return response()->json(array('status' => 2 ));
        }
    }

    public function modal_cat()
    {
        try {

            $array = array(
                'modal_title' => 'Tambah Kategori',
            );

            return view('Item/ModalCategory',$array);

        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function create_cat(Request $request)
    {
        try {
            $category = Category::where('category_name','=',$request->category_name)->first();
            if ( $category === null ) {
                $array = array(
                    'category_name' => strip_tags($request->category_name),
                );

                Category::create($array);

                return response()->json(array('class_name'=>'success','message'=>'Nama Kategori berhasil ditambahkan.'));
            }
            else{
                return response()->json(array('class_name'=>'info','message'=>'Nama Kategori yang anda masukan sudah ada!!'));
            }

        } catch (\Throwable $th) {
            return response()->json(array('class_name'=>'error','message'=>'Nama Kategori gagal ditambahkan.'));
        }
    }

    public function modal_brand()
    {
        try {

            $array = array(
                'modal_title' => 'Tambah Merek',
            );

            return view('Item/ModalBrand',$array);

        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function create_brand(Request $request)
    {
        try {
            $brand = Brand::where('name_brand','=',$request->name_brand)->first();
            if ( $brand === null ) {
                $array = array(
                    'name_brand' => strip_tags($request->name_brand),
                );

                Brand::create($array);

                return response()->json(array('class_name'=>'success','message'=>'Nama Merek berhasil ditambahkan.'));
            }
            else{
                return response()->json(array('class_name'=>'info','message'=>'Nama Merek yang anda masukan sudah ada!!'));
            }

        } catch (\Throwable $th) {
            return response()->json(array('class_name'=>'error','message'=>'Nama Merek gagal ditambahkan.'));
        }
    }

    public function modal_unit()
    {
        try {

            $array = array(
                'modal_title' => 'Tambah Satuan',
            );

            return view('Item/ModalUnit',$array);

        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function create_unit(Request $request)
    {
        try {
            $unit = Unit::where('unit_name','=',$request->unit_name)->first();
            if ( $unit === null ) {
                $array = array(
                    'unit_name' => strip_tags($request->unit_name),
                );

                Unit::create($array);

                return response()->json(array('class_name'=>'success','message'=>'Nama Satuan berhasil ditambahkan.'));
            }
            else{
                return response()->json(array('class_name'=>'info','message'=>'Nama Satuan yang anda masukan sudah ada!!'));
            }

        } catch (\Throwable $th) {
            return response()->json(array('class_name'=>'error','message'=>'Nama Satuan gagal ditambahkan.'));
        }
    }
}
