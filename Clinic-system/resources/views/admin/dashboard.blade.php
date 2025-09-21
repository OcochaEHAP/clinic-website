@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="container my-4">
    <h2 class="mb-4 text-center">Tableau de Bord</h2>

    {{-- Summary Cards --}}
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm border-primary">
                <div class="card-body text-center">
                    <h5 class="card-title">Patients</h5>
                    <h3 class="text-primary">{{ $totalPatients }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-success">
                <div class="card-body text-center">
                    <h5 class="card-title">Paiements</h5>
                    <h3 class="text-success">{{ number_format($totalPayments, 2) }} DA</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-danger">
                <div class="card-body text-center">
                    <h5 class="card-title">Dépenses</h5>
                    <h3 class="text-danger">{{ number_format($totalExpenses, 2) }} DA</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-info">
                <div class="card-body text-center">
                    <h5 class="card-title">Profit Net</h5>
                    <h3 class="text-info">{{ number_format($netProfit, 2) }} DA</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- Charts --}}
    <div class="row mb-5">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Revenus vs Dépenses</h5>
                    <canvas id="financeChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Rendez-vous par Mois</h5>
                    <canvas id="appointmentsChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- Recent Activity --}}
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Derniers Paiements</h5>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Patient</th>
                                <th>Montant</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentPayments as $payment)
                            <tr>
                                <td>{{ $payment->patient->first_name }} {{ $payment->patient->last_name }}</td>
                                <td>{{ number_format($payment->amount, 2) }} DA</td>
                                <td>{{ $payment->payment_date }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Dernières Dépenses</h5>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Titre</th>
                                <th>Montant</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentExpenses as $expense)
                            <tr>
                                <td>{{ $expense->title }}</td>
                                <td>{{ number_format($expense->amount, 2) }} DA</td>
                                <td>{{ $expense->expense_date }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const financeCtx = document.getElementById('financeChart').getContext('2d');
    new Chart(financeCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($months) !!},
            datasets: [
                {
                    label: 'Paiements',
                    data: {!! json_encode($paymentsPerMonth) !!},
                    borderColor: 'green',
                    fill: false
                },
                {
                    label: 'Dépenses',
                    data: {!! json_encode($expensesPerMonth) !!},
                    borderColor: 'red',
                    fill: false
                }
            ]
        }
    });

    const appointmentsCtx = document.getElementById('appointmentsChart').getContext('2d');
    new Chart(appointmentsCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($months) !!},
            datasets: [{
                label: 'Rendez-vous',
                data: {!! json_encode($appointmentsPerMonth) !!},
                backgroundColor: 'blue'
            }]
        }
    });
</script>
@endsection
