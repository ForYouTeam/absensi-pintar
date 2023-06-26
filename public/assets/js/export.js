function exportToExcel(jsonData) {
  // Membuat file Excel
  const xlsContent = 'data:application/vnd.ms-excel;base64,';
  const header = Object.keys(jsonData[0]).join('\t');
  const rows = jsonData.map(data => Object.values(data).join('\t'));
  const xlsData = [header, ...rows].join('\n');
  const xlsBase64 = btoa(xlsData);
  const xlsURI = xlsContent + xlsBase64;

  // Membuat tautan unduhan
  const downloadLink = document.createElement('a');
  downloadLink.href = xlsURI;
  downloadLink.download = 'data.xls';
  downloadLink.click();
}

exportToExcel(jsonData);
