<?php
require "d_head.php";
$stmt = $conn->prepare("SELECT l_token FROM `users` WHERE `username` = ?");
$stmt->bind_param('s', $_SESSION['username']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
if ($user['l_token'] == isset($_SESSION['token']) && isset($_SESSION['username']) && session_status() === PHP_SESSION_ACTIVE && $_SESSION['usertype']) {

    require "menu.php";
    require "chart.php";
    require "function.php";
?>




<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">

            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <!--begin::Item-->

                <li class="breadcrumb-item">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                        Dashboard </h1>
                </li>

                <li class="breadcrumb-item text-muted"><img src="assets/media/stock/etc/live.png" width="60px"> </li>
                <!--end::Item-->
            </ul>
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
                <li class="breadcrumb-item text-muted">Dashboards </li>

                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->



        </div>

    </div>
    <!--end::Toolbar container-->
</div>

<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">

    <div id="kt_app_content_container" class="app-container container-fluid">

        <?php
            if ($_SESSION['usertype'] == 'admin') {

            ?>
        <div class="row g-3 g-xl-10 mb-3 mb-xl-3">

            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-3">
                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                    <!--begin::Number-->
                    <div class="d-flex align-items-center">
                        <span class="svg-icon fs-3 text-success me-2">

                        </span>
                        <div class="fs-2 fw-bold" data-kt-countup="true" id="totaladmin"></div>
                    </div>
                    <!--end::Number-->

                    <!--begin::Label-->
                    <div class="fw-semibold fs-6 ">Total Admins</div>
                    <!--end::Label-->
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-3">
                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                    <!--begin::Number-->
                    <div class="d-flex align-items-center">
                        <span class="svg-icon fs-3 text-success me-2">

                        </span>
                        <div class="fs-2 fw-bold" id="totalradmins" data-kt-countup="true"></div>
                    </div>
                    <!--end::Number-->

                    <!--begin::Label-->
                    <div class="fw-semibold fs-6 ">Total Restaurent Admins</div>
                    <!--end::Label-->
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-3">
                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                    <!--begin::Number-->
                    <div class="d-flex align-items-center">
                        <span class="svg-icon fs-3 text-success me-2">

                        </span>
                        <div class="fs-2 fw-bold" data-kt-countup="true" id="totaltacc"></div>
                    </div>
                    <!--end::Number-->

                    <!--begin::Label-->
                    <div class="fw-semibold fs-6 ">Total Tables Users</div>
                    <!--end::Label-->
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-3">
                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                    <!--begin::Number-->
                    <div class="d-flex align-items-center">
                        <span class="svg-icon fs-3 text-success me-2">

                        </span>
                        <div class="fs-2 fw-bold" data-kt-countup="true" id="notlogged"></div>
                    </div>
                    <!--end::Number-->

                    <!--begin::Label-->
                    <div class="fw-semibold fs-6 ">Total Users Not Logged Once</div>
                    <!--end::Label-->
                </div>
            </div>



        </div>
        <div class="row g-3 g-xl-10 mb-3 mb-xl-3">

            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-3">
                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                    <!--begin::Number-->
                    <div class="d-flex align-items-center">
                        <span class="svg-icon fs-3 text-success me-2">

                        </span>
                        <div class="fs-2 fw-bold" data-kt-countup="true" id="todayordercount"></div>
                    </div>
                    <!--end::Number-->

                    <!--begin::Label-->
                    <div class="fw-semibold fs-6 ">Total Orders Today</div>
                    <!--end::Label-->
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-3">
                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                    <!--begin::Number-->
                    <div class="d-flex align-items-center">
                        <span class="svg-icon fs-3 text-success me-2">

                        </span>
                        <div class="fs-2 fw-bold" id="totalorders" data-kt-countup="true"></div>
                    </div>
                    <!--end::Number-->

                    <!--begin::Label-->
                    <div class="fw-semibold fs-6 ">Total Orders Till Now</div>
                    <!--end::Label-->
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-3">
                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                    <!--begin::Number-->
                    <div class="d-flex align-items-center">
                        <span class="svg-icon fs-3 text-success me-2">

                        </span>
                        <div class="fs-2 fw-bold" data-kt-countup="true" id="totalmenuitems"></div>
                    </div>
                    <!--end::Number-->

                    <!--begin::Label-->
                    <div class="fw-semibold fs-6 ">Total Menu Items</div>
                    <!--end::Label-->
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-3">
                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                    <!--begin::Number-->
                    <div class="d-flex align-items-center">
                        <span class="svg-icon fs-3 text-success me-2">

                        </span>
                        <div class="fs-2 fw-bold" data-kt-countup="true" id="ttotalmenuitems"></div>
                    </div>
                    <!--end::Number-->

                    <!--begin::Label-->
                    <div class="fw-semibold fs-6 ">Total Menu Items added today</div>
                    <!--end::Label-->
                </div>
            </div>



        </div>




        <!-- <div class="row g-5 g-xl-10 mb-5 mb-xl-10">

                    <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 mb-md-5 mb-xl-10">
                        <div class="card card-bordered">
                            <div class="card-body">
                                <div id="kt_docs_google_chart_column" style="width:100%; margin: 35px auto;"></div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 mb-md-5 mb-xl-10">

                        <div class="card card-bordered">
                            <div class="card-body">
                                <div id="kt_docs_google_chart_line" style="  width:100%;margin: 35px auto;"></div>
                            </div>
                        </div>
                    </div>

                </div> -->
        <?php
            }

            ?>




        <!-- for radmin analyticc start -->

        <?php
            if ($_SESSION['usertype'] == 'radmin') {

            ?>
        <div class="row g-3 g-xl-10 mb-3 mb-xl-3">

            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-3">
                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                    <!--begin::Number-->
                    <div class="d-flex align-items-center">
                        <span class="svg-icon fs-3 text-success me-2">

                        </span>
                        <div class="fs-2 fw-bold" data-kt-countup="true" id="utable"></div>
                    </div>
                    <!--end::Number-->

                    <!--begin::Label-->
                    <div class="fw-semibold fs-6 ">Total Tables Added</div>
                    <!--end::Label-->
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-3">
                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                    <!--begin::Number-->
                    <div class="d-flex align-items-center">
                        <span class="svg-icon fs-3 text-success me-2">

                        </span>
                        <div class="fs-2 fw-bold" id="rmenu" data-kt-countup="true"></div>
                    </div>
                    <!--end::Number-->

                    <!--begin::Label-->
                    <div class="fw-semibold fs-6 ">Total Menu Items Created</div>
                    <!--end::Label-->
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-3">
                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                    <!--begin::Number-->
                    <div class="d-flex align-items-center">
                        <span class="svg-icon fs-3 text-success me-2">

                        </span>
                        <div class="fs-2 fw-bold" data-kt-countup="true" id="todayorderu"></div>
                    </div>
                    <!--end::Number-->

                    <!--begin::Label-->
                    <div class="fw-semibold fs-6 ">Total Orders Today</div>
                    <!--end::Label-->
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-3">
                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                    <!--begin::Number-->
                    <div class="d-flex align-items-center">
                        <span class="svg-icon fs-3 text-success me-2">

                        </span>
                        <div class="fs-2 fw-bold" data-kt-countup="true" id="todayallorderu"></div>
                    </div>
                    <!--end::Number-->

                    <!--begin::Label-->
                    <div class="fw-semibold fs-6 ">Total orders</div>
                    <!--end::Label-->
                </div>
            </div>



        </div>

        <?php

// Fetch Menu Data
$menu_data = [];
$menu_sql = "SELECT item, price, avaibility FROM r_menu";
$menu_result = $conn->query($menu_sql);
if ($menu_result->num_rows > 0) {
    while ($row = $menu_result->fetch_assoc()) {
        $menu_data[] = $row;
    }
}

// Fetch Order Data
$order_data = [];
$order_sql = "SELECT total, timestamp FROM orders";
$order_result = $conn->query($order_sql);
if ($order_result->num_rows > 0) {
    while ($row = $order_result->fetch_assoc()) {
        $order_data[] = $row;
    }
}

// Prepare Input Text for GPT-2
$menu_json = json_encode($menu_data);
$order_json = json_encode($order_data);

$input_text = "Analyze restaurant data to generate actionable insights. Analyze restaurant data to generate actionable insights. Return the result strictly in JSON format with the following structure:
{
  \"best_selling_items\": [\"item1\", \"item2\"],
  \"peak_hours\": [\"hour1\", \"hour2\"],
  \"suggestions\": \"string with improvement suggestions\"
}. Here is the menu data: " 
    . $menu_json . " and order data: " . $order_json . ". Provide analysis for best-selling items, peak hours, and suggest improvements.";

    $api_url = "https://openrouter.ai/api/v1/chat/completions";
    $api_key = "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"; // Replace with your OpenRouter API key
    
    // API Payload
    $data = json_encode([
        "model" => "deepseek/deepseek-chat-v3-0324:free", // Using DeepSeek's free version
        "messages" => [
            [
                "role" => "user",
                "content" => $input_text
            ]
        ]
    ]);
    
    // cURL Setup
    $ch = curl_init($api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer $api_key",
        "Content-Type: application/json"
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    
    // API Response
    $response = curl_exec($ch);
    curl_close($ch);
    
    // Decode API Response
    $result = json_decode($response, true);
    
    // Check for API Response
    if (isset($result['choices'][0]['message']['content'])) {
        $response_text = trim($result['choices'][0]['message']['content']);

        // Extract JSON using regex (removes ```json or any unwanted text)
        $json_string = preg_replace('/```json|```/', '', $response_text);
        
        // Decode the JSON string
        $json_response = json_decode($json_string, true);
    
        // Check if JSON decoding was successful
        if (json_last_error() === JSON_ERROR_NONE) {
            // Log the parsed JSON to the console
            echo "<script>console.log('OpenRouter Insights:', " . json_encode($json_response, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . ");</script>";
            
            // You can now access the JSON elements like this:
            $best_selling_items = $json_response['best_selling_items'];
            $peak_hours = $json_response['peak_hours'];
            $suggestions = $json_response['suggestions'];

            // Sort peak hours and order data together based on time
            array_multisort($peak_hours);
                    
            // Convert 24-hour format to 12-hour format
            function convertTo12Hour($time) {
                return date("g:i A", strtotime($time));
            }
            
            // Apply conversion to all peak hours
            $peak_hours_12hr = array_map('convertTo12Hour', $peak_hours);
                    
            // Split the string based on numbered pattern (e.g., "1.", "2.", "3.")
            $suggestionList = preg_split('/\d+\.\s/', $suggestions, -1, PREG_SPLIT_NO_EMPTY);
    
            // echo "<h3>Peak Hours:</h3>";
            // foreach ($peak_hours as $hours) {
            //     echo "<p>$hours</p>";
            // }

            ?>

        <div class="row justify-content-center">
            <div class="col-6">
                <div class="text-center mb-4">
                    <h2 class="fw-bold text-success">Best-Selling Items</h2>
                    <p class="text-muted">Check out our top-rated dishes!</p>
                </div>

                <div class="row justify-content-left gap-6 p-2">
                    <!-- Card 1 -->
                    <?php 
                    foreach ($best_selling_items as $item) {
                        echo "<div class='card w-auto shadow-sm border-0' style='padding: 0;'>
                        <div class='card-body text-center' style='padding: 15px 25px;''>
                            <h5 class='card-title text-capitalize fw-bold'>$item</h5>
                        </div>
                    </div>";
                    }
                    ?>

                    <div class="text-center mt-2">
                        <h2 class="fw-bold text-primary">Peak Hours</h2>
                        <p class="text-muted">Check out the busiest hours of the day!</p>
                    </div>

                    <div class="card border-0">
                        <div class="card-body">
                            <canvas id="peakHoursChart" height="100"></canvas>
                        </div>
                    </div>

                </div>

            </div>

            <div class="col-6">
                <div class="text-center mb-4">
                    <h2 class="fw-bold text-warning">💡 Business Suggestions 💡</h2>
                    <p class="text-muted">Insights to improve efficiency and customer satisfaction.</p>
                </div>

                <!-- Suggestion Card -->
                <div class="card pb-4 border-0">
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <!-- Suggestion 1 -->
                            <li class="list-group-item d-flex align-items-start">
                                <div>
                                    <p class="text mb-0"><?php 
                                    foreach ($suggestionList as $index => $suggestion) {
                                        echo ($index + 1) . '. ' . trim($suggestion) . "<br><br>";
                                    }
                                    ?></p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- Call to Action -->
                    <div class="text-center">
                        <button class="btn btn-warning">View Detailed Insights</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
        // Data for peak hours
        const peakHoursData = {
            labels: <?php echo json_encode($peak_hours_12hr); ?>,
            datasets: [{
                label: 'Number of Orders',
                data: [5, 10, 15], // You can update these values based on real data
                backgroundColor: ['#ff6384', '#36a2eb', '#4caf50'],
                borderColor: '#ddd',
                borderWidth: 1,
                barThickness: 50
            }]
        };

        // Config for the chart
        const config = {
            type: 'bar',
            data: peakHoursData,
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Orders'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Time of Day'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        };

        // Render the chart
        const ctx = document.getElementById('peakHoursChart').getContext('2d');
        new Chart(ctx, config);
        </script>

        <?php
        } else {
        // Handle JSON parsing error
        echo "<script>
        console.error('Error parsing JSON response.');
        </script>";
        }
        } else {
        echo "<script>
        console.error('Error generating response from OpenRouter.');
        </script>";
        }
        ?>


    </div>
</div>


<?php } ?>
<!-- for radmin analyticc end -->

</div>

</div>



<script>
$(document).ready(function() {
    // Make AJAX request to retrieve data

    $.ajax({
        url: 'phpdata/live_a_u.php',
        dataType: 'json',
        success: function(data) {
            // Update data placeholders
            $('#totalradmins').text(data.totalradmin);
            $('#totaladmin').text(data.totaladmin);
            $('#totaltacc').text(data.totaltacc);
            $('#notlogged').text(data.notlogged);
            $('#todayordercount').text(data.todayordercount);
            $('#totalorders').text(data.totalorders);
            $('#totalmenuitems').text(data.totalmenuitems);
            $('#ttotalmenuitems').text(data.ttotalmenuitems);
            $('#utable').text(data.utable);
            $('#rmenu').text(data.rmenu);
            $('#todayorderu').text(data.todayorderu);
            $('#todayallorderu').text(data.todayallorderu);






        }
    });

    // Refresh data every 5 seconds
    setInterval(function() {
        $.ajax({
            url: 'phpdata/live_a_u.php',
            dataType: 'json',
            success: function(data) {
                // Update data placeholders
                $('#totalradmins').text(data.totalradmin);
                $('#totaladmin').text(data.totaladmin);
                $('#totaltacc').text(data.totaltacc);
                $('#notlogged').text(data.notlogged);
                $('#todayordercount').text(data.todayordercount);
                $('#totalorders').text(data.totalorders);
                $('#totalmenuitems').text(data.totalmenuitems);
                $('#ttotalmenuitems').text(data.ttotalmenuitems);
                $('#utable').text(data.utable);
                $('#rmenu').text(data.rmenu);
                $('#todayorderu').text(data.todayorderu);
                $('#todayallorderu').text(data.todayallorderu);

            }
        });
    }, 5000);
});
</script>

<?php require "footer.php";
} else {
    echo "<script>window.location.href = 'index.php'; </script>";
}
?>