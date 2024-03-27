<?php

namespace App\Http\Controllers;
use App\Models\ProjectStages;
use App\Models\Projects;
use App\Models\Roles;
use App\Models\User;
use App\Models\Project_Developer_Assignment;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        $is_active = "project_list";
        $type = session()->get('type');
        $data = [];
        if($type == 'leader')
        {  
            $data = DB::table('projects')
                        ->select('projects.id','projects.name',  'projects.timeline', 'projects.customer_name', 'project_stages.name as project_stage_name', 'projects.project_stage_id',  'projects.rep_link',
                        DB::raw("GROUP_CONCAT(CONCAT(users.name, ' (', roles.name, ')') SEPARATOR '<br>') as pro_name"))
                        ->leftJoin('project__developer__assignments', 'project__developer__assignments.project_id', '=', 'projects.id')
                        ->leftJoin('users', 'users.id', '=', 'project__developer__assignments.developer_id')
                        ->leftJoin('roles', 'roles.id', '=', 'project__developer__assignments.role_id')
                        ->leftJoin('project_stages', 'project_stages.id', '=', 'projects.project_stage_id')
                        ->groupBy('projects.id','projects.name','projects.timeline', 'projects.customer_name', 'projects.project_stage_id','projects.rep_link','project_stage_name')
                        ->get();
        }
        else{
           
            $data = [];
        }

        return view('projects.project.index',compact('data','is_active'));
    }

        public function fetchName($id)
        {
            $name = ProjectStages::find($id)->name;
            return response()->json($name);
        }

        public function assign($id)
        {   
            $is_active = "";
            $data1 = Project_Developer_Assignment::where('project_id',$id)->pluck('developer_id');
            $data = User::select('id','name')->where('type',"developer")->whereNotIn('id',$data1)->get();
            $roles = Roles::select('id','name')->get();
            return view('projects.project.assign',compact('data','id','roles','is_active'));
        }
        
        public function assign_store(Request $request)
        {   
            $developer_id = $request->developer_id;
            $project_id = $request->project_id;
            $role_id = $request->role_id;
              
        for($i=0;$i<count($developer_id);$i++)
        {   
           
            $list =[
            'project_id' =>  $project_id,
            'developer_id' =>  $developer_id[$i],
            'role_id' => $role_id[$i],
            ];
        
           DB::table('project__developer__assignments')->insert($list);
        }
         $message = ' Developer and his role has been assigned in this Project';

        return redirect()->route('project.index')->with('message', $message);

        }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $is_active = "create_project";
        $type = session()->get('type');
        $data = [];
        if($type == 'leader')
        {  
        $data = ProjectStages::select('id','name')->get();
        return view('projects.project.add',compact('data','is_active'));
        }
        else{
        
            $data = [];
            return redirect()->route('login');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
         
        $this->validate($request, [
            'name' => 'required',
            'project_stage_id' => 'required',
            'srs_pdf' =>  'max:30000|mimes:pdf',
        ]);
   
    
        $pdf_name = "";
        $data = new Projects();
        $data->name = $request->name;
        $data->client_spoke_name = $request->client_spoke_name;
        $data->client_spoke_mobile = $request->client_spoke_mobile;
        $data->client_spoke_email = $request->client_spoke_email;
        $data->miaki_spoke_name = $request->miaki_spoke_name;
        $data->miaki_spoke_mobile = $request->miaki_spoke_mobile;
        $data->miaki_spoke_email = $request->miaki_spoke_email;
        $data->customer_name = $request->customer_name;
       
        if($request->file('srs_pdf') !== null){

            $pdf_name = date('YmdHis') . "_" . mt_rand(1, 999999) . "." . $request->file('srs_pdf')->getClientOriginalExtension();

            $pdf_path = $request->file('srs_pdf')->move('app/projects', $pdf_name);
            
            $pdf_name =  'projects'.'/'.$pdf_name;

        }
        else 
        {
            $pdf_name="";
        }
       

        $data->srs_pdf = $pdf_name;

        $data->ui_ux_link = $request->ui_ux_link;

        $data->rep_link = $request->rep_link;

        $data->timeline = $request->timeline;

        $data->remarks = $request->remarks;

        $data->project_stage_id = $request->project_stage_id;
        
        $data->save();

        $message = ' New Project has been added in your system.';

        return redirect()->route('project.index')->with('message', $message);
    }
    public function project_edit($id)
    {   
        $is_active = "";
        $stage = DB::table('project_stages')->get();
        $dev =  DB::table('users')->get();
        $roles =  DB::table('roles')->get();
        $data = DB::table('projects')
                    ->select('projects.id','projects.name',  'projects.timeline', 'projects.customer_name',
                     'project_stages.name as project_stage_name', 'projects.project_stage_id',  
                     'projects.rep_link','projects.client_spoke_name','projects.client_spoke_mobile',  
                     'projects.client_spoke_email', 'projects.miaki_spoke_name','projects.miaki_spoke_mobile',
                     'projects.miaki_spoke_email',  'projects.ui_ux_link','projects.srs_pdf',
                    DB::raw('GROUP_CONCAT(users.name) as pro_name'),
                    DB::raw('GROUP_CONCAT(roles.name) as role_name'))
                    ->leftJoin('project__developer__assignments', 'project__developer__assignments.project_id', '=', 'projects.id')
                    ->leftJoin('users', 'users.id', '=', 'project__developer__assignments.developer_id')
                    ->leftJoin('roles', 'roles.id', '=', 'project__developer__assignments.role_id')
                    ->leftJoin('project_stages', 'project_stages.id', '=', 'projects.project_stage_id')
                    ->groupBy('projects.id','projects.name','projects.timeline', 'projects.customer_name', 'projects.project_stage_id','projects.rep_link','project_stage_name',
                    'projects.client_spoke_name','projects.client_spoke_mobile',  
                    'projects.client_spoke_email', 'projects.miaki_spoke_name',
                    'projects.miaki_spoke_mobile','projects.miaki_spoke_email',  'projects.ui_ux_link','projects.srs_pdf')
                    ->where('projects.id',$id)
                    ->first();
        $pda_ids = Project_Developer_Assignment::select('id') 
                                                ->where('project_id', $id)
                                                ->get()->toArray();
  
       return view('projects.project.edit',compact('data','stage','dev','roles', 'pda_ids','is_active'));
    }


    public function project_edit_store(Request $request)
    {
       
        $pro_id = $request->project_id;
        $pdf_name = "";
        $data = Projects::findOrFail($pro_id);
        $data->name = $request->name;
        $data->customer_name    = $request->customer_name;
        $data->client_spoke_name = $request->client_spoke_name;
        $data->client_spoke_mobile    = $request->client_spoke_mobile;
        $data->client_spoke_email = $request->client_spoke_email;
        $data->miaki_spoke_name    = $request->miaki_spoke_name;
        $data->miaki_spoke_mobile = $request->miaki_spoke_mobile;
        $data->miaki_spoke_email    = $request->miaki_spoke_email;
        
        // $pdf_name = date('YmdHis') . "_" . mt_rand(1, 999999) . "." . $request->file('srs_pdf')->getClientOriginalExtension();

        // $pdf_path = $request->file('srs_pdf')->move('app/projects', $pdf_name);
        
        // $pdf_name =  'projects'.'/'.$pdf_name;

        // $data->srs_pdf = $pdf_name;

        if($request->file('srs_pdf') !== null){

            $pdf_name = date('YmdHis') . "_" . mt_rand(1, 999999) . "." . $request->file('srs_pdf')->getClientOriginalExtension();

            $pdf_path = $request->file('srs_pdf')->move('app/projects', $pdf_name);
            
            $pdf_name =  'projects'.'/'.$pdf_name;

        }
        else 
        {
            $pdf_name="";
        }
        
        $data->srs_pdf = $pdf_name;
        $data->rep_link = $request->rep_link;
        $data->ui_ux_link    = $request->ui_ux_link;
        $data->timeline  = $request->timeline;
        $data->project_stage_id = $request->stage_id;
        $data->save();
       
        $developerIds = $request->developer_id;
        $roleIds = $request->role_id;
        
        if(!empty($roleIds) && !empty($developerIds)){
           for($i=0;$i<count($roleIds);$i++)
                {   
                    $pdaId = $request->input('project_id_'.$i);
                    $previousRole = Project_Developer_Assignment::where('id', $pdaId)
                                                              ->first();
                    
                    $list =[
                    'developer_id' =>  $developerIds[$i],
                    'role_id' => $roleIds[$i]
                    ];
                   
                DB::table('project__developer__assignments')->where('project_id', $pro_id)
                                                            ->where('developer_id', $developerIds[$i])
                                                            ->update($list);
                }
            }
        $message = 'Info updated successfully.';

        return redirect()->route('project.index')->with('message', $message);
    }

    public function view_pro_info($userId)
    {   

        $data = DB::table('projects')
                    ->select('projects.id','projects.name','projects.customer_name','projects.timeline',
                     'projects.customer_name', 'project_stages.name as project_stage_name',
                      'projects.project_stage_id',  'projects.rep_link','projects.client_spoke_name',
                      'projects.client_spoke_mobile',  'projects.client_spoke_email', 
                      'projects.miaki_spoke_name','projects.miaki_spoke_mobile','projects.miaki_spoke_email',  
                      'projects.ui_ux_link','projects.srs_pdf','projects.rep_link',
                    DB::raw("GROUP_CONCAT(CONCAT(users.name, ' (', roles.name, ')') SEPARATOR '<br> ') as pro_name"))
                    ->leftJoin('project__developer__assignments', 'project__developer__assignments.project_id', '=', 'projects.id')
                    ->leftJoin('users', 'users.id', '=', 'project__developer__assignments.developer_id')
                    ->leftJoin('roles', 'roles.id', '=', 'project__developer__assignments.role_id')
                    ->leftJoin('project_stages', 'project_stages.id', '=', 'projects.project_stage_id')
                    ->groupBy('projects.id','projects.name','projects.timeline', 'projects.customer_name', 'projects.project_stage_id','projects.rep_link','project_stage_name',
                    'projects.client_spoke_name','projects.customer_name','projects.client_spoke_mobile',  'projects.client_spoke_email', 'projects.miaki_spoke_name','projects.miaki_spoke_mobile','projects.miaki_spoke_email'
                    ,  'projects.ui_ux_link','projects.srs_pdf','projects.rep_link',)
                    ->where('projects.id',$userId)
                    ->first();
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function stage()
    {  
        $is_active = "create_stage";
        $type = session()->get('type');
        if($type == 'leader')
        { 
            $data =  ProjectStages::get();
        return view('projects.project.stage',compact('data','is_active'));
        }
        else {
            return redirect()->route('login');
        }
    }
    public function stage_store(Request $request,)
    {
        $this->validate($request, [
            'name' => 'required',
            
        ]);
        $data = new ProjectStages();
        $data->name = $request->name;
        $data->save();

        $message = 'New Project Stage has been added in your system.';

        return redirect()->route('project.stage')->with('message', $message);

    }
    
    public function stage_delete($id)
    {
        
        DB::table('project_stages')->where('id', $id)->delete();

        $message = 'Stage delete successfully.';

        return redirect()->route('project.stage')->with('message', $message);         

    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
