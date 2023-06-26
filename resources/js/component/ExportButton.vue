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

  const data = {
  "siswa": [
    {
      "id" : 1,
      "nisn" : "35345",
      "nama" : "yuli",
      "tmpt_lahir" : "palu",
      "tgl_lahir" : "2000-01-01",
      "alamat" : "parigi",
      "hp" : "95745",
      "sex" : "wanita",
      "agama" : "hindu",
      "kelas_id" : 1,
      "jurusan_id" : 1,
      "rfid" : "0009529774",
      "foto" : "no",
      "created_at" : null,
      "updated_at" : null
    },
    {
      "id" : 2,
      "nisn" : "26264",
      "nama" : "winda",
      "tmpt_lahir" : "palu",
      "tgl_lahir" : "2000-01-01",
      "alamat" : "palu",
      "hp" : "96856",
      "sex" : "wanita",
      "agama" : "islam",
      "kelas_id" : 1,
      "jurusan_id" : 1,
      "rfid" : "0009432065",
      "foto" : "1.png",
      "created_at" : null,
      "updated_at" : null
    },
    {
      "id" : 3,
      "nisn" : "43534",
      "nama" : "akbar triwicaksono",
      "tmpt_lahir" : "palu",
      "tgl_lahir" : "2001-01-01",
      "alamat" : "anoa",
      "hp" : "84566",
      "sex" : "pria",
      "agama" : "islam",
      "kelas_id" : 1,
      "jurusan_id" : 1,
      "rfid" : "0016232383",
      "foto" : "no",
      "created_at" : null,
      "updated_at" : null
    },
    {
      "id" : 4,
      "nisn" : "8686",
      "nama" : "dirga",
      "tmpt_lahir" : "palu",
      "tgl_lahir" : "1999-01-01",
      "alamat" : "palu",
      "hp" : "78898",
      "sex" : "pria",
      "agama" : "islam",
      "kelas_id" : 1,
      "jurusan_id" : 1,
      "rfid" : "0016268438",
      "foto" : "no",
      "created_at" : null,
      "updated_at" : null
    },
    {
      "id" : 5,
      "nisn" : "76877",
      "nama" : "eet elvian",
      "tmpt_lahir" : "palu",
      "tgl_lahir" : "2000-01-01",
      "alamat" : "palu",
      "hp" : "447573",
      "sex" : "pria",
      "agama" : "islam",
      "kelas_id" : 2,
      "jurusan_id" : 1,
      "rfid" : "0009384011",
      "foto" : "no",
      "created_at" : null,
      "updated_at" : null
    },
    {
      "id" : 6,
      "nisn" : "875655",
      "nama" : "ayu astuti",
      "tmpt_lahir" : "palu",
      "tgl_lahir" : "2001-01-02",
      "alamat" : "palu",
      "hp" : "342353",
      "sex" : "wanita",
      "agama" : "islam",
      "kelas_id" : 2,
      "jurusan_id" : 1,
      "rfid" : "0016268324",
      "foto" : "no",
      "created_at" : null,
      "updated_at" : null
    },
    {
      "id" : 7,
      "nisn" : "46654",
      "nama" : "nurul hudayah",
      "tmpt_lahir" : "palu",
      "tgl_lahir" : "2001-01-03",
      "alamat" : "palu",
      "hp" : "543536",
      "sex" : "wanita",
      "agama" : "islam",
      "kelas_id" : 2,
      "jurusan_id" : 1,
      "rfid" : "0009384047",
      "foto" : "no",
      "created_at" : null,
      "updated_at" : null
    },
    {
      "id" : 8,
      "nisn" : "56745",
      "nama" : "wiwin",
      "tmpt_lahir" : "palu",
      "tgl_lahir" : "2001-05-01",
      "alamat" : "palu",
      "hp" : "453454",
      "sex" : "wanita",
      "agama" : "kristen",
      "kelas_id" : 2,
      "jurusan_id" : 1,
      "rfid" : "0016268398",
      "foto" : "no",
      "created_at" : null,
      "updated_at" : null
    }
  ]}

  const hadir = [
    {
        "gate_id": 22,
        "siswa": "dirga",
        "status": "2",
        "tgl": "2023-06-26",
        "start_tap": "18:16:01",
        "end_tap": null
    },
    {
        "gate_id": 22,
        "siswa": "yuli",
        "status": "2",
        "tgl": "2023-06-26",
        "start_tap": "18:15:56",
        "end_tap": null
    }
  ]

  const exportDaftarIsi = () => {
  }
</script>