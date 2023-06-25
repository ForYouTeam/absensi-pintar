<?php

namespace App\Http\Controllers;

use App\Interfaces\GateInterface;
use App\Interfaces\KelasInterface;
use App\Interfaces\MapelInterface;
use Illuminate\Http\Request;

class WebController extends Controller
{
    private KelasInterface $kelasRepo;
    private MapelInterface $mapelRepo;
    private GateInterface  $gateRepo;

    public function __construct(KelasInterface $kelasRepo, MapelInterface $mapelRepo, GateInterface $gateRepo)
    {
      $this->kelasRepo = $kelasRepo;  
      $this->mapelRepo = $mapelRepo;  
      $this->gateRepo = $gateRepo;  
    }

    public function dashboardPanel()
    {
			$data = array(
				'kelas' => $this->kelasRepo->getAllPayload()['data'],
				'mapel' => $this->mapelRepo->getAllPayload()['data']
			);

			return view('web.pages.Dashboard')->with('data', $data);
    }

		public function siswaSectionPanel($section)
		{
			$data = $this->gateRepo->getGateByRfid($section);
			if ($data['code'] == 404) {
				return redirect()->back();
			}

			return view('web.pages.AbsenPanel')->with('data', $data['data']);
		}
}
