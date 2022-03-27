<?php

namespace App\Repository;

interface HeroRepositoryInterface extends EloquentRepositoryInterface{
    public function attachLessons($lesson_ids,$id);

}
