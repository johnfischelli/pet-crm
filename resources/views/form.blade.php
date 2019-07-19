@extends('layout')

@section('title')
  Pet CRM
@endsection

@section('content')
  <div>
    <div class="max-w-3xl rounded overflow-hidden shadow-lg bg-pink-100">
      <div class="px-6 py-4">

        @if ($customer->owner_first_name)
        <div class="flex flex-wrap mb-2">
          <h1 class="text-xxl text-gray-700 my-3">Howdy, {{ $customer->owner_first_name }}</h1>
        </div>
        @endif

        @if ($customer->id)
        <div class="flex flex-wrap -mx-3 mb-2">
          <div class="w-full px-3">
            <h2 class="text-xl text-gray-700 border-b border-pink-500 my-3">Scheduled Appointments</h2>
          </div>
          <div class="w-full px-3">
            @if (!$customer->appointments->all())
              <p>There are currently no scheduled appointments</p>
            @else
              @foreach($customer->appointments as $appointment)
                  <form method="post" action="{{ route('deleteAppointment') }}">
                    {{ csrf_field() }}
                    <p class="my-3">
                      <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">
                      {{ $appointment->date->format('F jS g:i a') }}, {{ $appointment->type }}
                      <input type="submit" value="Delete" class="text-xs ml-3 bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">
                    </p>
                  </form>
              @endforeach
            @endif
          </div>
        </div>
        @endif

        <form method="post" action="{{ route('saveCustomer') }}" class="w-full max-w-3xl">
          {{ csrf_field() }}
          @if ($customer->id)
            <input type="hidden" name="customer_id" value="{{ $customer->id }}" />
          @endif

          <div class="flex flex-wrap -mx-3 mb-2">
            <div class="w-full px-3">
              <h2 class="text-xl text-gray-700 border-b border-pink-500 my-3">Add Appointment</h2>
            </div>
            <div class="w-full md:w-1/3 px-3">
              @include('components.date-input',[ 'id' => 'appointment_date', 'label' => 'Date', 'value' => null ])
            </div>
            <div class="w-full md:w-1/3 px-3">
              @include('components.select-input',[ 'id' => 'appointment_type', 'label' => 'Appointment Type', 'values' => ['Walk' => 'walk', 'Pet Sit' => 'pet-sit'], 'selected' => null])
            </div>
          </div>

          <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3 mb-5">
              <h2 class="text-xl text-gray-700 border-b border-pink-500 my-3">Edit Customer</h2>
            </div>
            <div class="w-full md:w-1/2 px-3">
              @include('components.text-input',[ 'id' => 'owner_first_name', 'label' => 'Owner First Name', 'value' => $customer->owner_first_name ])
            </div>
            <div class="w-full md:w-1/2 px-3">
              @include('components.text-input',[ 'id' => 'owner_last_name', 'label' => 'Owner Last Name', 'value' => $customer->owner_last_name ])
            </div>
            <div class="w-full md:w-1/2 px-3">
              @include('components.text-input',[ 'id' => 'owner_email', 'label' => 'Owner Email', 'value' => $customer->owner_email ])
            </div>
            <div class="w-full md:w-1/2 px-3">
              @include('components.text-input',[ 'id' => 'owner_phone', 'label' => 'Owner Phone', 'value' => $customer->owner_phone ])
            </div>
          </div>

          <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/3 px-3">
              @include('components.text-input',[ 'id' => 'pet_name', 'label' => 'Pet Name', 'value' => $customer->pet_name ])
            </div>
            <div class="w-full md:w-1/3 px-3">
              @include('components.text-input',[ 'id' => 'pet_type', 'label' => 'Pet Type', 'value' => $customer->pet_type ])
            </div>
            <div class="w-full md:w-1/3 px-3">
              @include('components.text-input',[ 'id' => 'pet_breed', 'label' => 'Pet Breed', 'value' => $customer->pet_breed ])
            </div>
          </div>

          <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3">
              @include('components.text-input',[ 'id' => 'address', 'label' => 'Address', 'value' => $customer->address ])
            </div>
            <div class="w-full md:w-1/2 px-3">
              @include('components.text-input',[ 'id' => 'address_line_2', 'label' => 'Address Line 2', 'value' => $customer->address_line_2 ])
            </div>
          </div>

          <div class="flex flex-wrap -mx-3 mb-2">
            <div class="w-full md:w-1/3 px-3">
              @include('components.text-input',[ 'id' => 'city', 'label' => 'City', 'value' => $customer->city ])
            </div>
            <div class="w-full md:w-1/3 px-3">
              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="state">
                State
              </label>
              <div class="relative">
                <select class="block appearance-none w-full bg-white-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-grey focus:border-gray-500" id="state">
                  <option value="CA">California</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                  <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
              </div>
            </div>
            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
              @include('components.text-input',[ 'id' => 'zip', 'label' => 'Zip', 'value' => $customer->zip ])
            </div>
          </div>
          <input class="bg-pink-500 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded" type="submit" value="Submit" />
        </form>
      </div>
    </div>
  </div>
@endsection