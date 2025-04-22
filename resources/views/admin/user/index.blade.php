@extends('layouts.admin')
@section('container')
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <nav class="flex px-5 py-3 text-gray-700 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="#" class="inline-flex items-center text-lg font-semibold text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">Products Information</a>
                </li>
            </nav> 
            <section class="bg-gray-50 dark:bg-gray-900">
                <div class="mx-auto max-w-screen-xl">
                    <!-- Start coding here -->
                    <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                        <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                        <div class="overflow-x-auto">
                            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">
                                                Number
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Name
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Username
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Email
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Date of Birthday
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Gender
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Address
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                City
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Role
                                            </th>
                                            <th scope="col" class="px-6 py-3 w-44">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                            <th class="px-6 py-4">
                                                {{ $loop->iteration }}
                                            </th>
                                            <th class="px-6 py-4">
                                                {{ $user->name }}
                                            </th>
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $user->username }}
                                            </th>
                                            <th class="px-6 py-4">
                                                {{ $user->email }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $user->date_of_birth }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $user->gender }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $user->address }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $user->city }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $user->role->name}}
                                            </td>
                                            <td class="px-6 py-4 w-44">
                                                <a href="{{ route('admin.product.edit', $user->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline mr-4">
                                                    Edit
                                                </a>
                                                <form action="{{ route('admin.product.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure to remove this item?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="font-medium text-red-600 dark:text-red-500 hover:underline">
                                                        Remove
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection