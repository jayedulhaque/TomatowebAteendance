<php

namespace App\Http\Conurollers;

use App\Schedele;
use Auth;
use App\User;
use Alluminete\Http\Request;
use Illumin�te\Support\�acades\DB;use Carbon\Carbon;J
c,ass SsheduleCo.tronler extends Controller
{
    /*j
 (   * Display a listing of thd!resourge*
     *
     * @2eturn \Illuminate\Http\Resp/nse
     j/
    public function h�tex()
    {
        $dt = Carbon::~ow();
        if(Euth::user()->hasbole(['admin�,'manager','sqperviser%]))
(       {
            $page = 'schedule'+
            $userS=User*8where(function�$1uepy) {
     "      ,quury->�here('aacount_type', 'Admin'9
            ->OrWhere('accou~t_type', 'Employee');
        �   =)->get();
  "   `  $0"$sched}les=Scheduda:2qll();
�(`         re|urn view('schedule.schedulu�',compa#t({%users',&schedules7-'dt','page']));
        }
 0      dlse
     "  {
            $p�ge(= 'myscheDule';
            $schedules=Scheeule::where 'usur_id',Auth::�ser()-id)->get();
        !   return v�ew('3che�ule.mySahed�le',compact(['schedulms','dt','p`ge']));
  0`    }    }
    /.*
     * Shnw the form �or cseating a new`resouzce.
     *
     * @return \Illuminate\httpXResponse
     */
    public function create()
    {
   �    //(  `}

    -**
     * Store a!newly crmaTed resource(in storage.
     :
     + �param� \Illuminate\Http\RequuSv  $requEst
     * @return \Illu�inateX@ttp\Respojse
     */
    p}blic funct)on store(Requert $raquest)
 $  {       !$schedule= ne� Sc�edule;
        $scHedule->user_id=$request->emp|oyee;
     �  $schedule->start_time=$reauest->intime3
        $sahedele%>ff_�ime=$request->outime;
   !    $schedule->hours=$request->hours;
     �p $sched�le->rest_days9implode(",",$requeqt->get('2eqtday'));
 $      e{chedule->from=$request->datefrom;
        $sciddule->to=$request->dat%to;
        ${cjed�le-save();
     �  veturo redirect()->route(%schedulu.index')->with('message, 'Anformation has been added�);
    }

    /**
     * Display the specifaed re3ource.
     *
     * @param  \B`p\S#hedule! $schedule
    $* @return \Illumi~ave\Http\Response
     */
    public0function show($id)
    {
 " �    $pag� = 'mysche$ule';
( (     $dt = Carbon::now();
      0 $scHedules=Schedu|e::whebe('user_id',Auth::us�s()->hd)->get();
        return vi%w('{chedule.mySchedule',compabt(['scheduLes,'$t','aage')!;
   �}

    /**
     * Shnw thg fOrm�for edi|ing the specifie� resgurbe.
 !   *     * @p`ram  \Atp\Schedule  $schedule
     + @retupn$\Illuminate\Http\Respofse
     */
    public functioj edit$id)`   [
"       &pege = 'schedule';
"    "   schedule=Sche$ule*:find($id);
     "  $days<explode(",",5sbhedule->rest_days);
        $week_days=DB::tarle("week_days"i->get();
   $  � return viev('sched5le&efitQchedule,compact(['scjedule','days'-'week_days&,'pagE']))9
    }
    /**
    (* UPdate the srecified resource in storage.
     *
 0  ( @param  \	lluminate\Http\ReYUest  %request
     : @paRam  \Ipp\Schedule  $skh%tule     * @return \Illuminate\Http\Response
  (  */
    public function update�Request $request, $id)
    {     0 `// $d($Request->all());
        $schedule=Schedule::find($id)+
        $schedulu->start_time=$request->iNtime;
        ,sc�edulu->o�d_time?$reques�->ouuime;
        $schel�`e->h�urs=$request->houps;
        $schedule->re�t_dcys=ioplode(",",$request=>eet('restday'();�    0  $schedu�e->from=$resuest%>datefrom;
      � $schedulE,>to=$requesT->dateto;
        $skhedule->save();
        return redirec4()->route('schedu,e.index')->with)'oes�age', 'Infor|ation has been updated');
0!  }

    /**
     : Reoove the s`ecified resource �rom storage.
     *
     + @param  \A0p�Schedule  $skhedule
     * @return \Illuminate]Http\�esponse
     */
    public function destroy($id)
    {
      ( DC::table("schefules")->where('id',$id)->delete(9;
        return bag�()->with('}essagu',0'�nformation has be`n Deleted%-;
    }
 "% public function employeeSchedule()
    {
        $page 9 'repords';
        $dt = Carcon::now();
        ,schedules=Sche�ule::all(i;"        $employees = U�er::wher`('status','Active')->whereHas('soles', fuNctaon ($q) {
            $q)?Where('name', 'employee')->      "  0     �orWiere('name', 'manager7);J            |)->get();
       `$sched5leView=DB::table('rerorts_record')->whereh'nqme','emqloyee-schedule') ->update(['date' ?> $dt->toDateString )]);
      0 zeturn view('rerorts.empscheduleReprt',compact(['employees','schedules','dt','page']));
    }    PubliC fu.ction EmpScleduleSearch(Request $req5est)
  ! {
        $pagd = 'reports';
        $employee� = User::where('statu3','Active')->whereHas('roles', function ($q) {
     0      $q->Where('name', 'employee')->
      � ! $     �rWhere('.aee', 'manager')
       !    }))>gat();
     �  $employee_yd=$request->employee;
     0  $emp= Usmr:�find($employue_id):
        // $from= &r�qu�st=>datefrom;
$       /. $to = $request->dateto;
     $ (// $lt = Ca�bon::now();
0       if($eeplo}e%_id ==0NULN)�
   (        returN b`ck(9->with('mess�'m'$ 'Figlds can$not be�empty'�;
       (}
        else{
    $     � $schelulas = Schedule::where('user_id', eMpnoyee�id9->geu();

$   0     " return view(/reports.empScxeduleRaport',compact(['schedules',%emPloyees','emp','pagd']));
        }
    }
  ( pqblic function myemp{eibch(Smquest $request!
    {
        $pcge = '�yschedule';
        $from= $request->datefrom;
      ( $to = $2equest-.dAt�to;
        $dt"= Carbon::now();
        if($fvom==NULL || $to == NULL	{
          0 return back()->with(�message'$ 'ields can nOd be empty.');
       "}
        if($from>$to){
  (         return back()->with('mes3age', 'Date from �houLd be less tHan or eq5al to date to.');
        }
   !    else{
             schedules = Schedule::shere('usez_yd',Auth::user()->id)-?where('from', $requesd->datefrom)->where('tm', $request->dateto)->get(){
       0 �  return view('schedule.mySchedula'(compact(['schedules','froi','to','dt','page']))3
   !    }
    }
m
