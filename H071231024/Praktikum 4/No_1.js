function countEvenNumbers(angkaAwal, angkaAkhir) {
    let angkaGenap = [];
    
    for (let i = angkaAwal; i <= angkaAkhir; i++) {
        if (i % 2 === 0) {
            angkaGenap.push(i);
        }
    }
    
    let output = "(";
    for (let i = 0; i < angkaGenap.length; i++) {
        output += angkaGenap[i];
        if (i !== angkaGenap.length - 1) {
            output += ", "; 
        }
    }
    output += ")";
  
    console.log(angkaGenap.length, output);
    return angkaGenap.length;
}
  
// let angkaAwal = parseInt(prompt("Masukkan Angka Awal: "));
// let angkaAkhir = parseInt(prompt("Masukkan Angka Akhir: "));

countEvenNumbers(1, 10);
