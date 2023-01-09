<form action="{{ route('packages.update', $package->id) }}" method="post">
    @csrf
    @method('put')
    <label for="name">name</label>
    <input type="text" name="name">

    <label for="senders_address">senders address</label>
    <input type="text" name="senders_address">
    
    <label for="receivers_address">receivers address</label>
    <input type="text" name="receivers_address">
    
    <label for="size">size</label>
    <input type="text" name="size">

    <label for="receivers_id">receivers id</label>
    <input type="number" name="receivers_id">
    
    <label for="senders_id">senders id</label>
    <input type="number" name="senders_id">

    <label for="cash_on_delivery">cash_on_delivery</label>
    <input type="number" name="cash_on_delivery">

    <label for="status">status</label>
    <input type="number" name="status">

    <button type="submit"> update </button>
</form>