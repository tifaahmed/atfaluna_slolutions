<?php

namespace App\Repository;

interface SubUserRepositoryInterface extends EloquentRepositoryInterface{

    public function attachAccessories($accessory_ids,$id);
    public function attachAvatars($avatar_ids,$id);

}
