<?php

namespace App\Http\Controllers;

use App\Models\productData;
use App\Models\SupInsert;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Builder;
use Exception;
use Illuminate\Validation\Rules\Unique;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = productData::latest()->get();
            return DataTables::of($data)
                    -> addColumn('action', function($data){
                        //$supplier = SupInsert::where('id',$data->id_supplier)->first();
                        $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Edit</button>';
                        //$button .= '<button type="button" class="btn btn-info" data-toggle="popover" title="Supplier Name" data-content="'.$supplier->name_supplier.'">View</button>';
                        $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        return $button;
                    })
                    ->addColumn('supplier_name',function($data){
                        $supplier = SupInsert::where('id',$data->id_supplier)->first();
                       return $supplier->name_supplier;
                    })
                    ->rawColumns(['action', 'supplier_name'])
                    ->make(true);

        }

        //dd($request->ajax);
        $id_supplier =  SupInsert::distinct()->get();
        return view('product.index', compact('id_supplier'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id_supplier =  SupInsert::distinct()->get();
        return view('product.add', compact('id_supplier'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   //ubah
        $rules = array(
            'name_product' => 'required',
        );

        $error = Validator::make($request->all(), $rules);
        if($error->fails())
        {
            return response()->json(['errors'=>$error->errors()->all()]);
        }

        $form_data = array(
            'id_supplier'=> $request->id_supplier,
            'name_product'=> $request->name_product
        );
        productData::create($form_data);

        return response()->json(['success'=>'Data Added Successfully.']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\productData  $productData
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\productData  $productData
     * @return \Illuminate\Http\Response
     */
    public function edit($id) //ubah
    {
        if(request()->ajax())
        {
            $data = productData::findOrFail($id);
            return response()->json(['result'=>$data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\productData  $productData
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, productData $productData)
    {
            $rules = array(
                'name_product'        =>  'required',
            );

            $error = Validator::make($request->all(), $rules);

            if($error->fails())
            {
                return response()->json(['errors' => $error->errors()->all()]);
            }

            $form_data = array(
                'name_product'    =>  $request-> name_product,

            );

            productData::whereId($request->hidden_id)->update($form_data);

            return response()->json(['success' => 'Data is successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\productData  $productData
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = productData::findOrFail($id);
        $data->delete();
    }
}
