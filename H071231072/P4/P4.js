// nomor 1
// function countEvenNumbers(start, end) {
//     let count = 0;
//     let evenNumbers = [];

//     for (let i = start; i <= end; i++) {
//         if (i % 2 === 0) {
//             evenNumbers.push(i);
//             count++;
//         }
//     }

//     console.log(`${count} (${evenNumbers.join(", ")})`);
//     return count;
// }
// console.log(countEvenNumbers(1, 10)); 
// console.log(countEvenNumbers(10, 20)); 


// function hitungDiskon(harga, jenisBarang) {
//     let diskonPersen = 0;
    
//     switch(jenisBarang.toLowerCase()) {
//         case 'elektronik':
//             diskonPersen = 10;
//             break;
//         case 'pakaian':
//             diskonPersen = 20;
//             break;
//         case 'makanan':
//             diskonPersen = 5;
//             break;
//         default:
//             diskonPersen = 0;
//     }
    
//     const diskonNominal = harga * (diskonPersen / 100);
//     const hargaAkhir = harga - diskonNominal;
    
//     console.log(`Harga awal: Rp${harga}`);
//     console.log(`Diskon: ${diskonPersen}%`);
//     console.log(`Harga setelah diskon: Rp${hargaAkhir}`);
// }

// // Simulasi input pengguna
// const harga = parseFloat(prompt("Masukkan harga barang:"));
// const jenisBarang = prompt("Masukkan jenis barang (Elektronik, Pakaian, Makanan, Lainnya):");

// hitungDiskon(harga, jenisBarang);

// const namaHari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

// function hitungHariMasaDepan(hariIni, jumlahHari) {
//     // Mencari indeks hari ini dalam array namaHari
//     const indeksHariIni = namaHari.indexOf(hariIni);
    
//     if (indeksHariIni === -1) {
//         return "Hari yang dimasukkan tidak valid!";
//     }
    
//     // Menghitung indeks hari di masa depan
//     const indeksMasaDepan = (indeksHariIni + jumlahHari) % 7;
    
//     // Mengembalikan nama hari di masa depan
//     return namaHari[indeksMasaDepan];
// }

// // Fungsi untuk meminta input dari pengguna
// function masukkanInput() {
//     const hariIni = prompt("Masukkan hari ini (Senin, Selasa, dst.):");
//     const jumlahHari = parseInt(prompt("Masukkan jumlah hari ke depan:"));
    
//     if (isNaN(jumlahHari)) {
//         console.log("Jumlah hari harus berupa angka!");
//         return;
//     }
    
//     const hasilHitung = hitungHariMasaDepan(hariIni, jumlahHari);
//     console.log(`${jumlahHari} hari dari hari ${hariIni} adalah hari ${hasilHitung}`);
// }

// // Jalankan program
// masukkanInput();

function hitungDiskon(harga, jenisBarang) {
    let diskonPersen = 0;
    
    if (jenisBarang.toLowerCase() === 'elektronik') {
        diskonPersen = 10;
    } else if (jenisBarang.toLowerCase() === 'pakaian') {
        diskonPersen = 20;
    } else if (jenisBarang.toLowerCase() === 'makanan') {
        diskonPersen = 5;
    } else {
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



