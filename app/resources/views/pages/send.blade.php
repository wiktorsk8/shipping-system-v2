
<x-app-layout>
  <div class="container" style="margin-top: 30px;">
    <form method="POST" action="{{route('packages.store')}}">
        @csrf
        <div>
          <h1>Package details:</h1>
        </div>
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Enter package name">
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
        <label for="receivers_id">receivers id</label>
        <input type="number" class="form-control" id="receivers_id" name="receivers_id" placeholder="Enter receivers id">
        <div>
          <h1>Your addres:</h1>
        </div>
        <div class="form-group">
          <label for="city">City</label>
          <input type="text" class="form-control" id="city" name="city" placeholder="ex. Poznan">
        </div>
        
        <div class="form-group">
          <label for="postal_code">Postal Code</label>
          <input type="text" class="form-control" id="postal_code" name="postal_code" placeholder="XX-XXX">
        </div>
        <div class="form-group">
          <label for="street_name">Street name</label>
          <input type="text" class="form-control" id="street_name" name="street_name" placeholder="ex. Armii Krajowej">
        </div>
        <div class="form-group">
          <label for="street_number">Street number</label>
          <input type="text" class="form-control" id="street_number" name="street_number" placeholder="ex. Armii Krajowej">
        </div>
        <div class="form-group">
          <label for="flat_number">Flat number</label>
          <input type="number" class="form-control" id="flat_number" name="flat_number" placeholder="ex. 4">
        </div>

        <div>
          <h1>Receivers addres:</h1>
        </div>
        <div class="form-group">
          <label for="receivers_city">City</label>
          <input type="text" class="form-control" id="receivers_city" name="receivers_city" placeholder="ex. Poznan">
        </div>
        
        <div class="form-group">
          <label for="receivers_postal_code">Postal Code</label>
          <input type="text" class="form-control" id="receivers_postal_code" name="receivers_postal_code" placeholder="XX-XXX">
        </div>
        <div class="form-group">
          <label for="receivers_street_name">Street name</label>
          <input type="text" class="form-control" id="receivers_street_name" name="receivers_street_name" placeholder="ex. Armii Krajowej">
        </div>
        <div class="form-group">
          <label for="receivers_street_number">Street number</label>
          <input type="text" class="form-control" id="receivers_street_number" name="receivers_street_number" placeholder="ex. Armii Krajowej 4(full name)">
        <div class="form-group">
          <label for="receivers_flat_number">Flat number</label>
          <input type="number" class="form-control" id="receivers_flat_number" name="receivers_flat_number" placeholder="ex. 4">
        </div>
        <x-primary-button class="ml-3 m-3">
          {{ __('Submit') }}
        </x-primary-button>
    </form>
  </div>

</x-app-layout>