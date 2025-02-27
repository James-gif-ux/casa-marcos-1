<!DOCTYPE html>
    <html>
    <head>
        <title>Image Upload</title>
        <style>
            .upload-container {
                max-width: 500px;
                margin: 20px auto;
                padding: 20px;
                border: 1px solid #ccc;
            }

            .gallery-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
                gap: 20px;
                padding: 20px;
            }
            .gallery-item {
                width: 100%;
            }
            .gallery-image {
                width: 100%;
                height: 200px;
                object-fit: cover;
                border-radius: 8px;
            }
            
            .upload-container {
                max-width: 600px;
                margin: 40px auto;
                background: white;
                padding: 2rem;
                border-radius: 1rem;
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            }
            .preview-image {
                width: 100%;
                height: 150px;
                object-fit: cover;
                border-radius: 0.5rem;
            }
            textarea {
                min-height: 100px;
                resize: vertical;
            }
            input[type="text"], textarea {
                width: 100%;
                padding: 0.75rem;
                border: 1px solid #e2e8f0;
                border-radius: 0.5rem;
                transition: all 0.3s ease;
            }
            input[type="text"]:focus, textarea:focus {
                outline: none;
                border-color: #9f7aea;
                box-shadow: 0 0 0 3px rgba(159, 122, 234, 0.2);
            }
            button[type="submit"] {
                background: linear-gradient(to right, #9f7aea, #7f69e7);
                color: white;
                font-weight: 600;
                padding: 0.75rem 1.5rem;
                border-radius: 0.5rem;
                transition: all 0.3s ease;
            }
            button[type="submit"]:hover {
                transform: translateY(-1px);
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            }
        </style>
    </head>
        <body>
            <div class="upload-container bg-gradient-to-br from-white to-purple-50 p-8 rounded-2xl shadow-2xl border border-purple-100">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Upload Menu Images</h2>
                <?php
                require_once '../model/server.php';
                
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
                    $connector = new Connector();
                    
                    try {
                        $image_name = $_POST['image_name'];
                        $image_description = $_POST['image_description'];
                        
                        // Handle file upload
                        $target_dir = "../uploads/gallery/";
                        if (!file_exists($target_dir)) {
                            mkdir($target_dir, 0777, true);
                        }
                        
                        $file_extension = strtolower(pathinfo($_FILES["image_img"]["name"], PATHINFO_EXTENSION));
                        $new_filename = uniqid() . '.' . $file_extension;
                        $target_file = $target_dir . $new_filename;
                        
                        if (move_uploaded_file($_FILES["image_img"]["tmp_name"], $target_file)) {
                            // Insert into database
                            $sql = "INSERT INTO image_tb (image_name, image_img, image_description) VALUES (?, ?, ?)";
                            $stmt = $connector->getConnection()->prepare($sql);
                            $stmt->execute([$image_name, $new_filename, $image_description]);
                            
                            header("Location: " . $_SERVER['PHP_SELF'] . "?success=1");
                            exit();
                        } else {
                            throw new Exception("Failed to upload file.");
                        }
                    } catch (Exception $e) {
                        $error_message = $e->getMessage();
                    }
                }
                ?>
                <form action="images.php" method="POST" enctype="multipart/form-data" class="space-y-6">
                        <div class="relative border-2 border-dashed border-purple-200 rounded-xl p-6 text-center hover:border-purple-400 transition-all duration-300 bg-white bg-opacity-50 backdrop-blur-sm hover:shadow-md">
                            <div id="imagePreview" class="grid grid-cols-2 gap-4 mb-4"></div>
                            <div class="space-y-2">
                                <label for="imageInput" class="cursor-pointer inline-flex items-center space-x-2 text-purple-600 hover:text-purple-700">
                                    <span class="text-sm font-medium">Choose files or drag and drop</span>
                                    <input type="file" name="image_img" id="imageInput" class="hidden" multiple required accept="image/*">
                                </label>
                                <p class="text-xs text-gray-500">Supported formats: JPG, PNG, GIF</p>
                            </div>
                        </div>

                        <div class="space-y-4 bg-white bg-opacity-50 backdrop-blur-sm p-6 rounded-xl border border-purple-100">
                            <div class="relative">
                                <label for="imageName" class="text-sm font-medium text-gray-700 block mb-2">Image Name</label>
                                <input type="text" name="image_name" id="imageName" required
                                    class="w-full px-4 py-2 border border-purple-100 rounded-lg focus:ring-2 focus:ring-purple-400 focus:border-transparent transition-all duration-300 bg-white"
                                    placeholder="Enter image name">
                            </div>

                            <div class="relative">
                                <label for="imageDescription" class="text-sm font-medium text-gray-700 block mb-2">Image Description</label>
                                <textarea name="image_description" id="imageDescription" required rows="3"
                                        class="w-full px-4 py-2 border border-purple-100 rounded-lg focus:ring-2 focus:ring-purple-400 focus:border-transparent transition-all duration-300 bg-white"
                                        placeholder="Enter image description"></textarea>
                            </div>
                        </div>

                    <button type="submit" name="submit" 
                            class="w-full py-3 px-4 rounded-lg bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-medium hover:from-purple-700 hover:to-indigo-700 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:ring-offset-2">
                        Upload Images
                    </button>
                </form>
            </div>

            <style>
                .upload-container {
                    backdrop-filter: blur(20px);
                    transition: all 0.3s ease;
                }
            </style>
                <div class="upload-container">
                    <h2>Gallery Images</h2>
                    <div class="gallery-grid">
                        <?php
                        require_once '../model/server.php';
                        $connector = new Connector();
                        
                        try {
                            $sql = "SELECT * FROM image_tb";
                            $result = $connector->executeQuery($sql);
                            
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                echo '<div class="gallery-item">';
                                echo '<img src="../uploads/gallery/' . htmlspecialchars($row['image_img']) . '" 
                                        alt="' . htmlspecialchars($row['image_name']) . '" 
                                        class="gallery-image">';
                                echo '<div class="image-info p-3 bg-white bg-opacity-90 rounded-b-lg">';
                                echo '<h3 class="font-medium text-gray-800">' . htmlspecialchars($row['image_name']) . '</h3>';
                                echo '<p class="text-sm text-gray-600">' . htmlspecialchars($row['image_description']) . '</p>';
                                echo '</div>';
                                echo '</div>';
                            }
                        } catch (Exception $e) {
                            echo '<div class="text-red-500">Error loading images: ' . $e->getMessage() . '</div>';
                        }
                        ?>
                    </div>
                </div>
        </body>
    </html>
