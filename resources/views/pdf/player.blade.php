{{-- $model = Player --}}
@extends('rpg::templates.pdf', ['title' => $model->name])

@section('header')
  <h1>{{ config('app.name') }}</h1>
@endsection

@section('content')
  <div class="container">
    <div class="row">
      <div class="column">
        {{-- PLAYER --}}
        <h2>{{ $model->name }}</h2>
        <table>
          <tbody>
            <tr>
              <td>User: </td><td>{{ optional($model->user)->email }}</td>
            </tr>
            <tr>
              <td>Discord: </td><td> {{ $model->discord_id }} </td>
            </tr>
            <tr>
              <td>Title: </td><td>{{ $model->title->name }}</td>
            </tr>
            <tr>
              <td>Biography: </td><td>{{ $model->biography }}</td>
            </tr>
            <tr>
              <td>Zone: </td><td>{{ optional($model->zone)->name }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      {{-- PETS --}}
      @if($model->pets)
      <div class="column">
        <h2>Pets <small>({{ $model->pets->count() }})</small></h2>
        <table>
          <thead>
            <tr>
              <th>
                Name
              </th>
              <th>
                Type
              </th>
            </tr>
          </thead>
          <tbody>
            @foreach($model->pets as $pet)
            <tr>
              <td>
                {{ $pet->name }}
              </td>
              <td>
                {{ $pet->monster->type->name }}
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      @endif
    </div>
    {{-- INVENTORY --}}
    @if($model->inventories)
    <hr>
    <div class="row">
      <div class="column">
        <h2>Inventories <small>({{ $model->inventories->count() }})</small></h2>
        @foreach($model->inventories as $inventory)
          @if($inventory->items)
            <h3>{{ $inventory->name }} - {{ $inventory->inventory_type->name }} ({{ $inventory->items->count() }}/{{ $inventory->inventory_type->capacity }})</h3>
            <table>
              <thead>
                <tr>
                  <th scope="col">
                    Name
                  </th>
                  <th>
                    Quantity
                  </th>
                </tr>
              </thead>
              <tbody>
                @foreach($inventory->items->groupBy('name') as $key => $items)
                <tr>
                  <td>
                    {{ $key }}
                  </td>
                  <td>
                    {{ $items->count() }}
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          @endif
        @endforeach
      </div>
    </div>
    @endif
  </div>
@endsection
