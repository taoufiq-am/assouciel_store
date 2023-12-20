<form action="{{ route('commandes.store') }}" method="POST">
    @csrf
    <label for="">Are you sure you want to submit this order</label>
    <input type="submit" value="yes" >
    <a href="{{ route('home.show') }}">no go back</a>

</form>
