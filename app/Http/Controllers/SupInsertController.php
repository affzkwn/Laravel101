<?php

namespace App\Http\Controllers;

use App\Models\SupInsert;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Illuminate\Validation\Rule;

class SupInsertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = SupInsert::latest()->get();
            return DataTables::of($data)
                    -> addColumn('action', function($data){
                        $button = '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Edit</button>';
                        //$button = '<button type="button" name="view" id="'.$data->id.'" class="view btn btn-primary btn-sm">View</button>';
                        $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        //dd($request->ajax);
        $id_supplier =  SupInsert::distinct()->get();
        return view('supplier.index',compact('id_supplier'));
        //$data = SupInsert::all();
        //return view('supplier.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id_supplier =  SupInsert::distinct()->get();
        return view('supplier.add', compact('id_supplier'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'name_supplier' => 'required',
            'contact_supplier' => 'required',
        );

        $error = Validator::make($request->all(), $rules);
        if($error->fails())
        {
            return response()->json(['errors'=>$error->errors()->all()]);
        }

        $form_data = array(
            'name_supplier'=> $request->name_supplier,
            'contact_supplier'=> $request->contact_supplier
        );
        SupInsert::create($form_data);

        return response()->json(['success'=>'Data Added Successfully.']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SupInsert  $supInsert
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SupInsert  $supInsert
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = SupInsert::findOrFail($id);
            return response()->json(['result'=>$data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SupInsert  $supInsert
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SupInsert $supInsert)
    {
        $rules = array(
            'name_supplier' => 'required',
            'contact_supplier' => 'required',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'name_supplier'    =>  $request->name_supplier,
            'contact_supplier'    =>  $request->contact_name,
        );

        SupInsert::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Data is successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SupInsert  $supInsert
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = SupInsert::findOrFail($id);
        $data->delete();
    }
}
