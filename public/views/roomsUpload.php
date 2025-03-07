<?php

    include 'nav/header.php';
    require_once '../model/server.php';
    include_once '../model/Booking_Model.php';
    $bookingModel = new Booking_Model();

    $services = $bookingModel->get_service();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Casa Marcos Rooms</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        
        <style>
            @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css");
            h1{
                text-align: left;
                margin-top: 30px;
                padding: 10px;
                font-size: 30px;
                font-weight: bold;
            }
            select{
                width: 24.5%;
                border: 1px solid #ccc;
                padding: 5px;
                margin-left: 10px;
            }
            input{
                width: 30%;
                margin-left: 10px;
                font-size: 20px;
            }
            table{
                border-collapse: collapse;
            }
            th{
                background-color: gray;
                padding: 10px;
            }
            .room-image {
                max-width: 150px;
                height: auto;
            }
            td {
                padding: 9px;
                text-align: center;
                vertical-align: middle;
            }
            textarea{
                width: 50%; 
                margin-left: 10px; 
                padding: 5px; 
                height: 100px;
                border: 1px solid #ccc;
            }
            .image{
                width: 50px;
                height: 50px;
            }
            .control{
                width: 10%;
                margin-left: 5px;
                border: 1px solid #ccc;
                padding: 5px;
            }
        </style>
    </head>
    <body>
        <h1>CASA MARCOS Rooms</h1>
        <form action="../pages/uploadRoom.php" method="POST" enctype="multipart/form-data">
            <div>
                <div>
                    <select name="room_name" id="room" class="form-control" required>
                        <option value="0" selected disabled> -  SELECT ROOMS  - </option>
                        <option value="Sapphira Villa 6 Pax">Sapphira Villa 6 Pax</option>
                        <option value="Sapphira Villas 8 Pax">Sapphira Villas 8 Pax</option>
                        <option value="Matrimonial">Matrimonial</option>
                        <option value="Matrimonial Plus">Matrimonial Plus</option>
                        <option value="Barkada">Barkada</option>
                        <option value="CV Room 4 Pax">CV Room 4 Pax</option>
                        <option value="CV Room 8 Pax">CV Room 8 Pax</option>
                    </select>
                    <select name="room_price" id="room_price" class="control" required>
                        <option value="0" selected disabled> -  ROOM PRICE - </option>
                        <option value="8999">8999</option>
                        <option value="11999">11999</option>
                        <option value="4999">4999</option>
                        <option value="5399">5399</option>
                        <option value="7999">7999</option>
                        <option value="3999">3999</option>
                        <option value="5999">5999</option>
                    </select>
                </div>
                <div>
                    <textarea name="room_description" placeholder="Room Description"  required></textarea>
                </div>
                <div>
                    <input type="file" name="room_image" id="room_image" accept="image/*" required>
                </div>
                <div style="margin: 10px;">
                    <button type="submit" style="padding: 8px 15px; background-color:rgb(28, 101, 227); color: white; border: none; border-radius: 4px; cursor: pointer;">
                        Upload Room
                    </button>
                </div>
            </div>
        </form>
        <br>
        <section>
            <div>
                <table border="1" width="100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Room Name</th>
                            <th>Room Description</th>
                            <th>Room Price</th>
                            <th>Room Image</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $counter = 1;
                        foreach ($services as $service): ?>
                            <tr>
                                <td><?php echo $counter++; ?></td>
                                <td class="px-4 py3 text-left"><?php echo htmlspecialchars($service['services_name']); ?></td>
                                <td class="px-2 py-3 text-left"><?php echo htmlspecialchars($service['services_description']); ?></td>
                                <td class="px-4 py-3 text-left">₱<?php echo number_format(htmlspecialchars($service['services_price']), 2); ?></td>
                                <td><img src="../images/<?php echo htmlspecialchars($service['services_image']); ?>" alt="Room Image" class="image"></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
        
        <script>
            function openEditModal(id, name, description, price) {
                document.getElementById('editModal').style.display = 'block'; 
                document.getElementById('edit_room_id').value = id;
                document.getElementById('edit_room_name').value = name;
                document.getElementById('edit_room_description').value = description;
                document.getElementById('edit_room_price').value = price;
            }

            function closeEditModal() {
                document.getElementById('editModal').style.display = 'none';
            }

            window.onclick = function(event) {
                let modal = document.getElementById('editModal');
                if (event.target == modal) {
                    modal.style.display = 'none';
                }
            }
        </script>
    </body>
</html>