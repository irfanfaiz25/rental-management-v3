<div
    class="flex justify-center items-center p-4 bg-white dark:bg-[#252525] drop-shadow-md border-4 border-gray-200/80 dark:border-[#2d2d2d]">
    <canvas id="weeklyIncomeChart"></canvas>
</div>

@push('script')
    <script>
        const incomesData = @json($weeklyIncomes);
        const expenditureData = @json($weeklyExpenditures);

        const ctx = document.getElementById('weeklyIncomeChart').getContext('2d');
        new Chart(ctx, {
            type: 'line', // Line chart
            data: {
                labels: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
                datasets: [{
                    label: 'Incomes',
                    data: incomesData,
                    backgroundColor: 'rgb(6, 208, 1, 0.2)',
                    borderColor: 'rgb(6, 208, 1)',
                    borderWidth: 1,
                    fill: false
                }, {
                    label: 'Expenditures',
                    data: expenditureData,
                    backgroundColor: 'rgb(228, 0, 58, 0.2)',
                    borderColor: 'rgb(228, 0, 58)',
                    borderWidth: 1,
                    fill: false
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endpush
