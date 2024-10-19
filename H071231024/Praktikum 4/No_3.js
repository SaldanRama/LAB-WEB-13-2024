const namaHari = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];

function indexHari(hari) {
    for (let i = 0; i < namaHari.length; i++) {
        if (namaHari[i].toLowerCase() === hari.toLowerCase()) {
            return i;
        }
    }
    return -1;
}

function hitungHari(hariIni, hariKemudian) {
    let indexAwal = indexHari(hariIni);
    
    if (indexAwal === -1) {
        return "Hari tidak valid!";
    }

    hariKemudian = parseInt(hariKemudian) % 7;

    let indexKemudian = (indexAwal + hariKemudian) % 7;
    return namaHari[indexKemudian];
}

let hariIni = prompt("Masukkan Hari Saat Ini : ");
let hariKemudian = prompt("Masukkan Jumlah Hari Kemudian : ");

let hasil = hitungHari(hariIni, hariKemudian);

console.log(`Hari ini adalah hari ${hariIni}.`);
console.log(`${hariKemudian} hari dari sekarang adalah hari ${hasil}.`);
