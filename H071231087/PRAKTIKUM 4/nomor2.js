let harga = prompt("Masukkan harga barang: ")
        let kategori = prompt("Masukkan jenis barang (Elektronik, Pakaian, Makanan, Lainnya): ")

        function hitungDiskon(harga, kategori) {
            let kat = kategori.toLowerCase();
            let diskon;

            if (kat == "elektronik") {
                diskon = 10
            } else if (kat == "pakaian") {
                diskon = 20
            } else if (kat == "makanan") {
                diskon = 5
            }else {
                diskon =0
            }

            let hasil = harga - (harga*diskon/100)


            console.log(`Harga awal: ${harga}`);
            console.log(`Diskon: ${diskon}%`);
            console.log(`Harga setalah siskon: Rp${hasil}`);
        }
        hitungDiskon(harga,kategori)
