<x-app-layout>

    <section class="intro">
        <div class="bg-image h-100" style="background-image: url('https://mdbootstrap.com/img/Photos/new-templates/tables/img4.jpg');">
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
                           
                            <th scope="col">Package Name</th>
                            <th scope="col">Package Size</th>
                            <th scope="col">Senders Address</th>
                            <th scope="col">Receivers Address</th>
                            <th scope="col">Show</th>
                           
                              
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($packages as $package)
                            <tr>
                                
                                <td>{{$package->name}}</td>
                                <td>{{$package->size}}</td>
                                <td>{{$package->senders_address}}</td>
                                <td>{{$package->receivers_address}}</td>
                                <td>
                                    <a href="{{route('packages.show', ['package' => $package])}}" class="text-decoration-none">
                                        <x-primary-button>
                                            {{'->'}}
                                        </x-primary-button>
                                    </a>
                                    
                                </td>
                            </tr>
                            @endforeach
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