<div class="block md:flex justify-start space-y-2 md:space-y-0 md:space-x-3">
    <div class="w-full h-44 bg-gradient-to-r from-[#3572EF] to-[#3ABEF9] drop-shadow-sm py-7 px-5 rounded-md">
        <div class="flex justify-between">
            <h1 class="text-xl font-extra-bold text-gray-800 dark:text-gray-50 capitalize">
                Rental Ready
            </h1>
            <i class="ri-checkbox-multiple-line text-5xl text-gray-50"></i>
        </div>
        <h1 class="sm:text-3xl lg:text-4xl font-bold pt-5 text-right">
            {{ $rentalReady }} Consoles
        </h1>
    </div>
    <div class="w-full h-44 bg-gradient-to-r from-[#007F73] to-[#4CCD99] drop-shadow-sm py-7 px-5 rounded-md">
        <div class="flex justify-between">
            <h1 class="text-xl font-extra-bold text-gray-800 dark:text-gray-50 capitalize">
                Today's Income
            </h1>
            <i class="ri-hand-coin-line text-5xl text-gray-50"></i>
        </div>
        <h1 class="sm:text-3xl lg:text-4xl font-bold pt-5 text-right">
            @currency($todaysIncome)
        </h1>
    </div>
    <div class="w-full h-44 bg-gradient-to-r from-[#D21312] to-[#ED2B2A] drop-shadow-sm py-7 px-5 rounded-md">
        <div class="flex justify-between">
            <h1 class="text-xl font-extra-bold text-gray-800 dark:text-gray-50 capitalize">
                Today's Expenditure
            </h1>
            <i class="ri-arrow-up-down-line text-5xl text-gray-50"></i>
        </div>
        <h1 class="sm:text-3xl lg:text-4xl font-bold pt-5 text-right">
            @currency($todaysExpenditure)
        </h1>
    </div>
</div>
