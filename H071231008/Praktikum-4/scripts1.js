// nomor 1
function countEvenNumbers(start, end) {
    let evenNumber = [];
    for (let i = start; i <= end; i++) {
        if (!(i % 2)) {
            evenNumber.push(i);
        }
    }
    return (evenNumber.length.toString() + "(").concat(evenNumber.toString() + ")");

}
// console.log(countEvenNumbers(1, 10));
// console.log(countEvenNumbers(5, 20));


// nomor 2
function calculateDiskon(harga, jenis) {
    jenis = jenis.toLowerCase();
    let diskon;
    let Sdiskon;
    switch (jenis) {
        case "elektronik":
            diskon = 10 / 100;
            Sdiskon = "10%";
            break;

        case "pakaian":
            diskon = 20 / 100;
            Sdiskon = "20%";
            break;

        case "makanan":
            diskon = 5 / 100;
            Sdiskon = "5%";
            break;


        default:
            diskon = 0;
            break;
    }
    let hasil = harga - harga * diskon;


    return "harga awal: Rp" + harga + "\ndiskon: " + Sdiskon + "\nHarga Setelah Diskon: Rp" + hasil;


}
// let hargaBarang = prompt("Masukan Harga Barang");
// let jenisBarang = prompt("Masukan Jenis Barang");

// console.log(calculateDiskon(hargaBarang,jenisBarang));


// nomor 3
function theDayCounter(target, today) {
    today = today.toLowerCase();
    const daysOfWeek = ['monday', 'tuesday', 'wednesday',
        'thursday', 'friday', 'saturday', 'sunday'];

    today = daysOfWeek.indexOf(today);


    while (target > 0) {
        if (today >= 6) {
            today = 0;
            target -= 1;
        } else {

            today += 1
            target -= 1;
        }
        console.log(today);
    }

    console.log(daysOfWeek[today]);
}

// theDayCounter(10,"sunday");


// no 4
function startGameTebakan() {
    let angka = Math.floor(Math.random() * 101);

    do {
        var tebakan = prompt("Masukan angka: ");
        if (tebakan > angka) {
            console.log("Tebakan Terlalu Besar")
        } else if (tebakan < angka) {
            console.log("Tebakan Terlalu Kecil")

        } else {
            console.log("Selamat Anda Menebak Angka " + angka + " dengan benar!");

        }
    } while (tebakan != angka);


}

startGameTebakan();