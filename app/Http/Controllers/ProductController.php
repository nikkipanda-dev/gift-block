<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
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
        return view('admin.products');
    }

    public function store(Request $request)
    {
        $hasFile = false;
        $isValid = false;

        $this->validate($request, [
            'usr' => 'required|numeric',
            'name' => 'bail|required|string|between:8,100',
            'description' => 'bail|required|string',
            'catg' => 'bail|required|in:AP,BK,GT,MD,PC',
            'subcatg' => 'bail|required|in:FHR,FHM,AAC,FTN,PHL,PSY,SFH,CAT,SNK,AUD,PTG',
            'price' => 'bail|required|numeric|between:1,50000',
            'stock' => 'bail|required|numeric|between:1,1000000000',
        ]);

        if ($request->usr == Auth::user()->id) {
            $isValid = true;
            // $product = new Product();

            // $product->user_id = Auth::user()->id;

        }

        // if ($request->hasFile('images')) {
        //     dump(count($request->images));
        //     $hasFile = true;
        //     if (count($request->images) > 1) {
        //         foreach ($request->images as $image) {
        //             if ($image->isValid()) {

        //                 $filename = Auth::user()->id.'-'.Str::uuid().'.'.$image->extension();

        //                 Storage::putFileAs(
        //                     'public/product-img', $image, $filename,
        //                 );

        //                 if (Storage::disk('public')->exists('product-img/'.$filename)) {
        //                     dump(public_path('product-img/'.$filename));
        //                     $isValid = true;
        //                 }
        //             }
        //         }
        //     } else {
        //         dump('only 1');
        //     }
        // }

        return response()->json([$request->all(), 'hasFile' => $hasFile, 'isValid' => $isValid]);
    }
}
