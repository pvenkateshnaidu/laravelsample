<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=\App\Products::all();
        return view('index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // echo public_path(); exit;
        if($request->hasfile('filename'))
         {
            $file = $request->file('filename');
            $name=$file->getClientOriginalName();
            $url= public_path().'/images/';
            $url= str_replace("\\", "/", $url);
            $file->move($url, $name);
         }
        $products= new \App\Products;
        $products->name=$request->get('name');
        $products->sku=$request->get('sku');
        $products->quantity=$request->get('quantity');
      //  $date=date_create($request->get('date'));
       // $format = date_format($date,"Y-m-d");
      ///  $passport->date = strtotime($format);
        $products->stock=$request->get('stock');
       // $passport->filename=$name;
        $products->save();
        
        return redirect('products')->with('success', 'Information has been added');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = \App\Products::find($id);
        return view('edit',compact('product','id'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $products= \App\Products::find($id);
        $products->name=$request->get('name');
        $products->sku=$request->get('sku');
        $products->quantity=$request->get('quantity');
      //  $date=date_create($request->get('date'));
       // $format = date_format($date,"Y-m-d");
      ///  $passport->date = strtotime($format);
        $products->stock=$request->get('stock');
        $products->save();
        return redirect('products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $products = \App\Products::find($id);
        $products->delete();
        return redirect('products')->with('success','Information has been  deleted');
    }
}
