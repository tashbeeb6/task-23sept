<?php

namespace App\Http\Controllers;

use App\Events\AppointmentStatusUpdated;
use App\Interface\AppointmentRepositoryInterface;
use App\Http\Requests\StoreAppointmentRequest;
use App\Models\Service;
use App\Models\ServiceProvider;
use Laravel\Reverb\Protocols\Pusher\EventDispatcher;
use Illuminate\Http\Request;
class AppointmentController extends Controller
{
    public function __construct(
        protected AppointmentRepositoryInterface $appointment_repository
    ) {}

    public function index()
    {

    if (auth()->user()->role === 'admin') {
        $appointment = $this->appointment_repository->getAll();
    } else {
        $appointment = $this->appointment_repository->getByCustomer(auth()->id());
        
    }    $notifications = auth()->user()->notifications;

    return view('dashboard', compact('appointment','notifications'));

    }

    public function create()
    {
        $services= Service::all();
    //   dd($services->pluck('Service_name'));
        $service_provider = ServiceProvider::all();
        return view('appointments.create',compact('services','service_provider'));
    }

    public function store(StoreAppointmentRequest $request)
    {
        $data = $request->all();
        $data['customer_id'] = auth()->id();
        // Status will use DB default = 'pending'. Admin confirms via edit form.
        $this->appointment_repository->create($data);

        return redirect()->route('dashboard');
    }

    public function edit($id)
    {
        $appointment = $this->appointment_repository->findById($id);
        $services = Service::all();
        $service_provider = ServiceProvider::all();
        
        return view('appointments.edit', compact('appointment', 'services', 'service_provider'));
    }

    public function update(Request $request, $id)
    {
         
        $data = $request->all();
      $appointment =  $this->appointment_repository->update($id, $data);
     
        AppointmentStatusUpdated::dispatch($appointment);
        return redirect()->route('dashboard');
     
    }

    public function destroy($id)
    {
        $this->appointment_repository->delete($id);
        return redirect()->route('dashboard');
    }
}