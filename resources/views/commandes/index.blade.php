    @extends('layouts.layout')
    @section('title', 'Gestion des categories')
    @section('space-work')

        <h1>Liste des commandes</h1>
        <form class="form-inline" action="{{ route('commandes.index') }}" method="get">
            <div class="form-group mx-sm-3 mb-2">
              <label for="etat" class="text-dark mr-2" style="font-size: 1.25em">Etat :</label>
              <select class="form-control border" style="width: 20em" name="etat" id="etat">
                <option value="">Selecter une etat...</option>
                @foreach ($etats as $etat)
                    <option value="{{ $etat->id }}">{{ $etat->intitule }}</option>
                @endforeach
            </select>
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <label for="nomClient" class="text-dark mr-2" style="font-size: 1.25em">Nom client :</label>
               <input type="text" class="form-control border " id="nomClient" name="nomClient" placeholder="Designation">
             </div>
            <div class="form-group mx-sm-3 mb-2">
                <label for="date" class="text-dark mr-2" style="font-size: 1.25em">Date min :</label>
               <input type="date" class="form-control border " id="date" name="dateMin">
             </div>
            <div class="form-group mx-sm-3 mb-2">
                <label for="date" class="text-dark mr-2" style="font-size: 1.25em">Date max :</label>
               <input type="date" class="form-control border " id="date" name="dateMax">
             </div>
            <button type="submit" class="btn btn-primary mb-2">Filter</button>
          </form>

            <form action="{{ route('commandes.exportCSV') }}" method="post">
                @csrf
                <input class="btn btn-primary" type="submit" value="Export CSV file">
            </form>


        {{-- <form action="{{ route('commandes.update', ['commande' => 1]) }}" method="post">
            @csrf
            @method('put')
            <input type="submit" value="AAAAAAAAAAAAAAAAAAAAAA">
        </form> --}}
        <table id="tbl" class="table center align-middle text-center caption-top">
                <tr>
                    <th>ID</th>
                    <th>Nom client</th>
                    <th>date</th>
                    <th>etat</th>
                    <th colspan="2">Action</th>
                </tr>
                @if ($notFound)
                <tr>
                    <td colspan="6">La list est vide <a href="{{ route("commandes.index") }}">Retourner a la list</a></td>
                 </tr>
                @else
                @foreach ($commandes as $commande)
                    <tr>
                        <td>{{ $commande->id }}</td>
                        <td>{{ $commande->client->nom }}</td>
                        <td>{{ Carbon\Carbon::parse($commande->created_at)->format('Y-m-d') }}</td>
                        <td class="{{ $commande->etat->intitule }}"><span
                            class="oldEtatIntitule">{{ $commande->etat->intitule }}</span> <span hidden
                            class="oldEtatId">{{ $commande->etat->id }}</span>
                        </td>
                        <td>
                            <a class="btn btn-primary"
                                href="{{ route('commandes.show', ['id' => $commande->id]) }}">detail</a>
                        </td>
                        <td class="tdAction">
                            <button class="btn btn-secondary save" style="display:none">Save</button>
                            <button class="btn btn-primary modify-btn">modifier etat</button>
                        </td>
                    </tr>
                @endforeach
                @endif
        </table>
        <div>
            {{ $commandes->links() }}
        </div>
    @endsection
    <script type="module">
        $(document).ready(function() {
            $(".modify-btn").click(function() {
                let row = $(this).closest('tr');
                let oldEtatIntitule = row.find('.oldEtatIntitule').text();
                let oldEtatId = row.find('.oldEtatId').text();

                $(this).toggle();
                $(this).prev('.save').toggle();
                $.ajax({
                    type: 'GET',
                    url: `/get-etats/${oldEtatId}`,
                    success: function(response) {
                           let etats = response.etats;

                            if (etats.length > 0) {
                                let options = etats.map(etat => {
                                return `<option value="${etat.id}">${etat.intitule}</option>`;
                            }).join('');

                            row.find('td:eq(3)').html(
                                `<select class="form-control selectEtat" name="newEtat" id="">
                                <option value="${oldEtatId}">${oldEtatIntitule}</option>
                                ${options}
                            </select>`
                            );

                        }


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
                    url: "/commandes-update/" + commandId,
                    type: 'PUT',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'PUT',
                        newEtatId: newEtatId
                    },

                    success: function(response) {
                        row.find('td:eq(3)').html(
                            `
                        <span
                            class="oldEtatIntitule">${response.newEtatIntitule}</span>
                             <span hidden
                            class="oldEtatId">${newEtatId}</span>
                        `
                        ).addClass(response.newEtatInt);
                        console.log(response);
                    }
                });
            });
        });
    </script>
