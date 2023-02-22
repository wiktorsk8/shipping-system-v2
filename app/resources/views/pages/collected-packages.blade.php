<x-app-layout>

    <section class="intro">
        <div  style="background-color: rgba(25, 185, 234,.25);">
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
                           
                            <th scope="col">Order</th>
                            <th scope="col">name</th>
                            <th scope="col">Number</th>
                            <th scope="col">Size</th>
                            <th scope="col">Coordinates</th>
                            
                            </tr>
                          </thead>
                          <tbody>
                            <?php $i = 1?>
                          @if (!empty($packages))
                            @foreach ($packages as $package)
                            <tr>
                                <td>{{'#'.$i}}</td>
                                <td>{{$package->name}}</td>
                                <td>{{$package->package_number}}</td>
                                <td>{{$package->size}}</td>
                                <td>{{$package->address->coordinates}}</td>
                                
                                <td>
                                    <a href={{'packages/show/'.$package->package_number}} class="text-decoration-none">
                                        <x-primary-button>
                                            {{'->'}}
                                        </x-primary-button>
                                    </a>
                                    
                                </td>
                                
                            </tr>
                            <?php $i += 1?>
                            @endforeach
                          
                          @else
                            <p>NO PACKAGES</p>
                          @endif
                         
                          </tbody>
                          <div class="d-flex justify-content-center">
                            <a class="btn btn-primary" href="#" role="button">Deliver all -></a>
                          </div>
                        </table>
                      </div>
                    </div>
                  </div>
              
                  <div id="map" class="w-100 p-3" style="height: 500px">

          
                  
                 
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </section>





<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-1WTxfHhHvB_mbKgXKcyrtwkfVQMia4Q&callback=initMap"></script>

<script>
  // In the following example, markers appear when the user clicks on the map.
  // Each marker is labeled with a single alphabetical character.
  const labels = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
  
  let labelIndex = 0;

  function initMap() {
    const bangalore = { lat: 52.474820, lng: 17.286664 }; 
    const map = new google.maps.Map(document.getElementById("map"), {
      zoom: 10,
      center: bangalore,
    });
    
    addMarker(bangalore, map);

    var coordinates = <?php echo json_encode($coordinates); ?>;

    for (let i = 0; i<coordinates.length; i++){
        
        const temp = coordinates[i].split(",");
     
        addMarker({
          lat: parseFloat(temp[0]),
          lng: parseFloat(temp[1])
        }, map);
    }
    


    // This event listener calls addMarker() when the map is clicked.
    // google.maps.event.addListener(map, "click", (event) => {
    //   addMarker(event.latLng, map);
    // });
    // Add a marker at the center of the map.
    
  }


  // Adds a marker to the map.
  function addMarker(location, map) {
    // Add the marker at the clicked location, and add the next-available label
    // from the array of alphabetical characters.
    new google.maps.Marker({
      position: location,
      label: labels[labelIndex++ % labels.length],
      map: map,
    });
  }
  
  window.initMap = initMap;
    
  </script>
</x-app-layout>