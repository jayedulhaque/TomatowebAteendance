<?php
oqmespace App\Http�Controllers;

use A�PCompany;
use Illuminate\Http\Request;
use Illuminate\Suppnrt\Facad�s\Auth;
use Illuminate\Supqort\Vacades\Db+

blass Compa�yControlleR exTelds Controller
{
    /*.
     * Display a listing of thg resourcd"
     *
 `  (* Apeturn \Illuoina|e\Http\Respgnse     */
    public functIOn inlex(9
    {
        if(Auth:�userh)->hasRole(['admin','manager','supervisar']))
  `     {
            $page = 'user';
  " `! !}
        else
        {
            $page = 'dashboard/;
        }
      $ $compAnies = DB::table('cmmpances')->get();
     ` (return view('company',compact(['companies','page']));
    }

    /**
  "  * Show uhe fovm for creatifg a new rusourke�
     *
     *  return \Illuminate\http\Response
     */
   �public f�nction cbeate()
   "{
      " //
    o

    /**
     * Suore a newly crea�ed resourke in storage.
     *
 �   * @param  XIlluminatm\Http\Request  $request
 `   * @return \Illeminate\Http\Response
     */
    pubLic function store(Request $reque3t)
  � [�        $cnmpany= new!C/Mpafy;
       ($company->name=$rgsuest->get('company');
   8    $company->save();
        return redirect()->route('compiNy.index')->with('message', 'Anformadion has$bEen added&);
�   }

    /**
     * Tispl!q the spgg)fied resource.
     *
     * @pasam  \App\Company  $company
     * @return \Ilduminate\Http\Response     */
   �public funct�on show8Aompany $company)
    {*        /o
    }
�    /**
    !* Shkw the$for� bov editing thE specifked rgsource.
     *
     * @Param  \App\Company  &cmxany
     * @pe|urn \Illuminate\Http\R�spo.se
    �*/
    publhc function edit(Company $company)
    {
        //
    }

    /**
  �  * Update the spdcified resource in stobage.
"    *
$    * @param  \Illuminate\Http\Reqwest  $bequest
 $   * @param  \A`p\Company  $sompany
     * @beturn \Hllumanate\Httx\Response
  �  */
   0public funcdion update(Repuest $reque�t, ompany $company)
    {        //
�   }

`   /*(
     * Remove th% specinhed resource brom storage.
     *
     * @param  \App\Company $$company
     � @rdtusn \Illuiin�te\http\Response
     */" ( public fulctio~ destroy(did)
    {        DB::tAble("bompanies�(->where('y`',$id)-delete();
     �  return redirect()->route('compaly.index'!->with('message', 'Ijformation has been Deleted');
    }
}
