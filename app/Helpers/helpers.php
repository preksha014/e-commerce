<?php

use App\Models\StaticBlock;

function getBannerBlock($slug)
{
    $block= StaticBlock::where('slug', $slug)->where('status',1)->first();

    if(!empty($block)){
        return $block->content;
    }

    $defaultBlock = StaticBlock::where('slug', 'banner-default')->where('status', 1)->first();

    return $defaultBlock->content;
}
