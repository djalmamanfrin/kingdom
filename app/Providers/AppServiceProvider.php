<?php

namespace App\Providers;

use App\Services\BankAccountService;
use App\Services\BankAccountServiceInterface;
use App\Services\BankCardService;
use App\Services\BankCardServiceInterface;
use App\Services\BranchService;
use App\Services\BranchServiceInterface;
use App\Services\ChurchService;
use App\Services\ChurchServiceInterface;
use App\Services\ProfileService;
use App\Services\ProfileServiceInterface;
use App\Services\ProjectService;
use App\Services\ProjectServiceInterface;
use App\Services\UserService;
use App\Services\UserServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(ProfileServiceInterface::class, ProfileService::class);
        $this->app->bind(BranchServiceInterface::class, BranchService::class);
        $this->app->bind(ChurchServiceInterface::class, ChurchService::class);
        $this->app->bind(BankCardServiceInterface::class, BankCardService::class);
        $this->app->bind(ProjectServiceInterface::class, ProjectService::class);
        $this->app->bind(BankAccountServiceInterface::class, BankAccountService::class);
    }
}
