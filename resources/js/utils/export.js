import * as ExcelJS from 'exceljs';
import { saveAs } from 'file-saver';
import moment from 'moment';

export default {
  async generateExcel(data) {
   // Membuat workbook dan worksheet
   const workbook = new ExcelJS.Workbook();
   const worksheet = workbook.addWorksheet('Data Siswa');
 
   // Tanggal report
   const tanggalReport = moment().format('DD-MM-YYYY');
 
   // Kelas report
   const kelasReport = data[0].kelas;
 
   // Deskripsi - Menggabungkan sel
   worksheet.mergeCells('A1:B1');
   worksheet.getCell('A1').value = 'Tanggal Report:';
   worksheet.getCell('C1').value = tanggalReport;
   worksheet.mergeCells('A2:B2');
   worksheet.getCell('A2').value = 'Kelas Report:';
   worksheet.getCell('C2').value = kelasReport;
 
   // Header kolom
   const columnHeaders = [
     { header: 'Siswa', key: 'nama' },
     { header: 'Hadir', key: 'statusObj.hadir' },
     { header: 'Alfa', key: 'statusObj.alfa' },
     { header: 'Dalam Kelas', key: 'statusObj.dalam_kelas' },
     { header: 'Bolos', key: 'statusObj.bolos' }
   ];
 
   columnHeaders.forEach((column, index) => {
     worksheet.getCell(`${String.fromCharCode(65 + index)}4`).value = column.header;
   });
 
   // Menambahkan data siswa
   data.forEach((siswa, index) => {
     const rowIndex = index + 5;
     worksheet.getCell(`A${rowIndex}`).value = siswa.nama;
     worksheet.getCell(`B${rowIndex}`).value = siswa.statusObj.hadir;
     worksheet.getCell(`C${rowIndex}`).value = siswa.statusObj.alfa;
     worksheet.getCell(`D${rowIndex}`).value = siswa.statusObj.dalam_kelas;
     worksheet.getCell(`E${rowIndex}`).value = siswa.statusObj.bolos;
   });
 
   // Mengatur lebar kolom berdasarkan konten
   columnHeaders.forEach((column, index) => {
     const values = data.map((item) => {
       const keys = column.key.split('.');
       let value = item;
       keys.forEach((key) => {
         if (value) {
           value = value[key];
         }
       });
       return (value || '').toString();
     });
     const maxLength = Math.max(
       column.header.length,
       ...values.map((value) => value.length)
     );
     worksheet.getColumn(index + 1).width = maxLength + 2;
   });
 
   // Menyimpan file Excel
   workbook.xlsx.writeBuffer()
     .then(buffer => {
       const blob = new Blob([buffer], {
         type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
       });
       saveAs(blob, `data-siswa-${kelasReport}-${tanggalReport}.xlsx`);
       console.log(`File data-siswa-${kelasReport}-${tanggalReport}.xlsx berhasil disimpan.`);
     })
     .catch(err => {
       console.error('Terjadi kesalahan:', err);
     });
  }
};
