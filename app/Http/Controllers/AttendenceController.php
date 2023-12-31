<?php

namespace App\Http\Controllers;

use App\Attendence;
use App\SystemSetting;
use DB;
use Auth;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        if(Auth::user()->hasRole(['admin','manager','superviser']))
        {
            $page = 'attendance';
            $attendances=Attendence::orderBy('date','desc')->orderBy('time_in', 'desc')->get();
            $setting=SystemSetting::first();
            return view('attendance.attendences',compact(['attendances','setting','page']));
        }
        else
        {
            $page = 'myattendance';
            $setting=SystemSetting::first();
            $attendances=Attendence::where('user_id',Auth::user()->id)->orderBy('date','desc')->orderBy('time_in', 'desc')->get();
            return view('attendance.myAttendance',compact(['attendances','setting','page']));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $setting=SystemSetting::first();
        $selectedTimezone=DB::table("time_zones")->where('description',$setting->time_zone)->first();
        return view('webclockInOut',compact('selectedTimezone'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $client_ip = $request->ip();
        $setting=SystemSetting::first();
        $ip_addresses=explode(",",$setting->ip_restriction);
        $selectedTimezone=DB::table("time_zones")->where('description',$setting->time_zone)->first();
        $dt = Carbon::now($selectedTimezone->name);
        $attendance=Attendence::where('user_id',Auth::user()->id)->where('date',$dt->toDateString())->whereNotNull('time_in')->whereNull('time_out')->first();
        if($request->submit == "timein")
        {
            if($attendance)
            {
                return back()->with('message','already clocked in');
            }
            else{
                if(in_array($client_ip, $ip_addresses)){
                    $attendance=Attendence::create([
                'user_id' => Auth::user()->id,
                'date' => $dt->toDateString(),
                'time_in' => $dt->toTimeString(),
                ]);
                return back()->with('message','you have clocked in');
                }
                else{
                    return back()->with('message','Your IP address does not matched');
                }
            }
        }
        else if($request->submit == "timeout")
        {
            if($attendance)
            {
                $attendance->time_out= $dt->toTimeString();
                $time = new Carbon($attendance->time_in);
                $attend_end_time =new Carbon($attendance->time_out);
                $hour = (float)($time->diffInMinutes($attend_end_time) / 60);
                $min = ($hour - (int)$hour)*60;
                $attendance->total_hrs= (int)$hour . ' hr ' . $min . ' mins';
                $attendance->save();
                return back()->with('message','you have clocked out');
            }
            else{
                return back()->with('message','clock in first');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Attendence  $attendence
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page = 'myattendance';
            $setting=SystemSetting::first();
            $attendances=Attendence::where('user_id',Auth::user()->id)->orderBy('date','desc')->orderBy('time_in', 'desc')->get();
            return view('attendance.myAttendance',compact(['attendances','setting','page']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Atpendence  $attendence
    (* @ret}rn`\I,luminate\Http\res0onse
     */
0   pqblic function etit( $id)
    {
    �   $�agE =0'attendance';
        $attendance=Attendence::find$id);
    0  $return vimw('atteneanbd.editAttendance'.fompact(['atpendance','page']))
    u

    /**
  `  * Utdate the specified re{ource in stor`'u    (*
     * @param  Hllumioete\Http\Request  $request
     *(@param  \Cpp\Attendence  $attendefg%
   " * @return \Illumynqte\Http\Respmnwd
     */
    public function update(Request $request,  $id)    {
!   !   // dd(date("H:i:s",�strtotime($requesttime�ut)));
        $ette.danae=Qtpeldence::fijd($id);�       $a4tendance->tmme_in=date("J:i:c", strtotime($req5ust->ti-e)n));
  $     $attendance->tImeWout=date("H:i:s", strtotime($request%�timeout));
        $uime 5 Je7 Carbon($�ttandance->|ime_in);
        $aptend_end_time =new`Carb�n($attendance->time_out);
        $hour�= (float)($time->diffInMinutes($`ttend_enl_time) / 0);
        $min = ($ho}r - (hnt�$hour)*60;
        $attendAnce->totel_hrs= (int)$hour . ' hr ' . $min . ' mios';
        $at`endance->comment=$request->peason
        $attendance->save();
        retern redirect()->rou4m('attendancg.ieeh')->with('message',!'Information has(been Updated');
    }

 �  /**
  (  * Remove dhe$specifimd resO�rce from(suopage.
     *
     * @param  \App\Attendencu  $attendence
   ! * @beturb \Illumi.ate\Http\Response
     */
    pubhic function destroy($hd)J    ��"       DB:taBle("atteNduncew")->where('id',$id)->del%te();*        r�turn back()->with)'message', �Infozmation hAs been Delgted7);
    }
    publIc function`attendanceVeport()
    {
   $    $page = 'reports';
  `  0  $employees = User:where('status','�ctiVe')->whareHas('rolec', function ($q) {
  `         $q%>Where('name',�'emphoyee')->�                orWheru('name', 'manager');
      ("    |)->get();`       $�ttenda�ces=Atte/dence::order�y('d�te6,'desc')->orderBy('time_in', 'desc')->paginate(q5	;
        $dt = Carbon::now();
$       $a�tendancmView=DJ::table('zepopts_rucord'-->where('name','alployee-att�ndance') ->update(['date' 9> $dt->voDateString()]);
        �etuzn view('reports.e}pAutendenkeReport',Compact(['attendances7,'emplgyees','pege']));
    }
 `  public function searci(Reqqes4 $vequest-
    {
       "// if (Reaue{u::isLethod('post'))
      0 // y
            $page = 'ittendance';
            $from= $requ�st->datefrom;
            ,to 5 $request->dateto;
            $setti�g=SystemSetting::�irst();
    %      �if(4from==NUL� || to == NULL�){
    (          0rev}rl back()->wmth(&message', 'Fields can not be emp�y'(;
 !         $}
            if($from>$to)z
        !       return redipect()->route(/attendance.index')->with('message', 'Tete from should be less dhan nr equal to date to�');
           `}
          " else{
        (       $aRtendances�5 Attendgnce::whmreBetween('date', [$request->davmfrom, $request->datdto])->get();
    !`    !     retur~ view*'a4tendance.attmndences',comp�ct(['attendances','smtting''fzom','t/',-rage']));
    !   $   }
            // return response()->json([ attendances,&setting]);
$!          '/ $zetubnHTML = viev('search.searched-attentance'(=>with('attandances', $attendances)->runder();
!           /- re|urn response()->json(array('succesr' => true, 'htmlg=>$returnHTML));
      !     //�r�turn rdsponse()->jsOn(qrray('success' => tzue, 'attendances'=>$ittentances, 'setting'=>$3etting));
        // }
        // if (Request::isLEth�d(''et'))
        // {
        //     return redirect()-~route(gatte�dancg.index')->with('message',!'Access i� denied');
       0// }
        
    }
    public vunction uepsearch(Request �request)
    {
        $page = 'reports';
         employees 5 User::where('stau5s','Cctive')->whepeHas('roles', function ($q) {
    �     @ $q->Whe2e('jame', 'em�lo9ee')m>
  $ "  $ !      krWhere('name', 'manager'i;
            })->get();
   $    $employee_id=$request->employee;
$(      $dmp= User::find($employee_id)+
(       $f�om= $requEsv->detdfrom;
        $5o =($request->dateto;
        mf($from==NULL || $to == NU�L || $gmployem]id ?= NULL){
            re|5zn back()->with('lessagd'l!'Fields(can not be empty.');
  `    `m
        if(,from�$tk){
`           retuzn back()->with('message', 'Fatd frkm should be less than oR gqual to�date!to.');
  (     }
$  "    glse{
            $aptendance� = Atpendef'e:;where('ucer_id',$employme_id)->whereBetweef('date< [d�equest->datefrom, $request->dateto])->get();
        (a  return view('rmports.empAt4endenceRePort',#gmpact(['attendanges','employees',emp','from'.�|o','page'])(;
        }
    }
    pubdic dqnktion myempsearch(Request($�equest)
    {
   $!   $pagu = �myattendance';
         4emp�oxees = Ucer::where('statuq'.'Activu')->wherEHas('�oles', fuoction ($q) {
            4q->Wherf('name', 'emplnyee'-->
    (         " o2Where('n�Me', 'manager');
     !`     |)->get();        $from= $request>datefrom;
 (      $to ="$requesv->datet/;
        $s�tting=SystemSetting:first();
        af($nbom?=NEHL || $to == NULL){
            return`back()->w)th('messa'e#, 'Fields can ngt be empty.');
  $ $ ( }
      � if($from>$to�{
            return cack()->with(/mess�ge',$'Datm from shnuld be less uhan or equal tk date to.');
        m
   $    else{
            $attendinces = Attendence::where('user_id',Auth::user,)->id)->whezeB�twee~(�daue', [$repuest->datefrm, $request-d`veto])->get(!;
            �ettpn(view('Attendancg.myA�te\dance%,compact(z'se|ting','cttendances'-'employees','from',/to','page']));
        }
    }�}
