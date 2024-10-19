const namaHari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

function hitungHariMasaDepan(hariIni, jumlahHari) {
    // Mencari indeks hari ini dalam array namaHari
    const indeksHariIni = namaHari.indexOf(hariIni);
    
    if (indeksHariIni == -1) {
        return "Hari yang dimasukkan tidak valid!";
    }
    
    // Menghitung indeks hari di masa depan
    let indeksMasaDepan = (indeksHariIni + jumlahHari) % 7;
    
    // Mengembalikan nama hari di masa depan
    return namaHari[indeksMasaDepan];
}

function masukkanInput() {
    let hariIni = prompt("Masukkan hari ini (Senin, Selasa, dst.):");
    let jumlahHari = parseInt(prompt("Masukkan jumlah hari ke depan:"));
    
    if (isNaN(jumlahHari)) {
        console.log("Jumlah hari harus berupa angka!");
        return;
    }
    
    let hasilHitung = hitungHariMasaDepan(hariIni, jumlahHari);
    console.log(`${jumlahHari} hari dari hari ${hariIni} adalah hari ${hasilHitung}`);
}

masukkanInput();