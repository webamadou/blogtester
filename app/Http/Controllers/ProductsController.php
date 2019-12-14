<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Products;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{

    /**
     * ProductsController constructor.
     */
    public function __construct(){
        //$this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Products::orderBy('updated_at', 'DESC')->get();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("products.create");
    }
    public function uploadOne(UploadedFile $uploadedFile, $folder = null, $disk = 'public', $filename = null)
    {
        $name = !is_null($filename) ? $filename : Str::random(25);

        $file = $uploadedFile->storeAs($folder, $name.'.'.$uploadedFile->getClientOriginalExtension(), $disk);

        return $file;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$this->messages();
        $data = $request->validate([
            'name' => 'required | max:300 | min: 3',
            'price' => 'nullable | numeric | max:9999999 | min:50'
        ]);
        if($request->hasFile('image')){
            /*if(!Storage::disk('public_uploads')->put($path, $file_content)) {
                return false;
            }*/
            //$data['images'] = $request->image->store('public/product_images');
            $image = $request->file('image');

            $name = Str::slug($request->input('name')).'_'.time();
            $folder = '/product_images/';
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            $this->uploadOne($image, $folder, 'public', $name);
            //$user->profile_image = $filePath;
            $data['images'] = $filePath;
            //$data['images'] = $request->image->storeAs('images', 'filename.jpg', 'public_uploads');
        }
        Products::updateOrCreate($data);
        return redirect('/')->with(['success' => 'Produit parfaitement enregistré']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Products::find($id);
        $categories = Categories::pluck('name','id');
        return view('products.edit', compact('product', 'categories'));
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

        $data['category_id'] = $request->input("category_id");
        //dd($data['category_id']);
        $product = Products::find($id);
        if($product){
            $product->update($data);
            return redirect()->back()->with(['success'=>'Modifications enregistre']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
