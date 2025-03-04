<?php
session_start();

include_once 'nav/header.php';

?>

<div class="container px-6 mx-auto">
    <div class="flex justify-center min-h-screen items-center">
        <div class="w-full max-w-md">
            <!-- Add success/error messages -->
            <?php if (isset($_SESSION['success'])): ?>
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                    <?php 
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                    ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                    <?php 
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    ?>
                </div>
            <?php endif; ?>

            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="bg-purple-600 px-6 py-4">
                    <h3 class="text-2xl font-bold text-white text-center">Account Management</h3>
                </div>
                <div class="p-6">
                    <!-- Add tabs for switching between register and edit -->
                    <div class="flex mb-6 border-b">
                        <button onclick="showForm('register')" id="registerTab" 
                            class="px-4 py-2 font-semibold text-purple-600 border-b-2 border-purple-600">
                            Register New Account
                        </button>
                        <button onclick="showForm('edit')" id="editTab"
                            class="px-4 py-2 font-semibold text-gray-500 hover:text-purple-600">
                            Edit Current Account
                        </button>
                    </div>

                    <!-- Register Form -->
                    <form action="../pages/register.php" method="POST" id="registerForm">
                        <div class="mb-4">
                            <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Username</label>
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-purple-500" 
                                id="username" name="username" required placeholder="Enter your username">
                        </div>
                        <div class="mb-4">
                            <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                            <div class="relative">
                                <input type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-purple-500" 
                                    id="password" name="password" required placeholder="Enter your password">
                                <button type="button" class="absolute inset-y-0 right-0 px-3 flex items-center" onclick="togglePassword('password')">
                                    <i class="fas fa-eye text-gray-500"></i>
                                </button>
                            </div>
                        </div>
                        <div class="mb-6">
                            <label for="confirm_password" class="block text-gray-700 text-sm font-bold mb-2">Confirm Password</label>
                            <div class="relative">
                                <input type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-purple-500" 
                                    id="confirm_password" name="confirm_password" required placeholder="Confirm your password">
                                <button type="button" class="absolute inset-y-0 right-0 px-3 flex items-center" onclick="togglePassword('confirm_password')">
                                    <i class="fas fa-eye text-gray-500"></i>
                                </button>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">
                                Register
                            </button>
                        </div>
                    </form>
                    <!-- Edit Account Form -->
                    <form action="../pages/register.php" method="POST" id="editForm" class="hidden">
                        <input type="hidden" name="action" value="update">
                        <input type="hidden" name="admin_id" value="<?php echo isset($_SESSION['admin_id']) ? htmlspecialchars($_SESSION['admin_id']) : ''; ?>">
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Current Username</label>
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 bg-gray-100 leading-tight" 
                                value="<?php echo isset($_SESSION['admin_username']) ? htmlspecialchars($_SESSION['admin_username']) : ''; ?>" disabled>
                        </div>
                        <div class="mb-4">
                            <label for="new_username" class="block text-gray-700 text-sm font-bold mb-2">New Username</label>
                            <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-purple-500" 
                                id="new_username" name="new_username" placeholder="Enter new username">
                        </div>
                        <div class="mb-4">
                            <label for="current_password" class="block text-gray-700 text-sm font-bold mb-2">Current Password</label>
                            <div class="relative">
                                <input type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-purple-500" 
                                    id="current_password" name="current_password" required placeholder="Enter current password">
                                <button type="button" class="absolute inset-y-0 right-0 px-3 flex items-center" onclick="togglePassword('current_password')">
                                    <i class="fas fa-eye text-gray-500"></i>
                                </button>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="new_password" class="block text-gray-700 text-sm font-bold mb-2">New Password</label>
                            <div class="relative">
                                <input type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-purple-500" 
                                    id="new_password" name="new_password" placeholder="Enter new password">
                                <button type="button" class="absolute inset-y-0 right-0 px-3 flex items-center" onclick="togglePassword('new_password')">
                                    <i class="fas fa-eye text-gray-500"></i>
                                </button>
                            </div>
                        </div>
                        <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">
                            Update Account
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Add form switching functionality
function showForm(formType) {
    const registerForm = document.getElementById('registerForm');
    const editForm = document.getElementById('editForm');
    const registerTab = document.getElementById('registerTab');
    const editTab = document.getElementById('editTab');
    
    if (formType === 'register') {
        registerForm.classList.remove('hidden');
        editForm.classList.add('hidden');
        registerTab.classList.add('border-b-2', 'border-purple-600', 'text-purple-600');
        editTab.classList.remove('border-b-2', 'border-purple-600', 'text-purple-600');
    } else {
        registerForm.classList.add('hidden');
        editForm.classList.remove('hidden');
        registerTab.classList.remove('border-b-2', 'border-purple-600', 'text-purple-600');
        editTab.classList.add('border-b-2', 'border-purple-600', 'text-purple-600');
    }
}

// Existing togglePassword function remains the same
</script>

<!-- Add Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<!-- Add this script at the bottom of your file -->
<script>
function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const icon = input.nextElementSibling.querySelector('i');
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}
</script>

