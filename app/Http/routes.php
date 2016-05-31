<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', function () {
    // Change blade tags
    Blade::setEscapedContentTags('[[', ']]');
    Blade::setContentTags('[[[', ']]]');

    return view('index');
});

Route::get('/api/testjson', function () {
    return "{
    \"menu\": {
        \"id\": \"jdhdhdh\",
        \"value\": \"File\",
        \"popup\": {
            \"menuitem\": [
                { \"value\": \"New\", \"onclick\": \"CreateNewDoc()\" },
                { \"value\": \"Open\", \"onclick\": \"OpenDoc()\" },
                { \"value\": \"Close\", \"onclick\": \"CloseDoc()\" }
            ]
        }
    }
}";
});



Route::get('/hello', function () {

    $omd = new \App\Http\Utils\Omdb();
    $data = $omd->searchBySeriesName("Game");

    dd($data);

    return "It works !";
});

Route::get('/securitycheck', ['middleware' => 'jwt.auth', function () {
    return "Security works !";
}]);




/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/
/*
Route::group(['middleware' => ['web']], function () {
    //
});


/*
 * ROUTES TO USE
*/



Route::group(['prefix' => 'api'], function () {

    // Home Controller
    /**
     * Get all featured series
     */
    Route::get('featured', 'HomeController@getFeaturedSeries');

    /**
     * Get favourites series from user
     */
    Route::get('favourites/{iduser}', 'HomeController@getFavouritesSeries');


    // Authenticate Controller

    Route::resource('authenticate', 'AuthenticateController', ['only' => ['index']]);
    Route::post('authenticate', 'AuthenticateController@authenticate');
    Route::get('authenticate/user', 'AuthenticateController@getAuthenticatedUser');


    // Serie Controller

    /**
     * Search serie from external api
     */
    Route::get('search/{string}', 'SerieController@searchSerie');

    /**
     * Get a serie by ID from home page
     */
    Route::get('serie/{id}', 'SerieController@getSerie');

    /**
     * Get episode information
     */
    Route::get('episode/{id}', 'SerieController@getEpisode');

    /**
     * Subscribe to a serie
     */
    Route::post('subscribe/{idserie}', 'SerieController@subscribe');

    /**
     * Unsubscribe from a serie
     */
    Route::post('unsubscribe/{idserie}', 'SerieController@unsubscribe');


    // Profile Controller

    /**
     * Get all profile info
     */
    Route::get('profile', 'ProfileController@getProfile');

    Route::group(['prefix' => 'profile'], function (){

        /**
         * Get all subscriptions
         */
        Route::get('subscriptions', 'ProfileController@getSubscriptions');

        /**
         * Set personal data
         */
        Route::post('personal', 'ProfileController@setPersonnalData');


    });


});




// Remove # from angularjs URL
Route::any('{path?}', function () {
    return view('index');
})->where("path", ".+");

