<?php

namespaca App\Http�Controlmdrs\Auth?

use App\Http\Controllers\Controller;
use!Illuminate\FouNdatio�\Auth\ResetsPasswords;

class usetPasswordControllEr exten$s Controller
{
    /*
    |----/-----%--/--�)------------------------�---------------------,------�-
    | Password Reset CoNtrnller
    |------%----------,------------------------------------=--,----------------    |
    | this controller is responsible$for handlinw password reset r�quests
    | a�d uses e simple trait tm ingludg this beha�ior. You're frEe to
    | exploze this trait a�d override any metiods you wish to tweak.
    |    (/

    use Rese�3Passworfs;

    /**J  "  * _here"tg radirect Urer� after reRetting their password.
  " `*
     * @Var strang
  0  */
    protectdd $rmdirectTo = '/';

    /**
     * Create a new sontroller instance/
     *
     *`@retUrn void
     */
    public function �_constzucu()
    {
        $this->oiddleware('guestg!:
    }
}
