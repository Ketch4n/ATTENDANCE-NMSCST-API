<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\DTRModel;
use App\Models\AbsentModel;
use App\Models\CourseModel;
use Illuminate\Http\Request;
use App\Models\AnnouncementModel;
use App\Models\EstablishmentModel;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReportResource;

class ReportController extends Controller
{
    public function report(Request $request)
    {
       
        $validated = $request->validate([
            'years' => 'required|string'
        ]);

        $year = $validated['years'];
        [$startYear, $endYear] = explode('-', $year);

        $response = [
            'users' => User::where('status', '!=', 3)
                           ->where('school_year', $year)
                           ->count(),

            'estab' => EstablishmentModel::count(),

            'courses' => CourseModel::count(),

            'absent' => AbsentModel::whereBetween('created_at', ["$startYear-01-01", "$endYear-12-31"])
                              ->count(),

            'late' => DTRModel::join('schedule', 'dtr.establishment_id', '=', 'schedule.establishment_id')
                          ->where(function ($query) {
                              $query->whereColumn('dtr.in_am', '>', 'schedule.in_am')
                                    ->orWhereColumn('dtr.in_pm', '>', 'schedule.in_pm');
                          })
                          ->whereBetween('dtr.created_at', ["$startYear-01-01", "$endYear-12-31"])
                          ->distinct()
                          ->count('dtr.user_id'),

            'announcement' => AnnouncementModel::whereBetween('created_at', ["$startYear-01-01", "$endYear-12-31"])
                                          ->count(),

          
        ];

        
        return new ReportResource($response);
    }
    public function outsideRange(Request $request)
    {
       
        $validated = $request->validate([
            'years' => 'required|string'
        ]);

        $year = $validated['years'];
        [$startYear, $endYear] = explode('-', $year);

        $response = EstablishmentModel::join('dtr', 'dtr.establishment_id', '=', 'establishment.id')
                            ->join('schedule', 'dtr.establishment_id', '=', 'schedule.establishment_id')
                            ->join('users', 'dtr.user_id', '=', 'users.id')
                            ->join('dtr_location', 'dtr_location.dtr_id', '=', 'dtr.id')
                            ->select('dtr.*','dtr_location.*','dtr_location.id AS dtr_loc_id','schedule.in_am AS sched_in_am','schedule.out_pm AS sched_out_pm' ,'users.name','users.email','establishment.longitude', 'establishment.latitude', 'establishment.radius')
                            ->whereBetween('dtr.created_at', ["$startYear-01-01", "$endYear-12-31"])
                            ->get()
        ;

        
        return new ReportResource($response);
    }
}
