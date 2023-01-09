<html>
<form action="{{route('test')}}" method="POST">
    @csrf

    <input type="checkbox" name="work_days[0]" value="1">
    <input type="checkbox" name="work_days[1]" value="2">
    <input type="checkbox" name="work_days[2]" value="3">
 
    <button type="submit">myk</button>
</form>


</html>