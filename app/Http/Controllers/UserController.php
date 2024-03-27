<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Technologies;
use App\Models\Roles;
use App\Models\Developer_Skills;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use DB;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $is_active = "user_list";
        $data = DB::table('users')
                    ->select('users.id','users.points','users.status','users.name' ,'users.type', 'users.employee_id', 'users.email', 'users.phone_number',
                        DB::raw("(SELECT GROUP_CONCAT(CONCAT(technologies.name, ' (', developer__skills.expertise_level, ')') SEPARATOR '<br>')
                                FROM developer__skills
                                INNER JOIN technologies ON technologies.id = developer__skills.technology_id
                                WHERE developer__skills.developer_id = users.id) as skills"))
                    ->orderBy('users.name', 'asc')            
                     ->get();

          
        return view('user.index',compact('data','is_active'));
    }
   public function update_profile($id)
   {  
        $is_active = "user_create";
        $data = User::where('id',$id)->first();
        return view('user.edit_profile',compact('data','is_active'));
   }
   public function update_profile_store(Request $request)
   {   
       $id = $request->user_id;
       $profile_picture = "";

       $data = User::findOrFail($id);
       $data->name = $request->name;
       $data->employee_id = $request->employee_id;
       $data->phone_number = $request->phone_number;
       if($request->profile_picture !== null) 
       {
           $profile_picture = date('YmdHis') . "_" . mt_rand(1, 999999) . "." . $request->file('profile_picture')->getClientOriginalExtension();

           $pdf_path = $request->file('profile_picture')->move('app/user', $profile_picture);
           
           $profile_picture =  'user'.'/'.$profile_picture;
       }
       else {
           $profile_picture = "";
       }

       $data->profile_picture = $profile_picture;
       $data->save();

        $message = 'Info Updated Successfully';

        return redirect()->route('user.update_profile', ['id' => $id])->with('message', $message);
   }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   $is_active = "user_create";
        $techno = Technologies::get();
        return view('user.adduser',compact('techno','is_active'));
    }
    
    public function pass_change()
    {   
        $is_active = "pass_change";
        return view('settings.password_change',compact('is_active'));
    }
    public function pass_store(Request $request){
        
        $user = Auth::user();

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
        ]);

        if (!Hash::check($request->old_password, $user->password)) {

             return redirect()->back()->withErrors(['old_password' => 'Old Password do not match our records.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        $message = 'Successful! Password Updated';

        return redirect()->route('developer.pass_change')->with('message', $message);

    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {  
        
        $this->validate($request, [
            'type' => 'required',
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required',
            'profile_picture' =>  'max:30000|mimes:jpg,png,jpeg',
            'points' => 'numeric|min:0',
        ], [
            'points.min' => 'Points field value cannot be negative',
        ]
    );
        
 
    if ($request->type == 'developer')
    {   
        $profile_picture = "";
        $data = new User();

        $data->type = $request->type;
        $data->name = $request->name;
        $data->employee_id = $request->employee_id;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);
        $data->phone_number = $request->phone_number;
        
        if($request->profile_picture !== null) 
        {
            $profile_picture = date('YmdHis') . "_" . mt_rand(1, 999999) . "." . $request->file('profile_picture')->getClientOriginalExtension();

            $pdf_path = $request->file('profile_picture')->move('app/user', $profile_picture);
            
            $profile_picture =  'user'.'/'.$profile_picture;
        }
        else {
            $profile_picture = "";
        }

        // $profile_picture = date('YmdHis') . "_" . mt_rand(1, 999999) . "." . $request->file('profile_picture')->getClientOriginalExtension();

        // $pdf_path = $request->file('profile_picture')->move('app/user', $profile_picture);
        
        // $profile_picture =  'user'.'/'.$profile_picture;

        $data->profile_picture = $profile_picture;

        $data->description = $request->description;

        $data->points = $request->points;

        $data->status = 1;
        
        $data->save();
       
        $techno = $request->technology_id;
        $exper = $request->expertise_level;
        $developerIds_id = $data->id;
        
        if(!empty($techno) && !empty($exper)){
            for($i=0;$i<count($techno);$i++)
            {   
                if (!empty($techno[$i])) {
                $list =[
                'developer_id' =>  $developerIds_id ,
                'technology_id' =>  $techno[$i],
                'expertise_level' => $exper[$i],
                ];
            
            DB::table('developer__skills')->insert($list);
            }
        }
        }
      } 
    else {

        $profile_picture = "";
        $data = new User();

        $data->type = $request->type;
        $data->name = $request->name;
        $data->employee_id = $request->employee_id;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);
        $data->phone_number = $request->phone_number;

        if($request->profile_picture !== null) 
        {
            $profile_picture = date('YmdHis') . "_" . mt_rand(1, 999999) . "." . $request->file('profile_picture')->getClientOriginalExtension();

            $pdf_path = $request->file('profile_picture')->move('app/user', $profile_picture);
            
            $profile_picture =  'user'.'/'.$profile_picture;
        }
        else {
            $profile_picture = "";
        }

        // $profile_picture = date('YmdHis') . "_" . mt_rand(1, 999999) . "." . $request->file('profile_picture')->getClientOriginalExtension();

        // $pdf_path = $request->file('profile_picture')->move('app/user', $profile_picture);
        
        // $profile_picture =  'user'.'/'.$profile_picture;

        $data->profile_picture = $profile_picture;

        $data->description = $request->description;

        $data->status = 1;
        
        $data->save();
    }
        

        $message = ' New User has been added in your system.';

        return redirect()->route('user.create')->with('message', $message);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
    public function technology()
    {   
        $is_active = "tech_set";
        $data = Technologies::get();
        return view('user.technology',compact('data','is_active'));
    }
    public function technology_store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            
        ]);
        $data = new Technologies();
        $data->name = $request->name;
        $data->save();

        $message = ' New Technologies  has been added in your system.';

        return redirect()->route('developer.technology')->with('message', $message);

    }
    public function technology_delete($id)
    {
        
        DB::table('technologies')->where('id', $id)->delete();

        $message = 'Technology delete successfully.';

        return redirect()->route('developer.technology')->with('message', $message);         

    }
    public function techno()
    {
       $projects =  Technologies::get();
    
    return response()->json($projects);
    }

    public function role()
    {   
        $is_active = "role_set";
        $data = Roles::get();
        return view('user.role',compact('data','is_active'));
    }
    public function role_store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            
        ]);
        $data = new Roles();
        $data->name = $request->name;
        $data->save();

        $message = ' New Role  has been added in your system.';

        return redirect()->route('developer.role')->with('message', $message);

    }
    public function role_delete($id)
    {
        
        DB::table('roles')->where('id', $id)->delete();

        $message = 'Role delete successfully.';

        return redirect()->route('developer.role')->with('message', $message);         

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {   
        $is_active = "";
        $techno = Technologies::get();
        $exp = Developer_Skills::get();
        
        $data = DB::table('users')
                   ->select('users.id','users.points','users.profile_picture','users.type','users.name',  'users.employee_id', 'users.email', 'users.phone_number',
                    DB::raw('GROUP_CONCAT(technologies.name) as techno_name'),
                    DB::raw('GROUP_CONCAT(developer__skills.developer_id) as dev_id'),
                    DB::raw('GROUP_CONCAT(developer__skills.id) as ds_id'),
                    DB::raw('GROUP_CONCAT(developer__skills.expertise_level) as expertise_level'),)
                    ->leftjoin('developer__skills','developer__skills.developer_id','=','users.id')   
                    ->leftjoin('technologies','technologies.id','=','developer__skills.technology_id')
                    ->groupBy('users.points','users.id','users.type','users.name',
                    'users.employee_id', 'users.email','users.profile_picture','users.phone_number')    
                    ->where('users.id',$id)           
                    ->first();
        return view('user.edit',compact('data','techno','exp','is_active'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {   

        $this->validate($request, [
         
            'phone_number' => [
                
                Rule::unique('users')->ignore($request->user_id),
            ],
            
        ]);
        
        $userID = $request->user_id;
        $profile_picture = "";
        $data = User::findOrFail($userID);
        $data->name = $request->name;
        $data->employee_id    = $request->employee_id;
        $data->phone_number    = $request->phone_number;
        if($request->profile_picture !== null) 
        {
            $profile_picture = date('YmdHis') . "_" . mt_rand(1, 999999) . "." . $request->file('profile_picture')->getClientOriginalExtension();

            $pdf_path = $request->file('profile_picture')->move('app/user', $profile_picture);
            
            $profile_picture =  'user'.'/'.$profile_picture;
        }
        else {
            $profile_picture = "";
        }
        $data->profile_picture = $profile_picture;
        $data->points    = $request->points;
        $data->save();

        $techno = $request->technology_id;
        $exper = $request->expertise_level;
        $ds_id1 = $request->ds_ID;
        $dev_ids = $request->developer_id;
       
        $ds_id_str = implode(',',$ds_id1);
        $ds_id1     = explode(',',$ds_id_str);
        $ds_id =  array_slice($ds_id1, 0, 1);


        $dev_id_str = implode(',', $dev_ids);
        $dev_id = explode(',', $dev_id_str);
        
        if(!empty($techno) && !empty($exper)){
        if (empty(array_filter($dev_id))) {
            foreach ($techno as $key => $value) {
                DB::table('developer__skills')->insert([
                    'developer_id' => $userID,
                    'technology_id' => $value,
                    'expertise_level' => $exper[$key],
                ]);
            }
        } 
        else 
        {   
            foreach ($techno as $key => $value) {
                $developer_skills = DB::table('developer__skills')
                    ->where('developer_id', $userID)
                    ->where('technology_id', $value)
                    ->first();
                if ($developer_skills) {
                    DB::table('developer__skills')
                        ->where('developer_id', $userID)
                        ->where('technology_id', $value)
                        ->update([
                            'expertise_level' => $exper[$key],
                        ]);
                } else {
                    DB::table('developer__skills')
                        ->insert([
                            'developer_id' => $userID,
                            'technology_id' => $value,
                            'expertise_level' => $exper[$key],
                        ]);
                }
            }
        }
    }

        
        $message = 'Info Added Successfully';

        return redirect()->route('user.index')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function status($id)
    {
        $userID = User::findOrFail($id);
  

        if($userID->status == 1)
        {
            $data = User::findOrFail($id);
            $data->status = 0;
            $data->save();
        }
        else {
            $data = User::findOrFail($id);
            $data->status = 1;
            $data->save();
        }
        $message = 'Status Change Successfully';

        return redirect()->route('user.index')->with('message', $message);
    }
}
