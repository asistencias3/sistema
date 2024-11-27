{{-- Vista general de asistencia --}}
@extends('layouts.user_view')

@section('title', 'Asistencia')

@section('styles')
    <!--Regular Datatables CSS-->
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <!--Responsive Extension Datatables CSS-->
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">

    <style>
        /*Overrides for Tailwind CSS */

        /*Form fields*/
        .dataTables_wrapper select,
        .dataTables_wrapper .dataTables_filter input {
            color: #4a5568;
            /*text-gray-700*/
            padding-left: 1rem;
            /*pl-4*/
            padding-right: 1rem;
            /*pl-4*/
            padding-top: .5rem;
            /*pl-2*/
            padding-bottom: .5rem;
            /*pl-2*/
            line-height: 1.25;
            /*leading-tight*/
            border-width: 2px;
            /*border-2*/
            border-radius: .25rem;
            border-color: #edf2f7;
            /*border-gray-200 NO*/
            background-color: #e6edec;
            /*bg-gray-200 NO*/
        }

        /*Row Hover*/
        table.dataTable.hover tbody tr:hover,
        table.dataTable.display tbody tr:hover {
            background-color: #e6edec;
            /*bg-indigo-100*/
        }

        /*Pagination Buttons*/
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            font-weight: 700;
            /*font-bold*/
            border-radius: .25rem;
            /*rounded*/
            border: 1px solid transparent;
            /*border border-transparent*/
        }

        /*Pagination Buttons - Current selected */
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            color: #fff !important;
            /*text-white*/
            /*BIEN*/
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
            /*shadow*/
            font-weight: 700;
            /*font-bold*/
            border-radius: .25rem;
            /*rounded*/
            background: #2e6765 !important;
            /*bg-indigo-500*/
            border: 1px solid transparent;
            /*border border-transparent*/
        }

        /*Pagination Buttons - Hover */
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            color: #fff !important;
            /*text-white*/
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
            /*shadow*/
            font-weight: 700;
            /*font-bold*/
            border-radius: .25rem;
            /*rounded*/
            border: 1px solid transparent;
            /*border border-transparent*/
        }

        /* Estilo específico para los botones Previous y Next */
        .dataTables_wrapper .dataTables_paginate .paginate_button.previous:hover,
        .dataTables_wrapper .dataTables_paginate .paginate_button.next:hover {
            color: #ffffff !important;
            /* Cambia el texto a blanco */
            background-color: #5e8a89 !important;
            /* Fondo al hacer hover */
            border-color: transparent !important;
        }


        .paginate_button:hover {
            background: #5e8a89 !important;

            /*bg-indigo-500*/
        }

        /*Add padding to bottom border */
        table.dataTable.no-footer {
            border-bottom: 1px solid #e2e8f0;
            /*border-b-1 border-gray-300*/
            margin-top: 0.75em;
            margin-bottom: 0.75em;
        }

        /*Change colour of responsive icon*/
        table.dataTable.dtr-inline.collapsed>tbody>tr>td:first-child:before,
        table.dataTable.dtr-inline.collapsed>tbody>tr>th:first-child:before {
            background-color: #667eea !important;
            /*bg-indigo-500*/
        }
    </style>
@endsection

@section('content')

    <!--Container-->
    <div class="container w-full px-2 text-center">
        <!--Title-->
        <!--Card-->
        <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-[#fdfcfd] text-gray-950 w-full">


            <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                <thead>
                    <tr>
                        <th data-priority="1">Id</th>
                        <th data-priority="2">Id Sucursal</th>
                        <th data-priority="3">Fecha</th>
                        <th data-priority="4">Entrada</th>
                        <th data-priority="5">Salida</th>
                        <th data-priority="6">Entrada 2</th>
                        <th data-priority="7">Salida 2</th>
                        <th data-priority="8">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>1</td>
                        <td>10-11-20</td>
                        <td>7:10:25</td>
                        <td>10:10:25</td>
                        <td>5:10:25</td>
                        <td>10:10:25</td>
                        <td><a href="#"
                                class="p-1.5 m-1.5 bg-[#0468BF] rounded font-bold text-[#fdfcfd] hover:bg-[#09487E]">Editar</a><a
                                href="#"
                                class="p-1.5 m-1.5 bg-rose-500 rounded font-bold text-[#fdfcfd] hover:bg-rose-700">Eliminar</a>
                        </td>
                    </tr>

                    <!-- Rest of your data (refer to https://datatables.net/examples/server_side/ for server side processing)-->

                    <tr>
                        <td>2</td>
                        <td>1</td>
                        <td>10-11-20</td>
                        <td>7:10:25</td>
                        <td>10:10:25</td>
                        <td>13:10:25</td>
                        <td>16:10:25</td>
                        <td><a href="#"
                                class="p-1.5 m-1.5 bg-[#0468BF] rounded font-bold text-[#fdfcfd] hover:bg-[#09487E]">Editar</a><a
                                href="#"
                                class="p-1.5 m-1.5 bg-rose-500 rounded font-bold text-[#fdfcfd] hover:bg-rose-700">Eliminar</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!--/Card-->
    </div>
    <!--/container-->





    <!-- jQuery -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <!--Datatables -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script>
        $(document).ready(function() {

            var table = $('#example').DataTable({
                    responsive: true
                })
                .columns.adjust()
                .responsive.recalc();
        });
    </script>


    </html>
@endsection
