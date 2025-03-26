<?php

use App\Models\StaticBlock;

function getBannerBlock($slug)
{
    return StaticBlock::where('slug', $slug)->first();
}