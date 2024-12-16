<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Get date range from request or default to last 30 days
        $days = $request->query('days', 30); // Default to 30 days
        $startDate = now()->subDays($days);
        $endDate = now();

        // Fetch leads within the date range
        $data = DB::table('leads')
            ->join('clients', 'leads.client_id', '=', 'clients.id')
            ->join('users as salespeople', 'leads.user_id', '=', 'salespeople.id')
            ->join('lead_stages', 'leads.lead_stage_id', '=', 'lead_stages.id')
            ->whereBetween('leads.created_at', [$startDate, $endDate])
            ->select(
                'clients.name as client_name',
                DB::raw("CONCAT(salespeople.first_name, ' ', salespeople.last_name) as salesperson"),
                'leads.id as lead_id',
                'leads.title as lead_title',
                'leads.revenue',
                'lead_stages.title as current_stage',
                DB::raw('DATE(leads.created_at) as date'),
                DB::raw("CASE WHEN lead_stages.title = 'Conversion' THEN 'Converted' WHEN lead_stages.title = 'Loss' THEN 'Lost' ELSE 'In Progress' END as conversion_status")
            )
            ->get();

        // Fetch all stages to include those with 0 counts
        $stages = DB::table('lead_stages')->pluck('title')->toArray();

        // Metrics
        $totalLeads = $data->count(); // Total number of leads
        $potentialRevenue = $data->sum('revenue'); // Sum of revenue for all leads
        $convertedRevenue = $data->where('conversion_status', 'Converted')->sum('revenue'); // Total converted revenue

        // Total Clients, Projects, and Users
        $totalClients = DB::table('clients')->count(); // Total number of clients
        $totalProjects = DB::table('projects')->count(); // Assuming a projects table exists
        $totalUsers = DB::table('users')->count(); // Total number of users

        // Calculate Gained and Lost Revenue
        $gainedRevenue = $data->where('conversion_status', 'Converted')->sum('revenue'); // Total revenue of converted leads
        $lostRevenue = $data->where('conversion_status', 'Lost')->sum('revenue'); // Total revenue of lost leads

        // Format values for display
        $formattedGainedRevenue = 'R ' . number_format($gainedRevenue, 2, '.', ' ');
        $formattedLostRevenue = 'R ' . number_format($lostRevenue, 2, '.', ' ');
        $formattedPotentialRevenue = 'R ' . number_format($potentialRevenue, 2, '.', ' ');
        $formattedConvertedRevenue = 'R ' . number_format($convertedRevenue, 2, '.', ' ');


        // Prepare Data for Line Chart
        $chartData = [];
        foreach ($stages as $stage) {
            $chartData[$stage] = array_fill_keys(
                $data->pluck('date')->unique()->toArray(),
                0
            );
        }

        foreach ($data as $item) {
            $chartData[$item->current_stage][$item->date] += 1;
        }

        $series = [];
        foreach ($chartData as $stage => $counts) {
            $series[] = [
                'name' => $stage,
                'data' => array_values($counts),
            ];
        }

        // Dates for the x-axis
        $dates = array_keys(reset($chartData));

        // Revenue by Client (Converted Only)
        $clientsRevenue = $data->where('conversion_status', 'Converted')
            ->groupBy('client_name')
            ->map(fn($group) => $group->sum('revenue'))
            ->toArray();

        // Revenue by Consultant (Converted Only)
        $salespeopleRevenue = $data->where('conversion_status', 'Converted')
            ->groupBy('salesperson')
            ->map(fn($group) => $group->sum('revenue'))
            ->toArray();

        // Conversion Status Counts
        $conversionStatuses = array_replace(array_fill_keys(['Converted', 'Lost', 'In Progress'], 0), $data->groupBy('conversion_status')->map(fn($group) => $group->count())->toArray());

        // Top Clients and Consultants by Converted Revenue
        $topConvertedClients = collect($clientsRevenue)->sortDesc()->take(5);
        $leadingConsultants = collect($salespeopleRevenue)->sortDesc()->take(5);

        return view(
            'pages.dashboard',
            compact(
                'data',
                'clientsRevenue',
                'salespeopleRevenue',
                'conversionStatuses',
                'days',
                'gainedRevenue',
                'lostRevenue',
                'series',
                'dates',
                'totalLeads',
                'potentialRevenue',
                'convertedRevenue',
                'totalClients',
                'totalProjects',
                'totalUsers',
                'formattedGainedRevenue',
                'formattedLostRevenue',
                'formattedPotentialRevenue',
                'formattedConvertedRevenue',
                'leadingConsultants',
                'topConvertedClients'
            )
        );
    }



    /**
     * Display the specified resource.
     */
    public function show()
    {
        $user = Auth::user();
        $users = User::with('leads')
            ->paginate(10);

        $users = $users->getCollection()->sortByDesc(function ($user) {
            return $user->leads->sum('revenue');
        });

        $users = new \Illuminate\Pagination\LengthAwarePaginator(
            $users,
            $users->count(),
            10,
            request()->input('page', 1),
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('pages.dashboard', compact('users', 'user'));
    }
}
