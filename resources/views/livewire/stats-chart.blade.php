<div class="p-2">
    <div class="max-w-7xl mx-auto px-2 lg:px-8">
        <!-- Stats Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-2 mb-2">
            <!-- Total Expenses -->
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6 border border-red-500">
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-300">Total Expenses</p>
                <h3 class="text-3xl font-bold text-red-500">RM {{ number_format($totalExpenses, 2) }}</h3>
            </div>

            <!-- Total Incomes -->
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6 border border-green-500">
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-300">Total Income</p>
                <h3 class="text-3xl font-bold text-green-500">RM {{ number_format($totalIncomes, 2) }}</h3>
            </div>

            <!-- Total Transactions -->
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6 border border-gray-700 dark:border-gray-300">
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-300">Total Transactions</p>
                <h3 class="text-3xl font-bold text-gray-700 dark:text-gray-300">{{ $totalTransactions }}</h3>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mb-2">
            <!-- Expenses by Category (Pie Chart) -->
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                <h2 class="text-lg font-semibold mb-4 text-gray-700 dark:text-gray-300">Expenses by Category</h2>
                <canvas id="expensePieChart"></canvas>
            </div>

            <!-- Income by Source (Doughnut Chart) -->
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                <h2 class="text-lg font-semibold mb-4 text-gray-700 dark:text-gray-300">Income by Source</h2>
                <canvas id="incomeDoughnutChart"></canvas>
            </div>
        </div>

        <!-- Bar & Line Charts -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
            <!-- Expenses vs. Budgets by Month (Bar Charts) -->
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                <h2 class="text-lg font-semibold mb-4 text-gray-700 dark:text-gray-300">Expenses vs. Budgets by Month</h2>
                <canvas id="expenseBudgetChart"></canvas>
            </div>

            <!-- Budgets by Month (Bar Charts) -->
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                <h2 class="text-lg font-semibold mb-4 text-gray-700 dark:text-gray-300">Budgets by Month</h2>
                <canvas id="budgetLineChart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let pieChartData = @json($pieChartData);
        let barChartData = @json($barChartData);
        let lineChartData = @json($lineChartData);
        let doughnutChartData = @json($doughnutChartData);

        // Expenses by Category (Pie Chart)
        new Chart(document.getElementById('expensePieChart').getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: pieChartData.labels,
                datasets: [{
                    data: pieChartData.data,
                    backgroundColor: ['#ff6384', '#36a2eb', '#ffce56', '#4bc0c0', '#9966ff', '#ff9f40'],
                }]
            },
            options: { responsive: true, maintainAspectRatio: true, plugins: { legend: { position: 'top' } } }

        });

        // Income by Source (Doughnut Chart)
        new Chart(document.getElementById('incomeDoughnutChart').getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: doughnutChartData.labels,
                datasets: [{
                    data: doughnutChartData.data,
                    backgroundColor: ['#ff6384', '#36a2eb', '#ffce56', '#4bc0c0', '#9966ff', '#ff9f40'],
                }]
            },
            options: { responsive: true, maintainAspectRatio: true, plugins: { legend: { position: 'top' } } }
        });

        // Expenses vs Budgets (Bar Chart)
        new Chart(document.getElementById('expenseBudgetChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: barChartData.labels,
                datasets: [
                    { label: 'Budgets', data: barChartData.budgets, backgroundColor: 'rgba(54, 162, 235, 0.6)' },
                    { label: 'Expenses', data: barChartData.expenses, backgroundColor: 'rgba(255, 99, 132, 0.6)' }
                ]
            },
            options: {
                responsive: true,
                scales: { y: { beginAtZero: true } },
                plugins: { legend: { position: 'top' } }
            }
        });

        // Budgets by Month (Line Chart)
        new Chart(document.getElementById('budgetLineChart').getContext('2d'), {
            type: 'line',
            data: {
                labels: lineChartData.labels,
                datasets: [{
                    label: 'Budgets',
                    data: lineChartData.budgets,
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                    fill: false,
                    tension: 0.4
                }]
            },
            options: { responsive: true, plugins: { legend: { position: 'top' } }, scales: { y: { beginAtZero: true } } }
        });
    });
</script>
