<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Appointment;
use Carbon\Carbon;
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
        $customer = Customer::with('appointments')->firstOrNew($where, $query);
      } else {
        $customer = new Customer();
      }

      if (isset($query['output']) && $query['output'] == 'json') {
        return response()->json($customer);
      } else {
        return view('form', compact('customer'));
      }
    }

    public function saveCustomer(Request $request)
    {
      if ($request->get('customer_id')) {
        $customer = Customer::find($request->get('customer_id'));
        $customer->fill($request->except(['customer_id', '_token', 'appointment_type', 'appointment_date']));
        $customer->save();
      } else {
        $customer = Customer::create($request->except(['appointment_type', 'appointment_date']));
      }

      if ($request->get('appointment_date')) {
        $appointment = new Appointment([
          'type' => $request->get('appointment_type'),
          'date' => new Carbon($request->get('appointment_date'))
        ]);
        $customer->appointments()->save($appointment);
      }

      return redirect()->route('loadCustomer', ['owner_email' => $customer->owner_email, 'owner_phone' => $customer->owner_phone]);
    }

    public function deleteAppointment(Request $request)
    {
      if ($request->get('appointment_id')) {
        $appointment = Appointment::findOrFail($request->get('appointment_id'));
        $appointment->delete();
      }
      return redirect()->back();
    }
}
