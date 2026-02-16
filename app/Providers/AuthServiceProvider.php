<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\Models\User;
use App\Models\Attendance;
use App\Models\Division;
use App\Models\DivisionReport;
use App\Models\PmiDeparture;
use App\Models\Partner;
use App\Models\Visa;

use App\Policies\UserPolicy;
use App\Policies\AttendancePolicy;
use App\Policies\DivisionPolicy;
use App\Policies\DivisionReportPolicy;
use App\Policies\PmiDeparturePolicy;
use App\Policies\PartnerPolicy;
use App\Policies\VisaPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Attendance::class => AttendancePolicy::class,
        Division::class => DivisionPolicy::class,
        DivisionReport::class => DivisionReportPolicy::class,
        PmiDeparture::class => PmiDeparturePolicy::class,
        Partner::class => PartnerPolicy::class,
        Visa::class => VisaPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
