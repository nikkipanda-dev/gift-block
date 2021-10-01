<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();

        $products = Product::with('images')->get();

        // foreach ($products as $product) {
        //     dump($product->images);
        // }

        return view('admin.products');
    }

    public function store(Request $request)
    {
        $hasFile = false;
        $isValid = false;
        $ctr = 0;
        $user = null;
        $categories = Category::all();
        $subcategories = Subcategory::all();

        $this->validate($request, [
            'usr' => 'required|numeric',
            'name' => 'bail|required|string|between:8,100',
            'description' => 'bail|required|string',
            'catg' => 'bail|required|in:AP,BK,GT,MD,PC',
            'subcatg' => 'bail|required|in:FHR,FHM,AAC,FTN,PHL,PSY,SFH,CAT,SNK,AUD,PTG',
            'price' => 'bail|required|numeric|between:1,50000',
            'stock' => 'bail|required|numeric|between:1,1000000000',
            'thumb_v' => 'bail|required|image',
        ]);

        $filename = Auth::user()->id.'-'.Str::uuid();

        if ($request->usr == Auth::user()->id) {
            $isValid = false;

            $user = User::find(Auth::user()->id);

            $product = new Product();

            $product->user_id = Auth::user()->id;
            $product->reference = $filename;
            $product->name = $request->name;
            $product->description = $request->description;

            foreach ($categories as $category) {
                if ($category->reference == $request->catg) {
                    $product->category_id = $category->id;
                }
            }

            foreach ($subcategories as $subcategory) {
                if ($subcategory->reference == $request->subcatg) {
                    $product->subcategory_id = $subcategory->id;
                }
            }

            $product->price = $request->price;
            $product->stock = $request->stock;

            $product->save();
        }

        // if ($request->hasFile('thumb_v')) {
        //     // dump(count($request->images));
        //     // $hasFile = true;
        //     if ($request->file('thumb_v')->isValid()) {

        //         $filename = Auth::user()->id.'-'.Str::uuid().'.'.$request->file('thumb_v')->extension();

        //         Storage::putFileAs(
        //             'public/product-img', $request->thumb_v, $filename,
        //         );

        //         if (Storage::disk('public')->exists('product-img/'.$filename)) {
        //             dump(public_path('product-img/'.$filename));
        //             // $isValid = true;
        //         }
        //     }
        // }

        if ($request->hasFile('aux')) {
            $product_loc = Product::with('images')->where('reference', $filename)->first()->id;
            $product = Product::find($product_loc);

            $hasFile = true;
            foreach ($request->aux as $aux) {
                if ($aux->isValid()) {
                    $isValid = true;

                    $filename_aux = ++$ctr.'-'.$filename.'.'.$aux->extension();

                    Storage::putFileAs(
                        'public/product-img', $aux, $filename_aux,
                    );

                    if (Storage::disk('public')->exists('product-img/'.$filename_aux)) {
                        $product->images()->attach([
                            2 => [
                                'path' => 'storage/product-img/'.$filename_aux,
                            ]
                        ]);
                        $isValid = true;
                    }
                }
            }
        }

        return response()->json([$request->all(), 'hasFile' => $hasFile, 'isValid' => $isValid]);
    }
}
