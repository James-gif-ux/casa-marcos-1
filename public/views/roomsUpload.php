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
        <link rel="stylesheet" href="../assets/css/up.css">
       
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
                            <th>Action  </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $counter = 1;
                        foreach ($services as $service): ?>
                            <tr>
                                <td class="px-2 py-3 text-left"><?php echo $counter++; ?></td>
                                <td class="px-2 py-3 text-left"><?php echo htmlspecialchars($service['services_name']); ?></td>
                                <td class="px-2 py-3 text-left"><?php echo htmlspecialchars($service['services_description']); ?></td>
                                <td><?php echo htmlspecialchars($service['services_price']); ?></td>
                                <td>
                                    <?php if(!empty($service['services_image'])): ?>
                                        <img src="../images/<?php echo htmlspecialchars($service['services_image']); ?>" 
                                        alt="Room Image" class="room-image" style="width: 50px; height: 50px; ">
                                    <?php endif; ?>
                                </td>
                                <td class="px-2 py-3">
                                    <button onclick="openEditModal(
                                        '<?php echo htmlspecialchars($service['services_id']); ?>', 
                                        '<?php echo htmlspecialchars($service['services_name']); ?>', 
                                        '<?php echo nl2br(htmlspecialchars($service['services_description'])); ?>', 
                                        '<?php echo htmlspecialchars($service['services_price']); ?>'
                                    )" class="btn btn-primary" style="background-color:rgb(241, 102, 8); color: white; padding: 5px 10px; border: none; border-radius: 4px; cursor: pointer;">
                                        Edit
                                    </button>

                                    <!-- Edit Modal -->
                                    <div id="editModal" class="modal" style="display: none; position: fixed; z-index: 1; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.4);">
                                        <div class="modal-content" style="background-color: #fefefe; margin: 15% auto; padding: 20px; border: 1px solid #888; width: 80%; max-width: 500px;">
                                            <span class="close" onclick="closeEditModal()" style="color: #aaa; float: right; font-size: 28px; font-weight: bold; cursor: pointer;">&times;</span>
                                            <h2>Edit Room Details</h2>
                                            <form action="../pages/updateRoom.php" method="POST" enctype="multipart/form-data">
                                                <input type="hidden" id="edit_room_id" name="room_id">
                                                <div style="margin-bottom: 15px;">
                                                    <label for="edit_room_name">Room Name:</label>
                                                    <input type="text" id="edit_room_name" name="room_name" style="width: 100%; padding: 8px;">
                                                </div>
                                                <div style="margin-bottom: 15px;">
                                                    <label for="edit_room_description">Description:</label>
                                                    <textarea id="edit_room_description" name="room_description" style="width: 100%; height: 100px; padding: 8px;"></textarea>
                                                </div>
                                                <div style="margin-bottom: 15px;">
                                                    <label for="edit_room_price">Price:</label>
                                                    <input type="number" id="edit_room_price" name="room_price" style="width: 100%; padding: 8px;">
                                                </div>
                                                <div style="margin-bottom: 15px; margin-right:20px;">
                                                    <label for="edit_room_image">New Image (optional):</label>
                                                    <input type="file" id="edit_room_image" name="room_image" accept="image/*">
                                                </div>
                                                <div style="text-align: right;">
                                                    <button type="button" onclick="closeEditModal()" style="padding: 8px 15px; margin-right: 10px; background-color: #ccc;">Cancel</button>
                                                    <button type="submit" style="padding: 8px 15px; background-color: #007bff; color: white; border: none;">Save Changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
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