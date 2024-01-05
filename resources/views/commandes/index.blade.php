    @extends('layouts.admin')
    @section('title', 'Gestion des categories')
    @section('content')

        <h1>Liste des commandes</h1>
        <form action="{{ route('commandes.index') }}">
            <div>
                <label for="etat">Etat</label>
                <select name="etat" id="etat">
                    <option value="">Select une etat</option>
                    @foreach ($etats as $etat)
                        <option value="{{ $etat->id }}">{{ $etat->intitule }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="">Nom client</label>
                <input type="text" placeholder="nom de client" name="nomClient">
            </div>
            <div>
                <label for="">Date min</label>
                <input type="date" name="dateMin">
            </div>
            <div>
                <label for="">Date max</label>
                <input type="date" name="dateMax">
            </div>
            <input type="submit" value="Filtrer">
        </form>

        @if ($notFound)
            <h1>{{ $notFound }}</h1>
            <a href="{{ route('commandes.index') }}">go back to all commandes</a>
        @else
            <form action="{{ route('commandes.exportCSV') }}" method="post">
                @csrf
                <input type="submit" value="Export CSV file">
            </form>
        @endif



        <table class="table center  align-middle text-center caption-top">
            <thead>
                <tr>
                    <th class="col ">ID</th>
                    <th class="col ">etat</th>
                    <th class="col ">date</th>
                    <th class="col ">Nom client</th>
                    <th class="col " colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($commandes as $commande)
                    <tr>
                        <td class="col  ">{{ $commande->id }}</td>
                        <td class="{{ $commande->etat->intitule }}">{{ $commande->etat->intitule }}</td>
                        <td class="col ">{{ $commande->created_at }}</td>
                        <td class="col ">{{ $commande->client->nom }}</td>
                        <td class="col ">
                            <a class="btn btn-promary"
                                href="{{ route('commandes.show', ['commande' => $commande->id]) }}">detail</a>
                        </td>

                        <td class="col  tdAction">
                            {{-- <form action="{{ route('commandes.update', ['commande' => $commande->id]) }}" method="post"
                                style="display:none">
                                @method('put')
                                @csrf
                                <input type="hidden" name="newEtat" class="hiddenInput">
                                <input type="submit" value="Save">
                            </form> --}}
                            <button class="save" style="display:none">Save</button>
                            <button class="btn btn-promary modify-btn">modifier etat</button>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        <div>
            {{ $commandes->links() }}
        </div>
    @endsection
    <script type="module">
        $(document).ready(function() {
            $(".modify-btn").click(function() {
                let row = $(this).closest('tr');
                let oldEtatIntitule = row.find('td:eq(1)').text();
                let options = [];

                // Hide the modify button and show the save form
                $(this).toggle();
                $(this).prev('.save').toggle();
                $.ajax({
                    type: 'GET',
                    url: '{{ route('get-etats') }}',
                    success: function(response) {
                        // Adjust the default value for the hidden input 
                        let oldEtatId = response.etats.find(obj => obj.intitule ===
                            oldEtatIntitule).id;

                        // Prepare the states for the select field
                        switch (oldEtatIntitule) {
                            case "En attente de confirmation":
                                options = ["En attente de confirmation", "Confirmée",
                                "Anuller"];
                                break;
                            case "Confirmée":
                                options = ["Confirmée", "Envoyée"];
                                break;
                            case "Anuller":
                                options = ["Anuller"];
                                break;
                            case "Envoyée":
                                options = ["Envoyée", "Payée", "Retournée"];
                                break;
                            case "Retournée":
                                options = ["Retournée"];
                                break;
                            case "Payée":
                                options = ["Payée"];
                                break;
                        }
                        // Create the HTML options tags with the states id on the value
                        let etats = options.map(opt => {
                            return `<option value="${response.etats.find(obj => obj.intitule === opt).id}">${opt}</option>`;
                        }).join('');

                        // Add the options to the select
                        row.find('td:eq(1)').html(
                            `<select class="form-control selectEtat" name="newEtat" id="">
                                ${etats}
                            </select>`
                        );
                    }
                });
            });

            $(".save").click(function() {
                let row = $(this).closest('tr');
                let commandId = row.find('td:eq(0)').text();
                let newEtatId = $(".selectEtat").val();
                // Hide the modify button and show the save form
                $(this).toggle();
                $(this).next('.modify-btn').toggle();



                $.ajax({
                    url: `/commandes/${newEtatId}/${commandId}`,
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr("content"),
                    },
                    success: function(response) {
                        row.find('td:eq(1)').text(response.newEtatIntitule).attr({"class":response.newEtatIntitule});
                    }

                });
            });
        });
    </script>
