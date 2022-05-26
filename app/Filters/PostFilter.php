<?php

namespace App\Filters;

class PostFilter extends QueryFilter{
    public function categoryAdd($title) {
        return $this->builder->where('category_title', $title);
    }

    public function search($searchField){
        return $this->builder
                    ->where('post_name','like','%'.$searchField.'%')
                    ->orWhere('name','like','%'.$searchField.'%')
                    ->orWhere('content','like','%'.$searchField.'%');
    }
}