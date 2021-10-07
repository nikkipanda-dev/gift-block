<?php

namespace App\Http\Controllers;

use App\Models\Customer;
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
}
