    <?php
        include_once 'nav/homenav.php';
    ?>

        <div class="hero-section" style="position: relative;">
            <img src="../images/CVP.jpg" alt="Barkada Room" style="width: 100%; height: 600px; object-fit: cover;">
        </div>

    <div style="max-width: 1500px; margin: -30px auto 50px; padding: 2rem 1rem; position: relative; background-color: #2c3e50; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <div style="text-align: center; margin-bottom: 4rem; padding-bottom: 2rem; border-bottom: 2px solid #f0e6dd;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap;">
                    <h2 style="color: rgb(218, 191, 156); font-size: 2.8rem; font-family: 'impact'; margin-top:10px; text-transform: uppercase; letter-spacing: 1px;">
                        Cv room 8 pax
                    </h2>
                    <div style="background: rgb(218, 191, 156); padding: 0.8rem 1.5rem; border-radius: 12px; margin-top: 10px;">
                        <p style="color: white; margin: 0;"><span style="font-size: 2rem; font-weight: bold;">₱5,999</span></p>
                    </div>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 2rem; margin-bottom: 4rem; max-width: 1500px; margin-left: auto; margin-right: auto;">
                <div style="text-align: center; padding: 3rem; background: #f9f6f2; border-radius: 15px; transition: transform 0.3s; cursor: pointer; border: 1px solid #e6d5c5;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                    <i class="fas fa-bed" style="font-size: 2.5rem; color: rgb(102, 67, 35); margin-bottom: 1.5rem;"></i>
                    <h3 style="color: rgb(102, 67, 35); font-size: 1.8rem; font-family: 'impact'; margin-bottom: 0.8rem;">Bed</h3>
                    <p style="color: #666; font-size: 1.2rem;">8 Single-sized Beds</p>
                </div>
                <div style="text-align: center; padding: 2.5rem; background: #f9f6f2; border-radius: 15px; transition: transform 0.3s; cursor: pointer; border: 1px solid #e6d5c5;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                    <i class="fas fa-users" style="font-size: 2.5rem; color: rgb(102, 67, 35); margin-bottom: 1.5rem;"></i>
                    <h3 style="color: rgb(102, 67, 35); font-size: 1.8rem; font-family: 'impact'; margin-bottom: 0.8rem;">Capacity</h3>
                    <p style="color: #666; font-size: 1.2rem;">8 Person</p>
                </div>
            </div>

            <div style="background: #f9f6f2; padding: 3rem; border-radius: 20px; border: 1px solid #e6d5c5;">
                <h3 style="color: rgb(102, 67, 35); font-size: 2rem; font-family: 'impact'; margin-bottom: 2rem; text-align: center;">Room Features</h3>
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem;">
                    <div style="display: flex; align-items: center; gap: 1rem; background: white; padding: 1rem; border-radius: 10px;">
                        <i class="fas fa-check-circle" style="color: rgb(102, 67, 35); font-size: 1.2rem;"></i>
                        <span style="color: #666;">Shared Bathroom</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 1rem; background: white; padding: 1rem; border-radius: 10px;">
                        <i class="fas fa-check-circle" style="color: rgb(102, 67, 35); font-size: 1.2rem;"></i>
                        <span style="color: #666;">TV & Wifi in Rooms</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 1rem; background: white; padding: 1rem; border-radius: 10px;">
                        <i class="fas fa-check-circle" style="color: rgb(102, 67, 35); font-size: 1.2rem;"></i>
                        <span style="color: #666;">Free use of swimming pool</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 1rem; background: white; padding: 1rem; border-radius: 10px;">
                        <i class="fas fa-check-circle" style="color: rgb(102, 67, 35); font-size: 1.2rem;"></i>
                        <span style="color: #666;">Room Service</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 1rem; background: white; padding: 1rem; border-radius: 10px;">
                        <i class="fas fa-check-circle" style="color: rgb(102, 67, 35); font-size: 1.2rem;"></i>
                        <span style="color: #666;">Breakfast Included for 2</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 1rem; background: white; padding: 1rem; border-radius: 10px;">
                        <i class="fas fa-check-circle" style="color: rgb(102, 67, 35); font-size: 1.2rem;"></i>
                        <span style="color: #666;">Air conditioning</span>
                    </div>
                </div>
            </div>
    </div>

    <div style="background: #f9f6f2; padding: 2rem; border-radius: 20px; max-width: 1500px; margin: 0 auto 4rem auto; border: 1px solid #e6d5c5;">
        <h2 style="color: rgb(102, 67, 35); font-size: 2rem; font-family: 'impact'; text-align: center; margin-bottom: 2rem;">Book Your Stay</h2>
        
            <div id="calendar-container">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                    <button onclick="changeMonth(-1)" style="background: rgb(102, 67, 35); color: white; padding: 0.5rem 1rem; border: none; border-radius: 5px; cursor: pointer;">&lt; Prev</button>
                    <div id="current-month" style="font-size: 1.2rem; font-weight: bold; color: rgb(102, 67, 35);"></div>
                    <button onclick="changeMonth(1)" style="background: rgb(102, 67, 35); color: white; padding: 0.5rem 1rem; border: none; border-radius: 5px; cursor: pointer;">Next &gt;</button>
                </div>

                <div style="display: grid; grid-template-columns: repeat(7, 1fr); text-align: center; gap: 0.5rem; margin-bottom: 1.5rem;">
                    <div style="font-weight: bold; color: rgb(102, 67, 35);">Sun</div>
                    <div style="font-weight: bold; color: rgb(102, 67, 35);">Mon</div>
                    <div style="font-weight: bold; color: rgb(102, 67, 35);">Tue</div>
                    <div style="font-weight: bold; color: rgb(102, 67, 35);">Wed</div>
                    <div style="font-weight: bold; color: rgb(102, 67, 35);">Thu</div>
                    <div style="font-weight: bold; color: rgb(102, 67, 35);">Fri</div>
                    <div style="font-weight: bold; color: rgb(102, 67, 35);">Sat</div>
                </div>

                <div id="calendar-days" style="display: grid; grid-template-columns: repeat(7, 1fr); gap: 0.5rem;"></div>
            </div>

            <div style="margin-top: 2rem;">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem;">
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; color: rgb(102, 67, 35);">Check-in Date*</label>
                        <input type="date" id="check-in" style="width: 100%; padding: 0.5rem; border: 1px solid #e6d5c5; border-radius: 5px;">
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; color: rgb(102, 67, 35);">Check-out Date*</label>
                        <input type="date" id="check-out" style="width: 100%; padding: 0.5rem; border: 1px solid #e6d5c5; border-radius: 5px;">
                    </div>
                </div>
                <button onclick="checkAvailability()" style="width: 100%; background: rgb(102, 67, 35); color: white; padding: 1rem; border: none; border-radius: 5px; font-size: 1.1rem; cursor: pointer; transition: background 0.3s;" onmouseover="this.style.background='rgb(122, 87, 55)'" onmouseout="this.style.background='rgb(102, 67, 35)'">Check Availability</button>
            </div>
    </div>

        <script>
        let currentDate = new Date();
        let selectedDates = [];

        function renderCalendar() {
            const calendarDays = document.getElementById('calendar-days');
            const currentMonthDisplay = document.getElementById('current-month');
            
            // Clear previous calendar
            calendarDays.innerHTML = '';
            
            // Set month and year display
            currentMonthDisplay.textContent = currentDate.toLocaleString('default', { month: 'long', year: 'numeric' });
            
            // Get first day of month and total days
            const firstDay = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);
            const lastDay = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0);
            
            // Add empty cells for days before first day of month
            for(let i = 0; i < firstDay.getDay(); i++) {
                const emptyDay = document.createElement('div');
                calendarDays.appendChild(emptyDay);
            }
            
            // Add days of month
            for(let day = 1; day <= lastDay.getDate(); day++) {
                const dayElement = document.createElement('div');
                dayElement.textContent = day;
                dayElement.style.padding = '0.5rem';
                dayElement.style.background = '#fff';
                dayElement.style.borderRadius = '5px';
                dayElement.style.cursor = 'pointer';
                dayElement.style.transition = 'all 0.3s';
                
                const dateString = `${currentDate.getFullYear()}-${(currentDate.getMonth()+1).toString().padStart(2, '0')}-${day.toString().padStart(2, '0')}`;
                
                dayElement.addEventListener('click', () => selectDate(dateString, dayElement));
                
                // Disable past dates
                const dayDate = new Date(dateString);
                if(dayDate < new Date().setHours(0,0,0,0)) {
                    dayElement.style.color = '#ccc';
                    dayElement.style.cursor = 'not-allowed';
                }
                
                calendarDays.appendChild(dayElement);
            }
        }

        function changeMonth(delta) {
            currentDate.setMonth(currentDate.getMonth() + delta);
            renderCalendar();
        }

        function selectDate(dateString, element) {
            const date = new Date(dateString);
            if(date < new Date().setHours(0,0,0,0)) return;
            
            if(selectedDates.length === 2) {
                selectedDates = [];
                document.querySelectorAll('#calendar-days div').forEach(div => {
                    div.style.background = '#fff';
                });
            }
            
            selectedDates.push(dateString);
            element.style.background = 'rgb(102, 67, 35)';
            element.style.color = '#fff';
            
            if(selectedDates.length === 2) {
                document.getElementById('check-in').value = selectedDates[0];
                document.getElementById('check-out').value = selectedDates[1];
            }
        }

        function checkAvailability() {
            if(!document.getElementById('check-in').value || !document.getElementById('check-out').value) {
                alert('Please select both check-in and check-out dates');
                return;
            }
            // Add your availability check logic here
            alert('Checking availability...');
        }

        // Initialize calendar
        renderCalendar();
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