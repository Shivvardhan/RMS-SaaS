document.addEventListener("DOMContentLoaded", () => {
    const countdownText = document.getElementById('countdown-text');
    const progressBar = document.getElementById('progress-bar');

    const estimatedDeliveryTime = new Date(new Date().getTime() + 30 * 60 * 1000); // ⏳ 30 minutes from now
    console.log(`Estimated Delivery Time: ${estimatedDeliveryTime}`);

    const totalDistance = 10; // 📏 Total distance in km
    let currentDistance = totalDistance;

    const totalDuration = estimatedDeliveryTime - new Date(); // ⏳ Total countdown duration in ms
    const startPercentage = 50; // 🎨 Start progress at 50%

    function updateDisplay() {
        const currentTime = new Date();
        const diff = estimatedDeliveryTime - currentTime;

        console.log(`Time Left: ${diff} ms`);

        if (diff <= 0) {
            clearInterval(interval);
            countdownText.innerHTML = "🎉 Your order has arrived!";
            progressBar.style.width = "0%"; // Empty progress bar when countdown ends
            return;
        }

        // 📉 Calculate distance decrease rate (distance per second)
        let speedPerSecond = totalDistance / (totalDuration / 1000);
        currentDistance = Math.max(0, currentDistance - speedPerSecond);

        // 🛵 Update display with only distance left
        countdownText.innerHTML = `${currentDistance.toFixed(2)} km left`;

        // 🎨 Update progress bar from 50% to 0%
        const elapsedTime = totalDuration - diff;
        let progressPercent = startPercentage - (elapsedTime / totalDuration) * 50;
        progressBar.style.width = `${Math.max(progressPercent, 0)}%`;
    }

    const interval = setInterval(updateDisplay, 1000);
    updateDisplay(); // ⏳ Initial call to set values
});
