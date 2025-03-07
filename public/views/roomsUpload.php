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
                            <th>Actions</th>
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
                                <td>
                                    <button onclick="openEditModal(<?php echo $service['services_id']; ?>, '<?php echo htmlspecialchars($service['services_name'], ENT_QUOTES); ?>', '<?php echo htmlspecialchars($service['services_description'], ENT_QUOTES); ?>', '<?php echo htmlspecialchars($service['services_price']); ?>')" style="background-color: #2196F3; color: white; border: none; padding: 5px 10px; margin: 2px; border-radius: 3px; cursor: pointer;"><i class="bi bi-pencil-square"></i></button>
                                         <!-- Edit Modal -->
                                        <div id="editModal" class="modal" style="display: none; position: fixed; z-index: 1; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.4);">
                                            <div class="modal-content" style="background-color: #fefefe; margin: 15% auto; padding: 20px; border: 1px solid #888; width: 50%;">
                                                <span class="close" onclick="closeEditModal()" style="color: #aaa; float: right; font-size: 28px; font-weight: bold; cursor: pointer;">&times;</span>
                                                <h2>Edit Room</h2>
                                                <form id="editRoomForm" action="../pages/roomsUpload.php" method="POST">
                                                    <input type="hidden" id="edit_room_id" name="room_id">
                                                    <div style="margin-bottom: 15px;">
                                                        <label for="edit_room_name">Room Name:</label>
                                                        <select name="room_name" id="edit_room_name" class="form-control" required>
                                                            <option value="Sapphira Villa 6 Pax">Sapphira Villa 6 Pax</option>
                                                            <option value="Sapphira Villas 8 Pax">Sapphira Villas 8 Pax</option>
                                                            <option value="Matrimonial">Matrimonial</option>
                                                            <option value="Matrimonial Plus">Matrimonial Plus</option>
                                                            <option value="Barkada">Barkada</option>
                                                            <option value="CV Room 4 Pax">CV Room 4 Pax</option>
                                                            <option value="CV Room 8 Pax">CV Room 8 Pax</option>
                                                        </select>
                                                    </div>
                                                    <div style="margin-bottom: 15px;">
                                                        <label for="edit_room_description">Description:</label>
                                                        <textarea id="edit_room_description" name="room_description" required style="width: 100%; height: 100px;"></textarea>
                                                    </div>
                                                    <div style="margin-bottom: 15px; ">
                                                        <label for="edit_room_price">Price:</label>
                                                        <input type="number" id="edit_room_price" name="room_price" style="border: 1px solid #ccc;" required>
                                                    </div>
                                                    <button type="submit" style="background-color: #4CAF50; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer;">Update Room</button>
                                                </form>
                                            </div>
                                        </div>
                                   
                                    <button onclick="deleteRoom(<?php echo $service['services_id']; ?>)" style="background-color: #f44336; color: white; border: none; padding: 5px 10px; margin: 2px; border-radius: 3px; cursor: pointer;"><i class="bi bi-trash-fill"></i></button>
                                </td>
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