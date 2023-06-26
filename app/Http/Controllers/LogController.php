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
        $date = Carbon::now();
        $payload = array(
            'section'    => $request->section   ,
            'tgl_gate'   => $request->tgl_gate  ,
            'open'       => $request->open      ,
            'close'      => $request->close     ,
            'nama_guru'  => $request->nama_guru ,
            'rfid_guru'  => $request->rfid_guru ,
            'nama_siswa' => $request->nama_siswa,
            'rfid_siswa' => $request->rfid_siswa,
            'kelas'      => $request->kelas     ,
            'level'      => $request->level     ,
            'jurusan'    => $request->jurusan   ,
            'status'     => $request->status    ,
            'tgl_absen'  => $request->tgl_absen ,
            'start_tap'  => $request->start_tap ,
            'end_tap'    => $request->end_tap   ,
            'created_at' => $date               ,
            'updated_at' => $date               ,
        );

        $data = $this->logRepo->SetLog($payload);
        return response()->json($data, $data['code']);  
    }
}
