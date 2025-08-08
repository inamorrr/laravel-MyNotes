<?php

namespace App\Providers;

use App\Models\Note;
use App\Policies\NotePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Mapping policy ke model.
     */
    protected $policies = [
        Note::class => NotePolicy::class,
    ];

    /**
     * Bootstrap authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
