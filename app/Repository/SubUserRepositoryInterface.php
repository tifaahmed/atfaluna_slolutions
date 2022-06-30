<?php

namespace App\Repository;

interface SubUserRepositoryInterface extends EloquentRepositoryInterface{
                    //Accessory
    public function attachAccessories($accessory_ids,$id);
                    //Achievement
    public function attachAchievements($achievement_ids,$id);
                    //Avatar
    public function attachAvatars($avatar_ids,$id);
    public function attachAvatar($avatar_id,$id);
                    //Certificate
    public function attachCertificates($certificate_ids,$id);
                    //Subject
    public function attachSubjects($subject_ids,$id);
                    //Sub_Subject
    public function attachSubSubjects($sub_subject_ids,$id);
                    //Quiz
    public function attachQuizs($quiz_ids,$id);
                    //Lesson
    public function attachLessons($lesson_ids,$id);
                   //AgeGroup
    public function attachAgeGroups($age_group_ids,$id); 
                   //Activity
    public function attachActivities($activity_ids,$id);

}
