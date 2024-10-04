
// nomor 1
function countEvenNumbers(start, end) {
    let count = 0;
    let evenNumbers = [];

    for (let i = start; i <= end; i++) {
        if (i % 2 == 0) {
            evenNumbers.push(i);
            count++;
        }
    }

    console.log(`${count} (${evenNumbers.join(", ")})`);
    return count;
}
console.log(countEvenNumbers(1, 10)); 
console.log(countEvenNumbers(10, 20)); 