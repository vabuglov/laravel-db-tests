<?php

namespace App\Http\Controllers;

use App\Route;
use App\RouteGroup;
use Illuminate\Http\Request;

class RouteGroupController extends Controller
{
    public function index()
    {
        $routeGroup = RouteGroup::all();
        return ["data" => $routeGroup];
    }

    public function store(Request $request)
    {

        if (isset($request->id)) {
            $routeGroup = RouteGroup::findOrFail($request->id);
        } else {
            $routeGroup = new RouteGroup;
        }

        $routeGroup->id = $request->input('id');
        $routeGroup->name = $request->input('name');
        $routeGroup->save();

        return ["data" => $routeGroup];
    }

    public function connect(Request $request)
    {

        $routeGroup = RouteGroup::findOrFail($request->input('route_group_id'));

        $route = Route::where('name', ($request->input('route_name')))->first();

        $routeGroup->routes()->save($route);

        return ["data" => $routeGroup];
    }

    public function disconnect(Request $request)
    {
        $routeGroup = RouteGroup::findOrFail($request->input('route_group_id'));
        $route = Route::findOrFail($request->input('route_id'));
        $routeGroup->routes()->detach($route);
        return ["data" => $routeGroup];
    }

    public function show_connected($id)
    {
        $routeGroup = RouteGroup::find($id)->routes()->get();
        return $routeGroup;
    }

    public function show($id)
    {
        $review = RouteGroup::findOrFail($id);

        return ["data" => $review];
    }

    public function destroy($id)
    {
        $routeGroup = RouteGroup::findOrFail($id);
        \Log::info($routeGroup);
        \Log::info($id);

        if ($routeGroup) {
            $routeGroup->delete();
        }

        try {

            return ["data" => $routeGroup];
        } catch (\Exception $e) {
            $status = 400;
            $message = 'Something went wrong, please, report us';
            if ($e instanceof HttpException) {
                $status = $e->getStatusCode();
                $message = $e->getMessage();
            }
            return [
                "error" => $message,
                "status" => $status,
            ];
        }
    }
}
