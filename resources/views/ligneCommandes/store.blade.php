<form action="{{route("ligneCommandes.store")}}" method="POST">
@csrf
</form>
<script>
    document.querySelector("form").submit();
</script>