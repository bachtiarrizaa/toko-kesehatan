@extends('layouts.admin')
@section('container')
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <nav class="flex px-5 py-3 text-gray-700 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="#" class="inline-flex items-center text-lg font-semibold text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">Add New Category</a>
                </li>
            </nav>  
            <form action="{{ route('admin.category.add') }}" method="POST">
                @csrf
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <strong class="font-bold">Oops!</strong>
                        <span class="block sm:inline">{{ $errors->first() }}</span>
                    </div>
                @endif
                <div class="my-4">
                    <div class="flex items-center">
                        <label for="name" class="w-1/4 text-sm font-medium text-gray-900 dark:text-white ml-2">Category Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                            focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                            dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white 
                            dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                            placeholder="Add Category Name" required />
                    </div>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 
                        focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto 
                        px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Submit
                    </button>
                </div>
            </form>            
        </div>
    </div>
@endsection