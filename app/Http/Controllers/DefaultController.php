<?php


namespace App\Http\Controllers;


use App\Http\Services\CovidApiService;
use http\Env\Request;

class DefaultController
{

    public function index(CovidApiService $covidApiService, Request $request){
        $formSubmitted = false;
        $infections =[];

        if ($request->has('country')){
            $formSubmitted = true;
            $covidData = $covidApiService->download("https://pomber.github.io/covid19/timeseries.json");
        }

        return view('index');
    }

}
