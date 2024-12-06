<?php

namespace App\Http\Controllers;

use App\Lib\VisitorManager;

class VisitorController extends Controller
{

    public function getAdvertise($pubId, $slug, $currentUrl)
    {
        header("Access-Control-Allow-Origin: *");
        return (new VisitorManager())->ad($pubId, $slug, $currentUrl);
    }

    public function adClicked($publisherId, $trackId)
    {
        return (new VisitorManager())->adClicked($publisherId, $trackId);
    }
}
