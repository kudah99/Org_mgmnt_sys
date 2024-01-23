@extends('layouts.app')

@section('content')


<div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white p-4">
  <div class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4">
      <div>
        <div class="inline-flex items-center text-gray-600 font-bold mr-4 text-2xl">Organisation Members Database</div>
          <button data-modal-target="popup-modal" data-modal-toggle="popup-modal"  class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700" type="button">
                Add new member
          </button>

      </div>
      <label for="table-search" class="sr-only">Search</label>
      <div class="relative">
        <form action="{{ route('home') }}" method="GET">
            <div class="absolute inset-y-0 left-0 rtl:inset-r-0 rtl:right-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
            </div>
            <input type="text" id="table-search" name="search" value="{{ request('search') }}" class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search members">
        </form>
      </div>
  </div>
  <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
              <th scope="col" class="px-6 py-3">Full Name</th>
                    
                    <th scope="col" class="px-6 py-3">Email</th>
                    <th scope="col" class="px-6 py-3">Phone Number</th>
                    <th scope="col" class="px-6 py-3">Birth Date</th>
                    <th scope="col" class="px-6 py-3">Address</th>
                    <th scope="col" class="px-6 py-3">Gender</th>
          </tr>
      </thead>
      <tbody>
        @foreach ($members as $member)
        <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600">
            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{ $member->first_name }} {{ $member->last_name }}
            </td>
            <td class="px-6 py-4">{{ $member->email }}</td>
            <td class="px-6 py-4">{{ $member->phone_number }}</td>
            <td class="px-6 py-4">{{ $member->birth_date }}</td>
            <td class="px-6 py-4">{{ $member->address }}</td>
            <td class="px-6 py-4">{{ $member->gender }}</td>
        </tr>
    @endforeach
      </tbody>
  </table>
</div>

{{-- add new user member form --}}
<div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="max-w-md mx-auto bg-white p-6 rounded-md shadow-md">
        <h2 class="text-2xl font-bold mb-4">Add Member</h2>
        <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
            <span class="sr-only">Close modal</span>
        </button>

        <form action="{{ route('validate.form') }}" method="post">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div class="mb-4">
                    <label for="first_name" class="block text-sm font-medium text-gray-600">First Name:</label>
                    <input type="text" id="first_name" name="first_name" class="mt-1 p-2 border rounded-md w-full" required>
                </div>

                <div class="mb-4">
                    <label for="last_name" class="block text-sm font-medium text-gray-600">Last Name:</label>
                    <input type="text" id="last_name" name="last_name" class="mt-1 p-2 border rounded-md w-full" required>
                </div>
                
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-600">Email:</label>
                    <input type="email" id="email" name="email" class="mt-1 p-2 border rounded-md w-full" required>
                </div>

                <div class="mb-4">
                    <label for="phone_number" class="block text-sm font-medium text-gray-600">Phone Number:</label>
                    <input type="text" id="phone_number" name="phone_number" class="mt-1 p-2 border rounded-md w-full">
                </div>

                <div class="mb-4">
                    <label for="birth_date" class="block text-sm font-medium text-gray-600">Birth Date:</label>
                    <input type="date" id="birth_date" name="birth_date" class="mt-1 p-2 border rounded-md w-full">
                </div>

                <div class="mb-4">
                    <label for="address" class="block text-sm font-medium text-gray-600">Address:</label>
                    <textarea id="address" name="address" class="mt-1 p-2 border rounded-md w-full"></textarea>
                </div>

                <div class="mb-4">
                    <label for="gender" class="block text-sm font-medium text-gray-600">Gender:</label>
                    <select id="gender" name="gender" class="mt-1 p-2 border rounded-md w-full" required>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600">Add Member</button>
        </form>
    </div>
</div>

@endsection