
<x-app-layout>
  <div class="container" style="margin-top: 30px;">
    <form method="POST" action="{{route('packages.confirm')}}">
        @csrf
        <div>
          <h1>Package details:</h1>
        </div>
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Enter package name">
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
      </div>
      <div class="form-group">
        <select name="size" id="size">
          <option value="XS">XS</option>
          <option value="S">S</option>
          <option value="M">M</option>
          <option value="L">L</option>
          <option value="XL">XL</option>
        </select>
      </div>
      <div class="form-group">
        <label for="recipients_email">recipients_email</label>
        <input type="text" class="form-control" id="recipients_email" name="recipients_email" placeholder="Enter recipients email">
        <x-input-error :messages="$errors->get('recipients_email')" class="mt-2" />
      </div>
        <div>
          <h1>Your addres:</h1>
        </div>
        <div class="form-group">
          <label for="city">City</label>
          <input type="text" class="form-control" id="city" name="city" placeholder="ex. Poznan">
          <x-input-error :messages="$errors->get('city')" class="mt-2" />
        </div>
        
        <div class="form-group">
          <label for="postal_code">Postal Code</label>
          <input type="text" class="form-control" id="postal_code" name="postal_code" placeholder="XX-XXX">
          <x-input-error :messages="$errors->get('postal_code')" class="mt-2" />
        </div>
        <div class="form-group">
          <label for="street_name">Street name</label>
          <input type="text" class="form-control" id="street_name" name="street_name" placeholder="ex. Armii Krajowej">
          <x-input-error :messages="$errors->get('street_name')" class="mt-2" />
        </div>
        <div class="form-group">
          <label for="street_number">Street number</label>
          <input type="text" class="form-control" id="street_number" name="street_number" placeholder="ex. Armii Krajowej">
          <x-input-error :messages="$errors->get('street_number')" class="mt-2" />
        </div>
        <div class="form-group">
          <label for="flat_number">Flat number</label>
          <input type="text" class="form-control" id="flat_number" name="flat_number" placeholder="ex. 4">
          <x-input-error :messages="$errors->get('flat_number')" class="mt-2" />
        </div>

        <div>
          <h1>Recipients addres:</h1>
        </div>
        <div class="form-group">
          <label for="recipients_city">City</label>
          <input type="text" class="form-control" id="recipients_city" name="recipients_city" placeholder="ex. Poznan">
          <x-input-error :messages="$errors->get('recipients_city')" class="mt-2" />
        </div>
        
        <div class="form-group">
          <label for="recipients_postal_code">Postal Code</label>
          <input type="text" class="form-control" id="recipients_postal_code" name="recipients_postal_code" placeholder="XX-XXX">
          <x-input-error :messages="$errors->get('recipients_postal_code')" class="mt-2" />
        </div>
        <div class="form-group">
          <label for="recipients_street_name">street name</label>
          <input type="text" class="form-control" id="recipients_street_name" name="recipients_street_name" placeholder="ex. Armii Krajowej">
          <x-input-error :messages="$errors->get('recipients_street_name')" class="mt-2" />
        </div>
        <div class="form-group">
          <label for="recipients_street_number">Street number</label>
          <input type="text" class="form-control" id="recipients_street_number" name="recipients_street_number" placeholder="ex. Armii Krajowej 4(full name)">
          <x-input-error :messages="$errors->get('recipients_street_number')" class="mt-2" />
        </div>
        <div class="form-group">
          <label for="recipients_flat_number">Flat number</label>
          <input type="text" class="form-control" id="recipients_flat_number" name="recipients_flat_number" placeholder="ex. 4">
          <x-input-error :messages="$errors->get('recipients_flat_number')" class="mt-2" />
        </div>
        <x-primary-button class="ml-3 m-3">
          {{ __('Submit') }}
        </x-primary-button>
    </form>
  </div>

</x-app-layout>