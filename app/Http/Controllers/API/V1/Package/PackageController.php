<?php

namespace App\Http\Controllers\API\V1\Package;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Artisan;
use App\Models\Package;

class PackageController extends Controller
{
    public function index (Request $request) {
        $result = Package::all();
        return $result->toArray();
    }

    public function update (Request $request, $id) {
        $result = Package::find($id);
        $result->fill($request->all())->save();
        return $result->toArray();
    }

    public function show ($id) {
        $result = Package::find($id);
        return $result->toArray();
    }

    public function test () {
        Artisan::call('command:test');
        $result = Artisan::output(); 
        return $result;
    }

    public function install (Request $request) {
        switch($request->name) {
            case 'Lollypop':
                Artisan::call('install:lollypop');
                break;
        }
        $result = Artisan::output();
        return $result;
    }

    public function remove (Request $request) {
        switch($request->name) {
            case 'Lollypop':
                Artisan::call('remove:lollypop');
                break;
        }
        $result = Artisan::output();
        return $result;
    }
}