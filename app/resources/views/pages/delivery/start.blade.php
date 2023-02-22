
<x-app-layout>
    @dd($package)
    <div class="bg-image h-100">
        <div class="mask d-flex align-items-center h-100" style="background-color: rgba(25, 185, 234,.25);">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-hover mb-0">
                        <thead>
                          <tr>
                            <th scope="col">Package Number</th>
                            <th scope="col">Package Name</th>
                            <th scope="col">Senders Address</th>
                            <th scope="col">Receivers Address</th>
                            <th scope="col">Package Size</th>
                            <th scope="col">Cash On Delivery</th>
                            <th scope="col">Senders Id</th>
                            <th scope="col">Receivers Id</th>
                            <th scope="col">Status</th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                              <td>{{$package->package_number}}</td>
                              <td>{{$package->name}}</td>
                              <td>{{$package->senders_address}}</td>
                              <td>{{$package->receivers_address}}</td>
                              <td>{{$package->size}}</td>
                              <td>{{$package->cash_on_delivery}}</td>
                              <td>{{$package->senders_id}}</td>
                              <td>{{$package->receivers_id}}</td>
                              <td>{{$package->status}}</td>
                              {{-- <td> <a href="#" class="text-decoration-none">
                                      <x-primary-button>
                                          {{'Start Delivery'}}
                                      </x-primary-button>
                                  </a>
                              </td> --}}
                          </tr>
                        </tbody>
                      </table>
                      
                    </div>
                  </div>
                </div>
                
              </div>
            </div>
          </div>
        </div>
      </div>
      <form method="POST" action="{{route('deliveries.store')}}">
          <input type="hidden" name="couriers_id" id="couriers_id" value={{Auth::user()->id}}>
          <input type="hidden" name="package_id" id="package_id" value={{$package->id}}>
      </form>
    </div>
  
  </x-app-layout>