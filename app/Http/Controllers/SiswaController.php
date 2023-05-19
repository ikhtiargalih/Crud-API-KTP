<?php

namespace App\Http\Controllers;

use App\Helpers\formatAPI;
use App\Models\Siswa;
use Exception;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $data = Siswa::all();

        if($data){
            return formatAPI::createAPI(200, 'Success' ,$data);
        }else{
            return formatAPI::createAPI(400, 'Failed');
        }
    }

    public function store(Request $request)
    {
        try{
            //untuk create data
            $siswa = Siswa::create($request->all());
            $data = Siswa::where('id_siswa','=',$siswa->id_siswa)->get();
            
            //check data is valid? return data : failed
            if($data){
                return formatAPI::createAPI(200, 'Success' ,$data);
            }else{
                return formatAPI::createAPI(400, 'Failed');
            }
        }catch(Exception $error){
            return formatAPI::createAPI(400, 'Failed',$error);
        }
    }

    public function show($id_siswa)
    {
        try{
            $data = Siswa::where('id_siswa','=',$id_siswa)->first();
        if($data){
            return formatAPI::createAPI(200, 'Success' ,$data);
        }else{
            return formatAPI::createAPI(400, 'Failed');
        }

        }catch(Exception $error){
            return formatAPI::createAPI(400, 'Failed',$error);
        }
        
    }

    public function update(Request $request, $id_siswa)
    {
        try{
            $siswa = Siswa::findorFail($id_siswa);
            $siswa->update($request->all());

            $data = Siswa::where('id_siswa','=',$siswa->id_siswa)->get();
            if($data){
                return formatAPI::createAPI(200, 'Success' ,$data);
            }else{
                return formatAPI::createAPI(400, 'Failed');
            }

        }catch(Exception $error){
            return formatAPI::createAPI(400, 'Failed',$error);
        }
    }
}
