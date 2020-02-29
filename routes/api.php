<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('drivers/{count}', 'DriverController@index');
Route::get('cars/{count}', 'CarController@index');
Route::get('carphotos/{count}', 'CarphotoController@index');
Route::get('reviews/{count}', 'ReviewController@index');
Route::get('routes/{count}', 'RouteController@index');
Route::get('tours/{count}', 'TourController@index');

Route::group(['prefix' => 'driver'], function () {
    $controller = "DriverController@";
    Route::get('/{id}', $controller . 'show');
    Route::get('/showall/driversData', $controller . 'showAllDriversData');
    Route::get('/withTrashed/{count}', $controller . 'showWT');
    Route::get('/onlyTrashed/{count}', $controller . 'showOT');
    Route::get('/rg/show_connected/{driver_id}', $controller . 'show_connected');
    Route::get('/car/get_car/{id}', $controller . 'get_car');
    Route::post('/restore/{id}', $controller . 'restore'); //put
    Route::post('/', $controller . 'store');
    Route::post('/rg/connect/{driver_id}/{rg_id}', $controller . 'addRG');
    Route::post('/', $controller . 'store'); //put

    Route::post('/delete/{id}', $controller . 'destroy'); //delete
    Route::post('/rg/disconnect', $controller . 'disconnect'); //delete
    Route::post('/{id}', $controller . 'delete'); //delete

});

Route::group(['prefix' => 'car'], function () {
    $controller = "CarController@";
    Route::get('/{id}', $controller . 'show');
    Route::post('/', $controller . 'store');
    Route::post('/', $controller . 'store'); //put

    Route::post('/{id}', $controller . 'destroy'); //delete

});

Route::group(['prefix' => 'carphoto'], function () {
    $controller = "CarphotoController@";
    Route::get('/{id}', $controller . 'show');
    Route::post('/', $controller . 'store');
    Route::post('/', $controller . 'store'); //put
    Route::post('/back', $controller . 'postBackPhoto'); //put
    Route::post('/front', $controller . 'postFrontPhoto'); //put
    Route::post('/side', $controller . 'postSidePhoto'); //put
    Route::post('/{id}', $controller . 'destroy'); //delete

});

Route::group(['prefix' => 'review'], function () {
    $controller = "ReviewController@";
    Route::get('/driver/{id}', $controller . 'dshow');
    Route::get('/{id}', $controller . 'show');
    Route::post('/', $controller . 'store');
    Route::post('/', $controller . 'store'); //put
    Route::post('/{id}', $controller . 'destroy'); //delete

});

Route::group(['prefix' => 'route'], function () {
    $controller = "RouteController@";
    Route::get('/{id}', $controller . 'show');
    Route::get('/routes/all', $controller . 'all');
    Route::get('/wrg/{id}', $controller . 'showRG');
    Route::get('/name/{name}', $controller . 'show_name');
    Route::post('/', $controller . 'store');
    Route::post('/', $controller . 'store'); //put
    Route::post('/{id}', $controller . 'destroy'); //delete

});

Route::group(['prefix' => 'route_group'], function () {
    $controller = "RouteGroupController@";
    Route::get('/groups', $controller . 'index');
    Route::get('/{id}', $controller . 'show');
    Route::get('/show_connected/{id}', $controller . 'show_connected');
    Route::post('/connect', $controller . 'connect');
    Route::post('/', $controller . 'store');
    Route::post('/', $controller . 'store'); //put
    Route::post('/{id}', $controller . 'destroy'); //delete

});

Route::group(['prefix' => 'routes_rout_group'], function () {
    $controller = "RoutesRouteGroupController@";
    Route::post('/', $controller . 'store');
    Route::post('/', $controller . 'store'); //put
    Route::post('/{id}', $controller . 'destroy'); //delete

});

Route::group(['prefix' => 'tour'], function () {
    $controller = "TourController@";
    Route::get('/{id}', $controller . 'show');
    Route::get('/all', $controller . 'all');
    Route::get('/show/routes/{tourid}', $controller . 'show_routes');
    Route::get('/category/{id}', $controller . 'show_category');
    Route::post('/connect/category', $controller . 'connect_category');
    Route::post('/', $controller . 'store');
    Route::post('/connect/route', $controller . 'connect_route_to_tour');
    Route::post('/', $controller . 'store'); //put
    Route::post('/upload/photo', $controller . 'postphoto'); //put

    Route::post('/{id}', $controller . 'destroy'); //delete
    Route::post('/disconnect/category', $controller . 'disconnet_category'); //delete

    Route::post('/disconnect/route', $controller . 'disconnet_route'); //delete

});

Route::group(['prefix' => 'settings'], function () {
    $controller = "PhotosController@";
    Route::get('/updatePhotos', $controller . 'index');
});

Route::group(['prefix' => 'category'], function () {
    $controller = "CategoryController@";
    Route::get('/all', $controller . 'index');
    Route::get('/getTours/{id}', $controller . 'show_tours');
    Route::post('/update', $controller . 'update'); //put

});

Route::group(['prefix' => 'notices'], function () {
    $controller = "NoticesController@";
    Route::get('/get', $controller . 'index');
    Route::get('/getall', $controller . 'getAll');
    Route::post('/additem', $controller . 'addItem'); //put
    Route::post('/updateitem', $controller . 'updateItem'); //put
    Route::post('/deleteitem', $controller . 'deleteItem'); //delete

});

Route::post('/disconnect', 'RouteGroupController@disconnect'); //delete
Route::get('/alltour', 'TourController@all');

Route::group(['prefix' => 'settings'], function () {
    $controller = "AltaySettingsController@";
    Route::get('/all', $controller . 'index');
    Route::get('/deletephotos', $controller . 'deletephotos');
    Route::post('/update', $controller . 'update'); //put
});
