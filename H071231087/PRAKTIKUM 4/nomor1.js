function countEvenNumber(start, end) {
    const evenNumbers = []; 
    let count = 0;

    for (let i = start; i <= end; i += 1) { 
        if (i % 2 == 0) {  
            evenNumbers.push(i);
            count += 1; 
        }
    }
    console.log(`${count} (${evenNumbers.join(', ')})`);
}

countEvenNumber(1, 10);
