<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteInfo;

class user_SiteInfoController extends Controller
{
    public function AllInformation(){

        $siteinfo = SiteInfo::find(1);
        
        return response()->json([
            'data' => $siteinfo,
        ], 200);



    }
}
