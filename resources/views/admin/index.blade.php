@extends('layouts.admin')
@section('container')
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <div class="grid grid-cols-2 gap-4">
                <div class="flex flex-col items-center justify-center rounded-sm bg-gray-50 h-28 dark:bg-gray-800">
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">
                        Total Users
                    </p>
                    <p class="text-2xl text-gray-700 dark:text-gray-200 font-bold">
                        {{ $totalUsers }}
                    </p>
                </div>
                <div class="flex flex-col items-center justify-center rounded-sm bg-gray-50 h-28 dark:bg-gray-800">
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">
                        Total Category
                    </p>
                    <p class="text-2xl text-gray-700 dark:text-gray-200 font-bold">
                        {{ $totalCategory }}
                    </p>
                </div>
                <div class="flex flex-col items-center justify-center rounded-sm bg-gray-50 h-28 dark:bg-gray-800">
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">
                        Total Product
                    </p>
                    <p class="text-2xl text-gray-700 dark:text-gray-200 font-bold">
                        {{ $totalProduct }}
                    </p>
                </div>
                <div class="flex flex-col items-center justify-center rounded-sm bg-gray-50 h-28 dark:bg-gray-800 p-4">
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">
                        Total Order
                    </p>
                    <p class="text-2xl text-gray-700 dark:text-gray-200 font-bold">
                        {{ $totalOrder }}
                    </p>
                    <p class="text-xs text-green-600 dark:text-green-400 mt-1">
                        Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                    </p>
                </div>
                <div class="flex flex-col items-center justify-center rounded-sm bg-gray-50 h-28 dark:bg-gray-800">
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">
                        Total Feedback
                    </p>
                    <p class="text-2xl text-gray-700 dark:text-gray-200 font-bold">
                        {{ $totalFeedback }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection