function hitungDiskon(hargaBarang, jenisBarang) {
    
    if (jenisBarang == "Elektronik") {
        diskon = 10;    
    } else if (jenisBarang == "Pakaian") {
        diskon = 20;
    } else if (jenisBarang == "Makanan") {
        diskon = 5;
    } else {
        diskon = 0;
    }

    hargaDiskon = hargaBarang - (hargaBarang * diskon / 100);
    console.log("Harga Awal : " + hargaBarang);
    console.log("Diskon : " + diskon + "%");
    console.log("Harga Setelah Diskon : " + hargaDiskon);
    
}

let hargaBarang = prompt("Masukkan Harga Barang: ");
let jenisBarang = prompt("Masukkan Jenis Barang: ");

hitungDiskon(hargaBarang, jenisBarang);

