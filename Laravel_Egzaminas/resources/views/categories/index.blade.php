@extends('layouts.app')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-semibold">Kategorijos</h1>

        <a href="{{ route('categories.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Pridėti kategoriją
        </a>
    </div>

    @if($categories->isEmpty())
        <p class="text-gray-500">Kategorijų dar nėra.</p>
    @else
        <table class="w-full border-collapse">
            <thead>
                <tr class="border-b">
                    <th class="text-left py-2">Pavadinimas</th>
                    <th class="text-left py-2">Tipas</th>
                    <th class="py-2 text-right">Veiksmai</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr class="border-b">
                        <td class="py-2">{{ $category->name }}</td>
                        <td class="py-2">
                            {{ $category->type === 'income' ? 'Pajamos' : 'Išlaidos' }}
                        </td>
                        <td class="py-2 text-right">
                            <a href="{{ route('categories.edit', $category) }}"
                               class="text-blue-600 hover:underline">
                                Keisti
                            </a>

                            <form action="{{ route('categories.destroy', $category) }}"
                                  method="POST"
                                  class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:underline"
                                        onclick="return confirm('Ištrinti?')">
                                    Trinti
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
