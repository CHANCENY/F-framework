<?php @session_start();

$pager = \UI\Pagination::pager(\ErrorLogger\ErrorLogger::errors(),'error-errors-display');
?>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-6 py-3">
                Message
            </th>
            <th scope="col" class="px-6 py-3">
                Severity
            </th>
            <th scope="col" class="px-6 py-3">
                EID
            </th>
            <th scope="col" class="px-6 py-3">
                Date
            </th>
            <th scope="col" class="px-6 py-3">
                <span class="sr-only">Details</span>
            </th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($pager['data'] as $error=>$value):  ?>
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-dark">
                <?php echo substr($value['message'], 0 ,30).'...'; ?>
            </th>
            <td class="px-6 py-4">
                <?php echo $value['severity']; ?>
            </td>
            <td class="px-6 py-4">
                <?php echo $value['eid']; ?>
            </td>
            <td class="px-6 py-4">
                <?php echo date("Y-m-d",$value['eid']); ?>
            </td>
            <td class="px-6 py-4 text-right">
                <a href="<?php echo "error-report-details/{$value['eid']}"; ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">details...</a>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <div>
        <?php echo $pager['html']; ?>
    </div>
</div>

