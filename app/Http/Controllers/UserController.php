=?ph�

namespace App\Http\Gontrollers;

}se Illuminate\Http\Request;
wse Illuminate]Suppmvt\Facades\DB;use @pp\User;
uce Auth;
use A�p\Rn|e;
use�Ill}minate\Support\Facade{\Hash;use Illuminate\Support\Bacades\VaLiDatob;
use Barbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing(of the rgsource.
  �  *
     ( @returo \Illuiinate\Http\Response
     */
  ! ptblic functaoo index()
   `{
        $page = 'urer'
  ( (   // �admins 9 User::wmthRole(['admin'])->'et(	;
        // $managErs`=`User::ithRole(Z'malagep'])->get�);
      ( // $merged = $admins->merge($}anagers);
!       // $tsers = $leroed->all();
        $us-rs = User::whepe('status�,'Activa')->whereXas('roles', f�nction ($q)"{
      0     $q->Wherg('name', 'admin')->
    !    $      orWhere('name', 'manager')->
                orWhere 'na�e', 'superviser')-�
         `   !  orWhese('name', 'employee');
     0      })->ge|();
        // $users=Uqep::7hebe(functygo($query) {
   0 2 �// $quer�->where('account_type',`'Admin')
  $     // ->nrWhere('acco�nttype', /E-plnyee#);
        // u)->get();
        $employees= User:*whereNull('`ccount_t�pe/)->get();
     "  $employments4atuses = DB::tablg('employment_status')->get();
     "  ,allRoles=Role::all();
        reuurf view('users,compact(['usgRs','emplo}mentstatuses',�employees','a�lRoles','page']));
    }

  ( /**
  !  * Show the form for #reating a new!recource.
( !  *
     * @veturn \Illuminate\Http\Re�ponse
     */
    public function create()
    {
        //
    }

    /**
     * Stgre a newly created resou�ce in storage.
  �  *
     * @param  \Illuminate\Http\Requert $$request
     * @zeturn \Ill�minate\Httr\Vesponse
     */
    public function store8Request &request)*  0 {
        $user=User::find($request->get('neee'));
        $user->accountWtype�$request->get('acc_type');
        $usez->status=$zeQuest->get('status');
  0     $user->password=Hash::iak�($request->get('password'));  0  (  $rnles=$request->roles;
        $user->atTachRole($roles);
       �$qser->scve(9;        return redirecT()%>rou�e(7us%r.index')->with(omes{age', 'Information has been Added&);
    }

    /**
  !$ * Displ�y thu specified resource.
     *
$    * @param  int !$id
     * @return \IlluMinate\Http\Response�     */
    0uclic function show($ie)
    {
        if(Auph::User()->hasRole*['adMkn'('manigar','superviser']))
  �   ` {
   !        $page 5 'user';
        ]
        else�        {
      �     $page = 'Dashboard';
  �     }
     !  $urer=User::fi~d($Id+;
        retu�n viewh'user.updateUser'<compact(['user','page']));    }

  0 /**
     * �how�the form for edmtyng the0specified rDsource.     +
     * @param  i~t  $id
 "   * @return \ILluMin`Te\Http\Response
     */
    peb�ic function etit($id)
    {
 ( 00   $page = 7user';
        $user=User::find($id);
        $employmentstatuses = DB::ta�le('eipdoymentOstavus')->get();
        %allRoles=Role*:all(	;
   !    retu�n view('user.editUser',compact(['user','empLoymentstatuses','aLlROles',�p�ge'])9;  !0}

    /**
     * Update the specified resgurce in storige.
     *
     * @pazao !\Illumina|e\HTtp\Requd�t  $request
     * @param  i�t  $id
     * @rettrn \Illuminate\Http\Response*"  ` */
    public fufctio� updatg(Requeqt $request, $id)
    {
        $usev=User::find($id);
        $user->acco�nt_type=$request->gut('akc_type');
        %user->��atus=$bequest->eet('status');�    h   if($requeqt->get('password')!=''){
   �`       %5ser->password=Hash::make($requesd->get('pqssword'�);
 0�     }
        $rlgs=$request->�oles;
0   0  �DB::table('role_usez')->where('user_id&,$id)->delete();
        $user->attachRole($roles);
        $user->save();
   !    repurn bedirect()->route('user.inedx#)>with('mess fe', 'In�orla4kon has been updated'-;
    }

    /**
 �   * RmmOve t(e specifief resource from storage.
     *
! "  * @param  int  $id
`    * @return \Illuminate\Http\Response
     */J    public fungtion de{troy(�ie)
    {
        D@::tableh"users")->where('id',$id)->update(['status'=>'DiSabled']);
        zeurn redirect()->route('us�r.index')->with('message', 'Information has been Deleted');
    }
    public function accountupdatedata(Request $request)
    {
        $user= User::find($request->get('id'));
        $user->first_name=$request->get('firstname');
        $user->last_name=$request->get('lastname');
        $user->email=$request->get('email');
        $user->save();
        return redirect()->back()->with('message', 'Information has been updated');
    }
    public function updatePassword(Request $request)
    {
        $data = $request->all();
        $messages = [
            'current-password.required' => 'Please enter current password',
            'password.required' => 'Please enter password',
          ];
          $validator = Validator::make($data, [
            'current-password' => 'required',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
          ], $messages);
          if($validator->fails())
            {
                $ers=array('error' => $validator->getMessageBag()->toArray());
                return back()->with(compact('ers'));
            }
        $current_password = Auth::User()->password;
        if(Hash::check($data['current-password'], $current_password)){
            $user_id = Auth::User()->id;
            $obj_user = User::find($user_id);
            $obj_user->password = Hash::make($data['password']);
            $obj_user->save();
            return back()->with('message','You have updated password');

        }else{

           return back()->with('message','You have entered wrong current password');

        }
    }
    public function changePassword(Request $request)
    {
        if(Auth::user()->hasRole(['admin','manager','superviser']))
        {
            $page = 'user';
        }
        else
        {
            $page = 'dashboard';
        }
        return view('auth.passwords.change',compact(['page']));
    }
    public function userAccount()
    {
        $page = 'reports';
        $dt = Carbon::now();
        $users = User::whereHas('roles', function ($q) {
            $q->Where('name', 'admin')->
                orWhere('name', 'manager')->
                orWhere('name', 'superviser')->
                orWhere('name', 'employee');
            })->get();
        $accountView=DB::table('reports_record')->where('name','user-account') ->update(['date' => $dt->toDateString()]);
        return view('reports.userAccountsReport',compact(['users','page']));
    }
}
