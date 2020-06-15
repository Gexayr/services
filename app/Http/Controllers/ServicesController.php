<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRequest;
use App\Services;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request)
    {
        $data = $request->validated();
        $item = (new Services())->create($data);

        if ($item) {
            return redirect()
                ->route('services.index')
                ->with(['success' => 'Success']);
        } else {
            return back()
                ->withErrors(['msg' => 'Saving Error'])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Services  $services
     * @return \Illuminate\Http\Response
     */
    public function show(Services $services)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Services  $services
     * @return \Illuminate\Http\Response
     */
    public function edit(Services $services)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Services  $services
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Services $services)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Services  $services
     * @return \Illuminate\Http\Response
     */
    public function destroy(Services $services)
    {
        //
    }
}
