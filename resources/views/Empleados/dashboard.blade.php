@extends('layouts.user_view', ['headers' => []])

@section('title', 'Index')
@section('style')
    <style>
        .card-asistencias h2, .card-inasistencias h2 {
    font-size: 23px; 
    font-weight: bold;
}

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            font-family: 'Arial', sans-serif;
            margin: 10px;
            text-align: center;
        }

        /* Card Asistencias */
        .card-asistencias {
            background-color: #043a2c;
            color: #ffffff;
            transition: transform 0.2s ease, background-color 0.3s ease;
        }

        .card-asistencias:hover {
            background-color: #193d1b;
            transform: scale(1.05);
        }

        /* Card Inasistencias */
        .card-inasistencias {
            background-color: #2a682d;
            color: #ffffff;
            transition: transform 0.2s ease, background-color 0.3s ease;
        }

        .card-inasistencias:hover {
            background-color: #2e7d32;
            transform: scale(1.05);
        }

        /* Card Info Admin */
        .card-info-admin {
            background-color: #e8f5e9;
            color: #1b5e20;
            border: 1px solid #c8e6c9;
            border-radius: 10px;
            padding: 15px;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .card-info-admin img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .card-info-admin .info-text {
            flex-grow: 1;
        }

        .card-info-admin .info-text h4,
        .card-info-admin .info-text p {
            margin: 0;
        }

        .card-info-admin .info-text p {
            font-size: 14px;
        }

        .card-info-admin .buttons a {
            margin-right: 10px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .card-info-admin {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .card-info-admin img {
                margin-bottom: 10px;
            }
        }
    </style>
@endsection

@section('sidebar')
    @include('layouts._partials.sidebar_empleado')
@endsection

@section('content')
    <div class="container mt-4">
        <div class="row">
            <!-- Card: Asistencias -->
            <div class="col-md-6">
                <a href="{{ route('empleado.asistencia') }}" class="card-link">
                <div class="card card-asistencias shadow-lg">
                    <div class="card-body">
                        <h2 class="card-title">Asistencias</h2>
                    </div>
                </div>
            </div>

            <!-- Card: Inasistencias -->
            <div class="col-md-6">
                <a href="{{ route('empleado.inasistencia') }}" class="card-link">

                <div class="card card-inasistencias shadow-lg">
                    <div class="card-body">
                        <h2 class="card-title">Inasistencias</h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Admin Info -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card card-info-admin shadow">
                    <div>
                        <img src="{{asset('assets/img/admin.png')}}" alt="Foto del Administrador">
                    </div>
                    <!-- Info -->
                    <div class="info-text">
                        <p>Administrador</p>
                        <h4>Héctor Hugo Avilés Arriaga</h4>
                        <p><strong>Email:</strong> havilesa@upv.edu.mx</p>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection