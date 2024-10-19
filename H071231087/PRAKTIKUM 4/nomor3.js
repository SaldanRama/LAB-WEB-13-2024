function hitungHariMendatang(hariIni, jumlahHariMendatang) {
    const daftarHari = ["senin", "selasa", "rabu", "kamis", "jumat", "sabtu", "minggu"];

    const indeksHariIni = daftarHari.indexOf(hariIni);

    if (indeksHariIni === -1) {
        return "Hari tidak valid. Silakan masukkan hari yang benar.";
    }

    const indeksHariMendatang = (indeksHariIni + Number(jumlahHariMendatang)) % 7;

    console.log(`${jumlahHariMendatang} hari yang akan datang dari hari ${hariIni} adalah ${daftarHari[indeksHariMendatang]}.`);
}


let hariInput = prompt("Masukkan hari sekarang (contoh: senin, selasa, dll)").toLowerCase().trim();
let jumlahHariInput = prompt("Masukkan jumlah hari ke depan yang ingin anda ketahui harinya").trim();


hitungHariMendatang(hariInput, jumlahHariInput);
