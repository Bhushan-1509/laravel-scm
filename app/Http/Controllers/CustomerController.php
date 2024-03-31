<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\Customer\StoreCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Str;

class CustomerController extends Controller
{
    public function index()
    {
//        $customers = Customer::where('user_id', auth()->id())->count();
        $customers = Customer::all()->count();
        $url = 'https://cdn-api.co-vin.in/api/v2/admin/location/states';
        $client = new Client();
        $states = null;
        try {
            // Send a GET request to the URL
            $response = $client->get($url);

            // Get the response body as a string
            $body = $response->getBody()->getContents();
            $statesRes = json_decode($body);
            $states = $statesRes->states;
        } catch (RequestException $e) {
            // If an error occurs, handle it
            dd($e->getMessage());
        }
        return view('customers.index', [
                'customers' => $customers,
                'states' => $states
            ]);

    }

    public function create($request)
    {
        Customer::create([
            'uuid' => Str::uuid(),
            'company_name' => $request->companyName,
            'address' => $request->address,
            'pincode' => $request->pincode,
            'state' => $request->states,
            'gst_no' => $request->gstNo,
            'state' => $request->state,
            'company_in_sez' => $request->companyInSez,
            'company_type' => $request->companyType,
            'distance_from_andheri' => $request->distanceFromAndheri,
            'distance_from_vasai' => $request->distanceFromVasai,

        ]);

        return redirect()
            ->route('customers.index')
            ->with('success', 'New customer has been created!');
    }

    public function store(StoreCustomerRequest $request)
    {
        /**
         * Handle upload an image
         */
        $image = '';
//        if ($request->hasFile('photo')) {
//            $image = $request->file('photo')->store('customers', 'public');
//        }

        Customer::create([
            'uuid' => Str::uuid(),
            'company_name' => $request->companyName,
            'address' => $request->address,
            'pincode' => $request->pincode,
            'state' => $request->states,
            'gst_no' => $request->gstNo,
            'state' => $request->states,
            'company_in_sez' => $request->companyInSez,
            'company_type' => $request->companyType,
            'distance_from_andheri' => $request->distanceFromAndheri,
            'distance_from_vasai' => $request->distanceFromVasai,

        ]);

        return redirect()
            ->route('customers.index')
            ->with('success', 'New customer has been created!');
    }

    public function show($uuid)
    {
        $customer = Customer::where('uuid', $uuid)->firstOrFail();
        $customer->loadMissing(['quotations', 'orders'])->get();


        return view('customers.show', [
            'customer' => $customer,
        ]);
    }

    public function edit($uuid)
    {
        $customer = Customer::where('uuid', $uuid)->firstOrFail();
        $states = null;
        $url = 'https://cdn-api.co-vin.in/api/v2/admin/location/states';
        $client = new Client();
        try {
            // Send a GET request to the URL
            $response = $client->get($url);

            // Get the response body as a string
            $body = $response->getBody()->getContents();
            $statesRes = json_decode($body);
            $states = $statesRes->states;
        } catch (RequestException $e) {
            // If an error occurs, handle it
            dd($e->getMessage());
        }        return view('customers.edit', [
            'customer' => $customer,
            'states' => $states
        ]);
    }

    public function update(UpdateCustomerRequest $request, $uuid)
    {
        $customer = Customer::where('uuid', $uuid)->firstOrFail();

        /**
         * Handle upload image with Storage.
         */
//        $image = $customer->photo;
//        if ($request->hasFile('photo')) {
//            if ($customer->photo) {
//                unlink(public_path('storage/') . $customer->photo);
//            }
//            $image = $request->file('photo')->store('customers', 'public');
//        }

//        $customer->update([
//            'photo' => $image,
//            'name' => $request->name,
//            'email' => $request->email,
//            'phone' => $request->phone,
//            'shopname' => $request->shopname,
//            'type' => $request->type,
//            'account_holder' => $request->account_holder,
//            'account_number' => $request->account_number,
//            'bank_name' => $request->bank_name,
//            'address' => $request->address,
//        ]);

        $customer->update([
            'uuid' => Str::uuid(),
            'company_name' => $request->companyName,
            'address' => $request->address,
            'pincode' => $request->pincode,
            'state' => $request->states,
            'gst_no' => $request->gstNo,
            'state' => $request->states,
            'distance_from_andheri' => $request->distanceFromAndheri,
            'distance_from_vasai' => $request->distanceFromVasai,

        ]);


        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer has been updated!');
    }

    public function destroy($uuid)
    {
        $customer = Customer::where('uuid', $uuid)->firstOrFail();
        if ($customer->photo) {
            unlink(public_path('storage/') . $customer->photo);
        }

        $customer->delete();

        return redirect()
            ->back()
            ->with('success', 'Customer has been deleted!');
    }
}
