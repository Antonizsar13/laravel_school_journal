<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\AcademicDiscipline;
use App\Policies\AcademicDisciplinePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        AcademicDiscipline::class => AcademicDisciplinePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
