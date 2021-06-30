<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

use App\Models\Section;
use App\Observers\SectionObserver;

use App\Models\Lesson;
use App\Observers\LessonObserver;

use App\Models\Course;
use App\Observers\CourseObserver;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Section::observe(SectionObserver::class);
        Lesson::observe(LessonObserver::class);
        Course::observe(CourseObserver::class);
    }
}
