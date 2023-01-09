<x-app-layout>

            <ul class="list-group mt-5 text-white">
                @foreach ($packages as $package)
                <li class="list-group-item d-flex justify-content-between align-content-center">
    
                    <div class="d-flex flex-row">
                        <div class="ml-2">
                            <h3 class="mb-0">{{$package->name}}</h3>
                            <ul class="list-group mt-5 text-white">
                                <div class="container d-flex justify-content-center">
                                    <li class="list-group-item d-flex justify-content-between align-content-center">
                                        <div class="d-flex flex-row">
                                            {{$package->senders_address}}
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-content-center">
                                        <div class="d-flex flex-row">
                                            {{$package->receivers_address}}
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-content-center">
                                        <div class="d-flex flex-row">
                                            {{$package->size}}
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-content-center">
                                        <div class="d-flex flex-row">
                                            {{$package->package_number}}
                                        </div>
                                    </li>    
                                </div>
                             
                             </ul>
                        </div>
                    </div>
                    <div class="nwm">
                        <form action="{{route('packages.show', $package)}}" method="GET">
                            @csrf

                            <button type="submit">SHOW</button>
                        </form>
                        
                    </div>
                </li>  
                @endforeach
</x-app-layout>