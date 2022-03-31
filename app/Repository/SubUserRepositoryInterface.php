<?php

namespace App\Repository;

interface SubUserRepositoryInterface extends EloquentRepositoryInterface{

    public function attachAccessories($accessory_ids,$id);
    public function attachAvatars($avatar_ids,$id);
    public function attachCertificates($certificate_ids,$id);
    public function attachSubjects($subject_ids,$id);
    public function attachAgeGroups($age_group_ids,$id);

}
