    <?php
        include_once 'nav/homenav.php';
        require_once '../model/server.php';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                $connector = new Connector();
                
                $sql = "INSERT INTO messages (recipient_email, subject, message_content) 
                        VALUES (?, ?, ?)";
                
                $params = [
                    $_POST['email'],
                    $_POST['subject'],
                    $_POST['message']
                ];
                
                $result = $connector->executeQuery($sql, $params);
                
                if ($result) {
                    echo "<script>alert('A notification with the latest information will be emailed to you..');</script>";
                }
            } catch (Exception $e) {
                echo "<script>alert('Error sending message.');</script>";
            }
        }
        
    ?>



        <style>
        @media screen and (max-width: 768px) {
            .contact-grid {
                grid-template-columns: 1fr !important;
                padding: 1rem;
            }
            .input-grid {
                grid-template-columns: 1fr !important;
            }
        }
        </style>

    <section style="padding: 15rem 2rem; background: linear-gradient(to bottom, #f9f6f2, #fff);">
                    <div class="contact-grid" style="max-width: 1200px; margin: 0 auto; display: grid; grid-template-columns: 1fr 2fr; gap: 3rem; position: relative;">
                        <!-- Contact Info Side -->
                        <div style="background: white; padding: 2rem; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); transition: transform 0.3s ease; position: relative; z-index: 1;"
                            onmouseover="this.style.transform='translateY(-5px)'" 
                            onmouseout="this.style.transform='translateY(0)'">
                            <h3 style="color: rgb(102, 67, 35); font-size: 1.8rem; margin-bottom: 2rem; font-family: 'impact'; border-bottom: 2px solid rgba(163, 99, 15, 0.2); padding-bottom: 1rem;">Find Us</h3>
                            
                            <!-- Location -->
                            <div style="margin-bottom: 2rem; transition: all 0.3s ease;" onmouseover="this.style.transform='translateX(10px)'" onmouseout="this.style.transform='translateX(0)'">
                                <div style="display: flex; align-items: center; margin-bottom: 1rem;">
                                    <i class="fas fa-map-marker-alt" style="color: rgb(163, 99, 15); font-size: 1.5rem; margin-right: 1rem;"></i>
                                    <h4 style="color: rgb(102, 67, 35); font-size: 1.2rem;">Address</h4>
                                </div>
                                <p style="color: #666; line-height: 1.6; padding-left: 2.5rem;"><?=$info['contact_address']?></p>
                            </div>

                            <!-- Phone -->
                            <div style="margin-bottom: 2rem; transition: all 0.3s ease;" onmouseover="this.style.transform='translateX(10px)'" onmouseout="this.style.transform='translateX(0)'">
                                <div style="display: flex; align-items: center; margin-bottom: 1rem;">
                                    <i class="fas fa-phone" style="color: rgb(163, 99, 15); font-size: 1.5rem; margin-right: 1rem;"></i>
                                    <h4 style="color: rgb(102, 67, 35); font-size: 1.2rem;">Phone</h4>
                                </div>
                                <p style="color: #666; line-height: 1.6; padding-left: 2.5rem;"><?=$info['contact_number']?></p>
                            </div>

                            <!-- Email -->
                            <div style="margin-bottom: 2rem; transition: all 0.3s ease;" onmouseover="this.style.transform='translateX(10px)'" onmouseout="this.style.transform='translateX(0)'">
                                <div style="display: flex; align-items: center; margin-bottom: 1rem;">
                                    <i class="fas fa-envelope" style="color: rgb(163, 99, 15); font-size: 1.5rem; margin-right: 1rem;"></i>
                                    <h4 style="color: rgb(102, 67, 35); font-size: 1.2rem;">Email</h4>
                                </div>
                                <p style="color: #666; line-height: 1.6; padding-left: 2.5rem;"><?=$info['contact_email']?></p>
                            </div>
                        </div>

                        <!-- Contact Form Side -->
                        <div style="background: white; padding: 3rem; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); position: relative; z-index: 1;">
                        <form method="POST" action="contact.php" style="display: grid; gap: 1.5rem;">
                                <div class="input-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                                    <div style="position: relative;">
                                        <i class="fas fa-user" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #d4b696;"></i>
                                        <input type="text" name="name" placeholder="Your Name" required 
                                            style="padding: 1rem 1rem 1rem 3rem; border: 2px solid #d4b696; border-radius: 8px; font-size: 1rem; width: 100%;">
                                    </div>
                                    <div style="position: relative;">
                                        <i class="fas fa-envelope" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #d4b696;"></i>
                                        <input type="email" name="email" placeholder="Your Email" required 
                                            style="padding: 1rem 1rem 1rem 3rem; border: 2px solid #d4b696; border-radius: 8px; font-size: 1rem; width: 100%;">
                                    </div>
                                </div>
                                <div style="position: relative;">
                                    <i class="fas fa-heading" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #d4b696;"></i>
                                    <input type="text" name="subject" placeholder="Subject" required 
                                        style="padding: 1rem 1rem 1rem 3rem; border: 2px solid #d4b696; border-radius: 8px; font-size: 1rem; width: 100%;">
                                </div>
                                <div style="position: relative;">
                                    <i class="fas fa-comment" style="position: absolute; left: 1rem; top: 1.2rem; color: #d4b696;"></i>
                                    <textarea name="message" placeholder="Your Message" required 
                                        style="padding: 1rem 1rem 1rem 3rem; border: 2px solid #d4b696; border-radius: 8px; font-size: 1rem; min-height: 150px; resize: vertical; width: 100%;"></textarea>
                                </div>
                                <button type="submit" 
                                    style="padding: 1rem 2rem; background: linear-gradient(45deg, rgb(102, 67, 35), rgb(163, 99, 15)); 
                                        color: white; border: none; border-radius: 8px; font-size: 1.1rem; cursor: pointer; 
                                        transition: all 0.3s ease; position: relative; overflow: hidden;">
                                    <i class="fas fa-paper-plane" style="margin-right: 0.5rem;"></i>
                                    Send Message
                                </button>
                            </form>
                        </div>
                    </div>
                </section>


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