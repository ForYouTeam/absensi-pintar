<template>
  <div class="row">
      <div class="col-lg-4">
          <div class="form-group text-center">
              <div class="form-lable mb-3">Data Kehadiran</div>
              <button @click="exportDaftarIsi" class="btn btn-primary btn-lg">DOWNLOAD REPORT</button>
          </div>
      </div>
      <div class="col-lg-4">
          <div class="form-group text-center">
              <div class="form-lable mb-3">Data Siswa</div>
              <button class="btn btn-primary btn-lg">DOWNLOAD REPORT</button>
          </div>
      </div>
      <div class="col-lg-4">
          <div class="form-group text-center">
              <div class="form-lable mb-3">Data Guru</div>
              <button class="btn btn-primary btn-lg">DOWNLOAD REPORT</button>
          </div>
      </div>
  </div>
</template>
<script setup>
  import Export from '../utils/export'

  const data =
    {
    kelas: "rpl a",
    data : 
      [
        {
            gate_id: 21,
            siswa: "yuli",
            status: "2",
            tgl: "2023-06-26",
            start_tap: "14:52:18",
            end_tap: null
        },
        {
            gate_id: 21,
            siswa: "yuli",
            status: "2",
            tgl: "2023-08-26",
            start_tap: "14:52:18",
            end_tap: null
        },
        {
            gate_id: 21,
            siswa: "yuli",
            status: "2",
            tgl: "2023-06-26",
            start_tap: "14:52:18",
            end_tap: null
        },
        {
            gate_id: 21,
            siswa: "yuli",
            status: "2",
            tgl: "2023-08-26",
            start_tap: "14:52:18",
            end_tap: null
        },
      ]
    }

  const exportDaftarIsi = () => {
    Export.generateAttendanceReport('RPL A', data)
  }
</script>