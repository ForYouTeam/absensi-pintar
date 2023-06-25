@extends('web.skelton.Base')
@section('content')
<div class="row">
  <div class="col-12">
      <div class="card pull-up">
          <div class="card-content collapse show">
              <div class="card-body">
                  <form class="form-horizontal form-purchase-token row">
                      <div class="col-md-3 col-12">
                          <select class="custom-select">
                              <option disabled selected="">PILIH KELAS</option>
                              <option value="1">TKJ</option>
                          </select>
                      </div>
                      <div class="col-md-3 col-12">
                        <select class="custom-select">
                            <option disabled selected="">PILIH MATA PELAJARAN</option>
                            <option value="1">TKJ</option>
                        </select>
                      </div>
                      <div class="col-md-1"></div>
                      <div class="col-md-3 col-12 mb-1">
                        <fieldset class="form-label-group mb-0">
                            <input type="text" class="form-control" id="wallet-address" value="0xe834a970619218d0a7db4ee5a3c87022e71e177f" required="" autofocus="">
                            <label for="wallet-address">PASSWORD</label>
                        </fieldset>
                      </div>
                      <div class="col-md-2 col-12 text-center">
                          <button data-toggle="modal" data-target="#confirm-modal" type="button" class="btn-gradient-secondary">TEMPELKAN KARTU</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
</div>

<div class="row">
  <div id="recent-transactions" class="col-12">
      <h6 class="my-2">Kelas yang aktif hari ini</h6>
      <div class="card">
          <div class="card-content">
              <div class="table-responsive">
                  <table id="recent-orders" class="table table-hover table-xl mb-0">
                      <thead>
                          <tr>
                              <th class="border-top-0">Sesi Aktif</th>
                              <th style="width: 25%;" class="border-top-0">Guru</th>
                              <th class="border-top-0">Matapelajaran</th>
                              <th class="border-top-0">Jam Dimulai</th>
                              <th class="border-top-0">Opsi</th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr>
                              <td class="text-truncate"><i class="la la-dot-circle-o success font-medium-1"></i>25062023125351_0009429291</td>
                              <td class="text-truncate">Winda</td>
                              <td class="text-truncate">
                                  <a href="#" class="mb-0 btn-sm btn btn-outline-success round">Matamatika</a>
                              </td>
                              <td class="text-truncate">10:00</td>
                              <td>
                                  <a href="#" class="btn-link rounded">Buka Panel</a>
                              </td>
                          </tr>
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection