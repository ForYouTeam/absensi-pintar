<template>
  <div class="row">
    <div class="col-lg-4">
      <div class="form-group text-center">
        <div class="row">
          <div class="col-lg-6">
            <div class="form-group">
              <label for="" class="form-label">Periode Awal</label>
              <input v-model="kehadiranPayload.start" class="form-control" type="date" id="html5-month-input">
            </div>
          </div>
          <div class="col-lg-6">
            <div class="form-group">
              <label for="" class="form-label">Periode Akhir</label>
              <input v-model="kehadiranPayload.end" class="form-control" type="date" id="html5-month-input">
            </div>
          </div>
        </div>
        <div class="row mt-3 mb-3">
          <div class="col-lg-6">
            <div class="form-group">
              <label for="" class="form-label">Kelas</label>
              <select v-model.number="kehadiranPayload.kelas_id" class="form-select" >
                <option disabled value="0">-- Pilih ---</option>
                <option v-for="(kelas, index) in kelasList" :key="index" :value="kelas.id" class="text-capitalize">{{ kelas.nama_kelas }}</option>
              </select>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="form-group">
              <label for="" class="form-label">Guru</label>
              <select v-model.number="kehadiranPayload.guru_id" class="form-select" >
                <option disabled value="0">-- Pilih ---</option>
                <option v-for="(guru, index) in guruList" :key="index" :value="guru.id" class="text-capitalize">{{ guru.nama }}</option>
              </select>
            </div>
          </div>
        </div>
        <button id="btn-report" :disabled="kehadiranPayload.kelas_id && kehadiranPayload.guru_id && kehadiranPayload.start && kehadiranPayload.end ? false : true" @click="getDataDaftarHadir" class="btn btn-primary btn-lg mt-4">{{ buttonName }}</button>
      </div>
    </div>
    <div class="col-lg-8 px-5">
      <div class="terminal">
        <div class="terminal-header">
          <div class="red-circle"></div>
          <div class="yellow-circle"></div>
          <div class="green-circle"></div>
        </div>
        <div class="terminal-body">
          <p>Welcome to the Logger Terminal!</p>
          <p>Logging some messages...</p>
          <p v-for="(log, index) in logs" :key="index" class="log">[{{ log.message }} - {{ log.data }}</p>
        </div>
      </div>
    </div>
  </div>
</template>
<style scoped>
  .terminal {
    width: auto;
    max-height: 300px; /* Set the maximum height for scrolling */
    background-color: #1a1a1a;
    border-radius: 5px;
    padding: 10px;
    box-sizing: border-box;
    display: flex;
    flex-direction: column;
 /* Enable vertical scrolling */
  }

  .terminal-header {
    display: flex;
    align-items: center;
  }

  .red-circle, .yellow-circle, .green-circle {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    margin-right: 5px;
  }

  .red-circle {
    background-color: #ff5f57;
  }

  .yellow-circle {
    background-color: #ffbd2e;
  }

  .green-circle {
    background-color: #28c940;
  }

  .terminal-body {
    margin-top: 10px;
    overflow-y: auto;
  }

  .log {
    margin: 5px 0;
  }

  /* Removing the input and changing color and border */
  .terminal-footer {
    display: none;
  }

  .terminal {
    color: #fff;
    border: 1px solid #ccc;
  }

</style>
<script setup>
  import { onMounted, reactive, ref } from 'vue';
  import Export from '../utils/export'
  import axios from 'axios'

  const baseUrl = process.env.VUE_APP_API_URL

  const kelasList = ref()
  const guruList = ref()

  const kehadiranPayload = reactive({
    kelas_id : 0,
    guru_id  : 0,
    start    : '',
    end      : ''
    
  })

  const getKelasList = () => {
    axios.get(`${baseUrl}/api/v1/kelas`)
    .then((res) => {
      let item = res.data.data

      kelasList.value = item
    })
    .catch((err) => {
      console.log(err);
    })
  }

  const getGuruLust = () => {
    axios.get(`${baseUrl}/api/v1/guru`)
    .then((res) => {
      let item = res.data.data

      guruList.value = item
    })
    .catch((err) => {
      console.log(err);
    })
  }

  const buttonName = ref('DOWNLOAD REPORT')

  const data = ref()
  const getDataDaftarHadir = () => {
    console.log(kehadiranPayload);

    axios.get(`${baseUrl}/api/v1/report/daftar_hadir?kelas_id=${kehadiranPayload.kelas_id}&guru_id=${kehadiranPayload.guru_id}&start=${kehadiranPayload.start}&end=${kehadiranPayload.end}`)
    .then((res) => {
      let item = res.data
      console.log('data get', item);
      if (item.daftar_hadir.length >= 1) {
        tambahkanInformasiDaftarHadir(item.siswa, item.daftar_hadir)
        generateDataBulan(item.siswa)
        Export.generateExcel(data.value)
      } else {
        buttonName.value = "DATA KOSONG !"
        setTimeout(() => {
          buttonName.value = "DOWNLOAD REPORT"
        }, 1500);
      }
    })
  }

  const tambahkanInformasiDaftarHadir = (siswa, daftarHadir) => {
    siswa.forEach(siswaItem => {
      let statusObj = { hadir: 0, alfa: 0, dalam_kelas: 0, bolos: 0 }; // Objek untuk menyimpan jumlah daftar hadir

      daftarHadir.forEach(daftarHadirItem => {
        if (siswaItem.id === daftarHadirItem.siswa_id) {
          siswaItem.tgl = daftarHadirItem.tgl;
          siswaItem.start_tap = daftarHadirItem.start_tap;
          siswaItem.end_tap = daftarHadirItem.end_tap;

          // Menambahkan jumlah daftar hadir berdasarkan status
          switch (daftarHadirItem.status) {
            case "0":
              statusObj.alfa++;
              break;
            case "1":
              statusObj.hadir++;
              break;
            case "2":
              statusObj.dalam_kelas++;
              break;
            case "3":
              statusObj.bolos++;
              break;
            default:
              break;
          }

          console.log('status', daftarHadirItem.status);
        }
      });

      siswaItem.statusObj = statusObj; // Tambahkan objek status ke dalam objek siswa
      console.log('Ini Count', statusObj);
    });

    data.value = siswa
  }

  const getNamaBulan = (bulan) => {
    // Mengembalikan nama bulan berdasarkan nomor bulan
    const namaBulan = [
      "Januari", "Februari", "Maret", "April", "Mei", "Juni",
      "Juli", "Agustus", "September", "Oktober", "November", "Desember"
    ];
    return namaBulan[bulan - 1];
  }

  const getJumlahHari = (bulan) => {
    // Mengembalikan jumlah hari dalam bulan
    const jumlahHari = [
      31, 28, 31, 30, 31, 30,
      31, 31, 30, 31, 30, 31
    ];
    return jumlahHari[bulan - 1];
  }
  
  const generateDataBulan = (siswaData) => {
    const dataBulan = [];

    for (let bulan = 1; bulan <= 12; bulan++) {
      const namaBulan = getNamaBulan(bulan);
      const jumlahHari = getJumlahHari(bulan);

      const tanggal = [];
      for (let hari = 1; hari <= jumlahHari; hari++) {
        const dataTanggal = {
          tanggal: hari,
          siswa: siswaData.map((siswa) => siswa.nama)
        };

        tanggal.push(dataTanggal);
      }

      dataBulan.push({ bulan: namaBulan, tanggal });
    } // Cetak hasil data bulan ke konsol
  }

  const logs = ref()

  const getLogs = () => {
    axios.get(`${baseUrl}/api/v1/log/get`)
    .then((res) => {
      let item = res.data
      logs.value = item.data
    })
    .catch((err) => {
      console.log(err);
    })
  }

  onMounted(() => {
    getKelasList()
    getGuruLust()
    getLogs()
  })
</script>