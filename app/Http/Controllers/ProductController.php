<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use Database\Factories\ProductFactory;
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

        $products = Product::with('images')->has('images')->get();
        $product_loc = Product::with('images')->where('reference', '3-80e01caa-0524-4073-a4ca-e1b76f37c865')->first();

        foreach ($product_loc->images as $image) {
            if (Str::startsWith(str_replace('storage/product-img/', '', $image->prod_img->path), 'tmb-'.Auth::user()->id.'-'.'a05fbb1b-13ee-4db0-8ea4-5b2e349c665f')) {
                dump(str_replace('storage/product-img/', '', $image->prod_img->path));
            } else {
                dump('NOT MATCH! '.$image->prod_img->path);
            }
        }

        // update user table reference
        // detach user tmb
        // attach new user tmb

        return view('admin.products');
    }

    public function getProd(Request $request)
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();

        $products = Product::with('images')->has('images')->get();

        return response()->json([
            'prod' => $products,
            'catg' => $categories,
            'subcatg' => $subcategories,
        ]);
    }

    public function store(Request $request)
    {
        $hasFile = false;
        $isValid = false;
        $ctr = 0;
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

        $product_loc = Product::with('images')->where('reference', $filename)->first()->id;
        $product = Product::find($product_loc);

        if ($request->hasFile('thumb_v')) {
            if ($request->file('thumb_v')->isValid()) {

                $filename_tmb = 'tmb'.'-'.$filename.'.'.$request->file('thumb_v')->extension();

                Storage::putFileAs(
                    'public/product-img', $request->thumb_v, $filename_tmb,
                );

                if (Storage::disk('public')->exists('product-img/'.$filename_tmb)) {
                    $product->images()->attach([
                        1 => [
                            'path' => 'storage/product-img/'.$filename_tmb,
                        ]
                    ]);
                }
            }
        }

        if ($request->hasFile('aux')) {
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

    public function update(Request $request)
    {
        $isValid = false;
        $hasFile = false;
        $product = null;
        $product_loc = null;
        $thumb_path = null;
        $dump = null;
        $aux_arr = [];
        $ctr = 0;

        $filename = Auth::user()->id.'-'.Str::uuid();

        if ($request->usr == Auth::user()->id) {
            if ($request->hasFile('thumb_v')) {
                if ($request->file('thumb_v')->isValid()) {
                    $product_loc = Product::with('images')->where('reference', $request->ref)->first();
                    $product = Product::find($product_loc->id);

                    if ($product_loc) {
                        foreach ($product_loc->images as $image) {
                            if (Str::startsWith(str_replace('storage/product-img/', '', $image->prod_img->path), 'tmb-'.$request->ref)) {
                                $thumb_path = $image->prod_img->path;
                            } else {
                                array_push($aux_arr, $image->prod_img->path);
                            }
                        }

                        $product->images()->detach();
                    }

                    $filename_tmb = 'tmb'.'-'.$filename.'.'.$request->file('thumb_v')->extension();

                    if (Storage::disk('public')->exists(str_replace('storage/', '', $thumb_path))) {
                        Storage::putFileAs(
                            'public/product-img', $request->thumb_v, $filename_tmb,
                        );

                        if (Storage::disk('public')->exists('product-img/'.$filename_tmb)) {
                            $product->images()->attach([
                                1 => [
                                    'path' => 'storage/product-img/'.$filename_tmb,
                                ]
                            ]);

                            Storage::disk('public')->delete(str_replace('storage', '', $thumb_path));

                            if (count($aux_arr) !== 0) {
                                foreach($aux_arr as $aux) {
                                    if (Storage::disk('public')->exists(str_replace('storage/', '', $aux))) {
                                        Storage::disk('public')->delete(str_replace('storage', '', $aux));
                                    }
                                }
                            }
                        }
                    }

                    if ($request->hasFile('aux')) {
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

                    $product->reference = $filename;

                    $product->save();

                }
            }
        }

        return response()->json([$request->all(), 'product' => $product, 'hasFile' => $hasFile, 'isValid' => $isValid, 'thumbpath' => $thumb_path, 'dump' => $dump, 'arr' => $aux_arr]);
    }
}
