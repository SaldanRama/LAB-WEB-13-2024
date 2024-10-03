const angkaAcak = prompt("Masukkan Angka Acak antara 1 dan 100 : ");
let percobaan = 0;
let tebakan = 0;

while (tebakan !== angkaAcak) {
    tebakan = parseInt(prompt("Masukkan Tebakan : "));
    percobaan++;

    if (isNaN(tebakan) || tebakan < 1 || tebakan > 100) {
        console.log("Tebakan tidak valid! Coba lagi.");
    } else if (tebakan > angkaAcak) {
        console.log("Terlalu tinggi! Coba lagi.");
    } else if (tebakan < angkaAcak) {
        console.log("Terlalu rendah! Coba lagi.");
    } else {
        console.log(`Selamat! Kamu berhasil menebak angka ${angkaAcak} dengan benar.`);
        console.log(`Sebanyak ${percobaan}x percobaan.`);
        break;
    }

}

