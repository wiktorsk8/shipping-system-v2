<x-app-layout>

    <form action="{{route('load.tracking')}}" method="GET">
        @csrf
        <input type="text" name="package_number" placeholder="Enter the package number"
            class="bg-transparent placeholder-black font-semibold text-sm">
            <button type="submit" style="transform: scale(0.92); background-color: #4285f4; color: white; border: none; border-radius: 20px; padding: 10px 20px; font-size: 16px;">Submit</button>
    </form>
    @if (isset($package))
        @foreach ($package as $item)
        <div class="bg-light p-4" style="width: 25%;">
            <h1 style="background-color: #6d8fc7; color: white; border: none; border-radius: 20px; padding: 10px 20px; font-size: 16px;">package name: {{$item->name}}</h1>
            <h1 style="background-color: #6d8fc7; color: white; border: none; border-radius: 20px; padding: 10px 20px; font-size: 16px;">package status: {{$item->getStatusKey()}}</h1>
          </div>
          
          
        @endforeach 
    @endif

</x-app-layout>