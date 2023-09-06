<?php

namespace App\Http\Controllers;

use App\Models\item;
use App\Models\products;
use App\Models\products_item;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Array_;
use PhpParser\Node\Expr\Cast\Object_;
use Yajra\DataTables\Facades\DataTables;

class productsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
   return view('Admin.products',['items'=>item::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */

    public function getRecipe($id)
    {
$product=products::Where('id',$id)->first();
$data=$product->items;
$arr= Array();
foreach ($data as $d)
{
$temp=['percent'=> $d->percent * $d->products->quantity,'name'=>$d->items->name];
array_push($arr,$temp);
}
return view('Admin.showRecipe',['data'=>$arr]);

    }
    public function getdata()
    {
        $items = products::all();
        return Datatables::of($items)
            ->addIndexColumn()

            ->addColumn('action', function($row){

                $btn = '<div class="mt-1 col-s-4" > <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editPost">تعديل</a></div>';
                $btn1 = '<div class="mt-1 col-s-4" > <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Show" style="color: white" class="show showRecipe btn btn-warning btn-sm ">عرض الوصفة </a>';

                $btn = $btn1.$btn.'</div> <div class="col-s-4 mt-1 " ><a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deletePost">حذف</a>';

                return $btn;
            })


            ->rawColumns(['action'])
            ->make(true);


    }




    public function create()
    {




    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
   $products=$request->products;
foreach ($products as $product) {
    $allquntity=0;
    foreach ($product['items'] as $item) {
        $allquntity+=$item['item-quantity'];
    }
}
        foreach ($products as $product) {
            $price=0;
            foreach ($product['items'] as $item) {
$myitem= item::find($item['item-name']);

                $price+=$item['item-quantity']*$myitem->price/1000;
            }
        }

   foreach ($products as $product) {
       $items=$product["items"];

        $myproduct=  products::create([
           'name'=>$product['name'],
            'price'=>$price,
                'quantity'=>$allquntity/1000
     ]);
           foreach ($items as $item)
          products_item::create([

              "product_id"=>$myproduct->id,
              "item_id"=>$item['item-name'],
              "percent"=>($item['item-quantity']/$allquntity)*100

          ]) ;
    }

   }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
$product=  products::find($id);
$product_items=products_item::with('items')->where('product_id',$product->id)->get();
$arr=Array();

$name=$product->name;
$id1=$product->id;
$arr1=Array();
//return $product_items[1]->items;
$i=0;
 foreach ($product_items as $item)
        {
            $id=$item->id;

        $name1=$item->items->name;
        $percent=($product->quantity *$item->percent)/100;
        $percent=$percent *1000;
array_push($arr1,['id'=>$id,
    'name'=>$name1,
    "percent"=>$percent
    ]);
            $i++;
        }
        $arr=['id'=>$id1,'name'=>$name,'items'=>$arr1];

 return response()->json( $arr,'200');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {$arr1=Array();
        $product=    products::where('id',$request->id)->first();

        $arr=$request->all();
      $arr1=        array_keys($arr);
for ($i=0;$i<count($arr1);$i++)
if($arr1[$i] == "id" || $arr1[$i] == "_token" || $arr1[$i] == "name" )
unset($arr1[$i]);
foreach ($arr1 as $ar) {
$temp=    products_item::where('id',$ar)->first();
$temp->percent=($arr[$ar]/1000)/$product->quantity *100;
$temp->save();
echo $temp;
}
$product->name=$request->name;

$product->save();
return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        products::where('id',$request->id)->first()->delete();
return redirect()->back();
    }
}
