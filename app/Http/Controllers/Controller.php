<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function home(Request $request)
    {

      $query = $request->query();
      if ($query) {
        $where = array_slice($query, 0, 1, true);
        $customer = Customer::firstOrNew($where, $query);
      } else {
        $customer = new Customer();
      }

      return view('form', compact('customer'));
    }

    public function saveCustomer(Request $request)
    {
      if ($request->get('customer_id')) {
        $customer = Customer::find($request->get('customer_id'));
        $customer->fill($request->except(['customer_id', '_token']));
        $customer->save();
      } else {
        $customer = Customer::create($request->all());
      }
      return redirect()->route('loadCustomer', ['owner_email' => $customer->owner_email, 'owner_phone' => $customer->owner_phone]);
    }
}
