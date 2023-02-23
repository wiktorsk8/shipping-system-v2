<x-app-layout>
    <section class="intro">
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
                          <th scope="col">Package Size</th>
                          <th scope="col">senders email</th>
                          <th scope="col">Recipients email</th>
                          <th scope="col">Status</th>
                          <th scope="col"></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                            <td>{{$package->package_number}}</td>
                            <td>{{$package->name}}</td>
                            <td>{{$package->size}}</td>
                            <td>{{$package->senders_email}}</td>
                            <td>{{$package->recipients_email}}</td>
                            <td>{{$package->status}}</td>
                            <td> <a href="#" class="text-decoration-none">
                                    <x-primary-button>
                                        {{'Start Delivery'}}
                                    </x-primary-button>
                                </a>
                            </td>
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

</section>

</x-app-layout>