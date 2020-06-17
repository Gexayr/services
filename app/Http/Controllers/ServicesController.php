<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRequest;
use App\Relations;
use App\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = $innerServices = Services::get();

        return view('index',
            compact(['services', 'innerServices']));
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
        $result = (new Services())->create($data);

        if ($result) {
            return back()
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
    public function edit(Services $service)
    {
        return response()->json($service);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Services  $services
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceRequest $request, Services $service)
    {
        $data = $request->validated();
        $service->name = $data["name"];
        $service->description = $data["description"];

        $result = $service->save();
        if ($result) {
            return back()
                ->with(['success' => 'Success']);
        } else {
            return back()
                ->withErrors(['msg' => 'Saving Error'])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Services  $services
     * @return \Illuminate\Http\Response
     */
    public function destroy(Services $service)
    {


        Relations::whereServiceId($service->id)->delete();
        Relations::whereActiveService($service->id)->delete();

        $result = $service->delete();
        if ($result) {
            return back()
                ->with(['success' => 'Success']);
        } else {
            return back()
                ->withErrors(['msg' => 'Saving Error'])
                ->withInput();
        }
    }

    public function relations(Request $request)
    {
        $data = $request->input('service');

        DB::transaction(function () use ($data) {
            if (empty($data)) {
                Relations::truncate();
            } else {
                foreach ($data as $key => $value) {
                    $relations = Relations::whereServiceId($key)->get();

                    if (!$relations->isEmpty()) {
                        Relations::whereServiceId($key)->delete();
                    }
                    foreach ($value as $active_service => $v) {
                        $newRelation = new Relations();
                        $newRelation->service_id = $key;
                        $newRelation->active_service = $active_service;
                        $newRelation->save();
                    }
                }
            }
        });

        return response()->json(['status' => 'OK']);
    }

    public function home()
    {
        $services = Services::get();

        $checkedServices = Services::whereChecked(Services::CHECKED)->get();
        if(!$checkedServices->isEmpty()) {
            $activeServices = [];
            foreach($checkedServices as $checkedService) {
                foreach ($checkedService->relations as $relation) {
                    $activeServices[] = $relation->active_service;
                }
            }
        } else {
            $activeServices = Services::pluck('id')->toArray();
        }


        return view('home',
            compact(['services', 'activeServices']));
    }

    public function check(Request $request)
    {
        $data = $request->all();
        $service = Services::find($data['id']);
        if ($data["checked"] == 'true') {
            $service->checked = Services::CHECKED;
        } else {
            $service->checked = Services::UNCHECKED;
        }
        $service->save();
        $relations = $service->relations;

        return response()->json($relations->pluck('active_service'));

    }
}
