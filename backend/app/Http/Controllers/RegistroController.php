<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistroController extends Controller
{
    //

    public function get_all(){

        $instalation = DB::connection('mariadb')->select('SELECT * FROM tblinstalations');

        return $instalation;
    }

    public function get_id($id){
        
        $sql = DB::connection('mariadb')
                ->table('tblinstalations')
                ->select(['id','tecnicoid','clientid','date','status', 'equipo', 'name', 'nodoid','position' , 'coordinator','firmwaretype', 'placatype', 'frequency','chipcompany', 'sondatype', 'sondalarge', 'maxhigh', 'sensorhigh', 'waterhigh', 'deeppool','staticlevel', 'dinamiclevel', 'referencesensor','pulses','energytype', 'Coments'])
                ->where('tblinstalations.id','=',$id)
                ->get();

        return $sql;
    }

    public function get_history($id){
        
        $sql = DB::connection('mariadb')
                ->table('tblhistory')
                ->select(['id','tecnicoid','clientid','date','status', 'equipo', 'name', 'nodoid','position' , 'coordinator','firmwaretype', 'placatype', 'frequency','chipcompany', 'sondatype', 'sondalarge', 'maxhigh', 'sensorhigh', 'waterhigh', 'deeppool','staticlevel', 'dinamiclevel', 'referencesensor','pulses','energytype', 'Coments'])
                ->where('tblhistory.id','=',$id)
                ->get();

        return $sql;
    }


    public function get_status($status){
        
        $sql = DB::connection('mariadb')
                ->table('tblinstalations')
                ->select(['id','tecnicoid','clientid','date','status', 'equipo', 'nodoid','position' , 'coordinator','firmwaretype', 'placatype', 'frequency','chipcompany', 'sondatype', 'sondalarge', 'maxhigh', 'sensorhigh', 'waterhigh', 'deeppool','staticlevel', 'dinamiclevel', 'referencesensor','pulses','energytype', 'Coments'])
                ->where('tblinstalations.status','=',$status)
                ->get();

        return $sql;
        
    }

    
    public function update(Request $request){

        $id = $request->input('id');
        $tecnicoid = $request->input('tecnicoid');
        $clientid = $request->input('clientid');
        $date = $request->input('date');
        $status = $request->input('status');
        $equipo = $request->input('equipo');
        $name = $request->input('name');

        $nodoid = $request->input('nodoid');
        $position = $request->input('position');
        $coordinator = $request->input('coordinator');
        $firmwaretype = $request->input('firmwaretype');
        $placatype = $request->input('placatype');
        $frequency = $request->input('frequency');

        $chipcompany = $request->input('chipcompany');
        $sondatype = $request->input('sondatype');
        $sondalarge = $request->input('sondalarge');
        $maxhigh = $request->input('maxhigh');
        $sensorhigh = $request->input('sensorhigh');
        $waterhigh = $request->input('waterhigh');
        $deeppool = $request->input('deeppool');
        $staticlevel = $request->input('staticlevel');
        $dinamiclevel = $request->input('dinamiclevel');
        $referencesensor = $request->input('referencesensor');
        $pulses = $request->input('pulses');
        $energytype = $request->input('energytype');
        $Coments = $request->input('Coments');
 
        $sql = DB::connection('mariadb')
                ->table('tblinstalations')
                ->where('id', $id)
                ->update([
                    'tecnicoid' => $tecnicoid,
                    'clientid'    => $clientid,
                    'date'  => $date,
                    'status'   => $status,
                    'equipo'   => $equipo,
                    'name'   => $name,

                    'nodoid'   => $nodoid,
                    'position'    => $position,
                    'coordinator'   => $coordinator,
                    'firmwaretype'   => $firmwaretype,
                    'placatype'   => $placatype,
                    'frequency'   => $frequency,
                    
                    'chipcompany' => $chipcompany,
                    'sondatype' => $sondatype,
                    'sondalarge' => $sondalarge,
                    'maxhigh' => $maxhigh,
                    'sensorhigh' => $sensorhigh,
                    'waterhigh' => $waterhigh,
                    'deeppool' => $deeppool,
                    'staticlevel' => $staticlevel,
                    'dinamiclevel' => $dinamiclevel,
                    'referencesensor' => $referencesensor,
                    'pulses'=> $pulses,
                    'energytype' => $energytype,
                    'Coments' => $Coments
                ]);
                
    
        
    } 


    public function storeHistory(Request $request){

        $id = $request->input('id');
        $tecnicoid = $request->input('tecnicoid');
        $clientid = $request->input('clientid');
        $date = $request->input('date');
        $status = $request->input('status');
        $equipo = $request->input('equipo');
        $name = $request->input('name');

        $nodoid = $request->input('nodoid');
        $position = $request->input('position');
        $coordinator = $request->input('coordinator');
        $firmwaretype = $request->input('firmwaretype');
        $placatype = $request->input('placatype');
        $frequency = $request->input('frequency');

        $chipcompany = $request->input('chipcompany');
        $sondatype = $request->input('sondatype');
        $sondalarge = $request->input('sondalarge');
        $maxhigh = $request->input('maxhigh');
        $sensorhigh = $request->input('sensorhigh');
        $waterhigh = $request->input('waterhigh');
        $deeppool = $request->input('deeppool');
        $staticlevel = $request->input('staticlevel');
        $dinamiclevel = $request->input('dinamiclevel');
        $referencesensor = $request->input('referencesensor');
        $pulses = $request->input('pulses');
        $energytype = $request->input('energytype');
        $Coments = $request->input('Coments');

        
        
        $sql = DB::connection('mariadb')
                ->table('tblhistory')
                ->insert([
                    'id' => $id,
                    'tecnicoid' => $tecnicoid,
                    'clientid'    => $clientid,
                    'date'  => $date,
                    'status'   => $status,
                    'equipo'   => $equipo,
                    'name'   => $name,

                    
                    'nodoid'   => $nodoid,
                    'position'    => $position,
                    'coordinator'   => $coordinator,
                    'firmwaretype'   => $firmwaretype,
                    'placatype'   => $placatype,
                    'frequency'   => $frequency,
                    
                    'chipcompany' => $chipcompany,
                    'sondatype' => $sondatype,
                    'sondalarge' => $sondalarge,
                    'maxhigh' => $maxhigh,
                    'sensorhigh' => $sensorhigh,
                    'waterhigh' => $waterhigh,
                    'deeppool' => $deeppool,
                    'staticlevel' => $staticlevel,
                    'dinamiclevel' => $dinamiclevel,
                    'referencesensor' => $referencesensor,
                    'pulses'=> $pulses,
                    'energytype' => $energytype,
                    'Coments' => $Coments
                ]);

        return "Se ha ejecutado la llamada a storeHistory ";
    }
    
}