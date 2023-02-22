<x-app-layout>
    <div class="container" style="margin-top: 30px;">
        <form method="POST" action="{{route('packages.store')}}">
            @csrf
            <input type="hidden" name="name" value="{{$request->name}}"/>
            <input type="hidden" name="size" value="{{$request->size}}"/>
            <input type="hidden" name="recipients_email" value="{{$request->recipients_email}}"/>
            <input type="hidden" name="city" value="{{$request->city}}"/>
            <input type="hidden" name="postal_code" value="{{$request->postal_code}}"/>
            <input type="hidden" name="street_name" value="{{$request->street_name}}"/>
            <input type="hidden" name="street_number" value="{{$request->street_number}}"/>
            <input type="hidden" name="flat_number" value="{{$request->flat_number}}"/>
            <input type="hidden" name="recipients_city" value="{{$request->recipients_city}}"/>
            <input type="hidden" name="recipients_postal_code" value="{{$request->recipients_postal_code}}"/>
            <input type="hidden" name="recipients_street_name" value="{{$request->recipients_street_name}}"/>
            <input type="hidden" name="recipients_street_number" value="{{$request->recipients_street_number}}"/>
            <input type="hidden" name="recipients_flat_number" value="{{$request->recipients_flat_number}}"/>

            <div>
                <h1>Confirm package details</h1>
            </div>
            <div class="form-group">
                <p>Name: {{$request->name}}</p>    
            </div>
            <div class="form-group">
                <p>Size: {{$request->size}}</p>    
            </div>

            <div class="form-group">
                <p>Recipients email: {{$request->recipients_email}}</p>    
            </div>

            <div>
                <h1>Your address:</h1>
            </div>

            <div class="form-group">
                <p>Your city: {{$request->city}}</p>    
            </div>

            <div class="form-group">
                <p>Postal code: {{$request->postal_code}}</p>    
            </div>

            <div class="form-group">
                <p>Street name: {{$request->street_name}}</p>    
            </div>

            <div class="form-group">
                <p>Street number: {{$request->street_number}}</p>    
            </div>

            <div class="form-group">
                <p>Flat number: {{$request->flat_number}}</p>    
            </div>

            <div>
                <h1>Recipients address:</h1>
            </div>

            <div class="form-group">
                <p>Recipients city: {{$request->recipients_city}}</p>    
            </div>

            <div class="form-group">
                <p>Postal code: {{$request->recipients_postal_code}}</p>    
            </div>

            <div class="form-group">
                <p>Street name: {{$request->recipients_street_name}}</p>    
            </div>

            <div class="form-group">
                <p>Street number: {{$request->recipients_street_number}}</p>    
            </div>

            <div class="form-group">
                <p>Flat number: {{$request->recipients_flat_number}}</p>    
            </div>

            <x-primary-button class="ml-3 m-3">
              {{ __('Confirm') }}
            </x-primary-button>
            <a href="{{url()->previous()}}">CANCEL</a>
        </form>
      </div>
</x-app-layout>