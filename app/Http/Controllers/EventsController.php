<?php

namespace App\Http\Controllers;

use App\Models\Events;

/**
 * https://codereview.stackexchange.com/questions/283008/laravel-eager-loading-tickets-from-db
 */
class EventsController extends Controller
{
    public function showEvents($course)
    {
        // function for the /events/{$course} pages
        [$view, $id] = match ($course) {
            default => ['error', 'error'],
            // URL Request from ($course) then the set the $view and $id
            'loremimpsum' => ['pages.course.loremimpsum', '2'],
            'impsumlorem' => ['pages.course.impsumlorem', '3'],
            'loremlorem' => ['pages.course.loremlorem', '4'],
            'impsumimpsum' => ['pages.course.impsumimpsum', '5'],
            'looremloorem' => ['pages.course.looremloorem', '6'],
            'impsimps' => ['pages.course.impsimps', '7'],
            'loremloremlorem' => ['pages.course.loremloremlorem', '8'],
        };

        try {
            return view($view, [
                'events' => Events::query()
                    ->orderBy('title')
                    ->orderBy('start')
                    ->where('category', $id)
                    ->where('start', '>', now())
                    ->get()

            ]);
        } catch (InvalidArgumentException) {
            return Redirect::route('all-events')->with('error', 'You were redirected! This event was not found.');
        }
    }
}
