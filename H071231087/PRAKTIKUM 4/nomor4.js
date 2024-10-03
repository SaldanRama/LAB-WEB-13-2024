const angkaMin = 1;
const angkaMax = 100;
const jawabanBenar = Math.floor(Math.random() * (angkaMax - angkaMin + 1)) + angkaMin;

let jumlahPercobaan = 0;
let tebakan; 
let gameBerjalan = true; 

while (gameBerjalan) {
    tebakan = window.prompt(`Masukkan angka antara ${angkaMin} sampai ${angkaMax}`);
    tebakan = Number(tebakan);

    if (isNaN(tebakan)) {
        window.alert("Masukkan tebakan yang valid (harus berupa angka).");
    } else if (tebakan < angkaMin || tebakan > angkaMax) {
        window.alert(`Pilih angka dari ${angkaMin} sampai ${angkaMax}.`);
    } else {
        jumlahPercobaan++;
        
        if (tebakan > jawabanBenar) {
            window.alert("Tebakanmu masih terlalu tinggi! Coba lagi...");
        } else if (tebakan < jawabanBenar) {
            window.alert("Tebakanmu masih terlalu rendah! Coba lagi...");
        } else if (tebakan === jawabanBenar) {
            window.alert(`Selamat! Kamu berhasil menebak angka ${jawabanBenar} dengan benar dalam ${jumlahPercobaan} percobaan.`);
            gameBerjalan = false; 
        }
    }
}
