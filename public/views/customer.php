<?php
  include_once './nav/header.php';
require_once '../model/customerModel.php';

$customerModel = new CustomerModel();
$customers = $customerModel->getCustomers();
?>

<!-- New Table -->
<div class="w-full overflow-hidden rounded-lg shadow-xs">
    <div class="w-full overflow-x-auto">
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Customers Name</th>
                    <th class="px-4 py-3">Booking ID</th>
                    <th class="px-4 py-3">Phone Number</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Check in</th>
                    <th class="px-4 py-3">Check out</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                <?php foreach ($customers as $customer): ?>
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3"><?php echo htmlspecialchars($customer['cstm_name']); ?></td>
                    <td class="px-4 py-3"><?php echo htmlspecialchars($customer['cstm_room_id']); ?></td>
                    <td class="px-4 py-3"><?php echo htmlspecialchars($customer['cstm_number']); ?></td>
                    <td class="px-4 py-3"><?php echo htmlspecialchars($customer['cstm_email']); ?></td>
                    <td class="px-4 py-3"><?php echo htmlspecialchars($customer['cstm_check_in']); ?></td>
                    <td class="px-4 py-3"><?php echo htmlspecialchars($customer['cstm_check_out']); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>