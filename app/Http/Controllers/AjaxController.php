<?php

namespace App\Http\Controllers;

use App\Models\Account_list;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Item;
use App\Models\Tax;
use App\Models\Unit;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AjaxController extends Controller
{
    public function ajax_brand(Request $request)
    {
        $term = trim($request->q);

        $brands = Brand::where('name_brand', 'LIKE', "%$term%")->limit(5)->get();

        $formatted_brands = [];

        foreach ($brands as $brand) {
            $formatted_brands[] = ['id' => $brand->id, 'text' => $brand->name_brand];
        }

        return response()->json($formatted_brands);
    }


    public function ajax_category(Request $request)
    {
        $term = trim($request->q);

        $categories = Category::where('category_name', 'LIKE', "%$term%")->limit(5)->get();

        $formatted_categories = [];

        foreach ($categories as $category) {
            $formatted_categories[] = ['id' => $category->id, 'text' => $category->category_name];
        }

        return response()->json($formatted_categories);
    }

    public function ajax_unit(Request $request)
    {
        $term = trim($request->q);

        $units = Unit::where('unit_name', 'LIKE', "%$term%")->limit(5)->get();

        $formatted_units = [];

        foreach ($units as $unit) {
            $formatted_units[] = ['id' => $unit->id, 'text' => $unit->unit_name];
        }

        return response()->json($formatted_units);
    }

    public function ajax_account(Request $request)
    {
        $term = trim($request->q);

        $account_lists = Account_list::where('lists_name', 'LIKE', "%$term%")->limit(5)->get();

        $formatted_account_lists = [];

        foreach ($account_lists as $account_list) {
            $formatted_account_lists[] = ['id' => $account_list->id, 'text' => $account_list->lists_code.' - '.$account_list->lists_name];
        }

        return response()->json($formatted_account_lists);
    }


    public function ajax_tax(Request $request)
    {
        $term = trim($request->q);

        $taxes = Tax::where('tax_name', 'LIKE', "%$term%")->limit(5)->get();

        $formatted_taxes = [];

        foreach ($taxes as $tax) {
            $formatted_taxes[] = ['id' => $tax->id, 'text' => $tax->tax_name];
        }

        return response()->json($formatted_taxes);
    }


    public function ajax_product(Request $request)
    {
        if ($request->ajax()) {
            $data = Item::select('*')->with('brand',function($join){
                                    $join->select([
                                        'id',
                                        'name_brand'
                                    ]);
                                })->with('category',function($join){
                                    $join->select([
                                        'id',
                                        'category_name'
                                    ]);
                                })->with('unit_conversion',function($join){
                                    $join->select([
                                        'item_id',
                                        'unit_id',
                                        'buy_price'
                                    ])->with('unit',function($join){
                                        $join->select([
                                            'id',
                                            'unit_name'
                                        ]);
                                    })->where('unit_type',1);
                                })->orderBy('id','desc')->get();

            return DataTables::of($data)
                            ->addColumn('name',function($rows){
                                return '<a href="'.url("/item/{$rows->id}").'">'.$rows->item_name.'</a>';
                            })->addColumn('category',function($rows){
                                return $rows->category->category_name;
                            })->addColumn('brand',function($rows){
                                return $rows->brand->name_brand;
                            })->addColumn('buy_price',function($rows){
                                foreach ($rows->unit_conversion as $value) {
                                    return number_format($value->buy_price,0,',','.');
                                }
                            })->addColumn('unit_conversion',function($rows){
                                foreach ($rows->unit_conversion as $value) {
                                    return $value->unit->unit_name;
                                }
                            })
                            ->addColumn('create',function($rows){
                                return date('d/m/Y H:i',strtotime($rows->updated_at));
                            })
                            ->rawColumns(['name'])//FOR READ HTML
                            ->toJson();
        }
    }

    public function ajax_contact(Request $request)
    {
        if ($request->ajax()) {
            
            $filter = $request->filter;
            $array  = array('all','Pelanggan','Supplier','Pegawai','Lainnya');
            $check  = $filter == 'all' ? '' : $array[$filter];
            $terms = explode(',',$check);
            
            $data = Contact::where(function($query) use($terms) {
                        foreach($terms as $term) {
                            $query->orWhere('contact_type', 'like', "%$term%");
                        };
                    })->get();
                $array = array();
                foreach ($data as  $value) {
                    $explode_type =  explode(",",$value->contact_type);
                    $array_type=[];
                    foreach ($explode_type as  $val) {
                        $array_type[] = '<span class="badge badge-rounded badge-outline-info">'.$val.'</span>';
                    }

                    $array[] = array(
                        'name' => '<a href="'.url("/contact/{$value->id}").'">'.$value->nickname.'</a',
                        'type' => implode(' ', array_filter($array_type)),
                        'contact' => $value->contact_name,
                        'email' => $value->emails,
                        'phone' => $value->handphone,
                        'call' => $value->telephone,
                    );
                }

            return DataTables::of($array)->rawColumns(['name','type'])->toJson();
        }
    }

}
