<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function getAdr(Request $request)
    {
        $customers = Customer::with('user')->has('user')->get();

        // dump($customers);

        return response()->json($customers);
    }

    public function storeAdr(Request $request)
    {
        $saved = false;

        $this->validate($request, [
            'usr' => 'bail|required|numeric',
            'fname' => 'bail|required|string',
            'lname' => 'bail|required|string',
            'mobile' => 'bail|required|string',
            'adr' => 'bail|required|string',
            'rgn' => 'bail|required|in:NCR,CAR,R01,R02,R03,RSTM,RSTR,R05,R06,R07,R08,R09,R10,R11,R12,R13,BSR',
            'city' => 'bail|required|string',
            'zip' => 'bail|required|numeric|between:400,9811',
        ]);

        if ($request->usr == Auth::user()->id) {

            $user = User::find($request->usr);

            if ($user) {
                $customer = new Customer();

                $customer->user()->associate($user);
                $customer->shpg_first_name = $request->fname;
                $customer->shpg_last_name = $request->lname;
                $customer->shpg_mobile_number = $request->mobile;
                $customer->shpg_address = $request->adr;
                $customer->shpg_region = $request->rgn;
                $customer->shpg_city = $request->city;
                $customer->shpg_zip = $request->zip;

                $customer->save();

                $saved = true;
            }
        }

        return response()->json([$request->all(), 'stored' => $saved]);
    }

    public function updateAdr(Request $request)
    {
        $isValid = false;

        $this->validate($request, [
            'usr' => 'bail|required|numeric',
            'ref' => 'bail|required|numeric',
            'fname' => 'bail|nullable|string',
            'lname' => 'bail|nullable|string',
            'mobile' => 'bail|nullable|string',
            'adr' => 'bail|nullable|string',
            'rgn' => 'bail|nullable|in:NCR,CAR,R01,R02,R03,RSTM,RSTR,R05,R06,R07,R08,R09,R10,R11,R12,R13,BSR',
            'city' => 'bail|nullable|string',
            'zip' => 'bail|nullable|numeric|between:400,9811',
        ]);

        if ($request->usr == Auth::user()->id) {
            $customer = Customer::find($request->ref);

            if ($customer) {
                if (($customer->id == $request->ref) && ($customer->user_id == $request->usr)) {
                    if ($request->fname) {
                        $customer->shpg_first_name = $request->fname;
                    }

                    if ($request->lname) {
                        $customer->shpg_last_name = $request->lname;
                    }

                    if ($request->mobile) {
                        $customer->shpg_mobile_number = $request->mobile;
                    }

                    if ($request->adr) {
                        $customer->shpg_address = $request->adr;
                    }

                    if ($request->rgn) {
                        $customer->shpg_region = $request->rgn;
                    }

                    if ($request->city) {
                        $customer->shpg_city = $request->city;
                    }

                    if ($request->zip) {
                        $customer->shpg_zip = $request->zip;
                    }

                    $customer->save();
                    $isValid = true;
                }
            }
        }

        return response()->json([$request->all(), 'isValid' => $isValid]);
    }

    public function destroyAdr(Request $request)
    {
        $isValid = false;

        $this->validate($request, [
            'usr' => 'bail|required|numeric',
            'ref' => 'bail|required|numeric',
        ]);

        if ($request->usr == Auth::user()->id) {
            $customer = Customer::find($request->ref);

            if ($customer) {
                if (($customer->id == $request->ref) && ($customer->user_id == $request->usr)) {
                    $customer->delete();
                    $isValid = true;
                }
            }
        }

        return response()->json([$request->all(), 'isValid' => $isValid]);
    }

    public function storeCart(Request $request)
    {

        $saved = false;
        $image = null;
        $ST = null;

        if ($request->usr == Auth::user()->id) {
            $user = User::find($request->usr);

            if ($user) {
                $product = Product::find($request->ref);

                if ($product) {
                    if ($product->user_id !== $request->usr) {
                        if (($request->session()->exists('cart.'.$product->id.'.qty')) && ($request->session()->exists('cart.'.$product->id.'.st'))) {
                            $request->session()->put('cart.'.$product->id.'.qty', $request->qty);
                            $ST = floatval($product->price) * $request->qty;
                            $request->session()->put('cart.'.$product->id.'.st', $ST);
                            $saved = true;
                        } else {
                            $request->session()->push('cart.'.$product->id, $product);
                            $request->session()->put('cart.'.$product->id.'.qty', $request->qty);
                            $ST = floatval($product->price) * $request->qty;
                            $request->session()->put('cart.'.$product->id.'.st', $ST);

                            if ($product->images) {
                                foreach ($product->images as $image) {
                                    $saved = true;
                                    if ($image->prod_img->image_id == 1) {
                                        $request->session()->put('cart.'.$product->id.'.thumb', $image->prod_img->path);
                                        break;
                                    }
                                }
                            }

                            $request->session()->flash('alert', 'Added '.$product->name.' to shopping cart.');
                        }
                    }
                }
            }
        }

        $usrSesh = $request->session()->all();

        return response()->json([$request->all(), 'isValid' => $saved, 'session' => $usrSesh]);
    }

    public function showCart(Request $request)
    {
        $hasCart = false;
        $cartSesh = null;

        if ($request->session()->has('cart')) {
            $cartSesh = $request->session()->get('cart');
            $hasCart = true;
        }

        return response()->json(['hasProd' => $hasCart, 'cart' => $cartSesh]);
    }

    public function destroyCart(Request $request)
    {
        $isValid = false;

        if (Auth::check()) {
            if ($request->usr !== Auth::user()->id) {
                $product = Product::with('images')->where('reference', $request->ref)->first();

                if ($product) {
                    if (($product->user_id == $request->usr) && ($product->id == $request->id)) {
                        if ($request->session()->exists('cart.'.$product->id)) {
                            $rmv_prod = $request->session()->pull('cart.'.$product->id);
                            if ($request->session()->missing('cart.'.$product->id)) {
                                $request->session()->flash('alert', 'Removed '.$product->name.' from cart.');
                                $isValid = true;
                            }
                        }
                    }
                }
            }
        }

        $usrSesh = $request->session()->all();

        return response()->json([$request->all(), 'isValid' => $isValid, 'removed' => $rmv_prod, 'session' => $usrSesh]);
    }
}
