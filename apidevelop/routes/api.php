<?php 

Route::apiResource('/class','Api\ClassController');

Route::apiResource('/subject','Api\SubjectController');
Route::apiResource('/section','Api\SectionController');
Route::apiResource('/student','Api\StudentController');


// Route::group([

//     'middleware' => 'api',
//     'prefix' => 'auth'

// ], function ($router) {

//     Route::post('login', 'AuthController@login');
//     Route::post('logout', 'AuthController@logout');
//     Route::post('refresh', 'AuthController@refresh');
//     Route::post('me', 'AuthController@me');

// });

Route::group([

   
    'prefix' => 'auth'

], function () {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('payload','AuthController@payload');
    Route::post('register','AuthController@register');

});

