document.addEventListener("DOMContentLoaded", function () {
    const proceedButton = document.getElementById("proceedToPayment");
    const cancelButton = document.getElementById("cancelOrder");

    proceedButton.addEventListener("click", function () {
        const firstName = document.getElementById("firstName").value;
        const lastName = document.getElementById("lastName").value;
        const email = document.getElementById("email").value;
        const phone = document.getElementById("phone").value;

        if (!firstName || !lastName || !email || !phone) {
            alert("Please fill in all required fields!");
        } else {
            alert("Proceeding to Payment...");
            window.location.href = "payment.html"; // Redirect to payment page
        }
    });

    cancelButton.addEventListener("click", function () {
        if (confirm("Are you sure you want to cancel the order?")) {
            alert("Order Cancelled!");
            window.location.href = "menu.html"; // Redirect back to menu
        }
    });
});
