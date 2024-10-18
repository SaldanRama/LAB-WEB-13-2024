const container = document.querySelector('.sparkles');
const totalSparkles = 100; 

for (let i = 0; i < totalSparkles; i++) {
    const sparkle = document.createElement('div');
    sparkle.classList.add('sparkle');
    sparkle.style.left = `${Math.random() * 100}%`;
    sparkle.style.top = `${Math.random() * 100}%`;
    sparkle.style.animationDuration = `${Math.random() * 3 + 2}s`;
    sparkle.style.animationDelay = `${Math.random() * 5}s`;
    container.appendChild(sparkle);
}