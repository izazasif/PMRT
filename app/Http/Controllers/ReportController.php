<?php

namespace App\Http\Controllers;
use App\Models\Project_Developer_Assignment;
use App\Models\WeeklyReports;
use Illuminate\Http\Request;
use App\Models\ProjectStages;
use App\Models\User;
use Illuminate\Support\Carbon;
use DB;
class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $is_active = "assigned_list";
        $id = session()->get('user_id');
        $type = session()->get('type');
        $data = Project_Developer_Assignment::where('developer_id',$id)->get();
     
        return view('report.developer.index',compact('data','is_active'));
    }
    public function developer_all_report()
    {   
        $is_active = "developer_all_report";
        $id = session()->get('user_id');
            Carbon::setWeekStartsAt(Carbon::SUNDAY);
            $currentWeekStart = Carbon::now()->startOfWeek();
            $currentWeekEnd = Carbon::now()->endOfWeek()->endOfDay()->subDay(3);
  
        $data = WeeklyReports::where('developer_id',$id )
                                ->whereNotBetween('created_at', [$currentWeekStart, $currentWeekEnd])
                                ->orderBy('created_at', 'desc')
                                ->get();
        // dd($data);                        
        // $data = Project_Developer_Assignment::whereIn('developer_id',$data->id )
        //                         ->whereIn('developer_id',$data->id )
        //                         ->orderBy('created_at', 'desc')
        //                         ->get();                                                             
        return view('report.developer.developer_all_report',compact('data','is_active'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {   
        $is_active = "assigned_list";
        $data = Project_Developer_Assignment::where('id',$id)->first();
        // dd($data);
        return view('report.developer.add',compact('data','is_active'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
   

        $this->validate($request, [
            'task_completed' => 'required',
            
        ]);
        
        $current = Carbon::now();
        $data = new WeeklyReports();


        
        $data->project_id = $request->project_id;

        $data->developer_id = $request->developer_id;

        $data->timeline  = $current;

        $data->task_completed = $request->task_completed;
        
        $data->save();

        $message = 'Weekly Report Submitted .';

        return redirect()->route('report.index')->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {   
        $is_active = "submitted_report";
        $type = session()->get('type');
       
        $data = [];
        if($type == 'leader')
        {   
            Carbon::setWeekStartsAt(Carbon::SUNDAY);
            $currentWeekStart = Carbon::now()->startOfWeek();
            $currentWeekEnd = Carbon::now()->endOfWeek()->endOfDay()->subDay(3);
           
            $data = WeeklyReports::select('weekly_reports.id','projects.timeline as timeline','weekly_reports.project_id','projects.name as projects_name', 'users.name as developer_name', 'task_completed')
            ->join('users', 'users.id', '=', 'weekly_reports.developer_id')
            ->join('projects', 'projects.id', '=', 'weekly_reports.project_id')
            ->whereBetween('weekly_reports.created_at', [$currentWeekStart, $currentWeekEnd])
            ->get()
            ->groupBy(['projects_name'])
            ->toArray();
        }
        else{
           
            $data = [];
        }
        return view('report.leader.index',compact('data','is_active'));
    }

    public function report_show()
    {  
        $is_active = "report";
        $type = session()->get('type');
        $data = [];
        if($type == 'leader')
        {     
            Carbon::setWeekStartsAt(Carbon::SUNDAY);
            $currentWeekStart = Carbon::now()->startOfWeek();
            $currentWeekEnd = Carbon::now()->endOfWeek()->endOfDay()->subDay(3);
            $data = WeeklyReports::select('weekly_reports.project_id','projects.name as projects_name','projects.timeline as timeline','users.name as developer_name', 'task_completed')
                            ->join('users', 'users.id', '=', 'weekly_reports.developer_id')
                            ->join('projects', 'projects.id', '=', 'weekly_reports.project_id')
                            ->whereBetween('weekly_reports.created_at', [$currentWeekStart, $currentWeekEnd])
                            ->get()
                            ->groupBy('projects_name')
                            ->toArray();
                       
        }
        else {
            $data = [];
        }                    
        return view('report.leader.show',compact('data','is_active'));
    }

    public function project_show()
    {   
        $is_active = "developer_involved";
        $type = session()->get('type');
        $data = [];
        if($type == 'leader')
        {   
        $stage = ProjectStages::get();
        $name = User::where('type','developer')->get();
        $data = User::select('project__developer__assignments.developer_id', 'project_stages.name as projects_stage_name', 'projects.name as projects_name', 'users.name as developer_name')
                    ->join('project__developer__assignments', 'project__developer__assignments.developer_id', '=', 'users.id')
                    ->join('projects', 'projects.id', '=', 'project__developer__assignments.project_id')
                    ->join('project_stages', 'project_stages.id', '=', 'projects.project_stage_id') 
                    ->get()
                    ->groupBy('developer_name')
                    ->map(function ($items, $key) {
                        $mergedItem = $items->first();
                        $mergedItem['projects_stage_name'] = $items->pluck('projects_stage_name')->implode('<br> ');
                        $mergedItem['projects_name'] = $items->pluck('projects_name')->unique()->implode('<br> ');

                        return $mergedItem;
                    })
                    ->values()
                    ->toArray();
                return view('report.leader.assign_project',compact('data','stage','name','is_active'));    
        }
        else {
            $data = [];
            return redirect('/report');
        }
    }
    
    public function report_sort(Request $request)
    {
        $project_stage = $request->project_stage_id;
        $dev_id = $request->name;
        $data = [];
        $stage = [];
        $name = [];
        $is_active = "";
        
        if($project_stage != null && $dev_id == null)
        {    
            session()->put('project_stage_id', $project_stage);

            $stage = ProjectStages::get();
            $name = User::where('type','developer')->get();  
            // $data =  User::select('project__developer__assignments.developer_id','project_stages.name as projects_stage_name','projects.name as projects_name', 'users.name as developer_name')
            //                     ->join('project__developer__assignments', 'project__developer__assignments.developer_id', '=', 'users.id')
            //                     ->join('projects', 'projects.id', '=', 'project__developer__assignments.project_id')
            //                     ->join('project_stages', 'project_stages.id', '=', 'projects.project_stage_id')
            //                     ->where('projects.project_stage_id',$project_stage)
            //                     ->get()
            //                     ->groupBy(['users.name as developer_name'])
            //                     ->toArray();
            $data = User::select('project__developer__assignments.developer_id', 'project_stages.name as projects_stage_name', 'projects.name as projects_name', 'users.name as developer_name')
                        ->join('project__developer__assignments', 'project__developer__assignments.developer_id', '=', 'users.id')
                        ->join('projects', 'projects.id', '=', 'project__developer__assignments.project_id')
                        ->join('project_stages', 'project_stages.id', '=', 'projects.project_stage_id') 
                        ->where('projects.project_stage_id',$project_stage)
                        ->get()
                        ->groupBy('developer_name')
                        ->map(function ($items, $key) {
                            $mergedItem = $items->first();
                            $mergedItem['projects_stage_name'] = $items->pluck('projects_stage_name')->implode('<br> ');
                            $mergedItem['projects_name'] = $items->pluck('projects_name')->unique()->implode('<br> ');

                            return $mergedItem;
                        })
                        ->values()
                        ->toArray();
            
           
            
        }
        elseif($project_stage ==null && $dev_id != null){
            
            
            session()->put('name',  $dev_id);
            $stage = ProjectStages::get();
            $name = User::where('type','developer')->get();
            $data = User::select('project__developer__assignments.developer_id', 'project_stages.name as projects_stage_name', 'projects.name as projects_name', 'users.name as developer_name')
                                ->join('project__developer__assignments', 'project__developer__assignments.developer_id', '=', 'users.id')
                                ->join('projects', 'projects.id', '=', 'project__developer__assignments.project_id')
                                ->join('project_stages', 'project_stages.id', '=', 'projects.project_stage_id') 
                                ->where('project__developer__assignments.developer_id',$dev_id)
                                ->get()
                                ->groupBy('developer_name')
                                ->map(function ($items, $key) {
                                    $mergedItem = $items->first();
                                    $mergedItem['projects_stage_name'] = $items->pluck('projects_stage_name')->implode('<br> ');
                                    $mergedItem['projects_name'] = $items->pluck('projects_name')->unique()->implode('<br> ');
        
                                    return $mergedItem;
                                })
                                ->values()
                                ->toArray();
                              
        }
        elseif($project_stage != null && $dev_id != null){
      
            session()->put('name', $dev_id);
            session()->put('project_stage_id', $project_stage);
            
            $stage = ProjectStages::get();
            $name = User::where('type','developer')->get();  
            $data = User::select('project__developer__assignments.developer_id', 'project_stages.name as projects_stage_name', 'projects.name as projects_name', 'users.name as developer_name')
                        ->join('project__developer__assignments', 'project__developer__assignments.developer_id', '=', 'users.id')
                        ->join('projects', 'projects.id', '=', 'project__developer__assignments.project_id')
                        ->join('project_stages', 'project_stages.id', '=', 'projects.project_stage_id') 
                        ->where('projects.project_stage_id',$project_stage)
                        ->where('project__developer__assignments.developer_id',$dev_id)
                        ->get()
                        ->groupBy('developer_name')
                        ->map(function ($items, $key) {
                            $mergedItem = $items->first();
                            $mergedItem['projects_stage_name'] = $items->pluck('projects_stage_name')->implode('<br> ');
                            $mergedItem['projects_name'] = $items->pluck('projects_name')->unique()->implode('<br> ');

                            return $mergedItem;
                        })
                        ->values()
                        ->toArray();
           
        }
        
        return view('report.leader.assign_project',compact('data','stage','name','is_active'));
    }
    public function report_reset(){
        session()->forget('project_stage_id');
        session()->forget('name');
        // return redirect()->route('report.user');
        return redirect('/report/projects');
    }
    public function history()
    {   
        $is_active = "developer_worked";
        $type = session()->get('type');
        $data = [];
        if($type == 'leader')
        {  
        $dev_name = User::where('type','developer')->get();
        return view('report.leader.history',compact('dev_name','data','is_active'));
        }
        else {
            $data = [];
            return redirect('/report');
        }
        
    }
    public function history_report(Request $request)
    {   
        $is_active = "developer_worked";
        $daterange = $request->shdaterange;
        $dev_id = $request->name;
        $data = [];
        $dev_name = [];
        if($daterange != null && $dev_id == null)
        {    
            session()->put('search_date', $daterange);
            $f = trim(explode("-",$daterange)[0]," ");
            $t = trim(explode("-",$daterange)[1]," ");
            $from = \Carbon\Carbon::createFromFormat('m/d/Y', $f)->format('Y-m-d'.' 00:00:00');
            $to = \Carbon\Carbon::createFromFormat('m/d/Y', $t)->format('Y-m-d'.' 23:59:59');
            $dev_name = User::where('type','developer')->get();  
            $data = WeeklyReports::select('weekly_reports.project_id', 'project_stages.name as projects_stage_name', 'projects.name as projects_name', 'users.name as developer_name')
                                ->join('users', 'users.id', '=', 'weekly_reports.developer_id')
                                ->join('projects', 'projects.id', '=', 'weekly_reports.project_id')
                                ->join('project_stages', 'project_stages.id', '=', 'projects.project_stage_id')
                                ->whereBetween('weekly_reports.created_at', [$from, $to])
                                ->get()
                                ->groupBy('developer_name')
                                ->map(function ($items, $key) {
                                    $mergedItem = $items->first();
                                    $mergedItem['projects_stage_name'] = $items->pluck('projects_stage_name')->implode('<br> ');
                                    $mergedItem['projects_name'] = $items->pluck('projects_name')->unique()->implode('<br> ');
                            
                                    return $mergedItem;
                                })
                                ->values()
                                ->toArray();

        }
        elseif($daterange !=null && $dev_id != null){
            
            session()->put('dev_id',  $dev_id);
            session()->put('search_date', $daterange);
            $f = trim(explode("-",$daterange)[0]," ");
            $t = trim(explode("-",$daterange)[1]," ");
            $from = \Carbon\Carbon::createFromFormat('m/d/Y', $f)->format('Y-m-d'.' 00:00:00');
            $to = \Carbon\Carbon::createFromFormat('m/d/Y', $t)->format('Y-m-d'.' 23:59:59');
            $dev_name = User::where('type','developer')->get();
            $data = WeeklyReports::select('weekly_reports.project_id', 'project_stages.name as projects_stage_name', 'projects.name as projects_name', 'users.name as developer_name')
                                ->join('users', 'users.id', '=', 'weekly_reports.developer_id')
                                ->join('projects', 'projects.id', '=', 'weekly_reports.project_id')
                                ->join('project_stages', 'project_stages.id', '=', 'projects.project_stage_id')
                                 ->where('weekly_reports.developer_id',$dev_id)
                                ->whereBetween('weekly_reports.created_at',[$from, $to])
                                ->get()
                                ->groupBy('developer_name')
                                ->map(function ($items, $key) {
                                    $mergedItem = $items->first();
                                    $mergedItem['projects_stage_name'] = $items->pluck('projects_stage_name')->implode('<br> ');
                                    $mergedItem['projects_name'] = $items->pluck('projects_name')->unique()->implode('<br> ');
                                    return $mergedItem;
                                })
                                ->values()
                                ->toArray();
          
        }

        return view('report.leader.history',compact('data','dev_name','is_active'));
    }
    public function report_reset1(){
        session()->forget('search_date');
        session()->forget('dev_id');
        // return redirect()->route('report.user');
        return redirect('/history');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {  
        $is_active = "";
        $data = WeeklyReports::where('id', $id)
                ->first();
          return view('report.leader.edit',compact('data','is_active'));      
    }

   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
    //    dd($request->all());
       $id =  $request->report_id;
       if($request->task_completed == null){
        DB::table('weekly_reports')
        ->where(function ($query) use ($id, $id1) {
            $query->where('id', $id);
        })
        ->update(['task_completed' => '-']);
       }
        else {
        DB::table('weekly_reports')
        ->where(function ($query) use ($id) {
            $query->where('id', $id);
        })
        ->update(['task_completed' => $request->task_completed]);

       }
        $message = ' Weekly Report Updated .';

        return redirect()->route('report.show')->with('message', $message); 
         
    }

    public function edit_dev ($project_id,$developer_id)
    {
     
        $is_active = "";
        $data = WeeklyReports::where('project_id', $developer_id)
                ->where('developer_id', $project_id)
                ->latest('created_at')
                ->first();
          return view('report.developer.edit',compact('data','is_active')); 
    }
    public function edit_dev_save(Request $request)
    {
        
        $id =  $request->developer_id;
        $id1 = $request->project_id;
        $id2 = $request->report_id;
        DB::table('weekly_reports')
             ->where(function ($query) use ($id, $id1,$id2) {
                 $query->where('developer_id', $id)
                     ->where('project_id', $id1)
                     ->where('id', $id2);
             })
             ->update(['task_completed' => $request->task_completed]);
 
             $message = 'Weekly Report Updated .';
 
             return redirect()->route('report.index')->with('message', $message);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
