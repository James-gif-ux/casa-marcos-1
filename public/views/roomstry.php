    <?php
        include_once 'nav/homenav.php';
        include_once '../model/BookingModel.php';
        include_once '../model/Booking_Model.php';

        $model = new BookingModel();
        $bookingModel = new Booking_Model();

        // Get all services
        $services = $bookingModel->get_service();

        // Include the Connector class
        require_once '../model/server.php';
        $connector = new Connector();

        // Fetch all bookings that are pending approval
        $sql = "SELECT booking_id, booking_fullname, booking_email, booking_number, booking_check_in, booking_check_out FROM booking_tb WHERE booking_status = 'pending'";
        $bookings = $connector->executeQuery($sql);


    require_once '../model/server.php';


    ?>
    <!-- Add this in the <head> section -->
        <section class="hero">
        </section>
       
                    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; margin-top: 100px;">
                        <div style="max-width: 1200px; margin: 0 auto; background: rgba(255, 255, 255, 0.95); padding: 2rem; border-radius: 15px; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1); ">
                                    <form method="POST" action="" style="display: flex; flex-wrap: wrap; gap: 2rem; align-items: flex-end; justify-content: space-between;">
                                        <div class="flex-col" style="flex: 1; min-width: 200px;">
                                            <label for="checkin" style="display: block; color: #666; margin-bottom: 0.5rem; font-size: 0.9rem;">Check In</label>
                                            <input type="date" id="checkin" name="checkin_date" required 
                                                min="<?php echo date('Y-m-d'); ?>"
                                                style="width: 100%; padding: 0.8rem; border: 1px solid #d4b696; border-radius: 8px; font-size: 1rem;">
                                        </div>
                                        
                                        <div class="flex-col" style="flex: 1; min-width: 200px;">
                                            <label for="checkout" style="display: block; color: #666; margin-bottom: 0.5rem; font-size: 0.9rem;">Check Out</label>
                                            <input type="date" id="checkout" name="checkout_date" required
                                                style="width: 100%; padding: 0.8rem; border: 1px solid #d4b696; border-radius: 8px; font-size: 1rem;">
                                        </div>

                                        <div class="flex-col" style="flex: 1; min-width: 150px;">
                                            <label for="adults" style="display: block; color: #666; margin-bottom: 0.5rem; font-size: 0.9rem;">Adults</label>
                                            <select id="adults" name="adults" style="width: 100%; padding: 0.8rem; border: 1px solid #d4b696; border-radius: 8px; font-size: 1rem;">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                            </select>
                                        </div>

                                        <div class="flex-col" style="flex: 1; min-width: 150px;">
                                            <label for="children" style="display: block; color: #666; margin-bottom: 0.5rem; font-size: 0.9rem;">Children</label>
                                            <select id="children" name="children" style="width: 100%; padding: 0.8rem; border: 1px solid #d4b696; border-radius: 8px; font-size: 1rem;">
                                                <option value="0">0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                            </select>
                                        </div>

                                        <input type="hidden" name="search_dates" value="true">
                                        <button type="submit" style="flex: 1; min-width: 200px; padding: 1rem; background: rgb(218, 191, 156); color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: 500; transition: all 0.3s ease;">
                                            Check Availability
                                        </button>
                                    </form>
                                </div>
                    </div>

                <section>
                    ssss
                </section>
                 
                <?php
                    if (isset($_POST['submit_dates'])) {
                        try {
                            $checkin_date = $_POST['checkin_date'];
                            $checkout_date = $_POST['checkout_date'];
                            
                            // Validate dates
                            $current_date = date('Y-m-d');
                            if ($checkin_date < $current_date) {
                                throw new Exception("Check-in date cannot be in the past.");
                            }
                            if ($checkout_date <= $checkin_date) {
                                throw new Exception("Check-out date must be after check-in date.");
                            }

                            // Insert into database without status
                            $sql = "INSERT INTO booking_tb (booking_check_in, booking_check_out) VALUES (:check_in, :check_out)";
                            $stmt = $connector->getConnection()->prepare($sql);
                            $result = $stmt->execute([
                                ':check_in' => $checkin_date,
                                ':check_out' => $checkout_date
                            ]);

                            if ($result) {
                                echo "<script>
                                    alert('Dates have been successfully saved!');
                                    window.location.href = 'books.php';
                                </script>";
                                $_SESSION['check_in'] = $checkin_date;
                                $_SESSION['check_out'] = $checkout_date;
                            }
                        } catch (Exception $e) {
                            echo "<script>alert('Error: " . addslashes($e->getMessage()) . "');</script>";
                        }
                    }
                ?>
                <script>
                    document.getElementById('checkin').addEventListener('change', function() {
                        const checkIn = new Date(this.value);
                        const minCheckOut = new Date(checkIn);
                        minCheckOut.setDate(minCheckOut.getDate() + 1);
                        document.getElementById('checkout').min = minCheckOut.toISOString().split('T')[0];
                    });
                </script>

        <footer>
            <p>© 2025 Casa Marcos. All rights reserved.</p>
        </footer>

        <script>
            window.addEventListener('scroll', function () {
                const header = document.querySelector('header');
                if (window.scrollY > 50) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
            });
        </script>