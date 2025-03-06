<?php
    include 'nav/header.php';
?>
<style>
   
    .report-container {
       
        padding: 2rem;
     
    }
    .date-picker-container {
        background: white;
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        width: 50%;
    }
    .generate-btn {
        border-radius: 5px;
        padding: 5px;
        background: #2c3e50;
        transition: all 0.3s ease;
    }
    .generate-btn:hover {
        background: #34495e;
        transform: translateY(-2px);
    }
    .results-table {
        background: white;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .results-table thead {
        background: #2c3e50;
    }
    .table-row-hover:hover {
        background-color: #f8f9fa;
        transition: background-color 0.3s ease;
    }
    .total-row {
        background: #34495e !important;
        color: white !important;
    }
    @media print {
        .btn, .report-header p, form {
            display: none !important;
        }
        .results-table {
            box-shadow: none !important;
        }
        @page {
            size: landscape;
        }
    }
</style>

<div class="container mt-5 report-container">
    <div class="row">
        <div class="col-md-12">

            <div class="card border-0">
                <div class="card-body date-picker-container">
                    <form method="POST" action="" class="mb-4">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="start_date" class="form-label fw-bold">
                                        <i class="fas fa-calendar-alt me-2"></i>Start Date:
                                    </label>
                                    <input type="date" class="form-control form-control-lg" id="start_date" name="start_date" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="end_date" class="form-label fw-bold">
                                        <i class="fas fa-calendar-alt me-2"></i>End Date:
                                    </label>
                                    <input type="date" class="form-control form-control-lg" id="end_date" name="end_date" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="invisible">Generate:</label>
                                <button type="submit" class="btn generate-btn btn-lg w-100 text-white">
                                    <i class="fas fa-sync-alt me-2"></i>Generate Report
                                </button>
                            </div>
                        </div>
                    </form>

                    
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section>
        <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        // Get the date range
                        $start_date = $_POST['start_date'];
                        $end_date = $_POST['end_date'];

                        // Database connection
                        require_once '../model/server.php';
                        
                        try {
                            $connector = new Connector();
                            
                            // Query to get booking data
                            $query = "SELECT 
                                        DATE(booking_check_in) as date,
                                        COUNT(*) as total_bookings,
                                        SUM(CASE WHEN booking_status = 'completed' THEN 1 ELSE 0 END) as completed_bookings,
                                        SUM(CASE WHEN booking_status = 'pending' THEN 1 ELSE 0 END) as pending_bookings,
                                        SUM(CASE WHEN booking_status = 'approved' THEN 1 ELSE 0 END) as approved_bookings,
                                        SUM(total_amount) as daily_revenue
                                    FROM booking_tb 
                                    WHERE booking_check_in BETWEEN ? AND ?
                                    GROUP BY DATE(booking_check_in)
                                    ORDER BY date";
                            
                            $stmt = $connector->getConnection()->prepare($query);
                            $stmt->execute(array($start_date, $end_date));
                            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            $stmt->execute();
                            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            
                            // Initialize totals
                            $total_revenue = 0;
                            $total_bookings = 0;
                    ?>       


                            <div class="d-flex justify-content-end mb-3">
                                <button onclick="window.print()" class="btn btn-secondary" style="background-color:rgb(66, 214, 69); padding:5px; border-radius:5px; margin-left: 95%; top:0; left:0; position:relative;" title="Print Reports">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-printer" viewBox="0 0 16 16">
                                        <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1"/>
                                        <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="results-table mt-4 table-responsive">
                                <table class="table table-hover mb-0 text-center" style="min-width: 100%;">
                                    <thead>
                                        <tr>
                                            <th class="px-4 py-3" style="width: 25%;">Date</th>
                                            <th class="px-4 py-3" style="width: 25%;">Total Bookings</th>
                                            <th class="px-4 py-3" style="width: 25%;">Completed</th>
                                            <th class="px-4 py-3" style="width: 25%;">Daily Revenue</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($result as $row) {
                                            echo "<tr class='table-row-hover'>";
                                            echo "<td class='px-4 py-3 text-center'>" . date('F d, Y', strtotime($row['date'])) . "</td>";
                                            echo "<td class='px-4 py-3 text-center'>" . $row['total_bookings'] . "</td>";
                                            echo "<td class='px-4 py-3 text-center'>" . $row['completed_bookings'] . "</td>";
                                            echo "<td class='px-4 py-3 text-center'>₱" . number_format($row['daily_revenue'], 2) . "</td>";
                                            echo "</tr>";
                                            
                                            $total_revenue += $row['daily_revenue'];
                                            $total_bookings += $row['total_bookings'];
                                            $total_bookings += $row['completed_bookings'];
                                        }
                                        ?>
                                        <tr class="total-row">
                                            <td class="px-4 py-3 fw-bold text-center">Total</td>
                                            <td class="px-4 py-3 fw-bold text-center"><?php echo $total_bookings; ?></td>
                                            <td class="px-4 py-3 fw-bold text-center"><?php echo $total_bookings; ?></td>
                                            <td class="px-4 py-3 fw-bold text-center">₱<?php echo number_format($total_revenue, 2); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                    <?php
                        } catch (Exception $e) {
                            echo "Error: " . $e->getMessage();
                        }
                    }
                    ?>
        </section>     
    </div>
</div>
