<div>
        <!-- Total Expenses -->
        <div class="">
            <h3 class="text-lg font-semibold">Total Expenses</h3>
            <p class="text-2xl font-bold">RM {{ number_format($totalExpenses, 2) }}</p>
        </div>

        <!-- Total Incomes -->
        <div class=""">
            <h3 class="text-lg font-semibold">Total Income</h3>
            <p class="text-2xl font-bold">RM {{ number_format($totalIncomes, 2) }}</p>
        </div>

        <!-- Total Transactions -->
        <div class="">
            <h3 class="text-lg font-semibold">Total Transactions</h3>
            <p class="text-2xl font-bold">{{ $totalTransactions }}</p>
        </div>

    <!-- Pie Chart -->
    <h2 class="text-lg font-semibold text-center my-4">Expenses by Category</h2>
    <canvas id="expensePieChart"></canvas>

    <!-- Bar Chart for Expenses vs Budgets -->
    <h2 class="text-lg font-semibold text-center my-4">Expenses vs. Budgets by Month</h2>
    <canvas id="expenseBudgetChart"></canvas>

    <!-- Line Chart for Budgets -->
    <h2 class="text-lg font-semibold text-center my-4">Budgets by Month</h2>
    <canvas id="budgetLineChart"></canvas>

    <!-- Doughnut Chart for Income by Source -->
    <h2 class="text-lg font-semibold text-center my-4">Income by Source</h2>
    <canvas id="incomeDoughnutChart"></canvas>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <div class="w-full max-w-lg mx-auto">
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                let pieChartData = @json($pieChartData);
                let barChartData = @json($barChartData);
                let lineChartData = @json($lineChartData);
                let doughnutChartData = @json($doughnutChartData);

                // Pie Chart (Expense by Category)
                const pieCtx = document.getElementById('expensePieChart').getContext('2d');
                new Chart(pieCtx, {
                    type: 'doughnut',
                    data: {
                        labels: pieChartData.labels,
                        datasets: [{
                            label: 'Expenses by Category',
                            data: pieChartData.data,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.6)',
                                'rgba(54, 162, 235, 0.6)',
                                'rgba(255, 206, 86, 0.6)',
                                'rgba(75, 192, 192, 0.6)',
                                'rgba(153, 102, 255, 0.6)',
                                'rgba(255, 159, 64, 0.6)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });

                console.log("Pie Chart Data:", pieChartData);
                console.log("Bar Chart Data:", barChartData);

                // Bar Chart (Expenses vs Budgets)
                const barCtx = document.getElementById('expenseBudgetChart').getContext('2d');
                new Chart(barCtx, {
                    type: 'bar',
                    data: {
                        labels: barChartData.labels,
                        datasets: [
                            {
                                label: 'Budgets',
                                data: barChartData.budgets,
                                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'Expenses',
                                data: barChartData.expenses,
                                backgroundColor: 'rgba(255, 99, 132, 0.6)',
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 1
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

                // Line Chart (Budgets by Month)
                const lineCtx = document.getElementById('budgetLineChart').getContext('2d');
                new Chart(lineCtx, {
                    type: 'line',
                    data: {
                        labels: lineChartData.labels,
                        datasets: [{
                            label: 'Budgets',
                            data: lineChartData.budgets,
                            backgroundColor: 'rgba(54, 162, 235, 0.6)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 2,
                            fill: false,
                            tension: 0.4 // Smooth curve
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top'
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

                // Doughnut Chart (Income by Source)
                const doughnutCtx = document.getElementById('incomeDoughnutChart').getContext('2d');
                new Chart(doughnutCtx, {
                    type: 'doughnut',
                    data: {
                        labels: doughnutChartData.labels,
                        datasets: [{
                            label: 'Income by Source',
                            data: doughnutChartData.data,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.6)',
                                'rgba(54, 162, 235, 0.6)',
                                'rgba(255, 206, 86, 0.6)',
                                'rgba(75, 192, 192, 0.6)',
                                'rgba(153, 102, 255, 0.6)',
                                'rgba(255, 159, 64, 0.6)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });
            });
        </script>
    </div>
</div>
