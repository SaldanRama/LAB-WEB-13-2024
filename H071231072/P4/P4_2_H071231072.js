function hitungDiskon(harga, jenisBarang) {
    let diskonPersen = 0;
    
    switch(jenisBarang.toLowerCase()) {
        case 'elektronik':
            diskonPersen = 10;
            break;
        case 'pakaian':
            diskonPersen = 20;
            break;
        case 'makanan':
            diskonPersen = 5;
            break;
        default:
            diskonPersen = 0;
    }
    
    let diskonNominal = harga * (diskonPersen / 100);
    let hargaAkhir = harga - diskonNominal;
    
    console.log(`Harga awal: Rp${harga}`);
    console.log(`Diskon: ${diskonPersen}%`);
    console.log(`Harga setelah diskon: Rp${hargaAkhir}`);
}


let harga = parseFloat(prompt("Masukkan harga barang:"));
let jenisBarang = prompt("Masukkan jenis barang (Elektronik, Pakaian, Makanan, Lainnya):");

hitungDiskon(harga, jenisBarang);