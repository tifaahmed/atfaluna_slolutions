<?php

namespace App\Repository;

interface BodySuitRepositoryInterface extends EloquentRepositoryInterface{
	public function attachHumanPart($human_part_ids,$body_suit_id)  ;
}
