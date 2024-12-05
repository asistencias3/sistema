<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Torneo;
use App\Models\User;
use App\Models\Equipo;


class UsDashboordsController extends Controller{

    public function AdminDashboard()
    {
        return view("admin.dashboard");
    }
    public function EmpDashboard()
    {
        return view("Empleados.dashboard");
        //modificar el dashbord
    }
    public function RHDashboard()
    {
        return view("RH.dashboard");
        //modificar el dashbord
    }

}
