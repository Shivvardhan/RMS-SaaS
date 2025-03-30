<?php
require "d_head.php";
$stmt = $conn->prepare("SELECT l_token FROM `users` WHERE `username` = ?");
$stmt->bind_param('s', $_SESSION['username']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
if ($user['l_token'] == isset($_SESSION['token']) && isset($_SESSION['username']) && session_status() === PHP_SESSION_ACTIVE ) {
require "menu.php"; ?>


<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Default</h1>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    <a href="dash.php" class="text-muted text-hover-primary">Home</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">Order</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->



        </div>

    </div>
    <!--end::Toolbar container-->
</div>

<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">



    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">

        <div class="screen-togo">

            <ul class="menu1-items">
                <!--    Menu Item 1    -->
                <li class="menu1-item">
                    <img src="https://images.themodernproper.com/billowy-turkey/production/posts/2022/Homemade-French-Fries_8.jpg?w=960&h=960&q=82&fm=jpg&fit=crop&dm=1662474181&s=f6b09b96f732330eca2aae43140b3ffa"
                        alt="French Fries with Ketchup" class="menu1-image">
                    <div class="menu1-item-dets">
                        <p class="menu1-item-heading">French Fries with Ketchup</p>
                        <p class="g-price">$2.23</p>
                    </div>
                    <div class="counter">
                        <span class="down" onClick='decreaseCount(event, this)'>-</span>
                        <input type="text" value="0">
                        <span class="up" onClick='increaseCount(event, this)'>+</span>
                    </div>
                </li>
                <!--    Menu Item 2    -->
                <li class="menu1-item">
                    <img src="https://24carrotkitchen.com/wp-content/uploads/2015/08/DSC_0965_9083.jpg"
                        alt="Salmon and Vegetables" class="menu1-image">
                    <div class="menu1-item-dets">
                        <p class="menu1-item-heading">Salmon and Vegetables</p>
                        <p class="g-price">$8.99</p>
                    </div>
                    <div class="counter disable">
                        <span class="down" onClick='decreaseCount(event, this)'>-</span>
                        <input type="text" value="0">
                        <span class="up" onClick='increaseCount(event, this)'>+</span>
                    </div>
                </li>
                <!--    Menu Item 3    -->
                <li class="menu1-item">
                    <img src="https://www.hintofhealthy.com/wp-content/uploads/2020/07/Healthy-Spaghetti-Sauce-1.jpg"
                        alt="Spaghetti with Sauce" class="menu1-image">
                    <div class="menu1-item-dets">
                        <p class="menu1-item-heading">Spaghetti with Sauce</p>
                        <p class="g-price">$7.89</p>
                    </div>
                    <div class="counter">
                        <span class="down" onClick='decreaseCount(event, this)'>-</span>
                        <input type="text" value="0">
                        <span class="up" onClick='increaseCount(event, this)'>+</span>
                    </div>
                </li>
                <!--    Menu Item 4    -->
                <li class="menu1-item">
                    <img src="https://whitneybond.com/wp-content/uploads/2015/03/Vegetarian-Pesto-Tortellini-6.jpg"
                        alt="Tortellini" class="menu1-image">
                    <div class="menu1-item-dets">
                        <p class="menu1-item-heading">Tortellini</p>
                        <p class="g-price">$8.99</p>
                    </div>
                    <div class="counter">
                        <span class="down" onClick='decreaseCount(event, this)'>-</span>
                        <input type="text" value="0">
                        <span class="up" onClick='increaseCount(event, this)'>+</span>
                    </div>
                </li>
                <!--    Menu Item 5    -->
                <li class="menu1-item">
                    <img src="https://www.licious.in/blog/wp-content/uploads/2022/06/shutterstock_1264839352.jpg"
                        alt="Chicken Salad" class="menu1-image">
                    <div class="menu1-item-dets">
                        <p class="menu1-item-heading">Chicken Salad</p>
                        <p class="g-price">$5.75</p>
                    </div>
                    <div class="counter">
                        <span class="down" onClick='decreaseCount(event, this)'>-</span>
                        <input type="text" value="0">
                        <span class="up" onClick='increaseCount(event, this)'>+</span>
                    </div>
                </li>
            </ul>
        </div>

    </div>









</div>

<!--end::Content wrapper-->

<?php require "footer.php"; 
}
else{
    echo "<script>window.location.href = 'index.php'; </script>";
}
?>

<script>
var elements = Array.prototype.slice.call(document.querySelectorAll("[data-bs-stacked-modal]"));

if (elements && elements.length > 0) {
    elements.forEach((element) => {
        if (element.getAttribute("data-kt-initialized") === "1") {
            return;
        }

        element.setAttribute("data-kt-initialized", "1");

        element.addEventListener("click", function(e) {
            e.preventDefault();

            const modalEl = document.querySelector(this.getAttribute("data-bs-stacked-modal"));

            if (modalEl) {
                const modal = new bootstrap.Modal(modalEl);
                modal.show();
            }
        });
    });
}
</script>

<style>
body {
    background-image: url('../img/background.webp');
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    min-height: 100vh;
    font-family: "Poppins", sans-serif;
}

.counter {
    margin: auto;
    display: flex;
    align-items: center;
    justify-content: end;
}

.counter input {
    width: 50px;
    border: 0;
    line-height: 30px;
    font-size: 20px;
    text-align: center;
    background: #2884EF;
    color: #fff;
    appearance: none;
    outline: 0;
}

.counter.disable {
    pointer-events: none !important;
}

.counter.disable input {
    background: #bfbfbf;
}

.counter.disable span {
    color: #bfbfbf;
}

.counter span {
    display: block;
    font-size: 25px;
    padding: 0 10px;
    cursor: pointer;
    color: #0052cc;
    user-select: none;
}

h2,
.g-price {
    font-size: 32px;
    font-weight: 700;
    margin-bottom: 50px;
}

.g-price {
    margin: 8px 0;
}


@media (max-width: 470px) {

    .screen-togo,
    .screen-cart {
        width: 400px !important;
    }

}

.screen-togo,
.screen-cart {
    width: 100%;
    border: solid #d1d4e3 3px;
    border-radius: 5px;
    background: white;
    padding-top: 10px;
    padding-left: 30px;
    margin: 20px;
    box-shadow: 0px 0px 70px rgba(0, 0, 0, 0.1);
}

ul {
    padding: 0;
    list-style: none;
}

.menu1-item {
    background: #E4F0FD;
    border-radius: 20px 0 0 20px;
    margin: 30px 0;
    padding-top: 15px;
    padding-right: 30px;
    padding-bottom: 10px;
    position: relative;
}

.menu1-item:nth-child(2n) {
    background: #FBE4F0;
}

.menu1-item:nth-child(3n) {
    background: #F7F7FE;
}

.menu1-item:nth-child(4n) {
    background: #E4FDF1;
}

.menu1-item img {
    width: 150px;
    position: absolute;
    top: -20px;
    left: -20px;
}

.menu1-item .add-button {
    position: absolute;
    border: none;
    background: #6B00F5;
    padding: 6px 20px 4px;
    border-radius: 20px;
    color: white;
    font-weight: 700;
    font-size: 16px;
    bottom: -10px;
    left: 150px;
    transition: all 0.3s;
}

.menu1-item .add-button:hover {
    background: #5815AE;
}

.menu1-item-dets {
    margin-left: 150px;
    padding-bottom: 15px;
}

.menu1-item-heading {
    font-size: 18px;
    margin: 10px 0 12px;
}

.screen-cart {
    padding-right: 30px;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translate(10px);
    }

    to {
        opacity: 1;
        transform: translate(0);
    }
}

.cart-item {
    display: flex;
    align-items: flex-start;
    padding-bottom: 25px;
    margin-bottom: 25px;
    border-bottom: 1px solid #D7D7F9;
    animation: fadeIn 0.3s;
}

.cart-item:last-child {
    border-bottom: 5px solid #D7D7F9;
}

.cart-item img {
    width: 65px;
}

.cart-item .g-price {
    font-size: 24px;
}

.cart-item-dets {
    margin-left: 15px;
    width: 100%;
}

.cart-item-heading {
    margin: 10px 0;
}

.cart-math-item {
    margin: 5px 0;
    font-weight: 700;
}

.cart-math-item span {
    display: inline-block;
    text-align: right;
}

.cart-math-item .cart-math-header {
    width: 50%;
}

.cart-math-item .g-price {
    width: 40%;
}
</style>

<!-- jQuery -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>

<script>
let subtotal = 0;

const calculateTax = subtotal => {
    const tax = subtotal * 0.13;
    const formattedTax = tax.toFixed(2);
    return formattedTax;
};

const calculateTotal = subtotal => {
    const tax = calculateTax(subtotal);
    const total = parseFloat(subtotal) + parseFloat(tax);
    const formattedTotal = total.toFixed(2);
    return formattedTotal;
};

const getImgLink = title => {
    let imgLink;
    switch (title) {
        case 'French Fies with Ketchup':
            imgLink =
                'https://images.themodernproper.com/billowy-turkey/production/posts/2022/Homemade-French-Fries_8.jpg?w=960&h=960&q=82&fm=jpg&fit=crop&dm=1662474181&s=f6b09b96f732330eca2aae43140b3ffa';
            break;
        case 'Salmon and Vegetables':
            imgLink = 'https://24carrotkitchen.com/wp-content/uploads/2015/08/DSC_0965_9083.jpg';
            break;
        case 'Spaghetti with Sauce':
            imgLink = 'https://www.hintofhealthy.com/wp-content/uploads/2020/07/Healthy-Spaghetti-Sauce-1.jpg';
            break;
        case 'Tortellini':
            imgLink = 'https://whitneybond.com/wp-content/uploads/2015/03/Vegetarian-Pesto-Tortellini-6.jpg';
            break;
        case 'Chicken Salad':
            imgLink = 'https://www.licious.in/blog/wp-content/uploads/2022/06/shutterstock_1264839352.jpg';
            break;
        default:
            imgLink = 'https://assets.codepen.io/687837/plate__chicken-salad.png';
    }

    return imgLink;
};

$('.add-button').on('click', function() {
    const title = $(this).data('title');
    const price = $(this).data('price');
    const imgLink = getImgLink(title);

    const element = `
    <li class="cart-item">
      <img src="${imgLink}" alt="${title}">
      <div class="cart-item-dets">
        <p class="cart-item-heading">${title}</p>
        <p class="g-price">$${price}</p>
      </div>
    </li>
  `;
    $('.cart-items').append(element);

    subtotal = subtotal + price;

    const formattedSubtotal = subtotal.toFixed(2);
    const tax = calculateTax(subtotal);
    const total = calculateTotal(subtotal);

    $('.cart-math').html(`
    <p class="cart-math-item">
      <span class="cart-math-header">Subtotal:</span>
      <span class="g-price subtotal">$${formattedSubtotal}</span>
    </p>
    <p class="cart-math-item">
      <span class="cart-math-header">Tax:</span>
      <span class="g-price tax">$${tax}</span>
    </p>
    <p class="cart-math-item">
      <span class="cart-math-header">Total:</span>
      <span class="g-price total">$${total}</span>
    </p>
  `);
});
</script>

<!-- JS for counter -->
<script>
function increaseCount(a, b) {
    var input = b.previousElementSibling;
    var value = parseInt(input.value, 10);
    value = isNaN(value) ? 0 : value;
    value++;
    input.value = value;
}

function decreaseCount(a, b) {
    var input = b.nextElementSibling;
    var value = parseInt(input.value, 10);
    if (value > 0) {
        value = isNaN(value) ? 0 : value;
        value--;
        input.value = value;
    }
}
</script>