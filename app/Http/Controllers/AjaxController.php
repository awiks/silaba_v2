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

        $brands = Brand::where('name_brand', 'LIKE', "%$term%")->limit(10)->get();

        $formatted_brands = [];

        foreach ($brands as $brand) {
            $formatted_brands[] = ['id' => $brand->id, 'text' => $brand->name_brand];
        }

        return response()->json($formatted_brands);
    }


    public function ajax_category(Request $request)
    {
        $term = trim($request->q);

        $categories = Category::where('category_name', 'LIKE', "%$term%")->limit(10)->get();

        $formatted_categories = [];

        foreach ($categories as $category) {
            $formatted_categories[] = ['id' => $category->id, 'text' => $category->category_name];
        }

        return response()->json($formatted_categories);
    }

    public function ajax_unit(Request $request)
    {
        $term = trim($request->q);

        $units = Unit::where('unit_name', 'LIKE', "%$term%")
        ->limit(10)->get();

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
                        })->orderBy('id','desc')->get();

            $array_item = array();
            foreach ($data as $item) {

                $unit_decode = json_decode($item->unit);
                $array_unit =  array_search('1',array_column($unit_decode,'unit_type'));
                $unit_ = $unit_decode[$array_unit];

                $unit = Unit::where('id',$unit_->unit_id)->first();

                $sell_price = $unit_->sell_price ? $unit_->sell_price : 0;
                $buy_price = $unit_->buy_price ? $unit_->buy_price : 0;
                $margin = $sell_price != 0 ? ($sell_price - $buy_price)  / $sell_price : 0;
                $percentase_margin = ceil($margin * 100);

                $array_item[] = array(
                    'image' => '<a href="'.$item->images.'" data-max-width="600" data-footer="'.$item->brand->name_brand.'" data-title="'.$item->item_name.'" data-toggle="lightbox"><img src="'.$item->images.'" class="w-50 rounded-circle"></a>',
                    'name' => '<a href="'.url("/item/{$item->id}").'">'.$item->item_name.'</a>',
                    'code_sku' => $item->code_sku,
                    'barcode' => $item->barcode ? $item->barcode : '-',
                    'item_name' => $item->item_name,
                    'category' => $item->category->category_name,
                    'brand' => $item->brand->name_brand,
                    'unit' =>$unit->unit_name,
                    'buy_price' =>'Rp. '.number_format($unit_->buy_price,0,',','.'),
                    'sell_price' =>'Rp. '.number_format($unit_->sell_price,0,',','.'),
                    'margin' => $percentase_margin ? $percentase_margin.'%' : 0,
                    'qty' => 0,
                    'created' =>date('d/m/Y H:i',strtotime($item->updated_at)),
                );
            }

            return DataTables::of($array_item)
                                ->rawColumns(['name','image'])//FOR READ HTML
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

                    $array_type=[];
                    foreach (json_decode($value->contact_type) as  $val) {
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
