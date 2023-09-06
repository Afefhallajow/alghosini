<?php

namespace App\Http\Controllers;

use App\Models\item;
use App\Models\products;
use App\Models\products_item;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class itemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.items',['items'=>item::all()]);
    }
    public function getdata()
    {
        $items = item::all();
        return Datatables::of($items)
            ->addIndexColumn()
            ->addColumn('action', function($row){

                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editPost">Edit</a>';

                $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deletePost">Delete</a>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {




    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $items=$request->items;

            foreach ($items as $item)
            {
                $quantity=$item['quantity'];
            $price=$item['price']/$quantity;
                item::create([

                    "name"=>$item['name'],
                    "price"=>$price,

                ]) ;
            }


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
$item=item::find($id);
    return response()->json($item,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {$item= item::find($request->id);

        $quantity=$request->quantity;
        $price=$request->price/$quantity;
$item->price=$price;
$item->name=$request->name;
$item->save();
return redirect()->back();


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {

        item::where('id',$request->id)->first()->delete();
        return redirect()->back();

    }
}
