import * as ExcelJS from 'exceljs';
import { saveAs } from 'file-saver'
import moment from 'moment';

export default {
  async generateAttendanceReport(kelas, payload) {
    const workbook = new ExcelJS.Workbook();

    const columnHeaders = [
      { header: "Gate ID", key: "gate_id" },
      { header: "Siswa", key: "siswa" },
      { header: "Status", key: "status" },
      { header: "Tanggal", key: "tgl" },
      { header: "Jam Masuk", key: "start_tap" },
      { header: "Jam Keluar", key: "end_tap" },
    ];

    const monthMap = new Map();

    payload.data.forEach((item) => {
      const tgl = moment(item.tgl).format("DD MMMM YYYY");
      if (!monthMap.has(tgl)) {
        monthMap.set(tgl, []);
      }
      monthMap.get(tgl).push(item);
    });

    monthMap.forEach((data, month) => {
      const worksheet = workbook.addWorksheet(`Report ${kelas} - ${month}`);

      worksheet.getCell("A1").value = "Kelas";
      worksheet.getCell("B1").value = kelas;

      worksheet.getRow(3).values = columnHeaders.map((column) => column.header);

      const rowData = data.map((item) =>
        columnHeaders.map((column) => {
          let value = "";
          if (item.hasOwnProperty(column.key)) {
            if (column.key === "tgl") {
              value = moment(item[column.key]).format("DD MMMM YYYY");
            } else if (column.key === "status") {
              switch (item[column.key]) {
                case "0":
                  value = "Tidak Hadir";
                  break;
                case "1":
                  value = "Hadir";
                  break;
                case "2":
                  value = "Dalam Kelas";
                  break;
                case "3":
                  value = "Bolos";
                  break;
                default:
                  value = "";
                  break;
              }
            } else {
              value = item[column.key];
            }
          }
          return value;
        })
      );

      worksheet.addRows(rowData, "A4");

      columnHeaders.forEach((column, index) => {
        const values = data.map((item) => (item[column.key] || "").toString());
        const maxLength = Math.max(column.header.length, ...values.map((value) => value.length));
        worksheet.getColumn(index + 1).width = maxLength + 2;
      });

      worksheet.eachRow({ includeEmpty: false }, (row) => {
        row.alignment = { horizontal: "left" };
      });
    });

    const buffer = await workbook.xlsx.writeBuffer();
    const blob = new Blob([buffer], {
      type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
    });
    saveAs(blob, `daftar-hadir-${kelas}-${moment().format("DDMMYYYY")}.xlsx`);
  },
};