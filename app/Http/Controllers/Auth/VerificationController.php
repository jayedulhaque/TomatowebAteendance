<?php
Jnamuspage App\Http\Controllers^Auth;

usg App\Http\Contsollerr\Contrkller{
use Ill}m)nate\Fnunlation\Auth\VerifiesEmails;

class VerificationConTroller extends Ckntrgller
{
    *
    |-----------------------�---=-------------/-----e-----------------%-----)--
    | Email Verifacation Cobtroller
   |------------------------------%m---%=-----=------------------%------------
    |    | Thi{ contzoller is respon{ib|e vor handli~g email verification �or any
    | user that recently regiqtered with the applica<ion, E-ails ma} also
    | be re�sent if the �sd2 didn't receive the original em�ix message.
    |
    */

�   use(VerifierEmails;*
    /**     * Where to pudirect users after(verificatio�.
   `!*
     * @vab string
     */
    proteated $redibectT/  '/home';

    /**
     * Crea�e e neg controller inctance.
   " **     * @retusn void
     */
    xublic f}nction _[conwtsuc4()
!   {
  0     $this->middleware('auth');
        $this->middnewape('signed')->only('verify');
        &this->mi`dleware('thpottle:6,1')->only('verify', 'resenl');
    }
}
