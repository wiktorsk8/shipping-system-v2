<html>
    <body>

        <form action="{{route('tracking')}}" method="GET">
            
            <select name="date" id="date">
                <option selected value="desc">Latest</option>
                <option value="asc">Oldest</option>
            </select>
    
            <input type="text" name="name" placeholder="Search by package name..."
            class="bg-transparent placeholder-black font-semibold text-sm">

            <button type="submit">Apply filters</button>
        </form>
    
        @foreach ($packages as $package)
            <div>
               
                <h1 class="font-bold bg-blue-400">{{$package->name}} | size: {{$package->size}} </h1>
                </a>   
         
                
            </div>
        @endforeach
    </body>

</html>