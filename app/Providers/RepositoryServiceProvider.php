<?php

namespace App\Providers;
// Repository

    use App\Repository\Eloquent\BaseRepository;
    use App\Repository\Eloquent\LanguageRepository;
    use App\Repository\Eloquent\BasicRepository;

    use App\Repository\Eloquent\GovernmentRepository;
    use App\Repository\Eloquent\CountryRepository;
    use App\Repository\Eloquent\CityRepository;

    use App\Repository\Eloquent\UserRepository;
    use App\Repository\Eloquent\UserSubscriptionRepository;
    use App\Repository\Eloquent\UserPackageRepository;

    use App\Repository\Eloquent\SubUserRepository;
    use App\Repository\Eloquent\SubUserQuizRepository;
    use App\Repository\Eloquent\SubUserLessonRepository;

    use App\Repository\Eloquent\AvatarRepository;

    use App\Repository\Eloquent\AgeRepository;
    use App\Repository\Eloquent\AboutUsRepository;

    use App\Repository\Eloquent\ContactUsRepository;

    use App\Repository\Eloquent\AgeGroupLanguageRepository;
    use App\Repository\Eloquent\AgeGroupRepository;

    use App\Repository\Eloquent\StoreLanguageRepository;
    use App\Repository\Eloquent\StoreRepository;

    use App\Repository\Eloquent\TrueFalseQuestionRepository;
    use App\Repository\Eloquent\TrueFalseQuestionLanguageRepository;

    use App\Repository\Eloquent\SubscriptionRepository;
    use App\Repository\Eloquent\SubscriptionLanguageRepository;

    use App\Repository\Eloquent\SubjectRepository;
    use App\Repository\Eloquent\SubjectLanguageRepository;

    use App\Repository\Eloquent\SkillableRepository;

    use App\Repository\Eloquent\SkillRepository;
    use App\Repository\Eloquent\SkillLanguageRepository;

    use App\Repository\Eloquent\QuizRepository;
    use App\Repository\Eloquent\QuizLanguageRepository;

    use App\Repository\Eloquent\PlayTimeRepository;

    use App\Repository\Eloquent\PackageRepository;
    use App\Repository\Eloquent\PackageLanguageRepository;

    use App\Repository\Eloquent\McqQuestionRepository;
    use App\Repository\Eloquent\McqQuestionLanguageRepository;

    use App\Repository\Eloquent\McqAnswerRepository;
    use App\Repository\Eloquent\McqAnswerLanguageRepository;

    use App\Repository\Eloquent\LessonRepository;
    use App\Repository\Eloquent\LessonTypeRepository;
    use App\Repository\Eloquent\LessonLanguageRepository;

    use App\Repository\Eloquent\CertificateRepository;
    use App\Repository\Eloquent\CertificateLanguageRepository;

    use App\Repository\Eloquent\AccessoryRepository;
    use App\Repository\Eloquent\AccessoryLanguageRepository;

    use App\Repository\Eloquent\SubSubjectRepository;
    use App\Repository\Eloquent\SubSubjectLanguageRepository;

    use App\Repository\Eloquent\HeroRepository;
    use App\Repository\Eloquent\HeroLanguageRepository;

    use App\Repository\Eloquent\HeroLessonRepository;

    use App\Repository\Eloquent\QuestionTagRepository;
    use App\Repository\Eloquent\QuizTypeRepository;

    use App\Repository\Eloquent\AchievementRepository;
    use App\Repository\Eloquent\AchievementLanguageRepository;
    use App\Repository\Eloquent\AchievementImageRepository;
    use App\Repository\Eloquent\SubUserAchievementRepository;

    use App\Repository\Eloquent\SoundsRepository;
    use App\Repository\Eloquent\SoundableRepository;

    use App\Repository\Eloquent\FriendRepository;
    use App\Repository\Eloquent\GroupChatRepository;
    use App\Repository\Eloquent\MassageImageRepository;
    use App\Repository\Eloquent\MassageRepository;
    use App\Repository\Eloquent\ConversationRepository;

    use App\Repository\Eloquent\ActivityRepository;
    use App\Repository\Eloquent\ActivityLanguageRepository;
    use App\Repository\Eloquent\SubUserActivityRepository;

    use App\Repository\Eloquent\SkinRepository;
    use App\Repository\Eloquent\SkinLanguageRepository;
    use App\Repository\Eloquent\SubUserSkinRepository;
    use App\Repository\Eloquent\AccessorySkinRepository;
    use App\Repository\Eloquent\BodySuitRepository;
    use App\Repository\Eloquent\HumanPartRepository;

    use App\Repository\Eloquent\DurationTimeRepository;
    use App\Repository\DurationTimeRepositoryInterface;

    use App\Repository\Eloquent\MatchQuestionRepository;
    use App\Repository\Eloquent\MatchQuestionLanguageRepository;

    use App\Repository\Eloquent\MatchAnswerRepository;
    use App\Repository\Eloquent\MatchAnswerLanguageRepository;
    // Role  Permission
        use App\Repository\Eloquent\RoleRepository;

        use App\Repository\Eloquent\RolePermissionRepository\PermissionRepository;
        // use App\Repository\Eloquent\RolePermissionRepository\RoleRepository;
        use App\Repository\Eloquent\RolePermissionRepository\ModelHasPermissionRepository;
        use App\Repository\Eloquent\RolePermissionRepository\ModelHasRoleRepository;
        use App\Repository\Eloquent\RolePermissionRepository\RoleHasPermissionRepository;
    // Role  Permission

// Repository

// Interface

    use App\Repository\EloquentRepositoryInterface;
    use App\Repository\LanguageRepositoryInterface;
    use App\Repository\BasicRepositoryInterface;

    use App\Repository\GovernmentRepositoryInterface;
    use App\Repository\CountryRepositoryInterface;
    use App\Repository\CityRepositoryInterface;

    use App\Repository\StoreLanguageRepositoryInterface;
    use App\Repository\StoreRepositoryInterface;

    use App\Repository\UserRepositoryInterface;
    use App\Repository\UserSubscriptionRepositoryInterface;
    use App\Repository\UserPackageRepositoryInterface;

    use App\Repository\SubUserRepositoryInterface;
    use App\Repository\SubUserQuizRepositoryInterface;
    use App\Repository\SubUserLessonRepositoryInterface;
    use App\Repository\AboutUsRepositoryInterface;

    use App\Repository\ContactUsRepositoryInterface;

    use App\Repository\AvatarRepositoryInterface;
    
    use App\Repository\AgeRepositoryInterface;
    use App\Repository\AgeGroupLanguageRepositoryInterface;
    use App\Repository\AgeGroupRepositoryInterface;

    use App\Repository\TrueFalseQuestionRepositoryInterface;
    use App\Repository\TrueFalseQuestionLanguageRepositoryInterface;

    use App\Repository\SubscriptionRepositoryInterface;
    use App\Repository\SubscriptionLanguageRepositoryInterface;

    use App\Repository\SubjectRepositoryInterface;
    use App\Repository\SubjectLanguageRepositoryInterface;

    use App\Repository\SkillableRepositoryInterface;
    use App\Repository\SkillRepositoryInterface;
    use App\Repository\SkillLanguageRepositoryInterface;

    use App\Repository\QuizRepositoryInterface;
    use App\Repository\QuizLanguageRepositoryInterface;

    use App\Repository\PlayTimeRepositoryInterface;

    use App\Repository\PackageRepositoryInterface;
    use App\Repository\PackageLanguageRepositoryInterface;

    use App\Repository\McqQuestionRepositoryInterface;
    use App\Repository\McqQuestionLanguageRepositoryInterface;

    use App\Repository\McqAnswerRepositoryInterface;
    use App\Repository\McqAnswerLanguageRepositoryInterface;

    use App\Repository\LessonRepositoryInterface;
    use App\Repository\LessonTypeRepositoryInterface;
    use App\Repository\LessonLanguageRepositoryInterface;

    use App\Repository\CertificateRepositoryInterface;
    use App\Repository\CertificateLanguageRepositoryInterface;

    use App\Repository\AccessoryRepositoryInterface;
    use App\Repository\AccessoryLanguageRepositoryInterface;

    use App\Repository\SubSubjectRepositoryInterface;
    use App\Repository\SubSubjectLanguageRepositoryInterface;

    use App\Repository\HeroRepositoryInterface;
    use App\Repository\HeroLanguageRepositoryInterface;

    use App\Repository\HeroLessonRepositoryInterface;

    use App\Repository\QuestionTagRepositoryInterface;
    use App\Repository\QuizTypeRepositoryInterface;

    use App\Repository\SubUserAchievementRepositoryInterface;
    use App\Repository\AchievementRepositoryInterface;
    use App\Repository\AchievementLanguageRepositoryInterface;
    use App\Repository\AchievementImageRepositoryInterface;

    use App\Repository\SoundsRepositoryInterface;
    use App\Repository\SoundableRepositoryInterface;

    use App\Repository\FriendRepositoryInterface;
    use App\Repository\GroupChatRepositoryInterface;
    use App\Repository\MassageImageRepositoryInterface;
    use App\Repository\MassageRepositoryInterface;
    use App\Repository\ConversationRepositoryInterface;

    use App\Repository\ActivityRepositoryInterface;
    use App\Repository\ActivityLanguageRepositoryInterface;
    use App\Repository\SubUserActivityRepositoryInterface;

    use App\Repository\SkinRepositoryInterface;
    use App\Repository\SkinLanguageRepositoryInterface;
    use App\Repository\SubUserSkinRepositoryInterface;
    use App\Repository\AccessorySkinRepositoryInterface;
    use App\Repository\BodySuitRepositoryInterface;
    use App\Repository\HumanPartRepositoryInterface;

    use App\Repository\MatchQuestionRepositoryInterface;
    use App\Repository\MatchQuestionLanguageRepositoryInterface;

    use App\Repository\MatchAnswerRepositoryInterface;
    use App\Repository\MatchAnswerLanguageRepositoryInterface;
    // Role  Permission   
    use App\Repository\RoleRepositoryInterface;

    use App\Repository\RolePermissionInterface\PermissionRepositoryInterface;
    // use App\Repository\RolePermissionInterface\RoleRepositoryInterface;
    use App\Repository\RolePermissionInterface\ModelHasPermissionRepositoryInterface;
    use App\Repository\RolePermissionInterface\ModelHasRoleRepositoryInterface;
    use App\Repository\RolePermissionInterface\RoleHasPermissionRepositoryInterface;
    // Role  Permission


use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Basic
        $this->app->bind(EloquentRepositoryInterface::class,BaseRepository::class);
        $this->app->bind(LanguageRepositoryInterface::class,LanguageRepository::class);
        $this->app->bind(BasicRepositoryInterface::class,BasicRepository::class);

        // Country
        $this->app->bind(GovernmentRepositoryInterface::class,GovernmentRepository::class);
        $this->app->bind(CountryRepositoryInterface::class,CountryRepository::class);
        $this->app->bind(CityRepositoryInterface::class,CityRepository::class);

        // Store
        $this->app->bind(StoreLanguageRepositoryInterface::class,StoreLanguageRepository::class);
        $this->app->bind(StoreRepositoryInterface::class,StoreRepository::class);

        // User
        $this->app->bind(UserRepositoryInterface::class,UserRepository::class);
        $this->app->bind(UserSubscriptionRepositoryInterface::class,UserSubscriptionRepository::class);
        $this->app->bind(UserPackageRepositoryInterface::class,UserPackageRepository::class);

        // SubUser
        $this->app->bind(SubUserRepositoryInterface::class,SubUserRepository::class);
        $this->app->bind(SubUserQuizRepositoryInterface::class,SubUserQuizRepository::class);
        $this->app->bind(SubUserLessonRepositoryInterface::class,SubUserLessonRepository::class);

        // Avatar
        $this->app->bind(AvatarRepositoryInterface::class,AvatarRepository::class);

        // Us
        $this->app->bind(AboutUsRepositoryInterface::class,AboutUsRepository::class);
        $this->app->bind(ContactUsRepositoryInterface::class,ContactUsRepository::class);

        // Age
        $this->app->bind(AgeRepositoryInterface::class,AgeRepository::class);
        $this->app->bind(AgeGroupLanguageRepositoryInterface::class,AgeGroupLanguageRepository::class);
        $this->app->bind(AgeGroupRepositoryInterface::class,AgeGroupRepository::class);

        // TrueFalseQuestion
        $this->app->bind(TrueFalseQuestionRepositoryInterface::class,TrueFalseQuestionRepository::class);
        $this->app->bind(TrueFalseQuestionLanguageRepositoryInterface::class,TrueFalseQuestionLanguageRepository::class);
        $this->app->bind(QuestionTagRepositoryInterface::class,QuestionTagRepository::class);

        // Mcq
        $this->app->bind(McqQuestionRepositoryInterface::class,McqQuestionRepository::class);
        $this->app->bind(McqQuestionLanguageRepositoryInterface::class,McqQuestionLanguageRepository::class);
        $this->app->bind(McqAnswerRepositoryInterface::class,McqAnswerRepository::class);
        $this->app->bind(McqAnswerLanguageRepositoryInterface::class,McqAnswerLanguageRepository::class);

         // Match
        $this->app->bind(MatchQuestionRepositoryInterface::class,MatchQuestionRepository::class);
        $this->app->bind(MatchQuestionLanguageRepositoryInterface::class,MatchQuestionLanguageRepository::class);
        $this->app->bind(MatchAnswerRepositoryInterface::class,MatchAnswerRepository::class);
        $this->app->bind(MatchAnswerLanguageRepositoryInterface::class,MatchAnswerLanguageRepository::class);

        // Subscription
        $this->app->bind(SubscriptionRepositoryInterface::class,SubscriptionRepository::class);
        $this->app->bind(SubscriptionLanguageRepositoryInterface::class,SubscriptionLanguageRepository::class);

        // Subject
        $this->app->bind(SubjectRepositoryInterface::class,SubjectRepository::class);
        $this->app->bind(SubjectLanguageRepositoryInterface::class,SubjectLanguageRepository::class);

        // SubSubject
        $this->app->bind(SubSubjectRepositoryInterface::class,SubSubjectRepository::class);
        $this->app->bind(SubSubjectLanguageRepositoryInterface::class,SubSubjectLanguageRepository::class);

        // Lesson
        $this->app->bind(LessonRepositoryInterface::class,LessonRepository::class);
        $this->app->bind(LessonTypeRepositoryInterface::class,LessonTypeRepository::class);
        $this->app->bind(LessonLanguageRepositoryInterface::class,LessonLanguageRepository::class);

        // Quiz
        $this->app->bind(QuizRepositoryInterface::class,QuizRepository::class);
        $this->app->bind(QuizLanguageRepositoryInterface::class,QuizLanguageRepository::class);
        $this->app->bind(QuizTypeRepositoryInterface::class,QuizTypeRepository::class);

         // Activity
        $this->app->bind(ActivityRepositoryInterface::class,ActivityRepository::class);
        $this->app->bind(ActivityLanguageRepositoryInterface::class,ActivityLanguageRepository::class);
        $this->app->bind(SubUserActivityRepositoryInterface::class,SubUserActivityRepository::class);
        // Skill
        $this->app->bind(SkillRepositoryInterface::class,SkillRepository::class);
        $this->app->bind(SkillLanguageRepositoryInterface::class,SkillLanguageRepository::class);
        $this->app->bind(SkillableRepositoryInterface::class,SkillableRepository::class);

        // PlayTime
        $this->app->bind(PlayTimeRepositoryInterface::class,PlayTimeRepository::class);

        // Package
        $this->app->bind(PackageRepositoryInterface::class,PackageRepository::class);
        $this->app->bind(PackageLanguageRepositoryInterface::class,PackageLanguageRepository::class);

        // Certificate
        $this->app->bind(CertificateRepositoryInterface::class,CertificateRepository::class);
        $this->app->bind(CertificateLanguageRepositoryInterface::class,CertificateLanguageRepository::class);

        // Accessory
        $this->app->bind(AccessoryRepositoryInterface::class,AccessoryRepository::class);
        $this->app->bind(AccessoryLanguageRepositoryInterface::class,AccessoryLanguageRepository::class);

        // Hero
        $this->app->bind(HeroRepositoryInterface::class,HeroRepository::class);
        $this->app->bind(HeroLanguageRepositoryInterface::class,HeroLanguageRepository::class);
        $this->app->bind(HeroLessonRepositoryInterface::class,HeroLessonRepository::class);

        // Achievement
        $this->app->bind(AchievementRepositoryInterface::class,AchievementRepository::class);
        $this->app->bind(AchievementLanguageRepositoryInterface::class,AchievementLanguageRepository::class);
        $this->app->bind(AchievementImageRepositoryInterface::class,AchievementImageRepository::class);
        $this->app->bind(SubUserAchievementRepositoryInterface::class,SubUserAchievementRepository::class);

        // Conversation
        $this->app->bind(MassageRepositoryInterface::class,MassageRepository::class);
        $this->app->bind(MassageImageRepositoryInterface::class,MassageImageRepository::class);
        $this->app->bind(GroupChatRepositoryInterface::class,GroupChatRepository::class);
        $this->app->bind(FriendRepositoryInterface::class,FriendRepository::class);
        $this->app->bind(ConversationRepositoryInterface::class,ConversationRepository::class);
    
        // Sound
        $this->app->bind(SoundableRepositoryInterface::class,SoundableRepository::class);
        $this->app->bind(SoundsRepositoryInterface::class,SoundsRepository::class);

        // Skin
        $this->app->bind(SkinRepositoryInterface::class,SkinRepository::class);
        $this->app->bind(SkinLanguageRepositoryInterface::class,SkinLanguageRepository::class);
        $this->app->bind(SubUserSkinRepositoryInterface::class,SubUserSkinRepository::class);

        $this->app->bind(AccessorySkinRepositoryInterface::class,AccessorySkinRepository::class);
        $this->app->bind(BodySuitRepositoryInterface::class,BodySuitRepository::class);
        
        $this->app->bind(HumanPartRepositoryInterface::class,HumanPartRepository::class);

        $this->app->bind(DurationTimeRepositoryInterface::class,DurationTimeRepository::class);


    
        // Role  Permission
        $this->app->bind(PermissionRepositoryInterface::class,PermissionRepository::class);
        $this->app->bind(RoleRepositoryInterface::class,RoleRepository::class);
        $this->app->bind(ModelHasPermissionRepositoryInterface::class,ModelHasPermissionRepository::class);
        $this->app->bind(ModelHasRoleRepositoryInterface::class,ModelHasRoleRepository::class);
        $this->app->bind(RoleHasPermissionRepositoryInterface::class,RoleHasPermissionRepository::class);
    }
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
