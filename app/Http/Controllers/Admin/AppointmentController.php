<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AppointmentRequest;
use App\Http\Resources\AppointmentResources;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;

class AppointmentController extends Controller
{
    public function __contruct(AppointmentRequest $request){
        $this->variable = $Variable
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.appointments.index');
    }

    public function getDatatable(){
        return AppointmentResources::collection(Appointment::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $input = [
            'users' => User::pluck('name', 'id'),
        ];

        return view('dashboard.appointments.create',$input);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        Appointment::create(array_merge($request->validated()));
        return redirect()->route('dashboard.appointments.index')->with(['err'=>'0','alert'=>[
            'icon'  =>'success',
            'title' =>'Success',
            'text'  =>'Appointment Added successfully',
        ]]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        $input = [
            'users' => User::pluck('name', 'id'),
            'appointment' => $appointment,
        ];

        return view('dashboard.appointments.edit',$input);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(AppointmentRequest $request, Appointment $appointment)
    {
        $appointment->update(array_merge($request->validated()));
        return redirect()->route('dashboard.appointments.index')->with(['err'=>'0','alert'=>[
            'icon'  =>'success',
            'title' =>'Success',
            'text'  =>'Appointment Updated successfully',
        ]]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        try{
            $appointment->delete();
            return response()->json(['err'=>'0','alert'=>[
                'icon'  => 'success',
                'title' => 'Deleted',
                'text'  => 'Appointment Canceled Successfully',
            ]]);
        }catch(Exception $e){
            return response()->json(['err'=>'1','alert'=>[
                'icon'  => 'error',
                'title' => 'Failed!',
                'text'  => $e->getMessage(),
            ]]);
        }
    }
}
