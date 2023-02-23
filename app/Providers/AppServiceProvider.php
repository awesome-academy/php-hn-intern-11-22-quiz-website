<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            \App\Repositories\Quiz\QuizRepositoryInterface::class,
            \App\Repositories\Quiz\QuizRepository::class
        );
        $this->app->singleton(
            \App\Repositories\Category\CategoryRepositoryInterface::class,
            \App\Repositories\Category\CategoryRepository::class
        );
        $this->app->singleton(
            \App\Repositories\User\UserRepositoryInterface::class,
            \App\Repositories\User\UserRepository::class
        );
        $this->app->singleton(
            \App\Repositories\QuizAnswer\QuizAnswerRepositoryInterface::class,
            \App\Repositories\QuizAnswer\QuizAnswerRepository::class
        );
        $this->app->singleton(
            \App\Repositories\QuizQuestion\QuizQuestionRepositoryInterface::class,
            \App\Repositories\QuizQuestion\QuizQuestionRepository::class
        );
        $this->app->singleton(
            \App\Repositories\Take\TakeRepositoryInterface::class,
            \App\Repositories\Take\TakeRepository::class
        );
        $this->app->singleton(
            \App\Repositories\TakeAnswer\TakeAnswerRepositoryInterface::class,
            \App\Repositories\TakeAnswer\TakeAnswerRepository::class
        );
        $this->app->singleton(
            \App\Repositories\Notification\NotificationRepositoryInterface::class,
            \App\Repositories\Notification\NotificationRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
