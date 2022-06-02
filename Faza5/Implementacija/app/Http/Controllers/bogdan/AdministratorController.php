<?php
// Bogdan Arsic 329/19
// Kontroler koji pokriva funkcionalnosti Administratora
namespace App\Http\Controllers\bogdan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\bogdan\SviKorisnici;
use App\Models\bogdan\SviAdministratori;
use App\Models\bogdan\SviModeratori;

class AdministratorController extends Controller
{   
    function __construct() {
        $this->middleware('admin');
    }

    // upgradovanje uloga korsinika(vraca stranicu)
    public function upgradeUserRoles(){
        return view('bogdan/upgradeUserRoles', ['body_id' => 'aboutus_body']);
    }

    // submit dugme za stranicu unapredjivanja korisnika
    public function upgradeUserRolesSubmit(Request $request){

        $svi = SviKorisnici::all();
        $povr = "<div style = 'color:red'>User with given username doesn't exist!</div>";
        $trenId = -1;
        foreach ($svi as $jedan) {
            if($jedan['Username'] == $request['usernameUK'])
            {
                $povr = "<div style = 'color:blue'>Success!</div>";
                $trenId = $jedan['IDUser']; 
                break;
            }
        }

        if($trenId != -1){
            $isModerator = SviModeratori::find($trenId);
            $isAdministrator = SviAdministratori::find($trenId);

            if(!empty($isAdministrator)){
                $povr = "<div style = 'color: red'>User is already an administrator!</div>";

            }else if(!empty($isModerator)){
                if($request['ulogaUK'] == 'Administrator'){
                    $tekuci = SviModeratori::find($trenId);
                    $tekuci->delete();

                    $novi = new SviAdministratori;
                    $novi->IDUser = $trenId;
                    $novi->save();
                }else{
                    $povr = "<div style = 'color: red'>User is already a moderator!</div>";
                }
            }else{
                if($request['ulogaUK'] == 'Administrator'){
                    $novi = new SviAdministratori;
                    $novi->IDUser = $trenId;
                    $novi->save();
                }else{
                    $novi = new SviModeratori;
                    $novi->IDUser = $trenId;
                    $novi->save();
                }
            }
        }

        return response()->json(['status'=>1, 'msg'=>$povr]);
    }
}
