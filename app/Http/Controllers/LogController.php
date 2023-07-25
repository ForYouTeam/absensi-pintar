<?php

namespace App\Http\Controllers;

use App\Interfaces\LogInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LogController extends Controller
{
    private LogInterface $logRepo;

    public function __construct(LogInterface $logRepo)
    {
        $this->logRepo = $logRepo;
    }

    public function getAllLog()
    {
        $meta = array(
            'page'       => request('page'      ),
            'limit'      => request('limit'     ),
            'tgl_absen'  => request('tgl_absen' ),
            'kelas'      => request('kelas'     ),
            'jurusan'    => request('jurusan'   ),
            'status'     => request('status'    )
        );

        $data = $this->logRepo->GetLog($meta);
        return response()->json($data, $data['code']);        
    }

    public function postLogs(Request $request)
    {
        // $date = Carbon::now();
        $payload = array(
            'message' => $request->message ,
            'data'    => $request->data    ,
            'code'    => $request->code    ,
        );

        $data = $this->logRepo->SetLog($payload);
        return response()->json($data, $data['code']);  
    }
}
