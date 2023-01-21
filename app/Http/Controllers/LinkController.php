<?php

namespace App\Http\Controllers;

use App\Http\Resources\LinkResource;
use App\Models\Link;

/**
 * https://codereview.stackexchange.com/q/281639/120114
 */
class LinkController extends Controller
{
    /// is this correct?
    public function show($code)
    {
        $link = Link::where('code', $code)->first();

        return new LinkResource($link);
    }

    ///is this correct?
    public function index(){
        $links = Link::paginate(20);

        return LinkResource::collection($links);

    }
}
