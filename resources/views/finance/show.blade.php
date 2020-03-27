@extends('layouts.app')

@section('title', $club->name . ' - ')

@section('header')
    @include('clubs.partials.header')
@endsection

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <h2>Balance: {{ $club->balance }}</h2>

                <strong>Last week costs: {{ $lastWeekCosts }}</strong>

                <ul>
                    @foreach($transactions as $transaction)
                        <li>{{ $transaction->sum }} :
                            @if ($transaction->isManagerContract)
                                {{ $transaction->user->name }}
                            @elseif ($transaction->isPlayerContract)
                                <a href="{{ link_route('show_player', ['person' => $transaction->person]) }}">{{ $transaction->person->firstname . ' ' . $transaction->person->lastname }}</a>
                            @endif
                        </li>
                    @endforeach
                </ul>

                {{ $transactions->links() }}

            </div>
            <div class="col-md-4">
                @auth()
                    @if (auth()->user()->isAdmin)
                        <a href="{{ link_route('edit_club', ['club' => $club]) }}">Edit Club</a>
                    @endif
                @endauth
                @include('clubs.partials.sidemenu')
            </div>
        </div>
    </div>

@endsection
