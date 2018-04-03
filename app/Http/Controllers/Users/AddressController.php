<?php

namespace App\Http\Controllers\Users;

use App\Models\Users\Address;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;

class AddressController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:user');
    }
    
    public function index()
    {
        $addresses = auth()->user()->addresses()->get();

        return view('user.address', compact('addresses'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AddressRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddressRequest $request)
    {
        auth()->user()->addresses()->create($request->all());

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\AddressRequest  $request
     * @param  \App\Models\Users\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(AddressRequest $request, Address $address)
    {
        $address->update($request->all());

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Users\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {
        $address->delete();

        return redirect()->back();
    }
}
