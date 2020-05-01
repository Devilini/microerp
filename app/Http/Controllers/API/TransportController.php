<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Transport;
use App\TransportType;
use Illuminate\Http\Request;

class TransportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Transport::with('type')->paginate(15);
    }

    public function create()
    {
        $transport_types = TransportType::all();
        $status = Transport::getEnumValues('transports', 'status');

        return ['transport_types' => $transport_types,'status' => $status];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Transport::validate($request);
        $transport = new Transport;

        return $transport->add($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transport = Transport::find($id);
        $transport_types = TransportType::all();
        $status = Transport::getEnumValues('transports', 'status');

        return ['transport' =>$transport, 'transport_types' => $transport_types, 'status' => $status];
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
        Transport::validate($request);
        $transport = Transport::find($id);
        $transport->edit($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transport = Transport::findOrFail($id);
        $transport->delete();
    }

}
