function permainanTebakAngka() {
    const angkaRahasia = Math.floor(Math.random() * 100) + 1;
    console.log(angkaRahasia);
    
    let jumlahTebakan = 0;
    let tebakan;

    while (true) {
        tebakan = parseInt(prompt(`Masukkan salah satu dari angka 1 sampai 100:`));
        jumlahTebakan++;

        if (tebakan < angkaRahasia) {
            console.log(`Terlalu rendah! Coba lagi.`);
        } else if (tebakan > angkaRahasia) {
            console.log(`Terlalu tinggi! Coba lagi.`);
        } else {
            console.log(`Selamat! kamu berhasil menebak angka ${angkaRahasia} dengan benar.\nSebanyak ${jumlahTebakan}x percobaan.`);
            break;
        }
    }
}

permainanTebakAngka();